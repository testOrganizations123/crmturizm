<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: Vordoom.net
 * The Initial Developer of the Original Code is Vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class VDDialogueDesigner_ScriptModule_Model {
        public $fieldlist = array('subject', 'description', 'menu_active'); 
    
        function __construct() {
           
        }
        public function getFieldsList(){
            return $this->fieldlist;
        }
        public function getListViewUrl(){
            return "index.php?module=VDDialogueDesigner&view=List&parent=Settings";
        }
	
}
