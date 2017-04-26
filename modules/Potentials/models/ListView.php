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
class Potentials_ListView_Model extends Vtiger_ListView_Model {



	/**
	 * Function to get the Module Model
	 * @return Vtiger_Module_Model instance
	*/
	public function getListViewEntries($pagingModel, $statbron, $mobile) {
		$db = PearDatabase::getInstance();

		$moduleName = $this->getModule()->get('name');
                
               
		$moduleFocus = CRMEntity::getInstance($moduleName);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$queryGenerator = $this->get('query_generator');
		$listViewContoller = $this->get('listview_controller');

         $searchParams = $this->get('search_params');
        
        if(empty($searchParams)) {
            $searchParams = array();
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
			$orderBy = 'vtiger_potentialscf.cf_1217';
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
        $listQuery = $this->getQuery();
        $addQuery = '';
        if ($statbron){
            switch ($statbron){
                case "0": $addQuery .= ''; break;
                case "1": $addQuery .= 'vtiger_potentialscf.cf_1250 > 0 and ';break;
                case "2": $addQuery .= 'vtiger_potentialscf.cf_1258 > 0 and ';break;
                case "3": $addQuery .= 'vtiger_potentialscf.cf_1234 = 0 and ';break;
            }
        }
        if ($mobile){
            $addQuery .="vtiger_contactdetails.mobile ='$mobile' and ";
        }
        $parseQuery = explode('WHERE', $listQuery);
                $_d = explode ('FROM', $parseQuery[0]);
               
                $listQuery = "SELECT concat (us.first_name, ' ', us.last_name) as oldowner, vtiger_crmentity.description, vtiger_vendor.vendorname, vtiger_listcountry.country_name, vtiger_listresorts.resort, vtiger_crmentity.smownerid, vtiger_potentialscf.*, vtiger_potential.*, vtiger_listtouroperators.turoperator_name as turoperator,vtiger_contactdetails.phone, vtiger_contactdetails.mobile FROM".$_d[1];
                $listQuery .= 'LEFT JOIN vtiger_contactdetails ON vtiger_contactdetails.contactid = vtiger_potential.contact_id '
                        . 'LEFT JOIN vtiger_listcountry ON vtiger_listcountry.listcountryid = vtiger_potentialscf.cf_1165 '
                        . 'LEFT JOIN vtiger_listresorts ON vtiger_listresorts.listresortsid = vtiger_potentialscf.cf_1167 '
                        . 'LEFT JOIN vtiger_vendor ON vtiger_vendor.vendorid = vtiger_potentialscf.cf_1246 '
                        . 'LEFT JOIN vtiger_listtouroperators ON vtiger_listtouroperators.listtouroperatorsid = vtiger_potentialscf.cf_1163 '
                        . "LEFT JOIN transfer_manager as t ON t.crmid = vtiger_potentialscf.potentialid and t.status = 2 and t.newowner = vtiger_crmentity.smownerid "
                        . "LEFT JOIN vtiger_users as us ON us.id = t.oldowner "
                        . 'WHERE '.$addQuery.$parseQuery[1];
		
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
                        $referenceNameFieldOrderBy[] = getSqlForNameInDisplayFormat(array('first_name'=>$columnList[0],'last_name'=>$columnList[1]),'Users', '').' '.$sortOrder;
                    } else {
                        $referenceNameFieldOrderBy[] = implode('', $columnList).' '.$sortOrder ;
                    }
                }
                $listQuery .= ' ORDER BY '. implode(',',$referenceNameFieldOrderBy);
            }
            else if (!empty($orderBy) && $orderBy === 'smownerid') { 
                $fieldModel = Vtiger_Field_Model::getInstance('assigned_user_id', $moduleModel); 
                if ($fieldModel->getFieldDataType() == 'owner') { 
                    $orderBy = 'COALESCE(CONCAT(vtiger_users.first_name,vtiger_users.last_name),vtiger_groups.groupname)'; 
                } 
                $listQuery .= ' ORDER BY '. $orderBy . ' ' .$sortOrder;
            }
            else{
                $listQuery .= ' ORDER BY '. $orderBy . ' ' .$sortOrder;
            }
		}

		
                $viewid = ListViewSession::getCurrentView($moduleName);
		if(empty($viewid)) {
            $viewid = $pagingModel->get('viewid');
		}
                
        $_SESSION['lvs'][$moduleName][$viewid]['start'] = $pagingModel->get('page');

		ListViewSession::setSessionQuery($moduleName, $listQuery, $viewid);

		$listQuery .= " LIMIT $startIndex,".($pageLimit+1);
                //echo $listQuery; 
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

		$index = 0;
		foreach($listViewEntries as $recordId => $record) {
			$rawData = $db->query_result_rowdata($listResult, $index++);
			$record['id'] = $recordId;
			$listViewRecordModels[$recordId] = $moduleModel->getRecordFromArray($record, $rawData);
		}
		return $listViewRecordModels;
	}
        
    public function getListAlert() {
                global $adb, $current_user;
		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', 1);
		$pagingModel->set('viewid', 79);

		$moduleName = $this->getModule()->get('name');
                
               
		$moduleFocus = CRMEntity::getInstance($moduleName);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$queryGenerator = $this->get('query_generator');
		$listViewContoller = $this->get('listview_controller');

         $searchParams = $this->get('search_params');
        if(empty($searchParams)) {
            $searchParams = array();
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
			$orderBy = 'vtiger_potentialscf.cf_1217';
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
        $listQuery = $this->getQuery();
		
        $parseQuery = explode('WHERE', $listQuery);
                $_d = explode ('FROM', $parseQuery[0]);
                $date = date('Y-m-d H:i:m', strtotime("-1 day"));
                $listQuery = 'SELECT vtiger_crmentity.description, vtiger_vendor.vendorname, vtiger_listcountry.country_name, vtiger_listresorts.resort, vtiger_crmentity.smownerid, cf.*, vtiger_potential.*, vtiger_listtouroperators.turoperator_name as turoperator,vtiger_contactdetails.phone, vtiger_contactdetails.mobile FROM'.$_d[1];
                $listQuery .= 'LEFT JOIN vtiger_potentialscf as cf ON cf.potentialid = vtiger_potential.potentialid '
                        . 'LEFT JOIN vtiger_contactdetails ON vtiger_contactdetails.contactid = vtiger_potential.contact_id '
                        . 'LEFT JOIN vtiger_listcountry ON vtiger_listcountry.listcountryid = cf.cf_1165 '
                        . 'LEFT JOIN vtiger_listresorts ON vtiger_listresorts.listresortsid = cf.cf_1167 '
                        . 'LEFT JOIN vtiger_vendor ON vtiger_vendor.vendorid = cf.cf_1246 '
                        . 'LEFT JOIN vtiger_listtouroperators ON vtiger_listtouroperators.listtouroperatorsid = cf.cf_1163 '
                        . "WHERE ((cf.cf_1242 != '0000-00-00' and cf.cf_1242 <= '$date')"
                        . " OR (cf.cf_1248 IS NOT NULL and cf.cf_1248 <= '$date')"
                        . " OR(cf.cf_1250 > 0 and cf.cf_1252 IS NOT NULL and cf.cf_1252 != '0000-00-00' and cf.cf_1252 <= '$date')"
                        . " OR(cf.cf_1258 > 0 and cf.cf_1260 IS NOT NULL and cf.cf_1260 != '0000-00-00' and cf.cf_1260 <= '$date')) AND vtiger_crmentity.deleted=0 AND ( (( vtiger_potential.sales_stage <> 'Closed Won' AND vtiger_potential.sales_stage <> 'Closed Lost') and ( cf.cf_1240 = '0') and ( cf.cf_1238 = '0') )) AND vtiger_potential.potentialid > 0";
		
                
		$sourceModule = $this->get('src_module');
		if(!empty($sourceModule)) {
			if(method_exists($moduleModel, 'getQueryByModuleField')) {
				$overrideQuery = $moduleModel->getQueryByModuleField($sourceModule, $this->get('src_field'), $this->get('src_record'), $listQuery);
				if(!empty($overrideQuery)) {
					$listQuery = $overrideQuery;
				}
			}
		}

		
		
                $viewid = '79';
		
                
       

		ListViewSession::setSessionQuery($moduleName, $listQuery, $viewid);

		
               
		$listResult = $adb->pquery($listQuery, array());
                
		$listViewRecordModels = array();
		$numRows = $adb->num_rows($listResult);
                
                for ($i=0; $i<$numRows; $i++){
                    $listViewRecordModels[$adb->query_result($listResult, $i,'potentialid')] = $adb->query_result_rowdata($listResult, $i);
                }
		$visa = array();
                $control = array();
                $turist = array();
                $turoperator = array();
                 $count = 0;
                $priv = explode('::',Users_Record_Model::getCurrentUserModel()->get('privileges')->get('parent_role_seq'));
                
                if (count($priv)>5){
                foreach ($listViewRecordModels as $key=>$value){
                    if (!empty($value['cf_1242']) and $value['cf_1242'] != '0000-00-00 00:00:00' and $value['cf_1242'] <= $date){
                        $control[$key]['dogovor'] = $value['cf_1223'];
                        $control[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $control[$key]['data'] = $value['cf_1242'];
                        $count ++;
                    }
                    if (!empty($value['cf_1248'])  and $value['cf_1248'] <= $date){
                        $visa[$key]['dogovor'] = $value['cf_1223'];
                        $visa[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $count ++;
                    }
                    if ( $value['cf_1250'] > 0 and !empty($value['cf_1252']) and $value['cf_1252'] != '0000-00-00' and $value['cf_1252'] <= $date){
                        $turist[$key]['dogovor'] = $value['cf_1223'];
                        $turist[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turist[$key]['data'] = $value['cf_1252'];
                        $count ++;
                    }
                    if ( $value['cf_1258'] > 0 and !empty($value['cf_1260']) and $value['cf_1260'] <= $date){
                        $turoperator[$key]['dogovor'] = $value['cf_1223'];
                        $turoperator[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turoperator[$key]['data'] = $value['cf_1260'];
                        $count ++;
                    }
                    
                }
                } else if (count($priv) == 5){
                    $_delta = 60*60*11.5;
                    $date = date('Y-m-d H:i:s', (strtotime($date)-$_delta));
                    foreach ($listViewRecordModels as $key=>$value){
                    if (!empty($value['cf_1242']) and $value['cf_1242'] != '0000-00-00 00:00:00' and $value['cf_1242'] <= $date){
                        $control[$key]['dogovor'] = $value['cf_1223'];
                        $control[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $control[$key]['data'] = $value['cf_1242'];
                        $count ++;
                    }
                    if (!empty($value['cf_1248'])  and $value['cf_1248'] <= $date){
                        $visa[$key]['dogovor'] = $value['cf_1223'];
                        $visa[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $count ++;
                    }
                    if ( $value['cf_1250'] > 0 and !empty($value['cf_1252']) and $value['cf_1252'] != '0000-00-00' and $value['cf_1252'] <= $date){
                        $turist[$key]['dogovor'] = $value['cf_1223'];
                        $turist[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turist[$key]['data'] = $value['cf_1252'];
                        $count ++;
                    }
                    if ( $value['cf_1258'] > 0 and !empty($value['cf_1260']) and $value['cf_1260'] <= $date){
                        $turoperator[$key]['dogovor'] = $value['cf_1223'];
                        $turoperator[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turoperator[$key]['data'] = $value['cf_1260'];
                        $count ++;
                    }
                    
                    
                    }
                } else if (count($priv) == 4){
                    $_delta = 60*60*12.5;
                    $date = date('Y-m-d H:i:s', (strtotime($date)-$_delta));
                    foreach ($listViewRecordModels as $key=>$value){
                    if (!empty($value['cf_1242']) and $value['cf_1242'] != '0000-00-00 00:00:00' and $value['cf_1242'] <= $date){
                        $control[$key]['dogovor'] = $value['cf_1223'];
                        $control[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $control[$key]['data'] = $value['cf_1242'];
                        $count ++;
                    }
                    if (!empty($value['cf_1248'])  and $value['cf_1248'] <= $date){
                        $visa[$key]['dogovor'] = $value['cf_1223'];
                        $visa[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $count ++;
                    }
                    if ( $value['cf_1250'] > 0 and !empty($value['cf_1252']) and $value['cf_1252'] != '0000-00-00' and $value['cf_1252'] <= $date){
                        $turist[$key]['dogovor'] = $value['cf_1223'];
                        $turist[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turist[$key]['data'] = $value['cf_1252'];
                        $count ++;
                    }
                    if ( $value['cf_1258'] > 0 and !empty($value['cf_1260']) and $value['cf_1260'] <= $date){
                        $turoperator[$key]['dogovor'] = $value['cf_1223'];
                        $turoperator[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turoperator[$key]['data'] = $value['cf_1260'];
                        $count ++;
                    }
                    
                }
                
                } else {
                    $_delta = 60*60*15;
                    $date = date('Y-m-d H:i:s', (strtotime($date)-$_delta));
                    foreach ($listViewRecordModels as $key=>$value){
                    if (!empty($value['cf_1242']) and $value['cf_1242'] != '0000-00-00 00:00:00' and $value['cf_1242'] <= $date){
                        $control[$key]['dogovor'] = $value['cf_1223'];
                        $control[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $control[$key]['data'] = $value['cf_1242'];
                        $count ++;
                    }
                    if (!empty($value['cf_1248'])  and $value['cf_1248'] <= $date){
                        $visa[$key]['dogovor'] = $value['cf_1223'];
                        $visa[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $count ++;
                    }
                    if ( $value['cf_1250'] > 0 and !empty($value['cf_1252']) and $value['cf_1252'] != '0000-00-00' and $value['cf_1252'] <= $date){
                        $turist[$key]['dogovor'] = $value['cf_1223'];
                        $turist[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turist[$key]['data'] = $value['cf_1252'];
                        $count ++;
                    }
                    if ( $value['cf_1258'] > 0 and !empty($value['cf_1260']) and $value['cf_1260'] <= $date){
                        $turoperator[$key]['dogovor'] = $value['cf_1223'];
                        $turoperator[$key]['link'] = 'index.php?module=Potentials&view=Edit&record='.$key;
                        $turoperator[$key]['data'] = $value['cf_1260'];
                        $count ++;
                    }
                   
                    
                }
                }
                
                //echo '<pre>';print_r(array('control'=>$control, 'visa'=>$visa,'turist'=>$turist,'turoperator'=>$turoperator,'count'=>$count));echo '</pre>';
		return array('control'=>$control, 'visa'=>$visa,'turist'=>$turist,'turoperator'=>$turoperator,'count'=>$count);
	}
        
    function getCallQuery() {
		$queryGenerator = $this->calendar->query_generator;
		// Added to remove emails from the calendar list
		$queryGenerator->addCondition('eventstatus','Planned','e','AND');

		$listQuery = $queryGenerator->getQuery();
		return $listQuery;
	}
        function getListCall(){
                 
            $db = PearDatabase::getInstance();
            $moduleName = 'Calendar';
            $this->getCalendarInstance($moduleName);
		$moduleFocus = CRMEntity::getInstance($moduleName);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', 1);
		$pagingModel->set('viewid', '');
		$queryGenerator = $this->calendar->query_generator;
                
		$listViewContoller = $this->calendar->listview_controller;
		$listViewFields = array('visibility','assigned_user_id');
		$queryGenerator->setFields(array_unique(array_merge($queryGenerator->getFields(), $listViewFields)));
	$searchParams = array(
                    array( 
                        'columns'=>array(
                            array( 
                                'columnname' => 'vtiger_activity:activitytype:activitytype:Calendar_Status:V',
                                'comparator' => 'e',
                                'value' => 'Обзвон туристов',
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
        if($orderBy == 'date_start') {
            $orderBy = "str_to_date(concat(date_start,time_start),'%Y-%m-%d %H:%i:%s')";
        }else if($orderBy == 'due_date') {
            $orderBy = "str_to_date(concat(due_date,time_end),'%Y-%m-%d %H:%i:%s')";
        }

	$mobile_search = '';
       
        $listQuery = $this->getCallQuery();
                
                $parseQuery = explode('WHERE', $listQuery);
                $listQuery = str_replace('SELECT', 'SELECT vtiger_potential.*, vtiger_potentialscf.*, ', $parseQuery[0]);
                
                $parseQuery[1] = str_replace('AND   (  (0  and 1  and 2 ))', '', $parseQuery[1]);
                
                $listQuery .= 'LEFT JOIN vtiger_potential ON vtiger_potential.potentialid = vtiger_seactivityrel.crmid LEFT JOIN vtiger_potentialscf ON vtiger_potentialscf.potentialid = vtiger_seactivityrel.crmid WHERE '.$mobile_search.$parseQuery[1];
		echo $listQuery; 
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
                 echo $listQuery; //die();
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
        

	
}
