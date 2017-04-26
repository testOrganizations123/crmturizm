<?php

class Settings_ModuleCreator_CreateRelationSuccess_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
                
                
                $viewer->assign('modulename', vtlib_purify($_REQUEST['module_name']));
		echo $viewer->view('CreateRelationSuccess.tpl', $qualifiedModuleName,true);
	}
        
        
        
        
}
