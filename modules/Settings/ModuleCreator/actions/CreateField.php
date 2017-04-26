<?php

class Settings_ModuleCreator_CreateField_Action extends Settings_Vtiger_Index_Action {

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
            
            if (!ctype_alnum($_REQUEST['field_name'])){
                header("Location: index.php?module=ModuleCreator&parent=Settings&view=RelationsError&module_name=$module_name&errormc=ERR_NOT_ALNUM");
                exit;
            }
            else {
            
                if ($_REQUEST['field_label']){
                    $focus->createRelatedField(vtlib_purify($_REQUEST['modulename']),vtlib_purify($_REQUEST['relatedmodule']),vtlib_purify($_REQUEST['field_label']),vtlib_purify($_REQUEST['field_name']),vtlib_purify($_REQUEST['blockid']),trim(vtlib_purify($_REQUEST['relatedlistlabel'])));
                    header("Location: index.php?module=ModuleCreator&parent=Settings&view=CreateFieldSuccess&module_name=$module_name");
                    exit;
                }
            }
	}
        
        
        
        
}