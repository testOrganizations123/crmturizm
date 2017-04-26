<?php

class Settings_ModuleCreator_Relations_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
                $tabid = getTabid(vtlib_purify($_REQUEST['modulename']));
                $focus = new Settings_ModuleCreator_Relations_Model();
                $relationslist = $focus->getRelationsByTabId($tabid);
                $viewer->assign('relationslist', $relationslist);

                $fieldslist = $focus->getRelatedFieldsByTabname(vtlib_purify($_REQUEST['modulename']));
                $viewer->assign('fieldslist', $fieldslist);

                $viewer->assign('modulename', vtlib_purify($_REQUEST['modulename']));

                global $adb;
                $mcMods = array();
                $mcModsRes = $adb->query("select * from vtiger_modulecreator_modules");
                while ($mcModRow = $adb->fetch_array($mcModsRes)) {
                	$mcMods[] = $mcModRow['custom_module_name'];
                }

                if (!in_array($_REQUEST['modulename'], $mcMods)) {
                	echo $viewer->view('ErrorMod.tpl', $qualifiedModuleName,true);
                	return null;
                }

		echo $viewer->view('Relations.tpl', $qualifiedModuleName,true);
	}
        
        
        
        
}
