<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
include_once 'vtlib/Vtiger/Module.php';
require_once 'include/utils/utils.php';
require_once 'includes/Loader.php';
vimport ('includes.runtime.EntryPoint');
// ---  создание базы данных 
ini_set('display_errors',1);
error_reporting(E_ERROR);
$HOST = "193.124.177.160";      
$USER = "crmturizm";        
$PASS = "I0y7Y2s0";       

 
die();
$connection = new mysqli($HOST,$USER,$PASS, 'crmturizm');
$connection->set_charset("utf8"); //order by a.lead_id LIMIT 2000, 1000
$query = "select a.*, b.* FROM crm__lead as a LEFT JOIN crm__task as b ON b.lead_id = a.lead_id WHERE a.office_id in (29,30,31) order by a.lead_id LIMIT 3000, 1000";
$r = $connection->query($query);
$array = array();
while( $row = $r->fetch_assoc() ){
       $array[] = $row;
    }

    /* Освобождаем память */
    $r->close();
foreach ($array as $key=>$book){
    if (!empty($book['task_id'])){
    $sql = "select * FROM crm__task_target WHERE task_id =".$book['task_id']." order by task_target_id ASC";
   echo $sql;
    $r = $connection->query($sql);
       while( $row = $r->fetch_assoc()){
        $book['comment'][] = $row;
        }
        $r->close();
    
       }
      
       $import = new import_contact($book);
$import->process();
echo '<pre>'.$key.'</pre>';
} 
    
//    print_r ($array);//die;
//$import = new import_contact($array);
//$import->process();

class import_contact {
    public $db;
    public $data;
     public $user = array(
    53=>66,
    56=>13,
        54=>44,
        55=>22,
    57=>47,
    58=>72,
        59=>55,
        60=>8,
        61=>16,
        62=>65,
        63=>59,
        65=>60,
        66=>59,
    67=>57,
    68=>59,
    69=>14,
        
    70=>13,
    71=>53,
    72=>53,
    73=>56,
    74=>64,
    75=>64,
        77=>80,
        78=>38,
        80=>39,
        81=>44,
        82=>10,
        83=>9,
        84=>9,
        85=>9,
        86=>9,
        
        
        87=>29,
        88=>36,
        89=>34,
        90=>37,
        91=>40,
        92=>40,
        93=>29,
        94=>16,
        95=>16,
        96=>16,
        
        98=>31,
        99=>30,
        100=>31,
        101=>31,
        102=>31,
        103=>31,
        
    105=>54, 
        106=>19,
        108=>19,
        109=>31,
        110=>23,
        111=>20,
        112=>21,
    113=>13,
    114=>77,
        115=>17,
    116=>15,
    118=>53,
    120=>59,
        121=>31,
        122=>18,
    126=>61,
        127=>16,
        128=>31,
    129=>13,
        130=>19,
        131=>59,
         132=>73,
        133=>16,
        134=>31,
    135=>47,
        136=>64,
        137=>31,
        138=>24,
    139=>48,
    140=>65,
    141=>62,
    142=>47,
        143=>41,
        144=>31,
        155=>9,
    156=>66,
        157=>9,
    158=>67,
        159=>81,
        160=>59,
        161=>16,
        162=>31,
        163=>16,
        164=>40,
        168=>47,
        165=>9,
        166=>19,
        167=>79,
        169=>11,
        171=>9,
        172=>32,
         173=>49,
        174=>55,
        176=>74,
        177=>55,
       178=>65,
        179=>12,
        180=>9,
        182=>50,
        181=>55,
        
    184=>51,
        185=>16,
        186=>40,
        187=>40,
        188=>33,
        189=>29,
    190=>42,
        193=>26,
        194=>31,
        
    196=>52,
        197=>24,
        198=>43,
        199=>40,
        201=>23,
        203=>46,
        204=>45,
        205=>76,
     
);
    public $spcompany = array(
        4=>'ИП Миндюк А.В.',
        5=>'ИП Миндюк Ю.Х.',
        6=>'ИП Верещака А.Б.',
    );
    public $sourselid = array(   4=>"Входящий звонок",
                                 3=>"Заявка с сайта на подбор тура",
                                 12=>"Заказ с поисковика на сайте",
                                 13=>"Заявка с сайта на покупку тура",
                                 7=>"Встреча в офисе",
                                 14=>"Обратный звонок",
                                 6=>"ICQ",
                                 5=>"Соц. сети",
                                 0=>"Другое",);
    public $typeCl = array(      10=>"Клиент - Горячий тур",
                                 11=>"Клиент-готов купить тур",
				9=>"Клиент - Постоянный",
				5=>"Клиент - Скидочник",
				8=>"Клиент - Скидочник",
				6=>"Клиент - Скидочник",
				7=>"Клиент - Скидочник",);
    
    
    public $typedocvisa = array ('NOT_NEEDED'=>'Виза не нужна',
      "NO_DOCUMENTS"=>'Нет документов',
      "COLLECTED"=>'Документы собраны',
      "SENT"=>"Документы отправлены",
      "RECEIVED"=>"Виза получена",
      "ISSUED"=>"Выдана");
    public $docstatus  = array ('NOT_READY'=>'Не готовы',
      "READY"=>'Готовы',
      "ISSUED"=>"Выданы");
    public $transfer = array (0=>'без трансфера', 1=>'с трансфером');
    public $helthinshurence = array(0=>'Нет', 1=>'Да');
    public $male = array('MALE'=>'Мужской','FAMALE'=>'Женский');
    public $statusTask = array ("PERFORMED"=>"Planned",
				"ACHIEVED"=>"Продажа",
				"REJECTED"=>"Отказ",
                                "NEW"=>"Новая",);
    function __construct($array) {
        $this->data = $array;
    }
   
    function process(){
         global $current_user, $adb;
         $current_user = Users::getActiveAdminUser();
         
        $moduleName = 'Leads';
        
        
        $value = $this->data;
       // foreach ($array_data_int as $key=>$value){
        //     if ($index_i > $limit) continue;
       //      $index_i++;
            //$recordId = $this->checkContact($value['booking_id']);
            //if($recordId) continue;
            $record = Vtiger_Record_Model::getCleanInstance($moduleName);
            //print_r(str_replace('"', '',implode('#',(unserialize($value['booking_hotel_room_type'])))));
            //die();
            $record->set('firstname', $value['lead_client_name']);
            $record->set('industry', $this->male[$value['lead_client_gender']]);
            $record->set('assigned_user_id', $this->user[$value['user_id']]);
            $record->set('email', $value['lead_client_email']);
            $record->set('mobile', $this->phoneCreat($value['lead_client_phone']));
            $record->set('leadsource', $this->sourselid[$value['book_source_id']]);
            
            $record->set('rating', $this->typeCl[$value['book_type_id']]);
            
            $record->set('country',$value['lead_country']);
            $record->set('annualrevenue',$value['lead_budget']);
            $record->set('departure',$value['lead_departure_from_text']);
            $record->set('adults',$value['lead_adult_count']);
            $record->set('night',$value['lead_duration']);
            $record->set('children',$value['lead_children_count']);
            $record->set('childrenyear',$value['lead_children_age']);
            $record->set('cf_1103',$value['task_current']);
            $record->set('basicneeds',$value['lead_client_wishes']);
            $dateTask = $value['task_date'];
            $date = date('Y-m-d', strtotime($dateTask));
            $time = date('H:i:s', strtotime($dateTask));
            $record->set('date_start',$date);
            $record->set('time_start',$time);
            
            $record->save();
           
            if (strtotime($value['task_date']) > strtotime('2016-08-01 00:00:01')){
                echo 'OK';
                $this->saveEvent($value, $record);
            }
        }
    
    public function saveEvent($value,$LeadsModel){
         
            $moduleName = 'Events';
            $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
            $event = $value['comment'];
            $count_event = count($event);
            foreach ($event as $key => $_e){
                $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
                $recordModel->set('mode', '');
                 $modelData = $recordModel->getData();
                 $fieldModelList = $moduleModel->getFields();
                 foreach ($fieldModelList as $fieldName => $fieldModel) {
                    if ($fieldName == 'subject'){
                        $fieldValue = 'Задача к заявке';
                    }
                    else if ($fieldName == 'eventstatus') {
                        if (isset($event[$key+1]) && count($event[$key+1])>0){
                            $fieldValue = 'Held';
                        }
                        else{
                            $fieldValue = $this->statusTask[$value['task_status']];
                        }
                    }
                    else if ($fieldName == 'activitytype') {
                        $fieldValue = 'Заявка';
                    }
                    else if ($fieldName == 'description') {
                        $fieldValue =  $_e['task_target_message'];
                    }
                    else if ($fieldName == 'parent_id'){
                        $fieldValue = $LeadsModel->getId();
                    }
                    else if ($fieldName == 'cf_1085'){
                        $fieldValue = $event[$key+1]['task_target_has_been'];
                    }
                    else if ($fieldName == 'cf_1085'){
                        $fieldValue = $event[$key+1]['task_target_has_been'];
                    }
                    else if ($fieldName == 'time_start'){
                        if (isset($event[$key+1]) && count($event[$key+1])>0){
                            $fieldValue = $startTime = date('H:i', strtotime($_e['created']));
                        }
                        else {
                            $fieldValue = $startTime = date('H:i', strtotime($value['task_date']));
                        }
                        
                    }
                    else if ($fieldName == 'date_start'){
                        if (isset($event[$key+1]) && count($event[$key+1])>0){
                            $fieldValue = $startDateTime =  date('Y-m-d H:i:s', strtotime($_e['created']));
                        }
                        else {
                            $fieldValue = $startDateTime = date('Y-m-d H:i:s', strtotime($value['task_date']));
                        }
                        
                    }
                    else if ($fieldName == 'time_end'){
                        if (isset($event[$key+1]) && count($event[$key+1])>0){
                            $fieldValue = date('H:i', strtotime($_e['created']));
                        }
                        else {
                            $fieldValue = date('H:i', strtotime($value['task_date']));
                        }
                        
                    }
                    else if ($fieldName == 'due_date'){
                        if (isset($event[$key+1]) && count($event[$key+1])>0){
                            $fieldValue = date('Y-m-d', strtotime($_e['created']));
                        }
                        else {
                            $fieldValue = date('Y-m-d', strtotime($value['task_date']));
                        }
                        
                    }
                    else {
			$fieldValue = NULL;
                    }
            // For custom time fields in Calendar, it was not converting to db insert format(sending as 10:00 AM/PM)
            $fieldDataType = $fieldModel->getFieldDataType();
            if($fieldDataType == 'time'){
				$fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
            }
            // End
			if($fieldValue !== null) {
				if(!is_array($fieldValue)) {
					$fieldValue = trim($fieldValue);
				}
				$recordModel->set($fieldName, $fieldValue);
			}
		}
                
            
               
		//Start Date and Time values
		$startTime = Vtiger_Time_UIType::getTimeValueWithSeconds($startTime);
		$startDateTime = Vtiger_Datetime_UIType::getDBDateTimeValue($startDateTime);
		list($startDate, $startTime) = explode(' ', $startDateTime);

		$recordModel->set('date_start', $startDate);
		$recordModel->set('time_start', $startTime);
                $recordModel->set('assigned_user_id', $this->user[$value['executor_id']]);

		$recordModel->set('time_end', $startTime);
		$recordModel->set('due_date', $startDate);
                $recordModel->set('visibility', 'Private');
		
			$_REQUEST['set_reminder'] = 'No';
		 
        
                $recordModel->set('duration_hours', 0);
		$recordModel->set('duration_minutes', 0);
                $recordModel->save();
            }
		
            return true;
            
        }
    function addPayment($recordModel, $data, $type){
        $moduleName = 'SPPayments';
        $add= array();
        foreach($data as $row){
            $record = Vtiger_Record_Model::getCleanInstance($moduleName);
            $record->set('pay_date', date('Y-m-d', strtotime($row['booking_payment_date'])));
            if ($type == 'Receipt'){
             $record->set('payer', $recordModel->get('contact_id'));
            }
            else {
                $record->set('payer', $recordModel->get('tur_vendor'));
            }
            $record->set('pay_type', $type);
            $record->set('type_payment', $row['booking_payment_method']);
            $record->set('amount', $row['booking_payment_amount']);
            $record->set('spstatus', 'Executed');
            $record->set('related_to', $recordModel->getId());
            $record->set('assigned_user_id', $recordModel->get('assigned_user_id')); 
            $record->set('pay_details', $row['booking_payment_money_status']);
            $record->save();
            $add[$record->getId()] = $row['booking_payment_money_status'];
            
            
            
        }
        return $add;
        
    }
    function getMar($data){
        $airline = array();
        $flite = array();
        $departure = array();
        $time_departure = array();
        $arrival = array();
        $time_arrival = array();
        foreach ($data as $row){
           array_push($flite,$row['booking_flight_number']);
           array_push($time_departure,date('d.m.Y H:m', strtotime($row['booking_flight_depart'])));
           array_push($time_arrival,date('d.m.Y H:m', strtotime($row['booking_flight_arrive'])));
        array_push($departure,$this->getAirport($row['booking_flight_from_airport_title'],$row['dep_country']));
           array_push($arrival,$this->getAirport($row['booking_flight_to_airport_title'],$row['arr_country']));
           array_push($airline,$this->getAirline($row['booking_flight_airline_title']));
           
        }
        
        return array('airline'=>implode('#',$airline),
            'flite'=>implode('#',$flite),
            'departure'=>implode('#',$departure),
            'arrival'=>implode('#',$arrival),
            'time_departure'=>implode('#',$time_departure),
            'time_arrival'=>implode('#',$time_arrival));
    }
    function getAirline($name){
        global $adb;
        $sql = "SELECT * FROM vtiger_listairlines WHERE airlines = ?";
        $result = $adb->pquery($sql, array($name));
        $num = $adb->num_rows($result);
        if ($num > 0) return $name;
        else return $this->createAirline($name);
    }
    function createAirline($name,$country){
        $moduleName = 'ListAirlines';
        $record = Vtiger_Record_Model::getCleanInstance($moduleName);
        $record->set('airlines', $name);
        
        $record->set('assigned_user_id', 1);
        $record->save();
        return $name;
    }
    function getAirport($name,$country){
        global $adb;
        $sql = "SELECT * FROM vtiger_listairports WHERE airport = ?";
        $result = $adb->pquery($sql, array($name));
        $num = $adb->num_rows($result);
        if ($num > 0) return $name;
        else return $this->createAirport($name,$country);
    }
    function createAirport($name,$country){
        $moduleName = 'ListAirports';
        $record = Vtiger_Record_Model::getCleanInstance($moduleName);
        $record->set('airport', $name);
        $record->set('popular', 1);
        $record->set('country', $this->getCountry($country));
        $record->set('assigned_user_id', 1);
        $record->save();
        return $name;
    }
    function checkContact($id){
        global $adb;
        $sql = "SELECT * FROM vtiger_potentialscf WHERE cf_1346=?";
        $result = $adb->pquery($sql, array($id));
        $num = $adb->num_rows($result);
        if ($num > 0) return true;
        return false;
                
    }
    function getResort($name,$country){
        global $adb;
        $sql = "SELECT * FROM vtiger_listresorts WHERE resort = ?";
        $result = $adb->pquery($sql, array($name)); 
        $num = $adb->num_rows($result);
        if ($num > 0) return $adb->query_result($result,0,'listresortsid');
        else return $this->createResort($name,$country);
        
    }
    function createResort($name,$country){
        $moduleName = 'ListResorts';
        $record = Vtiger_Record_Model::getCleanInstance($moduleName);
        $record->set('resort', $name);
        $record->set('popular', 1);
        $record->set('country', $this->getCountry($country));
        $record->set('assigned_user_id', 1);
        $record->save();
        return $name;
    }
    function getCountry($name){
        global $adb;
        $sql = "SELECT * FROM vtiger_listcountry WHERE country_name = ?";
        $result = $adb->pquery($sql, array($name)); 
        return $adb->query_result($result,0,'listcountryid');
    }
    function getTuroperator($id){
        global $adb;
        $sql = "SELECT b.crmid, a.vendorid FROM vtiger_vendorcf as a LEFT JOIN vtiger_crmentityrel as b on b.relcrmid = a.vendorid WHERE a.cf_997 = ? ";
        $result = $adb->pquery($sql, array(trim($id)));
        return array('tur'=>$adb->query_result($result,0,'crmid'), 'ul'=>$adb->query_result($result,0,'vendorid'));
    } 
    function addServise($array){
        global $adb;
        $add = array();
        $price = array();
        $count = array();
        foreach ($array as $row){
            $sql = "SELECT * FROM vtiger_service WHERE servicename=?";
             $result = $adb->pquery($sql, array($row['book_service_title']));
            $num = $adb->num_rows($result);
            if ($num == 0) array_push($add, $this->createServise($row));
            else array_push($add, $adb->query_result($result,0,'serviceid'));
        array_push($price, $row['booking_service_price']);
            array_push($count, 1);
        }
        return array('servise'=>implode('#',$add),'price'=>implode('#',$price),'count'=>implode('#',$count));
    }
    function createServise($row){
        $moduleName = 'Services';
        $record = Vtiger_Record_Model::getCleanInstance($moduleName);
        $record->set('servicename', $row['book_service_title']);
        $record->set('discontinued', 1);
        $record->set('servicecategory', "Дополнительные услуги");
        $record->set('assigned_user_id', 1);
        $record->save();
        return $record->getId();
        
    }
    function getTurist($id){
        global $adb;
        $tu = array();
        foreach ($id as $_id){
        $sql = "SELECT * FROM vtiger_contactscf WHERE cf_1344=?";
        echo $sql; echo $_id['book_client_id'];
        $result = $adb->pquery($sql, array($_id['book_client_id']));
        echo $adb->query_result($result,0,'contactid');
        $num = $adb->num_rows($result);
        if ($num > 0) {
            if ($_id['booking_client_is_primary']==1){
                $dogovor = $adb->query_result($result,0,'contactid');
                if ($_id['booking_client_is_not_tourist']==1){
                    $dogovor .=':none';
                }
            }
            if ($_id['booking_client_is_not_tourist']==0){
            array_push($tu, $adb->query_result($result,0,'contactid'));
            }
        }
        }
        return array('turist'=>implode('#',$tu), 'dogovor'=>$dogovor);
                
    }
    function phoneCreat($value){
    $new_phone = $value;
    if (!empty($value)){
        $phone = str_replace(array('+','(',')',' '), array('','','',''), $value);
        if (strlen($phone) == 11){
            $phone = substr($phone, 1);
        }
        if (strlen($phone) == 10){
            $new_phone = '+7('.$phone{0}.$phone{1}.$phone{2}.') '.$phone{3}.$phone{4}.$phone{5}.'-'.$phone{6}.$phone{7}.$phone{8}.$phone{9};
        }
        else {
            $new_phone = $value;
        }
    }
    return $new_phone;
     
}
}