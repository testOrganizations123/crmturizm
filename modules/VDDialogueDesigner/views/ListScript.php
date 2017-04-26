<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
ini_set('display_errors',1);
error_reporting(E_ERROR);
class VDDialogueDesigner_ListScript_View extends Vtiger_List_View {
    public function preProcess(Vtiger_Request $request) {
            parent::preProcess($request, false);
            $moduleName = $request->getModule();
            $viewer = $this->getViewer ($request);
            
            $viewer->view('ListScriptPreProcess.tpl', $moduleName);
    }    
    public function process(Vtiger_Request $request) {
             $moduleName = $request->getModule();
             $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
             $viewer = $this->getViewer ($request);
             $viewer->assign('MODULE',$moduleName);
             $viewer->assign('MODULE_MODEL',$moduleModel);
             $viewer->view('ListScript.tpl',$moduleName);
    }
}