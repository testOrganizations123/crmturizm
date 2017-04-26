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

class Fosa extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_fosa';
	var $table_index= 'fosaid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_fosacf', 'fosaid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_fosa', 'vtiger_fosacf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_fosa' => 'fosaid',
		'vtiger_fosacf'=>'fosaid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		'LBL_SERIA' => array('fosa', 'seria'),
		'LBL_CONTACT_ID' => array('fosa', 'contact_id'),
		'LBL_NUMBER' => array('fosa', 'number'),
		'LBL_OFFICE' => array('fosa', 'office'),
		'LBL_STATATUS_FOSA' => array('fosa', 'statatus_fosa'),
		'LBL_DATA_PAYMENT' => array('fosa', 'data_payment'),
		'LBL_RELATED_TO' => array('fosa', 'related_to'),
		'LBL_AMOUNT' => array('fosa', 'amount'),

	);
	var $list_fields_name = Array (
		'LBL_SERIA' => 'seria',
		'LBL_CONTACT_ID' => 'contact_id',
		'LBL_NUMBER' => 'number',
		'LBL_OFFICE' => 'office',
		'LBL_STATATUS_FOSA' => 'statatus_fosa',
		'LBL_DATA_PAYMENT' => 'data_payment',
		'LBL_RELATED_TO' => 'related_to',
		'LBL_AMOUNT' => 'amount',

	);

	// Make the field link to detail view
	var $list_link_field = 'number';

	// For Popup listview and UI type support
	var $search_fields = Array(
		'LBL_AMOUNT' => array('fosa', 'amount'),
		'LBL_OFFICE' => array('fosa', 'office'),
		'LBL_STATATUS_FOSA' => array('fosa', 'statatus_fosa'),
		'LBL_DATA_PAYMENT' => array('fosa', 'data_payment'),
		'LBL_RELATED_TO' => array('fosa', 'related_to'),
		'LBL_SERIA' => array('fosa', 'seria'),
		'LBL_CONTACT_ID' => array('fosa', 'contact_id'),
		'LBL_NUMBER' => array('fosa', 'number'),

	);
	var $search_fields_name = Array (
		'LBL_AMOUNT' => 'amount',
		'LBL_OFFICE' => 'office',
		'LBL_STATATUS_FOSA' => 'statatus_fosa',
		'LBL_DATA_PAYMENT' => 'data_payment',
		'LBL_RELATED_TO' => 'related_to',
		'LBL_SERIA' => 'seria',
		'LBL_CONTACT_ID' => 'contact_id',
		'LBL_NUMBER' => 'number',

	);

	// For Popup window record selection
	var $popup_fields = Array ('number');

	// For Alphabetical search
	var $def_basicsearch_col = 'number';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'number';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('number','assigned_user_id');

	var $default_order_by = 'number';
	var $default_sort_order='ASC';

	function Fosa() {
		$this->log =LoggerManager::getLogger('Fosa');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('Fosa');
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

		$moduleInstance = Vtiger_Module::getInstance('Contacts');
		$relatedModuleInstance = Vtiger_Module::getInstance('Fosa');
		$relationLabel = 'LBL_FOSA_LIST';
		$moduleInstance->setRelatedList(
			$relatedModuleInstance, $relationLabel, array('ADD'), 'get_dependents_list'
		);

		$moduleInstance = Vtiger_Module::getInstance('Office');
		$relatedModuleInstance = Vtiger_Module::getInstance('Fosa');
		$relationLabel = 'LBL_FOSA_LIST';
		$moduleInstance->setRelatedList(
			$relatedModuleInstance, $relationLabel, array('ADD'), 'get_dependents_list'
		);

		$moduleInstance = Vtiger_Module::getInstance('Potentials');
		$relatedModuleInstance = Vtiger_Module::getInstance('Fosa');
		$relationLabel = 'LBL_FOSA_LIST';
		$moduleInstance->setRelatedList(
			$relatedModuleInstance, $relationLabel, array('ADD'), 'get_dependents_list'
		);

	}
}