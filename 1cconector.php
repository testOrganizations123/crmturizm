<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
header('Content-type: application/xml');

global $period;
include_once 'vtlib/Vtiger/Module.php';
require_once 'include/utils/utils.php';
require_once 'includes/Loader.php';
vimport ('includes.runtime.EntryPoint');
//if(PHP_SAPI === "cli" || (isset($_SESSION["authenticated_user_id"]) &&	isset($_SESSION["app_unique_key"]) && $_SESSION["app_unique_key"] == $application_unique_key)){
   $ui = new Conector();
   $array = $ui->proccess();
   $converter = new Array2XML();
   echo $converter->convert($array);
//}
// ---  создание базы данных 

class Conector {
    function __construct() {
        global $period;
        if ($_GET['user'] != 'vordoom'){
            exit();
        }
        if ($_GET['key'] != 'aFpvB7Y3avJtZ1WD'){
            exit();
        }
        $period = explode(",",$_GET['period']);
        if (count($period) ==2){
            $period[0] = date('Y-m-d 00:00:00', strtotime($period[0]));
            $period[1] = date('Y-m-d 23:59:59', strtotime($period[1]));
        }
        else {
            exit();
        }
        
    }
    function proccess(){
        $array = array('client'=>array(), 'vendor'=>array(), 'booking'=>array(), 'payment'=>array());
        $array['booking'] = $this->getPotentials();
        $array['payment'] = $this->getPayment();
        $array['client'] = $this->getClient();
        $array['vendor'] = $this->getVendor();
        
       return  $array;
        
    }
     function getPayment(){
         global $adb, $current_user, $period;
         $current_user = Users::getActiveAdminUser();
          $sql = "SELECT a.*, c.deleted, p.spcompany as company, of.office as office, pc.cf_1227 as booking_no FROM sp_payments as a INNER JOIN vtiger_crmentity as c ON c.crmid = a.payid LEFT JOIN vtiger_potential as p ON p.potentialid = a.related_to LEFT JOIN vtiger_potentialscf as pc ON pc.potentialid = a.related_to LEFT JOIN vtiger_office as of ON of.officeid = pc.cf_1215 WHERE a.pay_type = 'Receipt' and (c.modifiedtime BETWEEN '".$period[0]."' AND '".$period[1]."' or c.createdtime BETWEEN '".$period[0]."' AND '".$period[1]."')";
       // echo $sql; die;
          $result = $adb->pquery($sql, array());
       
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $raw[$i] = $adb->query_result_rowdata($result,$i);
        }
       $label_key = array(
           'payid'=>'payid',
           'pay_no'=>'pay_no',
           'pay_date'=>'pay_date',
           'pay_details'=>'pay_details',
           'pay_type'=>'pay_type', 
           'payer'=>'payer', 
           'type_payment'=>'type_payment',
           'booking_id'=>'related_to',
           'amount'=>'amount',
           'deleted'=>'deleted',
           'spcompany'=>'company',
           'office'=>'office',
           'booking_no'=>'booking_no'
           
           );
       $row = array();
      
       foreach ($raw as $key=>$poten){
           foreach ($label_key as $label=>$value){
              $row[$key][$label] = $poten[$value];
              if ($label == 'payer'){
                  $this->client[$poten[$value]] = $poten[$value];
              }
           }
       }
       return $row;
    }
    function getVendor(){
         global $adb, $current_user;
         $current_user = Users::getActiveAdminUser();
          $sql = "SELECT * FROM vtiger_vendor as a INNER JOIN vtiger_crmentity as c ON c.crmid = a.vendorid LEFT JOIN vtiger_vendorcf as cf ON cf.vendorid = a.vendorid WHERE a.vendorid IN (".implode("," ,$this->vendor).")";
       // echo $sql; die;
          $result = $adb->pquery($sql, array());
       
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $raw[$i] = $adb->query_result_rowdata($result,$i);
        }
       $label_key = array(
           'vendorid'=>'vendorid',
           'vendor_no'=>'vendor_no',
           'firstname'=>'firstname',
           'vendorname'=>'vendorname',
           'phone'=>'phone', 
           'street'=>'street', 
           'city'=>'city',
           'postalcode'=>'postalcode',
           
           'inn' => 'cf_1013',
           'ogrn' => 'cf_1015',
           'deleted'=>'deleted',
           
            
           
           
           );
       $row = array();
      
       foreach ($raw as $key=>$poten){
           foreach ($label_key as $label=>$value){
              $row[$key][$label] = $poten[$value];
              
           }
       }
       return $row;
    }
    function getClient(){
         global $adb, $current_user;
         $current_user = Users::getActiveAdminUser();
          $sql = "SELECT * FROM vtiger_contactdetails as a INNER JOIN vtiger_crmentity as c ON c.crmid = a.contactid LEFT JOIN vtiger_contactscf as cf ON cf.contactid = a.contactid LEFT JOIN vtiger_contactsubdetails as cu ON cu.contactsubscriptionid = a.contactid LEFT JOIN vtiger_contactaddress as ca ON ca.contactaddressid = a.contactid WHERE a.contactid IN (".implode("," ,$this->client).")";
        $result = $adb->pquery($sql, array());
       
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $raw[$i] = $adb->query_result_rowdata($result,$i);
        }
       $label_key = array(
           'contactid'=>'contactid',
           'contact_no'=>'contact_no',
           'firstname'=>'firstname',
           'lastname'=>'lastname',
           'midlename'=>'midlename', 
           'birthday'=>'birthday', 
           'pass_s'=>'cf_1336',
           'pass_no'=>'cf_1338',
           'pass_date'=>'cf_1340',
           'pass_fms'=>'cf_1342',
           'z_pass_s'=>'cf_1093',
           'z_pass_no'=>'cf_1095',
           'z_pass_date'=>'cf_1099',
           'z_pass_fms'=>'cf_1097',
           'z_pass_date_0ff'=>'cf_1101',
           'mobile' => 'mobile',
           'email' => 'email',
           'mailingcity' => 'mailingcity',
           'mailingstreet'=>'mailingstreet',
            'mailingcountry' => 'mailingcountry',
            'mailingzip' => 'mailingzip',
            'deleted'=>'deleted',
           
           
           );
       $row = array();
      
       foreach ($raw as $key=>$poten){
           foreach ($label_key as $label=>$value){
              $row[$key][$label] = $poten[$value];
              
           }
       }
        $sql = "SELECT * FROM vtiger_account as a INNER JOIN vtiger_crmentity as c ON c.crmid = a.accountid LEFT JOIN vtiger_accountscf as cf ON cf.accountid = a.accountid LEFT JOIN vtiger_accountbillads as cu ON cu.accountaddressid = a.accountid  WHERE a.accountid IN (".implode("," ,$this->client).")";
        $result = $adb->pquery($sql, array());
       
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $raw2[$i] = $adb->query_result_rowdata($result,$i);
        }
       $label_key = array(
           'accountid'=>'accountid',
           'account_no'=>'account_no',
           'accountname'=>'accountname',
           'phone'=>'phone',
           'inn'=>'inn', 
           'kpp'=>'kpp', 
           
           'bill_city' => 'bill_city',
           'bill_code'=>'bill_code',
            'bill_country' => 'bill_country',
            'bill_state' => 'bill_state',
            'bill_street' => 'bill_street',
            'deleted'=>'deleted',
           
           
           );
       $row2 = array();
      
       foreach ($raw2 as $key=>$poten){
           foreach ($label_key as $label=>$value){
              $row2[$key][$label] = $poten[$value];
              
           }
       }
        return array ('contacts'=>$row, 'account'=>$row2);
    }
    function getPotentials() {
         global $adb, $current_user, $period;
        $current_user = Users::getActiveAdminUser();
        
        $sql = "SELECT * FROM vtiger_potential as a INNER JOIN vtiger_crmentity as c ON c.crmid = a.potentialid LEFT JOIN vtiger_potentialscf as cf ON cf.potentialid = a.potentialid LEFT JOIN vtiger_office as of ON of.officeid = cf_1215 WHERE (c.modifiedtime BETWEEN '".$period[0]."' AND '".$period[1]."' or c.createdtime BETWEEN '".$period[0]."' AND '".$period[1]."')";
        $result = $adb->pquery($sql, array());
       
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $raw[$i] = $adb->query_result_rowdata($result,$i);
        }
       $label_key = array(
           'potentialid'=>'potentialid',
           'potentialname'=>'potentialname',
           'amount'=>'amount',
           'sales_stage'=>'sales_stage',
           'potentialtype'=>'potentialtype', 
           'spcompany'=>'spcompany', 
           'dogovor_id'=>'cf_1223',
           'dogovor_date'=>'cf_1225',
           'client_id'=>'contact_id',
           'vendor_id'=>'cf_1246',
           'deleted'=>'deleted',
           'office'=>'office',
           'pay_to'=>'cf_1256',
           'created'=>'createdtime',
           'modifiedtime'=>'modifiedtime',
           'discount'=>'cf_1121',
           'booking_no'=>'cf_1227',
           );
       $row = array();
       $this->client = array();
       $this->vendor = array();
       foreach ($raw as $key=>$poten){
           foreach ($label_key as $label=>$value){
              $row[$key][$label] = $poten[$value];
              if ($label == 'client_id'){
                  $this->client[$poten[$value]] = $poten[$value];
              }
              if ($label == 'vendor_id'){
                  $this->vendor[$poten[$value]] = $poten[$value];
              }
           }
       }
        return $row;
        
    }
    public function getStars($str){
            if(strpos($str, "5*") || strpos($str, "5 *") || strpos($str, "5+*") || strpos($str, "*****") || strpos($str, "5")){
                return 5;
            }
            elseif(strpos($str, "4*") || strpos($str, "4 *") || strpos($str, "4+*") || strpos($str, "****") || strpos($str, "4")){
                return 4;
            }
            elseif(strpos($str, "3*") || strpos($str, "3 *") || strpos($str, "3+*") || strpos($str, "***") || strpos($str, "3")){
                return 3;
            }
            elseif(strpos($str, "2*") || strpos($str, "2 *") || strpos($str, "2+*") || strpos($str, "**") || strpos($str, "2")){
                return 2;
            }
            elseif(strpos($str, "1*") || strpos($str, "1 *") || strpos($str, "1+*") || strpos($str, "*") || strpos($str, "1")){
                return 1;
            }
            else {
                return 0;
            }
        }
    function changeStatus(){
        global $adb, $current_user;
        $current_user = Users::getActiveAdminUser();
        $moduleName = 'Potentials';
         $sql = "SELECT a.potentialid FROM vtiger_potential as a LEFT JOIN vtiger_crmentity as crm ON crm.crmid = a.potentialid LEFT JOIN vtiger_potentialscf as c ON c.potentialid = a.potentialid WHERE crm.deleted = 0 and a.sales_stage != 'Closed Lost' and (c.cf_1238 = 1 or c.cf_1240=1)";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
           
            $record = Vtiger_Record_Model::getInstanceById($crmid);
            $record->set('mode', 'edit');
            $record->set('sales_stage', 'Closed Lost');
            
            $record->save();
            echo sprintf('[CRON], Modifi potettials UPDATE "%s",%s, [STARTS]',$record->getId(),$record->get('sales_stage'))."<br />";
        }
        $sql = "SELECT a.potentialid FROM vtiger_potential as a LEFT JOIN vtiger_crmentity as crm ON crm.crmid = a.potentialid LEFT JOIN vtiger_potentialscf as c ON c.potentialid = a.potentialid WHERE crm.deleted = 0 and a.sales_stage != 'Бронь оплачена' and a.sales_stage != 'Closed Won' and a.sales_stage != 'Closed Lost' and c.cf_1258 <= 0 and c.cf_1250 <= 0 and cf_1234 = 1";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
           
            $record = Vtiger_Record_Model::getInstanceById($crmid);
            $record->set('mode', 'edit');
            $record->set('sales_stage', 'Бронь оплачена');
            
            $record->save();
            echo sprintf('[CRON], Modifi potettials UPDATE "%s",%s, [STARTS]',$record->getId(),$record->get('sales_stage'))."<br />";
        }
        $sql = "SELECT a.potentialid FROM vtiger_potential as a LEFT JOIN vtiger_crmentity as crm ON crm.crmid = a.potentialid LEFT JOIN vtiger_potentialscf as c ON c.potentialid = a.potentialid WHERE crm.deleted = 0 and a.sales_stage != 'Бронь потверждена' and a.sales_stage != 'Бронь оплачена' and a.sales_stage != 'Closed Won' and a.sales_stage != 'Closed Lost' and cf_1234 = 1";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
           
            $record = Vtiger_Record_Model::getInstanceById($crmid);
            $record->set('mode', 'edit');
            $record->set('sales_stage', 'Бронь потверждена');
            
            $record->save();
            echo sprintf('[CRON], Modifi potettials UPDATE "%s",%s, [STARTS]',$record->getId(),$record->get('sales_stage'))."<br />";
        }
         $sql = "SELECT a.potentialid FROM vtiger_potential as a LEFT JOIN vtiger_crmentity as crm ON crm.crmid = a.potentialid LEFT JOIN vtiger_potentialscf as c ON c.potentialid = a.potentialid WHERE crm.deleted = 0 and a.sales_stage != 'Бронь потверждена' and a.sales_stage != 'Бронь оплачена' and a.sales_stage != 'Договор заключен' and a.sales_stage != 'Closed Won' and a.sales_stage != 'Closed Lost' and a.amount > 0 and a.amount > c.cf_1250 and cf_1234 = 0";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
           
            $record = Vtiger_Record_Model::getInstanceById($crmid);
            $record->set('mode', 'edit');
            $record->set('sales_stage', 'Договор заключен');
            
            $record->save();
            echo sprintf('[CRON], Modifi potettials UPDATE "%s",%s, [STARTS]',$record->getId(),$record->get('sales_stage'))."<br />";
        }
        
    }
    function closeWonAfterDeparture(){
        global $adb, $current_user;
        $current_user = Users::getActiveAdminUser();
        $moduleName = 'Potentials';
        $date = date('Y-m-d H:i:s', strtotime('-12 hours'));
        $sql = "SELECT a.potentialid FROM vtiger_potential as a LEFT JOIN vtiger_crmentity as crm ON crm.crmid = a.potentialid LEFT JOIN vtiger_potentialscf as c ON c.potentialid = a.potentialid WHERE crm.deleted = 0 and c.cf_1217 < ? and a.sales_stage != 'Closed Won' and a.sales_stage != 'Closed Lost' and c.cf_1258 <= 0 and c.cf_1250 <= 0";
        $result = $adb->pquery($sql, array($date));
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
           
            $record = Vtiger_Record_Model::getInstanceById($crmid);
            $record->set('mode', 'edit');
            $record->set('sales_stage', 'Closed Won');
            
            $record->save();
            echo sprintf('[CRON], Modifi potettials CLOSE "%s",%s, [STARTS]',$record->getId(),$record->get('sales_stage'))."<br />";
        }
    }
    function trigerEventAfterArrival(){
        global $adb, $current_user;
        $current_user = Users::getActiveAdminUser();
        $moduleName = 'Potentials';
        $date = date('Y-m-d');
        $sql = "SELECT a.potentialid FROM vtiger_potential as a LEFT JOIN vtiger_crmentity as crm ON crm.crmid = a.potentialid LEFT JOIN vtiger_potentialscf as c ON c.potentialid = a.potentialid WHERE crm.deleted = 0 and DATE_FORMAT(c.cf_1219,'%Y-%m-%d') < ? and c.cf_1219 is not NULL and a.sales_stage = 'Closed Won' and c.cf_1366 = 0";
        $result = $adb->pquery($sql, array($date));
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
           
            $record = Vtiger_Record_Model::getInstanceById($crmid);
            $record->set('mode', 'edit');
            $record->set('cf_1366', 1);
            
            $record->save();
            echo sprintf('[CRON], Modifi potettials ARRIVAL "%s",%s, [STARTS]',$record->getId(),$record->get('cf_1366'))."<br />";
        }
    }
}

class Array2XML {
     
    private $writer;
    private $version = '1.0';
    private $encoding = 'UTF-8';
    private $rootName = 'root';
     
 
    function __construct() {
        $this->writer = new XMLWriter();
    }
     
    public function convert($data) {
        $this->writer->openMemory();
        $this->writer->startDocument($this->version, $this->encoding);
        $this->writer->startElement($this->rootName);
        if (is_array($data)) {
            $this->getXML($data);
        }
        $this->writer->endElement();
        return $this->writer->outputMemory();
    }
    public function setVersion($version) {
        $this->version = $version;
    }
    public function setEncoding($encoding) {
        $this->encoding = $encoding;
    }
    public function setRootName($rootName) {
        $this->rootName = $rootName;
    }
    private function getXML($data) {
        foreach ($data as $key => $val) {
            if (is_numeric($key)) {
                $key = 'key'.$key;
            }
            if (is_array($val)) {
                $this->writer->startElement($key);
                $this->getXML($val);
                $this->writer->endElement();
            }
            else {
                $this->writer->writeElement($key, $val);
            }
        }
    }
}