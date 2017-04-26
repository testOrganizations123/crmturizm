<?
require_once 'modules/VChat/actions/Commander.php';
global $adb;

$domain='http://proxytest.1gb.ru/';
$domainscript='http://proxytest.1gb.ru/getmessage.php';

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
	  exit;
}

$curlInit = curl_init($domain);
curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
curl_setopt($curlInit,CURLOPT_HEADER,true);
curl_setopt($curlInit,CURLOPT_NOBODY,true);
curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

$response = curl_exec($curlInit);

if ($response)
{
	global $adb;
	$xml_dom=curl_tt($domainscript);
	$xml = simplexml_load_string($xml_dom); 
	$t=$xml->channel->item;//->title;
	foreach ($t as $p)
	{

		$sql02 = "insert into vtiger_vchat_text (message, datecreate, userfrom, userto,channelid,vchattexttoid,mainchannel) values(?,?,?,?,?,?,?)";
		$params02 = array($p->message, date("Y-m-d H:i:s"), $p->userfrom, $p->userto,$p->channel,0,0); //
		$result = $adb->pquery($sql02, $params02);
		
		$param = new VChat_Commander_Action();
		$param->updateDialog($p->channel,$p->userto,$p->message,false,$p->userfrom);
	} 
}
exit;

?>