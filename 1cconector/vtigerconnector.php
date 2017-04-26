<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

require_once '/var/www/moihottur/data/www/crmturizm.ru/1cconector/wsclient.php';
require_once '/var/www/moihottur/data/www/crmturizm.ru/1cconector/config/mapFields.php';
class Vtiger_Connector {

    private $client;
    public $fields;
    
    public function __construct($config) {
        $this->client = new WSClient($config->recipient_url);
        $this->client->doLogin($config->username, $config->user_access_key);
        $this->fields = new Vtiger_fields();
        
    }
    
     /**
     * Check Contact in Vtiger after create or update
     * Return serialise contact, billing and shiping information
     *
     * @param $contact array
     * @param $update bool
     * @return array
     */
    public function doSalesOrder($order,$update){
        $crmid = $this->checkSalesOrder($order['id_order']);
        if ($crmid['id']){ 
           // if ($update)
                $this->updateSalesOrder($order, $crmid);
            return $crmid['id'];
        }
        
        $crmid = $this->createSalesOrder($order);
        
        return $crmid;
    }
     public function doContact(){
        $queryResult = $this->client->doQuery("SELECT * FROM Contacts WHERE contact_no = 'КОНТАКТ_10171'");
        return $queryResult;
    }
     public function doAccount(){
        $queryResult = $this->client->doQuery("SELECT * FROM Accounts WHERE account_no = 'КОНТР_4'");
        return $queryResult;
    }
     public function doPayment(){
        $queryResult = $this->client->doQuery("SELECT * FROM SPPayments WHERE pay_no = '84889'");
        return $queryResult;
    }
    public function doBron(){
        global $period;
        $queryResult = $this->client->doQuery("SELECT * FROM Potentials WHERE booking_no = '3143616'");
        return $queryResult;
    }

    /**
     * Check Contact in Vtiger after create or update
     * Return serialise contact, billing and shiping information
     *
     * @param $contact array
     * @param $update bool
     * @return array
     */
    public function getContact($contact,$update){
        $crmid = $this->checkContact($contact['general']['email']);
        $_contact = $this->structureContact($contact);
        if ($crmid['id']){ 
            $_contact['contact_id'] = $crmid['id'];
            if ($update) $this->updateCRMentity($_contact, $crmid, 'Contacts', $contact['general']['id_customer']);
            return $_contact;
        }
        $crmid = $this->createCRMentity($_contact, 'Contacts', $contact['general']['id_customer']);
        $_contact['contact_id'] = $crmid;
        return $_contact;
    }
    /**
     * Check Product in Vtiger after create or update
     * Return ID product Vtiger
     *
     * @param $product array
     * @param $update bool
     * @return string
     */
    public function getProduct($product,$update){
        $crmid = $this->checkProduct($product['id_product']);
       
        if ($crmid['id']){ 
            if ($update) $this->updateCRMentity($product, $crmid, 'Products', $product['id_product']);
            return $crmid['id'];
        }
        return $this->createCRMentity($product, 'Products', $product['id_product']);
    }
    
     /**
     * Create Entity in Vtiger
     * Return ID if Entity exist in Vtiger
     *
     * @param $data array
     * @param $module string module name CRM
     * @return crmid
     */
    
    public function createCRMentity($data, $module) {
       
        $request = $this->getRequest($data, $this->fields->$module, $id);
        if ($module == 'Products' && !empty($data['upload']) && file_exists($data['upload']) && !empty($data['image_name'])){
            $request['imagename'] = $data['image_name'];
            
            $file = array ($data['image_name']=>$data['upload']);
            $createResult = $this->client->doCreateImage($module, $request, $file);
        }
        $createResult = $this->client->doCreate($module, $request);
        echo '<p>Create '.$module.' '.$id;
        if (isset($createResult['id'])){
            echo ' [DONE] - CRM Id '.$createResult['id'] ."</p>";
        }
        else {
            echo ' [ERROR] ';
            print_r ($createResult);
            echo "</p>";
        }
        return isset($createResult['id']) ? $createResult['id'] : false;
        
    }
    
     /**
     * Create SalesOrder in Vtiger
     * Return ID if SalesOrder exist in Vtiger
     *
     * @param $data array
     * @return crmid
     */
    
    public function createSalesOrder($data) {
       
        $request = $this->getRequest($data, $this->fields->SalesOrder);
        $request['currency_id'] = '21x1';
        $request['productid'] = '14x';
        foreach ($data['inventory'] as $key => $product){
            $request['LineItems'][$key] = $this->getRequest($product, $this->fields->Inventory);
        }
        $request['hdnTaxType'] = 'group';
        //print_r ($request);
        $createResult = $this->client->doCreate('SalesOrder', $request);
        echo '<p>Create SalesOrder '.$data['id_order'];
        if (isset($createResult['id'])){
            echo ' [DONE] - CRM Id '.$createResult['id'] ."</p>";
        }
        else {
            echo ' [ERROR] ';
           
            echo "</p>";
        }
        return isset($createResult['id']) ? $createResult['id'] : false;
        
    }
    
    /**
     * Update Entity in Vtiger
     * Return ID if Entity exist in Vtiger
     *
     * @param $data array
     * @param $crmid string id_table_x_id
     * @param $module string module name CRM
     * @return crmid
     */
    
    public function updateCRMentity($data, $crmid, $module, $id){
        $updateResult = false;
        $request = $this->getRequest($data, $this->fields->$module);
        $request = $this->getRequestCrmid($request, $crmid);
        
        if ($module == 'Products' && !empty($data['upload']) && file_exists($data['upload']) && !empty($data['image_name'])){
            $image_array = explode(',', $crmid['imagename']);
            
            if (!in_array($data['image_name'], $image_array)){
                $request['imagename'] = $data['image_name'];
                $file = array ($data['image_name']=>$data['upload']);
                $updateResult = $this->client->doUpdateImage($request, $file);
            }
        }
        if (!$updateResult){
            $updateResult = $this->client->doUpdate($request);
        }
        echo '<p>Update '.$module.' '.$id;
        if (isset($updateResult['id'])){
            echo ' [DONE] - CRM Id '.$updateResult['id'] ."</p>";
        }
        else {
            echo ' [ERROR] ';
           
            echo "</p>";
        }
    }
    
    /**
     * Update SalesOrder in Vtiger
     * Return ID if SalesOrder exist in Vtiger
     *
     * @param $data array
     * @param $crmid array
     * @return crmid
     */
    public function updateSalesOrder($data, $crmid){
         $request = $this->getRequest($data, $this->fields->SalesOrder);
         $request['id'] = $crmid['id'];
         $request['currency_id'] = '21x1';
        $request['productid'] = $data['inventory'][0]['crmid'];
        foreach ($data['inventory'] as $key => $product){
            $request['LineItems'][$key] = $this->getRequest($product, $this->fields->Inventory);
        }
        $request['hdnTaxType'] = 'group';
        $updateResult = $this->client->doUpdate($request);
       // print_r ($updateResult);
        echo '<p>Update SalesOrder '.$data['id_order'];
        if (isset($updateResult['id'])){
            echo ' [DONE] - CRM Id '.$updateResult['id'] ."</p>";
        }
        else {
            echo ' [ERROR] ';
           
            echo "</p>";
        }
         
    }
    
     /**
     * Delete Entyti in Vtiger
     * Return ID if Product exist in Vtiger
     *
     * @param $crmid
     */
    
    public function deleteCRMentity($crmid) {
       
        $deleteResult = $this->client->doDelete($crmid);
        
    }
    
    /**
     * Generate fields for request
     * Return array fields
     *
     * @param $data array, $fields array ('name_field_vtiger' => 'name_field_presta')
     * @return $result array
     */
    
    public function getRequest($data, $fields){
        $request = array();
        foreach ($fields as $fieldName => $prestaName){
             if (!empty($data[$prestaName])){
                 
                    $request[$fieldName] = strip_tags(htmlspecialchars_decode($data[$prestaName]));
                 
             }
        }
        $request['tax1'] = 22;
        
        return $request;
    }
    
    public function getRequestCrmid($request, $crmid){
        
        foreach ($crmid as $fieldName => $value){
            if (empty($request[$fieldName])){
                $request[$fieldName] = $value;
            }
        }
        return $request;
    }
     /**
     * Return ID if SalesOrder exist in Vtiger
     *
     * @param $id_order
     * @return bool
     */
    
    private function checkSalesOrder($id_order) {
        $queryResult = $this->client->doQuery("SELECT * FROM SalesOrder WHERE subject = '$id_order';");
        return !empty($queryResult[0]) ? $queryResult[0] : false;
    }
    
     /**
     * Return ID if Product exist in Vtiger
     *
     * @param $sku
     * @return bool
     */
    
    private function checkProduct($sku) {
        $queryResult = $this->client->doQuery("SELECT * FROM Products WHERE cf_753 = '$sku';");
        return !empty($queryResult[0]) ? $queryResult[0] : false;
    }
    
    /**
     * Return ID if Contact exist in Vtiger
     *
     * @param $email
     * @return bool
     */
    
    private function checkContact($email) {
        $queryResult = $this->client->doQuery("SELECT * FROM Contacts WHERE email = '$email';");
        return !empty($queryResult[0]) ? $queryResult[0] : false;
    }
    
    /**
     * Return serialise contact, billing and shiping information
     *
     * @param $contact array
     * @return array
     */
    public function structureContact($contact){
        $_contact = array();
        $_contact['note']               = @$contact['general']['note'];
        $_contact['id_customer']        = @$contact['general']['id_customer'];
        $_contact['group_name']         = @$contact['general']['group_name'];
        
        $_contact['firstname']          = @$contact['general']['firstname'];
        $_contact['lastname']           = @$contact['general']['lastname'];
        $_contact['email']              = @$contact['general']['email'];
        $_contact['billing_firstname']  = @$contact['billing']['firstname'];
        $_contact['billing_lastname']   = @$contact['billing']['lastname'];
        $_contact['billing_email']      = @$contact['general']['email'];
        $_contact['billing_company']    = @$contact['billing']['company'];
        $_contact['billing_address1']   = @$contact['billing']['address1'];
        $_contact['billing_address2']   = @$contact['billing']['address2'];
        $_contact['billing_postcode']   = @$contact['billing']['postcode'];
        $_contact['billing_city']       = @$contact['billing']['city'];
        $_contact['billing_country']    = @$contact['billing']['country'];
        $_contact['billing_dni']        = @$contact['billing']['dni'];
        $_contact['billing_vat_number'] = @$contact['billing']['vat_number'];
        $_contact['billing_phone']      = @$contact['billing']['phone'];
        $_contact['billing_phone_mobile'] = @$contact['billing']['phone_mobile'];
        $_contact['shiping_company']    = @$contact['shiping']['company'];
        $_contact['shiping_address1']   = @$contact['shiping']['address1'];
        $_contact['shiping_address2']   = @$contact['shiping']['address2'];
        $_contact['shiping_postcode']   = @$contact['shiping']['postcode'];
        $_contact['shiping_city']       = @$contact['shiping']['city'];
        $_contact['shiping_country']    = @$contact['shiping']['country'];
        $_contact['shiping_lastname']   = @$contact['shiping']['lastname'];
        $_contact['shiping_firstname']  = @$contact['shiping']['firstname'];
        $_contact['shiping_phone']      = @$contact['shiping']['phone'];
        $_contact['shiping_phone_mobile'] = @$contact['shiping']['phone_mobile'];
        
        if ($contact['general']['id_gender'] == 1){
            $_contact['gender'] = "Mr.";
        }
        elseif ($contact['general']['id_gender'] == 2){
            $_contact['gender'] = "Ms.";
        }
        else $_contact['gender'] = "";
        
        return $_contact;
        
    }
}