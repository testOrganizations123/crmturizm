<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Contacts_QuickCreateAjax_View extends Vtiger_QuickCreateAjax_View {

	public function process(Vtiger_Request $request) {
            
		$viewer = $this->getViewer ($request);
		$moduleName = $request->getModule();
                $record = $request->get('record');
                if($record){
                    $recordModel = Vtiger_Record_Model::getInstanceById($record,$moduleName);
                    $viewer->assign('MODE', 'edit');
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

		foreach($requestFieldList as $fieldName=>$fieldValue){
			$fieldModel = $fieldList[$fieldName];
			$specialField = false;
			// We collate date and time part together in the EditView UI handling 
			// so a bit of special treatment is required if we come from QuickCreate 
			
			if($fieldModel->isEditable() || $specialField) {
				$recordModel->set($fieldName, $fieldModel->getDBInsertValue($fieldValue));
			}
		}
        
       
		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);

        // SalesPlatform.ru begin Field Validation Information
        $tabid = getTabid($moduleName);
        $validationData = getDBValidationData($recordModel->get('tab_name'),$tabid);
        $validationArray = split_validationdataArray($validationData);
        
        $viewer->assign("VALIDATION_DATA_FIELDNAME",$validationArray['fieldname']);
        $viewer->assign("VALIDATION_DATA_FIELDDATATYPE",$validationArray['datatype']);
        $viewer->assign("VALIDATION_DATA_FIELDLABEL",$validationArray['fieldlabel']);
        
        $viewer->assign('ID', $record);
        // SalesPlatform.ru end 
              
		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE',Zend_Json::encode($picklistDependencyDatasource));
		$viewer->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
		$viewer->assign('RECORD_STRUCTURE', $recordStructureInstance->getStructure());
                $viewer->assign('RECORD_MODEL', $recordModel);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('CURRENTDATE', date('Y-n-j'));
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());

		$isRelationOperation = $request->get('relationOperation');

		//if it is relation edit
		$viewer->assign('IS_RELATION_OPERATION', $isRelationOperation);
		if($isRelationOperation) {
			$viewer->assign('SOURCE_MODULE', $request->get('sourceModule'));
			$viewer->assign('SOURCE_RECORD', $request->get('sourceRecord'));
		}
		
		$viewer->assign('MAX_UPLOAD_LIMIT_MB', Vtiger_Util_Helper::getMaxUploadSize());
		$viewer->assign('MAX_UPLOAD_LIMIT', vglobal('upload_maxsize'));
        $viewer->assign('SCRIPTS', $this->getHeaderScripts($request));
        // SalesPlatform.ru begin enable/disable button Import
        $instance = Vtiger_Module::getInstance('SPSocialConnector'); 
        $fl_import_button = true;
        if(empty($record) || $instance->presence == 1){
            $fl_import_button = false;
        }
        $viewer->assign("FL_IMPORT_BUTTON", $fl_import_button);
        // SalesPlatform.ru end
        
		$viewer->view('EditViewQuick.tpl', $moduleName);
	}
		
	public function validateRequest(Vtiger_Request $request) { 
           
        } 
       
}