<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
ini_set('display_errors',1);

Class Settings_VDDialogueDesigner_Edit_View extends Settings_Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer ($request);
		$moduleName = $request->getModule();
		
		$record = $request->get('record');
		
		

		if(!empty($record)) {
			$recordModel = new VDDialogueDesigner_Script_Model($request,$record);
			
		} else {
			$recordModel = new VDDialogueDesigner_Script_Model($request);
			
		}
		
		$viewer->assign('RECORD_MODEL', $recordModel);
		$viewer->assign('RECORD_ID', $record);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
               
		$viewer->view('EditScript.tpl', $moduleName);
	}


}