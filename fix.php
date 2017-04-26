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
$fix = new Fix();
$fix->proccess();
class Fix {
    function __construct() {
        
    }
    function proccess(){
        global $adb, $current_user;
        $current_user = Users::getActiveAdminUser();
         
        $moduleName = 'Potentials';
        $sql = "SELECT a.potentialid, a.sales_stage, c.cf_1217, c.cf_1234, c.cf_1258, c.cf_1250 FROM vtiger_potential as a LEFT JOIN vtiger_potentialscf as c ON c.potentialid = a.potentialid WHERE c.cf_1217 > '2016-09-01 23:59:59' and a.sales_stage = 'Closed Won'";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'potentialid');
            $b = $adb->query_result($result,$i,'cf_1258');
            $record = Vtiger_Record_Model::getInstanceById($crmid);
            $record->set('mode', 'edit');
            if ($b > 0){
                $record->set('sales_stage', 'Бронь подтверждена');
            }
            else {
                $record->set('sales_stage', 'Бронь оплачена');
            }
            $record->save();
        }
    }
}