<?php
/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Potentials_ChangeCurency_Action extends Potentials_Save_Action
{

    public function process(Vtiger_Request $request)
    {
        global $adb;
           $recordId = $request->get('record');
           $curent = $request->get('currenc');
           $exchange = $request->get('exchange');

           $recordModel = Vtiger_Record_Model::getInstanceById($recordId);

           $ammount_cur = number_format(($recordModel->get('amount')/$exchange),2,".","");
           $sql = "UPDATE vtiger_potentialscf SET cf_1125 = ?, cf_1127 = ?, cf_1129 = ?, cf_1272 = ? WHERE potentialid = ?";


           $response = new Vtiger_Response();
           $response->setResult($adb->pquery($sql, array($curent,$exchange,$exchange,$ammount_cur,$recordId)));
           $response->emit();
           exit();
    }
}