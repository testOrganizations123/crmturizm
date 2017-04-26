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
      
        <div class="{if $opportunity_type eq ""}hide{/if} blockShow">
            <div class="cms-group cms-group-expanded addPayContainer">
                <div class="cms-group-label">Доплаты</div>
                <div class="row-fluid" style="margin-top: 25px;">
                    <div class="span4">
                        <span class="help-block">Стоимость каждой доплаты указывается на 1 человека</span>
                    </div>
                </div>
                <div class="row-fluid">
                    {if $opportunity_type eq "" || $opportunity_type eq "Пакетный Тур"} 
                    <div class="span4 {if $opportunity_type eq ""}hide{/if} turPaket addShow">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['visaammount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                                       
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['visacount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(20)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                  
                                </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['chvisaammount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                                       
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['chvisacount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='  form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(20)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                   
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4 {if $opportunity_type eq ""}hide{/if} turPaket addShow">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['inshurout']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                                       
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['inshuroutcount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='form-control   {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(20)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                  
                                </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['inshuradd']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                                       
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['inshuraddcount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='form-control   {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(20)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                   
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4 {if $opportunity_type eq ""}hide{/if} turPaket addShow">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['fuelammount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                                       
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['fuelcount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='form-control   {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}" data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(20)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                  
                                </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    {/if}
                <div class="row-fluid">
                    <div class="span12">
                        <div class="cms-group cms-group-white cms-group-expanded" id="booking_add_booking_services">
                            <div class="cms-group-label">Доп. услуги</div>
                                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addservise']}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                {assign var="ARRAY_FIELD_VALUE" value=explode('#', $FIELD_VALUE)}  
{if count($ARRAY_FIELD_VALUE) > 1} 
     {include file=vtemplate_path('part/addservise_rows.tpl',$MODULE)}
    
{else}        
     {include file=vtemplate_path('part/addservise.tpl',$MODULE)}
{/if}
     
                                                    </div>



                    </div>
                </div>
            </div>
        </div>
    
        
        </div>

{strip}