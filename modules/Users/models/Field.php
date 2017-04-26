<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * User Field Model Class
 */
class Users_Field_Model extends Vtiger_Field_Model {
    public $userOffice = array(
        '6'=>array(
            409=>'ТЦ Радуга вкуса',
            407=>'ТОК Флагман',
            30=>'БЦ Россия',
            
        ),
        '19'=>array(
            405=>'Сургут',
            406=>'ТЦ Северяне',
        ),
        '78'=>array(
            29=>'ТЦ Аркада',
            428=>'ТЦ Европа',
            403=>'БЦ Версаль',
            434=>'Бердск',
            436=>'Барнаул',
        )
        );
    
    public $userRosel = array('71'=>array(
                                       'Руководитель офиса ТЦ Радуга ВКУСА' => 'H21',
    'Менеджер ТЦ Радуга Вкуса' => 'H22',
    'Менеджер стажер ТЦ Радуга Вкуса' => 'H23',
    'Руководитель офиса ТОК Флагман' => 'H24',
    'Старший менеджер ТОК Флагман' => 'H25',
    'Менеджер ТОК Флагман' => 'H26',
    'Менеджер стажер ТОК Флагман' => 'H27',
    'Руководитель офиса БЦ Россия'=> 'H4',
    'Старший менеджер БЦ Россия' => 'H5',
    'Менеджер БЦ Россия' => 'H8',
    'Менеджер стажер БЦ Россия' => 'H9',
                            ),
        '7'=>array(
            'Руководитель офиса Кемерово'=>'H17',
            'Старший менеджер Кемерово'=>'H18',
            'Менеджер Кемерово'=>'H19',
            'Менеджер стажер Кемерово'=>'H20',
            'Старший менеджер Прокопьевск'=>'H38',
            'Руководитель офиса Новокузнецк'=>'H39',
            'Старший менеджер Новокузнецк'=>'H40',
            'Менеджер Новокузнецк'=>'H41',
            'Менеджер стажер Новокузнецк'=>'H42',
            'Руководитель офиса Абакан'=>'H43',
            'Старший менеджер Абакан' => 'H44',
            'Руководитель офиса Красноярск'=>'H54',
            'Старший менеджер Красноярск'=>'H46',
            'Менеджер Красноярск'=>'H47',
            'Менеджер стажер Красноярск'=>'H48',
        ),
        '6'=>array(
            'Руководитель офиса ТЦ Радуга ВКУСА'=>'H21',
            'Менеджер ТЦ Радуга Вкуса'=>'H22',
            'Менеджер стажер ТЦ Радуга Вкуса'=>'H23',
            'Руководитель офиса ТОК Флагман'=>'H24',
            'Старший менеджер ТОК Флагман'=>'H25',
            'Менеджер ТОК Флагман'=>'H26',
            'Менеджер стажер ТОК Флагман'=>'H27',
            'Руководитель офиса БЦ Россия'=>'H4',
            'Старший менеджер БЦ Россия' => 'H5',
            'Менеджер БЦ Россия'=>'H8',
            'Менеджер стажер БЦ Россия'=>'H9',
            
        ),
        '19'=>array(
            'Руководитель офиса Сургут'=>'H50',
            'Старший менеджер Сургут'=>'H51',
            'Менеджер Вартовск'=>'H52',
            'Менеджер стажер Вартовск'=>'H53',
            'Руководитель офиса Стрежевой'=>'H54',
        ),
        '78'=>array(
            'Руководитель офиса ТЦ Аркада'=>'H12',
            'Старший менеджер ТЦ Аркада'=>'H13',
            'Менеджер ТЦ Аркада'=>'H14',
            'Менеджер стажер ТЦ Аркада'=>'H15',
            'Руководитель офиса ТЦ Европа'=>'H28',
            'Старший менеджер ТЦ Европа'=>'H29',
            'менеджер ТЦ Европа'=>'H30',
            'Менеджер стажер ТЦ Европа'=>'H31',
            'Руководитель офиса БЦ Версаль'=>'H32',
            'Старший менеджер БЦ Версаль'=>'H33',
            'Менеджер БЦ Версаль'=>'H34',
            'Менеджер стажер БЦ Версаль'=>'H35',
            'Руководитель офиса Бердск'=>'H36',
            'Руководитель офиса Барнаул'=>'H37'
        ),
        );
    /**
	 * Function to check whether the current field is read-only
	 * @return <Boolean> - true/false
	 */
	public function isReadOnly() {
        $currentUserModel = Users_Record_Model::getCurrentUserModel();
        if(($currentUserModel->isAdminUser() == false && $this->get('uitype') == 98) || $this->get('uitype') == 156 || $this->get('uitype') == 115) {
            return true;
        }
	}


	/**
	 * Function to check if the field is shown in detail view
	 * @return <Boolean> - true/false
	 */
	public function isViewEnabled() {
		if($this->getDisplayType() == '4' || in_array($this->get('presence'), array(1,3))) {
			return false;
		}
		return true;
	}


    /**
	 * Function to get the Webservice Field data type
	 * @return <String> Data type of the field
	 */
	public function getFieldDataType() {
		if($this->get('uitype') == 99){
			return 'password';
		}else if(in_array($this->get('uitype'), array(32, 115))) {
            return 'picklist';
        } else if($this->get('uitype') == 101) {
            return 'userReference';
        } else if($this->get('uitype') == 98) {
            return 'userRole';
        } elseif($this->get('uitype') == 105) {
			return 'image';
		} else if($this->get('uitype') == 31) {
			return 'theme';
		}
        return parent::getFieldDataType();
    }

    /**
	 * Function to check whether field is ajax editable'
	 * @return <Boolean>
	 */
	public function isAjaxEditable() {
		if(!$this->isEditable() || $this->get('uitype') == 105 || $this->get('uitype') == 106 || $this->get('uitype') == 98 || $this->get('uitype') == 101) {
			return false;
		}
		return true;
	}

	/**
	 * Function to get all the available picklist values for the current field
	 * @return <Array> List of picklist values if the field is of type picklist or multipicklist, null otherwise.
	 */
	public function getPicklistValues() {
		if($this->get('uitype') == 32) {
			return Vtiger_Language_Handler::getAllLanguages();
		}
        else if ($this->get('uitype') == '115') {
            $db = PearDatabase::getInstance();
            
            $query = 'SELECT '.$this->getFieldName().' FROM vtiger_'.$this->getFieldName();
            $result = $db->pquery($query, array());
            $num_rows = $db->num_rows($result);
            $fieldPickListValues = array();
            for($i=0; $i<$num_rows; $i++) {
                $picklistValue = $db->query_result($result,$i,$this->getFieldName());
                $fieldPickListValues[$picklistValue] = vtranslate($picklistValue,$this->getModuleName());
            }
            return $fieldPickListValues;
        }
		return parent::getPicklistValues();
	}

    /**
     * Function to returns all skins(themes)
     * @return <Array>
     */
    public function getAllSkins(){
        return Vtiger_Theme::getAllSkins();
    }

    /**
	 * Function to retieve display value for a value
	 * @param <String> $value - value which need to be converted to display value
	 * @return <String> - converted display value
	 */
    public function getDisplayValue($value, $recordId = false) {
        
		 if($this->get('uitype') == 32){
			return Vtiger_Language_Handler::getLanguageLabel($value);
		 }
          
         $fieldName = $this->getFieldName();
         if(($fieldName == 'currency_decimal_separator' || $fieldName == 'currency_grouping_separator') && ($value == '&nbsp;')) {
             return vtranslate('LBL_Space', 'Users');
         }
        return parent::getDisplayValue($value, $recordId);
    }

	/**
	 * Function returns all the User Roles
	 * @return
	 */
     public function getAllRoles(){
          $currentUserModel = Users_Record_Model::getCurrentUserModel();
         if ($currentUserModel->isAdminUser()){
        $roleModels = Settings_Roles_Record_Model::getAll();
		$roles = array();
		foreach ($roleModels as $roleId=>$roleModel) {
			$roleName = $roleModel->getName();
			$roles[$roleName] = $roleId;
		}
         }
         else {
            $roles = $this->userRosel[$currentUserModel->getId()];
         }
                
                
		return $roles;
    }

	/**
	 * Function to check whether this field editable or not
	 * return <boolen> true/false
	 */
	public function isEditable() {
		$isEditable = $this->get('editable');
		if (!$isEditable) {
			$this->set('editable', parent::isEditable());
		}
		return $this->get('editable');
	}
	
	/**
     * Function which will check if empty piclist option should be given
     */
    public function isEmptyPicklistOptionAllowed() {
		if($this->getFieldName() == 'reminder_interval') {
			return true;
		}
        return false;
    }
     public function getPicklistValuesOffice() {
         $currentUserModel = Users_Record_Model::getCurrentUserModel();
         if ($currentUserModel->isAdminUser()){
         $db = PearDatabase::getInstance();
         $sql = 'SELECT a.* FROM vtiger_office as a LEFT JOIN vtiger_crmentity as c ON c.crmid = a.officeid WHERE c.deleted = 0 ORDER BY a.office';
         $result = $db->pquery($sql, array());
         $numRows = $db->num_rows($result);
         for ($i=0;$i<$numRows;$i++){
             $pikList[$db->query_result($result,$i,'officeid')] = $db->query_result($result,$i,'office');
         }
         }
         else {
             $pikList = $this->userOffice[$currentUserModel->getId()];
         }
         return $pikList;
     }
}
