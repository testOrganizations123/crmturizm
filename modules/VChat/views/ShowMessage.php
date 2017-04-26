<?
function getImageDetails($recordId) {
	global $adb;
	$imageDetails = array();
	if ($recordId) {
		$query = "SELECT vtiger_attachments.* FROM vtiger_attachments
		LEFT JOIN vtiger_salesmanattachmentsrel ON vtiger_salesmanattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
		WHERE vtiger_salesmanattachmentsrel.smid='".$recordId."'";

		$result = $adb->pquery($query);

		$imageId = $adb->query_result($result, 0, 'attachmentsid');
		$imagePath = $adb->query_result($result, 0, 'path');
		$imageName = $adb->query_result($result, 0, 'name');
		$imageDetails = array(
				'id' => $imageId,
				'orgname' => "",//$imageOriginalName,
				'path' => $imagePath.$imageId,
				'name' => $imageName
		);
	}
	return $imageDetails;
}


global $adb;
if ($_REQUEST["start"]==10)
{
	$newdate = "0000-00-00 00:00:00";
	//date("Y-m-d H:i:s", strtotime("-1 day"));
}
else
{
	$next=$_REQUEST["next"];
	if ($next!="")
	{
		$next=round($next/1000);
		$next=$next+3;
	}
	else
	{
		$next=20;
	}
	$next=20;
	$newdate = date("Y-m-d H:i:s", strtotime("-".$next."second"));
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
		   
			$sqltoansweruser = "SELECT * FROM  
			 vtiger_users ,
			 vtiger_role ,
			 vtiger_user2role
			 WHERE 
			 vtiger_role.roleid=vtiger_user2role.roleid AND
			 vtiger_users.id='".$rowtexttouser["userfrom"]."' AND
			 vtiger_user2role.userid=vtiger_users.id LIMIT 1";

			$resultansweruser = $adb->pquery($sqltoansweruser);

			if($adb->num_rows($resultansweruser) > 0) {
			   $rowus = $adb->raw_query_result_rowdata($resultansweruser,0);
				
				$from=$rowus["last_name"].' '.$rowus["first_name"];
				
				//$rowtexttouser["userfrom"]=$rowus["last_name"].' '.$rowus["first_name"];
			}
						
		   $list["vchattexttoid"]=$from."<br>".$rowtexttouser["message"]; 
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
	   
	   if ($row["mainchannel"]>0)
	   {
		   $sqlsubuser = "SELECT * FROM   vtiger_vchat_text_namechannels WHERE  id='".$row["mainchannel"]."'";
		   $ressubuser = $adb->pquery($sqlsubuser);
		   if($adb->num_rows($ressubuser) > 0) {
			 $rowus = $adb->raw_query_result_rowdata($ressubuser,0);
		     $list["mainchannel"]=$rowus["name"];
			 $list["mainchannelid"]=$rowus["id"];
		   }
	   }
	   else
	   {
		     $list["mainchannel"]="";
			 $list["mainchannelid"]=0;
	   }
	  
	   // $list["mainchannel"]=$row["mainchannel"];
		
	   $list["user"]=$rowuser["first_name"]." ".$rowuser["last_name"];
	   $list["username"]=$rowuser["user_name"];
	   $list["time"]=$newDate;
	   
	   $imgdetaile=getImageDetails($rowuser["id"]);
	   if ($imgdetaile["name"]!="")
	   {
		   $list["img"]=$imgdetaile["path"]."_".$imgdetaile["name"];
	   }
	   else
	   {
		   $list["img"]="layouts/vlayout/modules/VChat/img/w128h1281338911651user.png";
	   }
	   
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

	$jj=count($mas2);
	for ($j=0;$j<=count($mas2)-1;$j++)
	{
		$jj--;
		$mas["message"][$j]=$mas2[$jj];
	}
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