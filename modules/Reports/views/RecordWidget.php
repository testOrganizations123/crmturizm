<?php
class Reports_RecordWidget_View extends Vtiger_Index_View {

	public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
                
		$moduleModel = Reports_Module_Model::getInstance($moduleName);

		$record = $request->get('record');
		$reportModel = Reports_Record_Model::getCleanInstance($record);

		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		if(!$currentUserPriviligesModel->hasModulePermission($moduleModel->getId()) && !$reportModel->isEditable()) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
	}
	
	function preProcess(Vtiger_Request $request) {
		
		$moduleName = $request->getModule();
               
		$recordId = $request->get('pid');

		$this->record = $detailViewModel = Reports_DetailView_Model::getInstance($moduleName, $recordId);
                 
		parent::preProcess($request);

		$reportModel = $detailViewModel->getRecord();
                
		$reportModel->setModule('Reports');
                //echo '<pre>';print_r ( $reportModel->report->widget );
                
		$primaryModule = $reportModel->getPrimaryModule();
		$primaryModuleModel = Vtiger_Module_Model::getInstance($primaryModule);
                $currentUser = Users_Record_Model::getCurrentUserModel();
		$userPrivilegesModel = Users_Privileges_Model::getInstanceById($currentUser->getId());
		$permission = $userPrivilegesModel->hasModulePermission($primaryModuleModel->getId());

		if(!$permission) {
			
			exit;
		}

		echo 'OK';
                exit;
		
	}

	function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
		echo $this->getReport($request);
	}

	function getReport(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$record = $request->get('record');

		$reportModel = Reports_Record_Model::getInstanceById($record);
                //echo '<pre>';print_r($reportModel);
		$reportChartModel = Reports_Chart_Model::getInstanceById($reportModel);
		$secondaryModules = $reportModel->getSecondaryModules();
		if(empty($secondaryModules)) {
			$viewer->assign('CLICK_THROUGH', true);
		}

		$viewer->assign('ADVANCED_FILTERS', $request->get('advanced_filter'));
		$viewer->assign('PRIMARY_MODULE_FIELDS', $reportModel->getPrimaryModuleFields());
		$viewer->assign('SECONDARY_MODULE_FIELDS', $reportModel->getSecondaryModuleFields());
		$viewer->assign('CALCULATION_FIELDS', $reportModel->getModuleCalculationFieldsForReport());
        
        $data = $reportChartModel->getData();
		$viewer->assign('CHART_TYPE', $reportChartModel->getChartType());
		$viewer->assign('DATA', json_encode($data, JSON_HEX_APOS));
		$viewer->assign('REPORT_MODEL', $reportModel);


		$viewer->assign('RECORD_ID', $record);
		$viewer->assign('REPORT_MODEL', $reportModel);
		$viewer->assign('SECONDARY_MODULES',$secondaryModules);
		$viewer->assign('MODULE', $moduleName);

		$viewer->view('ChartReportContents.tpl', $moduleName);
	}

	/**
	 * Function to get the list of Script models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_JsScript_Model instances
	 */
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			'modules.Vtiger.resources.Detail',
			"modules.Vtiger.resources.dashboards.Widget",
			"modules.$moduleName.resources.Detail",
			"modules.$moduleName.resources.Edit",
			"modules.$moduleName.resources.Edit3",
			"modules.$moduleName.resources.ChartEdit",
			"modules.$moduleName.resources.ChartEdit2",
			"modules.$moduleName.resources.ChartEdit3",
			"modules.$moduleName.resources.ChartDetail",

			'~/libraries/jquery/jqplot/jquery.jqplot.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.barRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.canvasTextRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.categoryAxisRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.pointLabels.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.highlighter.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.pieRenderer.min.js'
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	/**
	 * Function to get the list of Css models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_CssScript_Model instances
	 */
	public function getHeaderCss(Vtiger_Request $request) {
		$parentHeaderCssScriptInstances = parent::getHeaderCss($request);

		$headerCss = array(
			'~/libraries/jquery/jqplot/jquery.jqplot.min.css',
		);
		$cssScripts = $this->checkAndConvertCssStyles($headerCss);
		$headerCssScriptInstances = array_merge($parentHeaderCssScriptInstances , $cssScripts);
		return $headerCssScriptInstances;
	}

}

