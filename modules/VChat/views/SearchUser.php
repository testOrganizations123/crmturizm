<?
function seachUser($word,$channel)
{
	global $adb;
	$masuseron=array("0"=>"0");
	$sqlus = "SELECT * FROM   vtiger_vchat_text_viewsdialog WHERE userid='".$_SESSION['authenticated_user_id']."'  ORDER BY datecreate ASC";
	$resultus = $adb->pquery($sqlus);
	if($adb->num_rows($resultus) > 0) 
	{
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
	
	
	if ($word!="")
	{
		$sqldop="
		AND
		(vtiger_role.rolename LIKE '%".$word."%' OR vtiger_users.user_name LIKE '%".$word."%' OR vtiger_users.first_name LIKE '%".$word."%' OR vtiger_users.last_name LIKE '%".$word."%' )
		";
	}
	
	$sql = "SELECT * FROM  
	 vtiger_users ,
	 vtiger_role ,
	 vtiger_user2role
	 WHERE 
	 vtiger_role.roleid=vtiger_user2role.roleid AND
	 vtiger_users.id!='".$_SESSION['authenticated_user_id']."' AND
	 vtiger_user2role.userid=vtiger_users.id ".$sqldop." ".$orderby;

	$result = $adb->pquery($sql);

	if($adb->num_rows($result) > 0) {
		for($i = 0; $i < $adb->num_rows($result); $i++) {
		   $row = $adb->raw_query_result_rowdata($result,$i);
		   
		   if ($_REQUEST["selectTUser"]==$row["id"]){ $cl="selectTUser"; }else{$cl="";}
		   if ($masuseron[$row["id"]]==1)
		   {
			   $list.=$list2.'<div class="rowuserVChat '.$cl.' user'.$row["id"].'" onclick="javascript:selectUser(\''.$row["id"].'\',\''.$row["last_name"].' '.$row["first_name"].'\')">['.$row["rolename"].'] '.$row["last_name"].' '.$row["first_name"].'</a><div style="" class="radiusVChat"></div></div>';
	
		   }
		   else
		   {
			   $list.=$list2.'<div class="rowuserVChat '.$cl.' user'.$row["id"].'" onclick="javascript:selectUser(\''.$row["id"].'\',\''.$row["last_name"].' '.$row["first_name"].'\')" >['.$row["rolename"].'] '.$row["last_name"].' '.$row["first_name"].'</div>';
	
		   }
		}
	}
	return $list;
}

if ($_REQUEST["search"]==true)
{
	print seachUser($_REQUEST["word"],$channel);
	exit;
}

?>