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

class HRUser extends Vtiger_CRMEntity {
	 var $tab_name = Array('vtiger_users','vtiger_hruser');
         var $tab_name_index = Array('vtiger_users'=>'id','vtiger_hruser'=>'hruserid');
         var $table_name = "vtiger_users";
         var $table_index= 'id';
         
	
	/**
	 * Mandatory for Listing (Related listview)
	 */
	 var $list_fields = Array(
            'First Name'=>Array('vtiger_users'=>'first_name'),
            'Last Name'=>Array('vtiger_users'=>'last_name'),
            'Role Name'=>Array('vtiger_user2role'=>'roleid'),
            'User Name'=>Array('vtiger_users'=>'user_name'),
			'Status'=>Array('vtiger_users'=>'status'),
			'Email'=>Array('vtiger_users'=>'email1'),
            'Email2'=>Array('vtiger_users'=>'email2'),
            'Office'=>Array('vtiger_users'=>'office'),
            'Phone'=>Array('vtiger_users'=>'phone_work')
    );
    var $list_fields_name = Array(
            'Last Name'=>'last_name',
            'First Name'=>'first_name',
            'Role Name'=>'roleid',
            'User Name'=>'user_name',
			'Status'=>'status',
            'Email'=>'email1',
            'Email2'=>'email2',
            'Office'=>'office',
            'Phone'=>'phone_work'
    );


	// Make the field link to detail view
	 var $list_link_field= 'last_name';

	// For Popup listview and UI type support
	var $search_fields = Array(
            'Name'=>Array('vtiger_users'=>'last_name'),
            'Email'=>Array('vtiger_users'=>'email1'),
            'Email2'=>Array('vtiger_users'=>'email2')
    );
    var $search_fields_name = Array(
            'Name'=>'last_name',
            'Email'=>'email1',
            'Email2'=>'email2'
    );

	// For Popup window record selection
	var $popup_fields = array('name_hruser');

	// For Alphabetical search
	var $def_basicsearch_col = 'name_hruser';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'name_hruser';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = array('createdtime', 'modifiedtime', 'name_hruser');

	var $default_order_by = 'name_hruser';
	var $default_sort_order='ASC';

	function HRUser() {
		$this->log =LoggerManager::getLogger('HRUser');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('HRUser');
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
        function retrieve_entity_info($record, $module) {
		global $adb, $log, $app_strings;

		// INNER JOIN is desirable if all dependent table has entries for the record.
		// LEFT JOIN is desired if the dependent tables does not have entry.
		$join_type = 'LEFT JOIN';

		// Tables which has multiple rows for the same record
		// will be skipped in record retrieve - need to be taken care separately.
		$multirow_tables = NULL;
		
		// Lookup module field cache
              
                $cachedModuleFields = VTCacheUtils::lookupFieldInfo_Module($module);
		
		if ($cachedModuleFields === false) {
			// Pull fields and cache for further use
			$tabid = getTabid($module);

			$sql0 = "SELECT fieldname, fieldid, fieldlabel, columnname, tablename, uitype, typeofdata,presence FROM vtiger_field WHERE tabid=?";
			// NOTE: Need to skip in-active fields which we will be done later.
			$result0 = $adb->pquery($sql0, array($tabid));
			if ($adb->num_rows($result0)) {
				while ($resultrow = $adb->fetch_array($result0)) {
					// Update cache
					VTCacheUtils::updateFieldInfo(
						$tabid, $resultrow['fieldname'], $resultrow['fieldid'], $resultrow['fieldlabel'], $resultrow['columnname'], $resultrow['tablename'], $resultrow['uitype'], $resultrow['typeofdata'], $resultrow['presence']
					);
				}
				// Get only active field information
				$cachedModuleFields = VTCacheUtils::lookupFieldInfo_Module($module);
			}
		}
                
		if ($cachedModuleFields) {
			$column_clause = 'h.solary, h.position, h.procent, concat(u.first_name, " ", u.last_name) as name_hruser, u.office as office';
			$from_clause   = 'vtiger_users as u LEFT JOIN vtiger_hruser as h ON h.hruserid=u.id ';
			$where_clause  = '';
			$limit_clause  = ' LIMIT 1'; // to eliminate multi-records due to table joins.

			$params = array();
			$required_tables = $this->tab_name_index; // copies-on-write
                        
			
			

			$where_clause .= ' u.id=?';
			$params[] = $record;

			$sql = sprintf('SELECT %s FROM %s WHERE %s %s', $column_clause, $from_clause, $where_clause, $limit_clause);
                        
			$result = $adb->pquery($sql, $params);
                        
			if (!$result || $adb->num_rows($result) < 1) {
				throw new Exception($app_strings['LBL_RECORD_NOT_FOUND'], -1);
			} else {
				$resultrow = $adb->query_result_rowdata($result);
				if (!empty($resultrow['deleted'])) {
					throw new Exception($app_strings['LBL_RECORD_DELETE'], 1);
				}

				foreach ($cachedModuleFields as $fieldinfo) {
					$fieldvalue = '';
					$fieldkey = $fieldinfo['fieldname'];
                                        
					//Note : value is retrieved with a tablename+fieldname as we are using alias while building query
					if (isset($resultrow[$fieldkey])) {
						$fieldvalue = $resultrow[$fieldkey];
					}
					$this->column_fields[$fieldinfo['fieldname']] = $fieldvalue;
				}
			}
		}

		$this->column_fields['record_id'] = $record;
		$this->column_fields['record_module'] = $module;
	}
}