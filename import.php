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
$connection->set_charset("utf8");
$query = "select g.book_operator_number, a.* from crm__booking as a left join crm__user as u ON u.user_id = a.user_id LEFT JOIN crm__book_operator as g ON g.book_operator_id=a.book_operator_id WHERE u.office_id = 31 order by a.booking_id LIMIT 0,1000";
$r = $connection->query($query);
$array = array();
while( $row = $r->fetch_assoc() ){
       $array[] = $row;
    }

    /* Освобождаем память */
    $r->close();
    
foreach ($array as $key=>$book){
    $sql = "select a.* from crm__booking_client as a where a.booking_id = ".$book['booking_id'];
   
    $r = $connection->query($sql);
       while( $row = $r->fetch_assoc()){
        $book['tourist'][] = $row;
        }
        $r->close();
    $sql = "SELECT a.*, c.book_country_title as dep_country, g.book_country_title as arr_country FROM crm__booking_flight as a LEFT JOIN crm__book_airport as b ON b.book_airport_id = a.booking_flight_from_airport_id LEFT JOIN crm__book_country as c ON c.book_country_id = b.book_country_id LEFT JOIN crm__book_airport as e ON e.book_airport_id = a.booking_flight_to_airport_id LEFT JOIN crm__book_country as g ON g.book_country_id = e.book_country_id where booking_id =".$book['booking_id'];
    echo $sql;
    $r = $connection->query($sql);
       while( $row = $r->fetch_assoc()){
        $book[$row['booking_flight_direction']][] = $row;
        }
        $r->close();
    $sql = "SELECT * FROM crm__booking_payment where booking_id = ".$book['booking_id'];
    $r = $connection->query($sql);
       while( $row = $r->fetch_assoc()){
        $book[$row['booking_payment_type']][] = $row;
        }
        $r->close();
    $sql = "SELECT a.*, b.book_service_title FROM crm__booking_service as a LEFT JOIN crm__book_service as b on b.book_service_id=a.book_service_id where a.booking_id = ".$book['booking_id'];    
       
    $r = $connection->query($sql);
       while( $row = $r->fetch_assoc()){
        $book['addservice'][] = $row;
        }
        $r->close();
    $import = new import_contact($book);
    $import->process();
       }
      
  

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
    function __construct($array) {
        $this->data = $array;
    }
    function company( $new, $old = ''){
        
        if (empty($new)) return $old;
        $company_new = $this->spcompany[$new];
        if (empty($old)) return $new;
        $old = explode('|##|',$old);
        if (!in_array($company_new, $old)){
            $old[] = $company_new;
        }
        return implode('|##|', $old);
    }
    function process(){
         global $current_user, $adb;
         $current_user = Users::getActiveAdminUser();
         
        $moduleName = 'Potentials';
        $value = $this->data;
       
            
            $record = Vtiger_Record_Model::getCleanInstance($moduleName);
            //print_r(str_replace('"', '',implode('#',(unserialize($value['booking_hotel_room_type'])))));
            //die();
            $record->set('opportunity_type', "Пакетный Тур");
            if ($value['booking_is_canceled'] == 1 && $value['booking_is_aborted'] == 1){
                $record->set('sales_stage', "Closed Lost");
            }
            else if (strtotime($value['booking_arrival_date']) < strtotime(date('Y-m-d 00:00:00'))){
                $record->set('sales_stage', "Closed Won");
            }
            elseif ($value['booking_payment_outgoing'] == $value['booking_payment_outgoing_paid'] && $value['booking_payment_incoming']==$value['booking_payment_incoming_paid']){
                $record->set('sales_stage', "Бронь оплачена");
            }
            else if (!empty($value['booking_reservation_number'])){
                $record->set('sales_stage', "Бронь потверждена");
            }
            elseif ($value['booking_payment_incoming'] == $value['booking_payment_incoming_paid']){
                $record->set('sales_stage', "Договор заключен");
            }
            elseif ($value['booking_payment_incoming'] < $value['booking_payment_incoming_paid']){
                $record->set('sales_stage', "Заключение договора");
            }
            else {
                $record->set('sales_stage', "Новый");
            }
            $record->set('assigned_user_id', $this->user[$value['user_id']]);
            $record->set('spcompany', $this->spcompany[$value['unit_id']]);
            $record->set('office', 405);
            $record->set('dogovor', $value['booking_number']);
            $record->set('datedogovor', date('d.m.Y', strtotime($value['created'])));
            $record->set('visa_status', $this->typedocvisa[$value['booking_visa_status']]);
            $date = ($value['booking_visa_date'])?date('Y-m-d', strtotime($value['booking_visa_date'])):NULL;
            $record->set('visa_date', $date);
            $record->set('doc_status', $this->docstatus[$value['booking_document_status']]);
            $record->set('booking_no', $value['booking_reservation_number']);
            $record->set('book_success', $value['booking_is_reservation_confirm']);
             $date = ($value['booking_check_date'])?date('Y-m-d H:i:00', strtotime($value['booking_check_date'])):NULL;
            $record->set('control_data', $value['booking_check_date']);
            $record->set('description', $value['booking_notice']);
            $record->set('callback', $value['booking_is_call_before']);
            $record->set('book_reset', $value['booking_is_canceled']);
            $record->set('dog_reset', $value['booking_is_aborted']);
            $turist = $this->getTurist($value['tourist']);
            $record->set('list_tourist', $turist['turist']);
            $record->set('contact_id', str_replace(':none', '',$turist['dogovor']));
             $date = ($value['booking_payment_outgoing_date'])?date('Y-m-d', strtotime($value['booking_payment_outgoing_date'])):NULL;
            $record->set('date_pay_to', $date);
            $record->set('pay_to', $value['booking_payment_outgoing']);
            $record->set('start_pay_to',$value['booking_payment_outgoing_starting']);
            
            $record->set('balance_to', $value['booking_payment_outgoing']-$value['booking_payment_outgoing_paid']);
            $record->set('cena', $value['booking_tour_price']);
            $record->set('discount', $value['booking_tour_discount']);
            $record->set('amount', $value['booking_payment_incoming']);
            $record->set('exchange', $value['booking_currency_starting_value']);
            $record->set('currenc', $value['booking_rate_currency']);
            $record->set('amount_cur', $value['booking_payment_incoming']/$value['booking_currency_starting_value']);
            $record->set('visaammount', $value['booking_visa_price']);
            $record->set('visacount', $value['booking_visa_count']);
            $record->set('inshurout', $value['booking_insurance_price']);
            $record->set('inshuroutcount', $value['booking_insurance_count']);
            $record->set('fuelammount', $value['booking_fueltax_price']);
            $record->set('fuelcount', $value['booking_fueltax_count']);
            $record->set('chvisaammount', $value['booking_childvisa_price']);
            $record->set('chvisacount', $value['booking_childvisa_count']);
            $record->set('inshuradd', $value['booking_addinsurance_price']);
            $record->set('inshuraddcount', $value['booking_addinsurance_count']);
            $addServise = $this->addServise($value['addservice']);
            $record->set('addservise', $addServise['servise']);
            $record->set('addserviseamount', $addServise['price']);
            $record->set('addservisecount', $addServise['count']);
            $turoperator = $this->getTuroperator($value['book_operator_number']);
            $record->set('turoperator', $turoperator['tur']);
            $record->set('tur_vendor', $turoperator['ul']);
            $record->set('country', $this->getCountry($value['booking_country_title']));
            $record->set('resort', $this->getResort($value['booking_city_title'],$record->get('country')));
            $record->set('hotel', $value['booking_hotel_title']);
            $record->set('food', str_replace(array(',', '/', '"'), array('','',''),$value['booking_meals']));
            $record->set('type_room', str_replace(array(',', '/', '"'), array('','',''),implode('#',(unserialize($value['booking_hotel_room_type'])))));
            $record->set('placement', str_replace(array(',', '/', '"'), array('','',''),$value['booking_placement']));
            $record->set('night', $value['booking_nights']);
            $record->set('transfer', $this->transfer[$value['booking_is_transfer']]);
            $record->set('transport', $value['booking_transfer_transport']);
            $record->set('helthinshurence', $this->helthinshurence[$value['booking_is_medical_insurance']]);
            
            $date = ($value['booking_payment_outgoing_date'])?date('Y-m-d', strtotime($value['booking_payment_outgoing_date'])):NULL;
            $record->set('next_payment', $date);
            $record->set('balance', ($value['booking_payment_incoming'] - $value['booking_payment_incoming_paid'])); 
            $departure = $this->getMar($value['THERE']);
            
            $record->set('date_start', $value['booking_arrival_date']); 
            $record->set('dep_airline', $departure['airline']);
            $record->set('dep_flite', $departure['flite']);
            $record->set('dep_departure', $departure['departure']);
            $record->set('dep_arrival', $departure['arrival']);
            $record->set('dep_time_departure', $departure['time_departure']);
            $record->set('dep_time_arrival', $departure['time_arrival']);
            $departure = $this->getMar($value['BACK']);
            $_d = explode('#', $departure['time_arrival']);
            
            $date_start = date('Y-m-d H:i:00', strtotime($_d[count($_d)-1]));
           
            $record->set('due_data', $value['booking_departure_date']); 
            $record->set('arr_airline', $departure['airline']);
            $record->set('arr_flite', $departure['flite']);
            $record->set('arr_departure', $departure['departure']);
            $record->set('arr_arrival', $departure['arrival']);
            $record->set('arr_time_departure', $departure['time_departure']);
            $record->set('arr_time_arrival', $departure['time_arrival']);
            if ($record->get('pay_to') > 0){
                $comission = $record->get('amount') - $record->get('pay_to');
                $comission_pr = $comission / $record->get('pay_to') * 100;
                } else {
                    $comission = 0.00;
                    $comission_pr = 0.00;
                }
                $record->set('comission', $comission);
                $record->set('comission_pr', number_format($comission_pr,2,".",""));
            $record->save();
            
            $add = $this->addPayment($record, $value['INCOMING'],'Receipt');
            $this->addPayment($record, $value['OUTGOING'],'Expense');
            $record->set('mode', 'edit');
            $record->set('cf_1270', json_encode($add));
            
           $record->save();
           
        
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