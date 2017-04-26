<?php

class Settings_ModuleCreator_Success_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
            
	    global $currentModule, $adb;
            
	    $viewer = $this->getViewer($request);
            $module_name = trim(vtlib_purify($_GET['module_name']));
            $viewer->assign('module_name', $module_name);


            $moduleslist = vtlib_getToggleModuleInfo();//Settings_ModuleManager_Module_Model::getAll();
                
                global $adb;
                $mcMods = array();
                $mcModsRes = $adb->query("select * from vtiger_modulecreator_modules");
                while ($mcModRow = $adb->fetch_array($mcModsRes)) {
                	$mcMods[] = $mcModRow['custom_module_name'];
                }

                if (count($mcMods)) foreach ($moduleslist as $key => $value) {
                	if (!in_array($key, $mcMods)) unset($moduleslist[$key]);
                }

                $viewer->assign('moduleslist', $moduleslist);




	    echo $viewer->view('Success.tpl', $request->getModule(false), true);
		
	}
        
       
}


