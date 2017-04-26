<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class CostOffice_Save_Action extends Vtiger_Save_Action {
    function process(Vtiger_Request $request) {
        $office = $this->getValuesOffice($request->get('office'));
        $year = $request->get('year');
        $month = $request->get('month');
        $request->set('name', 'Расход '.$office.' за '.$month.' '. $year. ' г.');
        
        parent::process($request);
    }
     public function getValuesOffice($id) {
         $db = PearDatabase::getInstance();
         $sql = 'SELECT * FROM vtiger_office WHERE officeid = ?';
         $result = $db->pquery($sql, array($id));
        
         return $db->query_result($result,0,'office');
         
     }

}
