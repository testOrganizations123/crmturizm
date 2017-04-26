<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class FoulList_Save_Action extends Vtiger_Save_Action {
    public $newevent = false;
	public function saveRecord($request) {

            $recordId = $request->get('record');
            if (!empty($recordId)){
		        $recordModel = $this->getRecordModelFromRequest($request);
            }
            else {
                $recordModel = $this->getRecordModelFromRequest($request);
            }
            $recordModel->save();
            $target = $request->get('target', null);
                $recordId = $request->get('record');
                
                if (!empty($target)){
                    $targetRecordModel = Vtiger_Record_Model::getInstanceById($target);
                    $targetModule = $targetRecordModel->getModule();
                    
                }


            $users = $request->get('users');
            $notif = $request->get('notif');
            $parentId = $request->get('parent');
            if ($parentId > 0){
               $this->changeStatusEventParent($request);

            }
                
                if ($users == $notif) {
                    if ($targetModule->name == 'Leads') {
                        $this->changeCheckLeads($targetRecordModel);
                        $this->newSaveEventForNotif($request);
                    } else {
                        $this->newSaveEventForNotif($request);
                    }
                } else {

                    $this->newSaveEventForNotif($request);
                }


		return $recordModel;
	}
	 public function changeStatusEventParent($request){
	        global $adb;
            $parentId = $request->get('parent');
            $target = $request->get('target', null);
            $parentRecordModel = Vtiger_Record_Model::getInstanceById($parentId);
            $notif = $parentRecordModel->get('notif');
            $assign = $parentRecordModel->get('assign_user_id');
            $query = "SELECT a.activity FROM vtiger_seactivityrel as s INNER JOIN vtiger_activity as a ON a.activityid = s.crmid INNER JOIN vtiger_crmentity as c ON c.crmid = a.activityid and c.smcreatorid = ? and c.smownerid = ? WHERE s.crmid = ? and a.activitytype = ? and a.eventstatus = ? ";
            $result = $adb->pquery($query, array($assign, $notif, $target, 'Замечание', 'Planned'));
            $numRows = $adb->num_rows($result);
            $id_array = [];
            for ($i=0; $i<$numRows;$i++){
                $id_array[] = $adb->query_result($result,$i,'activity');
            }
            $query = "UPDATE vtiger_activity SET eventstatus = 'Held' WHERE activity IN (".implode(",",$id_array).")";
            $adb->pquery($query,array());

     }
        protected function getRecordModelFromRequest(Vtiger_Request $request) {
	    global $current_user;
	    $currentUserName[] = $current_user->column_fields['first_name'];
        $currentUserName[] = $current_user->column_fields['last_name'];
        $currentUserName = implode(' ', $currentUserName);
		$moduleName = $request->getModule();
		$recordId = $request->get('record');
		$solaryFoul = $request->get('foullist', null);
        $users = $request->get('users');
        $notif = $request->get('notif');
        $newMessage = $request->get('message');
        $addComent = $request->get('addcoment');

        $messageArray = array();
        $messageArray['message'] = $newMessage;
        $messageArray['name'] = $currentUserName;

		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		if(!empty($recordId)) {
			$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
			$modelData = $recordModel->getData();
			$recordModel->set('id', $recordId);
			$recordModel->set('mode', 'edit');
			$point = $recordModel->get('point');
            $Message = Zend_Json::decode(htmlspecialchars_decode($recordModel->get('message')));
            if (isset($Message[$notif]) && !empty($addComent)){
                array_push($Message[$notif], $messageArray);
                $this->newevent = $notif;
            }


		} else {
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$modelData = $recordModel->getData();
			$recordModel->set('mode', '');
			$point = false;
			$this->newevent = $notif;
			$Message = array();
			array_push($Message, $messageArray);
			$recordModel->set('block', $recordModel->getBlock($request->get('foullist')));



		}
		$json_message = Zend_Json::encode($Message);
		$recordModel->set('message', $json_message);
        if ($users == $notif && !empty($solaryFoul) && empty($point)){
		    $request->set('point', $recordModel->getPoint($solaryFoul));
        }
		$fieldModelList = $moduleModel->getFields();
		foreach ($fieldModelList as $fieldName => $fieldModel) {
            if ($fieldName == 'message') continue;
			$fieldValue = $request->get($fieldName, null);

			if($fieldValue !== null) {
				if(!is_array($fieldValue)) {
					$fieldValue = trim($fieldValue);
				}
                                else {
                                    $fieldValue = implode(' ', $fieldValue);
                                }
				$recordModel->set($fieldName, $fieldValue);
			}
		}
		

		return $recordModel;
	}
        public function changeCheckLeads($recordModel){
            $recordModel->set('mode', 'edit');
            $recordModel->set('checks', 1);
            $recordModel->save();
            
        }
        public function newSaveEvent($request){
           global $adb;
            $moduleName = 'Events';
            $sql = "SELECT a.activityid FROM vtiger_seactivityrel as a LEFT JOIN vtiger_activity as b ON b.activityid = a.activityid WHERE a.crmid = ? and (b.eventstatus = 'Planned' or b.eventstatus = 'Новая' or b.eventstatus = 'Отказ') ORDER BY a.activityid DESC LIMIT 1";
            $result = $adb->pquery($sql, array($request->get('target')));
            if ($endTime) {
			$endTime = Vtiger_Time_UIType::getTimeValueWithSeconds($endTime);
                $eventId = $adb->query_result($result,0,'activityid');


                if(!empty($eventId)){

                    $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
                    $recordModel = Vtiger_Record_Model::getInstanceById($eventId,$moduleName);
                    $recordModel->set('eventstatus', 'Held');
                    $recordModel->set('cf_1085', 'Замечание по работе с заявкой');
                    $endTime = date('H:i');
                    $endDate = Vtiger_Date_UIType::getDBInsertedValue(date('Y-m-d'));
			$endDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue(date('Y-m-d')." ".$endTime);
			list($endDate, $endTime) = explode(' ', $endDateTime);
            }
            $recordModel->set('time_end', $endTime);
            $recordModel->set('due_date', $endDate);
            $recordModel->set('mode', 'edit');
               
            $recordModel->save();
        }
            $sql = "SELECT a.activityid FROM vtiger_seactivityrel as a LEFT JOIN vtiger_activity as b ON b.activityid = a.activityid WHERE a.crmid = ? and (b.eventstatus = 'Planned' or b.eventstatus = 'Новая' or b.eventstatus = 'Отказ')";
            $result = $adb->pquery($sql,array($request->get('target')));
             
            $numRows = $adb->num_rows($result);
             $event_array = array();
             for ($i=0;$i<$numRows;$i++){
                 array_push($event_array, $adb->query_result($result, $i, 'activityid'));
             }
             if (count($event_array)>0){
                 $sql = "UPDATE vtiger_activity SET eventstatus = 'Held' WHERE activityid IN (".implode(',',$event_array).")";
                
                 $adb->pquery($sql,array());
             }
           
            $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
            $startTime = Vtiger_Time_UIType::getTimeValueWithSeconds(date('H:m'));
            $startDate = date('Y-m-d');
           
            $recordModel->set('date_start', $startDate);
            $recordModel->set('time_start', $startTime);  
            $endTime = $startTime;
            $endDate = date('Y-m-d');

		
		$recordModel->set('time_end', $endTime);
		$recordModel->set('due_date', $endDate);
                $recordModel->set('visibility', 'Private');
		$recordModel->set('duration_hours', 0);
		$recordModel->set('duration_minutes', 0);
                $recordModel->set('subject', 'Замечание к заявке');
		$recordModel->set('activitytype', 'Замечание');
                $recordModel->set('description', $request->get('message'));
                $recordModel->set('eventstatus', 'Planned');
                
               
                $parent_id = $request->get('target');
                $recordModel->set('parent_id', $parent_id);
                if ($parent_id>0){
                    $leads = Vtiger_Record_Model::getInstanceById($parent_id);
                    $recordModel->set('assigned_user_id', $leads->get('assigned_user_id'));
                }
               
		$_REQUEST['set_reminder'] = 'No';
                         
                $recordModel->save();
                
                return true;
            
            
        }
        public function foulFix($request){
            global $adb;

            $sql = "SELECT a.activityid FROM vtiger_seactivityrel as a LEFT JOIN vtiger_activity as b ON b.activityid = a.activityid WHERE a.crmid = ? and (b.eventstatus = 'Planned' and b.activitytype = 'Замечание')";
            $result = $adb->pquery($sql,array($request->get('target')));

            $numRows = $adb->num_rows($result);
            $event_array = array();
            for ($i=0;$i<$numRows;$i++){
                array_push($event_array, $adb->query_result($result, $i, 'activityid'));
            }
            if (count($event_array)>0){
                $sql = "UPDATE vtiger_activity SET eventstatus = 'Held' WHERE activityid IN (".implode(',',$event_array).")";

                $adb->pquery($sql,array());
            }
            $sql = "SELECT foullistid FROM vtiger_foullist WHERE target = ? and checks != 'Да'";
            $result = $adb->pquery($sql,array($request->get('target')));

            $numRows = $adb->num_rows($result);

            for ($i=0;$i<$numRows;$i++){
                $recordModel = Vtiger_Record_Model::getInstanceById($adb->query_result($result,$i,'foullistid'));
                $recordModel->set('mode', 'edit');
                $recordModel->set('checks', 'Да');
                $recordModel->save();
            }

        }

    public function newSaveEventForNotif($request){

        $notif = $request->get('notif');
        $moduleName = 'Events';

        $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
        $startTime = Vtiger_Time_UIType::getTimeValueWithSeconds(date('H:m'));
        $startDate = date('Y-m-d');

        $recordModel->set('date_start', $startDate);
        $recordModel->set('time_start', $startTime);
        $endTime = $startTime;
        $endDate = date('Y-m-d');


        $recordModel->set('time_end', $endTime);
        $recordModel->set('due_date', $endDate);
        $recordModel->set('visibility', 'Private');
        $recordModel->set('duration_hours', 0);
        $recordModel->set('duration_minutes', 0);
        $recordModel->set('subject', 'Замечание к заявке');
        $recordModel->set('activitytype', 'Замечание');
        $recordModel->set('description', $request->get('message'));
        $recordModel->set('eventstatus', 'Planned');


        $parent_id = $request->get('target');
        $recordModel->set('parent_id', $parent_id);
        $recordModel->set('assigned_user_id', $notif);


        $_REQUEST['set_reminder'] = 'No';

        $recordModel->save();

        return true;


    }

    public function validateRequest(Vtiger_Request $request) {
        $sql = "SELECT a.activityid FROM vtiger_seactivityrel as a LEFT JOIN vtiger_activity as b ON b.activityid = a.activityid WHERE a.crmid = ? and (b.eventstatus = 'Planned' or b.eventstatus = 'Новая' or b.eventstatus = 'Отказ')";
        }
}
