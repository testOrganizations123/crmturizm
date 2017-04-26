<?php


/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/


class VDPreviewDoc_Setting_Action extends Vtiger_Action_Controller {
    
            public function checkPermission(Vtiger_Request $request) {
                $moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$userPrivilegesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$permission = $userPrivilegesModel->hasModulePermission($moduleModel->getId());

		if(!$permission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
            }
             public function process(Vtiger_Request $request) {
                 $setting = new VDPreviewDoc_Setting();
                 $setting->save($request->get('show'));
             }
}

class VDPreviewDoc_Setting {
    public $setting;
    public $settings;
    private $id;
            function __construct() {
                global $current_user;
                $this->id = $current_user->id;
                if(file_exists('modules/VDPreviewDoc/actions/Settings.php')){
                    include_once 'modules/VDPreviewDoc/actions/Settings.php';
                    $this->settings = new VDPreviewDoc_Settings();
                    $user = 'User'.$this->id;
                    if (isset($this->settings->$user)){
                        $this->setting = $this->settings->$user;
                    }
                    else {
                        $this->setting = 'SHOW';
                    }
                 }
                 else {
                        $this->settings = false;
                        $this->setting = 'SHOW';
                 }
                 
            }
            function save($show){
                if (is_object($this->settings)){
                    $array = (array) $this->settings;
                    $array['User'.$this->id] = $show;
                }
                else {
                    $array = array('User'.$this->id => $show );
                }
                $this->SetSetting($array);
            }
            public function GenerateClass($array){
                $text = "<?php \n";
                $text .= "class VDPreviewDoc_Settings { \n";
                foreach ($array as $key=> $value){
                    $text .= "\tpublic $".$key." = '$value';\n";
                }
                $text .= '}';
                return $text;
            }
            public function SetSetting($array){
                $text = $this->GenerateClass($array);
                $fp = fopen('modules/VDPreviewDoc/actions/Settings.php', 'w');
                $result = fwrite($fp, $text);
                fclose($fp);
                $response = new Vtiger_Response();
                $response->setResult($result);
                $response->emit();
            }
}