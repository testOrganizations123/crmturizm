<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

require_once SYNC_DIR.'processor.php';
echo "<p>Start VtigerSync</p>";

//if(PHP_SAPI === "cli"){
    $processor = new Processor();

    foreach ($processor->module as $moduleName => $value){
   
        if (date($processor->config->dateSqlFormat,$processor->jobStart) > $processor->jobTime['next_'.strtolower($moduleName)]){
            $processor->module[$moduleName] = true;
            $processor->nextTime('actual_'.strtolower($moduleName), date($processor->config->dateSqlFormat,$processor->jobStart));
        }
}
echo "<p>Run Sync </p>";
$processor->doSync();
//}
//$processor->checkSyncOrder();
echo "<p>End Sync </p>";
