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
     
        
    <div class="row-fluid">
        <div class="span6">
            <div class="cms-group cms-group-white">
                <div class="row-fluid">
                    <div class="span8">
                        <div class="form-group has-feedback">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['booking_no']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}" /><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                                                
                        </div>
                        <div class="checkbox">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['book_success']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label>
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS} Бронь подтверждена, турист оповещён
                                
                            </label>
                        </div>
                    </div>
                </div>
            </div>
			
	
			
            <div class="row-fluid">
                <div class="span12">
                    <div class="checkbox">
                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['callback']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label>
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS} {vtranslate($FIELD_MODEL->get('label'), $MODULE)}
                                
                            </label>
                        
                    </div>
                    <div class="checkbox">
                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['book_reset']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label>
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS} {vtranslate($FIELD_MODEL->get('label'), $MODULE)}
                                
                            </label>
                        
                    </div>
                    <div class="checkbox">
                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['dog_reset']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label>
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS} {vtranslate($FIELD_MODEL->get('label'), $MODULE)}
                                
                            </label>
                    </div>
					
					<div class="span7">
					
					<div class="checkbox">
						
					</div>
					
                 
                </div>
					
                </div>
            </div>
        </div>

        <div class="span6">
            <div class="cms-group cms-group-white">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="form-group form-group-required">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['control_data']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                {if $FIELD_VALUE eq '0000-00-00 00:00:00' or $FIELD_VALUE eq ''}
                                   {assign var="FIELD_VALUE" value=''} 
                                    {else }
                                       {assign var="FIELD_VALUE" value=date('d.m.Y H:i', strtotime($FIELD_VALUE))}  
                                       {/if}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                           
                            <div class="input-group">
                                <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control datetimepicker" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                            </div>
                        </div>
                    </div>
                                    </div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="form-group form-group-required">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['description']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                           
                            {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{strip}