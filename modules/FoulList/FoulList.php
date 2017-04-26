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

class FoulList extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_foullist';
	var $table_index= 'foullistid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_foullistcf', 'foullistid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_foullist', 'vtiger_foullistcf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_foullist' => 'foullistid',
		'vtiger_foullistcf'=>'foullistid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		'LBL_USERID' => array('foullist', 'users'),
		'LBL_FOUL' => array('foullist', 'foul'),
		'LBL_FOULLIST' => array('foullist', 'foullist'),
		'LBL_BLOCK' => array('foullist', 'block'),
		'LBL_POINT' => array('foullist', 'point'),
		'LBL_TARGET' => array('foullist', 'target'),
		'LBL_DATA_CHECK' => array('foullist', 'data_check'),
		'LBL_CHECK' => array('foullist', 'check'),
		'LBL_DATE_FOUL' => array('foullist', 'date_foul'),
		'LBL_NOTIF' => array('foullist', 'notif'),

	);
	var $list_fields_name = Array (
		'LBL_USERID' => 'users',
		'LBL_FOUL' => 'foul',
		'LBL_FOULLIST' => 'foullist',
		'LBL_BLOCK' => 'block',
		'LBL_POINT' => 'point',
		'LBL_TARGET' => 'target',
		'LBL_DATA_CHECK' => 'data_check',
		'LBL_CHECK' => 'check',
		'LBL_DATE_FOUL' => 'date_foul',
		'LBL_NOTIF' => 'notif',

	);

	// Make the field link to detail view
	var $list_link_field = 'foul';

	// For Popup listview and UI type support
	var $search_fields = Array(
		'LBL_NOTIF' => array('foullist', 'notif'),
		'LBL_DATA_CHECK' => array('foullist', 'data_check'),
		'LBL_TARGET' => array('foullist', 'target'),
		'LBL_DATE_FOUL' => array('foullist', 'date_foul'),
		'LBL_POINT' => array('foullist', 'point'),
		'LBL_FOUL' => array('foullist', 'foul'),
		'LBL_USERID' => array('foullist', 'users'),
		'LBL_FOULLIST' => array('foullist', 'foullist'),
		'LBL_BLOCK' => array('foullist', 'block'),

	);
	var $search_fields_name = Array (
		'LBL_NOTIF' => 'notif',
		'LBL_DATA_CHECK' => 'data_check',
		'LBL_TARGET' => 'target',
		'LBL_DATE_FOUL' => 'date_foul',
		'LBL_POINT' => 'point',
		'LBL_FOUL' => 'foul',
		'LBL_USERID' => 'users',
		'LBL_FOULLIST' => 'foullist',
		'LBL_BLOCK' => 'block',

	);

	// For Popup window record selection
	var $popup_fields = Array ('foul');

	// For Alphabetical search
	var $def_basicsearch_col = 'foul';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'foul';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('foul','assigned_user_id');

	var $default_order_by = 'foul';
	var $default_sort_order='ASC';

	function FoulList() {
		$this->log =LoggerManager::getLogger('FoulList');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('FoulList');
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

		$moduleInstance = Vtiger_Module::getInstance('Potentials');
		$relatedModuleInstance = Vtiger_Module::getInstance('FoulList');
		$relationLabel = 'LBL_FOULLIST_LIST';
		$moduleInstance->setRelatedList(
			$relatedModuleInstance, $relationLabel, array('ADD'), 'get_dependents_list'
		);

		$moduleInstance = Vtiger_Module::getInstance('Events');
		$relatedModuleInstance = Vtiger_Module::getInstance('FoulList');
		$relationLabel = 'LBL_FOULLIST_LIST';
		$moduleInstance->setRelatedList(
			$relatedModuleInstance, $relationLabel, array('ADD'), 'get_dependents_list'
		);

	}
}