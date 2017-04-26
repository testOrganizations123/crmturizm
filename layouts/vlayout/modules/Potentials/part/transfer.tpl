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
 <div class="row-fluid {if $opportunity_type eq ""}hide{/if} turPaket addShow">
                    <!-- Трансфер -->
                    <div class="span3">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['transfer']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS}
                                
                               
                            </div>
                        </div>
                    </div>
                                <!-- Транспорт -->
                    <div class="span3">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['transport']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS}
                                
                               
                            </div>
                        </div>
                    </div>
                                <!-- Мед.страховка -->
                    <div class="span3">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['helthinshurence']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS}
                                
                               
                            </div>
                        </div>
                    </div>
                    
                </div>
  
{strip}
