<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Leads_Detail_View extends Accounts_Detail_View {
            function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$recordId = $request->get('record');
                $read = $request->get('mod');
                
		$recordPermission = Users_Privileges_Model::isPermitted($moduleName, 'DetailView', $recordId);
		if(!$recordPermission && $read!='read' && $read!='read2') {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
                
		return true;
	}
	    function preProcess (Vtiger_Request $request){
            global $current_user;
            $recordId = $request->get('record');
            $recordModel = Vtiger_Record_Model::getInstanceById($recordId);
            $viewer = $this->getViewer($request);
            $error = $recordModel->getErrors();
            if ($current_user->id != $recordModel->get('assigned_user_id')){
                $viewer->assign('ERRORBUTTON', true);
            }
            if (count($error) > 0 ){

                $viewer->assign('ERROREDIT', true);
            }
            parent::preProcess($request);
        }
        function process(Vtiger_Request $request) {
                global $current_user;
                $recordId = $request->get('record');
		$recordModel = Vtiger_Record_Model::getInstanceById($recordId);
                $read = $request->get('mod');
                if ($read == 'read'){
                    $viewer = $this->getViewer($request);
                    $viewer->assign('READONLY', 1);
                }
                elseif ($read == 'read2'){
                    $viewer = $this->getViewer($request);
                    $viewer->assign('READONLY', 2);
                }
                else {
                    $viewer = $this->getViewer($request);
                    $viewer->assign('READONLY', 0);
                }
                // $leadsource = array('ВКонтакте'=>'ВКонтакте','Фейсбук'=>'Фейсбук','Одноклассники'=>'Одноклассники', 'Инстаграмм'=>'Инстаграмм');
                $leadsorce = $recordModel->get('leadsource');
                if (in_array($leadsorce,$leadsource)){
                    $viewer->assign('MB', 1);
                    
                    $viewer->assign('leadsource', $leadsource);

                }
                $error = $recordModel->getErrors();
            //echo '<pre>';print_r($error);echo '</pre>';die;
                $viewer->assign('TYPEUSER', 'reader');

                if (count($error) > 0 ){

                    $assign_user_id = $recordModel->get('assigned_user_id');
                    //echo '<pre>';print_r($error);echo '</pre>';die;

                    if ($current_user->id == $assign_user_id){
                        $viewer->assign('TYPEUSER', 'owner');

                        if (!empty($error[0]['type_error']) && $error[0]['type_error'] == 'assign' ){
                           $viewer->assign('ERRORIN', $error[0]['errors']);


                        }
                    }
                    else {

                        $errorin = [];
                        $errorout = [];
                        //echo '<pre>';print_r($error);echo '</pre>';die;
                        foreach ($error as $_error){
                            if (!empty($_error['type_error']) && $_error['type_error'] == 'smowner' ){
                                $viewer->assign('TYPEUSER', 'smowner');
                            }
                            if (!empty($_error['type_error']) && $_error['type_error'] == 'smcreator' ){
                                $viewer->assign('TYPEUSER', 'smcreator');
                            }
                                $errorin[] = $_error['errors'];

                        }

                        $viewer->assign('ERRORIN', $errorin);
                        $viewer->assign('ERROROUT', $errorout);
                    }

                }
                parent::process($request);
        }
            function showRecentComments(Vtiger_Request $request) {
		$parentId = $request->get('record');
		$pageNumber = $request->get('page');
		$limit = 100000000;
		$moduleName = $request->getModule();

		if(empty($pageNumber)) {
			$pageNumber = 1;
		}

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $pageNumber);
		if(!empty($limit)) {
			$pagingModel->set('limit', $limit);
		}
                   if(!$this->record) {
				$this->record = Vtiger_DetailView_Model::getInstance($moduleName, $parentId);
			}
			$recordModel = $this->record->getRecord();
			$moduleModel = $recordModel->getModule();

			$recentComments = $moduleModel->getHelpdeskActivities('', $pagingModel, 'all', $parentId);
		//$recentComments = ModComments_Record_Model::getRecentComments($parentId, $pagingModel);
                //$recentComments = $this->getActivities($request);
                //echo '<pre>';print_r($recentComments);echo '</pre>';die();
		$pagingModel->calculatePageRange($recentComments);
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$modCommentsModel = Vtiger_Module_Model::getInstance('ModComments');
                //echo '<pre>';print_r($recentComments);echo '</pre>';die();
		$viewer = $this->getViewer($request);
		$viewer->assign('COMMENTS', $recentComments);
		$viewer->assign('CURRENTUSER', $currentUserModel);
		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('PAGING_MODEL', $pagingModel);
		$viewer->assign('COMMENTS_MODULE_MODEL', $modCommentsModel);

		return $viewer->view('RecentComments.tpl', $moduleName, 'true');
	}
       
}
