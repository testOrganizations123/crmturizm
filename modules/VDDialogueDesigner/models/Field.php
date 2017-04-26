<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class VDDialogueDesigner_Field_Model extends Vtiger_Field_Model {

        function getStepName($id){
            global $adb;
            $query = $adb->pquery('SELECT * FROM vd_dialoguedesigner WHERE dialoguedesignerid = ?',array($id));
           return $adb->query_result($query,0,'dialog_name');
        }
        function getUiAnswer($template){
            return 'uitypes/Answer_'.$template.'.tpl';
        } 
        function getFieldNameRelatedModule($field){
            $_f = explode(':', $field);
            $label = explode("_", $_f[3]);
            return $label[1];
        }
        function getCategoryName($id){
             global $adb;
            $query = $adb->pquery('SELECT * FROM vd_dialogue_script WHERE id = ?',array($id));
           return ($adb->query_result($query,0,'subject'))? $adb->query_result($query,0,'subject'): "Общий";
        }
}