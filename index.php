<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
if ($_REQUEST["module"]=="VChat")
{
	session_start();
	if ($_SESSION['authenticated_user_id']!="142")
	{
		//exit;
	}
	
	//exit;
}
// тело скрипта

//Overrides GetRelatedList : used to get related query
//TODO : Eliminate below hacking solution
include_once 'include/Webservices/Relation.php';
include_once 'vtlib/Vtiger/Module.php';
include_once 'includes/main/WebUI.php';

$webUI = new Vtiger_WebUI();
ini_set('display_errors',0);
//error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
$webUI->process(new Vtiger_Request($_REQUEST, $_REQUEST));
