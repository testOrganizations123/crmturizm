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

class ListAirlines extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_listairlines';
	var $table_index= 'listairlinesid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_listairlinescf', 'listairlinesid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_listairlines', 'vtiger_listairlinescf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_listairlines' => 'listairlinesid',
		'vtiger_listairlinescf'=>'listairlinesid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		'LBL_AIRLINES' => array('listairlines', 'airlines'),
		'LBL_COUNTRY' => array('listairlines', 'country'),
		'LBL_POPULAR' => array('listairlines', 'popular'),

	);
	var $list_fields_name = Array (
		'LBL_AIRLINES' => 'airlines',
		'LBL_COUNTRY' => 'country',
		'LBL_POPULAR' => 'popular',

	);

	// Make the field link to detail view
	var $list_link_field = 'airlines';

	// For Popup listview and UI type support
	var $search_fields = Array(
		'LBL_POPULAR' => array('listairlines', 'popular'),
		'LBL_COUNTRY' => array('listairlines', 'country'),
		'LBL_AIRLINES' => array('listairlines', 'airlines'),

	);
	var $search_fields_name = Array (
		'LBL_POPULAR' => 'popular',
		'LBL_COUNTRY' => 'country',
		'LBL_AIRLINES' => 'airlines',

	);

	// For Popup window record selection
	var $popup_fields = Array ('airlines');

	// For Alphabetical search
	var $def_basicsearch_col = 'airlines';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'airlines';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('airlines','assigned_user_id');

	var $default_order_by = 'airlines';
	var $default_sort_order='ASC';

	function ListAirlines() {
		$this->log =LoggerManager::getLogger('ListAirlines');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('ListAirlines');
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

		$moduleInstance = Vtiger_Module::getInstance('ListCountry');
		$relatedModuleInstance = Vtiger_Module::getInstance('ListAirlines');
		$relationLabel = 'LBL_LISTAIRLINES_LIST';
		$moduleInstance->setRelatedList(
			$relatedModuleInstance, $relationLabel, array('ADD'), 'get_dependents_list'
		);

	}
}