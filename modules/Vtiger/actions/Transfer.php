<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class Vtiger_Transfer_Action extends Vtiger_Action_Controller {
    public $office_id = false;
    public $userId = false;
    public $users_array = false;
    public $countUser = 0;
    public function checkPermission(Vtiger_Request $request) {
		
	}

	public function process(Vtiger_Request $request) {
		$function = $request->get('mode');
		$this->$function($request);
	}
        function checkOfficeId($request){
            global $adb;
            $record = $request->get('recordId');
            $testOffice = false;
           
            foreach ($record as $id_record){
                $sql = "SELECT u.office FROM vtiger_crmentity as c"
                        . " LEFT JOIN vtiger_users as u ON u.id = c.smownerid"
                        . " WHERE crmid = ?";
                $result = $adb->pquery($sql, array($id_record));
                $office = $adb->query_result($result,0,'office');
                if ($testOffice and $testOffice != $office){
                    return false;
                }
                else {
                    $testOffice = $office;
                }
            }
            return $testOffice;
        }
        function getOffice($id){
            global $adb;
            $this->userId = $id;
            $sql = "SELECT office FROM vtiger_users WHERE id = ?";
            
            $result = $adb->pquery($sql, array($id));
           
            return $adb->query_result($result,0,'office');
            
        }
        function complitParitet($request){
            $record = $request->get('record');
            $this->office_id = $this->getOffice($request->get('userid'));
            $this->users_array = $this->getUsersOff();
            $this->countUser = count($this->users_array);
            
            foreach ($record as $ModuleName=>$value){
                if ($value == 3) {continue;}
                elseif ($value == 1) {
                    $function = $ModuleName.'AllRecord';
                   
                    $this->$function($request);
                }
                elseif ($value == 2) {
                    $function = $ModuleName.'ActiveRecord';
                    $this->$function($request);
                }
            }
            $response = new Vtiger_Response();
            $response->setResult(true);
            $response->emit();
            
        }
        function updateCrmidArray($data){
            global $adb;
            foreach ($data as $user_id=>$crmids){
                $sql = "UPDATE vtiger_crmentity SET smownerid = ? WHERE crmid IN (".implode(',',$crmids).")";
                //echo $sql.$user_id."\n";
                $adb->pquery($sql, array($user_id));
                foreach ($crmids as $crmid){
                     $update = $this->chekTransfer($crmid);
                    if (!$update){
                        $sql = "INSERT INTO transfer_manager (oldowner, newowner, status, crmid) VALUES(?,?,2,?)";
                        $adb->pquery($sql, array($this->userId,$user_id,$crmid));
                    }else {
                        $sql = "UPDATE transfer_manager SET oldowner=?, newowner = ?, status = 2 WHERE id = ?";
                        $adb->pquery($sql, array($this->userId,$user_id,$update));
                    }
                    
                }
            }
        }
        function LeadsAllRecord(){
            global $adb;
            $sql = "SELECT crmid FROM vtiger_crmentity WHERE smownerid = ? and deleted = 0 and setype = ? ORDER BY crmid ASC";
            $result = $adb->pquery($sql,array($this->userId, 'Leads'));
            
            $numRows = $adb->num_rows($result);
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'crmid');
                         $leads[$user_id][] = $crmid;
                         $seactive_sql = "SELECT activityid FROM vtiger_seactivityrel WHERE crmid = ?";
                         $seResult = $adb->pquery($seactive_sql, array($crmid));
                         $_n = $adb->num_rows($seResult);
                         for($_i=0;$_i<$_n;$_i++){
                            $leads[$user_id][] = $adb->query_result($seResult,$_i,'activityid');
                         }
                         $i++;
                    }
                    
                }
            }
            else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'crmid');
                    $leads[$this->users_array[$i]][] = $crmid;
                    $seactive_sql = "SELECT activityid FROM vtiger_seactivityrel WHERE crmid = ?";
                    $seResult = $adb->pquery($seactive_sql, array($crmid));
                    $_n = $adb->num_rows($seResult);
                    for($_i=0;$_i<$_n;$_i++){
                        $leads[$this->users_array[$i]][] = $adb->query_result($seResult,$_i,'activityid');
                    }
                }
            }
            $this->updateCrmidArray($leads);
            $sql = "SELECT a.activityid FROM vtiger_activity as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.activityid WHERE a.activitytype = 'Обзвон туристов' and c.smownerid = ? and a.eventstatus = 'Planned'";
             $result = $adb->pquery($sql,array($this->userId));
            
             $numRows = $adb->num_rows($result);
             $leads = array();
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'activityid'); 
                         $leads[$this->users_array[$i]][] = $crmid;
                          $i++;
                    }
                }
            }
             else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'activityid'); 
                    $leads[$this->users_array[$i]][] = $crmid;
                }
            }
           
        $this->updateCrmidArray($leads);
            $sql = "SELECT a.activityid FROM vtiger_activity as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.activityid WHERE a.activitytype = 'Экспресс заявка' and smownerid = ? and a.eventstatus = 'Planned'";
             $result = $adb->pquery($sql,array($this->userId));
             $numRows = $adb->num_rows($result);
              $leads = array();
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'activityid'); 
                         $leads[$this->users_array[$i]][] = $crmid;
                          $i++;
                    }
                }
            }
             else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'activityid'); 
                    $leads[$this->users_array[$i]][] = $crmid;
                }
            }
            $this->updateCrmidArray($leads);
        
       }
        function LeadsActiveRecord(){
            global $adb;
            $sql = "SELECT vtiger_leaddetails.leadid FROM vtiger_activity ".
                    "INNER JOIN vtiger_crmentity ON vtiger_activity.activityid = vtiger_crmentity.crmid ".
                    "LEFT JOIN vtiger_seactivityrel ON vtiger_activity.activityid = vtiger_seactivityrel.activityid ". 
                    "LEFT JOIN vtiger_leaddetails ON vtiger_leaddetails.leadid = vtiger_seactivityrel.crmid ".
                    "WHERE vtiger_crmentity.deleted=0 AND   ((((vtiger_activity.status = 'Planned' )  OR (vtiger_activity.eventstatus = 'Planned' )) "
                    . "OR ((vtiger_activity.status = 'Новая' )  OR (vtiger_activity.eventstatus = 'Новая' ))) ) AND ( vtiger_activity.activitytype <> 'Emails')  "
                    . "AND vtiger_leaddetails.leadid > 0 AND vtiger_crmentity.smownerid = ? ORDER BY vtiger_activity.due_date ASC";
            $result = $adb->pquery($sql,array($this->userId));
            
            $numRows = $adb->num_rows($result);
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'leadid');
                         $leads[$user_id][] = $crmid;
                         $seactive_sql = "SELECT activityid FROM vtiger_seactivityrel WHERE crmid = ?";
                         $seResult = $adb->pquery($seactive_sql, array($crmid));
                         $_n = $adb->num_rows($seResult);
                         for($_i=0;$_i<$_n;$_i++){
                            $leads[$user_id][] = $adb->query_result($seResult,$_i,'activityid');
                         }
                         $i++;
                    }
                    
                }
            }
            else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'leadid');
                    $leads[$this->users_array[$i]][] = $crmid;
                    $seactive_sql = "SELECT activityid FROM vtiger_seactivityrel WHERE crmid = ?";
                    $seResult = $adb->pquery($seactive_sql, array($crmid));
                    $_n = $adb->num_rows($seResult);
                    for($_i=0;$_i<$_n;$_i++){
                        $leads[$this->users_array[$i]][] = $adb->query_result($seResult,$_i,'activityid');
                    }
                }
            }
            
        $this->updateCrmidArray($leads);
        $sql = "SELECT a.activityid FROM vtiger_activity as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.activityid WHERE a.activitytype = 'Обзвон туристов' and c.smownerid = ? and a.eventstatus = 'Planned'";
             $result = $adb->pquery($sql,array($this->userId));
            
             $numRows = $adb->num_rows($result);
             $leads = array();
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'activityid'); 
                         $leads[$this->users_array[$i]][] = $crmid;
                          $i++;
                    }
                }
            }
             else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'activityid'); 
                    $leads[$this->users_array[$i]][] = $crmid;
                }
            }
           
        $this->updateCrmidArray($leads);
            $sql = "SELECT a.activityid FROM vtiger_activity as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.activityid WHERE a.activitytype = 'Экспресс заявка' and smownerid = ? and a.eventstatus = 'Planned'";
             $result = $adb->pquery($sql,array($this->userId));
             $numRows = $adb->num_rows($result);
              $leads = array();
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'activityid'); 
                         $leads[$this->users_array[$i]][] = $crmid;
                          $i++;
                    }
                }
            }
             else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'activityid'); 
                    $leads[$this->users_array[$i]][] = $crmid;
                }
            }
            $this->updateCrmidArray($leads);
            
        }
         function PotentialsAllRecord(){
            global $adb;
            $sql = "SELECT crmid FROM vtiger_crmentity WHERE smownerid = ? and deleted = 0 and setype = ? ORDER BY crmid ASC";
            $result = $adb->pquery($sql,array($this->userId, 'Potentials'));
            
            $numRows = $adb->num_rows($result);
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'crmid');
                         $leads[$user_id][] = $crmid;
                         
                         $i++;
                    }
                    
                }
            }
            else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'crmid');
                    $leads[$this->users_array[$i]][] = $crmid;
                    
                }
            }
            
        $this->updateCrmidArray($leads);
            
        }
        function PotentialsActiveRecord(){
            global $adb;
            $sql = "SELECT c.crmid FROM vtiger_crmentity as c LEFT JOIN vtiger_potential as p ON p.potentialid = c.crmid WHERE smownerid = ? and deleted = 0 and setype = ? and p.sales_stage != 'Closed Won' and p.sales_stage != 'Closed Lost' ORDER BY crmid ASC";
            $result = $adb->pquery($sql,array($this->userId, 'Potentials'));
            
            $numRows = $adb->num_rows($result);
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'crmid');
                         $leads[$user_id][] = $crmid;
                         
                         $i++;
                    }
                    
                }
            }
            else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'crmid');
                    $leads[$this->users_array[$i]][] = $crmid;
                    
                }
            }
            
        $this->updateCrmidArray($leads);
            
        }
        function ContactsAllRecord(){
            global $adb;
            $sql = "SELECT crmid FROM vtiger_crmentity WHERE smownerid = ? and deleted = 0 and setype = ? ORDER BY crmid ASC";
            $result = $adb->pquery($sql,array($this->userId, 'Contacts'));
            
            $numRows = $adb->num_rows($result);
            if ($numRows > $this->countUser){
                $_delta = $numRows / $this->countUser;
                $i = 0;
                for ($d=0;$d<$numRows;$d++){
                    foreach($this->users_array as $user_id){
                        if($i >= $numRows) continue;
                         $crmid = $adb->query_result($result,$i,'crmid');
                         $leads[$user_id][] = $crmid;
                         
                         $i++;
                    }
                    
                }
            }
            else if ($numRows > 0){
                for ($i=0;$i<$numRows;$i++){
                    $crmid = $adb->query_result($result,$i,'crmid');
                    $leads[$this->users_array[$i]][] = $crmid;
                    
                }
            }
            
        $this->updateCrmidArray($leads);
            
        }
        function ContactsActiveRecord(){
            
            
        }
        function getUsersOff(){
             global $adb;
            $sql = "SELECT u.id, r.parentrole FROM vtiger_users as u LEFT JOIN vtiger_user2role as ur ON ur.userid = u.id LEFT JOIN vtiger_role as r ON r.roleid = ur.roleid WHERE u.office = ? and u.status = 'Active' and u.id != ? and deleted=0";
            $result = $adb->pquery($sql, array($this->office_id, $this->userId));
          
            $numRows = $adb->num_rows($result);
            $users = array();
            for ($i=0;$i<$numRows;$i++){
                $parentrole = $adb->query_result($result,$i,'parentrole');
                $role = explode('::',$parentrole);
                if (count($role)>5){
                    array_push($users, $adb->query_result($result,$i,'id'));
                }
            }
            return $users;
        }
        function getParitet($request){
            global $adb;
            $sql = "SELECT office FROM vtiger_users WHERE id = ?";
            $userId = $request->get('recordId');
            $result = $adb->pquery($sql, array($userId));
            $office = $adb->query_result($result,0,'office');
            if (!empty($office)){
               $body_tr = "<tr><td>Заявки</td><td style='text-align: center;'><input class='radioCrmid' type='radio' checked name='Leads' value='2' /></td><td style='text-align: center;'><input class='radioCrmid' type='radio' name='Leads' value='1' /></td><td style='text-align: center;'><input class='radioCrmid' type='radio' name='Leads' value='3' /></td>";
               $body_tr .= "<tr><td>Брони</td><td style='text-align: center;'><input class='radioCrmid' type='radio' checked name='Potentials' value='2' /></td><td style='text-align: center;'><input class='radioCrmid' type='radio' name='Potentials' value='1' /></td><td style='text-align: center;'><input class='radioCrmid' type='radio' name='Potentials' value='3' /></td>";
               $body_tr .= "<tr><td>Клиенты</td><td style='text-align: center;'></td><td style='text-align: center;'><input class='radioCrmid' type='radio' checked name='Contacts' value='1' /></td><td style='text-align: center;'><input class='radioCrmid' type='radio' name='Contacts' value='3' /></td>";
               $table = "<table class='massEditTable table table-bordered'><tr><th>Название</th><th>Действующие</th><th>Все</th><th>Не передовать</th></tr>".$body_tr."</table>";
               $body = "<div class='quickCreateContent'><div class='modal-body'>".$table."</table></div></div>";
               $header = "<div class='modal-header contentsBackground'><button class='close' aria-hidden='true' data-dismiss='modal' type='button' title='закрыть'>x</button><h3>Паритетная передача</h3></div>";
               $footer = "<div class='modal-footer quickCreateActions'><button class='btn btn-success' onclick='paritet_complite(event)'><strong>Передать</strong></button><a class='cancelLink cancelLinkContainer pull-right' type='reset' data-dismiss='modal'>Отменить</a></div></div>";
               $html = "<div class='modelContainer'>".$header.$body.$footer;
               
            } else {
                $html = '<div class="modelContainer">'.
                    '<div class="modal-header contentsBackground">'.
                        '<button class="close" aria-hidden="true" data-dismiss="modal" type="button" title="закрыть">x</button>'.
                        '<h3>Паритетная передача</h3>'.
                    '</div><div class="quickCreateContent">
		<div class="modal-body"><h4>Сотрудник не являетесь сотрудником ни одного офиса</h4></div></div>
                <div class="modal-footer quickCreateActions"><a class="cancelLink cancelLinkContainer pull-right" type="reset" data-dismiss="modal">Отменить</a></div></div>';
            }
            $response = new Vtiger_Response();
               $response->setResult($html);
               $response->emit();
        }
        function getUsers($request){
            global $current_user, $adb;
            $office_id = $current_user->column_fields['office'];
           
            $module = $request->get('module');
            if(empty($office_id)){
                $user = Users_Record_Model::getCurrentUserModel();
                $priv = $user->getParentRoleSequence();
               
                $test_priv = explode('::',$priv);
                if ($priv === NULL || count($test_priv) <= 5){
                    
                    $office_id = $this->checkOfficeId($request);
                    if ($office_id){
                        $this->getUserList($office_id, $current_user->id, $module);
                    }
                }
                
                    $this->errorOffice();
               
            }
            else {
                $this->getUserList($office_id, false, $module);
            }
            
        }
        function errorOffice(){
        $html = '<div class="modelContainer">'.
                    '<div class="modal-header contentsBackground">'.
                        '<button class="close" aria-hidden="true" data-dismiss="modal" type="button" title="закрыть">x</button>'.
                        '<h3>Передача заявок</h3>'.
                    '</div><div class="quickCreateContent">
		<div class="modal-body"><h4>Вы не являетесь сотрудником ни одного офиса</h4></div></div>
                <div class="modal-footer quickCreateActions"><a class="cancelLink cancelLinkContainer pull-right" type="reset" data-dismiss="modal">Отменить</a></div></div>';
        echo $html;
        exit();
        }
        function getUserList($office_id, $boss = false,$module){
            global $current_user, $adb;
            $sql = "SELECT * FROM vtiger_users WHERE office = ? and status = ?";
            $result = $adb->pquery($sql, array($office_id,'Active'));
            //print_r($result);
            $numRows = $adb->num_rows($result);
           
            $option = '';
            for ($i=0; $i < $numRows; $i++){
                if(($boss and $boss == $adb->query_result($result,$i,'id')) or $current_user->id == $adb->query_result($result,$i,'id')){
                    continue;
                }
                $option .= '<option value="'.$adb->query_result($result,$i,'id').'">'.$adb->query_result($result,$i,'first_name').' '.$adb->query_result($result,$i,'last_name').'</option>';
                
            }
            $html = '<div class="modelContainer">'.
                    '<div class="modal-header contentsBackground">'.
                        '<button class="close" aria-hidden="true" data-dismiss="modal" type="button" title="закрыть">x</button>'.
                        '<h3>Передача заявок</h3>'.
                    '</div><div class="quickCreateContent">
		<div class="modal-body"><table class="massEditTable table table-bordered">
				<tr><td>Выбирите сотрудника для передачи</td><td><select id="selectUserTransfer">'.$option.'</select></td></tr></table></div></div>
                <div class="modal-footer quickCreateActions"><button class="btn btn-success" onclick="'.$module.'_mass_transfer(event)"><strong>Передать</strong></button><a class="cancelLink cancelLinkContainer pull-right" type="reset" data-dismiss="modal">Отменить</a></div></div>';
            echo $html;
        exit();
        }
        function transferInitiate($request){
            global $current_user, $adb;
            $module = $request->get('module');
            $record = $request->get('recordId');
            $newOwner = $request->get('newusers');
            $oldUser = $current_user->id;
            $status = 1;
            $user = Users_Record_Model::getCurrentUserModel();
                $priv = $user->getParentRoleSequence();
               
                $test_priv = explode('::',$priv);
            if ($priv === NULL || count($test_priv) <= 5){
                     $status = 2;
                 }
                
            if ($module == 'Leads'){
                $sql = "SELECT * FROM vtiger_seactivityrel WHERE crmid IN (".implode(",", $record).") ORDER BY activityid DESC";
               
                $result = $adb->pquery($sql, array());
               
                $numRows = $adb->num_rows($result);
                $leadsid = array();
                for ($i=0; $i<$numRows; $i++){
                    $leadsid[$adb->query_result($result,$i,'crmid')][] = $adb->query_result($result,$i,'activityid'); 
                    
                }
                foreach ($leadsid as $key=>$value){
                    if ($status == 2){
                        $sql = "SELECT smownerid FROM vtiger_crmentity WHERE crmid = $key";
                        $result = $adb->pquery($sql, array());
                        $oldUser = $adb->query_result($result,0,'smownerid');
                    }
                    $update = $this->chekTransfer($key);
                    if (!$update){
                        $sql = "INSERT INTO transfer_manager (oldowner, newowner, status, relcrmid, crmid, name) VALUES($oldUser,$newOwner,$status,'".implode('::', $value)."',$key, 'Заявка')";
                        $adb->pquery($sql, array());
                    }else {
                        $sql = "UPDATE transfer_manager SET oldowner=$oldUser, newowner = $newOwner, status = $status, relcrmid='".implode('::', $value)."' WHERE id = $update";
                        $adb->pquery($sql, array());
                    }
                    if ($status == 2){
                        $sql = "UPDATE vtiger_crmentity SET smownerid = ? WHERE crmid = ?";
                        $adb->pquery($sql, array($newOwner, $key));
                        //$relcrmid = explode('::', $value);
                        foreach ($value as $crmid){
                            $sql = "UPDATE vtiger_crmentity SET smownerid = ? WHERE crmid = ?";
                            $adb->pquery($sql, array($newOwner, $crmid));
                        }
                    
                    }
                    
                }
            }
            else {
                 foreach ($record as $value){
                     if ($status == 2){
                        $sql = "SELECT smownerid FROM vtiger_crmentity WHERE crmid = $value";
                        $result = $adb->pquery($sql, array());
                        $oldUser = $adb->query_result($result,0,'smownerid');
                    }
                     $update = $this->chekTransfer($value);
                    if (!$update){
                        $sql = "INSERT INTO transfer_manager (oldowner, newowner, status, crmid, name) VALUES($oldUser,$newOwner,$status,$value, 'Бронь')";
                       
                        $adb->pquery($sql, array());
                    }else {
                        $sql = "UPDATE transfer_manager SET newowner = $newOwner, status = $status WHERE id = $update";
                        $adb->pquery($sql, array());
                    }
                    if ($status == 2){
                        $sql = "UPDATE vtiger_crmentity SET smownerid = ? WHERE crmid = ?";
                        $adb->pquery($sql, array($newOwner, $value));
                        
                    
                    }
                 }
            }
           $response = new Vtiger_Response();
           $response->setResult($leadsid);
           $response->emit();
        }
        function chekTransfer($key){
           global $current_user, $adb;
           $sql = "SELECT * FROM transfer_manager WHERE crmid = $key";
          
           $result = $adb->pquery($sql, array());
           $numRows = $adb->num_rows($result);
           if ($numRows > 0){
               return $adb->query_result($result,0,'id');
           }
           else return false;
        }
        function checkTransferUser(){
           global $current_user, $adb;
           $user = $current_user->id;
           $sql = "SELECT t.*, u.first_name, u.last_name, c.label FROM transfer_manager as t LEFT JOIN vtiger_users as u ON u.id = t.oldowner LEFT JOIN vtiger_crmentity as c ON c.crmid = t.crmid WHERE t.status=1 and t.newowner = $user";
           $result = $adb->pquery($sql,array());
          
           $numRows = $adb->num_rows($result);
           
           if ($numRows > 0){
               $body_tr = "";
               for ($i=0;$i<$numRows;$i++){
                   $body_tr .= '<tr><td>'.$adb->query_result($result,$i,'label').'</td><td>'. $adb->query_result($result,$i,'first_name'). ' ' . $adb->query_result($result,$i,'last_name') . "</td><td style='text-align: center;'><input class='radioCrmid' data-id='".$adb->query_result($result,$i,'crmid')."' type='radio' checked name='crmid[".$adb->query_result($result,$i,'crmid')."]' value='2' /></td><td style='text-align: center;'><input type='radio' class='radioCrmid' data-id='".$adb->query_result($result,$i,'crmid')."' name='crmid[".$adb->query_result($result,$i,'crmid')."]' value='3' /></td></tr>";
               }
               $table = "<table class='massEditTable table table-bordered'><tr><th>Название</th><th>От кого</th><th>Принять</th><th>Отказаться</th></tr>".$body_tr."</table>";
               $body = "<div class='quickCreateContent'><div class='modal-body'>".$table."</table></div></div>";
               $header = "<div class='modal-header contentsBackground'><button class='close' aria-hidden='true' data-dismiss='modal' type='button' title='закрыть'>x</button><h3>Запросы на передачу</h3></div>";
               $footer = "<div class='modal-footer quickCreateActions'><button class='btn btn-success' onclick='transfer_complite(event)'><strong>Сохранить</strong></button><a class='cancelLink cancelLinkContainer pull-right' type='reset' data-dismiss='modal'>Отменить</a></div></div>";
               $html = "<div class='modelContainer'>".$header.$body.$footer;
               $response = new Vtiger_Response();
               $response->setResult($html);
               $response->emit();
               
           }
           else {
           $response = new Vtiger_Response();
           $response->setError(false);
               $response->emit();
           }
          
        }
        function complitTransferUser($request){
            global $adb, $current_user;
            $record = $request->get('record');
            $user = $current_user->id;
            
            foreach ($record as $value){
                if($value['value'] == 2){
                    $sql = "SELECT * FROM transfer_manager WHERE crmid = ? and status = 1 and newowner = ?";
                    $result = $adb->pquery($sql, array($value['crmid'], $user));
                    $id = $adb->query_result($result,0,'id');
                    $relcrmid = $adb->query_result($result,0,'relcrmid');
                    $sql = "UPDATE vtiger_crmentity SET smownerid = ? WHERE crmid = ?";
                    $adb->pquery($sql, array($user, $value['crmid']));
                    $relcrmid = explode('::', $relcrmid);
                    foreach ($relcrmid as $crmid){
                        $sql = "UPDATE vtiger_crmentity SET smownerid = ? WHERE crmid = ?";
                        $adb->pquery($sql, array($user, $crmid));
                    }
                    $sql = "UPDATE transfer_manager SET status = 2 WHERE id = ?";
                    $adb->pquery($sql, array($id));
                }
                else if ($value['value'] == 3){
                    $sql = "SELECT * FROM transfer_manager WHERE crmid = ? and status = 1 and newowner = ?";
                    $result = $adb->pquery($sql, array($value['crmid'], $user));
                    $id = $adb->query_result($result,0,'id');
                    $sql = "UPDATE transfer_manager SET status = 3 WHERE id = ?";
                    $adb->pquery($sql, array($id));
                    
                }
            }
            $response = new Vtiger_Response();
            $response->setResult(true);
            $response->emit();
        }
}