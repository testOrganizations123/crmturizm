<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: Vordoom.net
 * The Initial Developer of the Original Code is Vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class VDDialogueDesigner_Module_Model extends Vtiger_Module_Model {
        public $inputs;
        
        public function getViewDisplayValueStep($value){
            return $value;
        }
        /**
     * Get supported modules
     *
     * @return array
     */
	public function getSupportedModules() {
            $this->initListOfModules();
           
        foreach($this->module_list as $key=>$value) {
            if(isPermitted($key,'index') == "yes") {
                $modules [$key] = vtranslate($key, $key);
            }
        }
        asort($modules);
		return $modules;
	}
	 public function initListOfModules() {
		global $adb, $current_user, $old_related_modules;

		$restricted_modules = array('Events','Webmails');
		$restricted_blocks = array('LBL_COMMENTS','LBL_COMMENT_INFORMATION');

		$this->module_id = array();
		$this->module_list = array();

		// Prefetch module info to check active or not and also get list of tabs
		$modulerows = vtlib_prefetchModuleActiveInfo(false);

		$cachedInfo = VTCacheUtils::lookupReport_ListofModuleInfos();

		if($cachedInfo !== false) {
			$this->module_list = $cachedInfo['module_list'];
			$this->related_modules = $cachedInfo['related_modules'];

		} else {

			if($modulerows) {
				foreach($modulerows as $resultrow) {
					if($resultrow['presence'] == '1') continue;      // skip disabled modules
					if($resultrow['isentitytype'] != '1') continue;  // skip extension modules
					if(in_array($resultrow['name'], $restricted_modules)) { // skip restricted modules
						continue;
					}
					if($resultrow['name']!='Calendar'){
						$this->module_id[$resultrow['tabid']] = $resultrow['name'];
					} else {
						$this->module_id[9] = $resultrow['name'];
						$this->module_id[16] = $resultrow['name'];

					}
					$this->module_list[$resultrow['name']] = array();
				}

				$moduleids = array_keys($this->module_id);
				$reportblocks =
					$adb->pquery("SELECT blockid, blocklabel, tabid FROM vtiger_blocks WHERE tabid IN (" .generateQuestionMarks($moduleids) .")",
						array($moduleids));
				$prev_block_label = '';
				if($adb->num_rows($reportblocks)) {
					while($resultrow = $adb->fetch_array($reportblocks)) {
						$blockid = $resultrow['blockid'];
						$blocklabel = $resultrow['blocklabel'];
						$module = $this->module_id[$resultrow['tabid']];

						if(in_array($blocklabel, $restricted_blocks) ||
							in_array($blockid, $this->module_list[$module]) ||
							isset($this->module_list[$module][getTranslatedString($blocklabel,$module)])
						) {
							continue;
						}

						if(!empty($blocklabel)){
							if($module == 'Calendar' && $blocklabel == 'LBL_CUSTOM_INFORMATION')
								$this->module_list[$module][$blockid] = getTranslatedString($blocklabel,$module);
							else
								$this->module_list[$module][$blockid] = getTranslatedString($blocklabel,$module);
							$prev_block_label = $blocklabel;
						} else {
							$this->module_list[$module][$blockid] = getTranslatedString($prev_block_label,$module);
						}
					}
				}

				
				// Put the information in cache for re-use
				VTCacheUtils::updateReport_ListofModuleInfos($this->module_list);
			}
		}
	}
        public function getListScript(){
            global $adb;
            $listScript = array();
            $result = $adb->pquery('SELECT a.*, b.dialoguedesignerid FROM vd_dialogue_script as a LEFT JOIN vd_dialoguedesigner as b ON b.category = a.id LEFT JOIN vtiger_crmentity as c on c.crmid=b.dialoguedesignerid WHERE c.deleted = 0 and a.menu_active = 1 and b.step = 1', array());
            $numRows = $adb->num_rows($result);
            for ($i=0;$i<$numRows;$i++){
                $listScript[$i] = $adb->query_result_rowdata($result, $i);
                $listScript[$i]['link'] = $this->getScriptStep($listScript[$i]['dialoguedesignerid']);
            }
           
            return $listScript;
        }
        public function getScriptStep($id){
            return 'index.php?module=VDDialogueDesigner&view=RunScript&record='.$id;
        }
        public function getSrciptStepModel($record){
            global $adb;
            $result = $adb->pquery('SELECT a.*, b.subject, c.description FROM vd_dialoguedesigner as a LEFT JOIN vd_dialogue_script as b ON b.id = a.category LEFT JOIN vtiger_crmentity as c ON c.crmid = dialoguedesignerid WHERE dialoguedesignerid = ?',array($record));
            $array = $adb->query_result_rowdata($result);
            $array = $this->getAnswerFields($array);
            $array['dialogue'] = $this->parserDialogue(preg_replace("/(\n)/", "<br/>", $array['dialogue'])); // если 1 на <br/> или сколько поставишь столько и будет
            
            $array['description'] = $this->parserDialogue(preg_replace("/(\n)/", "<br/>", $array['description'])); // если 1 на <br/> или сколько поставишь столько и будет
            
            return $array;
            
        }
        public function parserDialogue($text){
            $array_text = explode('##', $text);
            if (count($array_text)>1){
                for($i=1;$i<count($array_text);$i=$i+2){
                    $array_text[$i] = $this->getDataDialogue($array_text[$i]);
                }
            }
            $text = implode('', $array_text);
            $array_text = explode('#!', $text);
            if (count($array_text)>1){
                for($i=1;$i<count($array_text);$i=$i+2){
                    $array_text[$i] = "<span style='color:red'>".$array_text[$i]."</span>";
                }
            }
            return implode('', $array_text);
        }
        public function getDataDialogue($key){
            global $current_user;
            if ($key == 'USERNAME'){
                
                if (!empty($current_user->column_fields['first_name'])) return $current_user->column_fields['first_name'];
                else return $current_user->column_fields['last_name'];
            }
            else {
                
                $keys = explode('::', $key);
                $str = '';
             
                foreach ($keys as $value){
                    
                    if (!empty($this->inputs[$value])) {
                        if (!is_array(($this->inputs[$value]))){
                         $str .= str_replace(array('\t', '	'),'', trim($this->inputs[$value]))." ";
                        }
                        else {
                            $str .= implode(',', str_replace(array('\t', '	'),'',$this->inputs[$value]))." ";
                        }
                    }
                }
                
                return $str;
            }
        }
        public function getAnswerFields($array){
            if ($array['type_answer'] == ''){
                return $array;
            }
            if ($array['type_answer'] == 'LongString'){
                $function = 'getSerializeAnswerString';
            }
            else $function = 'getSerializeAnswer'.$array['type_answer'];
            return $this->$function($array);
        }
        public function getSerializeAnswerSearch($array){
            $fields = Zend_Json::decode(htmlspecialchars_decode($array['answer']));
            $array['next_step'] = $this->getScriptStep($fields['step']);
            $array['step'] = $fields['step'];
            $relatedModule = $fields['name'];
            $getFieldsArray = array();
            foreach ($fields['field'] as $key=>$field){
                 
                $_fieldT = explode(':', $field['field']);
                $array['default'][$_fieldT[2]] = $field['comment'];
                array_push($getFieldsArray, $_fieldT[2]);
                
              
               
            }
            $array['fieldsModels'] = $this->getAllFieldsList($relatedModule,$getFieldsArray);
            $recordModel = Vtiger_Record_Model::getCleanInstance($relatedModule);
            $array['moduleModels'] = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
           
            $array['fields'] = $fields;
            return $array;
        }
        public function getSerializeAnswerString($array){
            $array['answer'] = Zend_Json::decode(htmlspecialchars_decode($array['answer']));
            $array['step'] = $array['answer']['step'];
            return $array;
        }
        public function getSerializeAnswerModule($array){
           
            $fields = Zend_Json::decode(htmlspecialchars_decode($array['answer']));
            
            $array['next_step'] = $this->getScriptStep($fields['step']);
            $array['step'] = $fields['step'];
            $relatedModule = $fields['name'];
            $getFieldsArray = array();
            foreach ($fields['field'] as $key=>$field){
                 
                $_fieldT = explode(':', $field['field']);
                $array['default'][$_fieldT[2]] = $field['comment'];
                array_push($getFieldsArray, $_fieldT[2]);
                
              
               
            }
            $array['fieldsModels'] = $this->getAllFieldsList($relatedModule,$getFieldsArray);
            $recordModel = Vtiger_Record_Model::getCleanInstance($relatedModule);
            $array['moduleModels'] = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
           
            $array['fields'] = $fields;
            return $array;
        }
        
        public function getSerializeAnswerModuleDefault($array){
            return $this->getSerializeAnswerModule($array);
        }
        public function getSerializeAnswerButtons($array) {
            $fields = Zend_Json::decode(htmlspecialchars_decode($array['answer']));
            foreach ($fields as $key=>$field){
                $fields[$key]['next_step'] = $this->getScriptStep($field['step']);
                $fields[$key]['label'] = htmlspecialchars($fields[$key]['label'], ENT_QUOTES);
            }
            $array['fields'] = $fields;
            return $array;
        }
        public function getSerializeAnswerModuleButtons($array) {
            $fields = Zend_Json::decode(htmlspecialchars_decode($array['answer']));
            
            foreach ($fields['buttons'] as $key=>$field){
                $fields[$key]['next_step'] = $this->getScriptStep($field['step']);
                $fields[$key]['label'] = htmlspecialchars($fields[$key]['label'], ENT_QUOTES);
            }
            $array['fields']['buttons'] = $fields;
             $relatedModule = $fields['module']['module'];
             $getFieldsArray = array();
            foreach ($fields['module']['field'] as $key=>$field){
                 
                $_fieldT = explode(':', $field['field']);
                $array['default'][$_fieldT[2]] = $field['comment'];
                array_push($getFieldsArray, $_fieldT[2]);
                
              
               
            }
            $array['fieldsModels'] = $this->getAllFieldsList($relatedModule,$getFieldsArray);
            $recordModel = Vtiger_Record_Model::getCleanInstance($relatedModule);
            $array['moduleModels'] = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
            $array['fields']['module'] = $fields['module'];
            return $array;
        }
	public function getAllFieldsList($moduleName,$field) {
		
                $targetModuleAllFieldsList = array();
		$targetModuleModel = Vtiger_Module_Model::getInstance($moduleName);
		
		$blocks = $targetModuleModel->getBlocks();
                $webformFieldList = array();
                $fielsIsk = array('time_start');
		foreach ($blocks as $blockLabel => $blockModel) {
			$fieldModelsList = $blockModel->getFields();
			
			foreach ($fieldModelsList as $fieldName => $fieldModel) {
                           if (!in_array($fieldName, $field)) continue;
                           if (in_array($fieldName, $fielsIsk)) continue;
				
				if($fieldModel->isEditable()){
					$webformFieldInstnace = VDDialogueDesigner_ModuleField_Model::getInstanceFromFieldObject($fieldModel);
                                        $webformFieldInstnace->set('currentModule', $moduleName);
                                        if (!$add){
                                            $webformFieldInstnace->set('add', false);
                                        }
					if ($fieldModel->getDefaultFieldValue()) {
						$webformFieldInstnace->set('fieldvalue', $fieldModel->getDefaultFieldValue());
                                                
                                                
                                                
					}
					$webformFieldList[$webformFieldInstnace->getName()] = $webformFieldInstnace;
                                        
				}
			}
			
                }
                $sort = array();
                foreach ($field as $value){
                    if (!in_array($value, $fielsIsk)){
                         $sort[$value] = $webformFieldList[$value];
                    }
                }
                                 
		return $sort;
	}
        public function getInstanceFromFieldObject(Vtiger_Field $fieldObj) {
                
		$objectProperties = get_object_vars($fieldObj);
		$fieldModel = new self();
		foreach($objectProperties as $properName=>$propertyValue) {
			$fieldModel->$properName = $propertyValue;
		
		}
               
		return $fieldModel;
	}
        function getCategoryName($id){
             global $adb;
            $query = $adb->pquery('SELECT * FROM vd_dialogue_script WHERE id = ?',array($id));
           return ($adb->query_result($query,0,'subject'))? $adb->query_result($query,0,'subject'): "Общий";
        }
}
