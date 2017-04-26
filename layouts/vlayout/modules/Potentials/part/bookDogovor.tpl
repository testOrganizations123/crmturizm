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
     
        
                <div class="row-fluid" style="margin-top: 25px;">
        <div class="span2" style="width:12.35%">
            <div class="form-group">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['dogovor']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  readonly />
                                
               
            </div>
        </div>
        
        <div class="span2" style="width:12.35%">
            <div class="form-group form-group-required">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['visa_status']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="visa_status" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                             {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS CLASS="form-control"}
                                
               
                
            </div>
        </div>
        <div id="visa_date_container" class="span2 {if $visa_status eq "Виза не нужна"}hide{/if}" style="width:12.35%">
            <div class="form-group form-group-required">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['visa_date']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            
                             <div class="input-group">
                                
                                <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control datepicker" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>   
               
                
            </div>
        </div>    
        <div class="span2" style="width:12.35%">
            <div class="form-group form-group-required">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['doc_status']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                             {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS CLASS="form-control"}
                                
               
                
            </div>
        </div>
        <div class="span2" style="width:12.35%">
            <div class="form-group form-group-required">
                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['doc_enrtrey']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                             {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS CLASS="form-control"}
                                
               
                
            </div>
        </div>
        <div class="span2" style="width:12.35%">
            <div class="form-group">
                <label>Долг туриста</label>
                <div class="input-group">
                    <input class="form-control" value="" id="balance_dogovor" readonly="" type="text">
                    <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                </div>
            </div>
        </div>
        <div class="span2" style="width:12.35%">
            <div class="form-group">
                <label>Долг оператору</label>
                <div class="input-group">
                    <input class="form-control" value="" id="balance_to_dogovor" readonly="" type="text">
                    <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                </div>
            </div>
        </div>
    </div>
    

{strip}