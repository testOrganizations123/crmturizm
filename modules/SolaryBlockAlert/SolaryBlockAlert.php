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

class SolaryBlockAlert extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_solaryblockalert';
	var $table_index= 'solaryblockalertid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_solaryblockalertcf', 'solaryblockalertid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_solaryblockalert', 'vtiger_solaryblockalertcf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_solaryblockalert' => 'solaryblockalertid',
		'vtiger_solaryblockalertcf'=>'solaryblockalertid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = array (
		'LBL_SOLARYBLOCKALERT' => array('solaryblockalert', 'solaryblockalert'),
		'LBL_TYPE_APPLICATION' => array('solaryblockalert', 'type_application'),
		'LBL_TYPE_BLOCK_AMOUNT' => array('solaryblockalert', 'type_block_amount'),
		'LBL_TYPE_BLOCK_SOLARY' => array('solaryblockalert', 'type_block_solary'),
		'LBL_AMOUNT' => array('solaryblockalert', 'amount'),
		'LBL_MAXPOINT' => array('solaryblockalert', 'maxpoint'),

);
	var $list_fields_name = array (
		'LBL_SOLARYBLOCKALERT' => 'solaryblockalert',
		'LBL_TYPE_APPLICATION' => 'type_application',
		'LBL_TYPE_BLOCK_AMOUNT' => 'type_block_amount',
		'LBL_TYPE_BLOCK_SOLARY' => 'type_block_solary',
		'LBL_AMOUNT' => 'amount',
		'LBL_MAXPOINT' => 'maxpoint',

);

	// Make the field link to detail view
	var $list_link_field = 'solaryblockalert';

	// For Popup listview and UI type support
	var $search_fields = array (
		'LBL_DESCRIPTION' => array('solaryblockalert', 'description'),
		'LBL_TYPE_BLOCK_SOLARY' => array('solaryblockalert', 'type_block_solary'),
		'LBL_MAXPOINT' => array('solaryblockalert', 'maxpoint'),
		'LBL_AMOUNT' => array('solaryblockalert', 'amount'),
		'LBL_SOLARYBLOCKALERT' => array('solaryblockalert', 'solaryblockalert'),

);
	var $search_fields_name = array (
		'LBL_DESCRIPTION' => 'description',
		'LBL_TYPE_BLOCK_SOLARY' => 'type_block_solary',
		'LBL_MAXPOINT' => 'maxpoint',
		'LBL_AMOUNT' => 'amount',
		'LBL_SOLARYBLOCKALERT' => 'solaryblockalert',

);

	// For Popup window record selection
	var $popup_fields = array('solaryblockalert');

	// For Alphabetical search
	var $def_basicsearch_col = 'solaryblockalert';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'solaryblockalert';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = array('createdtime', 'modifiedtime', 'solaryblockalert');

	var $default_order_by = 'solaryblockalert';
	var $default_sort_order='ASC';

	function SolaryBlockAlert() {
		$this->log =LoggerManager::getLogger('SolaryBlockAlert');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('SolaryBlockAlert');
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