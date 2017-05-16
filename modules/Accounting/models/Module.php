<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Accounting_Module_Model extends Vtiger_Module_Model {
    public function getPicklistValuesOffice() {
         $db = PearDatabase::getInstance();
         $sql = 'SELECT a.* FROM vtiger_office as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.officeid WHERE c.deleted = 0 ORDER BY a.office';
         $result = $db->pquery($sql, array());
         $numRows = $db->num_rows($result);
         for ($i=0;$i<$numRows;$i++){
             $pikList[$db->query_result($result,$i,'officeid')] = $db->query_result($result,$i,'office');
         }
         
         return $pikList;
     }
}