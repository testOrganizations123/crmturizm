<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class SPPayments_QuickCreateAjax_View extends Vtiger_IndexAjax_View  {

	public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		
	}

	public function process(Vtiger_Request $request) {
            global $adb;
                $viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
                $record = $request->get('record');
                if($record){
                    $recordModel = Vtiger_Record_Model::getInstanceById($record,$moduleName);
                    $viewer->assign('MODE', 'edit');
                    $viewer->assign('ID', $record);
                    $office = $recordModel->get('office');
                    if (empty($office)){
                        $relatedid = $recordModel->get('related_to');
                        $sql = "SELECT cf_1215 FROM vtiger_potentialscf WHERE potentialid = ?";
                        $result = $adb->pquery($sql, array($relatedid));
                        $office = $adb->query_result($result,0,'cf_1215');
                        $recordModel->set('office', $office);
                    }
                    $viewer->assign('office', $office);
                }      
                else {
                    $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
                    $viewer->assign('MODE', '');
                }
        if(!$this->record){
            $this->record = $recordModel;
        }
		
		$moduleModel = $recordModel->getModule();
		
		$fieldList = $moduleModel->getFields();
		$requestFieldList = array_intersect_key($request->getAll(), $fieldList);

		foreach($requestFieldList as $fieldName => $fieldValue){
			$fieldModel = $fieldList[$fieldName];
			if($fieldModel->isEditable()) {
				$recordModel->set($fieldName, $fieldModel->getDBInsertValue($fieldValue));
			}
		}

		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_QUICKCREATE);
		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);

		
		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE',Zend_Json::encode($picklistDependencyDatasource));
		$viewer->assign('CURRENTDATE', date('Y-n-j'));
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('SINGLE_MODULE', 'SINGLE_'.$moduleName);
		$viewer->assign('MODULE_MODEL', $moduleModel);
		$viewer->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
		$viewer->assign('RECORD_STRUCTURE', $recordStructureInstance->getStructure());
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->view('QuickCreate.tpl',$moduleName);

	}
	
        
        public function validateRequest(Vtiger_Request $request) { 
            
        } 
}