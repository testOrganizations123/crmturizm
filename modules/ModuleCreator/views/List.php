<?php

class ModuleCreator_List_View extends Vtiger_Index_View {

	public function process(Vtiger_Request $request) {
            
            // force redirect
            echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='."index.php?module=ModuleCreator&parent=Settings&view=List".'">';
            exit;
               
	}
        
        
}
