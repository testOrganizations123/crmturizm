<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
global $period;
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once 'config/config.php';
require_once 'vtigerconnector.php';
header('Content-type: application/xml');
$converter = new Array2XML();
$conector = new Processor();
$arra['Potentials'] = $conector->getBron();
$arra['Contacts'] = $conector->getContact();
$arra['Accounts'] = $conector->getAccount();
$arra['Payment'] = $conector->getPayment();
echo $converter->convert($arra);
class Processor {
    public $jobStart;
    public $jobTime;
    public $orders = false;
    public $product = false;
    public $contact = false;
    public $connector;
    public $config;
    public $module = array('Order'=>false, 'Product'=>false, 'Contact'=>false);
    
    function __construct() {
        global $period;
        $this->jobStart = time();
        $this->config = new Vtigersync_Config_Config();
        $this->config->username = $_GET['user'];
        $this->config->user_access_key = $_GET['key'];
        $period = explode(",",$_GET['period']);
        if (count($period) ==2){
            $period[0] = date('Y-m-d 00:00:00', strtotime($period[0]));
            $period[1] = date('Y-m-d 23:59:59', strtotime($period[1]));
        }
        else {
            exit();
        }
        $this->connector = new Vtiger_Connector($this->config);
       
       
    }
    
    function getAccount(){
        return $this->connector->doAccount();
    }
    function getContact(){
        return $this->connector->doContact();
    }
     function getBron(){
        return $this->connector->doBron();
    }
     function getPayment(){
        return $this->connector->doPayment();
    }
    function doSync () {
        foreach ($this->module as $moduleName => $value){
            if ($value === true){
                $function = 'checkSync'.$moduleName;
                $this->$function();
            }
        }
       
        
    }
    
  
    
    
}
	
class Array2XML {
     
    private $writer;
    private $version = '1.0';
    private $encoding = 'UTF-8';
    private $rootName = 'root';
     
 
    function __construct() {
        $this->writer = new XMLWriter();
    }
     
    public function convert($data) {
        $this->writer->openMemory();
        $this->writer->startDocument($this->version, $this->encoding);
        $this->writer->startElement($this->rootName);
        if (is_array($data)) {
            $this->getXML($data);
        }
        $this->writer->endElement();
        return $this->writer->outputMemory();
    }
    public function setVersion($version) {
        $this->version = $version;
    }
    public function setEncoding($encoding) {
        $this->encoding = $encoding;
    }
    public function setRootName($rootName) {
        $this->rootName = $rootName;
    }
    private function getXML($data) {
        foreach ($data as $key => $val) {
            if (is_numeric($key)) {
                $key = 'key'.$key;
            }
            if (is_array($val)) {
                $this->writer->startElement($key);
                $this->getXML($val);
                $this->writer->endElement();
            }
            else {
                $this->writer->writeElement($key, $val);
            }
        }
    }
}