<?
$domain='http://proxytest.1gb.ru/';

function curl_tt($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 3);     
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}


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

if ($response)
{
	global $adb;
	$sql = "SELECT * FROM  
	 vtiger_users ,
	 vtiger_role ,
	 vtiger_user2role
	 WHERE 
	 vtiger_role.roleid=vtiger_user2role.roleid AND
	 vtiger_users.id='".$_SESSION['authenticated_user_id']."' AND
	 vtiger_user2role.userid=vtiger_users.id ";

	$result = $adb->pquery($sql);

	if($adb->num_rows($result) > 0) {
		for($i = 0; $i < $adb->num_rows($result); $i++) {
		   $row = $adb->raw_query_result_rowdata($result,$i);
		   $user_name=$row["user_name"];
		}
	}
	
	global $current_user;
	$data=curl_tt($domain."getpassword.php?senduser=".$_SESSION['authenticated_user_id']."&user_name=".$user_name);
	print "Логин:<br><br>".$user_name."<br><br>Пароль:<br><br>".$data;
	exit;
}
		   
				

?>