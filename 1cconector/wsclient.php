<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

require_once('vtwsclib/Vtiger/WSClient.php');

class WSClient extends Vtiger_WSClient {

    /**
     * Update Operation
     *
     * @param $valueMap
     * @return bool
     */
    function doUpdate($valueMap) {
        // Perform re-login if required.
        $this->__checkLogin(); 

        // Assign record to logged in user if not specified
        if(!isset($valueMap['assigned_user_id'])) {
            $valueMap['assigned_user_id'] = $this->_userid;
        }

        $postData = Array(
            'operation'   => 'update',
            'sessionName' => $this->_sessionid,
            'element'     => $this->toJSONString($valueMap)
        );
        $resultData = $this->_client->doPost($postData, true);
       
        if($this->hasError($resultData)) {
            
            return false;
        }
        return $resultData['result'];
    }
    function doUpdateImage($valueMap, $file) {
        // Perform re-login if required.
        $this->__checkLogin(); 

        // Assign record to logged in user if not specified
        if(!isset($valueMap['assigned_user_id'])) {
            $valueMap['assigned_user_id'] = $this->_userid;
        }

        $postData = Array(
            'operation'   => 'update',
            'sessionName' => $this->_sessionid,
            'element'     => $this->toJSONString($valueMap)
        );
        $resultData = $this->_client->doPostImage($postData, $file,true);
        
       
        if($this->hasError($resultData)) {
            
            return false;
        }
        return $resultData['result'];
    }

    /**
     * Delete Operation
     *
     * @param $record
     * @return bool
     */
    function doDelete($record) {
        // Perform re-login if required.
        $this->__checkLogin();

        $postData = Array(
            'operation'   => 'delete',
            'sessionName' => $this->_sessionid,
            'id' => $record
        );
        $resultData = $this->_client->doPost($postData, true);
        if($this->hasError($resultData)) {
            return false;
        }
        return $resultData['result'];
    }

    /**
     * Retrieve details of record
     *
     * @param $module
     * @param $timestamp
     * @return bool
     */
    function doSync($module, $timestamp) {
        // Perform re-login if required.
        $this->__checkLogin();

        $getData = Array(
            'operation' => 'sync',
            'sessionName'  => $this->_sessionid,
            'modifiedTime' => $timestamp,
            'elementType' => $module
        );
        $resultData = $this->_client->doGet($getData, true);
        if($this->hasError($resultData)) {
            return false;
        }
        return $resultData['result'];
    }
}