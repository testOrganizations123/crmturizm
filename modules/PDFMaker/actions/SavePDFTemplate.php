<?php

/* * *******************************************************************************
 * The content of this file is subject to the PDF Maker license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class PDFMaker_SavePDFTemplate_Action extends Vtiger_Action_Controller {

    public function checkPermission(Vtiger_Request $request) {
    }

    public function process(Vtiger_Request $request) {

        PDFMaker_Debugger_Model::GetInstance()->Init();
        $adb = PearDatabase::getInstance();
        
        $adb->println("TRANS save pdfmaker starts");
        $adb->startTransaction();
        
        $cu_model = Users_Record_Model::getCurrentUserModel();
        $PDFMaker = new PDFMaker_PDFMaker_Model();
 
        $S_Data = $request->getAll();
        
        $filename = $request->get('filename');
        $modulename = $request->get('modulename');
        $templateid = $request->get('templateid');
        $description = $request->get('description');
        $spcompany = $request->get('spcompany');
        
        $body = $S_Data['body'];
        
        $pdf_format = $request->get('pdf_format');
        $pdf_orientation = $request->get('pdf_orientation');
        $owner = $request->get('template_owner');
        $sharingtype = $request->get('sharing');
        //vtiger_pdfmaker_user_status
        $is_active = $request->get('is_active');
       
        $is_default_dv = $request->get('is_default_dv');
        $is_default_lv = $request->get('is_default_lv');
        $is_portal = $request->get('is_portal');
        $is_listview = $request->get('is_listview');
        
        if ($is_default_dv != "") $is_default_dv = "1"; else $is_default_dv = "0";
        if ($is_default_lv != "") $is_default_lv = "1"; else $is_default_lv = "0";
        if ($is_portal != "") $is_portal = "1"; else $is_portal = "0";
        if ($is_listview != "") $is_listview = "1"; else $is_listview = "0";
        
        $order = $request->get('tmpl_order');
        
        $dh_first = $request->get('dh_first');
        $dh_other = $request->get('dh_other');
        $df_first = $request->get('df_first');
        $df_last = $request->get('df_last');
        $df_other = $request->get('df_other');
        
        if ($dh_first != "") $dh_first = "1"; else $dh_first = "0";
        if ($dh_other != "") $dh_other = "1"; else $dh_other = "0";
        if ($df_first != "") $df_first = "1"; else $df_first = "0";
        if ($df_last != "") $df_last = "1"; else $df_last = "0";
        if ($df_other != "") $df_other = "1"; else $df_other = "0";

        if (isset($templateid) && $templateid != '') {
            $sql = "update vtiger_pdfmaker set filename =?, module =?, description =?, body =?, spcompany = ? where templateid =?";
            $params = array($filename, $modulename, $description, $body, $spcompany, $templateid);
            $adb->pquery($sql, $params);

            $sql2 = "DELETE FROM vtiger_pdfmaker_settings WHERE templateid =?";
            $params2 = array($templateid);
            $adb->pquery($sql2, $params2);

            $sql21 = "DELETE FROM vtiger_pdfmaker_userstatus WHERE templateid=? AND userid=?";
            $adb->pquery($sql21, array($templateid, $cu_model->id));
        } else {
            $templateid = $adb->getUniqueID('vtiger_pdfmaker');
            $sql3 = "insert into vtiger_pdfmaker (filename,module,description,body,deleted,spcompany,templateid) values (?,?,?,?,?,?,?)";
            $params3 = array($filename, $modulename, $description, $body, 0, $spcompany, $templateid);
            $adb->pquery($sql3, $params3);
        }

        $margin_top = $request->get('margin_top');
        if ($margin_top < 0) $margin_top = 0;

        $margin_bottom = $request->get('margin_bottom');
        if ($margin_bottom < 0) $margin_bottom = 0;    
            
        $margin_left = $request->get('margin_left');
        if ($margin_left < 0) $margin_left = 0; 
        
        $margin_right = $request->get('margin_right');
        if ($margin_right < 0) $margin_right = 0; 
        
 
        $dec_point = $request->get('dec_point');
        $dec_decimals = $request->get('dec_decimals');
        $dec_thousands = $request->get('dec_thousands');
        
        if ($dec_thousands == " ") $dec_thousands = "sp";

        $header = $S_Data['header_body'];
        $footer = $S_Data['footer_body'];

        $encoding = $request->get('encoding');
        if ($encoding == "") $encoding = "auto";

        $nameOfFile = $request->get('nameOfFile');

// ITS4YOU-CR VlZa
//in case of allowed module make sure that only one template from that module is set for portal
        if (($modulename == "Invoice" || $modulename == "Quotes") && $is_portal == "1") {
            $sql4a = "UPDATE vtiger_pdfmaker_settings 
            INNER JOIN vtiger_pdfmaker 
              USING(templateid)
            SET is_portal = '0' 
            WHERE is_portal = '1'
              AND module=?";
            $params4a = array($modulename);
            $adb->pquery($sql4a, $params4a);
        }

        if ($pdf_format == "Custom") {
            $pdf_cf_width = $request->get('pdf_format_width');
            $pdf_cf_height = $request->get('pdf_format_height');
            $pdf_format = $pdf_cf_width . ";" . $pdf_cf_height;
        }

        $disp_header = base_convert($dh_first . $dh_other, 2, 10);
        $disp_footer = base_convert($df_first . $df_last . $df_other, 2, 10);

        $sql4 = "INSERT INTO vtiger_pdfmaker_settings (templateid, margin_top, margin_bottom, margin_left, margin_right, format, orientation, 
                                               decimals, decimal_point, thousands_separator, header, footer, encoding, file_name, is_portal,
                                               is_listview, owner, sharingtype, disp_header, disp_footer)
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $params4 = array($templateid, $margin_top, $margin_bottom, $margin_left, $margin_right, $pdf_format, $pdf_orientation,
            $dec_decimals, $dec_point, $dec_thousands, $header, $footer, $encoding, $nameOfFile, $is_portal,
            $is_listview, $owner, $sharingtype, $disp_header, $disp_footer);
        $adb->pquery($sql4, $params4);
// ITS4YOU-END
//ignored picklist values
        $adb->pquery("DELETE FROM vtiger_pdfmaker_ignorepicklistvalues", array());
        
        $ignore_picklist_values =  $request->get('ignore_picklist_values');
        $pvvalues = explode(",", $ignore_picklist_values);
        foreach ($pvvalues as $value)
            $adb->pquery("INSERT INTO vtiger_pdfmaker_ignorepicklistvalues(value) VALUES(?)",array(trim($value)));
// end ignored picklist values
//unset the former default template because only one template can be default per user x module
        $is_default_bin = $is_default_lv . $is_default_dv;
        $is_default_dec = intval(base_convert($is_default_bin, 2, 10)); // convert binary format xy to decimal; where x stands for is_default_lv and y stands for is_default_dv
        if ($is_default_dec > 0) {
            $sql5 = "UPDATE vtiger_pdfmaker_userstatus
            INNER JOIN vtiger_pdfmaker USING(templateid)
            SET is_default=?
            WHERE is_default=? AND userid=? AND module=?";

            switch ($is_default_dec) {
//      in case of only is_default_dv is checked
                case 1:
                    $adb->pquery($sql5, array("0", "1", $cu_model->id, $modulename));
                    $adb->pquery($sql5, array("2", "3", $cu_model->id, $modulename));
                    break;
//      in case of only is_default_lv is checked
                case 2:
                    $adb->pquery($sql5, array("0", "2", $cu_model->id, $modulename));
                    $adb->pquery($sql5, array("1", "3", $cu_model->id, $modulename));
                    break;
//      in case of both is_default_* are checked
                case 3:
                    $sql5 = "UPDATE vtiger_pdfmaker_userstatus
                    INNER JOIN vtiger_pdfmaker USING(templateid)
                    SET is_default=?
                    WHERE is_default > ? AND userid=? AND module=?";
                    $adb->pquery($sql5, array("0", "0", $cu_model->id, $modulename));
            }
        }

        $sql6 = "INSERT INTO vtiger_pdfmaker_userstatus(templateid, userid, is_active, is_default, sequence) VALUES(?,?,?,?,?)";
        $adb->pquery($sql6, array($templateid, $cu_model->id, $is_active, $is_default_dec, $order));

//SHARING
        $sql7 = "DELETE FROM vtiger_pdfmaker_sharing WHERE templateid=?";
        $adb->pquery($sql7, array($templateid));

        $selected_col_string = $request->get('sharingSelectedColumnsString');
        if ($sharingtype == "share" && $selected_col_string != "") {
            $member_array = explode(';', $selected_col_string);
            $groupMemberArray = self::constructSharingMemberArray($member_array);

            $sql8a = "INSERT INTO vtiger_pdfmaker_sharing(templateid, shareid, setype) VALUES ";
            $sql8b = "";
            $params8 = array();
            foreach ($groupMemberArray as $setype => $shareIdArr) {
                foreach ($shareIdArr as $shareId) {
                    $sql8b .= "(?, ?, ?),";
                    $params8[] = $templateid;
                    $params8[] = $shareId;
                    $params8[] = $setype;
                }
            }

            if ($sql8b != "") {
                $sql8b = rtrim($sql8b, ",");
                $sql8 = $sql8a . $sql8b;
                $adb->pquery($sql8, $params8);
            }
        }

        $adb->pquery("DELETE FROM vtiger_pdfmaker_displayed WHERE templateid=?", array($templateid));

        $displayed_value = $request->get('displayedValue');
        $display_conditions = Zend_Json::encode($request->get('display_conditions'));
        $adb->pquery("INSERT INTO vtiger_pdfmaker_displayed (templateid,displayed,conditions) VALUES (?,?,?)", array($templateid,$displayed_value,$display_conditions));

        $PDFMaker->AddLinks($modulename);

        $adb->completeTransaction();
	$adb->println("TRANS save pdfmaker ends");
        
        
        $redirect = $request->get('redirect');
        if ($redirect == "false") {
            $redirect_url = "index.php?module=PDFMaker&view=Edit&parenttab=Tools&applied=true&templateid=".$templateid;
            
            $return_module = $request->get('return_module');
            $return_view = $request->get('return_view');
            
            if ($return_module != "") $redirect_url .= "&return_module=".$return_module;
            if ($return_view != "") $redirect_url .= "&return_view=".$return_view;
            
            header("Location:".$redirect_url);
        } else {
            header("Location:index.php?module=PDFMaker&view=Detail&parenttab=Tools&templateid=" . $templateid);
        }
    }

    private function constructSharingMemberArray($member_array) {

        $groupMemberArray = Array();
        $roleArray = Array();
        $roleSubordinateArray = Array();
        $groupArray = Array();
        $userArray = Array();

        foreach ($member_array as $member) {
            $memSubArray = explode('::', $member);
            switch ($memSubArray[0]) {
                case "groups":
                    $groupArray[] = $memSubArray[1];
                    break;

                case "roles":
                    $roleArray[] = $memSubArray[1];
                    break;

                case "rs":
                    $roleSubordinateArray[] = $memSubArray[1];
                    break;

                case "users":
                    $userArray[] = $memSubArray[1];
                    break;
            }
        }

        $groupMemberArray['groups'] = $groupArray;
        $groupMemberArray['roles'] = $roleArray;
        $groupMemberArray['rs'] = $roleSubordinateArray;
        $groupMemberArray['users'] = $userArray;

        return $groupMemberArray;
    }    
}