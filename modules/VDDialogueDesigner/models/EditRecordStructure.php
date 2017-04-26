<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class VDDialogueDesigner_EditRecordStructure_Model extends Vtiger_EditRecordStructure_Model{
    public function getTypePickList() {
        $array = array(
            'Question' => 'Question',
            'Question fields' => 'Question fields',
            'Speech' => 'Speech',
            'Save' => 'Save',
            'Exit' => 'Exit',
            'SaveAndLeads' => 'SaveAndLeads',
            
        );
        return $array;
    }
    public function getTypeAnswerPickList() {
        $array = array(
            'String' => 'String',
            'LongString' => 'Long String',
            'Buttons' => 'Buttons',
            'Module' => 'Module field',
            'ModuleDefault' => 'Module field default',
            'Search' => 'Search',
            'ModuleButtons' => 'ModuleButtons',
            
        );
        return $array;
    }
    public function getCategoryPicklist(){
        global $adb;
        $result = $adb->pquery('SELECT * FROM vd_dialogue_script');
        $numRows = $adb->num_rows($result);
        $array = array();
        for ($i=0;$i<$numRows;$i++){
            $array[$adb->query_result($result,$i,'id')] = $adb->query_result($result,$i,'subject');
        }
        return $array;
    }
     public function getColorPickList() {
        $array = array(
            'info' => 'Normal',
            'success' => 'Light',
            'warning' => 'Attention',
            'danger' => 'Warning',
            
            
        );
        return $array;
    }
    /**
     * Function to get the values in stuctured format
     * @return array <array> - values in structure array('block'=>array(fieldinfo));
     */
    function getStructurer($moduleName) {
        
		
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		if ($moduleName === 'Emails') {
			$restrictedTablesList = array('vtiger_emaildetails', 'vtiger_attachments');
			$moduleRecordStructure = array();
			$blockModelList = $moduleModel->getBlocks();
			foreach ($blockModelList as $blockLabel => $blockModel) {
				$fieldModelList = $blockModel->getFields();
				if (!empty($fieldModelList)) {
					$moduleRecordStructure[$blockLabel] = array();
					foreach ($fieldModelList as $fieldName => $fieldModel) {
						if (!in_array($fieldModel->get('table'), $restrictedTablesList) && $fieldModel->isViewable()) {
							$moduleRecordStructure[$blockLabel][$fieldName] = $fieldModel;
						}
					}
				}
			}
		} else if($moduleName === 'Calendar') { 
			$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($moduleModel);
			$moduleRecordStructure = array();
			$calendarRecordStructure = $recordStructureInstance->getStructure();
			
			$eventsModel = Vtiger_Module_Model::getInstance('Events');
			$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($eventsModel);
			$eventRecordStructure = $recordStructureInstance->getStructure();
			
			$blockLabel = 'LBL_CUSTOM_INFORMATION';
			if($eventRecordStructure[$blockLabel]) {
				if($calendarRecordStructure[$blockLabel]) {
					$calendarRecordStructure[$blockLabel] = array_merge($calendarRecordStructure[$blockLabel], $eventRecordStructure[$blockLabel]);
				} else {
					$calendarRecordStructure[$blockLabel] = $eventRecordStructure[$blockLabel];
				}
			}
			$moduleRecordStructure = $calendarRecordStructure;
		} else {
			$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($moduleModel);
			$moduleRecordStructure = $recordStructureInstance->getStructure();
		}
               
                return $moduleRecordStructure;
	}
}