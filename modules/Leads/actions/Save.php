<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Leads_Save_Action extends Vtiger_Save_Action
{


    public function process(Vtiger_Request $request)
    {
        $mode = $request->get('mode');

        if ($mode == 'newEvents') {
            $this->newSaveEvent($request);
        }
        $salutationType = $request->get('salutationtype');

        if ($salutationType === '--None--') {
            $request->set('salutationtype', '');
        }
        $redirect = $request->get('redirect');
        $recordid = $request->get('record');
        $this->recordLeads = $recordid;
        $leadstatus = $request->get('leadstatus');


        if ($leadstatus == 'Исходящий звонок 15 мин') {
            $request->set('date_start', date('Y-m-d', strtotime('+15 minutes', time())));
            $request->set('time_start', date('H:i:s', strtotime('+15 minutes', time())));

        } else if (empty($leadstatus)) {
            $request->set('leadstatus', '');
        }

        if ($leadstatus == 'Внесены изменения') {
            $request->set('cf_1103', implode(' ', $request->get('description')) . ' ' . implode(' ', $request->get('cf_1103')));


        }
        $express = $request->get('express');

        if (($leadstatus != 'Прилетевший не ответил' && $leadstatus != 'Дожим не ответил' && $leadstatus != 'Исходящий не ответил' ) || ($leadstatus == 'Исходящий не ответил' && empty($recordid)) ){
            if (!empty($express)) {
                $this->expressCheckOut($express);
            }
            $recordModel = $this->saveRecord($request);
            $call = $recordModel->get('callid');
            if ($call > 0) {
                $recordModel->set('mode', 'edit');
                $recordModel->set('callid', 0);
                $recordModel->save();
            }
            if ($leadstatus == 'Исходящий не ответил'){
                $recordModel->set('mode', 'edit');
                $recordModel->set('callid', 1);
                $recordModel->save();
            }
            $this->recordLeads = $recordModel->getId();
            if ($leadstatus == 'Внесены изменения') {
                $this->newSaveEvent($request);
            } else {
                $recordEvent = $this->getSearchEvent($recordModel->getId());

                if ($recordEvent > 0) {
                    $request->set('recordEvents', $recordEvent);
                    if ($leadstatus == 'Продажа') {
                        $request->set('eventstatus', 'Продажа');
                    } else {
                        $request->set('eventstatus', 'Planned');
                        $request->set('newEvent', implode('', $request->get('cf_1103')));
                    }
                    $this->newSaveEvent($request);

                } else {
                    if ($leadstatus == 'Продажа') {
                        $request->set('eventstatus', 'Продажа');
                    }


                    if ($request->get('cf_1482') != "") {

                        $date_start = $request->get('date_start');
                        $time_start = $request->get('time_start');
                        $request->set('date_start', date('d.m.Y'));
                        $request->set('time_start', date('H:i:s'));

                        $this->saveEvent($request, $recordid);

                        $recordEvent = $this->getSearchEvent($this->recordLeads);
                        $request->set('cf_1484', NULL);
                        $request->set('cf_1486', NULL);
                        $request->set('date_start', $date_start);
                        $request->set('time_start', $time_start);
                        $request->set('newEvent', $request->get('cf_1103'));
                        $request->set('oldEvent', $request->get('cf_1482'));
                        $request->set('recordEvents', $recordEvent);
                        $request->set('eventstatus', 'Planned');
                        $request->set('record', $this->recordLeads);
                        $this->newSaveEvent($request);
                    } else {
                        $this->saveEvent($request, $recordid);
                    }
                }
            }

        } else if ($leadstatus == 'Дожим не ответил' || $leadstatus == 'Исходящий не ответил') {

            $this->plusCallLeads($request);
        } else if (!empty($express)) {
            $this->plusCall($express);
        }


        if ($leadstatus == 'Продажа') {
            $loadUrl = "index.php?module=Potentials&view=Edit&leadsource=" . $this->recordLeads;
        } else if ($redirect == 'Leads') {
            $loadUrl = "index.php?module=Leads&view=Detail&mod=read2&record=" . $this->recordLeads;
        } elseif ($request->get('relationOperation')) {
            $parentModuleName = $request->get('sourceModule');
            $parentRecordId = $request->get('sourceRecord');
            $parentRecordModel = Vtiger_Record_Model::getInstanceById($parentRecordId, $parentModuleName);
            //TODO : Url should load the related list instead of detail view of record
            $loadUrl = $parentRecordModel->getDetailViewUrl();
        } else {
            $loadUrl = 'index.php?module=Calendar&view=List';
        }
        header("Location: $loadUrl");
    }

    function plusCallLeads(Vtiger_Request $request)
    {
        $record = $request->get('record');
        $recordModel = Vtiger_Record_Model::getInstanceById($record);
        $recordModel->set('mode', 'edit');
        $call = $recordModel->get('callid');
        $call++;
        $recordModel->set('callid', $call);
        $recordModel->save();
        $recordEvent = $this->getSearchEvent($recordModel->getId());
        $request->set('recordEvents', $recordEvent);
        if ($call < 4) {

            $request->set('eventstatus', 'Planned');
            $request->set('newEvent', implode(',', $request->get('cf_1103')));

            $this->newSaveEvent($request);

        } else {
            $request->set('eventstatus', 'Отказ');
            $this->newSaveEvent($request);
        }
    }

    function getSearchEvent($id)
    {
        global $adb;
        $sql = $sql = "SELECT a.activityid FROM vtiger_seactivityrel as a LEFT JOIN vtiger_activity as b ON b.activityid = a.activityid WHERE a.crmid = ? and (b.eventstatus = 'Planned' or b.eventstatus = 'Новая') and b.activitytype = 'Заявка'";
        $result = $adb->pquery($sql, array($id));

        return $adb->query_result($result, 0, 'activityid');

    }

    function plusCall($id)
    {
        $moduleName = 'Events';


        $recordModel = Vtiger_Record_Model::getInstanceById($id, $moduleName);
        $recordModel->set('mode', 'edit');
        $call = $recordModel->get('cf_1454') + 1;
        $recordModel->set('cf_1454', $call);
        $recordModel->save();
    }

    function expressCheckOut($id)
    {
        $moduleName = 'Events';


        $recordModel = Vtiger_Record_Model::getInstanceById($id, $moduleName);
        $recordModel->set('mode', 'edit');
        $recordModel->set('eventstatus', 'Held');
        $recordModel->save();


    }

    public function saveRecord($request)
    {
        $recordModel = $this->getRecordModelFromRequest($request);
        $leadstatus = $request->get('leadstatus');
        if ($leadstatus == 'Внесены изменения') {

            return $recordModel;
        }

        $recordModel->save();
        if ($request->get('relationOperation')) {
            $parentModuleName = $request->get('sourceModule');
            $parentModuleModel = Vtiger_Module_Model::getInstance($parentModuleName);
            $parentRecordId = $request->get('sourceRecord');
            $relatedModule = $recordModel->getModule();
            $relatedRecordId = $recordModel->getId();

            $relationModel = Vtiger_Relation_Model::getInstance($parentModuleModel, $relatedModule);
            $relationModel->addRelation($parentRecordId, $relatedRecordId);
        }
        if ($request->get('imgDeleted')) {
            $imageIds = $request->get('imageid');
            foreach ($imageIds as $imageId) {
                $status = $recordModel->deleteImage($imageId);
            }
        }
        return $recordModel;
    }

    protected function getRecordModelFromRequest(Vtiger_Request $request)
    {

        $moduleName = $request->getModule();
        $recordId = $request->get('record');

        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);

        if (!empty($recordId)) {
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
            $fieldValue = $request->get($fieldName, null);
            $fieldDataType = $fieldModel->getFieldDataType();
            if ($fieldDataType == 'time') {
                $fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
            }
            if ($fieldValue !== null) {
                if (!is_array($fieldValue)) {
                    $fieldValue = trim($fieldValue);
                } else {
                    $fieldValue = implode(' ', $fieldValue);
                }
                $recordModel->set($fieldName, $fieldValue);
            }
        }
        return $recordModel;
    }

    public function newSaveEvent($request)
    {
        global $adb;
        $moduleName = 'Events';
        $eventId = $request->get('recordEvents');
        $add = true;
        $cf_1482 = $request->get('cf_1482');
        $cf_1484 = $request->get('cf_1484');
        $cf_1486 = $request->get('cf_1486');
        echo $eventId;
        if (!empty($eventId)) {
            $add = false;
            $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
            $recordModel = Vtiger_Record_Model::getInstanceById($eventId, $moduleName);
            if ($request->get('eventstatus') == 'Отказ') {
                $recordModel->set('eventstatus', 'Отказ');
            } else if ($request->get('eventstatus') == 'Продажа') {
                $recordModel->set('eventstatus', 'Продажа');
            } else {
                $recordModel->set('eventstatus', 'Held');
            }
            $oldEvent = $request->get('oldEvent');

            if (!empty($oldEvent)) {
                $recordModel->set('cf_1085', $oldEvent);
            } else if (!empty($cf_1482)) {
                $recordModel->set('cf_1085', $oldEvent . ' ' . implode('. ', $cf_1482));

            }

            $addOldEvent = '';
            if (!empty($cf_1484)) {
                $addOldEvent .= 'Вопрос туриста: ' . $cf_1484 . "\n";
            }
            if (!empty($cf_1486)) {
                $addOldEvent .= 'Ответ менеджера: ' . $cf_1486;
            }
            if ($addOldEvent != '') {
                $recordModel->set('cf_1085', $recordModel->get('cf_805') . "\n" . $addOldEvent);
            }


            $endTime = date('H:i');
            $endDate = Vtiger_Date_UIType::getDBInsertedValue(date('Y-m-d'));

            if ($endTime) {
                $endTime = Vtiger_Time_UIType::getTimeValueWithSeconds($endTime);
                $endDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue(date('Y-m-d') . " " . $endTime);
                list($endDate, $endTime) = explode(' ', $endDateTime);
            }
            $recordModel->set('time_end', $endTime);
            $recordModel->set('due_date', $endDate);
            $recordModel->set('mode', 'edit');

            $recordModel->save();
        }
        $sql = "SELECT a.activityid FROM vtiger_seactivityrel as a LEFT JOIN vtiger_activity as b ON b.activityid = a.activityid WHERE a.crmid = ? and (b.eventstatus = 'Planned' or b.eventstatus = 'Новая') and b.activitytype = 'Заявка'";
        $result = $adb->pquery($sql, array($request->get('record')));

        $numRows = $adb->num_rows($result);
        $event_array = array();
        for ($i = 0; $i < $numRows; $i++) {
            array_push($event_array, $adb->query_result($result, $i, 'activityid'));
        }
        if (count($event_array) > 0) {
            $sql = "UPDATE vtiger_activity SET eventstatus = 'Held' WHERE activityid IN (" . implode(',', $event_array) . ")";

            $adb->pquery($sql, array());
        }
        if ($request->get('eventstatus') != 'Продажа' && $request->get('eventstatus') != 'Отказ') {
            $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
            $startTime = Vtiger_Time_UIType::getTimeValueWithSeconds($request->get('time_start'));
            $startDate = date('Y-m-d', strtotime($request->get('date_start')));

            $recordModel->set('date_start', $startDate);
            $recordModel->set('time_start', $startTime);
            $endTime = $request->get('time_start');
            $endDate = date('Y-m-d', strtotime($request->get('date_start')));


            $recordModel->set('time_end', $endTime);
            $recordModel->set('due_date', $endDate);
            $recordModel->set('visibility', 'Private');
            $recordModel->set('duration_hours', 0);
            $recordModel->set('duration_minutes', 0);
            $recordModel->set('subject', 'Задача к заявке');
            $recordModel->set('activitytype', 'Заявка');

            $leadstatus = $request->get('leadstatus');
            if ($leadstatus == 'Внесены изменения') {
                $recordModel->set('taskpriority', 'Ahight');
                $recordModel->set('description', $request->get('cf_1103'));
                $recordModel->set('eventstatus', 'Planned');


            } else {
                $recordModel->set('taskpriority', $request->get('taskpriority'));
                $recordModel->set('eventstatus', $request->get('eventstatus'));
                $recordModel->set('description', $request->get('newEvent'));
            }

            if ($add) {
                if (!empty($cf_1482)) {
                    $recordModel->set('description', $recordModel->get('description') . ' ' . implode('. ', $cf_1482));

                }
                $addOldEvent = '';
                if (!empty($cf_1484)) {
                    $addOldEvent .= 'Вопрос туриста: ' . $cf_1484 . "\n";
                }
                if (!empty($cf_1486)) {
                    $addOldEvent .= 'Ответ менеджера: ' . $cf_1486;
                }
                if ($addOldEvent != '') {
                    $recordModel->set('description', $recordModel->get('description') . "\n" . $addOldEvent);
                }

            }
            $parent_id = $request->get('record');
            $recordModel->set('parent_id', $request->get('record'));
            if ($parent_id > 0) {
                $leads = Vtiger_Record_Model::getInstanceById($parent_id);
                $recordModel->set('assigned_user_id', $leads->get('assigned_user_id'));
            }

            $_REQUEST['set_reminder'] = 'No';

            $recordModel->save();

            $loadUrl = 'index.php?module=Calendar&view=List';
            header("Location: $loadUrl");
            exit();
        } else if ($request->get('eventstatus') == 'Продажа') {
            $id = ($request->get('leadsource') > 0) ? $request->get('leadsource') : $this->recordLeads;
            $loadUrl = "index.php?module=Potentials&view=Edit&leadsource=" . $id;
            header("Location: $loadUrl");
            exit();
        } else if ($request->get('redirect') == 'Leads') {
            $loadUrl = "index.php?module=Leads&view=Detail&mod=read2&record=" . $id;
        } else {
            $loadUrl = 'index.php?module=Calendar&view=List';
            header("Location: $loadUrl");
            exit();
        }

    }

    public function saveEvent($request, $recordid)
    {
        $moduleName = 'Events';
        $array_status = array('Не оставил номер', 'Заявка для туриста неактуальна', 'Турист не планировал отдых', 'Прилетел - Еще не планировал отдых', 'Завершение встречи без закрытия возражения');
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        if (empty($recordid)) {
            $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
            $modelData = $recordModel->getData();
            $recordModel->set('mode', '');

            $fieldModelList = $moduleModel->getFields();
            foreach ($fieldModelList as $fieldName => $fieldModel) {
                if ($fieldName == 'subject') {
                    $fieldValue = 'Задача к заявке';
                } else if ($fieldName == 'eventstatus') {
                    if ($request->get('leadstatus') == 'Не оставил номер') {
                        $fieldValue = 'Отказ';
                    } elseif ($request->get('leadstatus') == 'Отказ') {
                        $fieldValue = 'Отказ';
                    } elseif ($request->get('leadstatus') == 'Заявка для туриста неактуальна') {
                        $fieldValue = 'Отказ';
                    } else if ($request->get('leadstatus') == 'Прилетел - Еще не планировал отдых') {
                        $fieldValue = 'Отказ';
                    } else if ($request->get('leadstatus') == 'Турист не планировал отдых') {
                        $fieldValue = 'Отказ';
                    } else if ($request->get('leadstatus') == 'Завершение встречи без закрытия возражения') {
                        $fieldValue = 'Отказ';
                    } else if ($request->get('leadstatus') == 'Продажа') {
                        $fieldValue = 'Продажа';
                    } else {
                        $fieldValue = 'Новая';
                    }
                } else if ($fieldName == 'activitytype') {
                    $fieldValue = 'Заявка';
                } else if ($fieldName == 'description') {

                    $fieldValue = implode(' ', $request->get('cf_1103', null));

                } else if ($fieldName == 'cf_1085') {
                    if (in_array($request->get('leadstatus'), $array_status)) {
                        $fieldValue = $request->get('leadstatus');
                    } else {
                        $fieldValue = $request->get($fieldName, null);
                    }
                } else if ($fieldName == 'parent_id') {
                    $fieldValue = $this->recordLeads;
                } else {
                    $fieldValue = $request->get($fieldName, null);
                }
                // For custom time fields in Calendar, it was not converting to db insert format(sending as 10:00 AM/PM)
                $fieldDataType = $fieldModel->getFieldDataType();
                if ($fieldDataType == 'time') {
                    $fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
                }
                // End
                if ($fieldValue !== null) {
                    if (!is_array($fieldValue)) {
                        $fieldValue = trim($fieldValue);
                    }
                    $recordModel->set($fieldName, $fieldValue);
                }
            }

            //Start Date and Time values

            $startTime = Vtiger_Time_UIType::getTimeValueWithSeconds($request->get('time_start'));

            $startDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue($request->get('date_start') . " " . $startTime);

            if ($request->get('leadstatus') == 'Не оставил номер' || $request->get('leadstatus') == 'Прилетел - Еще не планировал отдых' || $request->get('leadstatus') == 'Турист не планировал отдых' || $request->get('leadstatus') == 'Отказ' || $request->get('leadstatus') == 'Продажа' || $request->get('leadstatus') == 'Заявка для туриста неактуальна' || $request->get('leadstatus') == 'Завершение встречи без закрытия возражения') {
                $startTime = Vtiger_Time_UIType::getTimeValueWithSeconds(date('H:i'));
                $startDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue(date('Y-m-d') . " " . $startTime);
            }
            list($startDate, $startTime) = explode(' ', $startDateTime);

            $recordModel->set('date_start', $startDate);
            $recordModel->set('time_start', $startTime);

            //End Date and Time values
            $endTime = $request->get('time_start');
            $endDate = Vtiger_Date_UIType::getDBInsertedValue($request->get('date_start'));
            if ($request->get('leadstatus') == 'Не оставил номер' || $request->get('leadstatus') == 'Прилетел - Еще не планировал отдых' || $request->get('leadstatus') == 'Турист не планировал отдых' || $request->get('leadstatus') == 'Отказ' || $request->get('leadstatus') == 'Продажа' || $request->get('leadstatus') == 'Заявка для туриста неактуальна' || $request->get('leadstatus') == 'Завершение встречи без закрытия возражения') {
                $endTime = date('H:i');
                $endDate = Vtiger_Date_UIType::getDBInsertedValue(date('Y-m-d'));
            }

            if ($endTime) {
                $endTime = Vtiger_Time_UIType::getTimeValueWithSeconds($endTime);
                $endDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue($endDate . " " . $endTime);
                list($endDate, $endTime) = explode(' ', $endDateTime);
            }

            $recordModel->set('time_end', $endTime);
            $recordModel->set('due_date', $endDate);
            $recordModel->set('visibility', 'Private');

            $_REQUEST['set_reminder'] = 'No';
            $add = true;
            $cf_1482 = $request->get('cf_1482');
            $cf_1484 = $request->get('cf_1484');
            $cf_1486 = $request->get('cf_1486');

            if ($add) {
                if (!empty($cf_1482)) {
                    $recordModel->set('description', $recordModel->get('description') . ' ' . implode('. ', $cf_1482));

                }
                $addOldEvent = '';
                if (!empty($cf_1484)) {
                    $addOldEvent .= 'Вопрос туриста: ' . $cf_1484 . "\n";
                }
                if (!empty($cf_1486)) {
                    $addOldEvent .= 'Ответ менеджера: ' . $cf_1486;
                }
                if ($addOldEvent != '') {
                    $recordModel->set('description', $recordModel->get('description') . "\n" . $addOldEvent);
                }

            }
            $recordModel->set('duration_hours', 0);
            $recordModel->set('duration_minutes', 0);
            $recordModel->save();
        }
        return;

    }

    public function validateRequest(Vtiger_Request $request)
    {

    }
}
