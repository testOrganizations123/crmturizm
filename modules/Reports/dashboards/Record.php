<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Reports_Record_Dashboard extends Vtiger_IndexAjax_View {
	
	/**
	 * Retrieves css styles that need to loaded in the page
	 * @param Vtiger_Request $request - request model
	 * @return <array> - array of Vtiger_CssScript_Model
	 */
	function getHeaderCss(Vtiger_Request $request){
		$cssFileNames = array(
			//Place your widget specific css files here
		);
		$headerCssScriptInstances = $this->checkAndConvertCssStyles($cssFileNames);
		return $headerCssScriptInstances;
	}
    
    function getSearchParams($stage) {
        $listSearchParams = array();
        $conditions = array(array("sales_stage","e",$stage));
        $listSearchParams[] = $conditions;
        return '&search_params='. json_encode($listSearchParams);
    }

	public function process(Vtiger_Request $request) {
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$linkId = $request->get('linkid');
		require_once ('modules/Reports/models/wRecord.php');
		$moduleModel = new Reports_vRecord_Model();
		$record = $moduleModel->getReportsRecord($request);
                $reportModel = Reports_Record_Model::getInstanceById($record);
                $primaryModule = $reportModel->getPrimaryModule();
		$secondaryModules = $reportModel->getSecondaryModules();
		$primaryModuleModel = Vtiger_Module_Model::getInstance($primaryModule);
                $reportChartModel = Reports_Chart_Model::getInstanceById($reportModel);
                $typeChart = $reportChartModel->getChartType();
                //echo '<pre>';print_r ($typeChart);
                $viewer->assign('SCRIPT_JS', $this->addScripChart($typeChart));
                $viewer->assign('TYPECHART', $this->addScripChart($typeChart, true));
                $viewer->assign('SETTING_EXIST', 1);
                $viewer->assign('RECORD', $record);
                $viewer->assign('CHART_MODEL', $reportChartModel);
                $viewer->assign('CLASSHIDE', true);
                $secondaryModules = $reportModel->getSecondaryModules();
                // Advanced filter conditions
                //echo '<pre>';print_r ($reportModel->transformToNewAdvancedFilter());
		$viewer->assign('SELECTED_ADVANCED_FILTER_FIELDS', $reportModel->transformToNewAdvancedFilter());
		$viewer->assign('PRIMARY_MODULE', $primaryModule);
                $viewer->assign('PRIMARY_MODULE_FIELDS', $reportModel->getPrimaryModuleFields());
		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($reportModel);
		$primaryModuleRecordStructure = $recordStructureInstance->getPrimaryModuleRecordStructure();
		$secondaryModuleRecordStructures = $recordStructureInstance->getSecondaryModuleRecordStructure();
            
		$viewer->assign('PRIMARY_MODULE_RECORD_STRUCTURE', $primaryModuleRecordStructure);
		$viewer->assign('SECONDARY_MODULE_RECORD_STRUCTURES', $secondaryModuleRecordStructures);
                //echo '<pre>';print_r ($primaryModuleRecordStructure);
		$secondaryModuleIsCalendar = strpos($secondaryModules, 'Calendar');
		if(($primaryModule == 'Calendar') || ($secondaryModuleIsCalendar !== FALSE)){
			$advanceFilterOpsByFieldType = Calendar_Field_Model::getAdvancedFilterOpsByFieldType();
		} else{
			$advanceFilterOpsByFieldType = Vtiger_Field_Model::getAdvancedFilterOpsByFieldType();
		}
		$viewer->assign('ADVANCED_FILTER_OPTIONS', Vtiger_Field_Model::getAdvancedFilterOptions());
		$viewer->assign('ADVANCED_FILTER_OPTIONS_BY_TYPE', $advanceFilterOpsByFieldType);
        $dateFilters = Vtiger_Field_Model::getDateFilterTypes();
        foreach($dateFilters as $comparatorKey => $comparatorInfo) {
            $comparatorInfo['startdate'] = DateTimeField::convertToUserFormat($comparatorInfo['startdate']);
            $comparatorInfo['enddate'] = DateTimeField::convertToUserFormat($comparatorInfo['enddate']);
            $comparatorInfo['label'] = vtranslate($comparatorInfo['label'],$moduleName);
            $dateFilters[$comparatorKey] = $comparatorInfo;
        }
            $viewer->assign('SECONDARY_MODULE_FIELDS', $reportModel->getSecondaryModuleFieldsForAdvancedReporting());
		$viewer->assign('CALCULATION_FIELDS', $reportModel->getModuleCalculationFieldsForReport());

        $viewer->assign('DATE_FILTERS', $dateFilters);

        
        $data = $reportChartModel->getData();
        //echo $typeChart;
        $function = 'sortData'.$typeChart;
        $data = self::$function($data);
        //echo '<pre>';print_r ($data);
        $widget = Vtiger_Widget_Model::getInstance($linkId, $currentUser->getId());
		
		$viewer->assign('DATA', $data);
		
        $listViewUrl = $moduleModel->getListViewUrl();
       
       
		$viewer->assign('WIDGET', $widget);
		$viewer->assign('MODULE_NAME', $moduleName);
                if ($request->get('full')){
                    $viewer->assign('FULL', $true);
                }

		$viewer->assign('STYLES',$this->getHeaderCss($request));
		$viewer->assign('CURRENTUSER', $currentUser);
             
		$content = $request->get('content');
		if(!empty($content)) {
			$viewer->view('dashboards/DashBoardWidgetContents.tpl', $moduleName); //dashboards/Record.tpl
		} else {
                    
			$viewer->view('dashboards/Record.tpl', $moduleName);
		}
	}
        function  sortDatalineChart($data){
            return $data;
        }
                function sortDatapieChart($data){
            $return = array();
            if (empty($data['values'])) return false;
            foreach ($data['values'] as $key=>$value){
                $return[$key]['amount'] = $value;
            }
            foreach ($data['labels'] as $key=>$value){
                $return[$key]['last_name'] = $value;
            }
            $return[0][2] = 'Prospecting';
            $return[1][2] = 'Value Prospecting';
            foreach ($data['links'] as $key=>$value){
                $return[$key]['links'] = $value;
            }
            /*foreach ($data as $key=>$array){
                switch ($key){
                    case 'labels'; $array_key = 1;break;
                    case 'values'; $array_key = 0;break;
                    case 'links'; $array_key = 'links';break;
                    case 'graph_label'; $array_key = false;
                }
                if ($array_key === false )                    continue;
                foreach ($array as $_key=>$value){
                    $return[$_key][$array_key] = $value;
                }
                
            }
            $return[0][2] = 'Prospecting';
            $return[1][2] = 'Value Prospecting';*/
            return $return;
        }
        function sortDatahorizontalbarChart($data){
            $return = array();
            //echo '<pre>'; print_r($data);
            if (empty($data['values'])) return false;
            if (!empty($data['type'])){
                $return = $data;
                $return['typechar'] = true;
                //echo '<pre>'; print_r($return);
                return $return;
            }
            foreach ($data['values'] as $key=>$value){
                $return[$key][0] = implode(',', $value);
            }
            foreach ($data['labels'] as $key=>$value){
                $return[$key][1] = $value;
            }
            
            foreach ($data['links'] as $key=>$value){
                $return[$key]['links'] = $value;
            }
            if (!empty($data['type'])){
                $return['type'] = $data['type'];
                $return['dlabels'] = $data['data_labels'];
            }
            /*foreach ($data as $key=>$array){
                switch ($key){
                    case 'labels'; $array_key = 1;break;
                    case 'values'; $array_key = 0;break;
                    case 'links'; $array_key = 'links';break;
                    case 'graph_label'; $array_key = false;
                }
                if ($array_key === false )                    continue;
                foreach ($array as $_key=>$value){
                    $return[$_key][$array_key] = $value;
                }
                
            }
            $return[0][2] = 'Prospecting';
            $return[1][2] = 'Value Prospecting';*/
            $return['typechar'] = true;
            //echo '<pre>'; print_r($return);
            return $return;
        }
        function sortDataverticalbarChart($data){
            $return = array();
            if (empty($data['values'])) return false;
            if (!empty($data['type']) && $data['type']=='multiBar'){
                $return = $data;
                return $return;
            }
            //echo '<pre>' ;print_r ($data);
           // foreach ($data['values'] as $key=>$value){
           //     $return[$key][0] = $value;
           // }
           // foreach ($data['labels'] as $key=>$value){
           //     $return[$key][1] = $value;
           // }
            
           // foreach ($data['links'] as $key=>$value){
           //     $return[$key]['links'] = $value;
           // }
           // if (!empty($data['type'])){
           //     $return['type'] = $data['type'];
           //     $return['dlabels'] = $data['data_labels'];
           // }
            foreach ($data as $key=>$array){
                switch ($key){
                    case 'labels'; $array_key = 1;break;
                    case 'values'; $array_key = 0;break;
                    case 'links'; $array_key = 'links';break;
                    case 'graph_label'; $array_key = false;break;
                    case 'type';$array_key = false;break;
                    case 'data_labels';;$array_key = false;break;
                    
                }
                if ($array_key === false )                    continue;
                if (count($array)){
                foreach ($array as $_key=>$value){
                    $return[$_key][$array_key] = $value;
                }
                
                }
                
            }
            $return['data_labels'] = $data['data_labels'];
           
           // echo '<pre>'; print_r($return);
            return $return;
        }
        public function addScripChart($typeChart, $type=false){
        switch ($typeChart){
            case 'pieChart': $text = 'Pie';break;
            case 'verticalbarChart': $text = 'Barchat'; break;
            case 'horizontalbarChart': $text = 'BarchatH';break;
            case 'lineChart':$text = 'Linechart';break;
        }
        if ($type){
            return $text;
        }
            return "<script type='text/javascript'>Vtiger_".$text."_Widget_Js('Vtiger_Record_Widget_Js',{},{});</script>";
        }
}