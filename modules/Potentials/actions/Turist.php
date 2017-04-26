<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class Potentials_Turist_Action extends Vtiger_Action_Controller{
    public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$record = $request->get('record');

		if(!Users_Privileges_Model::isPermitted($moduleName, 'Save', $record)) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
	}
    public function process(Vtiger_Request $request) {
        global $adb;
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $records = implode(',', $request->get('data'));
        $sql = "SELECT a.*, b.*, g.birthday, d.* FROM vtiger_contactdetails as a "
                . "LEFT JOIN vtiger_contactaddress as b ON b.contactaddressid=a.contactid "
                . "LEFT JOIN vtiger_contactsubdetails as g ON g.contactsubscriptionid = a.contactid "
                . "LEFT JOIN vtiger_contactscf as d ON d.contactid = a.contactid "
                . "WHERE a.contactid IN ($records)";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        $list = array();
        
        for($i=0;$i<$numRows;$i++){
            $list[$adb->query_result($result,$i,'contactid')] = $adb->query_result_rowdata($result,$i);
        }
        $mod = $request->get('mod');
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('LIST_CONTACT', $list);
        $view->assign('MOD', $mod);
        $view->view('Turist.tpl', 'Potentials');
    }
}