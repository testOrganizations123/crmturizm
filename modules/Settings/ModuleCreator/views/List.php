<?php

class Settings_ModuleCreator_List_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
                $currentTabs = $this->getTabs();
                $viewer->assign("parenttabs", $currentTabs);
                $version = $this->getVersion();
                $viewer->assign("moduleVersion", $version);
                $moduleslist = vtlib_getToggleModuleInfo();//Settings_ModuleManager_Module_Model::getAll();
                
                global $adb;
                $mcMods = array();
                $mcModsRes = $adb->query("select * from vtiger_modulecreator_modules");
                while ($mcModRow = $adb->fetch_array($mcModsRes)) {
                	$mcMods[] = $mcModRow['custom_module_name'];
                }

                if (count($mcMods)) foreach ($moduleslist as $key => $value) {
                	if (!in_array($key, $mcMods)) unset($moduleslist[$key]);
                } else {
                	$moduleslist = null;
                }

                $viewer->assign('moduleslist', $moduleslist);
                
		echo $viewer->view('Index.tpl', $qualifiedModuleName,true);
	}
        
        function getVersion() {
		global $adb, $currentModule;
		$result = $adb->pquery( "SELECT version FROM vtiger_tab WHERE name = ?", Array( $currentModule ), 1, true );
		return $adb->query_result( $result, 'version', 0 );
	}	
        
        public function getTabs(){
		global $adb;
$sql = "SELECT parent as 'parenttab_label' FROM vtiger_tab group by parent";
		$result = $adb->query($sql);
		$rows = array();
		while($row = $adb->fetch_array($result)){
			$rows[] = $row;
		}
		
		return $rows;
	}
}
