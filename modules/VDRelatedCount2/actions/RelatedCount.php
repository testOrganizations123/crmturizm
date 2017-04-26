<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/


class VDRelatedCount2_RelatedCount_Action extends Vtiger_Action_Controller {
	
    function checkPermission(Vtiger_Request $request) {
		
	}
    function process(Vtiger_Request $request) {
        $data = $request->get('data');
        $moduleName = $data['module'];
        $parentId = $data['record'];
        $modules = $data['data'];
        $request->setGlobal('record', $parentId);
		$request->setGlobal('module', $moduleName);
        $pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page','');
        $pagingModel->set('limit',100);
        $parentRecordModel = Vtiger_Record_Model::getInstanceById($parentId, $moduleName);
        $result = array();
        foreach ($modules as $module){
            $relatedModuleName = $module['relatedModule'];
            if ($relatedModuleName == 'ProjectTask') {
                $result[$module['number']] = $this->getProjectTaskCount($parentId);
            }
            else  if ($relatedModuleName == 'ProjectMilestone') {
                $result[$module['number']] = $this->getProjectMilestoneCount($parentId);
            }
            else {
                $label = $module['tab_label'];
                $request->setGlobal('tab_label', $label);
                $relationListView = Vtiger_RelationListView_Model::getInstance($parentRecordModel, $relatedModuleName, $label);
                $list = $relationListView->getEntries($pagingModel);
                if ($relatedModuleName == $moduleName){
                    if(isset($list[$parentId])){
                     unset($list[$parentId]);
                    }
                
            }
                $result[$module['number']] = count($list);
            }
            
        }
		$result['history'] = $this->getHistoryCount($parentId);
        $result['comment'] = $this->getCommentCount($parentId);
        $response = new Vtiger_Response();
        $response->setResult($result);
        $response->emit();
        
    }
	public function getHistoryCount($parentId){
        global $adb;
        $result = $adb->pquery('Select count(id) as a from vtiger_modtracker_basic where crmid = ? LIMIT 100', array($parentId));
        return $adb->query_result($result,0,'a');
    }
    public function getCommentCount($parentId){
        global $adb;
        $result = $adb->pquery('Select count(modcommentsid) as a from vtiger_modcomments where related_to = ? LIMIT 100', array($parentId));
        return $adb->query_result($result,0,'a');
    }
    public function getProjectTaskCount($parentId){
        global $adb;
        $result = $adb->pquery('Select count(projecttaskid) as a from vtiger_projecttask LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_projecttask.projecttaskid where vtiger_crmentity.deleted=0 and projectid = ? LIMIT 100', array($parentId));
        return $adb->query_result($result,0,'a');
    }
    public function getProjectMilestoneCount($parentId){
        global $adb;
        $result = $adb->pquery('Select count(projectmilestoneid) as a from vtiger_projectmilestone LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_projectmilestone.projectmilestoneid where vtiger_crmentity.deleted=0 and  projectid = ? LIMIT 100', array($parentId));
        return $adb->query_result($result,0,'a');
    }
}