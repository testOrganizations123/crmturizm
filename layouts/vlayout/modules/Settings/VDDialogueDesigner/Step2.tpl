{*<!--
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: Vordoom.net
 * The Initial Developer of the Original Code is Vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
-->*}
{strip}
	<form name="EditColorList" action="index.php" method="post" id="colorList_step2" class="form-horizontal" >
		<input type="hidden" name="module" value="VDColorList" />
		<input type="hidden" name="action" value="Save" />
		<input type="hidden" name="parent" value="Settings" />
		<input type="hidden" class="step" value="2" />
		<input type="hidden" name="summary" value="{$COLORLIST_MODEL->get('summary')}" />
		<input type="hidden" name="record" value="{$COLORLIST_MODEL->getId()}" />
		<input type="hidden" name="module_name" value="{$COLORLIST_MODEL->get('module_name')}" />
                <input type="hidden" name="related_modules" value="{$SECONDARY_MODULES}" />
        <input type="hidden" name="color" value="{$COLORLIST_MODEL->get('color')}" />
		<input type="hidden" name="conditions" id="advanced_filter" value='' />
        <input type="hidden" id="olderConditions" value='{ZEND_JSON::encode($COLORLIST_MODEL->get('conditions'))}' />
        {assign var=RECORD_STRUCTURE value=array()}
		{assign var=PRIMARY_MODULE_LABEL value=vtranslate($PRIMARY_MODULE, $PRIMARY_MODULE)}
		{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$PRIMARY_MODULE_RECORD_STRUCTURE}
			{assign var=PRIMARY_MODULE_BLOCK_LABEL value=vtranslate($BLOCK_LABEL, $PRIMARY_MODULE)}
			{assign var=key value="$PRIMARY_MODULE_LABEL $PRIMARY_MODULE_BLOCK_LABEL"}
			{if $LINEITEM_FIELD_IN_CALCULATION eq false && $BLOCK_LABEL eq 'LBL_ITEM_DETAILS'}
				{* dont show the line item fields block when Inventory fields are selected for calculations *}
			{else}
				{$RECORD_STRUCTURE[$key] = $BLOCK_FIELDS}
			{/if}
		{/foreach}
		{foreach key=MODULE_LABEL item=SECONDARY_MODULE_RECORD_STRUCTURE from=$SECONDARY_MODULE_RECORD_STRUCTURES}
			{assign var=SECONDARY_MODULE_LABEL value=vtranslate($MODULE_LABEL, $MODULE_LABEL)}
			{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$SECONDARY_MODULE_RECORD_STRUCTURE}
				{assign var=SECONDARY_MODULE_BLOCK_LABEL value=vtranslate($BLOCK_LABEL, $MODULE_LABEL)}
				{assign var=key value="$SECONDARY_MODULE_LABEL $SECONDARY_MODULE_BLOCK_LABEL"}
				{$RECORD_STRUCTURE[$key] = $BLOCK_FIELDS}
			{/foreach}
		{/foreach}
		<div class="row-fluid" style="border:1px solid #ccc;">
				<div id="advanceFilterContainer" {if $IS_FILTER_SAVED_NEW == false} class="zeroOpacity conditionsContainer padding1per" {else} class="conditionsContainer padding1per" {/if}>
					<h5 class="padding-bottom1per"><strong>{vtranslate('LBL_CHOOSE_FILTER_CONDITIONS',$MODULE)}</strong></h5>
					<span class="span10" >
						{include file='AdvanceFilter.tpl'|@vtemplate_path RECORD_STRUCTURE=$RECORD_STRUCTURE ADVANCE_CRITERIA=$SELECTED_ADVANCED_FILTER_FIELDS COLUMNNAME_API=getWorkFlowFilterColumnName}
					</span>
					
				</div>
			</div><br>
			<div class="pull-right">
				<button class="btn btn-danger backStep" type="button"><strong>{vtranslate('LBL_BACK', $QUALIFIED_MODULE)}</strong></button>&nbsp;&nbsp;
				<button class="btn btn-success" type="submit"><strong>{vtranslate('LBL_SAVE', $QUALIFIED_MODULE)}</strong></button>
				<a class="cancelLink" type="reset" onclick="javascript:window.history.back();">{vtranslate('LBL_CANCEL', $QUALIFIED_MODULE)}</a>
			</div>
			<br><br>
	</form>
{/strip}