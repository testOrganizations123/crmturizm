<?php

/* * *******************************************************************************
 * The content of this file is subject to the PDF Maker license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class PDFMaker_List_View extends Vtiger_Index_View {

    protected $listViewLinks = false;
    
    public function __construct() {
        parent::__construct();
        $this->exposeMethod('getList');
    }

    public function preProcess(Vtiger_Request $request, $display = true) {
        $viewer = $this->getViewer($request);
        $moduleName = $request->getModule();
        $viewer->assign('QUALIFIED_MODULE', $moduleName);
        Vtiger_Basic_View::preProcess($request, false);
        $viewer = $this->getViewer($request);

        $moduleName = $request->getModule();
        if (!empty($moduleName)) {
            //$moduleModel = PDFMaker_PDFMaker_Model::getInstance($moduleName);
            $moduleModel = new PDFMaker_PDFMaker_Model('PDFMaker');
            $currentUser = Users_Record_Model::getCurrentUserModel();
            $userPrivilegesModel = Users_Privileges_Model::getInstanceById($currentUser->getId());
            $permission = $userPrivilegesModel->hasModulePermission($moduleModel->getId());
            $viewer->assign('MODULE', $moduleName);

            if (!$permission) {
                $viewer->assign('MESSAGE', 'LBL_PERMISSION_DENIED');
                $viewer->view('OperationNotPermitted.tpl', $moduleName);
                exit;
            }

            $linkParams = array('MODULE' => $moduleName, 'ACTION' => $request->get('view'));
            $linkModels = $moduleModel->getSideBarLinks($linkParams);

            $viewer->assign('QUICK_LINKS', $linkModels);
        }
        
        $viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('CURRENT_VIEW', $request->get('view'));
        if ($display) {
            $this->preProcessDisplay($request);
        }
    }
    
    public function postProcess(Vtiger_Request $request) {
        $viewer = $this->getViewer($request);
        $viewer->view('IndexPostProcess.tpl');

        parent::postProcess($request);
    }

    public function process(Vtiger_Request $request) {
        $viewer = $this->getViewer($request);
        
        $qualifiedModuleName = $request->getModule(false);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModuleName);
        $viewer->assign("URL", vglobal("site_URL"));
        $adb = PearDatabase::getInstance();

        $vcv = vglobal('vtiger_current_version');

        $result = @$adb->pquery("SELECT version FROM vtiger_pdfmaker_version WHERE version = ?", array($vcv));

        $num_templates = @$adb->query_result(@$adb->pquery("SELECT id FROM vtiger_pdfmaker_seq", array()), 0, "id");

        if ($result && $adb->num_rows($result) > 0 && $num_templates > 0 && is_dir("modules/PDFMaker/resources/mpdf")) {
            //require_once("ListPDFTemplates.php");
            $this->invokeExposedMethod('getList', $request);
        } else {
            
            $company_details = Vtiger_CompanyDetails_Model::getInstanceById();
            $viewer->assign("COMPANY_DETAILS", $company_details);
            
            
            $mb_string_exists = function_exists("mb_get_info");
            if ($mb_string_exists === false) {
                $viewer->assign("MB_STRING_EXISTS", 'false');
            } else {
                $viewer->assign("MB_STRING_EXISTS", 'true');
            }
            
            if ($result && $adb->num_rows($result) > 0) {
                
                 $current_step = 2;
                 if (is_dir("modules/PDFMaker/resources/mpdf")) {
                    require_once ('include/utils/VtlibUtils.php');

                    $step = "3";
                    $total_steps = "2";
 
                } else {
                    $step = "2";
                    $total_steps = "3";
                }
            } else {
               
                $step = 1;
                $current_step = 1;
                
                if (!is_dir("modules/PDFMaker/resources/mpdf"))
                    $total_steps = 3;
                else
                    $total_steps = 2;
            }
            
            $viewer->assign("STEP", $step);
            $viewer->assign("CURRENT_STEP", $current_step);
            $viewer->assign("TOTAL_STEPS", $total_steps);
            
            $viewer->view('Install.tpl', 'PDFMaker');
        }
    }

    public function getList(Vtiger_Request $request) {

        PDFMaker_Debugger_Model::GetInstance()->Init();
        $current_user = Users_Record_Model::getCurrentUserModel();

        $l = new PDFMaker_License_Action();
        $l->controlLicense();
        
        $PDFMaker = new PDFMaker_PDFMaker_Model();
        
        if ($PDFMaker->CheckPermissions("DETAIL") == false)
            $PDFMaker->DieDuePermission();

        $viewer = $this->getViewer($request);
        $orderby = "templateid";
        $dir = "asc";

        if (isset($_REQUEST["dir"]) && $_REQUEST["dir"] == "desc")
            $dir = "desc";

        if (isset($_REQUEST["orderby"])) {
            switch ($_REQUEST["orderby"]) {
                case "name":
                    $orderby = "filename";
                    break;

                case "module":
                    $orderby = "module";
                    break;

                case "description":
                    $orderby = "description";
                    break;

                case "order":
                    $orderby = "order";
                    break;
                default:
                    $orderby = $_REQUEST["orderby"];
                    break;
            }
        }

        $version_type = $PDFMaker->GetVersionType();
        $license_key = $PDFMaker->GetLicenseKey();

        $viewer->assign("VERSION_TYPE", $version_type);
        $viewer->assign("VERSION", ucfirst($version_type) . " " . PDFMaker_Version_Helper::$version);
        $viewer->assign("LICENSE_KEY", $license_key);

// $to_update = "false";
// $smarty->assign("TO_UPDATE",$to_update);  
        
        if ($PDFMaker->CheckPermissions("EDIT")) {
            $viewer->assign("EXPORT", "yes");
        }

        if ($PDFMaker->CheckPermissions("EDIT") && $PDFMaker->GetVersionType() != "deactivate") {
            $viewer->assign("EDIT", "permitted");
            $viewer->assign("IMPORT", "yes");
        }

        if ($PDFMaker->CheckPermissions("DELETE") && $PDFMaker->GetVersionType() != "deactivate") {
            $viewer->assign("DELETE", "permitted");
        }

        $notif = $PDFMaker->GetReleasesNotif();
        $viewer->assign("RELEASE_NOTIF", $notif);

        $php_version = phpversion();
        $notif = false;
        $max_in_vars = ini_get("max_input_vars");
        if ($max_in_vars <= 1000 && $php_version >= "5.3.9")
            $notif = true;

        $test = ini_set("memory_limit", "256M");
        $memory_limit = ini_get("memory_limit");
        if (substr($memory_limit, 0, -1) <= 128)
            $notif = true;

        $max_exec_time = ini_get("max_execution_time");
        if ($max_exec_time <= 60)
            $notif = true;

        if (extension_loaded('suhosin')) {
            $request_max_vars = ini_get("suhosin.request.max_vars");
            $post_max_vars = ini_get("suhosin.post.max_vars");
            if ($request_max_vars <= 1000)
                $notif = true;
            if ($post_max_vars <= 1000)
                $notif = true;
        }

        if ($notif === true) {
            //$notif = '<a href="index.php?module=PDFMaker&action=Debugging&parenttab=Settings" title="' . vtranslate("LBL_GOTO_DEBUG","PDFMaker") . '" style="color:red;">' . vtranslate("LBL_DBG_NOTIF","PDFMaker") . '</a>';
            //$viewer->assign("DEBUG_NOTIF", $notif);
        }

        $viewer->assign("PARENTTAB", getParentTab());
        $viewer->assign("ORDERBY", $orderby);
        $viewer->assign("DIR", $dir);

        $Search_Selectbox_Data = $PDFMaker->getSearchSelectboxData();
        $viewer->assign("SEARCHSELECTBOXDATA", $Search_Selectbox_Data);
        
        
        $return_data = $PDFMaker->GetListviewData($orderby, $dir, $request);
        $viewer->assign("PDFTEMPLATES", $return_data);
        $category = getParentTab();
        $viewer->assign("CATEGORY", $category);

        if ($current_user->isAdminUser()) {
            $viewer->assign('IS_ADMIN', '1');
        }
        //$tool_buttons = Button_Check($currentModule);
        //$viewer->assign('CHECK', $tool_buttons);
        $moduleName = $request->getModule();
        $linkParams = array('MODULE' => $moduleName, 'ACTION' => $request->get('view'));
        $linkModels = $PDFMaker->getListViewLinks($linkParams);
        $viewer->assign('LISTVIEW_MASSACTIONS', $linkModels['LISTVIEWMASSACTION']);
        
        $viewer->assign('LISTVIEW_LINKS', $linkModels);
       
        $tpl = "ListPDFTemplates";
        if ($request->get('ajax') == "true")
            $tpl .= "Contents";
        
        $sharing_types = Array(""=>"",
            "public" => vtranslate("PUBLIC_FILTER",'PDFMaker'),
            "private" => vtranslate("PRIVATE_FILTER",'PDFMaker'),
            "share" => vtranslate("SHARE_FILTER",'PDFMaker'));
        $viewer->assign("SHARINGTYPES", $sharing_types);
        
        $Status = array(
            "status_1" => vtranslate("Active",'PDFMaker'),
            "status_0" => vtranslate("Inactive",'PDFMaker'));
        $viewer->assign("STATUSOPTIONS", $Status);
        
        $Search_Types = array("filename","module","description","sharingtype","owner","status");
        
        foreach ($Search_Types AS $st) {    
            $search_val = "";
            if ($request->has('search_'.$st) && !$request->isEmpty('search_'.$st)) {
                $search_val = $request->get('search_'.$st);
            }
            $viewer->assign("SEARCH".strtoupper($st)."VAL", $search_val);
        }
        
        
        $viewer->assign("MAIN_PRODUCT_SUPPORT", '');
        $viewer->assign("MAIN_PRODUCT_WHITELABEL", '');
        
        $viewer->view($tpl.".tpl", 'PDFMaker');
    }
    
    function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();

        $jsFileNames = array(
            "layouts.vlayout.modules.PDFMaker.resources.License",
            "layouts.vlayout.modules.PDFMaker.resources.List"
        );
        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
        return $headerScriptInstances;
    }   
}