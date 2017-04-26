<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: SalesPlatform Ltd
 * The Initial Developer of the Original Code is SalesPlatform Ltd.
 * All Rights Reserved.
 * If you have any questions or comments, please email: devel@salesplatform.ru
 ************************************************************************************/

class SPPayments_Module_Model extends Vtiger_Module_Model {

    /**
     * Function to check whether the module is summary view supported
     * @return Boolean - true/false
     */
    public function isSummaryViewSupported() {
        return false;
    }
    public function deleteRecord($recordModel) {
		$moduleName = $this->get('name');
                $relatedModule_ID = $recordModel->get('related_to');
                $type = $recordModel->get('pay_type');
		$focus = CRMEntity::getInstance($moduleName);
		$focus->trash($moduleName, $recordModel->getId());
               
                $this->CalculatePayment($relatedModule_ID,$type);
                if(method_exists($focus, 'transferRelatedRecords')) {
			if($recordModel->get('transferRecordIDs'))
				$focus->transferRelatedRecords($moduleName, $recordModel->get('transferRecordIDs'), $recordModel->getId());
		}
	}
        
    public function CalculatePayment($recordId,$type){
               $moduleName = 'Potentials';
               $recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
               $recordModel->CalculatePayment($type);
               $recordModel->set('mode', 'edit');
               
               $recordModel->save();
            }
    public function saveRecord($recordModel) {
		$moduleName = $this->get('name');
		$focus = CRMEntity::getInstance($moduleName);
		$fields = $focus->column_fields;
		foreach($fields as $fieldName => $fieldValue) {
			$fieldValue = $recordModel->get($fieldName);
			if(is_array($fieldValue)){
                $focus->column_fields[$fieldName] = $fieldValue;
            }else if($fieldValue !== null) {
				$focus->column_fields[$fieldName] = decode_html($fieldValue);
			}
		}
		$focus->mode = $recordModel->get('mode');
		$focus->id = $recordModel->getId();
                
		$focus->save($moduleName);
                $relatedModule_ID = $recordModel->get('related_to');
                 $type = $recordModel->get('pay_type');
                 if(!empty($relatedModule_ID)){
                      $this->CalculatePayment($relatedModule_ID,$type);
                 }
                 if (!empty($recordModel->get('fosa_id'))){
                     $this->changeFosa($recordModel);
                 }
		return $recordModel->setId($focus->id);
	}
    public function changeFosa($data){
        $id = $data->get('fosa_id');
        $recordModel = Vtiger_Record_Model::getInstanceById($id, 'Fosa');
        $recordModel->set('mode', 'edit');
        $recordModel->set('statatus_fosa', 'Payment');
        $recordModel->set('contact_id', $data->get('payer'));
        $recordModel->set('related_to', $data->get('related_to'));
        $recordModel->set('amount', $data->get('amount'));
        $recordModel->set('data_payment', $data->get('pay_date'));
        $recordModel->save();
    }
}
