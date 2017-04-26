<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

ini_set ('display_errors', 0);

chdir('../../../');
include_once('config.inc.php');
include_once('include/Webservices/Relation.php');
include_once('vtlib/Vtiger/Module.php');
include_once('includes/main/WebUI.php');

$Connector = new VDPreviewDoc_ConectorMS();
$Connector->application_unique_key = $application_unique_key;
$Connector->getContent();


class VDPreviewDoc_ConectorMS {
      private $data = false;
      private $sign = false;
      public $user = false;
      public $record = false;
      public $fileid = false;
      public $t = false;
      public $document;
      public $application_unique_key;
              
      function __construct() {
          $parser = explode('&',base64_decode($_REQUEST['q']));
          foreach ($parser as $q ){
                            $q = explode('|=|',$q);
                            $field = $q[0];
                            $this->$field = $q[1];
                     }
          
      }
        function getContent() {
            
               if ($this->checkPermission()){
                     $parser = explode('&', $this->data);
                     foreach ($parser as $q ){
                            $q = explode('=',$q);
                            $field = $q[0];
                            $this->$field = $q[1];
                     }
                    
                     if ((time() - $this->t) < 10 && $this->checkUsers()){
                         $this->process();
                     }

                }
                else {
                    die ('access denied');
                }
        }
        public function checkPermission(){
            global $application_unique_key;
            $sign = md5($application_unique_key.md5($application_unique_key.$this->data.$application_unique_key));
            
            if ($sign == $this->sign){
                $this->data = base64_decode($this->data);
                return true;
            }
            return false;
        }
      public function process() {
                global $current_user;
                include_once 'include/Webservices/Retrieve.php';
                
                
               try {
                        $wsid = vtws_getWebserviceEntityId('Documents', $this->record); // Module_Webservice_ID x CRM_ID
                        $this->document = vtws_retrieve($wsid, $current_user);
                       

                } catch (WebServiceException $ex) {
                        echo $ex->getMessage();
                }
                //print_r ($this);die;
                $fileDetails = $this->getFileDetails($this->record);
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
                                        if ($fileDetails['type'] == 'application/octet-stream'){
                                            $fileType = $this->getMimeType($fileName);
                                        }
                                        else {
                                            $fileType = $fileDetails['type'];
                                        }
                                        header("Content-type: ".$fileType);
                                        
                                        header("Content-Leght: ".$fileSize);
					header("Pragma: public");
					
					header("Content-Disposition: attachment; filename=$fileName");
					header("Content-Description: PHP Generated Data");
				}
			}
		}
		print $fileContent;
                
                
	}
         public function checkUsers() {
             global $current_user;
                $webUI = new Vtiger_WebUI();
                $user = CRMEntity::getInstance('Users');
                $user->retrieveCurrentUserInfoFromFile($this->user);
                $webUI->setLogin($user);
                $current_user = $user;
                
                return $webUI->hasLogin();
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
        function getMimeType($fileName){
            $file_extendet = array(
                'xls' => 'application/vnd.ms-excel',
                'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'doc' =>  'application/msword',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'ppt' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'pptx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            );
                $parser = explode('.', $filename);
                $extend = $parser[count($parser)-1];
                if(isset($file_extendet[$extend])){
                    return $file_extendet[$extend];
                }
                return 'application/octet-stream';
        }
}