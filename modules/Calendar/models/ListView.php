<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * Vtiger ListView Model Class
 */
class Calendar_ListView_Model extends Vtiger_ListView_Model {


	public function getBasicLinks() {
		$basicLinks = array();
		$moduleModel = $this->getModule();
		$createPermission = Users_Privileges_Model::isPermitted($moduleModel->getName(), 'EditView');
		if($createPermission) {
			$basicLinks[] = array(
					'linktype' => 'LISTVIEWBASIC',
					'linklabel' => 'LBL_ADD_TASK',
					'linkurl' => $this->getModule()->getCreateEventRecordUrl(),
					'linkicon' => ''
			);

			$basicLinks[] = array(
					'linktype' => 'LISTVIEWBASIC',
					'linklabel' => 'Добавить Заявку',
					'linkurl' => 'index.php?module=VDDialogueDesigner&view=RunScript&record=51',
					'linkicon' => ''
			);
		}
		return $basicLinks;
	}


	/*
	 * Function to give advance links of a module
	 *	@RETURN array of advanced links
	 */
	public function getAdvancedLinks(){
		$moduleModel = $this->getModule();
		$createPermission = Users_Privileges_Model::isPermitted($moduleModel->getName(), 'EditView');
		$advancedLinks = array();
		$importPermission = Users_Privileges_Model::isPermitted($moduleModel->getName(), 'Import');
		if($importPermission && $createPermission) {
			$advancedLinks[] = array(
							'linktype' => 'LISTVIEW',
							'linklabel' => 'LBL_IMPORT',
							'linkurl' => 'javascript:Calendar_List_Js.triggerImportAction("'.$moduleModel->getImportUrl().'")',
							'linkicon' => ''
			);
		}

		$exportPermission = Users_Privileges_Model::isPermitted($moduleModel->getName(), 'Export');
		if($exportPermission) {
			$advancedLinks[] = array(
					'linktype' => 'LISTVIEW',
					'linklabel' => 'LBL_EXPORT',
					'linkurl' => 'javascript:Calendar_List_Js.triggerExportAction("'.$this->getModule()->getExportUrl().'")',
					'linkicon' => ''
				);
		}
		return $advancedLinks;
	}

	/**
	 * Function to get query to get List of records in the current page
	 * @return <String> query
	 */
	function getQuery() {
		$queryGenerator = $this->get('query_generator');
		// Added to remove emails from the calendar list
		$queryGenerator->addCondition('activitytype','Emails','n','AND');

		$listQuery = $queryGenerator->getQuery();
		return $listQuery;
	}


	/**
	 * Function to get the list of Mass actions for the module
	 * @param <Array> $linkParams
	 * @return <Array> - Associative array of Link type to List of  Vtiger_Link_Model instances for Mass Actions
	 */
	public function getListViewMassActions($linkParams) {
		$currentUserModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$moduleModel = $this->getModule();

		$linkTypes = array('LISTVIEWMASSACTION');
		$links = Vtiger_Link_Model::getAllByType($moduleModel->getId(), $linkTypes, $linkParams);


		$massActionLinks = array();
		if($currentUserModel->hasModuleActionPermission($moduleModel->getId(), 'EditView')) {
			$massActionLinks[] = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_CHANGE_OWNER',
				'linkurl' => 'javascript:Calendar_List_Js.triggerMassEdit("index.php?module='.$moduleModel->get('name').'&view=MassActionAjax&mode=showMassEditForm");',
				'linkicon' => ''
			);
		}
		if($currentUserModel->hasModuleActionPermission($moduleModel->getId(), 'Delete')) {
			$massActionLinks[] = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_DELETE',
				'linkurl' => 'javascript:Vtiger_List_Js.massDeleteRecords("index.php?module='.$moduleModel->get('name').'&action=MassDelete");',
				'linkicon' => ''
			);
		}

		foreach($massActionLinks as $massActionLink) {
			$links['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($massActionLink);
		}

		return $links;
	}
    
    /**
	 * Function to get the list view header
	 * @return <Array> - List of Vtiger_Field_Model instances
	 */
	public function getListViewHeaders() {
        $listViewContoller = $this->get('listview_controller');
        //echo '<pre>'; print_r(get_class($listViewContoller));die();
        $module = $this->getModule();
        $moduleName = $module->get('name');
		$headerFieldModels = array();
		$headerFields = $listViewContoller->getListViewHeaderFields();
		foreach($headerFields as $fieldName => $webserviceField) {
			if($webserviceField && !in_array($webserviceField->getPresence(), array(0,2))) continue;
            $fieldInstance = Vtiger_Field_Model::getInstance($fieldName,$module);
            if(!$fieldInstance) {
                if($moduleName == 'Calendar') {
                    $eventmodule = Vtiger_Module_Model::getInstance('Events');
                    $fieldInstance = Vtiger_Field_Model::getInstance($fieldName,$eventmodule);
                }
            }
			$headerFieldModels[$fieldName] = $fieldInstance;
		}
		return $headerFieldModels;
	}
    
    /**
	 * Function to get the list view entries
	 * @param Vtiger_Paging_Model $pagingModel
	 * @return <Array> - Associative array of record id mapped to Vtiger_Record_Model instance.
	 */
        public function getListExpressTask($mobile,$office) {
            global $current_user;
            $db = PearDatabase::getInstance();
            $moduleName = $this->getModule()->get('name');
            
		$moduleFocus = CRMEntity::getInstance($moduleName);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', 1);
		$pagingModel->set('viewid', '');
		$queryGenerator = $this->get('query_generator');
		$listViewContoller = $this->get('listview_controller');
		$listViewFields = array('visibility','assigned_user_id');
		$queryGenerator->setFields(array_unique(array_merge($queryGenerator->getFields(), $listViewFields)));
	$searchParams = array(
                    array( 
                        'columns'=>array(
                            array( 
                                'columnname' => 'vtiger_activity:status:taskstatus:Calendar_Status:V',
                                'comparator' => 'e',
                                'value' => 'Экспресс',
                                'column_condition' => '')))); 
       
         $glue = "";
        if(count($queryGenerator->getWhereFields()) > 0 && (count($searchParams)) > 0) {
            $glue = QueryGenerator::$AND;
        }
        $queryGenerator->parseAdvFilterList($searchParams, $glue);

		$searchKey = $this->get('search_key');
		$searchValue = $this->get('search_value');
		$operator = $this->get('operator');
		if(!empty($searchKey)) {
			$queryGenerator->addUserSearchConditions(array('search_field' => $searchKey, 'search_text' => $searchValue, 'operator' => $operator));
		}
        
        $orderBy = $this->getForSql('orderby');
		$sortOrder = $this->getForSql('sortorder');

		//List view will be displayed on recently created/modified records
		if(empty($orderBy) && empty($sortOrder) && $moduleName != "Users"){
			$orderBy = 'date_start';
			$sortOrder = 'ASC';
		}

        if(!empty($orderBy)){
            $columnFieldMapping = $moduleModel->getColumnFieldMapping();
            $orderByFieldName = $columnFieldMapping[$orderBy];
            $orderByFieldModel = $moduleModel->getField($orderByFieldName);
            if($orderByFieldModel && $orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::REFERENCE_TYPE){
                //IF it is reference add it in the where fields so that from clause will be having join of the table
                $queryGenerator = $this->get('query_generator');
                $queryGenerator->addWhereField($orderByFieldName);
                //$queryGenerator->whereFields[] = $orderByFieldName;
            }
        }
		if (!empty($orderBy) && $orderBy === 'smownerid') { 
			$fieldModel = Vtiger_Field_Model::getInstance('assigned_user_id', $moduleModel); 
			if ($fieldModel->getFieldDataType() == 'owner') { 
				$orderBy = 'COALESCE(CONCAT(vtiger_users.first_name,vtiger_users.last_name),vtiger_groups.groupname)'; 
			} 
		}
        //To combine date and time fields for sorting
        if($orderBy == 'date_start') {
            $orderBy = "str_to_date(concat(date_start,time_start),'%Y-%m-%d %H:%i:%s')";
        }else if($orderBy == 'due_date') {
            $orderBy = "str_to_date(concat(due_date,time_end),'%Y-%m-%d %H:%i:%s')";
        }

	$mobile_search = '';
        	
        $office_search = '';
        if (!empty($office)){
            $office_search = "and vtiger_users.office = $office";
        }
       
         if (!empty($mobile)){
            $mobile_search = "and vtiger_activitycf.cf_1117 ='$mobile'";
            $city = $this->getCityOffice($office);
            if (!empty($city)){
                $office_search = "and of.city = '$city'";
            }
           
        }
        $listQuery = $this->getQuery();
                
                $parseQuery = explode('WHERE', $listQuery);
                
                $listQuery = str_replace('SELECT', 'SELECT CONCAT(vtiger_users.first_name, " ",vtiger_users.last_name) as name, vtiger_crmentity.description, vtiger_activitycf.cf_1115, vtiger_activity.date_start, vtiger_activity.time_start, vtiger_activitycf.cf_1117, ', $parseQuery[0]);
                $listQuery .= 'LEFT JOIN vtiger_activitycf ON vtiger_activitycf.activityid = vtiger_activity.activityid '
                        . "LEFT JOIN vtiger_office as of ON of.officeid = vtiger_users.office WHERE ((vtiger_activity.status = 'Экспресс' ) OR (vtiger_activity.eventstatus = 'Экспресс' ))  AND ( vtiger_activity.activitytype <> 'Emails') ".$mobile_search.$office_search;
		if (!empty($mobile)){
                   $_delta = "INNER JOIN vt_tmp_u".$current_user->id." vt_tmp_u".$current_user->id." ON vt_tmp_u".$current_user->id.".id = vtiger_crmentity.smownerid"; 
                   $listQuery = str_replace($_delta, '', $listQuery);
                   
                   
                }
               
                $sourceModule = $this->get('src_module');
		if(!empty($sourceModule)) {
			if(method_exists($moduleModel, 'getQueryByModuleField')) {
				$overrideQuery = $moduleModel->getQueryByModuleField($sourceModule, $this->get('src_field'), $this->get('src_record'), $listQuery);
				if(!empty($overrideQuery)) {
					$listQuery = $overrideQuery;
				}
			}
		}

		$startIndex = $pagingModel->getStartIndex();
		$pageLimit = $pagingModel->getPageLimit();



		if(!empty($orderBy)) {
            if($orderByFieldModel && $orderByFieldModel->isReferenceField()){
                $referenceModules = $orderByFieldModel->getReferenceList();
                $referenceNameFieldOrderBy = array();
                foreach($referenceModules as $referenceModuleName) {
                    $referenceModuleModel = Vtiger_Module_Model::getInstance($referenceModuleName);
                    $referenceNameFields = $referenceModuleModel->getNameFields();

                    $columnList = array();
                    foreach($referenceNameFields as $nameField) {
                        $fieldModel = $referenceModuleModel->getField($nameField);
                        $columnList[] = $fieldModel->get('table').$orderByFieldModel->getName().'.'.$fieldModel->get('column');
                    }
                    if(count($columnList) > 1) {
                        $referenceNameFieldOrderBy[] = getSqlForNameInDisplayFormat(array('first_name'=>$columnList[0],'last_name'=>$columnList[1]),'Users').' '.$sortOrder;
                    } else {
                        $referenceNameFieldOrderBy[] = implode('', $columnList).' '.$sortOrder ;
                    }
                }
                $listQuery .= ' ORDER BY '. implode(',',$referenceNameFieldOrderBy);
            }else{
                $listQuery .= ' ORDER BY '. $orderBy . ' ' .$sortOrder;
            }
		}

		$viewid = ListViewSession::getCurrentView($moduleName);
        if(empty($viewid)){
            $viewid = $pagingModel->get('viewid');
        }
        $_SESSION['lvs'][$moduleName][$viewid]['start'] = $pagingModel->get('page');
		ListViewSession::setSessionQuery($moduleName, $listQuery, $viewid);

		$listQueryWithNoLimit = $listQuery;
		$listQuery .= " LIMIT $startIndex,".($pageLimit+1);
                // echo $listQuery; die();
		$listResult = $db->pquery($listQuery, array());
                
		$listViewRecordModels = array();
		$listViewEntries =  $listViewContoller->getListViewRecords($moduleFocus,$moduleName, $listResult);

		$pagingModel->calculatePageRange($listViewEntries);

		if($db->num_rows($listResult) > $pageLimit){
			array_pop($listViewEntries);
			$pagingModel->set('nextPageExists', true);
		}else{
			$pagingModel->set('nextPageExists', false);
		}
		
		$groupsIds = Vtiger_Util_Helper::getGroupsIdsForUsers($currentUser->getId());
		$index = 0;
		foreach($listViewEntries as $recordId => $record) {
			$rawData = $db->query_result_rowdata($listResult, $index++);
			$visibleFields = array('activitytype','date_start','due_date','assigned_user_id','visibility','smownerid');
			$ownerId = $rawData['smownerid'];
			$visibility = true;
			if(in_array($ownerId, $groupsIds)) {
				$visibility = false;
			} else if($ownerId == $currentUser->getId()){
				$visibility = false;
			}
			
			if(!$currentUser->isAdminUser() && $rawData['activitytype'] != 'Task' && $rawData['visibility'] == 'Private' && $ownerId && $visibility) {
				foreach($record as $data => $value) {
					if(in_array($data, $visibleFields) != -1) {
						unset($rawData[$data]);
						unset($record[$data]);
					}
				}
				$record['subject'] = vtranslate('Busy','Events').'*';
			}
			if($record['activitytype'] == 'Task') {
				unset($record['visibility']);
				unset($rawData['visibility']);
			}
			
			$record['id'] = $recordId;
                       
			$listViewRecordModels[$recordId] = $moduleModel->getRecordFromArray($record, $rawData);
		}
                 //echo '<pre>';print_r ($listViewRecordModels);
                //die();
		return $listViewRecordModels;
            
        }
	public function getListViewEntries($pagingModel, $mobile, $office, $source) {
            global $current_user;
		$db = PearDatabase::getInstance();

		$moduleName = $this->getModule()->get('name');
		$moduleFocus = CRMEntity::getInstance($moduleName);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$currentUser = Users_Record_Model::getCurrentUserModel();
		
		$queryGenerator = $this->get('query_generator');
              
		$listViewContoller = $this->get('listview_controller');
		$listViewFields = array('visibility','assigned_user_id');
		$queryGenerator->setFields(array_unique(array_merge($queryGenerator->getFields(), $listViewFields)));
		
        $searchParams = $this->get('search_params');
        
        if(empty($searchParams)) {
            $searchParams = array(
                    array( 
                        'columns'=>array(
                            array( 
                                'columnname' => 'vtiger_activity:status:taskstatus:Calendar_Status:V',
                                'comparator' => 'e',
                                'value' => 'Planned,Новая',
                                'column_condition' => '')))); 
        }
        else {
            $addStatus = true;
            $fullStatus = false;
            $array_serch_data = array('vtiger_crmentity:modifiedtime:modifiedtime:Calendar_Modified_Time:DT', 
                'vtiger_activity:due_date:due_date:Calendar_End_Date:D', 
                'vtiger_crmentity:createdtime:createdtime:Calendar_Created_Time:DT');
            foreach ($searchParams[0]['columns'] as $ser){
                if ($ser['columnname'] == 'vtiger_activity:status:taskstatus:Calendar_Status:V'){
                    $addStatus = false;
                }
                 if (in_array($ser['columnname'], $array_serch_data)){
                    $fullStatus = true;
                }
               
            }
            if ($addStatus && !$fullStatus){
                $count = count($searchParams[0]['columns']);
                $searchParams[0]['columns'][$count-1]['column_condition'] = 'and';
                $searchParams[0]['columns'][$count] = array( 
                                'columnname' => 'vtiger_activity:status:taskstatus:Calendar_Status:V',
                                'comparator' => 'e',
                                'value' => 'Planned,Новая',
                                'column_condition' => '');
            }
            else if ($addStatus && $fullStatus){
                $count = count($searchParams[0]['columns']);
                $searchParams[0]['columns'][$count-1]['column_condition'] = 'and';
                $searchParams[0]['columns'][$count] = array( 
                                'columnname' => 'vtiger_activity:status:taskstatus:Calendar_Status:V',
                                'comparator' => 'e',
                                'value' => 'Planned,Новая,Отказ,Продажа',
                                'column_condition' => '');
            }
        }
        //echo '<pre>';print_r($searchParams);die();
        $glue = "";
        if(count($queryGenerator->getWhereFields()) > 0 && (count($searchParams)) > 0) {
            $glue = QueryGenerator::$AND;
        }
        $queryGenerator->parseAdvFilterList($searchParams, $glue);

		$searchKey = $this->get('search_key');
		$searchValue = $this->get('search_value');
		$operator = $this->get('operator');
		if(!empty($searchKey)) {
			$queryGenerator->addUserSearchConditions(array('search_field' => $searchKey, 'search_text' => $searchValue, 'operator' => $operator));
		}
        
        $orderBy = $this->getForSql('orderby');
		$sortOrder = $this->getForSql('sortorder');

		//List view will be displayed on recently created/modified records
		if(empty($orderBy) && empty($sortOrder) && $moduleName != "Users"){
			$orderBy = 'due_date';
			$sortOrder = 'ASC';
		}

        if(!empty($orderBy)){
            $columnFieldMapping = $moduleModel->getColumnFieldMapping();
            $orderByFieldName = $columnFieldMapping[$orderBy];
            $orderByFieldModel = $moduleModel->getField($orderByFieldName);
            if($orderByFieldModel && $orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::REFERENCE_TYPE){
                //IF it is reference add it in the where fields so that from clause will be having join of the table
                $queryGenerator = $this->get('query_generator');
                $queryGenerator->addWhereField($orderByFieldName);
                //$queryGenerator->whereFields[] = $orderByFieldName;
            }
        }
		if (!empty($orderBy) && $orderBy === 'smownerid') { 
			$fieldModel = Vtiger_Field_Model::getInstance('assigned_user_id', $moduleModel); 
			if ($fieldModel->getFieldDataType() == 'owner') { 
				$orderBy = 'COALESCE(CONCAT(vtiger_users.first_name,vtiger_users.last_name),vtiger_groups.groupname)'; 
			} 
		}
        //To combine date and time fields for sorting
        if($orderBy == 'date_start') {
            $orderBy = "str_to_date(concat(date_start,time_start),'%Y-%m-%d %H:%i:%s')";
        }else if($orderBy == 'due_date') {
            $orderBy = "str_to_date(concat(due_date,time_end),'%Y-%m-%d %H:%i:%s')";
        }
        $office_search = '';
        if (!empty($office)){
            $office_search = "ut.office = $office and ";
        }
        $source_search = '';
         if (!empty($source)){
            $source_search = "vtiger_leaddetails.leadsource = '$source' and ";
        }
        $mobile_search = '';
        if (!empty($mobile)){
            
            $city = $this->getCityOffice($office);
            if (!empty($city)){
                $office_search = "and of.city = '$city'";
            }
             if (!empty($source)){
                $office_search .= " and vtiger_leaddetails.leadsource = '$source'";
             }
            $mobile_search = "vtiger_leadaddress.mobile ='$mobile' and vtiger_activity.eventstatus != 'Held' $office_search ORDER BY vtiger_activity.activityid DESC ";
            $office_search = "";
            $source_search = "";
        }
        	
        $listQuery = $this->getQuery();
                
                $parseQuery = explode('WHERE', $listQuery);
                 $parseQuery[1] = str_replace('CAST(vtiger_crmentity.createdtime AS DATE)', 'CAST(crm.createdtime AS DATE)', $parseQuery[1]);
                 if (!empty($mobile)){
                     $parseQuery[1] = "";
                 }
                $listQuery = str_replace('SELECT', "SELECT concat (ut.first_name, ' ', ut.last_name) as owner, concat (us.first_name, ' ', us.last_name) as oldowner, vtiger_crmentity.description, vtiger_leadaddress.*, vtiger_leaddetails.*, vtiger_leadscf.*, ", $parseQuery[0]);
                $listQuery .= "LEFT JOIN vtiger_leaddetails ON vtiger_leaddetails.leadid = vtiger_seactivityrel.crmid "
                        . "LEFT JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_seactivityrel.crmid "
                        . "LEFT JOIN vtiger_leadscf ON vtiger_leadscf.leadid = vtiger_seactivityrel.crmid "
                        . "LEFT JOIN vtiger_crmentity as crm ON crm.crmid = vtiger_seactivityrel.crmid "
                        . "LEFT JOIN transfer_manager as t ON t.crmid = vtiger_seactivityrel.crmid and t.status = 2 and t.newowner = vtiger_crmentity.smownerid "
                        . "LEFT JOIN vtiger_users as us ON us.id = t.oldowner "
                        . "LEFT JOIN vtiger_users as ut ON ut.id = vtiger_crmentity.smownerid "
                        . "LEFT JOIN vtiger_office as of ON of.officeid = ut.office "
                        . "WHERE  (crm.deleted=0 or crm.deleted is NULL)  and (vtiger_activity.activitytype != 'Экспресс заявка' and vtiger_activity.activitytype != 'Обзвон туристов' and vtiger_activity.activitytype != 'Замечание')  and ".$mobile_search.$office_search.$source_search.$parseQuery[1];
                if (!empty($mobile)){
                   $_delta = "INNER JOIN vt_tmp_u".$current_user->id." vt_tmp_u".$current_user->id." ON vt_tmp_u".$current_user->id.".id = vtiger_crmentity.smownerid"; 
                   $listQuery = str_replace($_delta, '', $listQuery);
                   $fix = $listQuery;
                   //echo $fix;
                   
                }
                 //echo $listQuery;
		$sourceModule = $this->get('src_module');
		if(!empty($sourceModule)) {
			if(method_exists($moduleModel, 'getQueryByModuleField')) {
				$overrideQuery = $moduleModel->getQueryByModuleField($sourceModule, $this->get('src_field'), $this->get('src_record'), $listQuery);
				if(!empty($overrideQuery)) {
					$listQuery = $overrideQuery;
				}
			}
		}

		$startIndex = $pagingModel->getStartIndex();
		$pageLimit = $pagingModel->getPageLimit();



		if(!empty($orderBy)) {
            if($orderByFieldModel && $orderByFieldModel->isReferenceField()){
                $referenceModules = $orderByFieldModel->getReferenceList();
                $referenceNameFieldOrderBy = array();
                foreach($referenceModules as $referenceModuleName) {
                    $referenceModuleModel = Vtiger_Module_Model::getInstance($referenceModuleName);
                    $referenceNameFields = $referenceModuleModel->getNameFields();

                    $columnList = array();
                    foreach($referenceNameFields as $nameField) {
                        $fieldModel = $referenceModuleModel->getField($nameField);
                        $columnList[] = $fieldModel->get('table').$orderByFieldModel->getName().'.'.$fieldModel->get('column');
                    }
                    if(count($columnList) > 1) {
                        $referenceNameFieldOrderBy[] = getSqlForNameInDisplayFormat(array('first_name'=>$columnList[0],'last_name'=>$columnList[1]),'Users').' '.$sortOrder;
                    } else {
                        $referenceNameFieldOrderBy[] = implode('', $columnList).' '.$sortOrder ;
                    }
                }
                $listQuery .= ' ORDER BY '. implode(',',$referenceNameFieldOrderBy);
            }else{
                $listQuery .= ' ORDER BY vtiger_activity.date_start, vtiger_activity.priority, vtiger_activity.time_start ASC ';
            }
		}
               //echo $listQuery; 
		$viewid = ListViewSession::getCurrentView($moduleName);
        if(empty($viewid)){
            $viewid = $pagingModel->get('viewid');
        }
        $_SESSION['lvs'][$moduleName][$viewid]['start'] = $pagingModel->get('page');
		ListViewSession::setSessionQuery($moduleName, $listQuery, $viewid);

		$listQueryWithNoLimit = $listQuery;
		$listQuery .= " LIMIT $startIndex,".($pageLimit+1);
                // echo $listQuery; die();
                if (!empty($mobile)){
                    $listQuery = $fix; 
                   
                }

		$listResult = $db->pquery($listQuery, array());
                
		$listViewRecordModels = array();
		$listViewEntries =  $listViewContoller->getListViewRecords($moduleFocus,$moduleName, $listResult);

		$pagingModel->calculatePageRange($listViewEntries);

		if($db->num_rows($listResult) > $pageLimit){
			array_pop($listViewEntries);
			$pagingModel->set('nextPageExists', true);
		}else{
			$pagingModel->set('nextPageExists', false);
		}
		
		$groupsIds = Vtiger_Util_Helper::getGroupsIdsForUsers($currentUser->getId());
		$index = 0;
               
		foreach($listViewEntries as $recordId => $record) {
			$rawData = $db->query_result_rowdata($listResult, $index++);
			$visibleFields = array('activitytype','date_start','due_date','assigned_user_id','visibility','smownerid');
			$ownerId = $rawData['smownerid'];
			$visibility = true;
			if(in_array($ownerId, $groupsIds)) {
				$visibility = false;
			} else if($ownerId == $currentUser->getId()){
				$visibility = false;
			}
			
			if(!$currentUser->isAdminUser() && $rawData['activitytype'] != 'Task' && $rawData['visibility'] == 'Private' && $ownerId && $visibility) {
				foreach($record as $data => $value) {
					if(in_array($data, $visibleFields) != -1) {
						unset($rawData[$data]);
						unset($record[$data]);
					}
				}
				$record['subject'] = vtranslate('Busy','Events').'*';
			}
			if($record['activitytype'] == 'Task') {
				unset($record['visibility']);
				unset($rawData['visibility']);
			}
			
			$record['id'] = $recordId;
                       
			$listViewRecordModels[$recordId] = $moduleModel->getRecordFromArray($record, $rawData);
		}
                 //echo '<pre>';print_r ($listViewRecordModels);
                //die();
		return $listViewRecordModels;
	}
       
        public function getCalendarInstance($moduleName, $viewId = '0', $New_Fields=false) {
        $db = PearDatabase::getInstance();
        $currentUser = vglobal('current_user');

        $modelClassName = Vtiger_Loader::getComponentClassName('Model', 'ListView', $moduleName);
        $instance = new $modelClassName();
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $queryGenerator = new QueryGenerator($moduleModel->get('name'), $currentUser);
        $customView = new CustomView();
       
        if (!empty($viewId) && $viewId != "0") {
                $queryGenerator->initForCustomViewById($viewId);
                $viewId = $customView->getViewId($moduleName);
        } else {
             
                $viewId = 19;
                
                if(!empty($viewId) && $viewId != 0) {
                        $queryGenerator->initForDefaultCustomView();
                } else {
                        $entityInstance = CRMEntity::getInstance($moduleName);
                        $listFields = $entityInstance->list_fields_name;
                        $listFields[] = 'id';
                        $queryGenerator->setFields($listFields);
                }
        }
        
        $controller = new ListViewController($db, $currentUser, $queryGenerator);

        if (count($New_Fields) > 0) {
            $Fields = $queryGenerator->getFields();
            if (is_array($New_Fields)) {

            foreach ($New_Fields AS $add_fieldname) {
                if (!in_array($add_fieldname, $Fields)) $Fields[] = $add_fieldname;
            }
        }
            $queryGenerator->setFields($Fields);
        }
        if (empty($this->calendar)) {
            $this->calendar = new stdClass();
        }
        $this->calendar->module = $moduleModel;

        $this->calendar->query_generator = $queryGenerator;
        $this->calendar->listview_controller = $controller;
        
        
        
    }
    function getListErrors(){
        global $current_user;
        $db = PearDatabase::getInstance();
        $result = $db->pquery("SELECT * FROM vtiger_user2role where userid = ?", array($current_user->id));
        $role = $db->query_result($result,0,'roleid');
        $result = $db->pquery("SELECT * FROM vtiger_user2role u where u.roleid IN (SELECT roleid FROM vtiger_role r WHERE r.parentrole LIKE '%$role%' AND r.roleid != '$role') ",array());
        $numRows = $db->num_rows($result);
        $row = [];
        for ($i=1;$i<$numRows;$i++){
            $row[] = $db->query_result($result,$i,'userid');
        }
        array_push($row, $current_user->id);
        $user_id = implode(",",$row);
        $query = "SELECT t.* FROM (SELECT concat (ut.first_name, ' ', ut.last_name) as owner, concat (u.first_name, ' ', u.last_name) as notif, a.* , cs.createdtime, cfl.description as description_foul, sa.crmid as idrecord, cs.label as label_entity"
                ." FROM vtiger_activity as a"
                ." INNER JOIN vtiger_crmentity as ca ON ca.crmid = a.activityid"
                ." INNER JOIN vtiger_seactivityrel as sa ON sa.activityid = a.activityid"
                ." INNER JOIN vtiger_crmentity as cs ON cs.crmid = sa.crmid"
                ." INNER JOIN vtiger_foullist as fl ON fl.target = sa.crmid"
                ." LEFT JOIN vtiger_crmentity as cfl ON cfl.crmid = fl.foullist"
                ." LEFT JOIN vtiger_users as ut ON ut.id = cs.smownerid"
                ." LEFT JOIN vtiger_users as u ON u.id = ca.smownerid"
                ." WHERE a.activitytype = 'Замечание' AND a.eventstatus = 'Planned' AND (ca.smcreatorid IN ($user_id) OR ca.smownerid IN ($user_id) OR ca.modifiedby IN ($user_id)) ORDER BY ca.crmid DESC) as t GROUP BY t.idrecord ";
        //echo $query;
        $result = $db->pquery($query, array());
        $numRows = $db->num_rows($result);
        $row = [];
        for ($i=0;$i<$numRows;$i++){
            $row[$i] = $db->query_result_rowdata($result,$i);

            if (!empty($row[$i]['idrecord'])) {
                $row[$i]['modulename'] = getSalesEntityType($row[$i]['idrecord']);
            }

        }
        return $row;
    }
    function getListCall($mobile,$office){
              global $current_user;   
            $db = PearDatabase::getInstance();
            $moduleName = 'Calendar';
            $this->getCalendarInstance($moduleName);
		$moduleFocus = CRMEntity::getInstance($moduleName);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', 1);
		$pagingModel->set('viewid', 19);
		$queryGenerator = $this->calendar->query_generator;
                
		$listViewContoller = $this->calendar->listview_controller;
		$listViewFields = array('visibility','assigned_user_id');
		$queryGenerator->setFields(array_unique(array_merge($queryGenerator->getFields(), $listViewFields)));
                 $searchParams = $this->get('search_params');
                  if(empty($searchParams)) {
           $searchParams = array(
                    array( 
                        'columns'=>array(
                            array( 
                                'columnname' => 'vtiger_activity:activitytype:activitytype:Calendar_Status:V',
                                'comparator' => 'e',
                                'value' => 'Обзвон туристов',
                                'column_condition' => '')))); 
        }
        else {
            $addStatus = true;
            foreach ($searchParams[0]['columns'] as $key=>$ser){
                if ($ser['columnname'] == 'vtiger_activity:activitytype:activitytype:Calendar_Status:V'){
                    $searchParams[0]['columns'][$key]['comparator'] = 'e';
                    $searchParams[0]['columns'][$key]['value'] = 'Обзвон туристов';
                     $addStatus = false;
                }
            }
            if ($addStatus){
                $count = count($searchParams[0]['columns']);
                $searchParams[0]['columns'][$count-1]['column_condition'] = 'and';
                $searchParams[0]['columns'][$count] = array( 
                                'columnname' => 'vtiger_activity:activitytype:activitytype:Calendar_Status:V',
                                'comparator' => 'e',
                                'value' => 'Обзвон туристов',
                                'column_condition' => '');
            }
        }
           
	
       
         $glue = "";
        if(count($queryGenerator->getWhereFields()) > 0 && (count($searchParams)) > 0) {
            $glue = QueryGenerator::$AND;
        }
        $queryGenerator->parseAdvFilterList($searchParams, $glue);

		$searchKey = $this->get('search_key');
		$searchValue = $this->get('search_value');
		$operator = $this->get('operator');
		if(!empty($searchKey)) {
			$queryGenerator->addUserSearchConditions(array('search_field' => $searchKey, 'search_text' => $searchValue, 'operator' => $operator));
		}
        
        $orderBy = $this->getForSql('orderby');
		$sortOrder = $this->getForSql('sortorder');

		//List view will be displayed on recently created/modified records
		if(empty($orderBy) && empty($sortOrder) && $moduleName != "Users"){
			$orderBy = 'date_start';
			$sortOrder = 'ASC';
		}

        if(!empty($orderBy)){
            $columnFieldMapping = $moduleModel->getColumnFieldMapping();
            $orderByFieldName = $columnFieldMapping[$orderBy];
            $orderByFieldModel = $moduleModel->getField($orderByFieldName);
            if($orderByFieldModel && $orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::REFERENCE_TYPE){
                //IF it is reference add it in the where fields so that from clause will be having join of the table
                $queryGenerator = $this->calendar->query_generator;
                $queryGenerator->addWhereField($orderByFieldName);
                //$queryGenerator->whereFields[] = $orderByFieldName;
            }
        }
		if (!empty($orderBy) && $orderBy === 'smownerid') { 
			$fieldModel = Vtiger_Field_Model::getInstance('assigned_user_id', $moduleModel); 
			if ($fieldModel->getFieldDataType() == 'owner') { 
				$orderBy = 'COALESCE(CONCAT(vtiger_users.first_name,vtiger_users.last_name),vtiger_groups.groupname)'; 
			} 
		}
        //To combine date and time fields for sorting
       
            $orderBy = "vtiger_activity.date_start";
       
           
       

	$mobile_search = '';
        
        $office_search = '';
        if (!empty($office)){
            $office_search = "vtiger_users.office = $office and ";
        }
        if (!empty($mobile)){
            $mobile_search = "vtiger_contactdetails.mobile ='$mobile' and ";
            $city = $this->getCityOffice($office);
            if (!empty($city)){
                $office_search = "of.city = '$city' and ";
            }
           
        }
       $date = date('Y-m-d');
        $listQuery = $this->getCallQuery();
                
                $parseQuery = explode('WHERE', $listQuery);
                $listQuery = str_replace('SELECT', 'SELECT acf.cf_1454, vtiger_potential.*, vtiger_potentialscf.*, vtiger_contactdetails.firstname, vtiger_listresorts.resort, vtiger_listtouroperators.turoperator_name,'
                        . ' vtiger_contactdetails.lastname, vtiger_contactdetails.midlename, vtiger_contactdetails.mobile, vtiger_listcountry.country_name,', $parseQuery[0]);
                
                $parseQuery[1] = str_replace('AND   (  (0  and 1  and 2 ))', '', $parseQuery[1]);
               // $parseQuery[1] = str_replace("AND ( ((vtiger_activity.eventstatus = 'Planned' )  OR (vtiger_activity.status = 'Planned' )))", '', $parseQuery[1]);
                $listQuery .= 'LEFT JOIN vtiger_potential ON vtiger_potential.potentialid = vtiger_seactivityrel.crmid '
                        
                        . 'LEFT JOIN vtiger_potentialscf ON vtiger_potentialscf.potentialid = vtiger_seactivityrel.crmid '
                        . 'LEFT JOIN vtiger_contactdetails ON vtiger_contactdetails.contactid = vtiger_potential.contact_id '
                        . 'LEFT JOIN vtiger_listcountry ON vtiger_listcountry.listcountryid = vtiger_potentialscf.cf_1165 '
                        . 'LEFT JOIN vtiger_listresorts ON vtiger_listresorts.listresortsid = vtiger_potentialscf.cf_1167 '
                        . 'LEFT JOIN vtiger_office as of ON of.officeid = vtiger_users.office '
                        . 'LEFT JOIN vtiger_listtouroperators ON vtiger_listtouroperators.listtouroperatorsid = vtiger_potentialscf.cf_1163 '
                        . 'LEFT JOIN vtiger_activitycf as acf ON acf.activityid = vtiger_activity.activityid '
                        . "WHERE acf.cf_1454 < 4 AND vtiger_activity.date_start <= '$date' AND ".$mobile_search.$office_search.$parseQuery[1];
                
                 if (!empty($mobile)){
                   $_delta = "INNER JOIN vt_tmp_u".$current_user->id." vt_tmp_u".$current_user->id." ON vt_tmp_u".$current_user->id.".id = vtiger_crmentity.smownerid"; 
                   $listQuery = str_replace($_delta, '', $listQuery);
                   //echo $listQuery;
                   
                }
		//echo $listQuery;
                $sourceModule = $this->get('src_module');
		if(!empty($sourceModule)) {
			if(method_exists($moduleModel, 'getQueryByModuleField')) {
				$overrideQuery = $moduleModel->getQueryByModuleField($sourceModule, $this->get('src_field'), $this->get('src_record'), $listQuery);
				if(!empty($overrideQuery)) {
					$listQuery = $overrideQuery;
				}
			}
		}

		$startIndex = $pagingModel->getStartIndex();
		$pageLimit = $pagingModel->getPageLimit();



		if(!empty($orderBy)) {
            if($orderByFieldModel && $orderByFieldModel->isReferenceField()){
                $referenceModules = $orderByFieldModel->getReferenceList();
                $referenceNameFieldOrderBy = array();
                foreach($referenceModules as $referenceModuleName) {
                    $referenceModuleModel = Vtiger_Module_Model::getInstance($referenceModuleName);
                    $referenceNameFields = $referenceModuleModel->getNameFields();

                    $columnList = array();
                    foreach($referenceNameFields as $nameField) {
                        $fieldModel = $referenceModuleModel->getField($nameField);
                        $columnList[] = $fieldModel->get('table').$orderByFieldModel->getName().'.'.$fieldModel->get('column');
                    }
                    if(count($columnList) > 1) {
                        $referenceNameFieldOrderBy[] = getSqlForNameInDisplayFormat(array('first_name'=>$columnList[0],'last_name'=>$columnList[1]),'Users').' '.$sortOrder;
                    } else {
                        $referenceNameFieldOrderBy[] = implode('', $columnList).' '.$sortOrder ;
                    }
                }
                $listQuery .= ' ORDER BY '. implode(',',$referenceNameFieldOrderBy);
            }else{
                $listQuery .= ' ORDER BY '. $orderBy . ' ' .$sortOrder;
            }
		}

		$viewid = ListViewSession::getCurrentView($moduleName);
        if(empty($viewid)){
            $viewid = $pagingModel->get('viewid');
        }
        $_SESSION['lvs'][$moduleName][$viewid]['start'] = $pagingModel->get('page');
		ListViewSession::setSessionQuery($moduleName, $listQuery, $viewid);

		$listQueryWithNoLimit = $listQuery;
		//$listQuery .= " LIMIT $startIndex,".($pageLimit+1);
                
		$listResult = $db->pquery($listQuery, array());
                
		$listViewRecordModels = array();
		$listViewEntries =  $listViewContoller->getListViewRecords($moduleFocus,$moduleName, $listResult);

		$pagingModel->calculatePageRange($listViewEntries);

		if($db->num_rows($listResult) > $pageLimit){
			array_pop($listViewEntries);
			$pagingModel->set('nextPageExists', true);
		}else{
			$pagingModel->set('nextPageExists', false);
		}
		
		$groupsIds = Vtiger_Util_Helper::getGroupsIdsForUsers($currentUser->getId());
		$index = 0;
		foreach($listViewEntries as $recordId => $record) {
			$rawData = $db->query_result_rowdata($listResult, $index++);
			$visibleFields = array('activitytype','date_start','due_date','assigned_user_id','visibility','smownerid');
			$ownerId = $rawData['smownerid'];
			$visibility = true;
			if(in_array($ownerId, $groupsIds)) {
				$visibility = false;
			} else if($ownerId == $currentUser->getId()){
				$visibility = false;
			}
			
			if(!$currentUser->isAdminUser() && $rawData['activitytype'] != 'Task' && $rawData['visibility'] == 'Private' && $ownerId && $visibility) {
				foreach($record as $data => $value) {
					if(in_array($data, $visibleFields) != -1) {
						unset($rawData[$data]);
						unset($record[$data]);
					}
				}
				$record['subject'] = vtranslate('Busy','Events').'*';
			}
			if($record['activitytype'] == 'Task') {
				unset($record['visibility']);
				unset($rawData['visibility']);
			}
			
			$record['id'] = $recordId;
                       
			$listViewRecordModels[$recordId] = $moduleModel->getRecordFromArray($record, $rawData);
		}
                 //echo '<pre>';print_r ($listViewRecordModels);
                //die();
		return $listViewRecordModels;
            
        }
    function getCallQuery() {
		$queryGenerator = $this->calendar->query_generator;
		// Added to remove emails from the calendar list
		$queryGenerator->addCondition('eventstatus','Planned','e','AND');

		$listQuery = $queryGenerator->getQuery();
		return $listQuery;
	}
        function getCityOffice($office_id=false){
            global $current_user, $adb;
            if (!$office_id){
                $office_id = $current_user->office;
            }
            if ($office_id > 0){
                $sql = "SELECT city FROM vtiger_office WHERE officeid = ?";
                $result = $adb->pquery($sql, array($office_id));
                return $adb->query_result($result,0,'city');
            }
            return false;
            
        }
}
