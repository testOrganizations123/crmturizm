<?php

class Settings_ModuleCreator_Error_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
            
	    global $currentModule, $adb;
            
	    $viewer = $this->getViewer($request);
            $module_name = trim(vtlib_purify($_GET['module_name']));
            $viewer->assign('module_name', $module_name);
            $errormc = trim(vtlib_purify($_GET['errormc']));
            $viewer->assign('errormc', $errormc);
	    echo $viewer->view('Error.tpl', $request->getModule(false), true);
		
	}
        
       
}


