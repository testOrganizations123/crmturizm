<?php

class Settings_ModuleCreator_DeleteRelation_Action extends Settings_Vtiger_Index_Action {

	function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		if(!$currentUserPriviligesModel->hasModulePermission($moduleModel->getId())) {
			throw new AppException(vtranslate($moduleName).' '.vtranslate('LBL_NOT_ACCESSIBLE'));
		}
	}

	function process(Vtiger_Request $request) {
            
            $viewer = $this->getViewer($request);
            $qualifiedModuleName = $request->getModule(false);
            
            $focus = new Settings_ModuleCreator_Relations_Model();
            $viewer->assign('modulename', vtlib_purify($_REQUEST['modulename']));

            $module_name = $_REQUEST['modulename'];
            if ($_REQUEST['relationid']){
                $focus->deleteRelation(vtlib_purify($_REQUEST['relationid']));
                header("Location: index.php?module=ModuleCreator&parent=Settings&view=Relations&modulename=$module_name");
                exit;
            }
            
	}
        
        
        
        
}