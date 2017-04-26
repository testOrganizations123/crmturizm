<?
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


print json_encode($mas);
exit;
?>