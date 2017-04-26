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
//if(PHP_SAPI === "cli" || (isset($_SESSION["authenticated_user_id"]) &&	isset($_SESSION["app_unique_key"]) && $_SESSION["app_unique_key"] == $application_unique_key)){
    $fix = new Fix();
    $fix->proccess();
//}
// ---  создание базы данных 

class Fix {
    function __construct() {
        //die();
        
    }
    function proccess(){
        global $current_user;
        $current_user = Users::getActiveAdminUser();
        $this->changeStatus();
       $this->closeWonAfterDeparture();
       $this->trigerEventAfterArrival();
        //$this->stars();
        
    }
    function stars() {
         global $adb, $current_user;
        $current_user = Users::getActiveAdminUser();
        $moduleName = 'Potentials';
        $sql = "SELECT a.potentialid, a.cf_1193 FROM vtiger_potentialscf as a INNER JOIN vtiger_crmentity as c ON c.crmid = a.potentialid WHERE c.deleted = 0 and a.cf_1368 = 0";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
            $hot = $adb->query_result($result,$i,'cf_1193');
            echo $crmid;
            $sql = "UPDATE vtiger_potentialscf SET cf_1368 = ? WHERE potentialid = ?";
            $adb->pquery($sql, array($this->getStars($hot),$crmid));
            
            echo '- '.$i.' -[CRON], Modifi potettials UPDATE "%s",%s, [STARTS]'."<br />";
        }
        
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