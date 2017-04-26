<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class PotentialsHandler extends VTEventHandler{

function handleEvent($eventName, $data) {
     $moduleName = $data->getModuleName();
     if ( $moduleName != 'Potentials') return true;
    $array_fields = array (
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
    if ($data->get('printdogovor') == 1 && $data->get('change_field') == 0 ){
        $vtEntityDelta = new VTEntityDelta();
        $record = $data->getId();
    //$record = $record[1];
    
        $delta = $vtEntityDelta->getEntityDelta('Potentials', $record, true);
    
        foreach ($delta as $key=>$value){
            if (in_array($key, $array_fields )){
                $data->set('change_field',1);
                $db = PearDatabase::getInstance();
                $sql = "UPDATE vtiger_potentialscf SET cf_1452= '1' WHERE potentialid =$record";
                echo $sql;
                print_r($db->pquery($sql));
                //$data->save();
                //echo '<pre>';print_r($data);echo '</pre>';die();
                return $data;
            }
        }
    }
    return $data;
}
function handlePotettialsChangeStatusAdd($data){
    $db = PearDatabase::getInstance();
    $data->set('change_field',1);
   //echo '<pre>';print_r($data);echo '</pre>';die();
    
    
    return true;
}
}