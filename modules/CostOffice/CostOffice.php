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

class CostOffice extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_costoffice';
	var $table_index= 'costofficeid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_costofficecf', 'costofficeid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_costoffice', 'vtiger_costofficecf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_costoffice' => 'costofficeid',
		'vtiger_costofficecf'=>'costofficeid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = array (
		'LBL_COST' => array('costoffice', 'cost'),
		'LBL_OFFICE' => array('costoffice', 'office'),
		'LBL_MONTH' => array('costoffice', 'month'),

);
	var $list_fields_name = array (
		'LBL_COST' => 'cost',
		'LBL_OFFICE' => 'office',
		'LBL_MONTH' => 'month',

);

	// Make the field link to detail view
	var $list_link_field = 'office';

	// For Popup listview and UI type support
	var $search_fields = array (
		'LBL_OFFICE' => array('costoffice', 'office'),
		'LBL_MONTH' => array('costoffice', 'month'),
		'LBL_COST' => array('costoffice', 'cost'),

);
	var $search_fields_name = array (
		'LBL_OFFICE' => 'office',
		'LBL_MONTH' => 'month',
		'LBL_COST' => 'cost',

);

	// For Popup window record selection
	var $popup_fields = array('office');

	// For Alphabetical search
	var $def_basicsearch_col = 'office';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'office';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = array('createdtime', 'modifiedtime', 'office');

	var $default_order_by = 'office';
	var $default_sort_order='ASC';

	function CostOffice() {
		$this->log =LoggerManager::getLogger('CostOffice');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('CostOffice');
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