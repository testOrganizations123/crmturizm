<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class VDDialogueDesigner_RunScript_View extends Vtiger_Detail_View {
    public function preProcess(Vtiger_Request $request) {
            parent::preProcess($request, false);
            $moduleName = $request->getModule();
            $viewer = $this->getViewer ($request);
            
            $viewer->view('ListScriptPreProcess.tpl', $moduleName);
    }    
    public function process(Vtiger_Request $request) {
             $moduleName = $request->getModule();
             $record = $request->get('record');
             $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
             
             $potentialid = $request->get('potentialid');
              $leadid = $request->get('leadid');
             ##firstname## , под Ваш запрос ##hotel## в ##country## едут взрослых ##adults## , детей ##children## (##childrenyear##) c ##departure## по ##arrival## на ##night##  
             $viewer = $this->getViewer ($request);
             $viewer->assign('CONTACT',false);
              if ($potentialid){
                  $contact = $this->getPotencial($potentialid);
                  $moduleModel->inputs['departure_old'] = $contact['cf_1217'];
                  $moduleModel->inputs['country_old'] = $contact['country_name'];
                  $moduleModel->inputs['hotel_old'] = $contact['cf_1193'];
                  $moduleModel->inputs['firstname'] = $contact['firstname'].' '.$contact['midlename'];
                 
                  $moduleModel->inputs['potentialid'] = $potentialid;
                 
                  $viewer->assign('potentialid',$potentialid);
                 $viewer->assign('CONTACT',$this->getPotencial($potentialid));
             } 
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
             $recordModel = $moduleModel->getSrciptStepModel($record);
              $viewer->assign('EXPRESS',$request->get('express'));
             $viewer->assign('RECORD',$record);
             $viewer->assign('RECORD_MODEL',$recordModel);
             $viewer->assign('MODULE',$moduleName);
             $viewer->assign('MODULE_MODEL',$moduleModel);
             $viewer->view('RunScript.tpl',$moduleName);
    }
    public function getPotencial($potentialid){
        global $adb;
        $sql = "SELECT p.*, pc.*, c.*, lc.country_name, lr.resort, lt.turoperator_name FROM vtiger_potential as p"
                . " LEFT JOIN vtiger_potentialscf as pc ON pc.potentialid = p.potentialid "
                . 'LEFT JOIN vtiger_contactdetails as c ON c.contactid = p.contact_id '
                . 'LEFT JOIN vtiger_listcountry as lc ON lc.listcountryid = pc.cf_1165 '
                . 'LEFT JOIN vtiger_listresorts as lr ON lr.listresortsid = pc.cf_1167 '
                . 'LEFT JOIN vtiger_listtouroperators as lt ON lt.listtouroperatorsid = pc.cf_1163 '
                . "WHERE p.potentialid = ?";
      
        $result = $adb->pquery($sql, array($potentialid));
        return $adb->query_result_rowdata($result,0);
    }
    public function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			
			"modules.$moduleName.resources.Runscript",
			
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}
}