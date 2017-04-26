<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class FoulList_Record_Model extends Vtiger_Record_Model {
     public function getPickListOwner($user){
         global $adb, $current_user;
         $myRole = $current_user->column_fields['roleid'];
         $sql = 'SELECT * FROM vtiger_user2role WHERE userid =?';
         $result = $adb->pquery($sql, array($user));
         $roleId = $adb->query_result($result,0,'roleid');
         $sql = 'SELECT * FROM vtiger_role WHERE roleid = ?';
         $result = $adb->pquery($sql, array($roleId));
         $parentrole = explode('::',$adb->query_result($result,0,'parentrole'));
         $parent = array();
         $end = false;
         for (end($parentrole); ($key = key($parentrole)); prev($parentrole)) { 
             if (!$end){
                if($parentrole[$key] != $roleId && $parentrole[$key] != 'H2'){
                    array_push($parent,$parentrole[$key]);
                } 
                if ($parentrole[$key] == $myRole){
                    $end = true;
                }
             }
         }
         $rolestring = '';
         foreach ($parent as $value){
             $rolestring .= '"'.$value.'",';
         }
         $rolestring = trim($rolestring,",");
         
         $sql = "SELECT concat(u.first_name, ' ', u.last_name) as name, u.id, r.rolename, r.parentrole FROM vtiger_user2role as ur INNER JOIN vtiger_users as u ON u.id = ur.userid LEFT JOIN vtiger_role as r ON r.roleid = ur.roleid WHERE ur.roleid in ($rolestring)";
         $result = $adb->pquery($sql, array());
         
         $numRows = $adb->num_rows($result);
         $pickList = array();
         for ($i=0;$i<$numRows;$i++){
             $row = $adb->query_result_rowdata($result,$i);
             if ($current_user->id != $row['id']){
                $classRole = count(explode('::',$row['parentrole']));
                $pickList[$row['rolename']][$row['id']] = $row['name'];
             }
         }
         $sql = "SELECT concat(u.first_name, ' ', u.last_name) as name, u.id, r.rolename, r.parentrole FROM vtiger_user2role as ur INNER JOIN vtiger_users as u ON u.id = ur.userid LEFT JOIN vtiger_role as r ON r.roleid = ur.roleid WHERE ur.userid = ?";
         $result = $adb->pquery($sql, array($user));
         $row = $adb->query_result_rowdata($result,0);
         $classRole = count(explode('::',$row['parentrole']));
         $pickList[$row['rolename']][$row['id']] = $row['name'];
         return $pickList;
     }
     public function getBlock($id){
         global $adb;
         $sql = 'SELECT block_id FROM vtiger_solaryofoullist WHERE solaryofoullistid =?';
         $result = $adb->pquery($sql, array($id));

         return $adb->query_result($result,0,'block_id');
     }
     public function getPoint($id) {
         global $adb;
         $sql = 'SELECT point FROM vtiger_solaryofoullist WHERE solaryofoullistid =?';
         $result = $adb->pquery($sql, array($id));
         return $adb->query_result($result,0,'point');
     }
     public function  getA ($key){
         return $this->valueMap[$key];
     }
}