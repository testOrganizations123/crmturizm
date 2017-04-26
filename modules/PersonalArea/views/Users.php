<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 12.02.2017
 * Time: 12:05
 */

class PersonalArea_Users_View extends Vtiger_List_View {

    public function process(Vtiger_Request $request) {
        $moduleName = $request->getModule();
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $viewer = $this->getViewer ($request);
        $viewer->assign('MODULE',$moduleName);
        $viewer->assign('MODULE_MODEL',$moduleModel);
        $viewer->view('UsersList.tpl',$moduleName);
    }
}