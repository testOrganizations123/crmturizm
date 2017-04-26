<?php
/***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class ClientTypes extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_type_room';
	var $table_index= 'type_roomid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array();

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_type_room');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_type_room' => 'type_roomid',
		);

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = array (
		'LBL_CLIENT_TYPES' => array('type_room', 'type_room'),
		

);
	var $list_fields_name = array (
		'LBL_CLIENT_TYPES' => 'type_room',
		

);

	// Make the field link to detail view
	var $list_link_field = 'type_room';

	// For Popup listview and UI type support
	var $search_fields = array (
		
		'LBL_CLIENT_TYPES' => array('type_room', 'type_room'),

);
	var $search_fields_name = array (
		
		'LBL_CLIENT_TYPES' => 'type_room',

);

	// For Popup window record selection
	var $popup_fields = array('type_room');

	// For Alphabetical search
	var $def_basicsearch_col = 'type_room';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'type_room';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = array('createdtime', 'modifiedtime', 'type_room');

	var $default_order_by = 'type_room';
	var $default_sort_order='ASC';

	function ClientTypes() {
		$this->log =LoggerManager::getLogger('ClientTypes');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('ClientTypes');
	}

	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/
	function vtlib_handler($moduleName, $eventType) {
 		if($eventType == 'module.postinstall') {
 			//Enable ModTracker for the module
 			static::enableModTracker($moduleName);
			//Create Related Lists
			static::createRelatedLists();
		} else if($eventType == 'module.disabled') {
			// Handle actions before this module is being uninstalled.
		} else if($eventType == 'module.preuninstall') {
			// Handle actions when this module is about to be deleted.
		} else if($eventType == 'module.preupdate') {
			// Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
			//Create Related Lists
			static::createRelatedLists();
		}
 	}
	
	/**
	 * Enable ModTracker for the module
	 */
	public static function enableModTracker($moduleName)
	{
		include_once 'vtlib/Vtiger/Module.php';
		include_once 'modules/ModTracker/ModTracker.php';
			
		//Enable ModTracker for the module
		$moduleInstance = Vtiger_Module::getInstance($moduleName);
		ModTracker::enableTrackingForModule($moduleInstance->getId());
	}
	
	protected static function createRelatedLists()
	{
		include_once('vtlib/Vtiger/Module.php');	

	}
}