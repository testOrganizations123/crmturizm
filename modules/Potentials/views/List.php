<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class Potentials_List_View extends Vtiger_List_View {
    public $statbron = false;
	function preProcess(Vtiger_Request $request, $display=true) {
		parent::preProcess($request, false);

		$viewer = $this->getViewer ($request);
		$moduleName = $request->getModule();

		$listViewModel = Vtiger_ListView_Model::getInstance($moduleName);
		$linkParams = array('MODULE'=>$moduleName, 'ACTION'=>$request->get('view'));
		$viewer->assign('CUSTOM_VIEWS', CustomView_Record_Model::getAllByGroup($moduleName));
		$this->viewName = $request->get('viewname');
		

		$quickLinkModels = $listViewModel->getSideBarLinks($linkParams);
		$viewer->assign('QUICK_LINKS', $quickLinkModels);
		$this->initializeListViewContents($request, $viewer);
		$viewer->assign('VIEWID', $this->viewName);

		if($display) {
			$this->preProcessDisplay($request);
		}
	}
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();
               
                 unset($headerScriptInstances['modules.Potentials.resources.Edit']);
              
		return $headerScriptInstances;
	}
        function process (Vtiger_Request $request) {
		$viewer = $this->getViewer ($request);
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$this->viewName = $request->get('viewname');
               
                
		$this->initializeListViewContents($request, $viewer);
		$viewer->assign('VIEW', $request->get('view'));
               
                $viewer->assign('statbron', $this->statbron);
		$viewer->assign('MODULE_MODEL', $moduleModel);
		$viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->view('ListViewContents.tpl', $moduleName);
	}
        public function initializeListViewContents(Vtiger_Request $request, Vtiger_Viewer $viewer) {
            global $current_user;
            $moduleName = $request->getModule();
		$cvId = $this->viewName;
		$pageNumber = $request->get('page');
		$orderBy = $request->get('orderby');
		$sortOrder = $request->get('sortorder');
		if($sortOrder == "ASC"){
			$nextSortOrder = "DESC";
			$sortImage = "icon-chevron-down";
		}else{
			$nextSortOrder = "ASC";
			$sortImage = "icon-chevron-up";
		}

		if(empty ($pageNumber)){
			$pageNumber = '1';
		}

		$listViewModel = Vtiger_ListView_Model::getInstance($moduleName, $cvId);
		$currentUser = Users_Record_Model::getCurrentUserModel();

		$linkParams = array('MODULE'=>$moduleName, 'ACTION'=>$request->get('view'), 'CVID'=>$cvId);
		$linkModels = $listViewModel->getListViewMassActions($linkParams);

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $pageNumber);
		$pagingModel->set('viewid', $request->get('viewname'));

		if(!empty($orderBy)) {
			$listViewModel->set('orderby', $orderBy);
			$listViewModel->set('sortorder',$sortOrder);
		}

		$searchKey = $request->get('search_key');
		$searchValue = $request->get('search_value');
		$operator = $request->get('operator');
		if(!empty($operator)) {
			$listViewModel->set('operator', $operator);
			$viewer->assign('OPERATOR',$operator);
			$viewer->assign('ALPHABET_VALUE',$searchValue);
		}
		if(!empty($searchKey) && !empty($searchValue)) {
			$listViewModel->set('search_key', $searchKey);
			$listViewModel->set('search_value', $searchValue);
		}

        $searchParmams = $request->get('search_params');
         
        if ($moduleName == 'Potentials'){
           $db = PearDatabase::getInstance();
           $sql = "SELECT * FROM vtiger_role WHERE roleid = ? ";
           $result = $db->pquery($sql, array($current_user->roleid));
           
           if (count(explode('::',$db->query_result($result,0,'parentrole')))>4){
              
            $office_id = $currentUser->get('office');
            
           
            $sql = 'SELECT * FROM vtiger_office WHERE officeid = ?';
            $result = $db->pquery($sql, array($office_id));
            if($result){
                $office = $db->query_result($result, 0, 'office');
                if (!empty($office)){
                    if(empty($searchParmams)){
                        $searchParmams[][] = array('office','c',html_entity_decode($office));
                         
                    }
                    else {
                        $add = true;
                        foreach ($searchParmams[0] as $key=>$value){
                            if ($value[0] == 'office'){
                               $searchParmams[0][$key] = array('office','c',  html_entity_decode($office));
                                $add = false;
                                continue;
                            }
                        }
                        if ($add){
                            $searchParmams[0][] = array('office','c',  html_entity_decode($office));
                        }
                    }
                    
                }
            }
           }
        } 
       
        if(empty($searchParmams)) {
            $searchParmams = array();
        }
        $searchParmams = $this->SearchStatbronTest($searchParmams);
        $searchParmams = $this->SearchMobileTest($searchParmams);
        $transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParmams, $listViewModel->getModule());
        $listViewModel->set('search_params',$transformedSearchParams);


        //To make smarty to get the details easily accesible
        foreach($searchParmams as $fieldListGroup){
            foreach($fieldListGroup as $fieldSearchInfo){
                $fieldSearchInfo['searchValue'] = $fieldSearchInfo[2];
                $fieldSearchInfo['fieldName'] = $fieldName = $fieldSearchInfo[0];
                $searchParmams[$fieldName] = $fieldSearchInfo;
			}
		}


		if(!$this->listViewHeaders){
			$this->listViewHeaders = $listViewModel->getListViewHeaders();
		}
		if(!$this->listViewEntries){
			$this->listViewEntries = $listViewModel->getListViewEntries($pagingModel, $this->statbron, $this->mobile);
		}
		$noOfEntries = count($this->listViewEntries);

		$viewer->assign('MODULE', $moduleName);

		if(!$this->listViewLinks){
			$this->listViewLinks = $listViewModel->getListViewLinks($linkParams);
		}
		$viewer->assign('LISTVIEW_LINKS', $this->listViewLinks);

		$viewer->assign('LISTVIEW_MASSACTIONS', $linkModels['LISTVIEWMASSACTION']);

		$viewer->assign('PAGING_MODEL', $pagingModel);
		$viewer->assign('PAGE_NUMBER',$pageNumber);

		$viewer->assign('ORDER_BY',$orderBy);
		$viewer->assign('SORT_ORDER',$sortOrder);
		$viewer->assign('NEXT_SORT_ORDER',$nextSortOrder);
		$viewer->assign('SORT_IMAGE',$sortImage);
		$viewer->assign('COLUMN_NAME',$orderBy);

		$viewer->assign('LISTVIEW_ENTRIES_COUNT',$noOfEntries);
		$viewer->assign('LISTVIEW_HEADERS', $this->listViewHeaders);
		$viewer->assign('LISTVIEW_ENTRIES', $this->listViewEntries);

		if (PerformancePrefs::getBoolean('LISTVIEW_COMPUTE_PAGE_COUNT', false)) {
			if(!$this->listViewCount){
				$this->listViewCount = $listViewModel->getListViewCount();
			}
			$totalCount = $this->listViewCount;
			$pageLimit = $pagingModel->getPageLimit();
			$pageCount = ceil((int) $totalCount / (int) $pageLimit);

			if($pageCount == 0){
				$pageCount = 1;
			}
			$viewer->assign('PAGE_COUNT', $pageCount);
			$viewer->assign('LISTVIEW_COUNT', $totalCount);
		}
		$viewer->assign('LIST_VIEW_MODEL', $listViewModel);
		$viewer->assign('GROUPS_IDS', Vtiger_Util_Helper::getGroupsIdsForUsers($currentUser->getId()));
		$viewer->assign('IS_MODULE_EDITABLE', $listViewModel->getModule()->isPermitted('EditView'));
		$viewer->assign('IS_MODULE_DELETABLE', $listViewModel->getModule()->isPermitted('Delete'));
        $viewer->assign('SEARCH_DETAILS', $searchParmams);
	}

        function SearchStatbronTest($searchParmams){
             //echo '<pre>';print_r ($searchParmams);
            foreach($searchParmams as $key=>$value){
                if (is_array($value)){
                    $unset = $this->_SearchStatbronTest($value);
                    $searchParmams[$key] = $unset['param'];
                }
                
                
            }
            return $searchParmams;
        }
        function SearchMobileTest($searchParmams){
             //echo '<pre>';print_r ($searchParmams);
            foreach($searchParmams as $key=>$value){
                if (is_array($value)){
                    $unset = $this->_SearchMobileTest($value);
                    $searchParmams[$key] = $unset['param'];
                }
                
                
            }
            return $searchParmams;
        }
        function _SearchStatbronTest($searchParmams){
            $_is = false;
            $del = false;
            foreach($searchParmams as $key=>$value){
                if (is_array($value)){
                    
                    $unset = $this->_SearchStatbronTest($value);
                   //var_dump ($unset);
                    if ($unset['is']===true){
                       // var_dump ($key);
                        $del = $key;
                    }
                }
                else {
                    if($value == 'statbron'){
                        $_is = true;
                    }
                    if($key == 2 && $_is){
                        $this->statbron = $value;
                        
                    }
                }
            }
            if ($del !== false){
                unset($searchParmams[$del]);
            }
            return array('is'=>$_is, 'param'=>$searchParmams);
        }
	function _SearchMobileTest($searchParmams){
            $_is = false;
            $del = false;
            foreach($searchParmams as $key=>$value){
                if (is_array($value)){
                    
                    $unset = $this->_SearchMobileTest($value);
                   //var_dump ($unset);
                    if ($unset['is']===true){
                       // var_dump ($key);
                        $del = $key;
                    }
                }
                else {
                    if($value == 'mobile'){
                        $_is = true;
                    }
                    if($key == 2 && $_is){
                        $this->mobile = $value;
                        
                    }
                }
            }
            if ($del !== false){
                unset($searchParmams[$del]);
            }
            return array('is'=>$_is, 'param'=>$searchParmams);
        }
    
}