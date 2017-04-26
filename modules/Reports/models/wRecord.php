<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reports_vRecord_Model extends Reports_Module_Model {
    
    public $_id;
    /**
         * Функция получения отчета в виджет
         */
        function getReportsRecord($request) {
            
            $db = PearDatabase::getInstance();
            $this->_id = $request->get('pid');
            $detailViewModel = Reports_DetailView_Model::getInstance('Reports', $this->_id);
            //$reportChartModel = Reports_Chart_Model::getInstanceById($reportModel);
            //echo '<pre>'; print_r( $detailViewModel);
            return $this->_id;//$detailViewModel;
        }
        function widgetApp() {
            $app = $_REQUEST['_act'];
            self::$app();
            
            
            
        }
        function add(){
            
            $db = PearDatabase::getInstance();
            $title = Zend_Json::decode($_REQUEST['_name']);
            $id = $_REQUEST['pid'];
            $width = $_REQUEST['width'];
            $link = 'index.php?module=Reports&view=ShowWidget&name=Record&pid='.$id;
            
            $sql = "INSERT INTO `vtiger_links`(`tabid`,`linktype`,`linklabel`,`linkurl`, `sequence`, `width`) VALUES (3,'DASHBOARDWIDGET','$title','$link',16,'$width')";
            $result = $db->query($sql);
            $sql = "SELECT linkid FROM `vtiger_links` WHERE `linkurl` = '$link'";
            $result = $db->pquery($sql, array());
            $_r = $db->fetch_array($result);
            self::getButton($_r['linkid']);
        }
        function delete(){
            $db = PearDatabase::getInstance();
            $id = $_REQUEST['pid'];
            $sql = "DELETE FROM `vtiger_links` WHERE  `linkid`= $id";
            $db->query($sql);
            $sql = "DELETE FROM `vtiger_module_dashboard_widgets` WHERE  `linkid`= $id";
            $db->query($sql);
        }
        function getButton($id){
            $html = '<button onclick="Vtiger_Detail_Js.deleteWidgetReports(this)" data-id="'.$id.'" type="button" class="cursorPointer btn btn-success"><strong>Widget</strong></button>';
            echo $html;
            exit;
        }
}