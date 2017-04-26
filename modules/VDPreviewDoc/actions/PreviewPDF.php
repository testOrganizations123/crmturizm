<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
include_once 'include/Webservices/Retrieve.php';
class VDPreviewDoc_PreviewPDF_Action extends Vtiger_Action_Controller {
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
      public function process(Vtiger_Request $request) {
                global $current_user;
		$record = $request->get('record');
               try {
                        $wsid = vtws_getWebserviceEntityId('Documents', $record); // Module_Webservice_ID x CRM_ID
                        $this->document = vtws_retrieve($wsid, $current_user);
                       

                } catch (WebServiceException $ex) {
                        echo $ex->getMessage();
                }
                $fileDetails = $this->getFileDetails($record);
		$fileContent = false;
               
		if (!empty ($fileDetails)) {
			$filePath = $fileDetails['path'];
			$fileName = $fileDetails['name'];

			if ($this->document['filelocationtype'] == 'I') {
				$fileName = html_entity_decode($fileName, ENT_QUOTES, vglobal('default_charset'));
				$savedFile = $fileDetails['attachmentsid']."_".$fileName;

				$fileSize = filesize($filePath.$savedFile);
				$fileSize = $fileSize + ($fileSize % 1024);

				if (fopen($filePath.$savedFile, "r")) {
					$fileContent = fread(fopen($filePath.$savedFile, "r"), $fileSize);

					header("Content-type: application/pdf");
                                        header("Accept-Ranges: bytes");
                                        header("Content-Leght: ".$fileSize);
				}
			}
		}
		print $fileContent;
                
                
	}
        function getFileDetails($record) {
		$db = PearDatabase::getInstance();
		$fileDetails = array();

		$result = $db->pquery("SELECT * FROM vtiger_attachments
							INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
							WHERE crmid = ?", array($record));

		if($db->num_rows($result)) {
			$fileDetails = $db->query_result_rowdata($result);
		}
		return $fileDetails;
	}
}