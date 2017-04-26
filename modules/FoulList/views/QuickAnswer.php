<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class FoulList_QuickAnswer_View extends Vtiger_QuickCreateAjax_View {

	public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		
	}
        public function getFoulList($target){
            global $adb,$current_user;
            $sql = "SELECT crm.crmid FROM vtiger_foullist as f INNER JOIN vtiger_crmentity as crm ON crm.crmid = f.foullistid WHERE crm.deleted = 0 and f.checks != 'Да' and f.target = ? and f.notif = ? ";
            $result = $adb->pquery($sql,array($target,$current_user->id));
            $numRows = $adb->num_rows($result);
            $foulList = array();
            if ($numRows > 0) {
                for ($i = 0; $i < $numRows; $i++) {
                    $foulList[$i] = Vtiger_Record_Model::getInstanceById($adb->query_result($result, $i, 'crmid'));
                }
            } else {
                $sql = "SELECT crm.crmid FROM vtiger_foullist as f INNER JOIN vtiger_crmentity as crm ON crm.crmid = f.foullistid WHERE crm.deleted = 0 and f.checks != 'Да' and f.target = ? order by crm.crmid";
                $result = $adb->pquery($sql,array($target));
                $numRows = $adb->num_rows($result);
                $foulList = array();
                for ($i=0;$i<$numRows;$i++){
                    $foulList[$i] = Vtiger_Record_Model::getInstanceById($adb->query_result($result,$i,'crmid'));
                }
            }
            return $foulList[0];
        }
	public function process(Vtiger_Request $request) {
		$moduleName = $request->getModule();
                $target = $request->get('target');
                $recordModel = $this->getFoulList($target);

		
		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_QUICKCREATE);
		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);
		$recordModel->set('message', Zend_Json::decode(htmlspecialchars_decode($recordModel->get('message'))));
		$viewer = $this->getViewer($request);


        $pikListOwner = $recordModel->getPickListOwner($recordModel->get('users'));
		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE',Zend_Json::encode($picklistDependencyDatasource));
		$viewer->assign('CURRENTDATE', date('Y-n-j'));
		$viewer->assign('MODULE', $moduleName);
        $viewer->assign('RECORD_MODEL', $recordModel);
		$viewer->assign('SINGLE_MODULE', 'SINGLE_'.$moduleName);
		$viewer->assign('MODULE_MODEL', $moduleModel);
		$viewer->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
		$viewer->assign('RECORD_STRUCTURE', $recordStructureInstance->getStructure());
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('PIKLIST_NOTIF', $pikListOwner);
		 $viewer->assign('RECORD_ID', $recordModel->getId());
		$viewer->assign('SCRIPTS', $this->getHeaderScripts($request));
        
        $viewer->assign('MAX_UPLOAD_LIMIT_MB', Vtiger_Util_Helper::getMaxUploadSize());
		$viewer->assign('MAX_UPLOAD_LIMIT', vglobal('upload_maxsize'));
		echo $viewer->view('QuickAnswer.tpl',$moduleName,true);

	}
	
}