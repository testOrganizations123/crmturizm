<?php

class ModuleCreator_Module_Model extends Vtiger_Module_Model {
    
    public function getDefaultUrl() {
	return 'index.php?module='.$this->get('name').'&view='.$this->getDefaultViewName(). "&parent=Settings";
    }
    
    
}


