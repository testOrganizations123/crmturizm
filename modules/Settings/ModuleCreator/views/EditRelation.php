<?php



class Settings_ModuleCreator_EditRelation_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
                $focus = new Settings_ModuleCreator_Relations_Model();
                
                $relation = $focus->getRelationById(vtlib_purify($_REQUEST['relationid']));
                $relatedmodule = $focus->getTabById($relation['related_tabid']);
                $relatedmodule = $relatedmodule['name'];

                $viewer->assign('relationid', $relation['relation_id']);
                $viewer->assign('relationfunction', $relation['name']);
                $viewer->assign('relatedmodule', $relatedmodule);
                $viewer->assign('relation_label', $relation['label']);
                
                $moduleslist = vtlib_getToggleModuleInfo();
                if (count($moduleslist))  foreach ($moduleslist as $key => $mod) {
                        if ($mod['isentitytype'] != 1) unset($moduleslist[$key]);
                }
                $viewer->assign('moduleslist', $moduleslist);
                $modulename = vtlib_purify($_REQUEST['modulename']);
                $otherlist = array();
                
                $viewer->assign('otherlist', $otherlist);
                
                
                $viewer->assign('modulename', vtlib_purify($_REQUEST['modulename']));
		echo $viewer->view('EditRelation.tpl', $qualifiedModuleName,true);
	}
        
        
        
        
}
