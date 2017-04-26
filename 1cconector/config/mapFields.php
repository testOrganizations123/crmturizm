<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vtiger_fields {
    
    public $Products = array (
        'productname' => 'reference',
        'unit_price' => 'price',
        'cf_753' => 'id_product',
        'discontinued' => 'active',
    );
    public $Inventory = array (
        'productid' => 'crmid',
        'listprice' => 'unit_price_tax_excl',
        'quantity' => 'product_quantity',
        'comment' => 'product_name',
    );
    public $Contacts = array (
        'cf_835' => 'note',
        'cf_841' => 'id_customer',
        'salutationtype' => 'gender',
        'cf_833' => 'group_name',
        'firstname' => 'firstname',
        'lastname' => 'lastname',
        'email' => 'email',
        'cf_805' => 'billing_company',
        'otherstreet' => 'billing_address1',
        'cf_807' => 'billing_address2',
        'otherzip' => 'billing_postcode',
        'othercity' => 'billing_city',
        'cf_809' => 'billing_country',
        'cf_811' => 'billing_dni',
        'cf_813' => 'billing_vat_number',
        'cf_815' => 'billing_phone',
        'cf_817' => 'billing_phone_mobile',
        'cf_823' => 'shiping_company',
        'mailingstreet' => 'shiping_address1',
        'cf_825' => 'shiping_address2',
        'mailingzip' => 'shiping_postcode',
        'mailingcity' => 'shiping_city',
        'cf_827' => 'shiping_country',
        'cf_821' => 'shiping_lastname',
        'cf_819' => 'shiping_firstname',
        'cf_829' => 'shiping_phone',
        'cf_831' => 'shiping_phone_mobile',
        'cf_801' => 'billing_lastname',
        'cf_799' => 'billing_firstname',
        'cf_803' => 'billing_email',
       
    );
   
    public $SalesOrder = array (
        'subject' => 'id_order',
        'contact_id' => 'contact_id',
        'customerno' => 'id_customer',
        'cf_759' => 'reference',
        'sostatus' => 'status',
        'cf_757' => 'shop',
        'cf_775' => 'billing_company',
        'bill_street' => 'billing_address1',
        'cf_779' => 'billing_address2',
        'bill_code' => 'billing_postcode',
        'bill_city' => 'billing_city',
        'bill_pobox' => 'billing_country',
        'cf_787' => 'billing_dni',
        'cf_789' => 'billing_vat_number',
        'cf_795' => 'billing_phone',
        'cf_797' => 'billing_phone_mobile',
        'cf_777' => 'shiping_company',
        'ship_street' => 'shiping_address1',
        'cf_781' => 'shiping_address2',
        'ship_code' => 'shiping_postcode',
        'ship_city' => 'shiping_city',
        'ship_pobox' => 'shiping_country',
        'cf_765' => 'shiping_lastname',
        'cf_769' => 'shiping_firstname',
        'cf_791' => 'shiping_phone',
        'cf_793' => 'shiping_phone_mobile',
        'cf_763' => 'billing_lastname',
        'cf_761' => 'billing_firstname',
        'cf_771' => 'billing_email',
        'hdnS_H_Amount'  => 'total_shipping',
    );
    
}
