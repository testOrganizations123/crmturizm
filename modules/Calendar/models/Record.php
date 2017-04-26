<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
vimport('~~include/utils/RecurringType.php');

class Calendar_Record_Model extends Vtiger_Record_Model {

/**
	 * Function returns the Entity Name of Record Model
	 * @return <String>
	 */
	function getName() {
		$name = $this->get('subject');
		if(empty($name)) {
			$name = parent::getName();
		}
		return $name;
	}

	/**
	 * Function to insert details about reminder in to Database
	 * @param <Date> $reminderSent
	 * @param <integer> $recurId
	 * @param <String> $reminderMode like edit/delete
	 */
	public function setActivityReminder($reminderSent = 0, $recurId = '', $reminderMode = '') {
		$moduleInstance = CRMEntity::getInstance($this->getModuleName());
		$moduleInstance->activity_reminder($this->getId(), $this->get('reminder_time'), $reminderSent, $recurId, $reminderMode);
	}

	/**
	 * Function returns the Module Name based on the activity type
	 * @return <String>
	 */
	function getType() {
		$activityType = $this->get('activitytype');
		if($activityType == 'Task') {
			return 'Calendar';
		}
		return 'Events';
	}

	/**
	 * Function to get the Detail View url for the record
	 * @return <String> - Record Detail View Url
	 */
	public function getDetailViewUrl() {
		$module = $this->getModule();
		return 'index.php?module=Calendar&view='.$module->getDetailViewName().'&record='.$this->getId();
	}

	/**
	 * Function returns recurring information for EditView
	 * @return <Array> - which contains recurring Information
	 */
	public function getRecurrenceInformation() {
		$recurringObject = $this->getRecurringObject();

		if ($recurringObject) {
			$recurringData['recurringcheck'] = 'Yes';
			$recurringData['repeat_frequency'] = $recurringObject->getRecurringFrequency();
			$recurringData['eventrecurringtype'] = $recurringObject->getRecurringType();
			$recurringEndDate = $recurringObject->getRecurringEndDate(); 
			if(!empty($recurringEndDate)){ 
				$recurringData['recurringenddate'] = $recurringEndDate->get_formatted_date(); 
			} 
			$recurringInfo = $recurringObject->getUserRecurringInfo();

			if ($recurringObject->getRecurringType() == 'Weekly') {
				$noOfDays = count($recurringInfo['dayofweek_to_repeat']);
				for ($i = 0; $i < $noOfDays; ++$i) {
					$recurringData['week'.$recurringInfo['dayofweek_to_repeat'][$i]] = 'checked';
				}
			} elseif ($recurringObject->getRecurringType() == 'Monthly') {
				$recurringData['repeatMonth'] = $recurringInfo['repeatmonth_type'];
				if ($recurringInfo['repeatmonth_type'] == 'date') {
					$recurringData['repeatMonth_date'] = $recurringInfo['repeatmonth_date'];
				} else {
					$recurringData['repeatMonth_daytype'] = $recurringInfo['repeatmonth_daytype'];
					$recurringData['repeatMonth_day'] = $recurringInfo['dayofweek_to_repeat'][0];
				}
			}
		} else {
			$recurringData['recurringcheck'] = 'No';
		}
		return $recurringData;
	}

	function save() {
		//Time should changed to 24hrs format
		$_REQUEST['time_start'] = Vtiger_Time_UIType::getTimeValueWithSeconds($_REQUEST['time_start']);
		$_REQUEST['time_end'] = Vtiger_Time_UIType::getTimeValueWithSeconds($_REQUEST['time_end']);
		parent::save();
	}

	/**
	 * Function to get recurring information for the current record in detail view
	 * @return <Array> - which contains Recurring Information
	 */
	public function getRecurringDetails() {
		$recurringObject = $this->getRecurringObject();
		if ($recurringObject) {
			$recurringInfoDisplayData = $recurringObject->getDisplayRecurringInfo();
			$recurringEndDate = $recurringObject->getRecurringEndDate(); 
		} else {
			$recurringInfoDisplayData['recurringcheck'] = vtranslate('LBL_NO', $currentModule);
			$recurringInfoDisplayData['repeat_str'] = '';
		}
		if(!empty($recurringEndDate)){ 
			$recurringInfoDisplayData['recurringenddate'] = $recurringEndDate->get_formatted_date(); 
		}

		return $recurringInfoDisplayData;
	}

	/**
	 * Function to get the recurring object
	 * @return Object - recurring object
	 */
	public function getRecurringObject() {
		$db = PearDatabase::getInstance();
		$query = 'SELECT vtiger_recurringevents.*, vtiger_activity.date_start, vtiger_activity.time_start, vtiger_activity.due_date, vtiger_activity.time_end FROM vtiger_recurringevents
					INNER JOIN vtiger_activity ON vtiger_activity.activityid = vtiger_recurringevents.activityid
					WHERE vtiger_recurringevents.activityid = ?';
		$result = $db->pquery($query, array($this->getId()));
		if ($db->num_rows($result)) {
			return RecurringType::fromDBRequest($db->query_result_rowdata($result, 0));
		}
		return false;
	}

	/**
	 * Function updates the Calendar Reminder popup's status
	 */
	public function updateReminderStatus($status=1) {
		$db = PearDatabase::getInstance();
		$db->pquery("UPDATE vtiger_activity_reminder_popup set status = ? where recordid = ?", array($status, $this->getId()));

	}
        public function getReferensModuleName(){
            global $adb;
           $parent_id = $this->rawData['crmid'];
           if (!empty($parent_id)){
               $result = $adb->pquery('Select * From vtiger_crmentity Where crmid = ?', array($parent_id));
               return $adb->query_result_rowdata($result,0);
           }
           else {
               return false;
           }
            
        }
        public function getUitypeTemplate($name){
            return "uitypes/".$name."_calendar.tpl";
        }
        public function getDetailLinkParentModule($name,$id=false, $mode=false){
            
            if(empty($name)){
                $parent_id = $id;
                $name = 'Calendar';
            }
            else {
                $parent_id = $this->rawData['crmid'];
                $potentialid = $this->rawData['potentialid'];
            }
             if ($this->rawData['leadstatus'] == 'Исходящий звонок 15 мин'){
                 return "index.php?module=VDDialogueDesigner&view=RunScript&record=162&leadid=$parent_id";
             }
            // elseif ($this->rawData['leadstatus'] == 'Контекст'){
             //    return "index.php?module=VDDialogueDesigner&view=RunScript&record=195&leadid=$parent_id";
            // }
             elseif ($this->rawData['leadstatus'] == 'Реактивация'){
                 return "index.php?module=VDDialogueDesigner&view=RunScript&record=55&leadid=$parent_id&potentialid=$potentialid";
             }
              elseif ($this->rawData['leadstatus'] == 'Реактивация дожим'){
                 return "index.php?module=VDDialogueDesigner&view=RunScript&record=545001&leadid=$parent_id&potentialid=$potentialid";
             } elseif ($name == 'Leads' and $mode == 1){
                 return "index.php?module=VDDialogueDesigner&view=RunScript&record=720999&leadid=$parent_id";
             }
            return 'index.php?module='.$name.'&view=Detail&record='.$parent_id;
        }
        
        public function getListEvent(){
            global $adb, $current_user;
            $parent_id = $this->rawData['crmid'];
            //echo '<pre>';print_r($this->rawData);echo '</pre>';die;
            $assigned_user = $this->rawData['smownerid'];
            $listEvent = array();
            if (!empty($parent_id)){
               $result = $adb->pquery('Select e.description, e.createdtime, e.modifiedtime, a.subject, a.activitytype, a.date_start, a.due_date, a.time_start, a.time_end, a.eventstatus, acf.cf_1085 From vtiger_seactivityrel as rel LEFT JOIN vtiger_crmentity as e ON e.crmid = rel.activityid LEFT JOIN vtiger_activity as a ON a.activityid=rel.activityid LEFT JOIN vtiger_activitycf as acf ON acf.activityid=rel.activityid LEFT JOIN vtiger_crmentity as crac ON crac.crmid = rel.activityid Where rel.crmid = ? and (a.activitytype = \'Заявка\') ORDER BY e.crmid DESC LIMIT 2', array($parent_id,$current_user->id)); // e.creattime
             //  echo '<pre>';   //print_r('Select e.description, e.createdtime, e.modifiedtime, a.activitytype, a.date_start, a.due_date, a.time_start, a.time_end, a.eventstatus From vtiger_seactivityrel as rel LEFT JOIN vtiger_crmidentity as e ON e.crmid = rel.activityid LEFT JOIN vtiger_activity as a ON a.activityid=rel.activityid LEFT JOIN vtiger_activitycf a acf ON acf.activityid=rel.activityid Where rel.crmid = ? ORDER BY e.createdtime ASC');
               $numRows = $adb->num_rows($result);
               for ($i=0;$i<$numRows;$i++){
                   $listEvent[$i] = $adb->query_result_rowdata($result,$i);
               }
             // print_r ($listEvent);
               
           }
           return $listEvent;
        }
        public function getClientsType(){
            global $adb;
            $id = $this->rawData['rating'];
            $resut = $adb->pquery('SELECT * FROM vtiger_clienttypes WHERE clienttypesid =?', array($id));
            return $adb->query_result($resut, 0, 'client_types');
        }
        public function getClassTrDate(){
            //echo '<pre>';print_r( $this->rawData);echo '</pre>';die();
            if ($this->rawData['leadstatus'] == 'Исходящий звонок 15 мин'){
                return 'min15';
            }
            $date_now = date('Y-m-d');
            $due_data = $this->rawData['due_date'];
            if ($date_now > $due_data) {
                return 'error';
            }
            else if ($date_now == $due_data){
                $time_now = date('H:i:s');
                $time_end = $this->rawData['time_end'];
                if ($time_now > $time_end){
                    return 'error';
                }
            }
            return 'success';
            
        }
        public function getLabelStatusClass(){
            $status = $this->rawData['status'];
            //echo "<pre>";print_r ($this->rawData);echo "</pre>";
            switch($status){
                case 'Planned': $class = 'label-info'; break;
                case 'Новая': $class = 'label-important'; break;
                case 'Продажа': $class = 'label-success'; break;
                case 'Отказ': $class = 'label-default'; break;
                default : $class = '';
            }
            return $class;
        }
}
