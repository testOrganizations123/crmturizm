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

class ListFoods extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_food';
	var $table_index= 'foodid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array();

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_food');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_food' => 'foodid',
		);

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		'LBL_FOOD_TYPE' => array('food', 'food'),
		

	);
	var $list_fields_name = Array (
		'LBL_FOOD_TYPE' => 'food',
		'LBL_CODE' => 'code',

	);

	// Make the field link to detail view
	var $list_link_field = 'food';

	// For Popup listview and UI type support
	var $search_fields = Array(
		
		'LBL_FOOD_TYPE' => array('food', 'food'),

	);
	var $search_fields_name = Array (
		
		'LBL_FOOD_TYPE' => 'food',

	);

	// For Popup window record selection
	var $popup_fields = Array ('food');

	// For Alphabetical search
	var $def_basicsearch_col = 'food';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'food';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('food','assigned_user_id');

	var $default_order_by = 'food';
	var $default_sort_order='ASC';

	function ListFoods() {
		$this->log =LoggerManager::getLogger('ListFoods');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('ListFoods');
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