<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class Potentials_PrintMode_Action extends Vtiger_Action_Controller{
    function __construct() {
        parent::__construct();
        $this->exposeMethod('printDogovor');
        $this->exposeMethod('printDopnik');
    }
    public function checkPermission(Vtiger_Request $request) {
		
	}
    public function process(Vtiger_Request $request) {
                       $this->record = $request->get('record');
                       $mode = $request->getMode();
		if(!empty($mode) && $this->isMethodExposed($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
    }
    public function printDogovor(Vtiger_Request $request){
        global $adb;
       
        $recordModel = Vtiger_Record_Model::getInstanceById($this->record, 'Potentials');
         $stamp = array();
         foreach ($recordModel->entity->column_fields as $key=>$value){
                        if (in_array($key, $recordModel->array_fields )){
                            $stamp[0][$key] = $value;
                            
                        }
         }
       $stamp = serialize($stamp);
        $sql = "UPDATE vtiger_potentialscf SET cf_1446=1, cf_1448 = cf_1448 + 1, cf_1452 = 0,cf_1450 = 0, stamp_data = ? WHERE potentialid =?";
        $response = new Vtiger_Response();
        $response->setResult($adb->pquery($sql,array($stamp,$this->record)));
        $response->emit();
                
    }
    public function printDopnik(Vtiger_Request $request){
        global $adb;
       
        $recordModel = Vtiger_Record_Model::getInstanceById($this->record, 'Potentials');
         $stamp = unserialize(htmlspecialchars_decode($recordModel->get('stamp_data')));
         $keyArray = count($stamp);
         foreach ($recordModel->entity->column_fields as $key=>$value){
                        if (in_array($key, $recordModel->array_fields )){
                            $stamp[$keyArray][$key] = $value;
                            
                        }
         }
       $stamp = serialize($stamp);
        $sql = "UPDATE vtiger_potentialscf SET cf_1450 = cf_1450 + 1, cf_1452 = 0, stamp_data = ? WHERE potentialid =?";
        $response = new Vtiger_Response();
        $response->setResult($adb->pquery($sql,array($stamp,$this->record)));
        $response->emit();
                
    }
}