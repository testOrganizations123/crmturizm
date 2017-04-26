<?php

class Settings_ModuleCreator_EditField_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
                $focus = new Settings_ModuleCreator_Relations_Model();
                $moduleslist = $focus->getModulesList();
                $viewer->assign('moduleslist', $moduleslist);
                $blockslist = $focus->getBlocksByTabid(getTabid(vtlib_purify($_REQUEST['modulename'])));
                $viewer->assign('blockslist', $blockslist);
                $fielddata = $focus->getRelatedFieldById(vtlib_purify($_REQUEST['fieldid']));
                $viewer->assign('fieldid', vtlib_purify($_REQUEST['fieldid']));
                $viewer->assign('field_name', $fielddata['fieldname']);
                $viewer->assign('field_label', $fielddata['fieldlabel']);
                $viewer->assign('blockid', $fielddata['block']);
                $viewer->assign('relatedmodule', $fielddata['relmodule']);
                
                $viewer->assign('modulename', vtlib_purify($_REQUEST['modulename']));
		echo $viewer->view('EditField.tpl', $qualifiedModuleName,true);
	}
        
        
        
        
}
