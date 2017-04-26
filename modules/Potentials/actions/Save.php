<?php
/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Potentials_Save_Action extends Vtiger_Save_Action {
        
	public function process(Vtiger_Request $request) {
		//Restrict to store indirect relationship from Potentials to Contacts
		$sourceModule = $request->get('sourceModule');
		$relationOperation = $request->get('relationOperation');

		if ($relationOperation && $sourceModule === 'Contacts') {
			$request->set('relationOperation', false);
		}

		$recordModel = $this->saveRecord($request);
                if ($recordModel->get('printdogovor') == 1 && $recordModel->get('change_field') == 0 ){
                     $vtEntityDelta = new VTEntityDelta();
                     $delta = $vtEntityDelta->getEntityDelta('Potentials', $recordModel->getId(), true);
                     foreach ($delta as $key=>$value){
                        if (in_array($key, $recordModel->array_fields )){
                            $recordModel->set('change_field',1);
                            continue;
                        }
        }
                }
                
                $recordModel->set('potentialname',$recordModel->get('booking_no').' '.$recordModel->get('opportunity_type'));
                $recordModel->set('mode','edit');
                $recordModel->save();
		if($request->get('relationOperation')) {
			$parentModuleName = $request->get('sourceModule');
			$parentRecordId = $request->get('sourceRecord');
			$parentRecordModel = Vtiger_Record_Model::getInstanceById($parentRecordId, $parentModuleName);
			//TODO : Url should load the related list instead of detail view of record
			$loadUrl = $parentRecordModel->getDetailViewUrl();
		} else if ($request->get('returnToList')) {
			$loadUrl = $recordModel->getModule()->getListViewUrl();
		} else {
			$loadUrl = $recordModel->getDetailViewUrl();
                        $loadUrl = 'index.php?module=Potentials&view=Edit&record='.$recordModel->getId();
		}
                
		header("Location: $loadUrl");
	}
        protected function getRecordModelFromRequest(Vtiger_Request $request) {
                global $current_user;
		$moduleName = $request->getModule();
		$recordId = $request->get('record');
                
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		if(!empty($recordId)) {
			$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
			$modelData = $recordModel->getData();
			$recordModel->set('id', $recordId);
			$recordModel->set('mode', 'edit');
		} else {
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$modelData = $recordModel->getData();
			$recordModel->set('mode', '');
		}
 
                $opportunity_type = $request->get('opportunity_type');
                if ($opportunity_type != 'Пакетный Тур'){
                    $request->set('addservise', $request->get('addservise_ticket'));
                    $addservisepaslist = $request->get('addservisepaslist');
                    foreach($addservisepaslist as $key=>$list){
                        $addservisepaslist[$key] = implode(',',$list);
                    }
                    $addservisepaslist = implode('#', $addservisepaslist);
                    $request->set('addservisepaslist', $addservisepaslist);
                    if ($opportunity_type == 'Авиа билеты' || $opportunity_type == 'ЖД билеты'){
                        $dep_list_pass = $request->get('dep_list_pass');
                        foreach($dep_list_pass as $key=>$list){
                            $dep_list_pass[$key] = implode(',',$list);
                        }
                        $dep_list_pass = implode('#', $dep_list_pass);
                        $request->set('dep_list_pass', $dep_list_pass);
                        $arr_list_pass = $request->get('arr_list_pass');
                        foreach($arr_list_pass as $key=>$list){
                            $arr_list_pass[$key] = implode(',',$list);
                        }
                        $arr_list_pass = implode('#', $arr_list_pass);
                        $request->set('arr_list_pass', $arr_list_pass);
                        
                        
                    }
                    if ($opportunity_type == 'ЖД билеты'){
                        $request->set('dep_airline',$request->get('dep_airline_rail'));
                        $request->set('arr_airline',$request->get('arr_airline_rail'));
                        $request->set('dep_departure',$request->get('dep_departure_rail'));
                        $request->set('arr_departure',$request->get('arr_departure_rail'));
                        $request->set('dep_arrival',$request->get('dep_arrival_rail'));
                        $request->set('arr_arrival',$request->get('arr_arrival_rail'));
                        
                        
                    }
                    if ($opportunity_type == 'Индивидуальный Тур'){
                       $turoperator = array();
                       $row = $request->get('ind_hotel');
                       $arrival = false;
                       foreach ($row as $value){
                           $turoperator[$value['turoperator']] = $value['turoperator']; 
                          
                       }
                       $row = $request->get('ind_flyte');
                       foreach ($row as $value){
                           $turoperator[$value['turoperator']] = $value['turoperator'];  
                            if (!$arrival) $arrival[0] = $value['departure_date'];
                           $departure[0] = $value['arrival_date'];
                       }
                       $row = $request->get('ind_gid');
                       foreach ($row as $value){
                           $turoperator[$value['turoperator']] = $value['turoperator'];  
                       }
                       $row = $request->get('ind_inshure');
                       foreach ($row as $value){
                           $turoperator[$value['turoperator']] = $value['turoperator'];  
                       }
                       $row = $request->get('ind_servise');
                       foreach ($row as $value){
                           $turoperator[$value['turoperator']] = $value['turoperator'];  
                       }
                       $row = $request->get('ind_transfer');
                       foreach ($row as $value){
                           $turoperator[$value['turoperator']] = $value['turoperator'];  
                       }
                       $row = $request->get('ind_trail');
                       foreach ($row as $value){
                           $turoperator[$value['turoperator']] = $value['turoperator'];  
                       }
                       
                      $request->set('dep_time_departure',  $arrival); 
                      $request->set('arr_time_arrival',  $departure);
                        $request->set('ind_hotel',  serialize($request->get('ind_hotel')));
                        $request->set('ind_flyte',  serialize($request->get('ind_flyte')));
                        $request->set('ind_gid',  serialize($request->get('ind_gid')));
                        $request->set('ind_inshure',  serialize($request->get('ind_inshure')));
                        $request->set('ind_servise',  serialize($request->get('ind_servise')));
                        $request->set('ind_transfer',  serialize($request->get('ind_transfer')));
                        $request->set('ind_trail',  serialize($request->get('ind_trail')));
                        
                      // echo '<pre>';print_r($request);echo '</pre>';die();
                        
                       
                    }
                    
                }
		$fieldModelList = $moduleModel->getFields();
		foreach ($fieldModelList as $fieldName => $fieldModel) {
			$fieldValue = $request->get($fieldName, null);
                        if ($fieldName == 'control_data' && !empty($fieldValue)){
                            $fieldValue = date('Y-m-d H:i:s', strtotime($fieldValue));
                        } else if ($fieldName == 'control_data' && empty($fieldValue)) {
                        $fieldValue = '0000-00-00 00:00:00';
                        }
                        else {
			$fieldDataType = $fieldModel->getFieldDataType();
			if($fieldDataType == 'time'){
				$fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
			}
                        }
			if($fieldValue !== null) {
				if(!is_array($fieldValue)) {
					$fieldValue = trim($fieldValue);
				}
                                else if ($fieldName == 'cf_1270'){
                                    foreach($fieldValue as $id=>$value){
                                        if (empty($value)) $value = "MY";
                                        $fieldValue[$id] = $value;
                                    } 
                                    $fieldValue = Zend_Json::encode($fieldValue);                                   
                                }
                                else if ($fieldName == 'visa_doc'){
                                   
                                    $fieldValue = Zend_Json::encode($fieldValue);
                                }
                                else if ($fieldName == 'turoperator' && empty($fieldValue)){
                                   
                                    $fieldValue = $request->get('turoperator_ticket');
                                }
                                else {
                                    //echo $fieldName; print_r ($fieldValue);
                                    $fieldValue = implode('#', $fieldValue);
                                    
                                }
				$recordModel->set($fieldName, $fieldValue);
			}
		}
                if ($recordModel->get('hotel')){
                    $recordModel->set('cf_1368', $this->getStars($recordModel->get('hotel')));
                }
                
               $dep_time_departure = $request->get('dep_time_departure');
                if (!empty($dep_time_departure[0])){
                    $recordModel->set('date_start', date('Y-m-d H:i:s', strtotime($dep_time_departure[0])));
                }
                else $recordModel->set('date_start',NULL);
                $arr_time_arrival = $request->get('arr_time_arrival');
                if (!empty($arr_time_arrival[count($arr_time_arrival)-1])){
                $recordModel->set('due_data', date('Y-m-d H:i:s', strtotime($arr_time_arrival[count($arr_time_arrival)-1])));
                 }
                 else $recordModel->set('due_data', NULL);
                 if ($opportunity_type == 'Авиа билеты' || $opportunity_type == 'ЖД билеты'){
                     $recordModel->set('tur_vendor', $request->get('turoperator_ticket'));
                     $recordModel->set('turoperator', $request->get('turoperator_ticket'));
                 }
                 else {
                    $recordModel->set('tur_vendor', $this->getTuroperatotEntity($recordModel->get('turoperator'), $recordModel->get('spcompany')));
                 }
                
                if ($recordModel->get('newexchange') != $recordModel->get('exchange') && $recordModel->get('newexchange') > 0){
                    $recordModel->set('cf_1296', ($recordModel->get('cf_1296') + $recordModel->get('newexchange') - $recordModel->get('exchange')));
                    $recordModel->set('exchange', $recordModel->get('newexchange'));
                    $recordModel->set('amount', ($recordModel->get('amount') + $recordModel->get('addcursamount')-$recordModel->entity->column_fields['addcursamount']));
                   
                }
                if ($recordModel->entity->column_fields['book_reset']!=$recordModel->get('book_reset')){
                   
                    if ($recordModel->get('book_reset')=='on'){
                        $recordModel->set('sales_stage', 'Closed Lost');
                    }
                    else {
                        $recordModel->set('sales_stage', $this->getSalesStage($recordModel));
                    }
                   
                   
                }
                if ($recordId > 0){
                     $recordModel->set('paid', $this->getPaidTurist($recordId));
                    $recordModel->set('balance', ($recordModel->get('amount') - $recordModel->get('paid')));
                     $recordModel->set('paid_to', $this->getPaidTo($recordId));
                     $recordModel->set('balance_to', ($recordModel->get('pay_to') - $recordModel->get('paid_to')));
                      if ($opportunity_type == 'Индивидуальный Тур'){
                          $payto_vendor = $request->get('payto_vendor');
                          $balance_vendor = array();
                          foreach ($payto_vendor as $key=>$value){
                              $balance_vendor[$key] = $value - $this->getPaidToVendor($recordId,$key);
                          }
                        $recordModel->set('balance_vendor',  serialize($balance_vendor));
                        $recordModel->set('payto_vendor',  serialize($payto_vendor));
                      }
                }
                
                if (empty($recordModel->entity->column_fields['start_pay_to'])){
                    $recordModel->set('start_pay_to', $recordModel->get('pay_to'));
                }
                $id_dogovor = explode(":",$recordModel->get('dogovor_id_turist'));
                $contact_id = $request->get('contact_id');
                if (count($id_dogovor) == 0){
                    $id_dogovor = false;
                }
                else if(empty($contact_id)){
                    $recordModel->set('contact_id', $id_dogovor[0]);
                }
                else {
                    $recordModel->set('contact_id', $contact_id);
                }
                $dogovor = $recordModel->get('dogovor');
                $office = $recordModel->get('office');
               
                if (empty($office)){
                    $recordModel->set('office', $current_user->column_fields['office']);
                    $office = $recordModel->get('office');
                }
                $spcompany = $recordModel->get('spcompany');
                if(empty($spcompany) && !empty($office)){
                    $spcompany = $this->getCompany($office);
                    $recordModel->set('spcompany', $spcompany);
                }
                $to = $recordModel->get('turoperator');
                if((empty($recordId) || empty($dogovor)) && !empty($spcompany) && !empty($to) && $id_dogovor && !empty($office)){
                    $recordModel->set('dogovor', $this->getDogovorNumber($request->get('office')));
                    $recordModel->set('datedogovor', date('Y-m-d'));
                }
                else if ($opportunity_type == 'Индивидуальный Тур' && (empty($recordId) || empty($dogovor)) && !empty($spcompany) && !empty($office) && $id_dogovor){
                    $recordModel->set('dogovor', $this->getDogovorNumber($request->get('office')));
                    $recordModel->set('datedogovor', date('Y-m-d'));
                }
                if ($opportunity_type == 'Индивидуальный Тур'){
                    $array_t = array();
                    foreach ($turoperator as $value){
                        $array_t[$value]= $this->getTuroperatotEntity($value, $recordModel->get('spcompany'));
                    }
                     $recordModel->set('listturoperator', serialize($array_t));
                }
                if ($recordModel->get('pay_to') > 0){
                $comission = $recordModel->get('amount') - $recordModel->get('pay_to');
                $comission_pr = $comission / $recordModel->get('pay_to') * 100;
                } else {
                    $comission = 0.00;
                    $comission_pr = 0.00;
                }
               
                if ((int)$recordModel->get('amount') > 0 && $recordModel->get('exchange') > 0){
                    
                    $recordModel->set('amount_cur', number_format(($recordModel->get('amount')/$recordModel->get('exchange')),2,".",""));
                }
               
                $recordModel->set('comission', $comission);
                $recordModel->set('comission_pr', number_format($comission_pr,2,".",""));
                
		return $recordModel;
	}
        public function getStars($str){
            if(strpos($str, "5*") || strpos($str, "5 *") ){
                return 5;
            }
            elseif(strpos($str, "4*") || strpos($str, "4 *") ){
                return 4;
            }
            elseif(strpos($str, "3*") || strpos($str, "3 *") ){
                return 3;
            }
            elseif(strpos($str, "2*") || strpos($str, "2 *") ){
                return 2;
            }
            elseif(strpos($str, "1*") || strpos($str, "1 *") ){
                return 1;
            }
            else {
                return 0;
            }
        }
        public function getCompany($office){
            global $adb;
            $sql = "SELECT * FROM vtiger_office WHERE officeid = ?";
            $result = $adb->pquery($sql, array($office));
            return $adb->query_result($result,0,'spcompany');
        }
        public function getSalesStage($recordModel){
            return 'Новый';
        }
        public function getPaidTo($recordId){
            global $adb;
            $sql = "SELECT sum(a.amount) as sum FROM sp_payments as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.payid WHERE c.deleted = 0 and a.related_to = ? and a.pay_type= ? and spstatus = ?";
           $result = $adb->pquery($sql,array($recordId,'Expense','Executed'));
           return $adb->query_result($result,0,'sum');
        }
        public function getPaidToVendor($recordId,$vendor){
            global $adb;
            $sql = "SELECT sum(a.amount) as sum FROM sp_payments as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.payid WHERE c.deleted = 0 and a.related_to = ? and a.pay_type= ? and spstatus = ? and payer =?";
           $result = $adb->pquery($sql,array($recordId,'Expense','Executed',$vendor));
           return $adb->query_result($result,0,'sum');
        }
        public function getPaidTurist($recordId){
            global $adb;
            $sql = "SELECT sum(a.amount) as sum FROM sp_payments as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.payid WHERE c.deleted = 0 and a.related_to = ? and a.pay_type= ? and spstatus = ?";
           $result = $adb->pquery($sql,array($recordId,'Receipt','Executed'));
           return $adb->query_result($result,0,'sum');
        }
        public function getTuroperatotEntity($touroperator, $spcompany){
            global $adb;
            //echo '<pre>';print_r($touroperator);print_r($spcompany);echo '</pre>';die();
            if (!empty($touroperator) && !empty($spcompany)){
            $sql = "Select a.* FROM vtiger_crmentityrel as a LEFT JOIN vtiger_vendor as v ON v.vendorid = a.relcrmid WHERE a.crmid = ? and v.spcompany LIKE '%$spcompany%'";
            $result = $adb->pquery(htmlspecialchars_decode($sql), array($touroperator));
            //echo '<pre>';var_dump($result);echo '</pre>';die();
            return $adb->query_result($result,0,'relcrmid');
            }
            
        }
        
        public function getDogovorNumber($officeName){
            global $adb;
            $year = date('Y');
            $sql = "Select dogovor_number.*, vtiger_office.* FROM dogovor_number LEFT JOIN vtiger_office ON vtiger_office.officeid = dogovor_number.office_id"
                    . " LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_office.officeid"
                    . " WHERE vtiger_crmentity.deleted = 0 and vtiger_office.officeid = ? and dogovor_number.year = ?";
            
            $result = $adb->pquery($sql, array($officeName, $year));
            $numRows = $adb->num_rows($result);
            if ($numRows == 0){
                $number = $this->insertDogovorRow($officeName, $year);
            }
            else {
               $prefix = $adb->query_result($result,0,'prefix');
               $office_id = $adb->query_result($result,0,'officeid');
               $id = $adb->query_result($result,0,'number')+1;
               $this->updateDogovorRow($office_id,$id,$year);
               $number = $id .'/'.$prefix;
            }
            return $number;
        }
        public function insertDogovorRow($officeName, $year){
            global $adb;
            $sql = "SELECT vtiger_office.* FROM vtiger_office LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_office.officeid"
                    . " WHERE vtiger_crmentity.deleted = 0 and vtiger_office.officeid = ?";
            
            $result = $adb->pquery($sql, array($officeName));
            $prefix = $adb->query_result($result,0,'prefix');
            $id = $adb->query_result($result,0,'officeid');
            
            $sql = "INSERT INTO dogovor_number (office_id, number, year) VALUE (?,?,?)";
           
            $result = $adb->pquery($sql, array($id,1,$year));
            return '1/'.$prefix;
        }
         public function updateDogovorRow($office_id,$number, $year){
            global $adb;
            $sql = "UPDATE dogovor_number SET number = ? WHERE office_id = ?  and year = ?";
            $result = $adb->pquery($sql, array($number,$office_id,$year));
         }    
}
