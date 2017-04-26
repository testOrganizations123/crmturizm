<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * Vtiger Record Structure Model
 */
class Contacts_EditRecordStructure_Model extends Vtiger_EditRecordStructure_Model {

	
        function getTypeTurist(){
            global $adb;
            $pikList = array();
            $result = $adb->pquery('SELECT a.* FROM vtiger_typetourisvisa as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.typetourisvisaid WHERE c.deleted = 0', array());
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'typetourisvisaid')] = $adb->query_result($result,$i,'type_name');
            }
            return $pikList;
              
        }
        
        
        
}