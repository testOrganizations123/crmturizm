<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
ini_set('display_errors',1);
error_reporting(E_ERROR);
class FoulList_SaveAjax_Action extends FoulList_Save_Action {

	public function process(Vtiger_Request $request) {
	    $mode = $request->get('mode');
	    if (empty($mode) || $mode == "reload") {
            $recordModel = $this->saveRecord($request);

            $fieldModelList = $recordModel->getModule()->getFields();
            $result = array();
            foreach ($fieldModelList as $fieldName => $fieldModel) {
                $recordFieldValue = $recordModel->get($fieldName);
                if (is_array($recordFieldValue) && $fieldModel->getFieldDataType() == 'multipicklist') {
                    $recordFieldValue = implode(' |##| ', $recordFieldValue);
                }
                $fieldValue = $displayValue = Vtiger_Util_Helper::toSafeHTML($recordFieldValue);
                if ($fieldModel->getFieldDataType() !== 'currency' && $fieldModel->getFieldDataType() !== 'datetime' && $fieldModel->getFieldDataType() !== 'date') {
                    $displayValue = $fieldModel->getDisplayValue($fieldValue, $recordModel->getId());
                }

                $result[$fieldName] = array('value' => $fieldValue, 'display_value' => $displayValue);
            }
            $result['_recordLabel'] = $recordModel->getName();
            $result['_recordId'] = $recordModel->getId();
        }
        elseif ($mode == 'foulFix') {
	        $this->foulFix($request);
        }
        if ($mode== "reload"){
	        $url = "index.php?module=Leads&view=Detail&record=".$request->get('target');
	        header ('Location:'.$url);
	        exit();
        }

        $result['_reload'] = 'reload';
		$response = new Vtiger_Response();
		$response->setEmitType(Vtiger_Response::$EMIT_JSON);
		$response->setResult($result);
		$response->emit();
	}

	/**
	 * Function to get the record model based on the request parameters
	 * @param Vtiger_Request $request
	 * @return Vtiger_Record_Model or Module specific Record Model instance
	 */
	
}
