<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * Vtiger Entity Record Model Class
 */
class VDDialogueDesigner_Script_Model {
        private $fields = array();
        public $id;
        public $module = false;
        public $mode = '';
        public $request;
       
        function __construct(Vtiger_Request $request, $recordId) {
            global $adb;
            $this->request = $request;
            $this->module = new VDDialogueDesigner_ScriptModule_Model();
            $fieldsList = $this->module->getFieldsList();
            if ($recordId){
                $this->mode = 'edit';
                $result = $adb->pquery('SELECT * FROM vd_dialogue_script WHERE id = ?', array($recordId)); 
                $numRows = $adb->num_rows($result);
                if (empty($numRows)){
                    throw new AppException(vtranslate('LBL_DELETE_RECORD'));
                }
                $this->id = $recordId;
                foreach ($fieldsList as $fieldName){
                   
                        $value = $adb->query_result($result,0,$fieldName);
                   
                    $this->set($fieldName, $value);
                }
            }
            else {
                $this->id = $adb->getUniqueID('vd_dialogue_script');
                 
                
            }
		
	
	}

	/**
	 * Function to get the id of the record
	 * @return <Number> - Record Id
	 */
	public function getId() {
		return $this->get('id');
	}

	/**
	 * Function to set the id of the record
	 * @param <type> $value - id value
	 * @return <Object> - current instance
	 */
	public function setId($value) {
		return $this->set('id',$value);
	}

	

	/**
	 * Function to get the Module to which the record belongs
	 * @return Vtiger_Module_Model
	 */
	public function getModule() {
		return $this->module;
	}

	
	/**
	 * Function to save the current Record Model
	 */
	public function save() {
            global $adb;
            $fieldsList = $this->module->getFieldsList();
             foreach ($fieldsList as $fieldName){
                    $value = $this->request->get($fieldName);
                    if ($fieldName == "menu_active" && empty($value)){
                         $value = 0;
                     }
                    
                    $this->set($fieldName, $value);
                }
            $data = array();
            $set = array();
               
            foreach ($fieldsList as $fieldName){
                    array_push($set, "$fieldName = ?");
                    $value = $this->get($fieldName);
                    if (empty($value)){
                        $value = '';
                    }
                    array_push($data, $this->get($fieldName));
                   
            }
                
            array_push($data, $this->id);
                
            if ($this->mode == 'edit'){
                    $sql = "Update vd_dialogue_script SET ".implode(',', $set)." WHERE id = ?";
                }
            else {
                    $sql = "INSERT INTO vd_dialogue_script SET ".implode(',', $set).", id = ?";
                }
            
            $adb->pquery($sql, $data);
                
	}

	/**
	 * Function to delete the current Record Model
	 */
	public function delete() {
		$this->getModule()->deleteRecord($this);
	}
        public function set($key,$value) {
		$this->fields[$key] = $value;
	}
        public function get($key) {
		return $this->fields[$key];
	}

	

}
