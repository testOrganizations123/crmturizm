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
    {assign var=FIELD_MODEL value=$IND_BLOCK['payto_vendor']}
                               {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                               {assign var=payto_vendor value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                               {assign var=FIELD_MODEL value=$IND_BLOCK['balance_vendor']}
                               {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                               {assign var=balance_vendor value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
    <div class="">
            <div class="cms-group cms-group-expanded addPayContainer">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['paid_to']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}       
                               <input type="hidden" name="{$FIELD_MODEL->getFieldName()}" value="{$FIELD_VALUE}" />  
                               {assign var=FIELD_MODEL value=$BLOCK_FIELDS['tur_vendor']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}       
                               <input type="hidden" name="{$FIELD_MODEL->getFieldName()}" value="{$FIELD_VALUE}" />  
                <div class="cms-group-label">Оплата оператору</div>
      <div class="row-fluid" style="margin-top: 25px;">
        <div class="span3">
            <div class="form-group">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['pay_to']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('К оплате всего', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                             <div class="input-group"> 
                                
                                <input id="payto_all_vendor" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" value="{$FIELD_VALUE}" readonly/>
                                       <span class="input-group-addon"><i class="fa fa-rub"></i></span></div>
                                       
                                
               
            </div>
        </div>
 <div class="span3">
            <div class="form-group">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['balance_to']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Долг всего', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                <div class="input-group">
                                <input id="balance_all_vendor" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
                                       value="{$FIELD_VALUE}"  readonly /><span class="input-group-addon"><i class="fa fa-rub"></i></span></div>
                                
               
            </div>
        </div>
<div class="span3">
            <div class="form-group form-group-required">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['date_pay_to']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                             <div class="input-group">
                                
                                <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control datepicker" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{if $FIELD_VALUE neq "" and $FIELD_VALUE neq "0000-00-00"}{date('d.m.Y', strtotime($FIELD_VALUE))}{/if}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>   
               
                
            </div>
        </div>
                               <div class="span3">
                        <span class="help-block">Сначала необходимо поставить дату предоплаты, после внесения предоплаты, необходимо изменить на дату следующей предоплаты или полной оплаты</span>
                    </div>
                               <div class='clearfix'></div>
                               {assign var=FIELD_MODEL value=$IND_BLOCK['listturoperator']}
                               {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                               {assign var=turlist value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                              
                               {foreach item=vendor key=operator from=$turlist}
                                    <div class="span3 margin0px">
                                        <div class="form-group">
                                             <label for="payto_vendor_{$vendor}">{$RECORD_STRUCTURE_MODEL->getDisplayOperator($operator)} к оплате</label>
                            
                             <div class="input-group"> 
                                
                                <input id="payto_vendor_{$vendor}" type="text" class="form-control payto_vendor_input"  data-vendor="{$vendor}" name="payto_vendor[{$vendor}]" value="{$payto_vendor.$vendor}" onchange="changePaytoVendor(this,{$vendor});"/>
                                 <input id="payto_vendor_old_{$vendor}" type="hidden" class="form-control"  name="" value="{$payto_vendor.$vendor}" />
                                       <span class="input-group-addon"><i class="fa fa-rub"></i></span></div>
                                        </div></div>
                               <div class="span3">
            <div class="form-group">
                
                            <label for="balance_vendor_{$vendor}">{vtranslate('Долг', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                <div class="input-group">
                                <input id="balance_vendor_{$vendor}" type="text" class="form-control"  name="balance_vendor[{$vendor}]"
                                       value="{$balance_vendor.$vendor}"  readonly /><span class="input-group-addon"><i class="fa fa-rub"></i></span></div>
                                
               
            </div>
        </div>
                                       <div class="span3">
                                           <label >&nbsp;</label>
                                           <button class="btn "  onclick="addPaymentsTo(event, {$vendor})" ><i class="fa fa-plus"></i> Добавить оплату</button>   </div>
                                       <div class="clearfix"></div>
                                       
                               {/foreach}
                               </div>
                                {include file=vtemplate_path('part/individulal/PaymentListOperator.tpl',$MODULE)}
                               
            </div>
    </div>
{strip}