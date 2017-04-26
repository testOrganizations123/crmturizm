<?
global $adb;
if ($_REQUEST["start"]==10)
{
	$newdate = "0000-00-00 00:00:00";
	//date("Y-m-d H:i:s", strtotime("-1 day"));
}
else
{
	$newdate = date("Y-m-d H:i:s", strtotime("-1 second"));
}

if ($_REQUEST["startload"]>0)
{
	$starload=20*$_REQUEST["startload"];
}
else
{
	$starload=0;
}


if ($_REQUEST["topfav"]>0)
{
	//$starload=20*$_REQUEST["startload"];
}
else
{
	
}


$sqllimit=" limit ".$starload.",20";
if ($_REQUEST["typeobj"]=="channel")
{
	if ($_REQUEST["topfav"]>0)
	{
		$sqllimit="";
		$sql = "SELECT * FROM  vtiger_vchat_text_tab,vtiger_vchat_text WHERE 
		vtiger_vchat_text_tab.vtiger_vchat_text_id=vtiger_vchat_text.id AND
		vtiger_vchat_text.datecreate>='".$newdate."'
		AND ( vtiger_vchat_text.channelid='".$_REQUEST["user"]."') ORDER BY vtiger_vchat_text.datecreate DESC ".$sqllimit;
	}
	else
	{
		$sql = "SELECT * FROM  vtiger_vchat_text WHERE vtiger_vchat_text.datecreate>='".$newdate."'
		AND ( channelid='".$_REQUEST["user"]."') ORDER BY datecreate DESC ".$sqllimit;
		$channel=true;
	}
	
}
else
{
	$sql = "SELECT * FROM  vtiger_vchat_text WHERE vtiger_vchat_text.datecreate>='".$newdate."'
	AND (
	(userfrom='".$_SESSION['authenticated_user_id']."' AND userto='".$_REQUEST["user"]."') OR
	(userfrom='".$_REQUEST["user"]."' AND userto='".$_SESSION['authenticated_user_id']."') 
	)
	AND ( channelid='0') ORDER BY datecreate DESC
	".$sqllimit; 
}

$result = $adb->pquery($sql);

if($adb->num_rows($result) > 0) {
	for($i = 0; $i < $adb->num_rows($result); $i++) {
		
	   $row = $adb->raw_query_result_rowdata($result,$i);
	   
	   $sqltop = "SELECT * FROM    vtiger_vchat_text_tab WHERE  vtiger_vchat_text_id='".$row["id"]."' AND	userid='".$_SESSION['authenticated_user_id']."'";
	   $restop = $adb->pquery($sqltop);
	   $rowtop = $adb->raw_query_result_rowdata($restop,0);
	
	   if ($channel==true)
	   {
		   $sqluser = "SELECT * FROM   vtiger_users WHERE  vtiger_users.id='".$row["userfrom"]."'";
		   $resultuser = $adb->pquery($sqluser);
	   }
	   else
	   {
		   $sqluser = "SELECT * FROM   vtiger_users WHERE  vtiger_users.id='".$row["userfrom"]."'";
			$resultuser = $adb->pquery($sqluser);
	   }

		if($adb->num_rows($resultuser) > 0) {
			$rowuser = $adb->raw_query_result_rowdata($resultuser,0);
		}
		
	   $originalDate = $row["datecreate"];
	   $newDate = date("H:i", strtotime($originalDate));

	   if ($row["vchattexttoid"]>0)
	   {
		   $sqluser = "SELECT * FROM   vtiger_vchat_text WHERE  id='".$row["vchattexttoid"]."'";
		   $resultuser = $adb->pquery($sqluser);
		   $rowtexttouser = $adb->raw_query_result_rowdata($resultuser,0);
		   $list["vchattexttoid"]=$rowtexttouser["userfrom"]."<br>".$rowtexttouser["message"]; 
	   }
	   else
	   {
		    $list["vchattexttoid"]="";
	   }
	   
	   if ($rowtop["id"]>0)
	   {
		    $list["yellowdiv"]=1;
	   }
	   else
	   {
		    $list["yellowdiv"]=0;
	   }
	   
	   $list["messagetext"]=$row["message"];
	   $list["id"]=$row["id"];
	   $list["mainchannel"]=$row["mainchannel"];
	   $list["user"]=$rowuser["first_name"]." ".$rowuser["last_name"];
	   $list["username"]=$rowuser["user_name"];
	   $list["time"]=$newDate;
	   $list["img"]="img";
	   if ($_SESSION['authenticated_user_id']==$row["userfrom"])
	   {
		   $list["type"]=0;
	   }
	   else
	   {
		   $list["type"]=1;
	   }
	   
	   $mas2[$i]=$list;//["message"]
	}
	//arsort($mas2);
	$jj=count($mas2);
	for ($j=0;$j<=count($mas2)-1;$j++)
	{
		$jj--;
		$mas["message"][$j]=$mas2[$jj];
		 //$mas["message"][$j]=$mas2[$j];// $list;//["message"]
	}
	//$arr2 = array_msort($arr1, array('name'=>SORT_DESC, 'cat'=>SORT_ASC));
	//array_multisort($mas,  array('message'=>SORT_DESC));
}
else
{
	$mas["message"]=null;
}

$starload=$_REQUEST["startload"]+1;
$mas["starload"]=$starload;
$mas["limit"]=true;
print json_encode($mas);
exit;
?>