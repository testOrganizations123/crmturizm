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
 <div class="row-fluid flite" style="margin-top: 25px;">
    <div class="span3">
        <div class="form-group">
             {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservise']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                               
                               
                                
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                                 {if $opportunity_type eq ""}
                                     <select class='form-control hide turPaket addShow  {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if}  data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getServicePickList('Дополнительные услуги')}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                    <select class='form-control  hide ticket addShow {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}_ticket[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if}  data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getServicePickList("Авиа билеты")}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                    <select class='form-control hide rail addShow  {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}_rail[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getServicePickList("ЖД билеты")}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                    
                                     
                              {else if $opportunity_type eq "Пакетный Тур" || $opportunity_type eq "Индивидуальный Тур"}
                                
                                <select class='form-control {if $opportunity_type eq ""}hide{/if} turPaket addShow  {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if}  data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getServicePickList('Дополнительные услуги')}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                           {else if $opportunity_type eq "Авиа билеты"}
                               <select class='form-control  ticket addShow {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}_ticket[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if}  data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getServicePickList("Авиа билеты")}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                            {else if $opportunity_type eq "ЖД билеты"}
                                   <select class='form-control rail addShow  {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}_rail[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if}  data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getServicePickList("ЖД билеты")}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                            {/if}
            
        </div>
    </div>
    
    <div class="span2">
        <div class="form-group">
            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addserviseamount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" data-validation-engine="validate[{if $FIELD_MODEL->isMandatory() eq true} required,{/if}funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" name="{$FIELD_MODEL->getFieldName()}[]"
value="{$FIELD_VALUE}"  />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
        </div>
    </div>
    </div>
{if $opportunity_type eq "" || $opportunity_type eq "Пакетный Тур"}
         {if $opportunity_type eq "Пакетный Тур"}
<div class="span2">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservisecount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='  form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(20)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                   
                                </div>
                                </div>
 {else}
     <div class="span2 turPaket addShow">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservisecount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='  form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(20)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                   
                                </div>
                                </div>
    <div class="span2 rail ticket addShow">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservisetype']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Направление', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='addServiseCalculate  form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    <option value="" {if $FIELD_VALUE eq ''}selected{/if}>Выберите направление</option>
                                    <option value="1" {if $FIELD_VALUE eq 1}selected{/if}>Туда</option>
                                    <option value="2" {if $FIELD_VALUE eq 2}selected{/if}>Обратно</option>
                                    <option value="3" {if $FIELD_VALUE eq 3}selected{/if}>Туда и обратно</option>
                                    
                                    </select>
                                   
                                </div>
                                </div>
    <div class="span4 rail ticket addShow" style="width:305px">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservisepaslist']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=explode(',',$FIELD_MODEL->get('fieldvalue'))}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Пасажиры', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='addServiseCalculate chzn-select form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if} listTurist' multiple name='{$FIELD_MODEL->getFieldName()}[0][]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}' style="width:300px;">
                                   
                                    
                                    
                                    </select>
                                   
                                </div>
                                </div>
 {/if}
 {else}
    <div class="span2 hide">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservisecount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                           
                           
                            <select class='  form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(100)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                               
                                   
                                </div>
                                </div>
    <div class="span2 rail ticket addShow">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservisetype']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Направление', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='  form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if} addServiseCalculate' name='{$FIELD_MODEL->getFieldName()}[]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    <option value="" {if $FIELD_VALUE eq ''}selected{/if}>Выберите направление</option>
                                    <option value="1" {if $FIELD_VALUE eq 1}selected{/if}>Туда</option>
                                    <option value="2" {if $FIELD_VALUE eq 2}selected{/if}>Обратно</option>
                                    <option value="3" {if $FIELD_VALUE eq 3}selected{/if}>Туда и обратно</option>
                                    
                                    </select>
                                   
                                </div>
                                </div>
    <div class="span4 rail ticket addShow" style="width:305px">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservisepaslist']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                                {assign var="FIELD_VALUE" value=explode(',',$FIELD_VALUE[0])}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Пасажиры', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='chzn-select form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if} listTurist addServiseCalculate' multiple name='{$FIELD_MODEL->getFieldName()}[0][]'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}' style="width:300px;">
                                   
                                    {foreach item=KEY from=$FIELD_VALUE}
                                       <option value="{$KEY}" selected >{$KEY}</option>
                                       {/foreach}
                                    
                                    </select>
                                   
                                </div>
                                </div>
 {/if}
    <div class="span1">
        <label>&nbsp;</label>
        <div class="form-group addButtonContainer">
            
            <button class="btn btn-default add-row-fluid" onclick="addFlite(event,this);"><i class="fa fa-plus"></i></button>
        </div>
    </div>
</div>
                
{strip}
