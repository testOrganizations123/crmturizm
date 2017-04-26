<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
ini_set('display_errors',1);
error_reporting(E_ERROR);
class VDDialogueDesigner_Script_Action extends Vtiger_Action_Controller 
{
    public $moduleName = 'VDDialogueDesigner';
   
    function __construct() {
        parent::__construct();
        $this->exposeMethod('TypeAnswer');
        $this->exposeMethod('RunScript');
        $this->exposeMethod('RunScriptSearch');
    }
     public function checkPermission(Vtiger_Request $request) {
            
    }
	public function process(Vtiger_Request $request) {
                
                $mode = $request->get('mode');
		if (!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			
		}
        return;
    }
    function RunScriptSearch (Vtiger_Request $request){
        $moduleName = $request->getModule();
            $record = $request->get('record');
            $backstep = $request->get('backstep');
            $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
            $moduleModel->inputs = $request->get('inputs');
            $recordModel = $moduleModel->getSrciptStepModel($record);
            if (!empty($moduleModel->inputs['description'])){
                $moduleModel->inputs['description'] = preg_replace("/(\n)/", " ", $moduleModel->inputs['description']);
            }
            $index = $request->get('index');
            if (!empty($index)){
                $record = $record.'-'.$index;
            }
            $searchResult = $this->search($request);
            $viewer = new Vtiger_Viewer();
            $viewer->assign('RECORD',$record);
            $viewer->assign('backstep',$backstep);
            $viewer->assign('RECORD_MODEL',$recordModel);
            $viewer->assign('MODULE',$moduleName);
            $viewer->assign('SEARCHRESULT',$searchResult);
            $viewer->assign('MODULE_MODEL',$moduleModel);
            $viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
            $viewer->assign('clientAnswer', $this->getClientAnswer($request));
            header("Content-Type: application/json");
            header("Cache-Control: no-cache");
            header("Pragma: no-cache");
            $viewer->view('RunScriptAjaxSearch.tpl',$moduleName);
        
    }
    function search(Vtiger_Request $request){
        global $current_user, $adb;
        $input = $request->get('input');
        $mobile = $input['mobile'];
        $list = array();
        if (!empty($mobile)){
            $city = $this->getCityOffice();
            if(!empty($city)){
                $city = " and of.city = '$city'";
            }
            $sql = "SELECT concat (ut.first_name, ' ', ut.last_name) as owner, concat (us.first_name, ' ', us.last_name) as oldowner, vtiger_crmentity.description, vtiger_leadaddress.*, vtiger_leaddetails.*, vtiger_leadscf.*, vtiger_crmentity.smownerid, vtiger_activity.status, CASE WHEN (vtiger_activity.status not like '') THEN vtiger_activity.status ELSE vtiger_activity.eventstatus END AS status, vtiger_activity.activitytype, vtiger_activity.subject, vtiger_seactivityrel.crmid, vtiger_crmentity.modifiedtime, vtiger_activity.due_date, vtiger_activity.time_end, vtiger_crmentity.createdtime, crm.createdtime as datecreate, vtiger_activity.priority, vtiger_activity.activityid, vtiger_activity.visibility FROM vtiger_activity INNER JOIN vtiger_crmentity ON vtiger_activity.activityid = vtiger_crmentity.crmid LEFT JOIN vtiger_users ON vtiger_crmentity.smownerid = vtiger_users.id LEFT JOIN vtiger_groups ON vtiger_crmentity.smownerid = vtiger_groups.groupid LEFT JOIN vtiger_seactivityrel ON vtiger_activity.activityid = vtiger_seactivityrel.activityid LEFT JOIN vtiger_leaddetails ON vtiger_leaddetails.leadid = vtiger_seactivityrel.crmid LEFT JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_seactivityrel.crmid LEFT JOIN vtiger_leadscf ON vtiger_leadscf.leadid = vtiger_seactivityrel.crmid LEFT JOIN vtiger_crmentity as crm ON crm.crmid = vtiger_seactivityrel.crmid LEFT JOIN transfer_manager as t ON t.crmid = vtiger_seactivityrel.crmid and t.status = 2 and t.newowner = vtiger_crmentity.smownerid LEFT JOIN vtiger_users as us ON us.id = t.oldowner LEFT JOIN vtiger_users as ut ON ut.id = vtiger_crmentity.smownerid LEFT JOIN vtiger_office as of ON of.officeid = ut.office WHERE (crm.deleted=0 or crm.deleted is NULL) and (vtiger_activity.activitytype != 'Экспресс заявка' and vtiger_activity.activitytype != 'Обзвон туристов' ) and vtiger_leadaddress.mobile = ? and (vtiger_activity.eventstatus = 'Planned' or vtiger_activity.eventstatus = 'Новая') $city ORDER BY vtiger_activity.activityid DESC";
            $result = $adb->pquery($sql, array($mobile));
            $numRows = $adb->num_rows($result);
            
            for ($i=0;$i<$numRows;$i++){
                $list[] = $adb->query_result_rowdata($result, $i);
            }
            return $list;
        }
        return $list;
    }
    function getCityOffice(){
            global $current_user, $adb;
            $office_id = $current_user->office;
           
            if ($office_id > 0){
                $sql = "SELECT city FROM vtiger_office WHERE officeid = ?";
                $result = $adb->pquery($sql, array($office_id));
                return $adb->query_result($result,0,'city');
            }
            return false;
            
        }
    function RunScript(Vtiger_Request $request){
            $moduleName = $request->getModule();
            $record = $request->get('record');
            $backstep = $request->get('backstep');
            $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
             $viewer = new Vtiger_Viewer();
             $leadid = $request->get('leadid');
              $inputs = $request->get('inputs');
             
             if ($leadid){
                 $lead = Vtiger_Record_Model::getInstanceById($leadid);
                 $moduleModel->inputs['firstname'] = $lead->get('firstname');
                 $moduleModel->inputs['mobile'] = $lead->get('mobile');
                 $moduleModel->inputs['hotel'] = $lead->get('hotel');
                 $moduleModel->inputs['country'] = $lead->get('country');
                 $moduleModel->inputs['adults'] = $lead->get('adults');
                 $moduleModel->inputs['children'] = $lead->get('children');
                 $moduleModel->inputs['childrenyear'] = $lead->get('childrenyear');
                 $moduleModel->inputs['departure'] = $lead->get('departure');
                  $moduleModel->inputs['arrival'] = $lead->get('arrival');
                   $moduleModel->inputs['night'] = $lead->get('night');
                   $moduleModel->inputs['record'] = $lead->getid();
                   $request->set('inputs', $moduleModel->inputs);
                   $viewer->assign('hideinput',true);
                   
                 
             }
             
             foreach ($inputs as $key=>$value){
                 if (!empty($value)){
                    
                 $moduleModel->inputs[$key] = $value;
                 }
             }
           
            
            $recordModel = $moduleModel->getSrciptStepModel($record);
            if (!empty($moduleModel->inputs['description'])){
                $moduleModel->inputs['description'] = preg_replace("/(\n)/", " ", $moduleModel->inputs['description']);
            }
            
            $index = $request->get('index');
            if (!empty($index)){
                $record = $record.'-'.$index;
            }
           // echo '<pre>';print_r($recordModel);echo '</pre>';die();
            $viewer->assign('RECORD',$record);
            $viewer->assign('backstep',$backstep);
            $viewer->assign('RECORD_MODEL',$recordModel);
            $viewer->assign('MODULE',$moduleName);
            $viewer->assign('MODULE_MODEL',$moduleModel);
             $viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
            $viewer->assign('clientAnswer', $this->getClientAnswer($request));
            header("Content-Type: application/json");
            header("Cache-Control: no-cache");
            header("Pragma: no-cache");
            $viewer->view('RunScriptAjax.tpl',$moduleName);
			
    }
    function getClientAnswer($request){
            $input = $request->get('input');
            $array = array();
            if (count($input)>2){
                foreach ($input as $key=>$value){
                    if (strpos($key, 'label-') === false){
                        if (!empty($value)){
                            $array[$key] = str_replace('	', ' ', htmlentities($input['label-'.$key].' - '. preg_replace("/(\n)/", " ", $value), ENT_QUOTES));
                        }
                    }
                }
            }
            else {
                foreach ($input as $key=>$value){
                    if (strpos($key, 'label-') === false){
                        $array[$key] =  str_replace('	', ' ', htmlentities(preg_replace("/(\n)/", " ", $value), ENT_QUOTES));
                    }
                }
            }
            
            return implode('. ', $array);
            
    }
    function TypeAnswer(Vtiger_Request $request){
        
        $value = $request->get('value');
        switch ($value){
            case 'String':$this->TypeAnswerStrintg($request); break;
            case 'LongString':$this->TypeAnswerStrintg($request); break;
            case 'Buttons':$this->TypeAnswerButtons($request); break;
            case 'Module':$this->TypeAnswerModule($request); break;
            case 'Search':$this->TypeAnswerModule($request); break;
            case 'ModuleDefault':$this->TypeAnswerModuleDefault($request); break;
            case 'ModuleButtons':$this->TypeAnswerModuleButtons($request); break;
            case 'getModuleFields':$this->getModuleFields($request); break;
            case 'getModuleFieldsDefault':$this->getModuleFieldsDefault($request); break;
            
        }
    }
    public function TypeAnswerStrintg(Vtiger_Request $request){
        $moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);
        $viewer = new Vtiger_Viewer();
        $viewer->assign('MODULE', $this->moduleName);
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('FIELDS', array());
        $viewer->assign('i', 1);
        $viewer->view('uitypes/TypeAnswerString.tpl', $this->moduleName);
    }
    public function TypeAnswerButtons(Vtiger_Request $request){
        $moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);
        $current_button = $request->get('current_button')+1;
        $viewer = new Vtiger_Viewer();
        $viewer->assign('MODULE', $this->moduleName);
         $viewer->assign('i', $current_button);
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
        $fields = $this->getFieldValue();
        $viewer->assign('FIELDS', $fields);
        $viewer->view('uitypes/TypeAnswerButtons.tpl', $this->moduleName);
    }
    public function TypeAnswerModuleButtons($request) {
        $moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);
        $current_button = $request->get('current_button')+1;
        $viewer = new Vtiger_Viewer();
        $viewer->assign('i', $current_button);
        $viewer->assign('MODULE', $this->moduleName);
        $viewer->assign('MODULELIST', $moduleModel->getSupportedModules());
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
        $fields = $this->getFieldValue();
        $viewer->assign('FIELDS', $fields);
        $viewer->view('uitypes/TypeAnswerModuleButtons.tpl', $this->moduleName);
    }
    public function TypeAnswerModule($request) {
        $moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);
        $current_button = $request->get('current_button')+1;
        $viewer = new Vtiger_Viewer();
        $viewer->assign('MODULE', $this->moduleName);
        $viewer->assign('MODULELIST', $moduleModel->getSupportedModules());
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
        $fields = $this->getFieldValue();
        $viewer->assign('FIELDS', $fields);
        $viewer->view('uitypes/TypeAnswerModule.tpl', $this->moduleName);
    }
    public function TypeAnswerModuleDefault($request) {
        $moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);
        $current_button = $request->get('current_button')+1;
        $viewer = new Vtiger_Viewer();
        $viewer->assign('MODULE', $this->moduleName);
        $viewer->assign('MODULELIST', $moduleModel->getSupportedModules());
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
        $fields = $this->getFieldValue();
        $viewer->assign('FIELDS', $fields);
        $viewer->view('uitypes/TypeAnswerModuleDefault.tpl', $this->moduleName);
    }
    public function getModuleFields($request) {
        $moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);
        $relatedModule = $request->get('relatedModule');
        $key = $request->get('current');
        $viewer = new Vtiger_Viewer();
        $viewer->assign('MODULE', $this->moduleName);
        $recordStructure = new VDDialogueDesigner_EditRecordStructure_Model();
        $viewer->assign('RELATED_MODULE', $relatedModule);
        $viewer->assign('MODULE_RECORD_STRUCTURE', $recordStructure->getStructurer($relatedModule));
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('KEY', $key);
        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
        
        $viewer->view('uitypes/TypeAnswerModuleFields.tpl', $this->moduleName);
    }
     public function getModuleFieldsDefault($request) {
        $moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);
        $relatedModule = $request->get('relatedModule');
        $key = $request->get('current');
        $viewer = new Vtiger_Viewer();
        $viewer->assign('MODULE', $this->moduleName);
        $recordStructure = new VDDialogueDesigner_EditRecordStructure_Model();
        $viewer->assign('RELATED_MODULE', $relatedModule);
        $viewer->assign('MODULE_RECORD_STRUCTURE', $recordStructure->getStructurer($relatedModule));
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('KEY', $key);
        $viewer->assign('RECORD_STRUCTURE_MODEL', new VDDialogueDesigner_EditRecordStructure_Model());
        
        $viewer->view('uitypes/TypeAnswerModuleFieldsDefault.tpl', $this->moduleName);
    }
    public function getFieldValue(){
        $field = new stdClass();
        $field->name = 'NextStep';
        $field->value = 2;
        $field->info->mandatory = false;
        $field->info->presence = true;
        $field->info->presence = true;
        $field->info->quickcreate = true;
        $field->info->masseditable = true;
        $field->info->defaultvalue = false;
        $field->info->type = "reference";
        $field->info->name = "nextstep";
        return $field;
    }
}