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
{literal}
    <style>
        .modelContainer td.fieldLabel{width:120px !important;}
        .modelContainer td.fieldValue{width:203px !important;}
        .modelContainer input.dateField{width:80% !important}
    </style>
    {/literal}
{strip}
{foreach key=index item=jsModel from=$SCRIPTS}
	<script type="{$jsModel->getType()}" src="{$jsModel->getSrc()}"></script>
{/foreach}
	
<div class="modelContainer">
<div class="modal-header contentsBackground">	
    {assign var='userId' value=$RECORD_STRUCTURE['users']->get('fieldvalue')}
    {assign var='targetId' value=$RECORD_STRUCTURE['target']->get('fieldvalue')}
	<button class="close" aria-hidden="true" data-dismiss="modal" type="button" title="{vtranslate('LBL_CLOSE')}">x</button>
    <h3>Замечание для {$RECORD_STRUCTURE['users']->getEditViewDisplayValue($userId)} - {$RECORD_STRUCTURE['target']->getEditViewDisplayValue($targetId)}</h3>
</div>
<form class="form-horizontal recordEditView" name="QuickCreate" method="post" action="index.php">
	{if !empty($PICKIST_DEPENDENCY_DATASOURCE)}
		<input type="hidden" name="picklistDependency" value='{Vtiger_Util_Helper::toSafeHTML($PICKIST_DEPENDENCY_DATASOURCE)}' />
	{/if}
	<input type="hidden" name="module" value="{$MODULE}">
	<input type="hidden" name="action" value="SaveAjax">
        <input type="hidden" name="foul" value="Замечание для {$RECORD_STRUCTURE['users']->getEditViewDisplayValue($userId)} - {$RECORD_STRUCTURE['target']->getEditViewDisplayValue($targetId)}">
	<div class="quickCreateContent">
		<div class="modal-body">
			<table class="massEditTable table table-bordered">
				<tr>
				{assign var=COUNTER value=0}
				{foreach key=FIELD_NAME item=FIELD_MODEL from=$RECORD_STRUCTURE name=blockfields}
                                    {if ($FIELD_NAME eq 'users' && $userId > 0)}
                                        <input name='users' value='{$userId}' type='hidden'/>
                                        {continue}
                                    {else if ($FIELD_NAME eq 'target' && $targetId > 0)}
                                        <input name='target' value='{$targetId}' type='hidden'/>
                                        {continue}
                                    {else if ($FIELD_NAME eq 'date_foul')}
                                        <input name='date_foul' value='{$FIELD_MODEL->get('fieldvalue')}' type='hidden'/>
                                        {continue}
                                    {else if ($FIELD_NAME eq 'assigned_user_id')}

                                        <input name='assigned_user_id' value='{$USER_MODEL->getId()}' type='hidden'/>
                                        {continue}
                                    {else if $FIELD_NAME eq 'checks' or $FIELD_NAME eq 'answer' or $FIELD_NAME eq 'foul' or $FIELD_NAME eq 'point'}
                                        {continue}
                                    {/if}
					{assign var="isReferenceField" value=$FIELD_MODEL->getFieldDataType()}
					{assign var="refrenceList" value=$FIELD_MODEL->getReferenceList()}
					{assign var="refrenceListCount" value=count($refrenceList)}
                    {if $FIELD_MODEL->get('uitype') eq "19"}
                        {if $COUNTER eq '1'}
                            <td></td><td></td></tr><tr>
                            {assign var=COUNTER value=0}
                        {/if}
                    {/if}
					{if $COUNTER eq 2}
						</tr><tr>
						{assign var=COUNTER value=1}
					{else}
						{assign var=COUNTER value=$COUNTER+1}
					{/if}
					<td class='fieldLabel' width="123">
						{if $isReferenceField neq "reference" or $FIELD_MODEL->get('fieldvalue') neq ''}<label class="muted pull-right">{/if}
						{if $FIELD_MODEL->isMandatory() eq true && ($isReferenceField neq "reference" or $FIELD_MODEL->get('fieldvalue') neq '')} <span class="redColor">*</span> {/if}
						{if $isReferenceField eq "reference" and $FIELD_MODEL->get('fieldvalue') eq ''}
							{if $refrenceListCount > 1}
								{assign var="DISPLAYID" value=$FIELD_MODEL->get('fieldvalue')}
								{assign var="REFERENCED_MODULE_STRUCT" value=$FIELD_MODEL->getUITypeModel()->getReferenceModule($DISPLAYID)}
								{if !empty($REFERENCED_MODULE_STRUCT)}
									{assign var="REFERENCED_MODULE_NAME" value=$REFERENCED_MODULE_STRUCT->get('name')}
								{/if}
								<span class="pull-right">
									{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}
									<select style="width: 150px;" class="chzn-select referenceModulesList" id="referenceModulesList">
										<optgroup>
											{foreach key=index item=value from=$refrenceList}
												<option value="{$value}" {if $value eq $REFERENCED_MODULE_NAME} selected {/if} >{vtranslate($value, $value)}</option>
											{/foreach}
										</optgroup>
									</select>
								</span>		
							{else}
								<label class="muted pull-right">{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}{vtranslate($FIELD_MODEL->get('label'), $MODULE)}</label>
							{/if}
						{else}
							{vtranslate($FIELD_MODEL->get('label'), $MODULE)}
						{/if}
					{if $isReferenceField neq "reference"}</label>{/if}
					</td>
					<td class="fieldValue" width="200"{if $FIELD_MODEL->get('uitype') eq '19'} colspan="3" {assign var=COUNTER value=$COUNTER+1} {/if}>
                                            {if $FIELD_NAME eq 'notif'}
                                                {include file='uitypes/PicklistNotif.tpl'|@vtemplate_path:$MODULE}
                                                {else}
						{include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE)}
                                                {/if}
					</td>
				{/foreach}
				</tr>
			</table>
		</div>
	</div>
	<div class="modal-footer quickCreateActions">
		{assign var="EDIT_VIEW_URL" value=$MODULE_MODEL->getCreateRecordUrl()}
			<a class="cancelLink cancelLinkContainer pull-right" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
			<button class="btn btn-success" type="submit"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button>
			
	</div>
</form>
</div>
{/strip}