<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
 
   if(extension_loaded('sockets')) echo "WebSockets OK";
  else echo "WebSockets UNAVAILABLE";
  
ini_set('display_errors',1);
error_reporting(E_ALL);
$a = 'ПРИВЕТ';

echo $a;