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
                    <!-- Отель -->
                    <div class="span3">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['hotel']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                
                                <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}[]"
value="{$FIELD_VALUE}"  />
                                
                                
                            </div>
                        </div>
                    </div>
<!-- тип номера -->
                    <div class="span3">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['type_room']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var=PICKLIST_VALUES value=$FIELD_MODEL->getPicklistValues()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div id="type_room">
                                {assign var="ARRAY_FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                                {if count($ARRAY_FIELD_VALUE) > 1}
                                    {foreach key=hKey item=VALUE from=$ARRAY_FIELD_VALUE}
                                         <select id="hotel-rooms-{$hKey}" class='chzn-select' name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if}>
                                        <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                        {foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
                                            <option value='{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}' {if trim(decode_html($VALUE)) eq trim($PICKLIST_NAME)} selected {/if}>{$PICKLIST_VALUE}</option>
                                        {/foreach}
                                        </select>
                                        {if $hKey eq 0}  
                                            <button class="btn btn-default add-row-fluid" onclick="addRoomType(event);false;"><i class="fa fa-plus"></i></button>
                                        {else}
                                            <button class="btn btn-default del-row-fluid" onclick="deleteRoomType(event, 'hotel-rooms-{$hKey}')"><i class="fa fa-times"></i></button>
                                        {/if}
                                        {/foreach}
                                {else}
                                <select class='chzn-select' id="hotel-rooms" name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if}>
                        <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                        {foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
                        <option value='{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}' {if trim(decode_html($FIELD_MODEL->get('fieldvalue'))) eq trim($PICKLIST_NAME)} selected {/if}>{$PICKLIST_VALUE}</option>
                        {/foreach}
                        </select>
                               
                                
                                <button class="btn btn-default add-row-fluid" onclick="addRoomType(event);false;"><i class="fa fa-plus"></i></button>
                                {/if}
                            </div>
                        </div>
                                </div>
                                                                     
                        
<!-- Питание -->
                    <div class="span2">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['food']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS}
                                
                               
                            </div>
                        </div>
                    </div>
                                <!-- Размещение -->
                    <div class="span2">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['placement']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                          
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS}
                                
                               
                            </div>
                        </div>
                    </div>
                                <!-- Количество ночей -->
                    <div class="span2">
                        <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['night']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                              
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='  form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   
                                    {foreach item=KEY from=$RECORD_STRUCTURE_MODEL->getCountArrayNumber(40)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                  
                                </div>
                    </div>
                </div>
          
{strip}
