<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
ini_set('display_errors',1);
error_reporting(E_ERROR);
class Potentials_Resort_Action extends Vtiger_Action_Controller{
    public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$record = $request->get('record');

		if(!Users_Privileges_Model::isPermitted($moduleName, 'Save', $record)) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
	}
    public function process(Vtiger_Request $request) {
        global $adb;
        $country = $request->get('country');
        $sql = "SELECT a.* FROM vtiger_listresorts as a "
                . "LEFT JOIN vtiger_crmentity as b ON b.crmid=a.listresortsid "
                . "WHERE b.deleted = 0 and a.country = ?";
        $result = $adb->pquery($sql, array($country));
        $numRows = $adb->num_rows($result);
        $list = array();
        
        for($i=0;$i<$numRows;$i++){
            $list[$adb->query_result($result,$i,'listresortsid')] = $adb->query_result($result,$i,'resort');
        }
        $response = new Vtiger_Response();
        $response->setResult($list);
        $response->emit();
    }
}