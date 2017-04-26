<?php

class Settings_ModuleCreator_CreateField_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
                $focus = new Settings_ModuleCreator_Relations_Model();
                $moduleslist = $focus->getModulesList();
                if (count($moduleslist))  foreach ($moduleslist as $key => $mod) {
                        if ($mod['isentitytype'] != 1) unset($moduleslist[$key]);
                }
                $viewer->assign('moduleslist', $moduleslist);
                $blockslist = $focus->getBlocksByTabid(getTabid(vtlib_purify($_REQUEST['modulename'])));
                $viewer->assign('blockslist', $blockslist);
                
                
                $viewer->assign('modulename', vtlib_purify($_REQUEST['modulename']));
		echo $viewer->view('CreateField.tpl', $qualifiedModuleName,true);
	}
        
        
        
        
}
