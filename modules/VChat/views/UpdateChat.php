<?
require_once 'include/Webservices/State.php';
require_once 'include/Webservices/OperationManager.php';
require_once 'include/Webservices/SessionManager.php';
require_once 'include/Webservices/WebserviceField.php';
require_once 'include/Webservices/EntityMeta.php';
require_once 'include/Webservices/VtigerWebserviceObject.php';
require_once 'include/Webservices/VtigerCRMObject.php';
require_once 'include/Webservices/VtigerCRMObjectMeta.php';
require_once 'include/Webservices/DataTransform.php';
require_once 'include/Webservices/WebServiceError.php';
require_once 'include/Webservices/ModuleTypes.php';
include_once 'include/Webservices/Create.php';
require_once 'include/Webservices/Utils.php';
require_once 'include/Webservices/WebserviceEntityOperation.php';
require_once 'include/Webservices/Retrieve.php';
require_once 'modules/com_vtiger_workflow/VTEntityCache.inc';
require_once 'modules/com_vtiger_workflow/VTJsonCondition.inc';
require_once('include/utils/UserInfoUtil.php');
//require_once 'modules/VChat/actions/Commander.php';


class VChat_Commander_Action extends Vtiger_Action_Controller{
    
    function __construct() {
		
		 $this->exposeMethod('addUsertChannel');
		 $this->exposeMethod('addChannel');
		 $this->exposeMethod('saveChannel');
		 $this->exposeMethod('seachUserLeftPanel');
		 $this->exposeMethod('uploadsubdata');
		 $this->exposeMethod('getUserList');
		 //$this->exposeMethod('SearchCall');
		 $this->exposeMethod('addFavorites');
		 $this->exposeMethod('closeDialog');
		 $this->exposeMethod('saveSendRelTo');
		 $this->exposeMethod('saveMessage');
		 $this->exposeMethod('deleteEntity');
   	}
    
    public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode) && $this->isMethodExposed($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
	}
	
	
    public function deleteEntity()
	{
		global $adb;
		$adb->pquery("update vtiger_vchat_text_namechannels set deleted='1' where id = '".$_REQUEST["record"]."'");
		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1');
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();				
	}
	
	/*update dialog for 'userto' answer user write*/
	private function updateDialog($channelto,$userto,$message)
	{
		global $adb;
		if ($channelto!=0)
		{
			$sql = "SELECT userid FROM  vtiger_vchat_text_users_channel WHERE channelid='".$channelto."'";
			$result = $adb->pquery($sql);
			if($adb->num_rows($result) > 0) {
				for($i = 0; $i < $adb->num_rows($result); $i++) {
				   $row = $adb->raw_query_result_rowdata($result,$i);
				   
				   $sql2 = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE channelid='".$channelto."' AND userfromid='0' AND userid='".intval($row["userid"])."' ";
				   $result2 = $adb->pquery($sql2);
					$rowuser[]=$row["userid"];
				   if ($_SESSION['authenticated_user_id']!=$row["userid"])
				   {
					   
						if($adb->num_rows($result2) > 0) 
						{
							$row2 = $adb->raw_query_result_rowdata($result2,0);
							
							$count=$row2["countmes"]+1;
							$adb->pquery("update vtiger_vchat_text_viewsdialog set userfromid='0', view_channels='1',datecreate='".date("Y-m-d H:i:s")."',audioncheck='0',countmes='".$count."' where id = '".$row2["id"]."'");
						}
						else
						{
							$sql2 = "insert into vtiger_vchat_text_viewsdialog(channelid, userfromid, userid, view_channels, datecreate,audioncheck,countmes) values(?,?,?,?,?,?,?)";
							$params2 = array($channelto, 0, $row["userid"], 1,  date("Y-m-d H:i:s"),0,1);
							$resultsave = $adb->pquery($sql2, $params2);
						}
						$this->updateCheckLogUser($row["userid"]);
						
				   }
				   else
				   {
					   if($adb->num_rows($result2) > 0) 
					   {
							$row2 = $adb->raw_query_result_rowdata($result2,0);
							$adb->pquery("update vtiger_vchat_text_viewsdialog set datecreate='".date("Y-m-d H:i:s")."' where id = '".$row2["id"]."'");
					   }
					   else
					   {
						    $sql2 = "insert into vtiger_vchat_text_viewsdialog(channelid, userfromid, userid, view_channels, datecreate,audioncheck,countmes) values(?,?,?,?,?,?,?)";
							$params2 = array($channelto, 0, $row["userid"], 0,  date("Y-m-d H:i:s"),0,0);
							$resultsave = $adb->pquery($sql2, $params2);
						   
					   }
					   $this->updateCheckLogUser($_SESSION['authenticated_user_id']); //?????
				   }
				}
				if ($this->isDomainAvailible('http://proxytest.1gb.ru/'))
				{
					$this->sendmessage($_SESSION['authenticated_user_id'],implode(",",$rowuser),$channelto,$message);
				}
			}
		}
		else
		if (($userto!=0))
		{
			$sql = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userfromid='".$_SESSION['authenticated_user_id']."' AND userid='".intval($userto)."' AND 	channelid='0' ";
			$result = $adb->pquery($sql);

			if($adb->num_rows($result) > 0) 
			{
				$row = $adb->raw_query_result_rowdata($result,0);
				$count=$row["countmes"]+1;
				$adb->pquery("update vtiger_vchat_text_viewsdialog set view_channels='1',datecreate='".date("Y-m-d H:i:s")."',audioncheck='0',countmes='".$count."' where id = '".$row["id"]."'");
			}
			else
			{
				$sql2 = "insert into vtiger_vchat_text_viewsdialog(channelid, userfromid, userid, view_channels, datecreate,audioncheck,countmes) values(?,?,?,?,?,?,?)";
				$params2 = array(0, $_SESSION['authenticated_user_id'], $userto, 1,  date("Y-m-d H:i:s"),0,1);
				$resultsave = $adb->pquery($sql2, $params2);
			}
			
		    if ($this->isDomainAvailible('http://proxytest.1gb.ru/'))
		    {
				$this->sendmessage($_SESSION['authenticated_user_id'],$userto,0,$message);
		    }
			$this->updateCheckLogUser($_SESSION['authenticated_user_id']);
			$this->updateCheckLogUser($userto);
		}
	}
	
	
	 function isDomainAvailible($domain)
     {
		   //Проверка на правильность URL 
		   if(!filter_var($domain, FILTER_VALIDATE_URL))
		   {
				   return false;
		   }

		   //Инициализация curl
		   $curlInit = curl_init($domain);
		   curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
		   curl_setopt($curlInit,CURLOPT_HEADER,true);
		   curl_setopt($curlInit,CURLOPT_NOBODY,true);
		   curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

		   //Получаем ответ
		   $response = curl_exec($curlInit);

		   curl_close($curlInit);

		   if ($response) return true;

		   return false;
       }
	   
    private function sendmessage($userfrom,$userto,$channel,$message)
    {
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL, 'http://proxytest.1gb.ru/message.php');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_POST, true);
			//$mas=array("1","2","3","4");
			curl_setopt($curl, CURLOPT_POSTFIELDS, "userfrom=".$userfrom."&userto=".$userto."&channel=".$channel."&message=".$message);
			$out = curl_exec($curl);
			echo $out;
			curl_close($curl);
		  }
    }
	   
	public function saveMessage()
	{
		global $adb;
		if ($_REQUEST["message"]!="")
		{
			$sql2 = "insert into vtiger_vchat_text (message, datecreate, userfrom, userto,channelid,vchattexttoid) values(?,?,?,?,?,?)";
			$params2 = array($_REQUEST["message"], date("Y-m-d H:i:s"), $_SESSION['authenticated_user_id'], $_REQUEST["userto"],$_REQUEST["channelto"],$_REQUEST["relto"]); //
			$result = $adb->pquery($sql2, $params2);
			
			if ($_REQUEST["channelto"]>0)
			{
				$sql = "SELECT subid FROM  vtiger_vchat_text_namechannels WHERE  deleted!='1' AND id='".$_REQUEST["channelto"]."'";
				$result2 = $adb->pquery($sql);
				if($adb->num_rows($result2) > 0) {
					$row = $adb->raw_query_result_rowdata($result2,0);
					$subid=$row["subid"];
					if ($subid>0)
					{
						$sql02 = "insert into vtiger_vchat_text (message, datecreate, userfrom, userto,channelid,vchattexttoid,mainchannel) values(?,?,?,?,?,?,?)";
						$params02 = array($_REQUEST["message"], date("Y-m-d H:i:s"), $_SESSION['authenticated_user_id'], $_REQUEST["userto"],$subid,$_REQUEST["relto"],$_REQUEST["channelto"]); //
						$result = $adb->pquery($sql02, $params02);
						
						$this->updateDialog($subid,0,$_REQUEST["message"]);
					}
				}	   
			}
			else
			{
				
			}
			
		  
		}
		
		$this->updateDialog($_REQUEST["channelto"],$_REQUEST["userto"],$_REQUEST["message"]);
		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1');
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
	}
	
	public function saveSendRelTo()
	{
		
		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmllistcall'=>$_REQUEST["record"]);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
	}
	
	public function closeDialog()
	{
		global $adb;
		if ($_REQUEST["record"]!=0)
		{
			if ($_REQUEST["type"]=="channel")
			{
				$adb->pquery("update vtiger_vchat_text_viewsdialog 	set view_channels='0', countmes='0'	
				where channelid='".$_REQUEST["record"]."' AND userid = '".$_SESSION['authenticated_user_id']."'");
			}
			else
			{
				$adb->pquery("update vtiger_vchat_text_viewsdialog 	set  view_channels='0' , countmes='0'
				where channelid='0' AND userfromid='".$_REQUEST["record"]."' 	AND userid = '".$_SESSION['authenticated_user_id']."'");
			}
		}


		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmllistcall'=>"1");
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
	}
	
	
	public function getUserList()
	{
		global $adb;
		$word=$_REQUEST["word"];
		$channel=(int)$_REQUEST["subfolder"];
		
		
		if ($word!="")
		{
			$sqldop="
			AND
			(vtiger_role.rolename LIKE '%".$word."%' OR vtiger_users.user_name LIKE '%".$word."%' OR vtiger_users.first_name LIKE '%".$word."%' OR vtiger_users.last_name LIKE '%".$word."%' )
			";
		}
	
		//$channel=39;
		if ($channel>0)
		{
			$sqlidchannels = "SELECT subid FROM  vtiger_vchat_text_namechannels WHERE  subid>0 AND  id='".$channel."' AND vtiger_vchat_text_namechannels.deleted!='1'  ";
			$resultidchannels = $adb->pquery($sqlidchannels);
			if($adb->num_rows($resultidchannels) > 0) {
				   $rowsubchannels = $adb->raw_query_result_rowdata($resultidchannels,0);
				   $subid=$rowsubchannels["subid"];
				   //vtiger_vchat_text_users_channel
				   
				   $sql = "SELECT * FROM
					vtiger_vchat_text_users_channel,				   
					 vtiger_users ,
					 vtiger_role ,
					 vtiger_user2role
					 WHERE 
					 vtiger_vchat_text_users_channel.channelid='".$subid."' AND
					 vtiger_vchat_text_users_channel.userid=vtiger_users.id AND
					 vtiger_role.roleid=vtiger_user2role.roleid AND
					 vtiger_users.id!='".$_SESSION['authenticated_user_id']."' AND
					 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ORDER BY last_name ASC";
					 
			}
			else
			{
				$sqlcuttentrole = "SELECT * FROM  
				 vtiger_users ,
				 vtiger_role ,
				 vtiger_user2role
				 WHERE 
				 vtiger_role.roleid=vtiger_user2role.roleid AND
				 vtiger_users.id='".$_SESSION['authenticated_user_id']."' AND
				 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ";

				$resultcuttentrole = $adb->pquery($sqlcuttentrole);
				if($adb->num_rows($resultcuttentrole) > 0)
				{
					$rowrole = $adb->raw_query_result_rowdata($resultcuttentrole,0);
					$roleid=$rowrole["roleid"];
					$parentrole=explode("::",$rowrole["parentrole"]);
					$depth=$rowrole["depth"];
					
					if (($depth>0)&&($depth<=3))
					{
						//$sqlrole=" ( vtiger_role.roleid='H16' OR  vtiger_role.roleid='H11' OR  vtiger_role.roleid='H10' OR  vtiger_role.roleid='H3' OR  vtiger_role.roleid='H2' OR  vtiger_role.parentrole='H1' OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
						$sqlrole=" ( vtiger_role.roleid='H16' OR  vtiger_role.roleid='H11' OR  vtiger_role.roleid='H10' OR  vtiger_role.roleid='H3' OR  vtiger_role.roleid='H2' OR  vtiger_role.parentrole='H1' OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
				
					}
					else
					if ($depth==4)
					{
						$sqlrole=" ( vtiger_role.roleid='".$parentrole["1"]."' OR ( vtiger_role.roleid='".$parentrole["2"]."' OR  vtiger_role.roleid='".$parentrole["3"]."'  OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
					
					}	
					else
					if ($depth==5)
					{
						$sqlrole=" ( vtiger_role.roleid='".$parentrole[4]."' OR  vtiger_role.roleid='".$parentrole[3]."'  OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
					
					}	
					else
					if ($depth==6)
					{
						$sqlrole=" ( vtiger_role.roleid='".$parentrole["4"]."' OR  vtiger_role.roleid='".$parentrole["5"]."'  OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
					
					}
					else
					if ($depth==7)
					{
						$sqlrole=" ( vtiger_role.roleid='".$parentrole["4"]."' OR  vtiger_role.roleid='".$parentrole["5"]."' OR  vtiger_role.parentrole='".$parentrole["6"]."' OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
					
					}
				}
				
				$sql = "SELECT * FROM  
				 vtiger_users ,
				 vtiger_role ,
				 vtiger_user2role
				 WHERE 
				".$sqlrole."
				 vtiger_role.roleid=vtiger_user2role.roleid AND
				 vtiger_users.id!='".$_SESSION['authenticated_user_id']."' AND
				 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ORDER BY last_name ASC";
				
			}
		}

		$result = $adb->pquery($sql);

		if($adb->num_rows($result) > 0) {
			for($i = 0; $i < $adb->num_rows($result); $i++) {
			   $row = $adb->raw_query_result_rowdata($result,$i);
				if ($row["id"]!="")
				{
					$sqlus = "SELECT * FROM    vtiger_vchat_text_users_channel WHERE userid='".$row["id"]."' AND channelid='".$channel."' ";
					$resultus = $adb->pquery($sqlus);
					if($adb->num_rows($resultus) > 0) 
					{
						$mas["consist"][$i]=1;
					}
					else
					{
						$mas["consist"][$i]=0;
					}
					
					/*
					$mas["username"][$i]=$row["last_name"].' '.$row["first_name"];
					$mas["userid"][$i]=$row["id"];
					$mas["rolename"][$i]=$row["rolename"];
					$mas["selectTUser"][$i]=$cl;
					$mas["countmes"][$i]=$row["countmes"];
					$mas["radiusVChat"][$i]=$masuseron[$row["id"]];
					*/
					
					$mas["username"][$i]="[".$row["rolename"]."] ".$row["last_name"].' '.$row["first_name"];
					$mas["userid"][$i]=$row["id"];
				}
			}
		}
		
		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmluser'=>$mas);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
		
	}
	
	public function uploadsubdata()
	{
		global $adb;
		$userid=$_REQUEST["userid"];
		
		$sqlchannels = "SELECT vtiger_users.user_name,vtiger_users.id,vtiger_users.first_name,vtiger_users.last_name, vtiger_vchat_text_users_channel.channelid FROM   vtiger_vchat_text_users_channel,vtiger_vchat_text_namechannels,vtiger_users 
		WHERE 
		vtiger_vchat_text_namechannels.deleted!='1' AND 
		vtiger_vchat_text_users_channel.channelid=vtiger_vchat_text_namechannels.id AND
		vtiger_users.id=vtiger_vchat_text_users_channel.userid	AND
		vtiger_vchat_text_users_channel.channelid='".$userid."'  ";
		$resultchannels = $adb->pquery($sqlchannels);
		if($adb->num_rows($resultchannels) > 0) {
			for($jj = 0; $jj < $adb->num_rows($resultchannels); $jj++) {
			   $rowchannels = $adb->raw_query_result_rowdata($resultchannels,$jj);
				if ($rowchannels["id"]!="")
				{
					$masChannel["namechannels"][$jj]=$rowchannels["first_name"].' '.$rowchannels["last_name"];
					$masChannel["channelsid"][$jj]=$rowchannels["id"];
					$masChannel["nameaccount"][$jj]=$rowchannels["user_name"];	
					$masChannel["nameaccountid"][$jj]=$rowchannels["id"];	
				}
			}
		}
		
		
		$sqlidchannels = "SELECT subid FROM  vtiger_vchat_text_namechannels WHERE id='".$userid."' AND vtiger_vchat_text_namechannels.deleted!='1'  ";
		$resultidchannels = $adb->pquery($sqlidchannels);
		if($adb->num_rows($resultidchannels) > 0) {
			   $rowsubchannels = $adb->raw_query_result_rowdata($resultidchannels,0);
			   $subid=$rowsubchannels["subid"];
		}
		
		$sqlhomechannels = "SELECT id,name FROM  vtiger_vchat_text_namechannels WHERE 
		((id='".$userid."' AND subid='0') OR (id='".$subid."' AND subid='0')) AND vtiger_vchat_text_namechannels.deleted!='1'";
		$resulthomechannels = $adb->pquery($sqlhomechannels);
		if($adb->num_rows($resulthomechannels) > 0) {
			   $rowhomechannels = $adb->raw_query_result_rowdata($resulthomechannels,0);
			   $homeid=$rowhomechannels["id"];
			   $homename="Главная:".$rowhomechannels["name"];
		}
		
		
		$sqlsubchannels = "SELECT * FROM  vtiger_vchat_text_namechannels WHERE (subid='".$userid."' OR subid='".$subid."')  AND subid!='0' AND vtiger_vchat_text_namechannels.deleted!='1' ";
		$resultsubchannels = $adb->pquery($sqlsubchannels);
		if($adb->num_rows($resultsubchannels) > 0) {
			for($jj = 0; $jj < $adb->num_rows($resultsubchannels); $jj++) {
			   $rowsubchannels = $adb->raw_query_result_rowdata($resultsubchannels,$jj);
				if ($rowsubchannels["id"]!="")
				{
					$masSubChannel["namechannels"][$jj]=$rowsubchannels["name"];
					$masSubChannel["channelsid"][$jj]=$rowsubchannels["id"];	
				}
			}
			$countchannels=$adb->num_rows($resultsubchannels);
		}
		else
		{
			$countchannels=0;
		}

		$masChannel["countEl"]=$adb->num_rows($resultchannels);

		
		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmluser'=>$masChannel,'htmlchannels'=>$masSubChannel,'sqls'=>$sqlsubchannels,'countchannels'=>$countchannels,'homeid'=>$homeid,'homename'=>$homename);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
		/**/
		
	}
	
	public function seachUser($channel)
	{
		global $adb;
		
		$word=$_REQUEST["word"];
		//$channel=$_REQUEST["channel"]; sdfsdfsdfsdf
		
		$masuseron=array("0"=>"0");
		/*
		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userid='".$_SESSION['authenticated_user_id']."'  ORDER BY datecreate ASC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			//AND view_channels='1'
			for($i = 0; $i < $adb->num_rows($resultus); $i++) 
			{
				$row = $adb->raw_query_result_rowdata($resultus,$i);
				$masuseron[$row["userfromid"]]=$row["view_channels"];
				if ($i>0)
				{
					$l.=",'".$row["userfromid"]."'";
				}
				else
				{
					$l.="'".$row["userfromid"]."'";
				}
			}
			$orderby=" ORDER BY FIELD(id,".$l.") DESC; ";
		}
		/**/
		
		if ($word!="")
		{
			$sqldop="
			AND
			(vtiger_role.rolename LIKE '%".$word."%' OR vtiger_users.user_name LIKE '%".$word."%' OR vtiger_users.first_name LIKE '%".$word."%' OR vtiger_users.last_name LIKE '%".$word."%' )
			";
		}
		
		if ($channel>0)
		{
			$sqlidchannels = "SELECT subid FROM  vtiger_vchat_text_namechannels WHERE  subid>0 AND  id='".$channel."' AND vtiger_vchat_text_namechannels.deleted!='1'  ";
			$resultidchannels = $adb->pquery($sqlidchannels);
			if($adb->num_rows($resultidchannels) > 0) {
				   $rowsubchannels = $adb->raw_query_result_rowdata($resultidchannels,0);
				   $subid=$rowsubchannels["subid"];
				   //vtiger_vchat_text_users_channel
				   
				   $sql = "SELECT * FROM
					vtiger_vchat_text_users_channel,				   
					 vtiger_users ,
					 vtiger_role ,
					 vtiger_user2role
					 WHERE 
					 vtiger_vchat_text_users_channel.channelid='".$subid."' AND
					 vtiger_vchat_text_users_channel.userid=vtiger_users.id AND
					 vtiger_role.roleid=vtiger_user2role.roleid AND
					 vtiger_users.id!='".$_SESSION['authenticated_user_id']."' AND
					 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ORDER BY last_name ASC";
					 
			}
			else
			{
				$sql = "SELECT * FROM  
				 vtiger_users ,
				 vtiger_role ,
				 vtiger_user2role
				 WHERE 
				 vtiger_role.roleid=vtiger_user2role.roleid AND
				 vtiger_users.id!='".$_SESSION['authenticated_user_id']."' AND
				 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ORDER BY last_name ASC";
				
			}
		}
		
		
		/*
		$sql = "SELECT * FROM  
		 vtiger_users ,
		 vtiger_role ,
		 vtiger_user2role
		 WHERE 
		 vtiger_role.roleid=vtiger_user2role.roleid AND
		 vtiger_users.id!='".$_SESSION['authenticated_user_id']."' AND
		 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ORDER BY last_name ASC";
		/**/
		$result = $adb->pquery($sql);

		if($adb->num_rows($result) > 0) {
			for($i = 0; $i < $adb->num_rows($result); $i++) {
			   $row = $adb->raw_query_result_rowdata($result,$i);
				if ($row["id"]!="")
				{
					$mas["username"][$i]=$row["last_name"].' '.$row["first_name"];
					$mas["userid"][$i]=$row["id"];
				}
			}
		}
		return $mas;
	}
	
	public function searchCheckLogUser($userid)
	{
		global $adb;
		$date = date("Y-m-d H:i:s", strtotime("-4 second"));
		$sqlus = "SELECT * FROM   vtiger_vchat_text_usercheckupdate WHERE userid='".$_SESSION['authenticated_user_id']."' 
		AND  datecreate>='".$date."' ";
		
		//file_put_contents("1.txt",$sqlus);
		
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function closeChanels($userid)
	{
		global $adb;
		//$adb->pquery("update vtiger_vchat_text_usercheckupdate set updateleftpanel='0' WHERE  userid='".$userid."' ");
	}
	
	/*function alert message to 'userto'*/
	public function updateCheckLogUser($userid)
	{
		global $adb;
		if ($userid!=0)
		{
			$sqlus = "SELECT * FROM   vtiger_vchat_text_usercheckupdate WHERE userid='".$userid."'";
			$resultus = $adb->pquery($sqlus);
			if($adb->num_rows($resultus) > 0) 
			{
				$adb->pquery("update vtiger_vchat_text_usercheckupdate set updateleftpanel='1',datecreate='".date("Y-m-d H:i:s")."' WHERE  userid='".$userid."' ");
			}
			else
			{
				$sql2 = "insert into vtiger_vchat_text_usercheckupdate(userid,updateleftpanel,datecreate) values(?,?,?)";
				$params2 = array($userid, 1, date("Y-m-d H:i:s"));
				$result_ch = $adb->pquery($sql2, $params2);
			}
		}
	}
	
	public function addFavorites()
	{
		global $adb;
		
		$record=$_REQUEST["record"];
		if ($record!=0)
		{
			$sqlus = "SELECT * FROM   vtiger_vchat_text_tab WHERE vtiger_vchat_text_id='".$record."' AND userid='".$_SESSION['authenticated_user_id']."'";
			$resultus = $adb->pquery($sqlus);
			if($adb->num_rows($resultus) > 0) 
			{
				$adb->pquery("DELETE FROM vtiger_vchat_text_tab WHERE vtiger_vchat_text_id=? AND userid=?", Array($record, $_SESSION['authenticated_user_id']));
				//$adb->pquery("update vtiger_vchat_text_usercheckupdate set updateleftpanel='1',datecreate='".date("Y-m-d H:i:s")."' WHERE  userid='".$userid."' ");
			}
			else
			{
				$sql2 = "insert into vtiger_vchat_text_tab (vtiger_vchat_text_id,userid,datecreate) values(?,?,?)";
				$params2 = array($record, $_SESSION['authenticated_user_id'], date("Y-m-d H:i:s"));
				$result_ch = $adb->pquery($sql2, $params2);
			}
		}
		$result2 = array('success'=>true,  'message'=>'true','returnid'=>'1');
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
	}
	
	public function seachUserLeftPanel()
	{
		global $adb;
		
		$word=$_REQUEST["word"];
		$channel=$_REQUEST["channel"];
		$open=$_REQUEST["true"];
		
		if ($_REQUEST["startsearchCannnelAndUser"]!=0)
		{
			if ($this->searchCheckLogUser($_SESSION['authenticated_user_id'])==false)
			{
				$result2 = array('success'=>false,  'message'=>'Не найдено новых событий','returnid'=>'1');
				$response = new Vtiger_Response();
				$response->setResult($result2);
				$response->emit();
				exit;
			}/**/
		}
		
		$masuseron=array("0"=>"0");
	
	
		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE 	userid='".$_SESSION['authenticated_user_id']."'  
		ORDER BY datecreate ASC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			for($i = 0; $i < $adb->num_rows($resultus); $i++) 
			{
				$row = $adb->raw_query_result_rowdata($resultus,$i);
				$maschannel2[$row["channelid"]]=$row["countmes"];
				if ($i>0)
				{
					$l2.=",'".$row["channelid"]."'";
				}
				else
				{
					$l2.="'".$row["channelid"]."'";
				}
			}
			$orderby2=" ORDER BY FIELD(vtiger_vchat_text_namechannels.id,".$l2.") DESC; ";
		}
		
		if ($word!="")
		{
			$sqldop2="
			AND
			(name LIKE '%".$word."%' )
			";
		}
		
		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE 	
		userid='".$_SESSION['authenticated_user_id']."'  AND channelid='0' 
		ORDER BY datecreate ASC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			for($i = 0; $i < $adb->num_rows($resultus); $i++) 
			{
				$row = $adb->raw_query_result_rowdata($resultus,$i);
				if ($row["channelid"]!="0")
				{
					$masuseron[$row["userfromid"]]=$row["countmes"];
				}
				else
				{
					$masuseron[$row["userfromid"]]=$row["countmes"];
				}
				if ($i>0)
				{
					$l.=",'".$row["userfromid"]."'";
				}
				else
				{
					$l.="'".$row["userfromid"]."'";
				}
			}
			$orderby=" ORDER BY FIELD(id,".$l.") DESC; ";
		}
		
		if ($word!="")
		{
			$sqldop="
			AND
			(vtiger_role.rolename LIKE '%".$word."%' OR vtiger_users.user_name LIKE '%".$word."%' OR vtiger_users.first_name LIKE '%".$word."%' OR vtiger_users.last_name LIKE '%".$word."%' )
			";
		}
		
		
		$sqlcuttentrole = "SELECT * FROM  
		 vtiger_users ,
		 vtiger_role ,
		 vtiger_user2role
		 WHERE 
		 vtiger_role.roleid=vtiger_user2role.roleid AND
		 vtiger_users.id='".$_SESSION['authenticated_user_id']."' AND
		 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ";

		$resultcuttentrole = $adb->pquery($sqlcuttentrole);
		if($adb->num_rows($resultcuttentrole) > 0)
		{
			$rowrole = $adb->raw_query_result_rowdata($resultcuttentrole,0);
			$roleid=$rowrole["roleid"];
			$parentrole=explode("::",$rowrole["parentrole"]);
			$depth=$rowrole["depth"];
			
			if (($depth>0)&&($depth<=3))
			{
				//$sqlrole=" ( vtiger_role.roleid='H3' OR  vtiger_role.roleid='H2' OR  vtiger_role.parentrole='H1' OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
				$sqlrole=" ( vtiger_role.roleid='H16' OR  vtiger_role.roleid='H11' OR  vtiger_role.roleid='H10' OR  vtiger_role.roleid='H3' OR  vtiger_role.roleid='H2' OR  vtiger_role.parentrole='H1' OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
				
			}
			else
			if ($depth==4)
			{
				$sqlrole=" ( vtiger_role.roleid='".$parentrole["2"]."' OR  vtiger_role.roleid='".$parentrole["3"]."'  OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
			
			}	
			else
			if ($depth==5)
			{
				$sqlrole=" ( vtiger_role.roleid='".$parentrole[4]."' OR  vtiger_role.roleid='".$parentrole[3]."'  OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
			
			}	
			else
			if ($depth==6)
			{
				$sqlrole=" ( vtiger_role.roleid='".$parentrole["4"]."' OR  vtiger_role.roleid='".$parentrole["5"]."'  OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
			
			}
			else
			if ($depth==7)
			{
				$sqlrole=" ( vtiger_role.roleid='".$parentrole["4"]."' OR  vtiger_role.roleid='".$parentrole["5"]."' OR  vtiger_role.parentrole='".$parentrole["6"]."' OR vtiger_role.parentrole LIKE '%".$roleid."%') AND ";
			
			}
		}
			
			
			/*
			$roleid." ".
			 
			*/
		$sql = "SELECT * FROM  
		 vtiger_users ,
		 vtiger_role ,
		 vtiger_user2role
		 WHERE 
		 ".$sqlrole."
		 vtiger_role.roleid=vtiger_user2role.roleid AND
		 vtiger_users.id!='".$_SESSION['authenticated_user_id']."' AND
		 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby." ";

		$result = $adb->pquery($sql);
		if($adb->num_rows($result) > 0)
		{
			$countElUser=$adb->num_rows($result);
			for($i = 0; $i < $adb->num_rows($result); $i++) {
				
			   $row = $adb->raw_query_result_rowdata($result,$i);
				if ($row["id"]!="")
				{
					//$sqlrole."<Br>".$rowrole["depth"]." ".
					$mas["username"][$i]=$row["last_name"].' '.$row["first_name"];
					$mas["userid"][$i]=$row["id"];
					$mas["rolename"][$i]=$row["rolename"];
					$mas["selectTUser"][$i]=$cl;
					$mas["countmes"][$i]=$row["countmes"];
					$mas["radiusVChat"][$i]=$masuseron[$row["id"]];
				}
			}
		}
		else
		{
			$countElUser=0;
		}

		$sqlchannels = "SELECT * FROM   vtiger_vchat_text_users_channel,vtiger_vchat_text_namechannels 
		WHERE 
		vtiger_vchat_text_users_channel.channelid=vtiger_vchat_text_namechannels.id AND
		vtiger_vchat_text_namechannels.deleted!='1' AND
		vtiger_vchat_text_namechannels.subid='0' AND
		 vtiger_vchat_text_users_channel.userid='".$_SESSION['authenticated_user_id']."' ".$sqldop2."
		 ".$orderby2."
		";
		$resultchannels = $adb->pquery($sqlchannels);
		if($adb->num_rows($resultchannels) > 0) 
		{
			$countEl=$adb->num_rows($resultchannels);
			for($jj = 0; $jj < $adb->num_rows($resultchannels); $jj++) {
			   $rowchannels = $adb->raw_query_result_rowdata($resultchannels,$jj);
				if ($rowchannels["id"]!="")
				{
					$masChannel["namechannels"][$jj]=$rowchannels["name"]; //.' '.$row["first_name"];
					$masChannel["channelsid"][$jj]=$rowchannels["id"];
					$masChannel["selectTChannel"][$jj]=$cl;
					$masChannel["countmes"][$jj]=$rowchannels["countmes"];
					$masChannel["radiusVChat"][$jj]=(int)$maschannel2[$rowchannels["channelid"]];
					/*
					if ($maschannel2[$rowchannels["channelid"]]==1)
					{
						$masChannel["radiusVChat"][$jj]=1;
						countEl
					}
					else
					{
						$masChannel["radiusVChat"][$jj]=0;
					}
					/**/
					$sqlcountchannels = "SELECT * FROM   vtiger_vchat_text_users_channel WHERE channelid='".$rowchannels["id"]."'";
					$resultcountchannels = $adb->pquery($sqlcountchannels);
					$count=$adb->num_rows($resultcountchannels);
					$masChannel["countuserchannelsid"][$jj]=$count;
				}
			}
		}
		else
		{
				$$countEl=0;
		}
	
		
		
		//$this->closeChanels($_SESSION['authenticated_user_id']);
		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmluser'=>$mas,'htmlhtmlchannellist'=>$masChannel,'countUsert'=>$countElUser,'countChannel'=>$countEl);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
	}
	
	public function getUniqueIDTable($table,$field) {
		 global $current_user,$adb;
		$sqlchannels = "SELECT ".$field." FROM  ".$table." ORDER BY ".$field." DESC LIMIT 1";
		$resultchannels = $adb->pquery($sqlchannels);
		if($adb->num_rows($resultchannels) > 0) {
			 $rowchannels = $adb->raw_query_result_rowdata($resultchannels,0);
			$uniqid=$rowchannels[$field]+1;
			return $uniqid;
		}
		else
		{
			return 0;
		}
		
	}
	
	
	
	public function addUsertChannel() {
        global $current_user,$adb;
		global $languageStrings;
		
		$sqlchannels = "SELECT * FROM  vtiger_vchat_text_users_channel WHERE userid='".intval($_REQUEST["userforchannel"])."' AND channelid='".intval($_REQUEST["namechannel"])."' ";
		$resultchannels = $adb->pquery($sqlchannels);
		if(!$adb->num_rows($resultchannels) > 0) {
			$sql2 = "insert into vtiger_vchat_text_users_channel(userid,datecreate, channelid) values(?,?,?)";
			$params2 = array($_REQUEST["userforchannel"], date("Y-m-d H:i:s"),$_REQUEST["namechannel"]);
			$result_ch = $adb->pquery($sql2, $params2);
			
			
			$result = array('success'=>true,'message'=>'!!!!!!');
		}
		else
		{
			$adb->pquery("DELETE FROM vtiger_vchat_text_users_channel WHERE userid='".intval($_REQUEST["userforchannel"])."' AND channelid='".intval($_REQUEST["namechannel"])."' ");
			$result = array('success'=>false,'message'=>'!!!!!!');
		}
		
		$this->updateCheckLogUser(intval($_REQUEST["userforchannel"]));
		
		$response = new Vtiger_Response();
		$response->setResult($result);
		$response->emit();
	}
	
	public function addChannel() {
        global $current_user,$adb;
		global $languageStrings;
		$subid=(int)$_REQUEST["subfolder"];
		$listUser=$this->seachUser($subid);
	
		$current_id = $this->getUniqueIDTable("vtiger_vchat_text_namechannels","id");
		$current_id=$current_id+1;
		$sql2 = "insert into vtiger_vchat_text_namechannels(id,subid, name, userid, datecreate) values(?,?,?,?,?)";
		$params2 = array($current_id,$subid,$_REQUEST["namechannel"],$_SESSION['authenticated_user_id'], date("Y-m-d H:i:s"));
		$result_ch = $adb->pquery($sql2, $params2);
		
		$sql3 = "insert into vtiger_vchat_text_users_channel(userid,datecreate, channelid) values(?,?,?)";
		$params3 = array($_SESSION['authenticated_user_id'], date("Y-m-d H:i:s"),$current_id);
		$result_ch3 = $adb->pquery($sql3, $params3);
		
		$this->updateCheckLogUser($_SESSION['authenticated_user_id']);
		
		$result = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmluser'=>$listUser,'getUniqueID'=>$current_id,'sqlhtml'=>$sql2."=".$current_id."=".$subid."=".$_REQUEST["namechannel"]."=".$_SESSION['authenticated_user_id']."=".date("Y-m-d H:i:s"));
		$response = new Vtiger_Response();
		$response->setResult($result);
		$response->emit();
		sleep(1);
		return $response;
	}
	
	
    public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$userPrivilegesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$permission = $userPrivilegesModel->hasModulePermission($moduleModel->getId());

		if(!$permission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
	}
    
    public function checkModuleViewPermission(Vtiger_Request $request){
        $response = new Vtiger_Response();
        $modules = array('Contacts','Leads');
        $view = $request->get('view');
        Users_Privileges_Model::getCurrentUserPrivilegesModel();
        foreach($modules as $module){
            if(Users_Privileges_Model::isPermitted($module, $view)){
                $result['modules'][$module] = true;
            }else{
                $result['modules'][$module] = false;
            }
        }
        $response->setResult($result);
        $response->emit();
    }
}
?>