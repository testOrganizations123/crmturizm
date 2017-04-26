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
//include_once 'include/Webservices/Create.php';
require_once 'include/Webservices/Utils.php';
require_once 'include/Webservices/WebserviceEntityOperation.php';
require_once 'include/Webservices/Retrieve.php';
require_once 'modules/com_vtiger_workflow/VTEntityCache.inc';
require_once 'modules/com_vtiger_workflow/VTJsonCondition.inc';
//require_once('include/utils/UserInfoUtil.php');

//Vtiger_Detail_View
class VChat_GetDataVChat_View extends Vtiger_IndexAjax_View{
    
    function __construct() {
		$this->exposeMethod('uploadCallMes');	
		$this->exposeMethod('loadMes');	
		$this->exposeMethod('SearchCall');	
		
		
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
	
	
	    
    public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode) && $this->isMethodExposed($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
	}
	
	

	
	private function getRowChat($userfromid,$usertoid,$channel)
	{
		global $adb;
		 
		 if ($channel>0)
		 {
			 $sqlus = "SELECT * FROM  vtiger_vchat_text WHERE 	channelid='".$channel."' ORDER BY datecreate DESC LIMIT 1";
		 }
		 else
		 {
			$sqlus = "SELECT * FROM  vtiger_vchat_text WHERE userfrom='".$userfromid."' AND userto='".$usertoid."' AND	channelid='0' ORDER BY datecreate DESC LIMIT 1";
		 
		 }
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			//for($i = 0; $i < $adb->num_rows($resultus); $i++) 
			{
				$row = $adb->raw_query_result_rowdata($resultus,$i);
			}
		}
		//$row["sql"]=$sqlus;
		return $row;
	}
	
	
	
	
	private function getInfoChannel($userfrom)
	{
		global $adb;
		$sqluser = "SELECT * FROM   vtiger_vchat_text_namechannels WHERE id='".$userfrom."'";
		$resultuser = $adb->pquery($sqluser);
		if($adb->num_rows($resultuser) > 0) {
			$rowuser = $adb->raw_query_result_rowdata($resultuser,0);
		}
		return $rowuser;
	}
	
	private function getDataUser($userfrom)
	{
		global $adb;
		$sqluser = "SELECT * FROM   vtiger_users WHERE  vtiger_users.id='".$userfrom."'";
		$resultuser = $adb->pquery($sqluser);
		if($adb->num_rows($resultuser) > 0) {
			$rowuser = $adb->raw_query_result_rowdata($resultuser,0);
		}
		return $rowuser;
	}
	
	public function SearchCall()
	{
		global $adb;
		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userid='".$_SESSION['authenticated_user_id']."' AND view_channels='1'  ORDER BY datecreate DESC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			$rowmes = $adb->raw_query_result_rowdata($resultus,0);
			$date = strtotime("-5 second");//strtotime(date("Y-m-d H:i:s", strtotime("-10 second")));
			$date2=strtotime($rowmes["datecreate"]);
			
			//$mas["alertpanel"]=$date."<".$date2;
			if ($date<$date2)
			{
				$mas["alertpanel"]=1;
			}
			else
			{
				$mas["alertpanel"]=0;
			}
			/**/
			//mas["datecreate"]=$rowmes["datecreate"];
			$mas["view_channels"]=1;
		}
		else
		{
			$mas["view_channels"]=0;
		}


		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userid='".$_SESSION['authenticated_user_id']."' AND audioncheck='0' AND view_channels='1'  ORDER BY datecreate ASC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			$mas["audioncheck"]=1;
			$adb->pquery("update vtiger_vchat_text_viewsdialog set audioncheck='1' where  userid='".$_SESSION['authenticated_user_id']."' AND audioncheck='0' AND view_channels='1' ");
					
		}
		else
		{
			$mas["audioncheck"]=0;
		}


		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmllistcall'=>$mas);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
		/**/
	}

	public function loadMes()
	{
		global $adb;
		$id=$_REQUEST["id"];
		$sqluser = "SELECT * FROM  vtiger_vchat_text_viewsdialog WHERE  id='".$id."' AND userid='".$_SESSION['authenticated_user_id']."'";
		$resultuser = $adb->pquery($sqluser);
		if($adb->num_rows($resultuser) > 0) {
			$rowmes = $adb->raw_query_result_rowdata($resultuser,0);
			$countmes=$rowmes["countmes"];
			if ($rowmes["channelid"]==0)
			{
				$sqlus = "SELECT * FROM  vtiger_vchat_text WHERE channelid='0' AND userfrom='".$rowmes["userfromid"]."' AND userto='".$_SESSION['authenticated_user_id']."' ORDER BY datecreate DESC LIMIT ".$countmes."";
				$resultus = $adb->pquery($sqlus);
				if($adb->num_rows($resultus) > 0) 
				{
					for($i = 0; $i < $adb->num_rows($resultus); $i++) 
					{
						$rowdialog = $adb->raw_query_result_rowdata($resultus,$i);
						$text.="<div>".$rowdialog["message"]."</div>";
					}
				}	
			}
			else
			{
				$sqlus = "SELECT * FROM  vtiger_vchat_text WHERE channelid='".$rowmes["channelid"]."' ORDER BY datecreate DESC LIMIT ".$countmes."";
				$resultus = $adb->pquery($sqlus);
				if($adb->num_rows($resultus) > 0) 
				{
					for($i = 0; $i < $adb->num_rows($resultus); $i++) 
					{
						$rowdialog = $adb->raw_query_result_rowdata($resultus,$i);
						$text.="<div><div>".date("d-m-Y H:i", strtotime($rowdialog["datecreate"]))."</div>".$rowdialog["message"]."</div><br><br>";
					
					}
				}	
			}
		}
		//$text=
		//"<div><a href='# return false' onclick='closePanelVChat()'>Закрыть</a><hr>"+$text+"</div>";
		$result2 = array('success'=>true, 'message'=>'+','htmlchat'=>$text);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
	}
	/**/
	
	
	public function uploadCallMes()
	{
		global $adb;
		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE view_channels='1' AND userid='".$_SESSION['authenticated_user_id']."'  
		ORDER BY view_channels DESC, datecreate DESC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			for($i = 0; $i < $adb->num_rows($resultus); $i++) 
			{
				$row = $adb->raw_query_result_rowdata($resultus,$i);
				$jj++;
				$rowtext=$this->getRowChat($row["userfromid"],$row["userid"],$row["channelid"]);
				$mas[$jj]=$rowtext["message"];
				$masid[$jj]=$rowtext["id"];
				$time[$jj]=date("H:i", strtotime($rowtext["datecreate"]));
				$mas_channel[$jj]=$row["view_channels"];
				$mas_countmes[$jj]=$row["countmes"];
				$mas_reocrd[$jj]=$row["id"];
				if ($row["channelid"]==0)
				{
					//channelid
					$mas_type[$jj]="user";
					$dataname=$this->getDataUser($row["userfromid"]);
					$name=$dataname["first_name"]." ".$dataname["last_name"];
					$mas_from[$jj]=$row["userfromid"];
				}
				else
				{
					$mas_from[$jj]=$row["channelid"];
					$mas_type[$jj]="channel";
					$dataname=$this->getInfoChannel($row["channelid"]);
					$name=$dataname["name"];
				}
				$fromuser[$jj]=$name;
			}
		}
		/*
		$mas4["countmes"]=$mas_countmes;
		$mas3["view_channels"]=$mas_channel;
		/**/
		
		$mas2["type"]=$mas_type;
		$mas2["recoridfrom"]=$mas_from;
		$mas2["recorid"]=$mas_reocrd;
		$mas2["time"]=$time;
		$mas2["fromuser"]=$fromuser;
		$mas2["countmes"]=$mas_countmes;
		$mas2["userchat"]=$mas;
		$mas2["mesid"]=$masid;
		
		$mas2["countel"]=$adb->num_rows($resultus);
		
		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmllistcall'=>$mas2);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
		/**/
	}
	
	public function SearchCall2()
	{
		global $adb;
		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userid='".$_SESSION['authenticated_user_id']."' AND view_channels='1'  ORDER BY datecreate ASC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			$mas["view_channels"]=1;
		}
		else
		{
			$mas["view_channels"]=0;
		}


		$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userid='".$_SESSION['authenticated_user_id']."' AND audioncheck='0' AND view_channels='1'  ORDER BY datecreate ASC";
		$resultus = $adb->pquery($sqlus);
		if($adb->num_rows($resultus) > 0) 
		{
			$mas["audioncheck"]=1;
			$adb->pquery("update vtiger_vchat_text_viewsdialog set audioncheck='1' where  userid='".$_SESSION['authenticated_user_id']."' AND audioncheck='0' AND view_channels='1' ");
					
		}
		else
		{
			$mas["audioncheck"]=0;
		}

		$result2 = array('success'=>true, 'message'=>'!!!!!!','returnid'=>'1','htmllistcall'=>$mas);
		$response = new Vtiger_Response();
		$response->setResult($result2);
		$response->emit();
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