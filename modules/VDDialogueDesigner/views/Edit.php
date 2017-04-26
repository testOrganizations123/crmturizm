<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

Class VDDialogueDesigner_Edit_View extends Vtiger_Edit_View {
    public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer ($request);
                $record = $request->get('record');
                if (!empty($record)){
                    $moduleName = $request->getModule();
                    $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
                    $recordModel = Vtiger_Record_Model::getInstanceById($record, $moduleName);
                    $type_answer = $recordModel->get('type_answer');
                    
                    if ($type_answer == 'Module' || $type_answer == 'ModuleDefault' || $type_answer == 'Search' ){
                        $viewer->assign('MODULE_MODEL',$moduleModel);
                       
                        $viewer->assign('MODULELIST', $moduleModel->getSupportedModules());
                        $answer = Zend_Json::decode(htmlspecialchars_decode($recordModel->get('answer')));
                        $relatedModule = $answer['name'];
                        if (!empty($relatedModule)){
                        
                        $recordStructure = new VDDialogueDesigner_EditRecordStructure_Model();
                        $viewer->assign('RELATED_MODULE', $relatedModule);
                        $viewer->assign('MODULE_RECORD_STRUCTURE', $recordStructure->getStructurer($relatedModule));
                        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
                        $viewer->assign('CONDITION', $answer['field']);
                        }
                    }
                    else if ($type_answer == 'ModuleButtons'){
                        $viewer->assign('MODULE_MODEL',$moduleModel);
                        $viewer->assign('MODULELIST', $moduleModel->getSupportedModules());
                        $answer = Zend_Json::decode(htmlspecialchars_decode($recordModel->get('answer')));
                        $relatedModule = $answer['module']['module'];
                        if (!empty($relatedModule)){
                        //echo '<pre>';print_r($answer);echo '</pre>';die();
                        $recordStructure = new VDDialogueDesigner_EditRecordStructure_Model();
                        $viewer->assign('RELATED_MODULE', $relatedModule);
                        $viewer->assign('MODULE_RECORD_STRUCTURE', $recordStructure->getStructurer($relatedModule));
                        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
                        $viewer->assign('CONDITION', $answer['module']['field']);
                        }
                    }
                    
                    
                }
		
                parent::process($request);
    }
}