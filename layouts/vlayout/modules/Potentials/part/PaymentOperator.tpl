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
                <div class="cms-group-label">{$BLOCK_LABEL}</div>
      <div class="row-fluid" style="margin-top: 25px;">
        <div class="span3">
            <div class="form-group">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['pay_to']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                             <div class="input-group"> 
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" value="{$FIELD_VALUE}" />
                                       <span class="input-group-addon"><i class="fa fa-rub"></i></span></div>
                                       <span class="help-block">Сумма редактируется в день полной оплаты туроператору</span>
                                
               
            </div>
        </div>
 <div class="span3">
            <div class="form-group">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['balance_to']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                <div class="input-group">
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
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
                               </div>
                                {include file=vtemplate_path('part/PaymentListOperator.tpl',$MODULE)}
                               <div class="row-fluid">
                                   <div class="span9">
                                       {if $RECORD_ID > 0}
<button class="btn pull-right"  onclick="addPaymentsTo(event)" ><i class="fa fa-plus"></i> Добавить оплату</button>   
{/if}
       
            </div>
    </div>
            </div>
    </div>
{strip}