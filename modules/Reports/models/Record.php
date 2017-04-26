<?php
/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */
vimport('~~/modules/Reports/Reports.php');
// SalesPlatform.ru begin
vimport('~~/modules/Reports/SPReportRun.php');
//vimport('~~/modules/Reports/ReportRun.php');
// SalesPlatform.ru end
require_once('modules/Reports/ReportUtils.php');
require_once('Report.php');


class Reports_Record_Model extends Vtiger_Record_Model {
	/**
	 * Function to get the id of the Report
	 * @return <Number> - Report Id
	 */
	public function getId() {
		return $this->get('reportid');
	}

	/**
	 * Function to set the id of the Report
	 * @param <type> $value - id value
	 * @return <Object> - current instance
	 */
	public function setId($value) {
		return $this->set('reportid', $value);
	}

	/**
	 * Fuction to get the Name of the Report
	 * @return <String>
	 */
	function getName() {
		return $this->get('reportname');
	}

	/**
	 * Function deletes the Report
	 * @return Boolean
	 */
	function delete() {
		return $this->getModule()->deleteRecord($this);
	}

	/**
	 * Function to get the detail view url
	 * @return <String>
	 */
	function getDetailViewUrl() {
		$module = $this->getModule();
        $reporttype = $this->get('reporttype');
        if($reporttype == 'chart'){
            $view = 'ChartDetail';
        } else {
            $view = $module->getDetailViewName();
        }
		return 'index.php?module='.$this->getModuleName().'&view='.$view.'&record='.$this->getId();
	}

	/**
	 * Function to get the edit view url
	 * @return <String>
	 */
	function getEditViewUrl() {
		$module = $this->getModule();
        $reporttype = $this->get('reporttype');
        if($reporttype == 'chart'){
            $view = 'ChartEdit';
        } else {
            $view = $module->getEditViewName();
        }
		return 'index.php?module='.$this->getModuleName().'&view='.$view.'&record='.$this->getId();
	}

	/**
	 * Funtion to get Duplicate Record Url
	 * @return <String>
	 */
	public function getDuplicateRecordUrl() {
		$module = $this->getModule();
        $reporttype = $this->get('reporttype');
        if($reporttype == 'chart'){
            $view = 'ChartEdit';
        } else {
            $view = $module->getEditViewName();
        }
		return 'index.php?module='.$this->getModuleName().'&view='.$view.'&record='.$this->getId().'&isDuplicate=true';
	}

	/**
	 * Function returns the url that generates Report in Excel format
	 * @return <String>
	 */
	function getReportExcelURL() {
		return 'index.php?module='.$this->getModuleName().'&view=ExportReport&mode=GetXLS&record='. $this->getId();
	}

	/**
	 * Function returns the url that generates Report in CSV format
	 * @return <String>
	 */
	function getReportCSVURL() {
		return 'index.php?module='.$this->getModuleName().'&view=ExportReport&mode=GetCSV&record='. $this->getId();
	}

	/**
	 * Function returns the url that generates Report in printable format
	 * @return <String>
	 */
	function getReportPrintURL() {
		return 'index.php?module='.$this->getModuleName().'&view=ExportReport&mode=GetPrintReport&record='. $this->getId();
	}

	/**
	 * Function returns the Reports Model instance
	 * @param <Number> $recordId
	 * @param <String> $module
	 * @return <Reports_Record_Model>
	 */
	public static function getInstanceById($recordId) {
		$db = PearDatabase::getInstance();

		$self = new self();
		$reportResult = $db->pquery('SELECT * FROM vtiger_report WHERE reportid = ?', array($recordId));
		if($db->num_rows($reportResult)) {
			$values = $db->query_result_rowdata($reportResult, 0);
			$module = Vtiger_Module_Model::getInstance('Reports');
			$self->setData($values)->setId($values['reportid'])->setModuleFromInstance($module);
			$self->initialize();
		}
		return $self;
	}

	/**
	 * Function creates Reports_Record_Model
	 * @param <Number> $recordId
	 * @return <Reports_Record_Model>
	 */
	public static function getCleanInstance($recordId = null) {
		if(empty($recordId)) {
			$self = new Reports_Record_Model();
		} else {
			$self = self::getInstanceById($recordId);
		}
		$self->initialize();
		$module = Vtiger_Module_Model::getInstance('Reports');
		$self->setModuleFromInstance($module);
		return $self;
	}

	/**
	 * Function initializes Report
	 */
	function initialize() {
		$reportId = $this->getId();
		$this->report = Vtiger_Report_Model::getInstance($reportId);
	}


	/**
	 * Function returns Primary Module of the Report
	 * @return <String>
	 */
	function getPrimaryModule() {
		return $this->report->primodule;
	}

	/**
	 * Function returns Secondary Module of the Report
	 * @return <String>
	 */
	function getSecondaryModules() {
		return $this->report->secmodule;
	}

	/**
	 * Function sets the Primary Module of the Report
	 * @param <String> $module
	 */
	function setPrimaryModule($module) {
		$this->report->primodule = $module;
	}

	/**
	 * Function sets the Secondary Modules for the Report
	 * @param <String> $modules, modules separated with colon(:)
	 */
	function setSecondaryModule($modules) {
		$this->report->secmodule = $modules;
	}

	/**
	 * Function returns Report Type(Summary/Tabular)
	 * @return <String>
	 */
	function getReportType() {
		$reportType = $this->get('reporttype');
		if(!empty($reportType)) {
			return $reportType;
		}
		return $this->report->reporttype;
	}

	/**
	 * Returns the Reports Owner
	 * @return <Number>
	 */
	function getOwner() {
		return $this->get('owner');
	}

	/**
	 * Function checks if the Report is editable
	 * @return boolean
	 */
	function isEditable() {
		return ($this->report->isEditable());
	}

	/**
	 * Function returns Report enabled Modules
	 * @return type
	 */
	function getReportRelatedModules() {
		$report = $this->report;
		return $report->related_modules;
	}

    function getModulesList() {
        return $this->report->getModulesList();
    }
	/**
	 * Function returns Primary Module Fields
	 * @return <Array>
	 */
	function getPrimaryModuleFields() {
		$report = $this->report;
		$primaryModule = $this->getPrimaryModule();
		$report->getPriModuleColumnsList($primaryModule);
		//need to add this vtiger_crmentity:crmid:".$module."_ID:crmid:I
		return $report->pri_module_columnslist;
	}
        function getColum ($table){
            $db = PearDatabase::getInstance();
            $result = $db->pquery('SHOW COLUMNS FROM '.$table);
            $row = $db->num_rows($result);
            $_colums = array();
            if ($row > 0) {
                for ($i=0; $i<$row; ++$i){
                    $_row = $db->fetchByAssoc($result, $i);
                    $_colums[$_row['field']] = $_row['field'];
                }
            }
            return $_colums;
        }
        function getColumTable($request){
            $field = $request->get('selected_fields');
            $colums[$field['FOR']] = $this->getColum($field['FOR']);
            if (!empty($field['JOIN'])){
                $join = explode(';', $field['JOIN']);
                foreach ($join as $table){
                    $colums[$table] = $this->getColum(trim($table));
                }
            }
           
            return $colums;
        }
        public static function getStrLink ($value){
            if (strstr($value, '|&amp;')){
                
                $_a = explode('|&amp;',$value);
                
                return '<a href="index.php?'.$_a[0].'">'.$_a[1].'</a>';
            }
            elseif (strstr($value, '|&')){
                
                $_a = explode('|&',$value);
                
                return '<a href="index.php?'.$_a[0].'">'.$_a[1].'</a>';
            }
           
            return $value;
        }
        function getColumName($request, $record, $callback=false){
            $old_inputs = array();
            $old_sql = '';
            if ($record){
                $db = PearDatabase::getInstance();
                 $result = $db->pquery("SELECT `columnname`, value FROM `vtiger_relcriteria` WHERE `queryid` = ?", array($record));
                 $arr = $db->fetch_array($result);
                 $old_sql = base64_decode($arr['columnname']);
                 $value = explode(',', $arr['value']);
                 $old_inputs = $this->getColumName($old_sql,false,true);
                 //print_r ($old_inputs);
                
                 $row = count($old_inputs);
                 if ($row > 0){
                     for ($i=0;$i<$row;$i++){
                         $old_inputs[$i]['value'] = $value[$i];
                          //print_r ($old_inputs);echo $value[$i];
                     }
                 }
                     
                     
            }
            if ($callback){
                $query = $request;
            }
            else {
            $field = $request->get('selected_fields');
           
            $query = $field['Query'];
            if ($old_sql == $query){
                return $old_inputs;
            }
            }
             $inputs = array();
            $_array = explode('?', $query);
            $_test_r1 = array('&&','||');
            $_test_r2 = array('`',',','!','<','>','=','&lt;', '&gt;','&amp;&amp;');
            $row = count($_array)-1;
            //echo $query;
            if ($row > 0){
               
                for ($i=0;$i<$row;++$i){
                    $_text =  str_replace($_test_r1, ' ', $_array[$i]);
                    $_text = trim(str_replace($_test_r2, '', $_text));
                   
                    
                    $reg = "/\/\*.*?\*\//";
                    preg_match_all($reg, $_text, $result);
                   
                    if (count($result[0])>0){
                        $name = $result[0][count($result[0])-1];
                       
                        $name = str_replace('/*', '', $name);
                        $name = str_replace('*/', '', $name);
                    }
                    else {
                        $_text = explode(' ', $_text);
                        $_row = count($_text);
                        $input = $_text[$_row-1];
                        $input = explode('.', $input);
                        $_r = count($input);
                        $name = $input[$_r-1]; 
                    }
                    
                    $inputs[$i]['name'] = $name;
                    $inputs[$i]['value'] = '';
                    $inputs[$i]['required'] = true;
                }
                if ($record && count($old_inputs) && count($inputs)){
                    
                   for ($i=0;$i<$row;$i++){
                       
                       if ($inputs[$i]['name'] == $old_inputs[$i]['name']){
                           
                           $inputs[$i]['value'] = $old_inputs[$i]['value'];
                          
                       }
                       else {
                           foreach ($old_inputs as $old){
                               if ($inputs[$i]['name'] == $old['name']){
                                $inputs[$i]['value'] = $old['value'];
                                break;
                                }
                           }
                       }
                   }
                }
            }
            return $inputs;
            
        }
        function getPrimaryModuleFieldsSqlQuery($record){
            $fields = array();
            $sqlQuery = array();
            $value ='';
            if ($record){
                 $db = PearDatabase::getInstance();
                 $result = $db->pquery("SELECT `columnname` FROM `vtiger_relcriteria` WHERE `queryid` = ?", array($record));
                 $arr = $db->fetch_array($result);
                 $value = base64_decode($arr['columnname']);
            }
            $sqlQuery['Query']['name'] = 'Query';
            $sqlQuery['Query']['value'] = $value;
            $sqlQuery['Query']['required'] = true;
            /*$sqlQuery['FOR']['name'] = 'FOR';
            $sqlQuery['FOR']['value'] = '';
            $sqlQuery['FOR']['required'] = true;
            $sqlQuery['JOIN']['name'] = 'JOIN';
            $sqlQuery['JOIN']['value'] = '';
            $sqlQuery['JOIN']['required'] = false;
            $sqlQuery['ON']['name'] = 'ON';
            $sqlQuery['ON']['value'] = '';
            $sqlQuery['ON']['required'] = false;
            $sqlQuery['SELECTJOIN']['name'] = 'SELECT JOIN';
            $sqlQuery['SELECTJOIN']['value'] = '';
            $sqlQuery['SELECTJOIN']['required'] = false;
            //$sqlQuery['WHERE']['name'] = 'WHERE';
            //$sqlQuery['WHERE']['value'] = '';
            //$sqlQuery['WHERE']['required'] = false;
            $fields['sqlQuery'] = $sqlQuery;*/
            return $sqlQuery;
        }

	/**
	 * Function returns Secondary Module fields
	 * @return <Array>
	 */
	function getSecondaryModuleFields() {
		$report = $this->report;
		$secondaryModule = $this->getSecondaryModules();
		$report->getSecModuleColumnsList($secondaryModule);
		return $report->sec_module_columnslist;
	}

	/**
	 * Function returns Report Selected Fields
	 * @return <Array>
	 */
	function getSelectedFields() {
		$db = PearDatabase::getInstance();

		$result = $db->pquery("SELECT vtiger_selectcolumn.columnname FROM vtiger_report
					INNER JOIN vtiger_selectquery ON vtiger_selectquery.queryid = vtiger_report.queryid
					INNER JOIN vtiger_selectcolumn ON vtiger_selectcolumn.queryid = vtiger_selectquery.queryid
					WHERE vtiger_report.reportid = ? ORDER BY vtiger_selectcolumn.columnindex", array($this->getId()));

		$selectedColumns = array();
		for($i=0; $i<$db->num_rows($result); $i++) {
			$column = $db->query_result($result, $i, 'columnname');
			list($tableName, $columnName, $moduleFieldLabel, $fieldName, $type) = split(':', $column);
			$fieldLabel  = explode('_', $moduleFieldLabel);
			$module = $fieldLabel[0];
			$dbFieldLabel = trim(str_replace(array($module, '_'), " ", $moduleFieldLabel));
			$translatedFieldLabel = vtranslate($dbFieldLabel, $module);
			if(CheckFieldPermission($fieldName, $module) == 'true' && $columnName != 'crmid') {
				$selectedColumns[$translatedFieldLabel] = $column;
			}
		}
		return $selectedColumns;
	}

	/**
	 * Function returns Report Calculation Fields
	 * @return type
	 */
	function getSelectedCalculationFields() {
		$db = PearDatabase::getInstance();

		$result = $db->pquery('SELECT vtiger_reportsummary.columnname FROM vtiger_reportsummary
					INNER JOIN vtiger_report ON vtiger_report.reportid = vtiger_reportsummary.reportsummaryid
					WHERE vtiger_report.reportid=?', array($this->getId()));

		$columns = array();
		for($i=0; $i<$db->num_rows($result); $i++) {
			$columns[] = $db->query_result($result, $i, 'columnname');
		}
		return $columns;
	}

	/**
	 * Function returns Report Sort Fields
	 * @return type
	 */
	function getSelectedSortFields() {
		$db = PearDatabase::getInstance();

		//TODO : handle date fields with group criteria
		$result = $db->pquery('SELECT vtiger_reportsortcol.* FROM vtiger_report
					INNER JOIN vtiger_reportsortcol ON vtiger_report.reportid = vtiger_reportsortcol.reportid
					WHERE vtiger_report.reportid = ? ORDER BY vtiger_reportsortcol.sortcolid',array($this->getId()));

		$sortColumns = array();
		for($i=0; $i<$db->num_rows($result); $i++) {
			$column = $db->query_result($result, $i, 'columnname');
			$order = $db->query_result($result, $i, 'sortorder');
			$sortColumns[decode_html($column)] = $order;
		}
		return $sortColumns;
	}

	/**
	 * Function returns Reports Standard Filters
	 * @return type
	 */
	function getSelectedStandardFilter() {
		$db = PearDatabase::getInstance();

		$result = $db->pquery('SELECT * FROM vtiger_reportdatefilter WHERE datefilterid = ? AND startdate != ? AND enddate != ?',
																		array($this->getId(), '0000-00-00', '0000-00-00'));
		$standardFieldInfo = array();
		if($db->num_rows($result)) {
			$standardFieldInfo['columnname'] = $db->query_result($result, 0, 'datecolumnname');
			$standardFieldInfo['type'] = $db->query_result($result, 0, 'datefilter');
			$standardFieldInfo['startdate'] = $db->query_result($result, 0, 'startdate');
			$standardFieldInfo['enddate'] = $db->query_result($result, 0, 'enddate');

			if ($standardFieldInfo['type'] == "custom" || $standardFieldInfo['type'] == "") {
				if ($standardFieldInfo["startdate"] != "0000-00-00" && $standardFieldInfo["startdate"] != "") {
					$startDateTime = new DateTimeField($standardFieldInfo["startdate"] . ' ' . date('H:i:s'));
					$standardFieldInfo["startdate"] = $startDateTime->getDisplayDate();
				}
				if ($standardFieldInfo["enddate"] != "0000-00-00" && $standardFieldInfo["enddate"] != "") {
					$endDateTime = new DateTimeField($standardFieldInfo["enddate"] . ' ' . date('H:i:s'));
					$standardFieldInfo["enddate"] = $endDateTime->getDisplayDate();
				}
			} else {
				$startDateTime = new DateTimeField($standardFieldInfo["startdate"] . ' ' . date('H:i:s'));
				$standardFieldInfo["startdate"] = $startDateTime->getDisplayDate();
				$endDateTime = new DateTimeField($standardFieldInfo["enddate"] . ' ' . date('H:i:s'));
				$standardFieldInfo["enddate"] = $endDateTime->getDisplayDate();
			}
		}

		return $standardFieldInfo;
	}

	/**
	 * Function returns Reports Advanced Filters
	 * @return type
	 */
	function getSelectedAdvancedFilter() {
		$report = $this->report;
		$report->getAdvancedFilterList($this->getId());
		return $report->advft_criteria;
	}

	/**
	 * Function saves a Report
	 */
	function save() {
		$db = PearDatabase::getInstance();
		$currentUser = Users_Record_Model::getCurrentUserModel();

		$reportId = $this->getId();
		if(empty($reportId)) {
			$reportId = $db->getUniqueID("vtiger_selectquery");
			$this->setId($reportId);

			$db->pquery('INSERT INTO vtiger_selectquery(queryid, startindex, numofobjects) VALUES(?,?,?)',
					array($reportId, 0, 0));

			$reportParams = array($reportId, $this->get('folderid'), $this->get('reportname'), $this->get('description'),
					$this->get('reporttype', 'tabular'), $reportId, 'CUSTOM', $currentUser->id, 'Public');
			$db->pquery('INSERT INTO vtiger_report(reportid, folderid, reportname, description,
								reporttype, queryid, state, owner, sharingtype) VALUES(?,?,?,?,?,?,?,?,?)', $reportParams);

                        
			$secondaryModule = $this->getSecondaryModules();
			$db->pquery('INSERT INTO vtiger_reportmodules(reportmodulesid, primarymodule, secondarymodules) VALUES(?,?,?)',
					array($reportId, $this->getPrimaryModule(), $secondaryModule));

			if ($this->getPrimaryModule() == 'sqlQuery'){
                            $select_fields = $this->get('selectedFields');
                           
                            if(empty($select_fields['inputs'])){
                                $select_fields['inputs'] = array();
                            }
                            
                            $input = implode(',', $select_fields['inputs']);
                           
                            $relCriteriaParams = array($reportId, $select_fields['Query'], $input);
                            $db->pquery("INSERT INTO `vtiger_relcriteria` (`queryid`, `columnindex`, `columnname`, `value`, `groupid`,`comparator`) VALUES (?, 0, ?, ?, 1, 'n')", $relCriteriaParams);
                            //print_r ($relCriteriaParams); die;
                        }
                        else {
                        $this->saveSelectedFields();
                        
			$this->saveSortFields();

			$this->saveCalculationFields();

			$this->saveStandardFilter();

			$this->saveAdvancedFilters();
                        }
            $this->saveReportType();

			$this->saveSharingInformation();
		} else {

			$reportId = $this->getId();
                        if ($this->getPrimaryModule() == 'sqlQuery'){
                            $db->pquery('DELETE FROM vtiger_relcriteria WHERE queryid = ?', array($reportId));
                            $select_fields = $this->get('selectedFields');
                            $input = implode(',', $select_fields['inputs']);
                            $relCriteriaParams = array($reportId, $select_fields['Query'], $input);
                            $db->pquery("INSERT INTO `vtiger_relcriteria` (`queryid`, `columnindex`, `columnname`, `value`, `groupid`,`comparator`) VALUES (?, 0, ?, ?, 1, 'n')", $relCriteriaParams);
                            //print_r ($relCriteriaParams); die;
                        }
                        else {
			$db->pquery('DELETE FROM vtiger_selectcolumn WHERE queryid = ?', array($reportId));
			$this->saveSelectedFields();
                        }
			$db->pquery("DELETE FROM vtiger_reportsharing WHERE reportid = ?", array($reportId));
			$this->saveSharingInformation();


			$db->pquery('UPDATE vtiger_reportmodules SET primarymodule = ?,secondarymodules = ? WHERE reportmodulesid = ?',
					array($this->getPrimaryModule(), $this->getSecondaryModules(), $reportId));

			$db->pquery('UPDATE vtiger_report SET reportname = ?, description = ?, reporttype = ?, folderid = ? WHERE
				reportid = ?', array($this->get('reportname'), $this->get('description'), $this->get('reporttype'), $this->get('folderid'), $reportId));


			$db->pquery('DELETE FROM vtiger_reportsortcol WHERE reportid = ?', array($reportId));
			$db->pquery('DELETE FROM vtiger_reportgroupbycolumn WHERE reportid = ?',array($reportId));
			$this->saveSortFields();

			$db->pquery('DELETE FROM vtiger_reportsummary WHERE reportsummaryid = ?', array($reportId));
			$this->saveCalculationFields();

			$db->pquery('DELETE FROM vtiger_reportdatefilter WHERE datefilterid = ?', array($reportId));
			$this->saveStandardFilter();

			$this->saveReportType();

			$this->saveAdvancedFilters();
		}
	}

	/**
	 * Function saves Reports Sorting Fields
	 */
	function saveSortFields() {
		$db = PearDatabase::getInstance();

		$sortFields = $this->get('sortFields');

        if(!empty($sortFields)){
            $i = 0;
            foreach($sortFields as $fieldInfo) {
                $db->pquery('INSERT INTO vtiger_reportsortcol(sortcolid, reportid, columnname, sortorder) VALUES (?,?,?,?)',
                        array($i, $this->getId(), $fieldInfo[0], $fieldInfo[1]));
                if(IsDateField($fieldInfo[0])) {
                    if(empty($fieldInfo[2])){
                        $fieldInfo[2] = 'None';
                    }
                    $db->pquery("INSERT INTO vtiger_reportgroupbycolumn(reportid, sortid, sortcolname, dategroupbycriteria)
                        VALUES(?,?,?,?)", array($this->getId(), $i, $fieldInfo[0], $fieldInfo[2]));
                }
                $i++;
            }
        }
	}

	/**
	 * Function saves Reports Calculation Fields information
	 */
	function saveCalculationFields() {
		$db = PearDatabase::getInstance();

		$calculationFields = $this->get('calculationFields');
		for ($i=0; $i<count($calculationFields); $i++) {
			$db->pquery('INSERT INTO vtiger_reportsummary (reportsummaryid, summarytype, columnname) VALUES (?,?,?)',
					array($this->getId(), $i, $calculationFields[$i]));
		}
	}

	/**
	 * Function saves Reports Standard Filter information
	 */
	function saveStandardFilter() {
		$db = PearDatabase::getInstance();

		$standardFilter = $this->get('standardFilter');
		if(!empty($standardFilter)) {
			$db->pquery('INSERT INTO vtiger_reportdatefilter (datefilterid, datecolumnname, datefilter, startdate, enddate)
							VALUES (?,?,?,?,?)', array($this->getId(), $standardFilter['field'], $standardFilter['type'],
					$standardFilter['start'], $standardFilter['end']));
		}
	}

	/**
	 * Function saves Reports Sharing information
	 */
	function saveSharingInformation() {
		$db = PearDatabase::getInstance();

		$sharingInfo = $this->get('sharingInfo');
		for($i=0; $i<count($sharingInfo); $i++) {
			$db->pquery('INSERT INTO vtiger_reportsharing(reportid, shareid, setype) VALUES (?,?,?)',
					array($this->getId(), $sharingInfo[$i]['id'], $sharingInfo[$i]['type']));
		}
	}

	/**
	 * Functions saves Reports selected fields
	 */
	function saveSelectedFields() {
		$db = PearDatabase::getInstance();

		$selectedFields = $this->get('selectedFields');

        if(!empty($selectedFields)){
           for($i=0 ;$i<count($selectedFields);$i++) {
                if(!empty($selectedFields[$i])) {
                    $db->pquery("INSERT INTO vtiger_selectcolumn(queryid, columnindex, columnname) VALUES (?,?,?)",
                            array($this->getId(), $i, decode_html($selectedFields[$i])));
                }
            }
        }
	}
        function saveSqlQueryFilters() {
            $db = PearDatabase::getInstance();
            $reportId = $this->getId();
            $select_fields = $this->get('selectedFields');
            
            if(is_array($select_fields['inputs'])){
                $input = implode(',', $select_fields['inputs']);
            }
            else $input = $select_fields['inputs'];
            $relCriteriaParams = array($input, $reportId);
            $db->pquery("UPDATE `vtiger_relcriteria` SET `value` = ? WHERE `queryid` = ?", $relCriteriaParams);
            
        }
	/**
	 * Function saves Reports Filter information
	 */
	function saveAdvancedFilters() {
		$db = PearDatabase::getInstance();

		$reportId = $this->getId();
		$advancedFilter = $this->get('advancedFilter');
		if(!empty($advancedFilter)) {

			$db->pquery('DELETE FROM vtiger_relcriteria WHERE queryid = ?', array($reportId));
			$db->pquery('DELETE FROM vtiger_relcriteria_grouping WHERE queryid = ?', array($reportId));

			foreach($advancedFilter as $groupIndex => $groupInfo) {
				if(empty($groupInfo)) continue;

				$groupColumns = $groupInfo['columns'];
				$groupCondition = $groupInfo['condition'];

				foreach($groupColumns as $columnIndex => $columnCondition) {
					if(empty($columnCondition)) continue;

					$advFilterColumn = $columnCondition["columnname"];
					$advFilterComparator = $columnCondition["comparator"];
					$advFilterValue = $columnCondition["value"];
					$advFilterColumnCondition = $columnCondition["column_condition"];

					$columnInfo = explode(":",$advFilterColumn);
					$moduleFieldLabel = $columnInfo[2];

					list($module, $fieldLabel) = explode('_', $moduleFieldLabel, 2);
					$fieldInfo = getFieldByReportLabel($module, $fieldLabel);
					$fieldType = null;
					if(!empty($fieldInfo)) {
						$field = WebserviceField::fromArray($db, $fieldInfo);
						$fieldType = $field->getFieldDataType();
					}

					if($fieldType == 'currency') {
						if($field->getUIType() == '72') {
                            // Some of the currency fields like Unit Price, Totoal , Sub-total - doesn't need currency conversion during save
							$advFilterValue = Vtiger_Currency_UIType::convertToDBFormat($advFilterValue, null, true);
						} else {
							$advFilterValue = Vtiger_Currency_UIType::convertToDBFormat($advFilterValue);
						}
					}

					$tempVal = explode(",",$advFilterValue);
					if(($columnInfo[4] == 'D' || ($columnInfo[4] == 'T' && $columnInfo[1] != 'time_start' && $columnInfo[1] != 'time_end') ||
									($columnInfo[4] == 'DT')) && ($columnInfo[4] != '' && $advFilterValue != '' )) {
						$val = Array();
						for($i=0; $i<count($tempVal); $i++) {
							if(trim($tempVal[$i]) != '') {
								$date = new DateTimeField(trim($tempVal[$i]));
								if($columnInfo[4] == 'D') {
									$val[$i] = DateTimeField::convertToDBFormat(trim($tempVal[$i]));
								} elseif($columnInfo[4] == 'DT') {
                                    /**
                                     * While generating query to retrieve report, for date time fields we are only taking
                                     * date field and appending '00:00:00' for correct results depending on time zone.
                                     * If you save the time also here by converting to db format, while showing in edit
                                     * view it was changing the date selected.
                                     */
                                    $values = explode(' ', $tempVal[$i]);
                                    $date = new DateTimeField($values[0]);
									$val[$i] = $date->getDBInsertDateValue();
								} else {
									$val[$i] = $date->getDBInsertTimeValue();
								}
							}
						}
						$advFilterValue = implode(",", $val);
					}

					$db->pquery('INSERT INTO vtiger_relcriteria (queryid, columnindex, columnname, comparator, value,
						groupid, column_condition) VALUES (?,?,?,?,?,?,?)', array($reportId, $columnIndex, $advFilterColumn,
							$advFilterComparator, $advFilterValue, $groupIndex, $advFilterColumnCondition));

					// Update the condition expression for the group to which the condition column belongs
					$groupConditionExpression = '';
					if(!empty($advancedFilter[$groupIndex]["conditionexpression"])) {
						$groupConditionExpression = $advancedFilter[$groupIndex]["conditionexpression"];
					}
					$groupConditionExpression = $groupConditionExpression .' '. $columnIndex .' '. $advFilterColumnCondition;
					$advancedFilter[$groupIndex]["conditionexpression"] = $groupConditionExpression;
				}

				$groupConditionExpression = $advancedFilter[$groupIndex]["conditionexpression"];
				if(empty($groupConditionExpression)) continue; // Case when the group doesn't have any column criteria

				$db->pquery("INSERT INTO vtiger_relcriteria_grouping(groupid, queryid, group_condition, condition_expression) VALUES (?,?,?,?)",
						array($groupIndex, $reportId, $groupCondition, $groupConditionExpression));
			}
		}
	}

	/**
	 * Function saves Reports Scheduling information
	 */
	function saveScheduleInformation() {
		$db = PearDatabase::getInstance();

		$selectedRecipients = $this->get('selectedRecipients');
		$scheduledInterval = $this->get('scheduledInterval');
		$scheduledFormat = $this->get('scheduledFormat');

		$db->pquery('INSERT INTO vtiger_scheduled_reports(reportid, recipients, schedule, format, next_trigger_time) VALUES
			(?,?,?,?,?)', array($this->getId(), $selectedRecipients, $scheduledInterval, $scheduledFormat, date("Y-m-d H:i:s")));
	}

	/**
	 * Function deletes report scheduling information
	 */
	function deleteScheduling() {
		$db = PearDatabase::getInstance();
		$db->pquery('DELETE FROM vtiger_scheduled_reports WHERE reportid = ?', array($this->getId()));
	}

	/**
	 * Function returns sql for the report
	 * @param <String> $advancedFilterSQL
	 * @param <String> $format
	 * @return <String>
	 */
	function getReportSQL($advancedFilterSQL=false, $format=false) {
		$reportRun = ReportRun::getInstance($this->getId());
		$sql = $reportRun->sGetSQLforReport($this->getId(), $advancedFilterSQL, $format);
		return $sql;
	}
        function getReportSQLQ($advancedFilterSQL=false, $format=false) {
		$reportRun = ReportRun::getInstance($this->getId());
		$sql = $reportRun->sGetSQLQ($this->getId(), $advancedFilterSQL, $format);
		return $sql;
	}
        function getSQLQdata($query) {
               global $adb;
               $result = $adb->pquery($query,array());
               if($result)
			{       $y=$adb->num_fields($result);
				$noofrows = $adb->num_rows($result);
				$custom_field_values = $adb->fetch_array($result);
				$column_definitions = $adb->getFieldsDefinition($result);
                                do
				{
					$arraylists = Array();
                                        for ($i=0; $i<$y; $i++){
                                            $fld = $adb->field_name($result, $i);
                                            $arraylists[$fld->name] = $custom_field_values[$fld->name];
                                            
                                        }
                                      
					$arr_val[] = $arraylists;
					set_time_limit($php_max_execution_time);
				}while($custom_field_values = $adb->fetch_array($result));
                        }
                $data['data'] = $arr_val;
                $data['count'] = $noofrows;
                return $data;
               
        } 

    /**
	 * Function returns sql for count query which don't need any fields
	 * @param <String> $query (with all columns)
	 * @return <String> $query (by removing all columns)
	 */
    function generateCountQuery($query){
        $from = explode(' from ' , $query);
        //If we select the same field in select and grouping/soring then it will include order by and query failure will happen
        $fromAndWhereQuery = explode(' order by ', $from[1]);
        $sql = "SELECT count(*) AS count FROM ".$fromAndWhereQuery[0];
        return $sql;
    }
	/**
	 * Function returns report's data
	 * @param <Vtiger_Paging_Model> $pagingModel
	 * @param <String> $filterQuery
	 * @return <Array>
	 */
	function getReportData($pagingModel = false, $filterQuery = false) {
                
		$reportRun = ReportRun::getInstance($this->getId());
                if ($pagingModel){
                
		$data = $reportRun->GenerateReport('PDF', $filterQuery, true, $pagingModel->getStartIndex(), $pagingModel->getPageLimit());
                }
                else {
                    $data = $reportRun->GenerateReport('PDF', $filterQuery, true);
                }
		return $data;
	}
        function getSqlQueryFiltre () {
                $reportRun = ReportRun::getInstance($this->getId());
                $filtre = $reportRun->getFiltreSqlQuery($this->getId());
                return $filtre;
        }

    function getReportsCount($query = null){
        if($query == null)
            $query = $this->get('recordCountQuery');
        global $adb;
        $count = 0;
        $result = $adb->query($query, array());
        if($adb->num_rows($result) > 0 ){
            $count = $adb->query_result($result, 0, 'count');
        }
        return $count;
    }

	function getReportCalulationData($filterQuery = false) {
		$reportRun = ReportRun::getInstance($this->getId());
		$data = $reportRun->GenerateReport('TOTALXLS', $filterQuery, true);
		return $data;
	}
	/**
	 * Function exports reports data into a Excel file
	 */
	function getReportXLS() {
		$reportRun = ReportRun::getInstance($this->getId());
        $advanceFilterSql = $this->getAdvancedFilterSQL();
		$rootDirectory = vglobal('root_directory');
		$tmpDir = vglobal('tmp_dir');

		$tempFileName = tempnam($rootDirectory.$tmpDir, 'xls');
		$fileName = decode_html($this->getName()).'.xls';
		$reportRun->writeReportToExcelFile($tempFileName, $advanceFilterSql);

		if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
			header('Pragma: public');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		}

		header('Content-Type: application/x-msexcel');
		header('Content-Length: '.@filesize($tempFileName));
		header('Content-disposition: attachment; filename="'.$fileName.'"');

		$fp = fopen($tempFileName, 'rb');
		fpassthru($fp);
		//unlink($tempFileName);
	}

	/**
	 * Function exports reports data into a csv file
	 */
	function getReportCSV() {
               
                require_once('modules/Reports/ReportRunCSV.php');
		$reportRun = ReportRunCSV::getInstance($this->getId());
                $advanceFilterSql = $this->getAdvancedFilterSQL();
		$rootDirectory = vglobal('root_directory');
		$tmpDir = vglobal('tmp_dir');

		$tempFileName = tempnam($rootDirectory.$tmpDir, 'csv');
                
                
		$reportRun->writeReportToCSVFile($tempFileName, $advanceFilterSql);
		$fileName = decode_html($this->getName()).'.csv';

		if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')) {
			header('Pragma: public');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		}

		header('Content-Type: application/csv');
		header('Content-Length: '.@filesize($tempFileName));
		header('Content-disposition: attachment; filename="'.$fileName.'"');

		$fp = fopen($tempFileName, 'rb');
		fpassthru($fp);
	}

	/**
	 * Function returns data in printable format
	 * @return <Array>
	 */
	function getReportPrint() {
		$reportRun = ReportRun::getInstance($this->getId());
        $advanceFilterSql = $this->getAdvancedFilterSQL();
		$data = array();
		$data['data'] = $reportRun->GenerateReport('PRINT', $advanceFilterSql);
		$data['total'] = $reportRun->GenerateReport('PRINT_TOTAL', $advanceFilterSql);
		return $data;
	}

	/**
	 * Function returns reports is default or not
	 * @return <boolean>
	 */
	function isDefault() {
		if ($this->get('state') == 'SAVED') {
			return true;
		}
		return false;
	}

	/**
	 * Function move report to another specified folder
	 * @param folderid
	 */
	function move($folderId) {
		$db = PearDatabase::getInstance();

		$db->pquery("UPDATE vtiger_report SET folderid = ? WHERE reportid = ?", array($folderId, $this->getId()));
	}

	/**
	 * Function to get Calculation fields for Primary module
	 * @return <Array> Primary module calculation fields
	 */
	function getPrimaryModuleCalculationFields() {
		$primaryModule = $this->getPrimaryModule();
		$primaryModuleFields = $this->getPrimaryModuleFields();
		$calculationFields = array();
                
                if (!empty($primaryModule) && $primaryModule != 'sqlQuery'){
		foreach ($primaryModuleFields[$primaryModule] as $blocks) {
			if (!empty ($blocks)) {
				foreach ($blocks as $fieldType => $fieldName) {
					$fieldDetails = explode(':', $fieldType);
                    if($fieldName == 'Send Reminder' && $primaryModule == 'Calendar') continue;
					if ($fieldDetails[4] === "I" || $fieldDetails[4] === "N" || $fieldDetails[4] === "NN") {
						$calculationFields[$fieldType] = $fieldName;
					}
				}
			}
		}
                }
                else {
                    
                }
		$primaryModuleCalculationFields[$primaryModule] = $calculationFields;
		return $primaryModuleCalculationFields;
	}

	/**
	 * Function to get Calculation fields for Secondary modules
	 * @return <Array> Secondary modules calculation fields
	 */
	function getSecondaryModuleCalculationFields() {
		$secondaryModuleCalculationFields = array();
		$secondaryModules = $this->getSecondaryModules();
		if (!empty ($secondaryModules)) {
			$secondaryModulesList = explode(':', $secondaryModules);
			$count = count($secondaryModulesList);

			$secondaryModuleFields = $this->getSecondaryModuleFields();

			for ($i=0; $i<$count; $i++) {
				$calculationFields = array();
				$secondaryModule = $secondaryModulesList[$i];
				foreach ($secondaryModuleFields[$secondaryModule] as $blocks) {
					if (!empty ($blocks)) {
						foreach ($blocks as $fieldType => $fieldName) {
							$fieldDetails = explode(':', $fieldType);
                            if($fieldName == 'Send Reminder' && $secondaryModule == 'Calendar') continue;
							if ($fieldDetails[4] === "I" || $fieldDetails[4] === "N" || $fieldDetails[4] === "NN") {
								$calculationFields[$fieldType] = $fieldName;
							}
						}
					}
				}
				$secondaryModuleCalculationFields[$secondaryModule] = $calculationFields;
			}
		}
		return $secondaryModuleCalculationFields;
	}

	/**
	 * Function to get Calculation fields for entire Report
	 * @return <Array> report calculation fields
	 */
	function getCalculationFields() {
		$primaryModuleCalculationFields = $this->getPrimaryModuleCalculationFields();
		$secondaryModuleCalculationFields = $this->getSecondaryModuleCalculationFields();

		return array_merge($primaryModuleCalculationFields, $secondaryModuleCalculationFields);
	}

	/**
	 * Function used to transform the older filter condition to suit newer filters.
	 * The newer filters have only two groups one with ALL(AND) condition between each
	 * filter and other with ANY(OR) condition, this functions tranforms the older
	 * filter with 'AND' condition between filters of a group and will be placed under
	 * match ALL conditions group and the rest of it will be placed under match Any group.
	 * @return <Array>
	 */
	function transformToNewAdvancedFilter() {
		$standardFilter = $this->transformStandardFilter();
		$advancedFilter = $this->getSelectedAdvancedFilter();
		$allGroupColumns = $anyGroupColumns = array();
		foreach($advancedFilter as $index=>$group) {
			$columns = $group['columns'];
			$and = $or = 0;
			$block = $group['condition'];
			if(count($columns) != 1) {
                foreach($columns as $column) {
					if($column['column_condition'] == 'and') {
						++$and;
					} else {
						++$or;
					}
                }
                if($and == count($columns)-1 && count($columns) != 1) {
					$allGroupColumns = array_merge($allGroupColumns, $group['columns']);
                } else {
					$anyGroupColumns = array_merge($anyGroupColumns, $group['columns']);
                }
            } else if($block == 'and' || $index == 1) {
				$allGroupColumns = array_merge($allGroupColumns, $group['columns']);
            } else {
                $anyGroupColumns = array_merge($anyGroupColumns, $group['columns']);
            }
		}
		if($standardFilter) {
			$allGroupColumns = array_merge($allGroupColumns,$standardFilter);
		}
		$transformedAdvancedCondition = array();
		$transformedAdvancedCondition[1] = array('columns' => $allGroupColumns, 'condition' => 'and');
		$transformedAdvancedCondition[2] = array('columns' => $anyGroupColumns, 'condition' => '');

		return $transformedAdvancedCondition;
	}

	/*
	 *  Function used to tranform the standard filter as like as advanced filter format
	 *	@returns array of tranformed standard filter
	 */
	public function transformStandardFilter(){
		$standardFilter = $this->getSelectedStandardFilter();
		if(!empty($standardFilter)){
			$tranformedStandardFilter = array();
			$tranformedStandardFilter['comparator'] = 'bw';

			$fields = explode(':',$standardFilter['columnname']);

			if($fields[1] == 'createdtime' || $fields[1] == 'modifiedtime' ||($fields[0] == 'vtiger_activity' && $fields[1] == 'date_start')){
				$tranformedStandardFilter['columnname'] = "$fields[0]:$fields[1]:$fields[3]:$fields[2]:DT";
				$date[] = $standardFilter['startdate'].' 00:00:00';
				$date[] = $standardFilter['enddate'].' 00:00:00';
				$tranformedStandardFilter['value'] =  implode(',',$date);
			} else{
				$tranformedStandardFilter['columnname'] = "$fields[0]:$fields[1]:$fields[3]:$fields[2]:D";
				$tranformedStandardFilter['value'] = $standardFilter['startdate'].','.$standardFilter['enddate'];
			}
			return array($tranformedStandardFilter);
		} else{
			return false;
		}
	}

	/**
	 * Function returns the Advanced filter SQL
	 * @return <String>
	 */
	function getAdvancedFilterSQL() {
		$advancedFilter = $this->get('advancedFilter');

		$advancedFilterCriteria = array();
		$advancedFilterCriteriaGroup = array();
		if(is_array($advancedFilter)) {
			foreach($advancedFilter as $groupIndex => $groupInfo) {
				$groupColumns = $groupInfo['columns'];
				$groupCondition = $groupInfo['condition'];

				if (empty ($groupColumns)) {
					unset($advancedFilter[1]['condition']);
				} else {
					if(!empty($groupCondition)){
						$advancedFilterCriteriaGroup[$groupIndex] = array('groupcondition'=>$groupCondition);
					}
				}

				foreach($groupColumns as $groupColumn){
					$groupColumn['groupid'] = $groupIndex;
					$groupColumn['columncondition'] = $groupColumn['column_condition'];
					unset($groupColumn['column_condition']);
					$advancedFilterCriteria[] = $groupColumn;
				}
			}
		}

		$this->reportRun = ReportRun::getInstance($this->getId());

        // SalesPlatform.ru begin
        if(in_array($this->reportRun->reporttype, getCustomReportsList())) {
            $filterQuery = $this->reportRun->generateAdvFilterArray($advancedFilterCriteria);
        } else {
            $filterQuery = $this->reportRun->RunTimeAdvFilter($advancedFilterCriteria, $advancedFilterCriteriaGroup);
        }
        // SalesPlatform.ru end

		return $filterQuery;
	}

	/**
	 * Function to generate data for advanced filter conditions
	 * @param Vtiger_Paging_Model $pagingModel
	 * @return <Array>
	 */
	public function generateData($pagingModel = false, $filterQuery = false) {
                if ($filterQuery == "sqlQuery"){
                    
                    var_dump ($filterQuery);die;
                    
                    $pagingModel = false;
                }
                else {
                    $filterQuery = $this->getAdvancedFilterSQL();
                }
		return $this->getReportData($pagingModel, $filterQuery);
	}

	/**
	 * Function to generate data for advanced filter conditions
	 * @param Vtiger_Paging_Model $pagingModel
	 * @return <Array>
	 */
	public function generateCalculationData() {
		$filterQuery = $this->getAdvancedFilterSQL();
		return $this->getReportCalulationData($filterQuery);
	}
	/**
	 * Function to check duplicate exists or not
	 * @return <boolean>
	 */
	public function checkDuplicate() {
		$db = PearDatabase::getInstance();

		$query = "SELECT 1 FROM vtiger_report WHERE reportname = ?";
		$params = array($this->getName());

		$record = $this->getId();
		if ($record && !$this->get('isDuplicate')) {
			$query .= " AND reportid != ?";
			array_push($params, $record);
		}

		$result = $db->pquery($query, $params);
		if ($db->num_rows($result)) {
			return true;
		}
		return false;
	}

		/**
	 * Function is used for Inventory reports, filters should show line items fields only if they are selected in
	 * calculation otherwise it should not be shown
	 * @return boolean
	 */
	function showLineItemFieldsInFilter($calculationFields=false) {
		if($calculationFields == false) $calculationFields = $this->getSelectedCalculationFields();

		$primaryModule = $this->getPrimaryModule();
		$inventoryModules = array('Invoice', 'Quotes', 'SalesOrder', 'PurchaseOrder');
		if(!in_array($primaryModule, $inventoryModules)) return false;
		if(!empty($calculationFields)) {
			foreach($calculationFields as $field) {
				if(stripos($field, 'cb:vtiger_inventoryproductrel') !== false) {
					return true;
				}
			}
			return false;
		}
		return true;
	}

	public function getScheduledReport(){
		return Reports_ScheduleReports_Model::getInstanceById($this->getId());
	}

    public function getRecordsListFromRequest(Vtiger_Request $request) {
        $folderId = $request->get('viewname');
        $module = $request->get('module');
        $selectedIds = $request->get('selected_ids');
        $excludedIds = $request->get('excluded_ids');

        if(!empty($selectedIds) && $selectedIds != 'all') {
            if(!empty($selectedIds) && count($selectedIds) > 0) {
                return $selectedIds;
            }
        }

        $reportFolderModel = Reports_Folder_Model::getInstance();
        $reportFolderModel->set('folderid', $folderId);
        if($reportFolderModel) {
            return $reportFolderModel->getRecordIds($excludedIds,$module);
        }
    }

    function getModuleCalculationFieldsForReport(){
        $aggregateFunctions = $this->getAggregateFunctions();
		$moduleFields = array();
		$primaryModuleFields = $this->getPrimaryModuleCalculationFields();
		$secondaryModuleFields = $this->getSecondaryModuleCalculationFields();
		$moduleFields = array_merge($primaryModuleFields, $secondaryModuleFields);
		foreach ($moduleFields as $moduleName => $fieldList) {
			$fields = array();
			if(!empty($fieldList)){
				foreach ($fieldList as $column => $label) {
					foreach ($aggregateFunctions as $function) {
						$fLabel = vtranslate($label, $moduleName).' ('.vtranslate('LBL_'.$function, 'Reports').')';
						$fColumn = $column.':'.$function;
						$fields[$fColumn] = $fLabel;
					}
				}
			}
			$moduleFields[$moduleName] = $fields;
		}
		return $moduleFields;
    }

    function getAggregateFunctions(){
        $functions = array('SUM','AVG','MIN','MAX');
        return $functions;
    }

    /**
     * Function to save reprot tyep data
     */
    function saveReportType(){
        $db = PearDatabase::getInstance();
		$data = $this->get('reporttypedata');
        if(!empty($data)){
            $db->pquery('DELETE FROM vtiger_reporttype WHERE reportid = ?', array($this->getId()));
            $db->pquery("INSERT INTO vtiger_reporttype(reportid, data) VALUES (?,?)",
            array($this->getId(), $data));
        }
    }

    function getReportTypeInfo() {
		$db = PearDatabase::getInstance();

		$result = $db->pquery("SELECT data FROM vtiger_reporttype WHERE reportid = ?", array($this->getId()));

		$dataFields = '';
		if($db->num_rows($result) > 0) {
			$dataFields = $db->query_result($result, 0, 'data');
		}
		return $dataFields;
	}

	/**
	 * Function is used in Charts to remove fields like email, phone, descriptions etc
	 * as these fields are not generally used for grouping records
	 * @return $fields - array of report field columns
	 */
	function getPrimaryModuleFieldsForAdvancedReporting() {
		$fields = $this->getPrimaryModuleFields();
		$primaryModule = $this->getPrimaryModule();
		$primaryModuleModel = Vtiger_Module_Model::getInstance($primaryModule);
		$primaryModuleFieldInstances = $primaryModuleModel->getFields();

		if(is_array($fields)) foreach($fields as $module => $blocks) {
			if(is_array($blocks)) foreach($blocks as $blockLabel => $blockFields) {
				if(is_array($blockFields)) foreach($blockFields as $reportFieldInfo => $fieldLabel) {
					$fieldInfo = explode(':',$reportFieldInfo);

					$fieldInstance = $primaryModuleFieldInstances[$fieldInfo[3]];
					if(empty($fieldInstance) || $fieldInfo[0] == 'vtiger_inventoryproductrel' || $fieldInstance->getFieldDataType() == 'email'
							|| $fieldInstance->getFieldDataType() == 'phone' || $fieldInstance->getFieldDataType() == 'image'
							|| $fieldInstance->get('uitype') == '4') {
						unset($fields[$module][$blockLabel][$reportFieldInfo]);
					}
				}
			}
		}
		return $fields;
	}

	/**
	 * Function is used in Charts to remove fields like email, phone, descriptions etc
	 * as these fields are not generally used for grouping records
	 * @return $fields - array of report field columns
	 */
	function getSecondaryModuleFieldsForAdvancedReporting() {
		$fields = $this->getSecondaryModuleFields();
		$secondaryModules = $this->getSecondaryModules();

		$secondaryModules = @explode(':', $secondaryModules);
		if(is_array($secondaryModules)) {
			$secondaryModuleFieldInstances = array();
			foreach($secondaryModules as $secondaryModule) {
				if(!empty($secondaryModule)) {
					$secondaryModuleModel = Vtiger_Module_Model::getInstance($secondaryModule);
					$secondaryModuleFieldInstances[$secondaryModule] = $secondaryModuleModel->getFields();
				}
			}
		}
		if(is_array($fields)) foreach($fields as $module => $blocks) {
			if(is_array($blocks)) foreach($blocks as $blockLabel => $blockFields) {
				if(is_array($blockFields)) foreach($blockFields as $reportFieldInfo => $fieldLabel) {
					$fieldInfo = explode(':',$reportFieldInfo);
					$fieldInstance = $secondaryModuleFieldInstances[$module][$fieldInfo[3]];
					if(empty($fieldInstance) || $fieldInfo[0] == 'vtiger_inventoryproductrel'
							|| $fieldInstance->getFieldDataType() == 'email' || $fieldInstance->getFieldDataType() == 'phone'
								|| $fieldInstance->getFieldDataType() == 'image' || $fieldInstance->get('uitype') == '4') {
						unset($fields[$module][$blockLabel][$reportFieldInfo]);
					}
				}
			}
		}

		return $fields;
	}
}
