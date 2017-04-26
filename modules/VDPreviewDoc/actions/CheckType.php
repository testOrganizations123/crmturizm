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
require_once 'modules/VDPreviewDoc/actions/Setting.php';
class VDPreviewDoc_CheckType_Action extends Vtiger_Action_Controller {
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
		global $current_user, $adb;
                  
                 $record = $request->get('record');
                 try {
                        $wsid = vtws_getWebserviceEntityId('Documents', $record); // Module_Webservice_ID x CRM_ID
                        $this->document = vtws_retrieve($wsid, $current_user);
                       

                } catch (WebServiceException $ex) {
                        echo $ex->getMessage();
                }
                $fileid = $request->get('fileid');
               
                $result = $adb->pquery("SELECT * FROM vtiger_attachments
							INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
							WHERE crmid = ?", array($record));
                $this->document['file_info'] = $adb->query_result_rowdata($result);
                
                $this->typeMime($this->document['filetype'],$this->document['file_info']['name']);
                
                
	}
       
        public function typeMime($mime, $filename){
            
            $mimeType = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'MS',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'  => 'MS',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'MS',
                'application/vnd.openxmlformats-officedocument.spre' => 'MS',
                'application/vnd.openxmlformats-officedocument.pres' => 'MS',
                'application/vnd.openxmlformats-officedocument.word' => 'MS',
                'application/vnd.ms-excel' => 'MS',
                'application/vnd.oasis.opendocument.text' => 'MS',
                'application/vnd.oasis.opendocument.spreadsheet' => 'MS',
                'application/vnd.oasis.opendocument.presentation' => 'MS',
                'application/vnd.ms-powerpoint' => 'MS',
                'application/msword' => 'MS',
                'application/pdf' => 'PDF',
				'applications/vnd.pdf' => 'PDF',
                'text/pdf'=> 'PDF',
                'text/x-pdf'=> 'PDF',
                'application/acrobat'=>'PDF',
                'application/x-pdf' => 'PDF',
                'image/png' => 'IMG',
                'image/jpeg' => 'IMG',
                'image/pjpeg' => 'IMG',
                'image/tiff' => 'IMG',
                'image/vnd.microsoft.icon' => 'IMG',
                'image/vnd.wap.wbmp' => 'IMG',
                'image/gif' => 'IMG',
                'image/bmp' => 'IMG',
                'image/tiff' => 'IMG',
                'text/plain' => 'TXT',
                'text/cmd' => 'TXT',
                'text/css' => 'TXT',
                'text/html' => 'TXT',
                'text/csv' => 'TXT',
                'text/javascript' => 'TXT',
                'text/xml' => 'TXT',
                'application/csv' => 'TXT',
				'application/txt' => 'TXT',
                );
            $file_extendet = array(
                'pdf' => 'PDF',
                'PDF' => 'PDF',
                'xls' => 'MS',
                'xlsx' => 'MS',
                'doc' => 'MS',
                'docx' => 'MS',
                'txt' => 'TXT',
                'csv' => 'TXT',
                'ppt' => 'MS',
                'pptx' => 'MS',
				'jpg' => 'IMG',
				'bmp' => 'IMG',
				'gif' => 'IMG',
				'png' => 'IMG',
				'jpeg' => 'IMG',
				'JPG' => 'IMG',
            );
            $response = new Vtiger_Response();
            $data = new stdClass();
            if(isset($mimeType[$mime])){
                if ($mimeType[$mime] == 'MS'){
                    $settings = new VDPreviewDoc_Setting();
                    $data->show = $settings->setting;
                }
                $data->type = $mimeType[$mime];
                $response->setResult($data);
            }
            else {
                $parser = explode('.', $filename);
                $extend = $parser[count($parser)-1];
                if(isset($file_extendet[$extend])){
                    if ($file_extendet[$extend] == 'MS'){
                        $settings = new VDPreviewDoc_Setting();
                        $data->show = $settings->setting;
                    }
                     $data->type = $file_extendet[$extend];
                     $response->setResult($data);
                }
                else {
                    $response->setError('file type is not supported');
                }
            }
           
            $response->emit();
            
        }
}