<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class HRUser_Record_Model extends Vtiger_Record_Model {
    public static function getInstanceById($recordId, $module=null) {
		$module = 'HRUser';
		$module = Vtiger_Module_Model::getInstance($module);
		$moduleName = $module->get('name');
		

		$focus = CRMEntity::getInstance($moduleName);
		$focus->id = $recordId;
                
		$focus->retrieve_entity_info($recordId, $moduleName);
                
		$modelClassName = Vtiger_Loader::getComponentClassName('Model', 'Record', $moduleName);
		$instance = new $modelClassName();
		return $instance->setData($focus->column_fields)->set('id',$recordId)->setModuleFromInstance($module)->setEntity($focus);
	}
    public function getName() {
		$displayName = $this->get('name_hruser');
		
		return Vtiger_Util_Helper::toSafeHTML(decode_html($displayName));
	}
}