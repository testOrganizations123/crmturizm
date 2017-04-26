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
// ---  создание базы данных 

$HOST = "193.124.177.160";      
$USER = "crmturizm";        
$PASS = "I0y7Y2s0";       

die();

$connection = new mysqli($HOST,$USER,$PASS, 'crmturizm');
$connection->set_charset("utf8");
$query = "select o.* from crm__booking as a left join crm__user as u ON u.user_id = a.user_id left join crm__book_operator as o on o.book_operator_id = a.book_operator_id WHERE 1 group by a.book_operator_id";
$r = $connection->query($query);
$array = array();
while( $row = $r->fetch_assoc() ){
       $array[] = $row;
    }

    /* Освобождаем память */
    $r->close();
    
    echo '<pre>'; 
//print_r($array);die();


ini_set('display_errors',1);
error_reporting(E_ERROR);
$import = new import_contact($array);
$import->process();

class import_contact {
    public $db;
    public $data;
    public $user = array(
    53=>66,
    156=>66,
    158=>67,
);
    public $spcompany = array(
        4=>'ИП Миндюк А.В.',
        5=>'ИП Миндюк Ю.Х.',
        6=>'ИП Верещака А.Б.',
    );
    function __construct($array) {
        $this->data = $array;
    }
    function company( $new, $old = ''){
        
        if (empty($new)) return $old;
        $company_new = $this->spcompany[$new];
        if (empty($old)) return $new;
        $old = explode('|##|',$old);
        if (!in_array($company_new, $old)){
            $old[] = $company_new;
        }
        return implode('|##|', $old);
    }
    function process(){
         global $current_user, $adb;
         $current_user = Users::getActiveAdminUser();
         
        $moduleName = 'Vendors';
        foreach ($this->data as $key=>$value){
            $recordId = $this->checkContact(trim($value['book_operator_number']));
            if($recordId) {
                $record = Vtiger_Record_Model::getInstanceById($recordId,$moduleName);
                $record->set('mode', 'edit');
                $record->set('spcompany', $this->company($value['unit_id'],$record->get('spcompany')));
            }
            else {
            $record = Vtiger_Record_Model::getCleanInstance($moduleName);
            $record->set('spcompany', $this->company($value['unit_id']));
            $record->set('cf_997', trim($value['book_operator_number']));
            }
            $record->set('cf_999', trim($value['book_operator_title']));
            $record->set('vendorname', trim($value['book_operator_title_short']));
            $record->set('website', trim($value['book_operator_url']));
            $record->set('cf_1015', trim($value['book_operator_ogrn']));
            $record->set('category', 'turoperator');
            $record->set('cf_1013', trim($value['book_operator_inn']));
            $record->set('street', trim($value['book_operator_address']));
            $record->set('cf_1001', trim($value['book_operator_address_postal']));
            $record->set('cf_1017', $value['book_operator_finsec_amount']);
            $record->set('cf_1019', trim($value['book_operator_finsec_doc_title']));
            $record->set('cf_1021', trim($value['book_operator_finsec_doc_number']));
            $record->set('cf_1023', trim($value['book_operator_finsec_doc_validity']));
            $record->set('cf_1025', trim($value['book_operator_finsec_org_title']));
            $record->set('cf_1027', trim($value['book_operator_finsec_org_address']));
            $record->set('cf_1029', trim($value['book_operator_finsec_org_address_postal']));
            
            $record->set('assigned_user_id', 1);
            $record->save();
           
           
        }
    }
    function checkContact($id){
        global $adb;
        $sql = "SELECT * FROM vtiger_vendorcf WHERE cf_997=?";
        $result = $adb->pquery($sql, array($id));
        $num = $adb->num_rows($result);
        if ($num > 0) return $adb->query_result($result,0,'vendorid');
        return false;
                
    }
    function phoneCreat($value){
    $new_phone = $value;
    if (!empty($value)){
        $phone = str_replace(array('+','(',')',' '), array('','','',''), $value);
        if (strlen($phone) == 11){
            $phone = substr($phone, 1);
        }
        if (strlen($phone) == 10){
            $new_phone = '+7('.$phone{0}.$phone{1}.$phone{2}.') '.$phone{3}.$phone{4}.$phone{5}.'-'.$phone{6}.$phone{7}.$phone{8}.$phone{9};
        }
        else {
            $new_phone = $value;
        }
    }
    return $new_phone;
     
}
}