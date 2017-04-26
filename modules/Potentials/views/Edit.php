<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Class Potentials_Edit_View extends Vtiger_Edit_View {
    function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();
             
              unset($headerScriptInstances['libraries.bootstrap.js.eternicode-bootstrap-datepicker.js.bootstrap-datepicker']);
              unset($headerScriptInstances['~libraries/bootstrap/js/eternicode-bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js']);
              unset($headerScriptInstances['~libraries/jquery/timepicker/jquery.timepicker.min.js']);
              
		$jsFileNames = array(
			
                    '~libraries/jquery/jquery-ui.min.js',
                    "~libraries/jquery/jquery.datetimepicker.js",
            
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

    function process(Vtiger_Request $request) {
        global $current_user;
        $recordId = $request->get('record');
        if(empty($recordId)) {
            parent::process($request);
        } else {
            $recordModel = Vtiger_Record_Model::getInstanceById($recordId);
            $viewer = $this->getViewer($request);
            $error = $recordModel->getErrors();
            //echo '<pre>';print_r($error);echo '</pre>';die;
            $viewer->assign('TYPEUSER', 'reader');
            if ($current_user->id != $recordModel->get('assigned_user_id')) {
                $viewer->assign('ERRORBUTTON', true);
            }
            if (count($error) > 0) {

                $viewer->assign('ERROREDIT', true);
            }
            if (count($error) > 0) {

                $assign_user_id = $recordModel->get('assigned_user_id');
                //echo '<pre>';print_r($error);echo '</pre>';die;

                if ($current_user->id == $assign_user_id) {
                    $viewer->assign('TYPEUSER', 'owner');

                    if (!empty($error[0]['type_error']) && $error[0]['type_error'] == 'assign') {
                        $viewer->assign('ERRORIN', $error[0]['errors']);


                    }
                } else {

                    $errorin = [];
                    $errorout = [];
                    //echo '<pre>';print_r($error);echo '</pre>';die;
                    foreach ($error as $_error) {
                        if (!empty($_error['type_error']) && $_error['type_error'] == 'smowner') {
                            $viewer->assign('TYPEUSER', 'smowner');
                        }
                        if (!empty($_error['type_error']) && $_error['type_error'] == 'smcreator') {
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
    }
        
}