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
<div class='container-fluid editViewContainer'>
	<form class="form-horizontal recordEditView" id="EditView" name="EditView" method="post" action="index.php" enctype="multipart/form-data">
		{assign var=WIDTHTYPE value=$USER_MODEL->get('rowheight')}
		
		{assign var=QUALIFIED_MODULE_NAME value={$MODULE}}
		<input type="hidden" name="module" value="{$MODULE}" />
		
		<input type="hidden" name="action" value="Save" />
		<input type="hidden" name="record" value="{$RECORD_ID}" />
		<input type="hidden" name="defaultCallDuration" value="{$USER_MODEL->get('callduration')}" />
		<input type="hidden" name="defaultOtherEventDuration" value="{$USER_MODEL->get('othereventduration')}" />
		
        
        {* SalesPlatform.ru begin For CheckBeforeSave tag*}
        <input type="hidden" name="mode" value="Script"/>
        <script>
            var fieldname = new Array();
            var fieldlabel = new Array();
            var fielddatatype = new Array();
            
            var crmId;
            
        </script>
        {* SalesPlatform.ru end *}
        
		<div class="contentHeader row-fluid">
		{assign var=SINGLE_MODULE_NAME value='SINGLE_'|cat:$MODULE}
		{if $RECORD_ID neq ''}
			<h3 class="span8 textOverflowEllipsis" title="{vtranslate('LBL_EDITING', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)}" >{vtranslate('LBL_EDITING', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)} - {$RECORD_MODEL->get('subject')}</h3>
		{else}
			<h3 class="span8 textOverflowEllipsis">{vtranslate('LBL_CREATING_NEW', $MODULE)} {vtranslate($SINGLE_MODULE_NAME, $MODULE)}</h3>
		{/if}
			<span class="pull-right">
                
                <span class="pull-right">
                    <button class="btn btn-success" type="submit"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button>
                    <a class="cancelLink" type="reset" onclick="javascript:window.history.back();">{vtranslate('LBL_CANCEL', $MODULE)}</a>
                </span>
            </div>
            
            <table class="table table-bordered blockContainer showInlineTable equalSplit">
                <thead>
                    <tr>
                        <th class="blockHeader" colspan="4">{vtranslate('Information', $MODULE)}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                            <td class="fieldLabel ">
                            
                                <label class="muted pull-right marginRight10px">{vtranslate('Name Script', $MODULE)} <span class="redColor">*</span></label>
                            
                            </td>
            
                <td class="fieldValue " >
                    <div class="row-fluid">
                        <span class="span10">
                            <input name="subject" required value="{$RECORD_MODEL->get('subject')}" />
                        </span>
                    </div>
                </td>
                <td class="fieldLabel ">
                            
                                <label class="muted pull-right marginRight10px">{vtranslate('Menu Active', $MODULE)} </label>
                            
                            </td>
            
                <td class="fieldValue " >
                    <div class="row-fluid">
                        <span class="span10">
                            <input type="checkbox" name="menu_active" value="1" {if $RECORD_MODEL->get('menu_active') eq 1} checked {/if}/>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                        
                <td class="fieldLabel " colspan="1">
                            
                                <label class="muted pull-right marginRight10px">{vtranslate('Description', $MODULE)}</label>
                            
                            </td>
            
                <td class="fieldValue " colspan="3">
                    <div class="row-fluid">
                        <span class="span10">
                            <textarea name="description">{$RECORD_MODEL->get('description')}</textarea>
                        </span>
                    </div>
                </td>
            </tr>
		
</tbody>
</table>
<br>

{/strip}