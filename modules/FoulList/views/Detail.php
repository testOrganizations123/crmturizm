<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class FoulList_Detail_View extends Vtiger_Detail_View {
	protected $record = false;




	function process(Vtiger_Request $request) {
        $recordId = $request->get('record');
        $moduleName = $request->getModule();

        if(!$this->record){
            $this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
        }
        $recordModel = $this->record->getRecord();
        $message = Zend_Json::decode(htmlspecialchars_decode($recordModel->get('message')));
        $messageDisplay = "";
        foreach ($message as $value){
            $messageDisplay .= $value['name'].": ".$value['message']."<br/>";
        }
        $recordModel->set('message', $messageDisplay);

        $recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_DETAIL);
        $structuredValues = $recordStrucure->getStructure();

        $moduleModel = $recordModel->getModule();

        $viewer = $this->getViewer($request);
        $viewer->assign('RECORD', $recordModel);
        $viewer->assign('RECORD_STRUCTURE', $structuredValues);
        $viewer->assign('BLOCK_LIST', $moduleModel->getBlocks());
        $viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('MODULE_NAME', $moduleName);
        $viewer->assign('IS_AJAX_ENABLED', false);

        echo $viewer->view('DetailViewBlockView.tpl',$moduleName,true);
	}





}
