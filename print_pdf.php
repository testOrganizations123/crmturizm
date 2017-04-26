<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
include_once 'vtlib/Vtiger/Module.php';
require_once 'include/utils/utils.php';
require_once 'includes/Loader.php';
vimport ('includes.runtime.EntryPoint');
// ---  создание базы данных ]

$record = $_GET['record'];
$recordModel = Vtiger_Record_Model::getInstanceById($record);
$country = $recordModel->get('turoperator');
$turoperator = $recordModel->get('country');
$file_array = getListPdf($country,$turoperator);
$createOutputFile = createOutputFile($country,$turoperator,$file_array);

function createOutputFile($country,$turoperator,$file_array){
    $outputFileName = 'createPdf/'.$country.'_'.$turoperator.'.pdf';
    if (is_file($outputFileName.'add')){
        generatePDFpage($outputFileName);
    }
    else {
        $string = implode(" ", $file_array);
        $string = 'pdftk '.$string.' cat output '.$outputFileName;
        exec ("$string");
        generatePDFpage($outputFileName);
    }
}
function generatePDFpage($outputFileName){
    $fileSize = filesize($outputFileName);
    $fileSize = $fileSize + ($fileSize % 1024);
    $fileContent = fread(fopen($outputFileName, "r"), $fileSize);
    header("Content-type: application/pdf");
    header("Accept-Ranges: bytes");
    header("Content-Leght: ".$fileSize);
    print $fileContent;
}
function  getListPdf($country,$turoperator){
    $country_doc = getSenoterel($country);
    $turoperator_doc = getSenoterel($turoperator);
    $noteid = array();
    foreach ($country_doc as $value){
        if (in_array($value, $turoperator_doc)){
            $noteid[] = $value;
        }
    }
    $array = getFilePatch($noteid);
    $file_array = array();
    foreach ($array as $value){
        $file_array[] = $value['path'].$value['attachmentsid'].'_'.$value['name'];
    }
    return $file_array;
}
function getFilePatch($noteid){
    $in = implode(",",$noteid);
     global $adb;
    $sql = "select a.* from vtiger_seattachmentsrel as r INNER JOIN vtiger_attachments as a ON a.attachmentsid = r.attachmentsid where crmid IN ($in)";
    
    $result = $adb->pquery($sql, array());
    $numRows = $adb->num_rows($result);
    $array = array();
    for ($i=0;$i<$numRows;$i++){
        $array[$adb->query_result($result, $i, 'attachmentsid')] = $adb->query_result_rowdata($result, $i);
    }
    return $array;
    
}
function getSenoterel($crmid){
    global $adb;
    $sql = "select * from vtiger_senotesrel where crmid = ?";
    $result = $adb->pquery($sql, array($crmid));
    $numRows = $adb->num_rows($result);
    $array = array();
    for ($i=0;$i<$numRows;$i++){
        $array[$adb->query_result($result, $i, 'notesid')] = $adb->query_result($result, $i, 'notesid');
    }
    return $array;
}