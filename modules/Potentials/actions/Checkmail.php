<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
require_once('modules/Emails/mail.php');

class Potentials_Checkmail_Action extends Vtiger_Action_Controller{
    public function process(Vtiger_Request $request) {
         $this->record = $request->get('record');
         $recordModel = Vtiger_Record_Model::getInstanceById($this->record);
         $this->potentials = $recordModel;
         $this->country = $recordModel->get('turoperator');
         $this->turoperator = $recordModel->get('country');
         $this->client_id = $recordModel->get('contact_id');
         $this->file_array = $this->getListPdf( $this->country,$this->turoperator);
         $this->creteMail();
        
                       
    }
    public function creteMail(){
        $this->clientRecordModel = Vtiger_Record_Model::getInstanceById($this->client_id);
        $this->clientModuleName = $this->clientRecordModel->getModuleName();
        if ($this->clientModuleName == 'Accounts'){
            $mailto = $this->clientRecordModel->get('email1');
        }
        else {
            $mailto = $this->clientRecordModel->get('email');
        }
        //$mailto = 'vordoom@inbox.ru';
        $templates = EmailTemplates_Record_Model::getInstanceById(14);
        $subject = $templates->get('subject');
        $body = $this->getContent($templates);
        send_mail('Contacts', $mailto, 'Мой Горящий Тур', 'robot@moihottur.ru', $subject, $body, "", "", $this->file_array);
            
        
        
    }
    public function getContent($templates){
        global $current_user;
        $content = $templates->get('body');
        
        $fistName = $this->clientRecordModel->get('firstname');
        $midleName = $this->clientRecordModel->get('midlename');
        $userTitle = $current_user->title;
        $userFistName = $current_user->first_name;
        $userLastName = $current_user->last_name;
        $content = sprintf($content, $fistName,$midleName,$userTitle,$userFistName,$userLastName);
        return $content;
        
    }
    public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$record = $request->get('record');

		if(!Users_Privileges_Model::isPermitted($moduleName, 'Save', $record)) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
	}
    public function  getListPdf($country,$turoperator){
        $country_doc = $this->getSenoterel($country);
        $turoperator_doc = $this->getSenoterel($turoperator);
        $noteid = array();
        foreach ($country_doc as $value){
            if (in_array($value, $turoperator_doc)){
                $noteid[] = $value;
            }
        }
        $array = $this->getFilePatch($noteid);
        $file_array = array();
        foreach ($array as $value){
            $file_array[] = $value['path'].$value['attachmentsid'].'_'.$value['name'];
        }
        return $file_array;
    }
    public function getSenoterel($crmid){
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
    function getFilePatch($noteid){
        global $adb;
        $in = implode(",",$noteid);
        $sql = "select a.* from vtiger_seattachmentsrel as r INNER JOIN vtiger_attachments as a ON a.attachmentsid = r.attachmentsid where crmid IN ($in)";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        $array = array();
        for ($i=0;$i<$numRows;$i++){
            $array[$adb->query_result($result, $i, 'attachmentsid')] = $adb->query_result_rowdata($result, $i);
        }
        return $array;
    
    }
    
}