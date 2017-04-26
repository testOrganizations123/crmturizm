<?
require_once 'modules/VChat/actions/Commander.php';
global $adb;
if ($_REQUEST["message"]!="")
{
	$sql2 = "insert into vtiger_vchat_text (message, datecreate, userfrom, userto,channelid,vchattexttoid) values(?,?,?,?,?,?)";
	$params2 = array($_REQUEST["message"], date("Y-m-d H:i:s"), $_SESSION['authenticated_user_id'], $_REQUEST["userto"],$_REQUEST["channelto"],$_REQUEST["relto"]); //
	$result = $adb->pquery($sql2, $params2);

	if ($_REQUEST["channelto"]!=0)
	{
		$sql = "SELECT userid FROM  vtiger_vchat_text_users_channel WHERE channelid='".$_REQUEST["channelto"]."'";
		$result = $adb->pquery($sql);
		if($adb->num_rows($result) > 0) {
			for($i = 0; $i < $adb->num_rows($result); $i++) {
			   $row = $adb->raw_query_result_rowdata($result,$i);
			   
			   $sql2 = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE channelid='".$_REQUEST["channelto"]."' AND userfromid='0' AND userid='".intval($row["userid"])."' ";
			   $result2 = $adb->pquery($sql2);

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
						$params2 = array($_REQUEST["channelto"], 0, $row["userid"], 1,  date("Y-m-d H:i:s"),0,1);
						$resultsave = $adb->pquery($sql2, $params2);
					}
					VChat_Commander_Action::updateCheckLogUser($row["userid"]);
			   }
			}
		}
	}
	else
	if (($_REQUEST["userto"]!=0))
	{
		$sql = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userfromid='".$_SESSION['authenticated_user_id']."' AND userid='".intval($_REQUEST["userto"])."' AND 	channelid='0' ";
		$result = $adb->pquery($sql);

		if($adb->num_rows($result) > 0) 
		{
			$row = $adb->raw_query_result_rowdata($result,0);
			$count=$row2["countmes"]+1;
			$adb->pquery("update vtiger_vchat_text_viewsdialog set view_channels='1',datecreate='".date("Y-m-d H:i:s")."',audioncheck='0',countmes='".$count."' where id = '".$row["id"]."'");
		}
		else
		{
			$sql2 = "insert into vtiger_vchat_text_viewsdialog(channelid, userfromid, userid, view_channels, datecreate,audioncheck,countmes) values(?,?,?,?,?,?,?)";
			$params2 = array(0, $_SESSION['authenticated_user_id'], $_REQUEST["userto"], 1,  date("Y-m-d H:i:s"),0,1);
			$resultsave = $adb->pquery($sql2, $params2);
		}
		VChat_Commander_Action::updateCheckLogUser($_SESSION['authenticated_user_id']);
		VChat_Commander_Action::updateCheckLogUser($_REQUEST["userto"]);
	}
	/**/
	
	
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
	   
	   function sendmessage()
	   {
		    if( $curl = curl_init() ) {
				curl_setopt($curl, CURLOPT_URL, 'http://proxytest.1gb.ru/message.php');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, "t=5222&d=1111");
				$out = curl_exec($curl);
				echo $out;
				curl_close($curl);
			  }
	   }
	   
       if (isDomainAvailible('http://proxytest.1gb.ru/'))
       {
			   sendmessage();
              // echo "Работает и готов отвечать на запросы!";
       }
       else
       {
              // echo "Ой, сайт не доступен.";
       }
}

exit;	

/*
CREATE TABLE  `chat`.`vtiger_vchat_text` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
`message` TEXT NOT NULL ,
`datecreate` DATE NOT NULL ,
`userfrom` INT NOT NULL ,
`userto` INT NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;

*/		
?>