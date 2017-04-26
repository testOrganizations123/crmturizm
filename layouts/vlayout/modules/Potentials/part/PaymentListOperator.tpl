{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}

{strip}
    {assign var=LIST_PAYMENT value=$RECORD_STRUCTURE_MODEL->getListPayment($RECORD_ID,'Expense')}
    {if count($LIST_PAYMENT) > 0}
    
   <div class="row-fluid">
                    <div class="span12">
                        <div class="cms-group cms-group-white" id="booking_edit_booking_payment_in">
{assign var=listNumber value = 0}                          
{foreach key=record_payment item=PAYMENT from=$LIST_PAYMENT}
   <div class="row-fluid" id="payment-id-{$record_payment}">
    <div class="span3">
        <div class="form-group form-group-required">
            <label>Оплачено<i class="fa fa-check"></i></label>
            <div class="input-group">
                                <input class="form-control price-amount" readonly value="{number_format($PAYMENT['amount'],2,'.',' ')}" type="text">
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
            </div>
            
        </div>
    </div>

    <div class="span3">
        <div class="form-group form-group-required">
            <label>Дата <i class="fa fa-check"></i></label>
            <div class="input-group">
                                <input id="dp1471166515669" class="form-control" readonly value="{date('d.m.Y',strtotime($PAYMENT['pay_date']))}" type="text">
                                <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
            
        </div>
    </div>

    <div class="span3">
        <div class="form-group form-group-required">
            <label>Форма оплаты <i class="fa fa-check"></i></label>
                        <select class="form-control" readonly >
                            <option value="">{vtranslate($PAYMENT['type_payment'], 'SPPayments')}</option>
                        </select>
           
        </div>
    </div>

    

    <div class="span2">
        <label>&nbsp;</label>
        <div class="form-group ">
             {*if count($privelege) < 6 or $PAYMENT['pay_date'] eq date('Y-m-d')*} 
          <button class="btn btn-default pencil" onclick='editPayment(event,{$record_payment})' title="Редактировать"><i class="fa fa-pencil"></i></button>&nbsp;
            <button class="btn btn-default del-row" onclick='deletePayment(event,{$record_payment})' title="Удалить"><i class="fa fa-times"></i></button>
            {*/if*}          
           
                    </div>
    </div>

   
</div>
   {/foreach}
                                                                            
                                                            
                        </div>
                      
                    </div>
                </div>
        {/if}
{strip}