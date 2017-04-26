<?php

include_once 'modules/Vtiger/CRMEntity.php';

class ModuleCreator {
	
	
	
	function vtlib_handler($modulename, $event_type) {
		global $adb;
		if($event_type == 'module.postinstall') {
			//include_once 'vtlib/Vtiger/Module.php';
			
			//file_put_contents('logs/testtt.txt', "ssss");

$Vtiger_Utils_Log = true;

$MODULENAME = 'ModuleCreator';

$moduleInstance = Vtiger_Module::getInstance($MODULENAME);
$moduleInstance->label= 'Module Creator';
	//$myExtensionModule->parent='Tools';
	$moduleInstance->save();
//$adb = PearDatabase::getInstance();
	    $maxId = $adb->getUniqueID('vtiger_settings_field');
        $adb->pquery("INSERT INTO `vtiger_settings_field` (`fieldid`, `blockid`, `name`, `iconpath`, `description`, `linkto`, `sequence`, `active`, `pinned`)
        VALUES ($maxId, 2, 'Module Creator', '', 'MODULE_CREATOR_DESCRIPTION', 'index.php?module=ModuleCreator&parent=Settings&view=List', NULL, 0, 0)");
        
        //$adb->query("UPDATE `vtiger_tab` SET `version` = '3.0.0' WHERE `name` = '$MODULENAME'");


		} else if($event_type == 'module.disabled') {
		// TODO Handle actions when this module is disabled.
		} else if($event_type == 'module.enabled') {
		// TODO Handle actions when this module is enabled.
		} else if($event_type == 'module.preuninstall') {
			
		} else if($event_type == 'module.preupdate') {
		// TODO Handle actions before this module is updated.
		} else if($event_type == 'module.postupdate') {
		// TODO Handle actions after this module is updated.
		}
	}
}
?>
