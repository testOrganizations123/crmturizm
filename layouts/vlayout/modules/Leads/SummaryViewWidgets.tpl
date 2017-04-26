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
		<div class="{if $READONLY neq 1}span7{else}span12{/if}">
			<div class="summaryView row-fluid">
                            <div class="recordDetails">
		<table class="summary-table" style="width:100%;">
	<tbody>
	{foreach item=FIELD_MODEL key=FIELD_NAME from=$SUMMARY_RECORD_STRUCTURE['SUMMARY_FIELDS']}
		{if $FIELD_MODEL->get('name') neq 'modifiedtime' && $FIELD_MODEL->get('name') neq 'createdtime'}
			<tr class="summaryViewEntries">
				<td class="fieldLabel" style="width:35%"><label class="muted">{vtranslate($FIELD_MODEL->get('label'),$MODULE_NAME)}</label></td>
				<td class="fieldValue" style="width:65%">
                    <div class="row-fluid">
                        {* SalesPlatform.ru begin *}
                        <span class="value" {if $FIELD_MODEL->get('uitype') eq '19' or $FIELD_MODEL->get('uitype') eq '20' or $FIELD_MODEL->get('uitype') eq '21'}style="word-wrap: break-word;"{/if}>
                        {*<span class="value" {if $FIELD_MODEL->get('uitype') eq '19' or $FIELD_MODEL->get('uitype') eq '20' or $FIELD_MODEL->get('uitype') eq '21'}style="word-wrap: break-word;white-space:pre-wrap;"{/if}>*}
                        {* SalesPlatform.ru end *}
                            {if $FIELD_NAME eq 'checks'  and $TYPEUSER eq 'owner' and $ERRORIN}
                                {$ERRORIN[0].description}<br />
                                    {foreach item=ERROR from=$ERRORIN }

										<b>{$ERROR.messageDisplay[0].name}</b>: <i>{$ERROR.messageDisplay[0].message}</i><br />
									{/foreach}
                                      <span class="pull-right"><a ><a onclick="foulFix()">Исправить</a></span>
							{else if $FIELD_NAME eq 'checks' and  $TYPEUSER eq 'smowner'}

 {$ERRORIN[0][0].description}<br />
								 	{foreach item=ERROR from=$ERRORIN[0] }
										<b>{$ERROR.messageDisplay[0].name}</b>: <i>{$ERROR.messageDisplay[0].message}</i><br />
									{/foreach}

                                 <span class="pull-right"><a ><a onclick="foulReady()">Замечание</a></span>
							{else if $FIELD_NAME eq 'checks' and $TYPEUSER eq 'smcreator'}
 {$ERRORIN[0][0].description}<br />

                                {foreach item=ERROR from=$ERRORIN[0] }
									<b>{$ERROR.messageDisplay[0].name}</b>: <i>{$ERROR.messageDisplay[0].message}</i><br />
                                {/foreach}


							{else if $FIELD_NAME eq 'checks'}
								Нет
                            {else}
                            {include file=$FIELD_MODEL->getUITypeModel()->getDetailViewTemplateName()|@vtemplate_path FIELD_MODEL=$FIELD_MODEL USER_MODEL=$USER_MODEL MODULE=$MODULE_NAME RECORD=$RECORD}
                            {/if}
</span>
                        {if $FIELD_MODEL->isEditable() eq 'true' && ($FIELD_MODEL->getFieldDataType()!=Vtiger_Field_Model::REFERENCE_TYPE) && $IS_AJAX_ENABLED && $FIELD_MODEL->isAjaxEditable() eq 'true' && $FIELD_MODEL->get('uitype') neq 69 && $READONLY eq 0}
                           {if ($FIELD_NAME eq 'rating' and $FIELD_MODEL->get('fieldvalue') eq 'Скидочник') or ($FIELD_NAME eq 'leadstatus' and trim($FIELD_MODEL->get('fieldvalue')) eq 'Готов купить тур') }
                                                 {assign var=ADDTEXTINFO value='При приезде туриста повторно, следует идти по скрипту "работа с туристом-скидочником с шага "Готов купить тур"'}
                                                 {assign var=LinkScript value=466383}
                                                 {else if ($FIELD_NAME eq 'leadstatus' and trim($FIELD_MODEL->get('fieldvalue')) eq 'в другом агентстве дешевле')} 
                                                     {assign var=ADDTEXTINFO value='Переход на скрипт "а в другом агентстве дешевле" - узнайте цену (исх)"'}
                                                 {assign var=LinkScript value=176}
                                                  {else if ($FIELD_NAME eq 'leadstatus' and trim($FIELD_MODEL->get('fieldvalue')) eq 'Контекст')} 
                                                     {assign var=ADDTEXTINFO value='Переход на скрипт  "Выберите контекст (исх)"'}
                                                 {assign var=LinkScript value=195}
                                                  {else if $FIELD_NAME eq 'checks'} 
                                                      {if $FIELD_MODEL->get('fieldvalue') eq 1}
														  {if $TYPEUSER eq 'owner' and $ERRORIN}

                                                      {/if}
														  {/if}
                                                 {else}
                            <span class="hide edit">
                                {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE_NAME) FIELD_MODEL=$FIELD_MODEL USER_MODEL=$USER_MODEL MODULE=$MODULE_NAME}
                                {if $FIELD_MODEL->getFieldDataType() eq 'multipicklist'}
                                    <input type="hidden" class="fieldname" value="{$FIELD_MODEL->get('name')}[]" data-prev-value="{$FIELD_MODEL->getDisplayValue($FIELD_MODEL->get('fieldvalue'))}" />
                                {else}
                                    <input type="hidden" class="fieldname" value="{$FIELD_MODEL->get('name')}" data-prev-value='{$FIELD_MODEL->get('fieldvalue')}' />
                                {/if}
                            </span>
                            <span class="summaryViewEdit cursorPointer pull-right">
                                &nbsp;<i class="icon-pencil" title="{vtranslate('LBL_EDIT',$MODULE_NAME)}"></i>
                            </span>
                            {/if}
                        {/if}
                    </div>
				</td>
			</tr>
		{/if}
	{/foreach}
	</tbody>
</table>
<hr>
<div class="row-fluid">
	<div class="span4 toggleViewByMode">
             {if $READONLY eq 0 }
		{assign var="CURRENT_VIEW" value="full"}
		{assign var="CURRENT_MODE_LABEL" value="{vtranslate('LBL_COMPLETE_DETAILS',{$MODULE_NAME})}"}
		<button type="button" class="btn changeDetailViewMode cursorPointer"><strong>{vtranslate('LBL_SHOW_FULL_DETAILS',$MODULE_NAME)}</strong></button>
		{assign var="FULL_MODE_URL" value={$RECORD->getDetailViewUrl()|cat:'&mode=showDetailViewByMode&requestMode=full'} }
		<input type="hidden" name="viewMode" value="{$CURRENT_VIEW}" data-nextviewname="full" data-currentviewlabel="{$CURRENT_MODE_LABEL}"
			data-full-url="{$FULL_MODE_URL}"  />
                {/if}
	</div>
	<div class="span8">
		<div class="pull-right">
			<div>
				<p>
					<small>
						{vtranslate('LBL_CREATED_ON',$MODULE_NAME)} {Vtiger_Util_Helper::formatDateTimeIntoDayString($RECORD->get('createdtime'))}
					</small>
				</p>
			</div>
			<div>
				<p>
					<small>
						{vtranslate('LBL_MODIFIED_ON',$MODULE_NAME)} {Vtiger_Util_Helper::formatDateTimeIntoDayString($RECORD->get('modifiedtime'))}
					</small>
				</p>
			</div>
		</div>
	</div>
</div>
	</div>
			
			</div>

			{foreach item=DETAIL_VIEW_WIDGET from=$DETAILVIEW_LINKS['DETAILVIEWWIDGET'] name=count}
				{if $smarty.foreach.count.index % 2 == 0}
					<div class="summaryWidgetContainer">
						<div class="widgetContainer_{$smarty.foreach.count.index}" data-url="{$DETAIL_VIEW_WIDGET->getUrl()}" data-name="{$DETAIL_VIEW_WIDGET->getLabel()}">
							<div class="widget_header row-fluid">
								<span class="span8 margin0px"><h4>{vtranslate($DETAIL_VIEW_WIDGET->getLabel(),'Leads')}</h4></span>
							</div>
							<div class="widget_contents">
							</div>
						</div>
					</div>
				{/if}
			{/foreach}
		</div>
               
		<div class="{if $READONLY neq 1}span5{else}hide{/if}" style="overflow: hidden">
                    
			<div id="relatedActivities">
                            {if $ADDTEXTINFO}
                                <div class='summaryWidgetContainer'>
                            <h4 >{$ADDTEXTINFO}</h4>
                            <br />
                            <a class="btn btn-success" href="index.php?module=VDDialogueDesigner&view=RunScript&record={$LinkScript}&leadid={$RECORD->getId()}">Начать скрипт</a>
                            </div>
                            {/if}
                             {if $READONLY neq 1}
				{$RELATED_ACTIVITIES}
                                {/if}
			</div>
                        
			{foreach item=DETAIL_VIEW_WIDGET from=$DETAILVIEW_LINKS['DETAILVIEWWIDGET'] name=count}
				{if $smarty.foreach.count.index % 2 != 0}
					<div class="summaryWidgetContainer">
						<div class="widgetContainer_{$smarty.foreach.count.index}" data-url="{$DETAIL_VIEW_WIDGET->getUrl()}" data-name="{$DETAIL_VIEW_WIDGET->getLabel()}">
							<div class="widget_header row-fluid">
								<span class="span8 margin0px"><h4>{vtranslate($DETAIL_VIEW_WIDGET->getLabel(),$MODULE_NAME)}</h4></span>
							</div>
							<div class="widget_contents">
							</div>
						</div>
					</div>
				{/if}
			{/foreach}
		</div>
	</div>
{/strip}