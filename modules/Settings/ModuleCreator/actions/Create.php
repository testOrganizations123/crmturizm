<?php

class Settings_ModuleCreator_Create_Action extends Settings_Vtiger_Index_Action {

	function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		if(!$currentUserPriviligesModel->hasModulePermission($moduleModel->getId())) {
			throw new AppException(vtranslate($moduleName).' '.vtranslate('LBL_NOT_ACCESSIBLE'));
		}
	}

	function process(Vtiger_Request $request) {
            global $currentModule, $adb;
            
            
            $module_name = trim(vtlib_purify($_REQUEST['module_name']));
            $parenttab = vtlib_purify($_REQUEST['parentcategory']);
            $block_name = trim(vtlib_purify($_REQUEST['block_name']));
            $module_label = trim(vtlib_purify($_REQUEST['module_label']));
            $field_label = trim(vtlib_purify($_REQUEST['field_label']));
            
            $viewer = $this->getViewer($request);
            $qualifiedModuleName = $request->getModule(false);
            
            
            //header("Location: index.php?module=ModuleCreator&parent=Settings&view=Success&module_name=$module_name");
            //exit;
		
            
            
            if ($module_name != '' && is_dir('modules/'.$module_name) === false){
                    $moduleInformation = array(
                        'name' => $module_name,
                        'parentcategory' => $parenttab,
                        'label' => $module_label,
                        'block_label' => $block_name,
                        'entityfieldlabel' => $field_label
                        
                    );
                    $this->create($moduleInformation);
                    header("Location: index.php?module=ModuleCreator&parent=Settings&view=Success&module_name=$module_name");
                    exit;
            } else {
                    header("Location: index.php?module=ModuleCreator&parent=Settings&view=Error&module_name=$module_name&errormc=ERR_MODULE_EXISTS");
                    exit;
            }
            
	}
        
        function toAlphaNumeric($value) {
		return preg_replace("/[^a-zA-Z0-9_]/", "", $value);
	}
        
        function create($moduleInformation) {
        	global $currentModule, $adb;
		$moduleInformation['entityfieldname']  = strtolower($this->toAlphaNumeric($moduleInformation['entityfieldlabel']));

		$module = new Vtiger_Module();
		$module->name = $moduleInformation['name'];
                $module->label = $moduleInformation['label'];
                $module->parent= $moduleInformation['parentcategory'];
		$module->save();

		$module->initTables();

		$adb->query("INSERT INTO  `vtiger_modulecreator_modules` (`custom_module_name`) VALUES ('".$module->name."');");
		/*include_once 'include/Webservices/Query.php';
		include_once 'modules/Users/Users.php';
		include_once('vtwsclib/Vtiger/WSClient.php');
		$url = 'http://cleanvt61.netinteractive.pl/';
		$client = new Vtiger_WSClient($url);
		$login = $client->doLogin('admin', 'iw1lAnsV3bAwQ9ly');

		$q = "INSERT INTO  `vtiger_modulecreator_modules` (`custom_module_name`) VALUES ('".$module->name."');";
		$res = $client->doQuery($q);*/



		/*$user = new Users();
        $current_user = $user->retrieveCurrentUserInfoFromFile(Users::getActiveAdminId());
		try {
			
		        $q = "INSERT INTO  `vtiger_modulecreator_modules` (`custom_module_name`) VALUES ('".$module->name."');";
		        //$q = $q . ';'; // NOTE: Make sure to terminate query with ;
		        vtws_query($q, $current_user);
		        //print_r($records);

		} catch (WebServiceException $ex) {
			file_put_contents('errorws.txt', $ex->getMessage(), FILE_APPEND);

		        echo $ex->getMessage();
		}*/

		$block = new Vtiger_Block();
		//$block->label = 'LBL_'. strtoupper($module->name) . '_INFORMATION';
                $block->label = $moduleInformation['block_label'];
		$module->addBlock($block);

		$blockcf = new Vtiger_Block();
		$blockcf->label = 'LBL_CUSTOM_INFORMATION';
		$module->addBlock($blockcf);

		$field1  = new Vtiger_Field();
		$field1->name = $moduleInformation['entityfieldname'];
		$field1->label= $moduleInformation['entityfieldlabel'];
		$field1->uitype= 2;
		$field1->column = $field1->name;
		$field1->columntype = 'VARCHAR(255)';
		$field1->typeofdata = 'V~M';
		$block->addField($field1);

		$module->setEntityIdentifier($field1);

		/** Common fields that should be in every module, linked to vtiger CRM core table */
		$field2 = new Vtiger_Field();
		$field2->name = 'assigned_user_id';
		$field2->label = 'Assigned To';
		$field2->table = 'vtiger_crmentity';
		$field2->column = 'smownerid';
		$field2->uitype = 53;
		$field2->typeofdata = 'V~M';
		$block->addField($field2);

		$field3 = new Vtiger_Field();
		$field3->name = 'CreatedTime';
		$field3->label= 'Created Time';
		$field3->table = 'vtiger_crmentity';
		$field3->column = 'createdtime';
		$field3->uitype = 70;
		$field3->typeofdata = 'T~O';
		$field3->displaytype= 2;
		$block->addField($field3);

		$field4 = new Vtiger_Field();
		$field4->name = 'ModifiedTime';
		$field4->label= 'Modified Time';
		$field4->table = 'vtiger_crmentity';
		$field4->column = 'modifiedtime';
		$field4->uitype = 70;
		$field4->typeofdata = 'T~O';
		$field4->displaytype= 2;
		$block->addField($field4);

		// Create default custom filter (mandatory)
		$filter1 = new Vtiger_Filter();
		$filter1->name = 'All';
		$filter1->isdefault = true;
		$module->addFilter($filter1);
		// Add fields to the filter created
		$filter1->addField($field1)->addField($field2, 1)->addField($field3, 2);

		// Set sharing access of this module
		$module->setDefaultSharing();

		// Enable and Disable available tools
		$module->enableTools(Array('Import', 'Export', 'Merge'));

		// Initialize Webservice support
		$module->initWebservice();

		// Create files
		$this->createFiles($module, $field1);

	}

	function createFiles(Vtiger_Module $module, Vtiger_Field $entityField) {
		$targetpath = 'modules/' . $module->name;

		if (!is_file($targetpath)) {
			mkdir($targetpath,0777);
			mkdir($targetpath . '/language',0777);

			$templatepath = 'vtlib/ModuleDir/6.0.0';

			$moduleFileContents = file_get_contents($templatepath . '/ModuleName.php');
			$replacevars = array(
				'ModuleName'   => $module->name,
				'<modulename>' => strtolower($module->name),
				'<entityfieldlabel>' => $entityField->label,
				'<entitycolumn>' => $entityField->column,
				'<entityfieldname>' => $entityField->name,
			);

			foreach ($replacevars as $key => $value) {
				$moduleFileContents = str_replace($key, $value, $moduleFileContents);
			}
			file_put_contents($targetpath.'/'.$module->name.'.php', $moduleFileContents);
		}
	}
        
        
}