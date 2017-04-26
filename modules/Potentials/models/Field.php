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
 * Vtiger Field Model Class
 */
class Potentials_Field_Model extends Vtiger_Field_Model {

	var $mandatory = false;
        public function isMandatory() {
            
                if ($this->mandatory){
                    return true;
                }
		list($type,$mandatory)= explode('~',$this->get('typeofdata'));
		return $mandatory=='M' ? true:false;
	}
        public function setMandatory() {
            $this->mandatory = true;
            
        }
        public function getPicklistValuesOffice() {
            
        
            if($this->isRoleBased()) {
                $userModel = Users_Record_Model::getCurrentUserModel();
                $picklistValues = Vtiger_Util_Helper::getRoleBasedPicklistValues($this->getName(), $userModel->get('roleid'));
            }else{
                $picklistValues = Vtiger_Util_Helper::getPickListValues($this->getName());
            }
		return $picklistValues;
        }
		
    

}