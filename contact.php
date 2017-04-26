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
die();
ini_set('display_errors',1);
error_reporting(E_ERROR);
$db = PearDatabase::getInstance();
//$select = "select a.* from vtiger_potentialscf as a left join vtiger_crmentity as c on c.crmid = a.potentialid LEFT join vtiger_users as u ON u.id = c.smownerid where u.office = 412";
$select = "select cu.smownerid as leadowner, c.* FROM vtiger_activity as a INNER JOIN vtiger_seactivityrel as s on s.activityid = a.activityid INNER JOIN vtiger_crmentity as cu ON cu.crmid = s.crmid and cu.setype = 'Leads' INNER JOIN vtiger_crmentity as c ON c.crmid=a.activityid and cu.smownerid <> c.smownerid WHERE a.activityid > 0 and a.eventstatus='Planned' group by cu.crmid";
$result = $db->pquery($select, array());

$numRows = $db->num_rows($result);
for ($i=0; $i<$numRows;$i++){
    $crmid = $db->query_result($result,$i, 'crmid');
    $owner = $db->query_result($result,$i, 'leadowner');
    $_sql = "UPDATE vtiger_crmentity SET smownerid= ? WHERE  crmid=?";
    $db->pquery($_sql, array($owner,$crmid));
}
$HOST = "193.124.177.160";      
$USER = "crmturizm";        
$PASS = "I0y7Y2s0";       

die();

$connection = new mysqli($HOST,$USER,$PASS, 'crmturizm');
$connection->set_charset("utf8");
$query = "select v.*, u.user_login, u.user_id, u.user_name from crm__booking_client as a LEFT JOIN crm__booking as b on b.booking_id = a.booking_id LEFT JOIN crm__user as u ON u.user_id = b.user_id LEFT JOIN crm__book_client as v on v.book_client_id = a.book_client_id WHERE u.office_id in (29,30,31) group by a.book_client_id ";
$r = $connection->query($query);
$array = array();
while( $row = $r->fetch_assoc() ){
       $array[] = $row;
    }

    /* Освобождаем память */
    $r->close();
    
    echo '<pre>'; 




$import = new import_contact($array);
$import->process();

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
    function __construct($array) {
        $this->data = $array;
    }
    function process(){
         global $current_user, $adb;
         $current_user = Users::getActiveAdminUser();
         
        $moduleName = 'Contacts';
        foreach ($this->data as $key=>$value){
            if($this->checkContact($value['book_client_id'])) continue;
            
            $record = Vtiger_Record_Model::getCleanInstance($moduleName);
            $name = explode (' ',$value['book_client_individual_name']);
            $latin_name = explode (' ',$value['book_client_individual_name_en']);
            $record->set('lastname', $name[0]);
            $record->set('firstname', $name[1]);
            $record->set('midlename', $name[2]);
            $record->set('firsname_latin', $latin_name[0]);
            $record->set('lastname_latin', $latin_name[1]);
            $record->set('mobile', $this->phoneCreat($value['book_client_individual_phone']));
            $record->set('birthday', date('Y-m-d', strtotime($value['book_client_individual_birthday'])));
            $record->set('typevisa',445);
            $record->set('mailingstreet', $value['book_client_individual_address']);
            $record->set('pasport_ser', $value['book_client_individual_passport_series']);
            $record->set('pasport_no', $value['book_client_individual_passport_number']);
            $record->set('pasport_date', date('Y-m-d', strtotime($value['book_client_individual_passport_date'])));
            $record->set('pasport_duedate', date('Y-m-d', strtotime($value['book_client_individual_passport_valid_till'])));
            $record->set('pasport_fms', $value['book_client_individual_passport_issuer']);
            $record->set('email', $value['book_client_individual_email']);
            $record->set('cf_1344', $value['book_client_id']);
            $record->set('assigned_user_id', $this->user[$value['user_id']]);
            
           $record->save();
           
            
        }
    }
    function checkContact($id){
        global $adb;
        $sql = "SELECT * FROM vtiger_contactscf WHERE cf_1344=?";
        $result = $adb->pquery($sql, array($id));
        $num = $adb->num_rows($result);
        if ($num > 0) return true;
        return false;
                
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