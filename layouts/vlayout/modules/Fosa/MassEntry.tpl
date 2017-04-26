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

            <table class="table table-bordered blockContainer showInlineTable equalSplit">
                <thead>
                    <tr>
                        <th class="blockHeader" colspan="4">{vtranslate($BLOCK_LABEL, $MODULE)}</th>
                    </tr>
                </thead>
                <tbody>
                     {assign var=FIELD_MODEL value=$BLOCK_FIELDS['seria']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                    <tr><td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Серия бланков</td>
                        <td>
                            <div class="row-fluid">
                                <span class="span10">
                                    <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  /></span>
                            </div>
                            </td>
                    
                    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['office']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                    <td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Выдано офису</td>
                        <td>
                            <div class="row-fluid">
                                <span class="span10">
                                    {include file=vtemplate_path('uitypes/office.tpl',$MODULE)}
                                </span>
                            </div>
                            </td>
                    </tr>
                    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['number']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                    <tr><td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Начальный номер</td>
                        <td>
                            <div class="row-fluid">
                                <span class="span10">
                                    <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  /></span>
                            </div>
                            </td>
                    
                    
                    <td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Конечный номер</td>
                        <td>
                            <div class="row-fluid">
                                <span class="span10">
                                   <input style="height: 26px;" id="{$MODULE}_editView_fieldName_number_off" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="number_off"
value="{$FIELD_VALUE}"  />
                                </span>
                            </div>
                            </td>
                    </tr>
                     
</tbody>
</table>
   
{/strip}