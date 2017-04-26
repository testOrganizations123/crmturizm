<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class VDPreviewDoc_PreviewMS_Action extends Vtiger_Action_Controller {
     public function checkPermission(Vtiger_Request $request) {
               
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$userPrivilegesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$permission = $userPrivilegesModel->hasModulePermission($moduleModel->getId());

		if(!$permission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
                $moduleName = 'Documents';
                $moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$userPrivilegesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$permission = $userPrivilegesModel->hasModulePermission($moduleModel->getId());

		if(!$permission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
                
	}
        private function encode($link){
            global $site_URL, $application_unique_key;
            $baseCode = base64_encode($link);
            $sign = md5($application_unique_key.md5($application_unique_key.$baseCode.$application_unique_key));
            $hash = base64_encode("data|=|$baseCode&sign|=|$sign");
            $url = $site_URL."modules/VDPreviewDoc/actions/ConnectorMS.php?q=$hash";
            
            return $url;
        }
      public function process(Vtiger_Request $request) {
                global $current_user;
                $record = $request->get('record');
                $fileid = $request->get('fileid');
                $link = "record=$record&fileid=$fileid&user=".$current_user->id."&t=".time();
                $url = "https://view.officeapps.live.com/op/view.aspx?src=".$this->encode($link);
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_URL, $url);
                $data = curl_exec($ch);
                curl_close($ch);
                print $data;
                exit();
      }
}