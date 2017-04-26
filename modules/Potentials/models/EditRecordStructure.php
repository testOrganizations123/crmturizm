<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * Vtiger Record Structure Model
 */
class Potentials_EditRecordStructure_Model extends Vtiger_EditRecordStructure_Model {

	 function getCountArrayNumber($num){
            $array = array();
            for ($i=0; $i<($num+1);$i++){
                array_push($array, $i);
            }
            
            return $array;
        }
        function getCountryPikList(){
            global $adb;
            $pikList = array();
            $result = $adb->pquery('SELECT a.*, cf.* FROM vtiger_listcountry as a LEFT JOIN vtiger_listcountrycf as cf ON cf.listcountryid = a.listcountryid LEFT JOIN vtiger_crmentity as c ON c.crmid = a.listcountryid WHERE c.deleted = 0 ORDER BY a.country_name', array());
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'listcountryid')] = $adb->query_result($result,$i,'country_name');
            }
            return $pikList;
              
        }
        function getTuroperatorPikList(){
            global $adb;
            $pikList = array();
            $result = $adb->pquery('SELECT a.*, cf.* FROM vtiger_listtouroperators as a LEFT JOIN vtiger_listtouroperatorscf as cf ON cf.listtouroperatorsid = a.listtouroperatorsid LEFT JOIN vtiger_crmentity as c ON c.crmid = a.listtouroperatorsid WHERE c.deleted = 0 ORDER BY a.turoperator_name', array());
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'listtouroperatorsid')] = $adb->query_result($result,$i,'turoperator_name');
            }
            return $pikList;
              
        }
        function getDisplayOperator($operator){
            global $adb;
            $result = $adb->pquery('SELECT a.* FROM vtiger_listtouroperators as a WHERE a.listtouroperatorsid = ?', array($operator));
           
            return $adb->query_result($result,0,'turoperator_name');
        }
        function getDisplayVendorToOperator($vendor){
            global $adb;
            $result = $adb->pquery('SELECT a.* FROM vtiger_listtouroperators as a LEFT JOIN vtiger_crmentityrel as r ON r.crmid = a.listtouroperatorsid WHERE r.relcrmid= ?', array($vendor));
            return $adb->query_result($result,0,'turoperator_name');
        }
        function getTransferPikList() {
            $pikList = array(
                "Автобус" => "Автобус",
                "Автомобиль" => "Автомобиль",
                "Авиа"=>"Авиа",
                "ЖД"=>"ЖД",
                "Водный транспорт"=>"Водный транспорт",
            );
            return $pikList;
        }
        function getVendorPikList(){
            global $adb;
            $pikList = array();
            
            $result = $adb->pquery("SELECT a.* FROM vtiger_vendor as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.vendorid WHERE c.deleted = 0 and a.category = 'ticketvendor' ORDER BY a.vendorname", array());
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'vendorid')] = $adb->query_result($result,$i,'vendorname');
            }
            return $pikList;
              
        }
        
        function getResortPikList($id = false){
             global $adb;
            $pikList = array();
            $array = array();
            $sql = 'SELECT a.*, cf.* FROM vtiger_listresorts as a LEFT JOIN vtiger_listresortscf as cf ON cf.listresortsid = a.listresortsid LEFT JOIN vtiger_crmentity as c ON c.crmid = a.listresortsid WHERE c.deleted = 0';
            if (!empty($id)){
                $sql .=" and country = ?";
                array_push($array, $id);
            }
            $result = $adb->pquery($sql, $array);
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'listresortsid')] = $adb->query_result($result,$i,'resort');
            }
            return $pikList;
        }
        function getAirlinePikList(){
             global $adb;
            $pikList = array();
            $result = $adb->pquery('SELECT a.*, cf.* FROM vtiger_listairlines as a LEFT JOIN vtiger_listairlinescf as cf ON cf.listairlinesid = a.listairlinesid LEFT JOIN vtiger_crmentity as c ON c.crmid = a.listairlinesid WHERE c.deleted = 0 ORDER BY a.airlines', array());
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'airlines')] = $adb->query_result($result,$i,'airlines');
            }
            return $pikList;
        }
        function getAirportsPikList(){
            global $adb;
            $pikList = array();
            $result = $adb->pquery('SELECT a.*, cf.* FROM vtiger_listairports as a LEFT JOIN vtiger_listairportscf as cf ON cf.listairportsid = a.listairportsid LEFT JOIN vtiger_crmentity as c ON c.crmid = a.listairportsid WHERE c.deleted = 0 ORDER BY a.airport', array());
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'airport')] = $adb->query_result($result,$i,'airport');
            }
            return $pikList;
        }
        function getTypeRoomsPikList(){
            global $adb;
            $pikList = array();
            $result = $adb->pquery('SELECT a.* FROM vtiger_type_room as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.type_roomid WHERE c.deleted = 0 ORDER BY a.type_room', array());
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'type_room')] = $adb->query_result($result,$i,'type_room');
            }
            return $pikList;
        }
        
        function getServicePickList($service) {
            global $adb;
            $pikList = array();
            $result = $adb->pquery('SELECT a.* FROM vtiger_service as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.serviceid WHERE c.deleted = 0 AND servicecategory = ?', array($service));
           
            $numRows = $adb->num_rows($result);
            for ($i=0; $i<$numRows;$i++){
                $pikList[$adb->query_result($result,$i,'serviceid')] = $adb->query_result($result,$i,'servicename');
            }
            return $pikList;
        }
        function getListContact($data, $dogovor){
            global $adb;
            if (empty($data)) return array();
            $id = explode('#', $data);
            $contact_info = array();
            if (empty($data)) $dogovor = array();
            else {
                $_dogovor = explode(':',$dogovor);
                if ($_dogovor[1] == 'none'){
                    $contact_info[$_dogovor[0]] = 'none';
                }
                else {
                    $contact_info[$_dogovor[0]] = 'turist';
                }
            }
            
            
            
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $records = implode(',', $id );
        $sql = "SELECT a.*, b.*, g.birthday, d.* FROM vtiger_contactdetails as a "
                . "LEFT JOIN vtiger_contactaddress as b ON b.contactaddressid=a.contactid "
                . "LEFT JOIN vtiger_contactsubdetails as g ON g.contactsubscriptionid = a.contactid "
                . "LEFT JOIN vtiger_contactscf as d ON d.contactid = a.contactid "
                . "WHERE a.contactid IN ($records)";
        $result = $adb->pquery($sql, array());
        $numRows = $adb->num_rows($result);
        $list = array();
        
        for($i=0;$i<$numRows;$i++){
            $crmid = $adb->query_result($result,$i,'contactid');
            $list[$crmid] = $adb->query_result_rowdata($result,$i);
            if (!empty($contact_info[$crmid])){
                $list[$crmid]['TYPEDOGOVOR'] = $contact_info[$crmid];
            }
            else {
                $list[$crmid]['TYPEDOGOVOR'] = false;
            }
            
        }
        
        return $list;
            
        }
        function getListPayment($recordId,$type){
             global $adb;
            $sql = "SELECT a.* FROM sp_payments as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.payid WHERE c.deleted = 0 and a.related_to = ? and a.pay_type= ? and spstatus = ?";
           $result = $adb->pquery($sql,array($recordId,$type,'Executed'));
           $list = array();
           $numRows = $adb->num_rows($result);
           for($i=0;$i<$numRows;$i++){
               $list[$adb->query_result($result,$i,'payid')] = $adb->query_result_rowdata($result,$i);
           }
           return $list;
        }
        function getCountryIsVisa($id){
             global $adb;
            
            $result = $adb->pquery('SELECT * FROM vtiger_listcountry WHERE listcountryid = ?', array($id));
           $is_visa = $adb->query_result($result,0,'visa');
           if ($is_visa == 1){
               return true;
           }
            return false;
        }
        
        
}