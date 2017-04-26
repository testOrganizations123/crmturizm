<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class VDCustomReports extends Vtiger_Index_View {
    function __construct() {
		parent::__construct();
		$this->exposeMethod('leadsreport');
	}
    function checkPermission(Vtiger_Request $request) {
		
		return true;
	}
    function preProcess(Vtiger_Request $request, $display=true) {
		parent::preProcess($request, false);

		
		$moduleName = $request->getModule();
                
		$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
		$recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_DETAIL);
		$summaryInfo = array();
		// Take first block information as summary information
		$stucturedValues = $recordStrucure->getStructure();
		foreach($stucturedValues as $blockLabel=>$fieldList) {
			$summaryInfo[$blockLabel] = $fieldList;
			break;
		}

		$detailViewLinkParams = array('MODULE'=>$moduleName,'RECORD'=>$recordId);

		$detailViewLinks = $this->record->getDetailViewLinks($detailViewLinkParams);
		

		$viewer = $this->getViewer($request);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('NAVIGATION', $navigationInfo);

		//Intially make the prev and next records as null
		
		$found = false;
		

		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		

		$viewer->assign('MODULE_MODEL', $this->record->getModule());
		$viewer->assign('DETAILVIEW_LINKS', $detailViewLinks);


		$linkParams = array('MODULE'=>$moduleName, 'ACTION'=>$request->get('view'));
		$linkModels = $this->record->getSideBarLinks($linkParams);
		$viewer->assign('QUICK_LINKS', $linkModels);
        $viewer->assign('MODULE_NAME', $moduleName);

		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$viewer->assign('DEFAULT_RECORD_VIEW', $currentUserModel->get('default_record_view'));

                $picklistDependencyDatasource=  Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName); 
                $viewer->assign('PICKLIST_DEPENDENCY_DATASOURCE',Zend_Json::encode($picklistDependencyDatasource));
		if($display) {
			$this->preProcessDisplay($request);
		}
	}

	function preProcessTplName(Vtiger_Request $request) {
		return 'DetailViewPreProcess.tpl';
	}
        function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode)) {
			echo $this->invokeExposedMethod($mode, $request);
			return;
		}

	}
        function leadsreport(Vtiger_Request $request){
            global $adb;
            //$sql = 
        }
        
}