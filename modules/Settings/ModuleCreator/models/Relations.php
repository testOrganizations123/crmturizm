<?php

class Settings_ModuleCreator_Relations_Model extends Settings_Vtiger_Systems_Model {
        function getTabs(){
		global $adb;
		$sql = "SELECT * FROM vtiger_parenttab";
		$result = $adb->pquery($sql);
		$rows = array();
		while($row = $adb->fetch_array($result)){
			$rows[] = $row;
		}
		
		return $rows;
	}
	
	function getModulesList(){
		$list = vtlib_getToggleModuleInfo();
		
		return $list;
	}
	
	function getRelationsByTabId($id){
		global $adb;
		
		$sql = "SELECT * FROM vtiger_relatedlists WHERE tabid = $id";
		$result = $adb->pquery($sql);
		
		$rows = array();
		while($row = $adb->fetch_array($result)){
			$rows[] = $row;
		}
		
		return $rows;
	}
	
	function getRelationById($id){
		global $adb;
		
		$sql = "SELECT * FROM vtiger_relatedlists WHERE relation_id = $id";
		$result = $adb->pquery($sql);
		
		$row = $adb->fetch_row($result);
		return $row;
	}
	
	function getTabById($id){
		global $adb;
		
		$sql = "SELECT * FROM vtiger_tab WHERE tabid = $id";
		$result = $adb->pquery($sql);
		
		$row = $adb->fetch_row($result);
		return $row;
	}
	
	function createRelation($modulename,$relatedmodule,$relationlabel,$relationfunction){
		$Vtiger_Utils_Log = false;

		$mod=Vtiger_Module::getInstance($modulename);
		$mod->setRelatedList(Vtiger_Module::getInstance($relatedmodule), $relationlabel ,Array('ADD','SELECT'),$relationfunction);
	}
	
	function editRelation($relationid,$modulename,$relatedmodule,$relationlabel,$relationfunction){
		global $adb;
		$t1 = getTabid($modulename);
		$t2 = getTabid($relatedmodule);
		$sql = "UPDATE vtiger_relatedlists SET tabid = '$t1', related_tabid = '$t2', name = '$relationfunction', label = '$relationlabel' WHERE relation_id = '$relationid'";
		$adb->pquery($sql);
                //exit($sql);
	}
	
	function deleteRelation($relationid){
		global $adb;
		
		$sql = "DELETE FROM vtiger_relatedlists WHERE relation_id = '$relationid'";
		
		$adb->pquery($sql);
	}
	
	function getRelatedFieldsByTabname($modulename){
		global $adb;
		
		$sql = "SELECT vtiger_fieldmodulerel.*, vtiger_field.fieldlabel FROM vtiger_fieldmodulerel 
				LEFT JOIN vtiger_field on vtiger_field.fieldid = vtiger_fieldmodulerel.fieldid WHERE module = '".$modulename."'";
		$result = $adb->pquery($sql);
		$rows = array();
		while($row = $adb->fetch_array($result)){
			$rows[] = $row;
		}
		return $rows;
	}
	
	function getBlocksByTabid($tabid){
		global $adb;
		
		$sql = "SELECT * FROM vtiger_blocks WHERE tabid = '".$tabid."'";
		$result = $adb->pquery($sql);
		$rows = array();
		while($row = $adb->fetch_array($result)){
			$rows[] = $row;
		}
		return $rows;
	}
	
	function createRelatedField($modulename,$relatedmodule,$fieldlabel,$fieldname,$blockid,$relatedlabel=''){
		$Vtiger_Utils_Log = false;
		
		$mod=Vtiger_Module::getInstance($modulename);
		$block = Vtiger_Block::getInstance($blockid);
	
		$fieldname = strtolower($fieldname);
		$fieldname = preg_replace("/[^a-z]/","",$fieldname);
		
		
		$field = new Vtiger_Field();
		$field->name = $fieldname;
		$field->label = $fieldlabel;
		$field->uitype = 10; 
		$block->addField($field);
		$field->setRelatedModules(Array($relatedmodule));
		$field->save();
		$block->save();
		if ($relatedlabel != ''){
			$mod2=Vtiger_Module::getInstance($relatedmodule);
			$mod2->setRelatedList(Vtiger_Module::getInstance($modulename), $relatedlabel ,Array('ADD'),'get_dependents_list');
		}
	}
	
	function deleteFieldRelation($fieldid){
		$Vtiger_Utils_Log = false;
		global $adb;
		
		$sql = "SELECT * FROM vtiger_fieldmodulerel WHERE fieldid='$fieldid' LIMIT 1";
		$row = $adb->fetch_row($adb->pquery($sql));
	
		$field = Vtiger_Field::getInstance($fieldid);
		$field->unsetRelatedModules(Array($row['relmodule']));
		
		$sql = "DELETE FROM vtiger_field WHERE fieldid = '$fieldid'";
		$adb->pquery($sql);
	}
	
	function getRelatedFieldById($fieldid){
		global $adb;
		
		$sql = "SELECT vtiger_fieldmodulerel.*, vtiger_field.fieldname, vtiger_field.fieldlabel, vtiger_field.block FROM vtiger_fieldmodulerel 
				JOIN vtiger_field ON vtiger_field.fieldid = vtiger_fieldmodulerel.fieldid WHERE vtiger_fieldmodulerel.fieldid = '$fieldid'";
				
		$result = $adb->pquery($sql);
		
		return $adb->fetch_row($result);
	}
	
	function editRelatedField($fieldid, $field_label, $blockid, $relatedmodule){
		global $adb;
		
		$sql = "UPDATE vtiger_fieldmodulerel SET relmodule = '$relatedmodule' WHERE fieldid = '$fieldid'";
		$adb->pquery($sql);
		
		$sql = "UPDATE vtiger_field SET fieldlabel = '$field_label', block = '$blockid' WHERE fieldid = '$fieldid'";
		$adb->pquery($sql);
	}
	
}