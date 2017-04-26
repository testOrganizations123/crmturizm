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

<script type="txt/javascript" src="layouts/vlayout/modules/Contacts/resources/Edit.js"></script>
 {assign var=privelege value=explode('::',$USER_MODEL->get('privileges')->get('parent_role_seq'))}
{strip}
<div class='container-fluid editViewContainer'>
	<form class="form-horizontal recordEditView" id="EditView" name="EditView" method="post" action="index.php" enctype="multipart/form-data">
		{assign var=WIDTHTYPE value=$USER_MODEL->get('rowheight')}
		{if !empty($PICKIST_DEPENDENCY_DATASOURCE)}
			<input type="hidden" name="picklistDependency" value='{Vtiger_Util_Helper::toSafeHTML($PICKIST_DEPENDENCY_DATASOURCE)}' />
        {/if}
		{assign var=QUALIFIED_MODULE_NAME value={$MODULE}}
		{assign var=IS_PARENT_EXISTS value=strpos($MODULE,":")}
		{if $IS_PARENT_EXISTS}
			{assign var=SPLITTED_MODULE value=":"|explode:$MODULE}
			<input type="hidden" name="module" value="{$SPLITTED_MODULE[1]}" />
			<input type="hidden" name="parent" value="{$SPLITTED_MODULE[0]}" />
		{else}
			<input type="hidden" name="module" value="{$MODULE}" />
		{/if}
		<input type="hidden" name="action" value="Save" />
		<input id="recordId" type="hidden" name="record" value="{$RECORD_ID}" />
		<input type="hidden" name="defaultCallDuration" value="{$USER_MODEL->get('callduration')}" />
		<input type="hidden" name="defaultOtherEventDuration" value="{$USER_MODEL->get('othereventduration')}" />
		{if $IS_RELATION_OPERATION }
			<input type="hidden" name="sourceModule" value="{$SOURCE_MODULE}" />
			<input type="hidden" name="sourceRecord" value="{$SOURCE_RECORD}" />
			<input type="hidden" name="relationOperation" value="{$IS_RELATION_OPERATION}" />
        {/if}
        
        {* SalesPlatform.ru begin For CheckBeforeSave tag*}
        <input type="hidden" name="mode" value="{$MODE}"/>
        <script>
            var fieldname = new Array({$VALIDATION_DATA_FIELDNAME});
            var fieldlabel = new Array({$VALIDATION_DATA_FIELDLABEL});
            var fielddatatype = new Array({$VALIDATION_DATA_FIELDDATATYPE});
            
            var crmId;
            {if isset($ID) && !empty($ID)}
            crmId = {$ID};
            {/if}
        </script>
        {* SalesPlatform.ru end *}
        
		<div class="contentHeader row-fluid">
		{assign var=SINGLE_MODULE_NAME value='SINGLE_'|cat:$MODULE}
		{if $RECORD_ID neq ''}
			<h3 class="span8 textOverflowEllipsis" title="{vtranslate('LBL_EDITING', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)} {$RECORD_STRUCTURE_MODEL->getRecordName()}">{vtranslate('LBL_EDITING', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)} - {$RECORD_STRUCTURE_MODEL->getRecordName()}</h3>
		{else}
			<h3 class="span8 textOverflowEllipsis">{vtranslate('LBL_CREATING_NEW', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)}</h3>
		{/if}




                <span class="pull-right">
                    {if $ERROREDIT and $ERRORBUTTON}

                   <span> <a style="margin-right: 10px;" class="btn" onclick="foulReady()">Замечание</a></span>

            {else if $ERRORBUTTON}

            <span id="createFoul"><a style="margin-right: 10px;" class="quickCreateModule btn" data-name="FoulList" data-url="index.php?module=FoulList&view=QuickCreateAjax&target={$RECORD_ID}" href="javascript:void(0)">Добавить Замечание</a></span>

            {/if}
                    <button class="btn btn-success" type="submit"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button>
                    <a class="cancelLink" type="reset" onclick="javascript:window.history.back();">{vtranslate('LBL_CANCEL', $MODULE)}</a>
                </span>
            </div>

        {if $TYPEUSER eq 'owner' and $ERRORIN}
        <table class="table table-bordered blockContainer showInlineTable equalSplit">
            <thead>
            <tr>
                <th class="blockHeader" colspan="4">{vtranslate('Замечание', $MODULE)}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="width:50% !important">
        {$ERRORIN[0].description}
                    </td>
                <td style="width:40% !important">
        {foreach item=ERROR from=$ERRORIN }

            <b>{$ERROR.messageDisplay[0].name}</b>: <i>{$ERROR.messageDisplay[0].message}</i><br />
        {/foreach}
                </td>
                <td style="width:10% !important">
        <span class="pull-right"><a ><a onclick="foulFix()">Исправить</a></span>
                </td>
            </tr>
            </tbody>
        </table>
            <br>
        {else if $TYPEUSER eq 'smowner'}
        <table class="table table-bordered blockContainer showInlineTable equalSplit">
            <thead>
            <tr>
                <th class="blockHeader" colspan="4">{vtranslate('Замечание', $MODULE)}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="width:50% !important">
                    {$ERRORIN[0][0].description}<br />
                </td>
                <td style="width:40% !important">

        {foreach item=ERROR from=$ERRORIN[0] }
            <b>{$ERROR.messageDisplay[0].name}</b>: <i>{$ERROR.messageDisplay[0].message}</i><br />
        {/foreach}
                </td>
                <td style="width:10% !important">
                    <span class="pull-right"><a ><a onclick="foulReady()">Передать</a></span>
                </td>
            </tr>
            </tbody>
        </table>
            <br>


        {else if $TYPEUSER eq 'smcreator'}
        <table class="table table-bordered blockContainer showInlineTable equalSplit">
            <thead>
            <tr>
                <th class="blockHeader" colspan="4">{vtranslate('Замечание', $MODULE)}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="width:50% !important">
                    {$ERRORIN[0][0].description}<br />
                </td>
                <td style="width:40% !important">

        {foreach item=ERROR from=$ERRORIN[0] }
            <b>{$ERROR.messageDisplay[0].name}</b>: <i>{$ERROR.messageDisplay[0].message}</i><br />
        {/foreach}
                </td>
                <td style="width:10% !important">
                    <span class="pull-right"><a ><a onclick="foulReady()">Передать</a></span>
                </td>
            </tr>
            </tbody>
        </table>
            <br>


        {/if}
            {assign var=iblock value=0}
            {assign var=opportunity_type value=""}
            {foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$RECORD_STRUCTURE name="EditViewBlockLevelLoop"}
            {if $opportunity_type eq 'Индивидуальный Тур'}{continue}{/if}
            {if $BLOCK_LABEL eq 'indtur'}{continue}{/if}
            {if $BLOCK_LABEL eq 'LBL_DESCRIPTION_INFORMATION'}
                {if $RECORD_ID > 0}
                {include file=vtemplate_path('part/Bookinginfo.tpl',$MODULE)}
                {else}
                    <input id="dataDogovora" value="{date('Y-m-d H:i:s')}" type="hidden" />
                {/if}
                {continue}
            {/if}
            
                {if $iblock eq 1}
                
            {/if}
            {assign var=iblock value=$iblock+1}
            {if $BLOCK_FIELDS|@count lte 0}{continue}{/if}
             {if $BLOCK_LABEL eq 'Туристы'}
                {include file=vtemplate_path('part/ListTur.tpl',$MODULE)}
                {continue}
            {/if} 
            {if $BLOCK_LABEL eq 'Стоимость тура'}
                
                {include file=vtemplate_path('part/TurFields.tpl',$MODULE)}
                
                {continue}
            {/if} 
            {if $BLOCK_LABEL eq 'Доплаты'}
                {include file=vtemplate_path('part/AddPay.tpl',$MODULE)}
                {continue}
            {/if}
            {if $BLOCK_LABEL eq 'turblock'}
                {include file=vtemplate_path('part/Turblock.tpl',$MODULE)}
                {continue}
            {/if}
            {if $BLOCK_LABEL eq 'Оплата туристом'}
                {if $RECORD_ID > 0}
                {include file=vtemplate_path('part/PaymentTourist.tpl',$MODULE)}
                {/if}
                {continue}
            {/if}
            {if $BLOCK_LABEL eq 'Оплата оператору'}
                {if $RECORD_ID > 0}
                {include file=vtemplate_path('part/PaymentOperator.tpl',$MODULE)}
                {/if}
                {continue}
            {/if}
           
            <table class="table table-bordered blockContainer showInlineTable equalSplit">
                <thead>
                    <tr>
                        <th class="blockHeader" colspan="4">{vtranslate($BLOCK_LABEL, $MODULE)}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {assign var=COUNTER value=0}
                        {foreach key=FIELD_NAME item=FIELD_MODEL from=$BLOCK_FIELDS name=blockfields}
                            {if $FIELD_NAME eq "opportunity_type"}
                            {assign var=opportunity_type value=$FIELD_MODEL->get('fieldvalue')}
                            {/if}
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
                        <span class="span10">
                             {if $FIELD_NAME eq 'office'}
                {include file=vtemplate_path('part/office.tpl',$MODULE)}
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
 {if $opportunity_type eq 'Индивидуальный Тур'}
     
           
      {if $RECORD_ID > 0}
                {assign var=BLOCK_FIELDS value=$RECORD_STRUCTURE.LBL_DESCRIPTION_INFORMATION}
                {include file=vtemplate_path('part/Bookinginfo.tpl',$MODULE)}
                 {assign var=BLOCK_FIELDS value=$RECORD_STRUCTURE['Оплата оператору']}
               {assign var=IND_BLOCK value=$RECORD_STRUCTURE['indtur']}
                {include file=vtemplate_path('part/individulal/PaymentOperator.tpl',$MODULE)}
                
           
                {else}
                    <input id="dataDogovora" value="{date('Y-m-d H:i:s')}" type="hidden" />
                {/if}
     {assign var=BLOCK_FIELDS value=$RECORD_STRUCTURE['Туристы']}
      
      {include file=vtemplate_path('part/ListTur.tpl',$MODULE)}
      
                 {assign var=BLOCK_FIELDS value=$RECORD_STRUCTURE['Стоимость тура']}   
                {include file=vtemplate_path('part/individulal/TurFields.tpl',$MODULE)}
                
       {assign var=BLOCK_FIELDS value=$RECORD_STRUCTURE['indtur']}
      
       {include file=vtemplate_path('part/individulal/AllBlock.tpl',$MODULE)}
       
                {if $RECORD_ID > 0}
                {assign var=BLOCK_FIELDS value=$RECORD_STRUCTURE['Оплата туристом']}   
                {include file=vtemplate_path('part/individulal/PaymentTourist.tpl',$MODULE)}
                {/if}
               
            
 {/if}
{/strip}
