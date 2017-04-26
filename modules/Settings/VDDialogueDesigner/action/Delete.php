<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Settings_VDDialogueDesigner_Delete_Action extends Vtiger_Delete_Action {

	function checkPermission(Vtiger_Request $request) {
		
	}

	public function process(Vtiger_Request $request) {
	global $adb;
                   
            $moduleName = $request->getModule();
            $ajaxDelete = $request->get('ajaxDelete');
		$recordId = $request->get('record');
	    $adb->pquery('DELETE FROM vd_dialogue_script WHERE id=?', array($recordId));
            

		$listViewUrl = 'index.php?module=VDDialogueDesigner&view=List&parent=Settings';
		if($ajaxDelete) {
			$response = new Vtiger_Response();
			$response->setResult($listViewUrl);
			return $response;
		} else {
			header("Location: $listViewUrl");
		}
	}
        public function validateRequest(Vtiger_Request $request) { 
            return true;
        } 
       
}
