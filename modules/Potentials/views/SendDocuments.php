<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class Potentials_SendDocuments_View extends Vtiger_IndexAjax_View {
    function __construct() {
		parent::__construct();
		$this->exposeMethod('sendMail');
    }
    function process(Vtiger_Request $request) {
		$mode = $request->get('mode');
		if(!empty($mode)) {
			echo $this->invokeExposedMethod($mode, $request);
			return;
		}
	}
    function sendMail(Vtiger_Request $request) {
		$moduleName = 'Emails';
		$sourceModule = 'Contacts';
		$selectedIds = $request->get('contactID');
		$excludedIds = $request->get('excluded_ids');
		$step = 1;
		$selectedFields = $request->get('selectedFields');
		$relatedLoad = $request->get('relatedLoad');

		$moduleModel = Vtiger_Module_Model::getInstance($sourceModule);
		$emailFields = $moduleModel->getFieldsByType('email');
        $accesibleEmailFields = array();
        $emailColumnNames = array();
        $emailColumnModelMapping = array();

        foreach($emailFields as $index=>$emailField) {
            $fieldName = $emailField->getName();
            if($emailField->isViewable()) {
                $accesibleEmailFields[] = $emailField;
                $emailColumnNames[] = $emailField->get('column');
                $emailColumnModelMapping[$emailField->get('column')] = $emailField;
            }
        }
        $emailFields = $accesibleEmailFields;

        $emailFieldCount = count($emailFields);
        $tableJoined = array();
        if($emailFieldCount > 1) {
            $recordIds = $this->getRecordsListFromRequest($request);

            $moduleMeta = $moduleModel->getModuleMeta();
            $wsModuleMeta = $moduleMeta->getMeta();
            $tabNameIndexList = $wsModuleMeta->getEntityTableIndexList();

            $queryWithFromClause = 'SELECT '. implode(',',$emailColumnNames). ' FROM vtiger_crmentity ';
            foreach($emailFields as $emailFieldModel) {
                $fieldTableName = $emailFieldModel->table;
                if(in_array($fieldTableName, $tableJoined)){
                    continue;
                }

                $tableJoined[] = $fieldTableName;
                $queryWithFromClause .= ' INNER JOIN '.$fieldTableName .
                            ' ON '.$fieldTableName.'.'.$tabNameIndexList[$fieldTableName].'= vtiger_crmentity.crmid';
            }
            $query =  $queryWithFromClause . ' WHERE vtiger_crmentity.deleted = 0 AND crmid IN ('.  generateQuestionMarks($recordIds).') AND (';

            for($i=0; $i<$emailFieldCount;$i++) {
                for($j=($i+1);$j<$emailFieldCount;$j++){
                    $query .= ' (' . $emailFields[$i]->getName() .' != \'\' and '. $emailFields[$j]->getName().' != \'\')';
                    if(!($i == ($emailFieldCount-2) && $j == ($emailFieldCount-1))) {
                        $query .= ' or ';
                    }
                }
            }
            $query .=') LIMIT 1';

            $db = PearDatabase::getInstance();
            $result = $db->pquery($query,$recordIds);

            $num_rows = $db->num_rows($result);

            if($num_rows == 0) {
                $query = $queryWithFromClause . ' WHERE vtiger_crmentity.deleted = 0 AND crmid IN ('.  generateQuestionMarks($recordIds).') AND (';
                foreach($emailColumnNames as $index =>$columnName) {
                    $query .= " $columnName != ''";
                    //add glue or untill unless it is the last email field
                    if($index != ($emailFieldCount -1 ) ){
                        $query .= ' or ';
                    }
                }
                $query .= ') LIMIT 1';
                $result = $db->pquery($query, $recordIds);
                if($db->num_rows($result) > 0) {
                    //Expecting there will atleast one row 
                    $row = $db->query_result_rowdata($result,0);

                    foreach($emailColumnNames as $emailColumnName) {
                        if(!empty($row[$emailColumnName])) {
                            //To send only the single email field since it is only field which has value
                            $emailFields = array($emailColumnModelMapping[$emailColumnName]);
                            break;
                        }
                    }
                }else{
                    //No Record which has email field value
                    foreach($emailColumnNames as $emailColumnName) {
                        //To send only the single email field since it has no email value
                        $emailFields = array($emailColumnModelMapping[$emailColumnName]);
                        break;
                    }
                }
            }
        }

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
        $viewer->assign('SOURCE_MODULE',$sourceModule);
		$viewer->assign('VIEWNAME', $cvId);
		$viewer->assign('SELECTED_IDS', $selectedIds);
		$viewer->assign('EXCLUDED_IDS', $excludedIds);
		$viewer->assign('EMAIL_FIELDS', $emailFields);
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
                $type = $request->get('type');
                $record = $request->get('record');
               
                $documentIds = $this->getAtachmentId($type,$record);
                
        if ($documentIds) {
			$attachements = array();
			foreach ($documentIds as $documentId) {
				$documentRecordModel = Vtiger_Record_Model::getInstanceById($documentId, $sourceModule);
				if ($documentRecordModel->get('filelocationtype') == 'I') {
					$fileDetails = $documentRecordModel->getFileDetails();
					if ($fileDetails) {
						$fileDetails['fileid'] = $fileDetails['attachmentsid'];
						$fileDetails['docid'] = $fileDetails['crmid'];
						$fileDetails['attachment'] = $fileDetails['name'];
						$fileDetails['size'] = filesize($fileDetails['path'] . $fileDetails['attachmentsid'] . "_". $fileDetails['name']);
						$attachements[] = $fileDetails;
					}
				}
			}
			$viewer->assign('ATTACHMENTS', $attachements);
		}
        $searchKey = $request->get('search_key');
        $searchValue = $request->get('search_value');
		$operator = $request->get('operator');
        if(!empty($operator)) {
			$viewer->assign('OPERATOR',$operator);
			$viewer->assign('ALPHABET_VALUE',$searchValue);
            $viewer->assign('SEARCH_KEY',$searchKey);
		}
        
        $searchParams = $request->get('search_params');
        if(!empty($searchParams)) {
            $viewer->assign('SEARCH_PARAMS',$searchParams);
        }

		$to = $request->get('to');
		if (!$to) {
			$to = array();
		}
		$viewer->assign('TO', $to);

		$parentModule = $request->get('sourceModule');
		$parentRecord = $request->get('sourceRecord');
		if (!empty($parentModule)) {
			$viewer->assign('PARENT_MODULE', $parentModule);
			$viewer->assign('PARENT_RECORD', $parentRecord);
			$viewer->assign('RELATED_MODULE', $sourceModule);
		}
		if($relatedLoad){
			$viewer->assign('RELATED_LOAD', true);
		}

		echo $viewer->view('ComposeEmailForm.tpl', $moduleName, true);
		
	}
        
        
        
        public function composeMailData($request){
		$moduleName = 'Emails';
        $fieldModule = $request->get('fieldModule');
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$userRecordModel = Users_Record_Model::getCurrentUserModel();
		$sourceModule = $request->getModule();
		$cvId = $request->get('viewname');
		$selectedIds = $request->get('selected_ids',array());
		$excludedIds = $request->get('excluded_ids',array());
		$selectedFields = $request->get('selectedFields');
		$relatedLoad = $request->get('relatedLoad');
		$documentIds = $request->get('documentIds');

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
        $viewer->assign('FIELD_MODULE',$fieldModule);
		$viewer->assign('VIEWNAME', $cvId);
		$viewer->assign('SELECTED_IDS', $selectedIds);
		$viewer->assign('EXCLUDED_IDS', $excludedIds);
        $viewer->assign('SELECTED_FIELDS',$selectedFields);  
		$viewer->assign('USER_MODEL', $userRecordModel);
		$viewer->assign('MAX_UPLOAD_SIZE', vglobal('upload_maxsize'));
		$viewer->assign('RELATED_MODULES', $moduleModel->getEmailRelatedModules());

		if ($documentIds) {
			$attachements = array();
			foreach ($documentIds as $documentId) {
				$documentRecordModel = Vtiger_Record_Model::getInstanceById($documentId, $sourceModule);
				if ($documentRecordModel->get('filelocationtype') == 'I') {
					$fileDetails = $documentRecordModel->getFileDetails();
					if ($fileDetails) {
						$fileDetails['fileid'] = $fileDetails['attachmentsid'];
						$fileDetails['docid'] = $fileDetails['crmid'];
						$fileDetails['attachment'] = $fileDetails['name'];
						$fileDetails['size'] = filesize($fileDetails['path'] . $fileDetails['attachmentsid'] . "_". $fileDetails['name']);
						$attachements[] = $fileDetails;
					}
				}
			}
			$viewer->assign('ATTACHMENTS', $attachements);
		}
        
        $searchKey = $request->get('search_key');
        $searchValue = $request->get('search_value');
		$operator = $request->get('operator');
        if(!empty($operator)) {
			$viewer->assign('OPERATOR',$operator);
			$viewer->assign('ALPHABET_VALUE',$searchValue);
            $viewer->assign('SEARCH_KEY',$searchKey);
		}
		
        $searchParams = $request->get('search_params');
        if(!empty($searchParams)) {
            $viewer->assign('SEARCH_PARAMS',$searchParams);
        }
		
		$to =array();
		$toMailInfo = array();
		$toMailNamesList = array();
		$selectIds = $this->getRecordsListFromRequest($request);

		$ccMailInfo = $request->get('ccemailinfo');
		if(empty($ccMailInfo)){
			$ccMailInfo = array();
		}

		$bccMailInfo = $request->get('bccemailinfo');
		if(empty($bccMailInfo)){
			$bccMailInfo = array();
		}

		$sourceRecordId = $request->get('record');
		if ($sourceRecordId) {
			$sourceRecordModel = Vtiger_Record_Model::getInstanceById($sourceRecordId);
			if ($sourceRecordModel->get('email_flag') === 'SAVED') {
				$selectIds = explode('|', $sourceRecordModel->get('parent_id'));
			}
		}
		foreach($selectIds as $id) {
			if ($id) {
				$parentIdComponents = explode('@', $id);
				if (count($parentIdComponents) > 1) {
					$id = $parentIdComponents[0];
					if ($parentIdComponents[1] === '-1') {
						$recordModel = Users_Record_Model::getInstanceById($id, 'Users');
					} else {
						$recordModel = Vtiger_Record_Model::getInstanceById($id);
					}
				} else if($fieldModule) {
					$recordModel = Vtiger_Record_Model::getInstanceById($id, $fieldModule);
				} else {
					$recordModel = Vtiger_Record_Model::getInstanceById($id);
				}
				if($selectedFields){
					foreach($selectedFields as $field) {
						$value = $recordModel->get($field);
						$emailOptOutValue = $recordModel->get('emailoptout');
						if(!empty($value) && (!$emailOptOutValue)) {
							$to[] =	$value;
							$toMailInfo[$id][] = $value;
                            //SalesPlatform.ru begin
							$toMailNamesList[$id][] = array('label' => html_entity_decode($recordModel->getName(), ENT_COMPAT|ENT_HTML401, 'UTF-8'), 'value' => $value);
                            //$toMailNamesList[$id][] = array('label' => $recordModel->getName(), 'value' => $value);
                            //SalesPlatform.ru end
						}
					}
				}
			}
		}

		$requestTo = $request->get('to');
		if (!$to && is_array($requestTo)) {
			$to = $requestTo;
		}

		$documentsModel = Vtiger_Module_Model::getInstance('Documents');
		$documentsURL = $documentsModel->getInternalDocumentsURL();

		$emailTemplateModuleModel = Settings_Vtiger_Module_Model::getInstance('Settings:EmailTemplates');
                
		$emailTemplateListURL = $emailTemplateModuleModel->getListViewUrl();
		
		$viewer->assign('DOCUMENTS_URL', $documentsURL);
		$viewer->assign('EMAIL_TEMPLATE_URL', $emailTemplateListURL);
		$viewer->assign('TO', $to);
		$viewer->assign('TOMAIL_INFO', $toMailInfo);
		$viewer->assign('TOMAIL_NAMES_LIST', $toMailNamesList);
		$viewer->assign('CC', $request->get('cc'));
		$viewer->assign('CCMAIL_INFO', $ccMailInfo);
		$viewer->assign('BCC', $request->get('bcc'));
		$viewer->assign('BCCMAIL_INFO', $bccMailInfo);
		
		//EmailTemplate module percission check
		$userPrevilegesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$viewer->assign('MODULE_IS_ACTIVE', $userPrevilegesModel->hasModulePermission(Vtiger_Module_Model::getInstance('EmailTemplates')->getId()));
		//
		
		if($relatedLoad){
			$viewer->assign('RELATED_LOAD', true);
		}
	}

        function getAtachmentId($type,$record){
            global $adb;
            $recordModel = Vtiger_Record_Model::getInstanceById($record);
            $country = $recordModel->get('country');
            $turoperator = $recordModel->get('turoperator');
            $sql = "SELECT cf.notesid as id FROM vtiger_notescf as cf INNER JOIN vtiger_senotesrel as country ON country.notesid = cf.notesid "
                    . "INNER JOIN vtiger_senotesrel as turo ON turo.notesid = cf.notesid WHERE cf.cf_1397 = ? and country.crmid = ? and turo.crmid = ?";
           
            $result = $adb->pquery($sql, array($type,$country,$turoperator));
           
            $numRows = $adb->num_rows($result);
            $docid = array();
            for ($i=0;$i<$numRows;$i++){
                array_push($docid, $adb->query_result($result,$i,'id'));
            }
            return $docid;
        }
}