<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class VDDialogueDesigner_Save_Action extends Vtiger_Save_Action {

	public function process(Vtiger_Request $request) {
                $moduleName = $request->getModule();
		$recordId = $request->get('record');
                $mode = $request->get('mode');
                if ($mode == 'Script'){
                    if(!empty($recordId)) {
                        $recordModel = new VDDialogueDesigner_Script_Model($request,$recordId);
                    }
                    else {
                        $recordModel = new VDDialogueDesigner_Script_Model($request, false);
                        
                    }
                }
                else {
                    $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
                
                    if(!empty($recordId)) {
			$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
			$modelData = $recordModel->getData();
			$recordModel->set('id', $recordId);
			$recordModel->set('mode', 'edit');
                    } else {
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$modelData = $recordModel->getData();
			$recordModel->set('mode', '');
                    }
                    
                    $fieldModelList = $moduleModel->getFields();
                        foreach ($fieldModelList as $fieldName => $fieldModel) {
                            if ($fieldName == 'answer'){
                                $fieldValue = $this->gerAnswerField($request);
                            }
                            else {
                                $fieldValue = $request->get($fieldName, null);
                            }
                            $fieldDataType = $fieldModel->getFieldDataType();
                            if($fieldDataType == 'time'){
				$fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
                            }
                            if($fieldValue !== null) {
				if(!is_array($fieldValue)) {
					$fieldValue = trim($fieldValue);
				}
				$recordModel->set($fieldName, $fieldValue);
                            }
                        }
                }
                   
		$recordModel->save();
		$loadUrl = $recordModel->getModule()->getListViewUrl();
		header("Location: $loadUrl");
	}
        public function gerAnswerField($request) {
            $typeAnswer = $request->get('type_answer');
            switch($typeAnswer){
                case 'String': return $this->getAnswerStrintg($request); break;
                case 'Long String': return $this->getAnswerStrintg($request); break;
                case 'Buttons': return $this->getAnswerButtons($request); break;
                case 'ModuleButtons': return $this->getAnswerModuleButtons($request); break;
                case 'Module': 
                case 'ModuleDefault': 
                case 'Search': 
                    return $this->getAnswerModule($request); break;
            }
            
        }
        public function getAnswerStrintg($request){
            $field = array();
            $field['name'] = $request->get('type_answer_string_name');
            $field['step'] = $request->get('type_answer_string_step');
            return Zend_Json::encode($field);
        }
        public function getAnswerModule($request){
            $field = array();
            $field['name'] = $request->get('type_answer_module_name');
            $field['step'] = $request->get('type_answer_module_step');
            $fields = $request->get('type_answer_module_field');
            $comment = $request->get('type_answer_module_comment');
            $i = 1;
            foreach ($fields as $key=>$value){
                $field['field'][$i]['field'] = $value;
                $field['field'][$i]['comment'] = $comment[$key];
                $i++;
            }
            
            return Zend_Json::encode($field);
        }
        function getAnswerModuleButtons($request){
            $field = array('module'=>array(), 'buttons'=>array());
            
            $field['module']['module'] = $request->get('type_answer_module_name');
            
            $fields = $request->get('type_answer_module_field');
            $comment['module'] = $request->get('type_answer_module_comment');
            $i = 1;
            foreach ($fields as $key=>$value){
                $field['module']['field'][$i]['field'] = $value;
                $field['module']['field'][$i]['comment'] = $comment[$key];
                $i++;
            }
            $label = $request->get('type_answer_buttons_label');
            $color = $request->get('type_answer_buttons_color');
            $stepExit = $request->get('type_answer_buttons_stepExit');
            foreach ($label as $key => $value){
                $field['buttons'][$key]['label'] = $value;
                $field['buttons'][$key]['step'] = $request->get('type_answer_buttons_step_'.$key);
                $field['buttons'][$key]['color'] = $color[$key];
                $field['buttons'][$key]['stepExit'] = $stepExit[$key];
               
                
            }
            return Zend_Json::encode($field);
        }
        public function getAnswerButtons($request){
            $field = array();
            
            $label = $request->get('type_answer_buttons_label');
            
            $color = $request->get('type_answer_buttons_color');
            $stepExit = $request->get('type_answer_buttons_stepExit');
            foreach ($label as $key => $value){
                $field[$key]['label'] = $value;
                $field[$key]['step'] = $request->get('type_answer_buttons_step_'.$key);
                $field[$key]['color'] = $color[$key];
                $field[$key]['stepExit'] = $stepExit[$key];
               
                
            }
            return Zend_Json::encode($field);
        }
	public function validateRequest(Vtiger_Request $request) { 
            
        } 
}
