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
{assign var=MODULE_NAME value="Calendar"}
<div  class="summaryWidgetContainer">
	<div class="widget_header row-fluid">
		<span class="span8"><h4 class="textOverflowEllipsis">{vtranslate('LBL_TASK',$MODULE_NAME)}</h4></span>
		
	</div>
	<div class="widget_contents">
		{if count($ACTIVITIES) neq '0'}
			{foreach item=RECORD key=KEY from=$ACTIVITIES}
				{assign var=START_DATE value=$RECORD->get('date_start')}
				{assign var=START_TIME value=$RECORD->get('time_start')}
				{assign var=EDITVIEW_PERMITTED value=isPermitted('Calendar', 'EditView', $RECORD->get('crmid'))}
				{assign var=DETAILVIEW_PERMITTED value=isPermitted('Calendar', 'DetailView', $RECORD->get('crmid'))}
				<div class="activityEntries">
					
					<input type="hidden" class="activityId" value="{$RECORD->get('activityid')}"/>
					<div class="row-fluid">
						<span class="span6"><strong title="{Vtiger_Util_Helper::formatDateTimeIntoDayString("$START_DATE $START_TIME")}">{Vtiger_Util_Helper::formatDateIntoStrings($START_DATE, $START_TIME)}</strong></span>
						<div class="activityStatus span6">
						{if $RECORD->get('activitytype') eq 'Task'}
							{assign var=MODULE_NAME value=$RECORD->getModuleName()}
							<input type="hidden" class="activityModule" value="{$RECORD->getModuleName()}"/>
							<input type="hidden" class="activityType" value="{$RECORD->get('activitytype')}"/>
							<div class="pull-right">
								<strong><span class="value">{vtranslate($RECORD->get('status'),$MODULE_NAME)}</span></strong>&nbsp&nbsp;
								<span class="editStatus cursorPointer"><i class="icon-pencil" title="{vtranslate('LBL_EDIT',$MODULE_NAME)}"></i></span>
								<span class="edit hide">
								{assign var=FIELD_MODEL value=$RECORD->getModule()->getField('taskstatus')}
								{assign var=FIELD_VALUE value=$FIELD_MODEL->set('fieldvalue', $RECORD->get('status'))}
								{include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(),$MODULE_NAME) FIELD_MODEL=$FIELD_MODEL USER_MODEL=$USER_MODEL MODULE=$MODULE_NAME OCCUPY_COMPLETE_WIDTH='true'}
								<input type="hidden" class="fieldname" value='{$FIELD_MODEL->get('name')}' data-prev-value='{$FIELD_MODEL->get('fieldvalue')}' />
								</span>
							</div>
						</div>
						{else}
							{assign var=MODULE_NAME value="Events"}
							<input type="hidden" class="activityModule" value="Events"/>
							<input type="hidden" class="activityType" value="{$RECORD->get('activitytype')}"/>
							{if $EDITVIEW_PERMITTED == 'yes'}
								<div class="pull-right">
									<strong><span class="value">{vtranslate($RECORD->get('eventstatus'),$MODULE_NAME)}</span></strong>&nbsp&nbsp;
									
								</div>
							{/if}
						</div>
						{/if}
					</div>
					<div class="summaryViewEntries">
                                            
                                                
						
						{$RECORD->get('subject')}&nbsp;-&nbsp;{$RECORD->get('description')}
						
					</div>
				</div>
                                <hr>
			{/foreach}
                        <form class="form-horizontal" action="index.php" method="POST" name="newEventForm">
                            <input type="hidden" value="{$RECORD->getId()}" name="recordEvents" />
                            <input type="hidden" value="{$RECORDID}" name="record" />
                            <input type="hidden" value="Save" name="action" />
                            <input type="hidden" value="newEvents" name="mode" />
                            <input name="module" value="Leads" type="hidden">
                             <div class="">
                                 <label>Что сделано по предыдущей задаче?<span class="redColor">*</span></label>
                                 <textarea name="oldEvent" required></textarea>
                             </div>
                            <div class="">
                                 <label>Новая задача<span class="redColor">*</span></label>
                                 <textarea name="newEvent" required></textarea>
                             </div>
                            <div class="">
                                 <label>Дата выполнения<span class="redColor">*</span></label>
                                 <div class="row-fluid">
                                     <span class="span10">
                                         <div>
                                             <div class="input-append row-fluid">
                                                 <div class="span12 row-fluid date">
                                                     <input id="Events_editView_fieldName_date_start" required class="dateField" name="date_start" data-date-format="dd.mm.yyyy" value="" data-validation-engine="validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"  type="text">
                                                     <span class="add-on">
                                                         <i class="icon-calendar"></i>
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div>
                                             <div class="input-append time">
                                                 <input required autocomplete="off" id="Events_editView_fieldName_time_start" data-format="24" class="timepicker-default input-small ui-timepicker-input" value="" name="time_start" data-validation-engine="validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" type="text">
                                                 <span class="add-on cursorPointer">
                                                     <i class="icon-time"></i>
                                                 </span>
                                             </div>
                                         </div>
                                     </span>
                                 </div>
                             </div>
                             <div class="">
                                 <label>Приоритет<span class="redColor">*</span></label>
                                 <select required class="chzn-select" name="taskpriority" data-validation-engine="validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" data-selected-value="">
                                     <option value="">Выберите опцию</option>
                                     <option value="High">Высокий</option>
                                     <option value="Kmidle">Средний</option>
                                     <option value="Low">Низкий</option>
                                 </select>
                             </div>
                            <br />
                            <div class="">
                                 <label>Статус<span class="redColor">*</span></label>
                                 <select required class="chzn-select" name="eventstatus" data-validation-engine="validate[ required,funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" >
                                     <option value="">Выберите опцию</option>
                                     <option value="Planned" selected="">В работе</option>
                                     <option value="Отказ">Отказ</option>
                                     <option value="Продажа">Продажа</option>
                                     <option value="Новая">Новая</option>
                                 </select>
                             </div>
                            <br />
                            {if isset($MEET)}
                                    <div class="row-fluid"><span class="span8"><p style="margin: 0" class="textOverflowEllipsis">Встреча в офисе</p></span></div>
                                    <input type="radio" name="meet" value="yes" onchange="changeMeet(1, this)" style="margin-right: 5px; width: 15px; height: 15px" {if $MEET != '0'}checked{/if}>состоялась <span style="display: none; font-size:10px; color: red"> сохранено</span><br>
                                    <input type="radio" name="meet" value="no" onchange="changeMeet(0, this)" style="margin-right: 5px; width: 15px; height: 15px" {if $MEET == '0'}checked{/if}>не состоялась <span style="display: none; font-size:10px; color: red"> сохранено</span><br>
                                <script>
                                    function changeMeet(val, elem){
                                        $.ajax({
                                            type: "GET",
                                            url: "/index.php?module=Leads&view=Detail&record={$RECORDID}&mode=setMeetCrmEntity&meet=" + val,
                                            success: function (data) {
                                                if (data == "success") {
                                                    $($(elem).siblings("span")[1 - val]).css('display','inline-block');
                                                    $($(elem).siblings("span")[val]).css('display','none');
                                                }
                                            },
                                            dataType: "json"
                                        });
                                    }
                                </script>
                            {/if}
                            <br />
                            <input type="submit" value="Сохранить" class="btn btn-success" />
                        </form>
		{else}
			<div class="summaryWidgetContainer">
				<p class="textAlignCenter">{vtranslate('LBL_NO_PENDING_ACTIVITIES',$MODULE_NAME)}</p>
			</div>
		{/if}
		{if $PAGING_MODEL->isNextPageExists()}
			<div class="row-fluid">
				<div class="pull-right">
					<a href="javascript:void(0)" class="moreRecentActivities">{vtranslate('LBL_MORE',$MODULE_NAME)}..</a>
				</div>
			</div>
		{/if}
	</div>
</div>
{/strip}
