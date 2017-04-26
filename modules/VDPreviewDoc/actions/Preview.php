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
class VDPreviewDoc_Preview_Action extends Vtiger_Action_Controller {
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
                
                $file_type = $request->get('type');
                
                $request->set('fileid',$this->document['attachmentsid']);
                $function = 'preview'.$file_type;
                $this->$function($request);
                
	}
        public function previewIMG(Vtiger_Request $request){
                $record = $request->get('record');
                $moduleName = $request->getModule();
                $fileid = $request->get('fileid');
                $fileName = $this->document['file_info']['name'];
                $viewer = new Vtiger_Viewer();
                $viewer->assign('LINK', $this->downloadLink($request));
                $viewer->assign('DOCUMENT', $this->document);
                $viewer->view('PreviewIMG.tpl', $moduleName);
                
                
          
        }
         public function previewPDF(Vtiger_Request $request){
                $record = $request->get('record');
                $moduleName = $request->getModule();
                $fileid = $request->get('fileid');
                $fileName = $this->document['file_info']['name'];
                $viewer = new Vtiger_Viewer();
                
                $viewer->assign('DOWNLOAD', $this->downloadLink($request));
                $viewer->assign('SRC', $this->previewPDFlink($request));
                $viewer->assign('DOCUMENT', $this->document);
                
                $viewer->view('PreviewPDF.tpl', $moduleName);
                
                
          
        }
         public function previewTXT(Vtiger_Request $request){
                global $site_URL;
                $record = $request->get('record');
                $moduleName = $request->getModule();
                $fileid = $request->get('fileid');
                $link = $this->downloadLink($request);
                $data = file_get_contents($site_URL.$link);
                
                $viewer = new Vtiger_Viewer();
                $viewer->assign('LINK', $link);
                $viewer->assign('SRC', $this->previewTXTlink($request));
                $viewer->assign('DOCUMENT', $this->document);
                $viewer->view('PreviewTXT.tpl', $moduleName);
         }
         
         public function previewMS(Vtiger_Request $request){
                $record = $request->get('record');
                $fileid = $request->get('fileid');
                $moduleName = $request->getModule();
                $data = "index.php?module=VDPreviewDoc&action=PreviewMS&record=".$record."&fileid=".$fileid; 
                $response = new Vtiger_Response();
                $response->setResult($data);
                $response->emit();
               
         }
         
        public function previewTXTlink(Vtiger_Request $request){
                $record = $request->get('record');
               $fileid = $request->get('fileid');
               $link = "index.php?module=VDPreviewDoc&action=PreviewTXT&record=".$record."&fileid=".$fileid;
                return $link;
        }
        public function previewPDFlink(Vtiger_Request $request){
               $record = $request->get('record');
               $fileid = $request->get('fileid');
               $link = "index.php?module=VDPreviewDoc&action=PreviewPDF&record=".$record."&fileid=".$fileid;
                return $link;
        }

        public function downloadLink(Vtiger_Request $request){
                $record = $request->get('record');
                $fileid = $request->get('fileid');
                $link = "index.php?module=Documents&action=DownloadFile&record=".$record."&fileid=".$fileid;
                return $link;
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
                'text/javascript' => 'TXT',
                'text/xml' => 'TXT',
                'application/csv' => 'TXT',
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
            );
            if(isset($mimeType[$mime])){
                return $mimeType[$mime];
            }
            elseif ($mime == 'application/octet-stream') {
                $parser = explode('.', $filename);
                $extend = $parser[count($parser)-1];
                if(isset($file_extendet[$extend])){
                    return $file_extendet[$extend];
                }
            }
                return 'Download';
            
        }
}