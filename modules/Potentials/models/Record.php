<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Potentials_Record_Model extends Vtiger_Record_Model {
        public $array_fields = array (
        'assigned_user_id', 
        "spcompany", 
        "office", 
        "contact_id", 
        "list_tourist", 
        "cena",
        "discount",
        "visaammount",
        "visacount",
        "chvisaammount",
        "chvisacount",
        "inshurout",
        "inshuroutcount",
        "inshuradd",
        "inshuraddcount",
        'fuelammount',
        'fuelcount',
        'addservise',
        'addserviseamount',
        'addservisecount',
        'country',
        'resort',
        'dep_airline',
        'dep_flite',
        'dep_type_flite',
        'dep_departure',
        'dep_time_departure',
        'dep_arrival',
        'dep_time_arrival',
        'arr_airline',
        'arr_flite',
        'arr_type_flite',
        'arr_departure',
        'arr_time_departure',
        'arr_arrival',
        'arr_time_arrival',
        'hotel',
        'type_room',
        'food',
        'placement',
        'night',
        'transfer',
        'transport',
        'helthinshurence',
        'addservisetype',
        'addservisepaslist',
        'dep_airline_rail',
        'dep_list_pass',
        'arr_airline_rail',
        'arr_list_pass',
        'amount',
     );
	function getCreateInvoiceUrl() {
		$invoiceModuleModel = Vtiger_Module_Model::getInstance('Invoice');
        // SalesPlatform.ru begin
        return $invoiceModuleModel->getCreateRecordUrl().'&sourceRecord='.$this->getId().'&sourceModule='.$this->getModuleName().'&potential_id='.$this->getId().'&relationOperation=true';
		//return 'index.php?module='.$invoiceModuleModel->getName().'&view='.$invoiceModuleModel->getEditViewName().'&account_id='.$this->get('related_to').'&contact_id='.$this->get('contact_id');
        // SalesPlatform.ru end
	}

	/**
	 * Function returns the url for create event
	 * @return <String>
	 */
	function getCreateEventUrl() {
		$calendarModuleModel = Vtiger_Module_Model::getInstance('Calendar');
		return $calendarModuleModel->getCreateEventRecordUrl().'&parent_id='.$this->getId();
	}

	/**
	 * Function returns the url for create todo
	 * @return <String>
	 */
	function getCreateTaskUrl() {
		$calendarModuleModel = Vtiger_Module_Model::getInstance('Calendar');
		return $calendarModuleModel->getCreateTaskRecordUrl().'&parent_id='.$this->getId();
	}

	/**
	 * Function to get List of Fields which are related from Contacts to Inventyory Record
	 * @return <array>
	 */
	public function getInventoryMappingFields() {
		return array(
				array('parentField'=>'related_to', 'inventoryField'=>'account_id', 'defaultValue'=>''),
				array('parentField'=>'contact_id', 'inventoryField'=>'contact_id', 'defaultValue'=>''),
		);
	}

    /**
	 * Function returns the url for create quote
	 * @return <String>
	 */
	public function getCreateQuoteUrl() {
		$quoteModuleModel = Vtiger_Module_Model::getInstance('Quotes');
		return $quoteModuleModel->getCreateRecordUrl().'&sourceRecord='.$this->getId().'&sourceModule='.$this->getModuleName().'&potential_id='.$this->getId().'&relationOperation=true';
	}
        public function getPaymentAmmount($id){
            global $adb;
            $sql = "SELECT sum(a.amount) as sum FROM sp_payments as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.payid WHERE c.deleted = 0 and a.related_to = ? and a.pay_type= ?";
           $result = $adb->pquery($sql,array($id,'Receipt'));
           return $adb->query_result($result,0,'sum');
        } 
        public function CalculatePayment($type){
            if (!empty($type)){
                if ($type == 'Receipt'){
                    $this->calculateReceipt();
                }
                else if ($type == 'Expense'){
                     $this->calculateExpense();
                }
            }
            else {
                $this->calculateReceipt();
                $this->calculateExpense();
            }
        }
        public function calculateReceipt(){
            $paidTurist = $this->getPaidTurist($this->getId());
            
            $moneyType = Zend_Json::decode(htmlspecialchars_decode($this->get('cf_1270')));
            $sum = 0;
            $cf_1270 = array();
            foreach ($paidTurist as $id=>$value){
                if (!empty($moneyType[$id]))$cf_1270[$id] = $moneyType[$id];
                else $cf_1270[$id] = "MY";
                $sum = $sum + $value;
            }
             $this->set('paid', $sum);
             $this->set('balance', ($this->get('amount') - $sum));
            
             $this->set('cf_1270', Zend_Json::encode($cf_1270));
        }
        public function getPaidTurist($recordId){
            global $adb;
            $sql = "SELECT amount, payid FROM sp_payments as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.payid WHERE c.deleted = 0 and a.related_to = ? and a.pay_type= ? and spstatus = ?";
           $result = $adb->pquery($sql,array($recordId,'Receipt','Executed'));
           $list = array();
           $numRows = $adb->num_rows($result);
           for ($i=0;$i<$numRows;$i++){
               $list[$adb->query_result($result,$i,'payid')] = $adb->query_result($result,$i,'amount');
           }
           return $list;
        }
         public function calculateExpense(){
             $this->set('paid_to', $this->getPaidTo($this->getId()));
             $this->set('balance_to', ($this->get('pay_to') - $this->get('paid_to')));
             
        }
        public function getPaidTo($recordId){
            global $adb;
            $sql = "SELECT sum(a.amount) as sum FROM sp_payments as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.payid WHERE c.deleted = 0 and a.related_to = ? and a.pay_type= ? and spstatus = ?";
           $result = $adb->pquery($sql,array($recordId,'Expense','Executed'));
           return $adb->query_result($result,0,'sum');
        }
        public function rus_date() {
// Перевод
 $translate = array(
 "am" => "дп",
 "pm" => "пп",
 "AM" => "ДП",
 "PM" => "ПП",
 "Monday" => "Понедельник",
 "Mon" => "Пн",
 "Tuesday" => "Вторник",
 "Tue" => "Вт",
 "Wednesday" => "Среда",
 "Wed" => "Ср",
 "Thursday" => "Четверг",
 "Thu" => "Чт",
 "Friday" => "Пятница",
 "Fri" => "Пт",
 "Saturday" => "Суббота",
 "Sat" => "Сб",
 "Sunday" => "Воскресенье",
 "Sun" => "Вс",
 "January" => "Января",
 "Jan" => "Янв",
 "February" => "Февраля",
 "Feb" => "Фев",
 "March" => "Марта",
 "Mar" => "Мар",
 "April" => "Апреля",
 "Apr" => "Апр",
 "May" => "Мая",
 "May" => "Мая",
 "June" => "Июня",
 "Jun" => "Июн",
 "July" => "Июля",
 "Jul" => "Июл",
 "August" => "Августа",
 "Aug" => "Авг",
 "September" => "Сентября",
 "Sep" => "Сен",
 "October" => "Октября",
 "Oct" => "Окт",
 "November" => "Ноября",
 "Nov" => "Ноя",
 "December" => "Декабря",
 "Dec" => "Дек",
 "st" => "ое",
 "nd" => "ое",
 "rd" => "е",
 "th" => "ое"
 );
 // если передали дату, то переводим ее
 if (func_num_args() > 1) {
 $timestamp = func_get_arg(1);
 return strtr(date(func_get_arg(0), $timestamp), $translate);
 } else {
// иначе текущую дату
 return strtr(date(func_get_arg(0)), $translate);
 }
 }
    function getDocumentLinks(){
        global $adb;
       
        $linkListArray = $this->getArrayDoc();
        $links = array();
        $sql = "SELECT a.description, a.templateid FROM vtiger_pdfmaker as a LEFT JOIN vtiger_pdfmaker_userstatus as b ON b.templateid=a.templateid WHERE b.is_active = 1 and a.module = ? and a.spcompany = ? and a.filename = ? and a.deleted = 0";
        if (is_array($linkListArray)) {
            foreach ($linkListArray as $key => $filename) {
                $result = $adb->pquery($sql, array('Potentials', $this->get('tur_vendor'), $filename));

                $numRows = $adb->num_rows($result);

                if ($numRows == 0) {
                    $result = $adb->pquery($sql, array('Potentials', 0, $filename));
                    //print_r ($result);
                    $numRows = $adb->num_rows($result);
                }
                if ($numRows > 0) {
                    $links[$key]['name'] = $filename;
                    $links[$key]['description'] = $adb->query_result($result, 0, 'description');
                    $links[$key]['href'] = $this->generateLinkDocuments($adb->query_result($result, 0, 'templateid'));
                }
            }
        }
         return $links; 
        }
    function generateLinkDocuments($template_id){
        return "/index.php?module=PDFMaker&relmodule=Potentials&action=CreatePDFFromTemplate&print=true&record=".$this->getId()."&commontemplateid=".$template_id.";&language=ru_ru";
    }
    function checkVisaDoc(){
        $visa_doc = json_decode(htmlspecialchars_decode($this->get('visa_doc')),true);
        if (count($visa_doc)>0){
            foreach($visa_doc as $value){
                if ($value['off']!= 1){
                    return true;
                }
            }
        }
        return false;
    }
    function getArrayDoc(){
        global $adb;
        $related_id = $this->get('contact_id');
        $opportunity_type = $this->get('opportunity_type');
        $sql = "SELECT setype FROM vtiger_crmentity WHERE crmid = ?";
        $result = $adb->pquery($sql, array($related_id));
        $type = $adb->query_result($result,0,'setype');
        switch ($type){
            case 'Accounts': 
                if ($opportunity_type == 'Авиа билеты'){
                    $array = array('dogovor'=>'Договор Авиа билеты Юр.Лицо', 'dopnik'=>'Дополнение Авиа билеты Юр.Лицо');
                }elseif ($opportunity_type == 'ЖД билеты'){
                    $array = array('dogovor'=>'Договор ЖД билеты Юр.Лицо', 'dopnik'=>'Дополнение ЖД билеты Юр.Лицо');
                    
                }else{
                $array = array('dogovor'=>'Договор Юр.Лицо','dopnik'=>'Дополнение Юр.Лицо');
                }
                if($this->get('cf_1296')>0){
                    $array['adddogovor'] ='Доп.Соглашение Юр.Лицо';
                }
                if($this->get('sales_stage') == "Closed Lost"){
                    $array['closelost'] ='Анулирование тура Юр.Лицо';
                }
                break;
            case 'Contacts': 
                if ($opportunity_type == 'Авиа билеты'){
                    $array = array('dogovor'=>'Договор Авиа билеты', 'bso'=>'Квитанция', 'dopnik'=>'Дополнение Авиа билеты');
                    
                }
                elseif ($opportunity_type == 'ЖД билеты'){
                    $array = array('dogovor'=>'Договор ЖД билеты', 'bso'=>'Квитанция', 'dopnik'=>'Дополнение ЖД билеты');
                } elseif ($opportunity_type == 'Индивидуальный Тур'){
                    $array = array('dogovor'=>'Договор инд.тур', 'dopnik'=>'Дополнение');
                }
                else{
                $array = array('dogovor'=>'Договор', 'dopnik'=>'Дополнение');
                }
                if($this->get('cf_1296')>0){
                    $array['adddogovor'] ='Доп.Соглашение';
                }
                 if($this->get('sales_stage') == "Closed Lost"){
                    $array['closelost'] ='Анулирование тура';
                }
                break;
        }
        if ($this->checkVisaDoc()){
            $array['visa'] = 'Виза';
        }
        
        return $array;
    }
    function unsetArray($array, $key){
        if (is_array($array)){
            unset($array[$key]);
        }
        return $array;
    }
    function getListDocumentVisa(){
        global $adb;
        $country = $this->get('country');
        $sql = "SELECT b.* FROM vtiger_crmentityrel as a LEFT JOIN vtiger_visadocuments as b ON b.visadocumentsid = a.relcrmid"
                . " LEFT JOIN vtiger_crmentity as c ON c.crmid = a.relcrmid"
                . " WHERE c.deleted = 0 AND a.crmid = ? AND a.relmodule = ?";
         $result = $adb->pquery($sql, array($country, 'VisaDocuments'));
        
         $numRows = $adb->num_rows($result);
         $listCountryVisa = array();
            if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $listCountryVisa[$adb->query_result($result,$i,'visadocumentsid')] = $adb->query_result($result,$i,'document_name');
                }
            }
         //
        $contact_id = explode('#', $this->get('list_tourist'));
        if (empty($contact_id)) return array();
        $contact_list = array();
        $type = array();
        foreach ($contact_id as $id){
            $sql = "SELECT a.cf_1330, a.cf_1087, b.lastname, b.firstname FROM vtiger_contactscf as a LEFT JOIN vtiger_contactdetails as b ON b.contactid = a.contactid WHERE a.contactid = ?";
            $result = $adb->pquery($sql, array($id));
            
            $contact_list[$id]['type'] = $adb->query_result($result,0,'cf_1330');
            $contact_list[$id]['name'] = $adb->query_result($result,0,'lastname').' '.$adb->query_result($result,0,'firstname').' '.$adb->query_result($result,0,'cf_1087');
            array_push($type, $contact_list[$id]['type']);
        }
       
        $listTypeVisa = array();
        foreach ($type as $id){
             $sql = "SELECT b.* FROM vtiger_crmentityrel as a LEFT JOIN vtiger_visadocuments as b ON b.visadocumentsid = a.relcrmid"
                . " LEFT JOIN vtiger_crmentity as c ON c.crmid = a.relcrmid"
                . " WHERE c.deleted = 0 AND a.crmid = ? AND a.relmodule = ?";
             $result = $adb->pquery($sql, array($id, 'VisaDocuments'));
             $numRows = $adb->num_rows($result);
            
            if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $listTypeVisa[$id][$adb->query_result($result,$i,'visadocumentsid')] = $adb->query_result($result,$i,'document_name');
                }
            }
        }
       
       
        $visa_doc = json_decode(htmlspecialchars_decode($this->get('visa_doc')),true);
       
        foreach ($contact_list as $key=>$row){
            if (is_array($listTypeVisa[$contact_list[$key]['type']])) {
                $contact_list[$key]['documents'] = array_intersect_key($listCountryVisa, $listTypeVisa[$contact_list[$key]['type']]);
            } else {
                $contact_list[$key]['documents'] = $listCountryVisa;
            }
           if (count($visa_doc[$key]['documents'])>0){
                foreach ($visa_doc[$key]['documents'] as $_key=>$value){
                    $contact_list[$key]['selected'][$_key] = $value;
                }
           }
            $contact_list[$key]['off'] = $visa_doc[$key]['off'];
        }
       
        return $contact_list;
    }
    function getContactEmail($id){
         global $adb;
        $contact_id = $this->get('contact_id');
        $sql = "SELECT setype FROM vtiger_crmentity WHERE crmid = ?";
        $result = $adb->pquery($sql, array($related_id));
        $type = $adb->query_result($result,0,'setype');
        $recordContact = Vtiger_Record_Model::getInstanceById($contact_id);
        if ($type = 'Contacts'){
            $email = $recordContact->get('email');
        }
        else if ($type = 'Accounts'){
            $email = $recordContact->get('email1');
        }
        if (!empty($email)){
            return $email;
        }
        return false;       
    }
    public function getErrors(){
        global $adb, $current_user;
        $result = $adb->pquery("SELECT * FROM vtiger_user2role where userid = ?", array($current_user->id));
        $role = $adb->query_result($result,0,'roleid');
        $result = $adb->pquery("SELECT * FROM vtiger_user2role u where u.roleid IN (SELECT roleid FROM vtiger_role r WHERE r.parentrole LIKE '%$role%' AND r.roleid != '$role') ",array());
        $numRows = $adb->num_rows($result);
        $row = [];
        for ($i=1;$i<$numRows;$i++){
            $row[] = $adb->query_result($result,$i,'userid');
        }
        array_push($row, $current_user->id);
        $user_id = implode(",",$row);
        $id = $this->getId();
        $sql =  $adb->pquery("Select crac.smownerid, crac.smcreatorid From vtiger_seactivityrel as rel LEFT JOIN vtiger_crmentity as e ON e.crmid = rel.activityid LEFT JOIN vtiger_activity as a ON a.activityid=rel.activityid LEFT JOIN vtiger_crmentity as crac ON crac.crmid = rel.activityid Where rel.crmid = ? and (a.activitytype = 'Замечание' and a.eventstatus = 'Planned') and (crac.smcreatorid IN ($user_id) OR crac.smownerid IN ($user_id) OR crac.modifiedby IN ($user_id)) ORDER BY e.crmid DESC", array($id)); // e.creattime
        //print_r ($sql);
        $numRows = $adb->num_rows($sql);
        $row = [];
        for ($i=0; $i<$numRows;$i++){
            $row[$i] = $adb->query_result_rowdata($sql,$i);


            if ($current_user->id === $this->get('assigned_user_id') && $current_user->id === $row[$i]['smownerid']){
                $_errors = $adb->pquery('SELECT f.*, s.description FROM vtiger_foullist as f LEFT JOIN vtiger_crmentity as c ON c.crmid = f.foullistid LEFT JOIN vtiger_crmentity as s ON s.crmid = f.foullist WHERE checks != \'Да\' and f.target = ? and f.notif = ? ', array($id,$current_user->id));
                // print_r($_errors );
                $row[$i]['errors'][0] = $adb->query_result_rowdata($_errors,0);
                $row[$i]['errors'][0]['messageDisplay'] = Zend_Json::decode(htmlspecialchars_decode($row[$i]['errors'][0]['message']));

                $row[$i]['type_error'] = 'assign';

            } else if ($current_user->id === $row[$i]['smownerid']){
                $_errors = $adb->pquery('SELECT f.*,s.sdescription FROM vtiger_foullist as f LEFT JOIN vtiger_crmentity as c ON c.crmid = f.foullistid LEFT JOIN vtiger_crmentity as s ON s.crmid = f.foullist WHERE checks != \'Да\' and f.target = ? and (f.notif = ? || c.smownerid =?)', array($id,$current_user->id,$current_user->id));
                $_numRows = $adb->num_rows($_errors);
                //echo '<pre>'.$query ;print_r($_errors);echo '</pre>';die;
                for ($_i=0;$_i<$_numRows;$_i++){
                    $row[$i]['errors'][$_i] =  $adb->query_result_rowdata($_errors,$_i);
                    $row[$i]['errors'][$_i]['messageDisplay'] = Zend_Json::decode(htmlspecialchars_decode($row[$i]['errors'][$_i]['message']));
                }

                $row[$i]['type_error'] = 'smowner';
            } else if ($current_user->id === $row[$i]['smcreatorid']){
                $query = 'SELECT f.*,s.description FROM vtiger_foullist as f LEFT JOIN vtiger_crmentity as c ON c.crmid = f.foullistid LEFT JOIN vtiger_crmentity as s ON s.crmid= f.foullist WHERE checks != \'Да\' and f.target = ? and (f.notif = ? || c.smownerid =?)';
                $_errors = $adb->pquery($query, array($id,$current_user->id,$current_user->id));

                $_numRows = $adb->num_rows($_errors);
                for ($_i=0;$_i<$_numRows;$_i++){
                    $row[$i]['errors'][$_i] =  $adb->query_result_rowdata($_errors,$_i);
                    $row[$i]['errors'][$_i]['messageDisplay'] = Zend_Json::decode(htmlspecialchars_decode($row[$i]['errors'][$_i]['message']));
                }
                $row[$i]['type_error'] = 'smcreator';
            } else {
                $query = 'SELECT f.*,s.description FROM vtiger_foullist as f LEFT JOIN vtiger_crmentity as c ON c.crmid = f.foullistid LEFT JOIN vtiger_crmentity as s ON s.crmid = f.foullist WHERE checks != \'Да\' and f.target = ? ';
                $_errors = $adb->pquery($query, array($id));

                $_numRows = $adb->num_rows($_errors);
                for ($_i=0;$_i<$_numRows;$_i++){
                    $row[$i]['errors'][$_i] =  $adb->query_result_rowdata($_errors,$_i);
                    $row[$i]['errors'][$_i]['messageDisplay'] = Zend_Json::decode(htmlspecialchars_decode($row[$i]['errors'][$_i]['message']));
                }
                $row[$i]['type_error'] = 'smcreator';
            }
        }

        return $row;


    }
}
