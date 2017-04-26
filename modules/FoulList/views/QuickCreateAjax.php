<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
ini_set('display_errors', 0);

class FoulList_QuickCreateAjax_View extends Vtiger_QuickCreateAjax_View {

	public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();


	}

	public function process(Vtiger_Request $request) {
		$moduleName = $request->getModule();
                $target = $request->get('target');
                $user = $request->get('users');
                $request->set('date_foul', date('d.m.Y'));
                $request->set('data_check', date('d.m.Y', strtotime('+3 days')));
                if(!empty($target)){
                    $targetModel = Vtiger_Record_Model::getInstanceById($target);
                    $request->set('users', $targetModel->get('assigned_user_id'));
                    if (empty($user)){
                        $user = $targetModel->get('assigned_user_id');
                    }
                }
                
		$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
		$moduleModel = $recordModel->getModule();
		
		$fieldList = $moduleModel->getFields();
               
		$requestFieldList = array_intersect_key($request->getAll(), $fieldList);
		$array = [];
		foreach($requestFieldList as $fieldName => $fieldValue){
			$fieldModel = $fieldList[$fieldName];
                        

				$recordModel->set($fieldName, $fieldModel->getDBInsertValue($fieldValue));
            $array[$fieldName] = $fieldValue;
		}

                if(!empty($target)){
                    $targetModel = Vtiger_Record_Model::getInstanceById($target);
                    $request->set('user', $targetModel->get('assigned_user_id'));
                }
		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_QUICKCREATE);
		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);
        $pikListOwner = $recordModel->getPickListOwner($user);



		$viewer = $this->getViewer($request);
		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE',Zend_Json::encode($picklistDependencyDatasource));
		$viewer->assign('CURRENTDATE', date('Y-n-j'));
		$viewer->assign('MODULE', $moduleName);
        $viewer->assign('ARRAY_DATA', $array);
		$viewer->assign('SINGLE_MODULE', 'SINGLE_'.$moduleName);
		$viewer->assign('MODULE_MODEL', $moduleModel);
		$viewer->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
		$viewer->assign('RECORD_STRUCTURE', $recordStructureInstance->getStructure());
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('PIKLIST_NOTIF', $pikListOwner);
		
		$viewer->assign('SCRIPTS', $this->getHeaderScripts($request));
        
        $viewer->assign('MAX_UPLOAD_LIMIT_MB', Vtiger_Util_Helper::getMaxUploadSize());
		$viewer->assign('MAX_UPLOAD_LIMIT', vglobal('upload_maxsize'));
		echo $viewer->view('QuickCreate.tpl',$moduleName,true);

	}
	
}