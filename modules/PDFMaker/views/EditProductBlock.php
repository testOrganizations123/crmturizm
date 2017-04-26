<?php

/* * *******************************************************************************
 * The content of this file is subject to the PDF Maker license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class PDFMaker_EditProductBlock_View extends Vtiger_Index_View {

    public $cu_language = ""; 
    
    public function preProcess(Vtiger_Request $request, $display = true) {
        
        $PDFMaker = new PDFMaker_PDFMaker_Model();
        $viewer = $this->getViewer($request);
        $moduleName = $request->getModule();
        $viewer->assign('QUALIFIED_MODULE', $moduleName);
        Vtiger_Basic_View::preProcess($request, false);
        $viewer = $this->getViewer($request);

        $moduleName = $request->getModule();
        
        $linkParams = array('MODULE' => $moduleName, 'ACTION' => $request->get('view'));
        $linkModels = $PDFMaker->getSideBarLinks($linkParams);
        $viewer->assign('QUICK_LINKS', $linkModels);
        
        $viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('CURRENT_VIEW', $request->get('view'));
        
        if ($display) {
            $this->preProcessDisplay($request);
        }
    }
    
    public function process(Vtiger_Request $request) {
        PDFMaker_Debugger_Model::GetInstance()->Init();

        $PDFMaker = new PDFMaker_PDFMaker_Model();
        if ($PDFMaker->CheckPermissions("EDIT") == false)
            $PDFMaker->DieDuePermission();

        $viewer = $this->getViewer($request);
        
        $emode = "";
        $template = array();
        $tplid = $request->get('tplid');
        $mode = $request->get('mode');
        if (isset($tplid) && $tplid != "") {
            
            $adb = PearDatabase::getInstance();
            $sql = "SELECT * FROM vtiger_pdfmaker_productbloc_tpl WHERE id=?";
            $result = $adb->pquery($sql, array($tplid));
            $row = $adb->fetchByAssoc($result);
            if ($mode != "duplicate") {
                $template["id"] = $row["id"];
            }
            $template["name"] = $row["name"];
            $template["body"] = $row["body"];
            $emode = "edit";
        }

        //if no ID is specified then it is create view
        $viewer->assign("EDIT_TEMPLATE", $template);
        //PROPERTIES tab
        $ProductBlockFields = $PDFMaker->GetProductBlockFields();
        foreach ($ProductBlockFields as $smarty_key => $pbFields) {
            $viewer->assign($smarty_key, $pbFields);
        }
        //LABELS
        //global lang
        $cu_model = Users_Record_Model::getCurrentUserModel();
       
        $this->cu_language = $cu_model->get('language');
        $app_strings_big = Vtiger_Language_Handler::getModuleStringsFromFile($this->cu_language);
        $app_strings = $app_strings_big['languageStrings'];
        
        $global_lang_labels = array_flip($app_strings);
        $global_lang_labels = array_flip($global_lang_labels);
        asort($global_lang_labels);
        $viewer->assign("GLOBAL_LANG_LABELS", $global_lang_labels);
        //custom lang
        list($custom_labels, $languages) = $PDFMaker->GetCustomLabels();
        $currLangId = "";
        foreach ($languages as $langId => $langVal) {
            if ($langVal["prefix"] == $current_language) {
                $currLangId = $langId;
                break;
            }
        }
        $vcustom_labels = array();
        if (count($custom_labels) > 0) {
            foreach ($custom_labels as $oLbl) {
                $currLangVal = $oLbl->GetLangValue($currLangId);
                if ($currLangVal == "")
                    $currLangVal = $oLbl->GetFirstNonEmptyValue();

                $vcustom_labels[$oLbl->GetKey()] = $currLangVal;
            }
            asort($vcustom_labels);
        }
        else {
            $vcustom_labels = $mod_strings["LBL_SELECT_MODULE_FIELD"];
        }
        $viewer->assign("CUSTOM_LANG_LABELS", $vcustom_labels);

        //VIEW HELPERS
        if ($PDFMaker->GetVersionType() == "professional") {
            $type = "professional";
        } else {
            $type = "basic";
        }
        $viewer->assign("TYPE", $type);            
        $viewer->assign("EMODE", $emode);
        $viewer->assign("MODE", $mode);
        
        $viewer->view('EditProductBlock.tpl', 'PDFMaker');
    }

    /**
     * Function to get the list of Script models to be included
     * @param Vtiger_Request $request
     * @return <Array> - List of Vtiger_JsScript_Model instances
     */
    function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();

        $jsFileNames = array(
            'modules.PDFMaker.resources.ckeditor.ckeditor',
            'libraries.jquery.ckeditor.adapters.jquery',
            'libraries.jquery.jquery_windowmsg',
            'modules.PDFMaker.resources.CkEditor'
        );

        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
        return $headerScriptInstances;
    }
}