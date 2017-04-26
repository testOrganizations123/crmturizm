<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

class Potentials_Turoption_Action extends Vtiger_Action_Controller{
    function __construct() {
        parent::__construct();
        $this->exposeMethod('hotel');
        $this->exposeMethod('planed');
        $this->exposeMethod('transfer');
        $this->exposeMethod('gid');
        $this->exposeMethod('inshur');
        $this->exposeMethod('other');
        $this->exposeMethod('source');
        $this->exposeMethod('trail');
        $this->exposeMethod('getForms');
    }
    public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$record = $request->get('record');

		if(!Users_Privileges_Model::isPermitted($moduleName, 'Save', $record)) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
	}
    public function process(Vtiger_Request $request) {
       $mode = $request->getMode();
		if(!empty($mode) && $this->isMethodExposed($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
    }
    public function hotel(Vtiger_Request $request){
       $index = $request->get('index') + 1;
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $recordModel = Vtiger_Record_Model::getCleanInstance('Potentials');
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
        
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $view->assign('index', $index);
       
        $view->view('part/individulal/Hotel.tpl', 'Potentials');
    }
     public function planed(Vtiger_Request $request){
       $index = $request->get('index') + 1;
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $recordModel = Vtiger_Record_Model::getCleanInstance('Potentials');
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
        
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $view->assign('index', $index);
       
        $view->view('part/individulal/Planed.tpl', 'Potentials');
    }
    public function transfer(Vtiger_Request $request){
        $index = $request->get('index') + 1;
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $recordModel = Vtiger_Record_Model::getCleanInstance('Potentials');
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
        
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $view->assign('index', $index);
       
        $view->view('part/individulal/Transfer.tpl', 'Potentials');
    }
    public function gid(Vtiger_Request $request){
        $index = $request->get('index') + 1;
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $recordModel = Vtiger_Record_Model::getCleanInstance('Potentials');
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
        
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $view->assign('index', $index);
       
        $view->view('part/individulal/Gid.tpl', 'Potentials');
    }
    public function inshur(Vtiger_Request $request){
        $index = $request->get('index') + 1;
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $recordModel = Vtiger_Record_Model::getCleanInstance('Potentials');
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
        
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $view->assign('index', $index);
       
        $view->view('part/individulal/Inshure.tpl', 'Potentials');
    }
    public function other(Vtiger_Request $request){
        $index = $request->get('index') + 1;
       
       
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $recordModel = Vtiger_Record_Model::getCleanInstance('Potentials');
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
        
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $view->assign('index', $index);
       
        $view->view('part/individulal/Other.tpl', 'Potentials');
    }
    public function trail(Vtiger_Request $request){
       $index = $request->get('index') + 1;
        $moduleModel = Vtiger_Module_Model::getInstance('Potentials');
        $recordModel = Vtiger_Record_Model::getCleanInstance('Potentials');
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
        
        $view = new Vtiger_Viewer();
        $view->assign('MODULE_MODEL', $moduleModel);
        $view->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $view->assign('index', $index);
       
        $view->view('part/individulal/Trail.tpl', 'Potentials');
    }
}