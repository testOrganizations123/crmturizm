<?php

class Settings_ModuleCreator_CreateRelation_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
                
                $moduleslist = vtlib_getToggleModuleInfo();
                if (count($moduleslist))  foreach ($moduleslist as $key => $mod) {
                        if ($mod['isentitytype'] != 1) unset($moduleslist[$key]);
                }
                
                $viewer->assign('moduleslist', $moduleslist);
                $modulename = vtlib_purify($_REQUEST['modulename']);
        
               
                
                $viewer->assign('modulename', vtlib_purify($_REQUEST['modulename']));
		echo $viewer->view('CreateRelation.tpl', $qualifiedModuleName,true);
	}
        
        
        
        
}
