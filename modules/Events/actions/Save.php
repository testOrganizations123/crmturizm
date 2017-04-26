<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Events_Save_Action extends Calendar_Save_Action {

	/**
	 * Function to save record
	 * @param <Vtiger_Request> $request - values of the record
	 * @return <RecordModel> - record Model of saved record
	 */
        function validateRequest(Vtiger_Request $request) {
                
                $mode = $request->get('mode');
                if ($mode == 'saveExpressTask'){
                    
                    return true;
                }
                else 
		return parent::validateRequest($request);
	}
        public function process(Vtiger_Request $request) {
            $mode = $request->get('mode');
                if ($mode == 'saveExpressTask'){
                   $this->saveExpress($request);
                }
                else {
                    parent::process($request);
                }
        }
        public function saveExpress($request){
             $moduleName = 'Events';
             $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
             $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
            $startTime = Vtiger_Time_UIType::getTimeValueWithSeconds(date('H:i'));
            $startDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue(date('Y-m-d')." ".$startTime);
            list($startDate, $startTime) = explode(' ', $startDateTime);
            $recordModel->set('date_start', date('Y-m-d'));
            $recordModel->set('time_start', $startTime);  
            $endTime = date('H:i');
            $endTime = Vtiger_Time_UIType::getTimeValueWithSeconds($endTime);
            $diffinSec=  0;
            $diff_days= 0;
       
        
        $recordModel->set('duration_hours', 0);
	$recordModel->set('duration_minutes', 0);
        $recordModel->set('time_end', $endTime);
	$recordModel->set('due_date', $endDate);
        $recordModel->set('visibility', 'Private');
		
                $recordModel->set('subject', 'Экспресс заявка');
		$recordModel->set('activitytype', 'Call');
                $recordModel->set('eventstatus', 'Экспресс');
                $recordModel->set('description', $request->get('description'));
                $recordModel->set('firstname', $request->get('firstname'));
                $recordModel->set('phone', $request->get('phone'));
                $recordModel->set('taskpriority', 'High');
			$_REQUEST['set_reminder'] = 'No';
                $recordModel->save();
                $loadUrl = 'index.php?module=Calendar&view=List';
                header("Location: $loadUrl");
                exit();
        }
                
	public function saveRecord($request) {
		$adb = PearDatabase::getInstance();
		$recordModel = $this->getRecordModelFromRequest($request);
		$recordModel->save();
		$originalRecordId = $recordModel->getId();
		if($request->get('relationOperation')) {
			$parentModuleName = $request->get('sourceModule');
			$parentModuleModel = Vtiger_Module_Model::getInstance($parentModuleName);
			$parentRecordId = $request->get('sourceRecord');
			$relatedModule = $recordModel->getModule();
			if($relatedModule->getName() == 'Events'){
				$relatedModule = Vtiger_Module_Model::getInstance('Calendar');
			}
			$relatedRecordId = $recordModel->getId();

			$relationModel = Vtiger_Relation_Model::getInstance($parentModuleModel, $relatedModule);
			$relationModel->addRelation($parentRecordId, $relatedRecordId);
		}

		// Handled to save follow up event
		$followupMode = $request->get('followup');

		//Start Date and Time values
		$startTime = Vtiger_Time_UIType::getTimeValueWithSeconds($request->get('followup_time_start'));
		$startDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue($request->get('followup_date_start') . " " . $startTime);
		list($startDate, $startTime) = explode(' ', $startDateTime);

		$subject = $request->get('subject');
		if($followupMode == 'on' && $startTime != '' && $startDate != ''){
			$recordModel->set('eventstatus', 'Planned');
			$recordModel->set('subject','[Followup] '.$subject);
			$recordModel->set('date_start',$startDate);
			$recordModel->set('time_start',$startTime);

			$currentUser = Users_Record_Model::getCurrentUserModel();
			$activityType = $recordModel->get('activitytype');
			if($activityType == 'Call') {
				$minutes = $currentUser->get('callduration');
			} else {
				$minutes = $currentUser->get('othereventduration');
			}
			$dueDateTime = date('Y-m-d H:i:s', strtotime("$startDateTime+$minutes minutes"));
			list($startDate, $startTime) = explode(' ', $dueDateTime);

			$recordModel->set('due_date',$startDate);
			$recordModel->set('time_end',$startTime);
			$recordModel->set('recurringtype', '');
			$recordModel->set('mode', 'create');
			$recordModel->save();
			$heldevent = true;
		}

		//TODO: remove the dependency on $_REQUEST
		if($_REQUEST['recurringtype'] != '' && $_REQUEST['recurringtype'] != '--None--') {
			vimport('~~/modules/Calendar/RepeatEvents.php');
			$focus =  new Activity();

			//get all the stored data to this object
			$focus->column_fields = $recordModel->getData();

			Calendar_RepeatEvents::repeatFromRequest($focus);
		}
        return $recordModel;
    }


    /**
	 * Function to get the record model based on the request parameters
	 * @param Vtiger_Request $request
	 * @return Vtiger_Record_Model or Module specific Record Model instance
	 */
	protected function getRecordModelFromRequest(Vtiger_Request $request) {
        $recordModel = parent::getRecordModelFromRequest($request);

        $recordModel->set('selectedusers', $request->get('selectedusers'));
        return $recordModel;
    }
}
