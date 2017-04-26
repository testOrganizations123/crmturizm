<?
global $adb;

if ($_REQUEST["userto"]!=0)
{
	if ($_REQUEST["type"]=="channel")
	{
		//print "update vtiger_vchat_text_viewsdialog 	set view_channels='0' 	
		//where channelid='".$_REQUEST["userto"]."' AND userid = '".$_SESSION['authenticated_user_id']."'";
		
		$adb->pquery("update vtiger_vchat_text_viewsdialog 	set view_channels='0', countmes='0'	
		where channelid='".$_REQUEST["userto"]."' AND userid = '".$_SESSION['authenticated_user_id']."'");
	}
	else
	{
		//print "update vtiger_vchat_text_viewsdialog 	set view_channels='0' 	
		//where channelid='0' AND userfrom='".$_REQUEST["userto"]."' 	AND userid = '".$_SESSION['authenticated_user_id']."'";
		
		$adb->pquery("update vtiger_vchat_text_viewsdialog 	set  view_channels='0' , countmes='0'
		where channelid='0' AND userfromid='".$_REQUEST["userto"]."' 	AND userid = '".$_SESSION['authenticated_user_id']."'");
	}
	sleep(1);
}



/*
if ($_REQUEST["userto"]!="")
{
	//file_put_contents("1.txt","update vtiger_vchat_text_viewsdialog set view_channels='0' where userfromid='".intval($_REQUEST["userto"])."' AND userid='".$_SESSION['authenticated_user_id']."'");
	$adb->pquery("update vtiger_vchat_text_viewsdialog set view_channels='0' where userfromid='".intval($_REQUEST["userto"])."' AND userid='".$_SESSION['authenticated_user_id']."'");
}
/**/
exit;			
?>