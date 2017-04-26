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

<div class='container-fluid editViewContainer modelContainer' id="contactForm">
	<form class="form-horizontal recordEditView" id="contactCreate" name="QuickCreate" method="post" action="index.php">
		{assign var=WIDTHTYPE value=$USER_MODEL->get('rowheight')}
		{if !empty($PICKIST_DEPENDENCY_DATASOURCE)}
			<input type="hidden" name="picklistDependency" value='{Vtiger_Util_Helper::toSafeHTML($PICKIST_DEPENDENCY_DATASOURCE)}' />
        {/if}
		
			<input type="hidden" name="module" value="{$MODULE}" />
		<input type="hidden" name="action" value="SaveAjax" />
		<input type="hidden" name="record" value="{$ID}">
        
		<div class="contentHeader row-fluid">
		{assign var=SINGLE_MODULE_NAME value='SINGLE_'|cat:$MODULE}
		{if $ID neq ''}
			<h3 class="span8 textOverflowEllipsis" title="{vtranslate('LBL_EDITING', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)} {$RECORD_STRUCTURE_MODEL->getRecordName()}">{vtranslate('LBL_EDITING', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)} - {$RECORD_STRUCTURE_MODEL->getRecordName()}</h3>
		{else}
			<h3 class="span8 textOverflowEllipsis">{vtranslate('LBL_CREATING_NEW', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)}</h3><button class="close" aria-hidden="true" data-dismiss="modal" type="button" title="{vtranslate('LBL_CLOSE')}">x</button>
		{/if}
			
               
            </div>
                <div style="overflow-y: scroll; height:500px;">
                    {if $ID > 0}
                        <input type="hidden" name="SaveAll" value="ALL">
                    {/if}
            {foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$RECORD_STRUCTURE name="EditViewBlockLevelLoop"}
            {if $BLOCK_FIELDS|@count lte 0}{continue}{/if}
            <table class="table table-bordered blockContainer showInlineTable equalSplit {if $BLOCK_LABEL eq "Системная информация" or $BLOCK_LABEL eq "LBL_CUSTOMER_PORTAL_INFORMATION" or $BLOCK_LABEL eq "LBL_DESCRIPTION_INFORMATION" or $BLOCK_LABEL eq "LBL_IMAGE_INFORMATION" }hide{/if}">
                <thead>
                    <tr>
                        <th class="blockHeader" colspan="4">{vtranslate($BLOCK_LABEL, $MODULE)}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {assign var=COUNTER value=0}
                        {foreach key=FIELD_NAME item=FIELD_MODEL from=$BLOCK_FIELDS name=blockfields}

                            {assign var="isReferenceField" value=$FIELD_MODEL->getFieldDataType()}
                            {if $FIELD_MODEL->get('uitype') eq "20" or $FIELD_MODEL->get('uitype') eq "19"}
                                {if $COUNTER eq '1'}
                                    <td class="{$WIDTHTYPE}"></td><td class="{$WIDTHTYPE}"></td>
                                </tr>
                                <tr>
                                    {assign var=COUNTER value=0}
                                {/if}
                            {/if}
                            {if $COUNTER eq 2}
                            </tr>
                            <tr>
                                {assign var=COUNTER value=1}
                            {else}
                                {assign var=COUNTER value=$COUNTER+1}
                            {/if}
                            <td class="fieldLabel {$WIDTHTYPE}">
                            {* SalesPlatform.ru begin *}
                            {if $isReferenceField neq "reference"}<label align="right" class="muted pull-right marginRight10px">{/if}
                            {*{if $isReferenceField neq "reference"}<label class="muted pull-right marginRight10px">{/if}*}
                            {* SalesPlatform.ru end *}
                            {if $FIELD_MODEL->isMandatory() eq true && $isReferenceField neq "reference"} <span class="redColor">*</span> {/if}
                            {if $isReferenceField eq "reference"}
                                {assign var="REFERENCE_LIST" value=$FIELD_MODEL->getReferenceList()}
                                {assign var="REFERENCE_LIST_COUNT" value=count($REFERENCE_LIST)}
                                {if $REFERENCE_LIST_COUNT > 1}
                                    {assign var="DISPLAYID" value=$FIELD_MODEL->get('fieldvalue')}
                                    {assign var="REFERENCED_MODULE_STRUCT" value=$FIELD_MODEL->getUITypeModel()->getReferenceModule($DISPLAYID)}
                                    {if !empty($REFERENCED_MODULE_STRUCT)}
                                        {assign var="REFERENCED_MODULE_NAME" value=$REFERENCED_MODULE_STRUCT->get('name')}
                                    {/if}
                                    <span class="pull-right">
                                    {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}
                                    <select id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->getName()}_dropDown" class="chzn-select referenceModulesList streched" style="width:160px;">
                                        <optgroup>
                                            {foreach key=index item=value from=$REFERENCE_LIST}
                                                <option value="{$value}" {if $value eq $REFERENCED_MODULE_NAME} selected {/if}>{vtranslate($value, $MODULE)}</option>
                                            {/foreach}
                                        </optgroup>
                                    </select>
                                </span>
                            {else}
                                <label class="muted pull-right marginRight10px">{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}{vtranslate($FIELD_MODEL->get('label'), $MODULE)}</label>
                            {/if}
                        {else if $FIELD_MODEL->get('uitype') eq "83"}
                            {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) COUNTER=$COUNTER MODULE=$MODULE}
                        {else}
                            {vtranslate($FIELD_MODEL->get('label'), $MODULE)}
                        {/if}
                    {if $isReferenceField neq "reference"}</label>{/if}
            </td>
            {if $FIELD_MODEL->get('uitype') neq "83"}
                <td class="fieldValue {$WIDTHTYPE}" {if $FIELD_MODEL->get('uitype') eq '19' or $FIELD_MODEL->get('uitype') eq '20'} colspan="3" {assign var=COUNTER value=$COUNTER+1} {/if}>
                    <div class="row-fluid">
                        <span class="span10">{if $FIELD_NAME eq 'typevisa'}
                            <select class='form-control  ' name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getTypeTurist()}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                            {else}
                                
                            {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE) BLOCK_FIELDS=$BLOCK_FIELDS}
                            {/if}
                        </span>
                    </div>
                </td>
            {/if}
            {if $BLOCK_FIELDS|@count eq 1 and $FIELD_MODEL->get('uitype') neq "19" and $FIELD_MODEL->get('uitype') neq "20" and $FIELD_MODEL->get('uitype') neq "30" and $FIELD_MODEL->get('name') neq "recurringtype"}
                <td class="{$WIDTHTYPE}"></td><td class="{$WIDTHTYPE}"></td>
            {/if}
            {if $MODULE eq 'Events' && $BLOCK_LABEL eq 'LBL_EVENT_INFORMATION' && $smarty.foreach.blockfields.last }
                {include file=vtemplate_path('uitypes/FollowUp.tpl',$MODULE) COUNTER=$COUNTER}
            {/if}
        {/foreach}
		{* adding additional column for odd number of fields in a block *}
		{if $BLOCK_FIELDS|@end eq true and $BLOCK_FIELDS|@count neq 1 and $COUNTER eq 1}
			<td class="fieldLabel {$WIDTHTYPE}"></td><td class="{$WIDTHTYPE}"></td>
		{/if}
    </tr>
</tbody>
</table>
<br>
{/foreach}
</div>
    <div class="modal-footer quickCreateActions">
		
			<a class="cancelLink cancelLinkContainer pull-right" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
                        {if $ID > 0}
                         <a class="btn btn-success" onclick="changeAjax({$ID});"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></a>
                        {else}
                            <a class="btn btn-success" onclick="saveAjax();"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></a> 
                    {/if}
                       
			
	</div>
{/strip}
<script>
   
    
    jQuery('.imageHolder').parent('div').remove();
    var script = document.createElement('script');
    script.src = "layouts/vlayout/modules/Contacts/resources/Edit2.js?330";
    document.getElementsByTagName('head')[0].appendChild(script);
   

</script>
<style>
    #ui-datepicker-div{
    z-index:50000 !important
    }
    input.dateField {
    width:150px !important}
</style>