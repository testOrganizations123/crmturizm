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
<input type="hidden" id="view" value="{$VIEW}" />
<input type="hidden" id="pageStartRange" value="{$PAGING_MODEL->getRecordStartRange()}" />
<input type="hidden" id="pageEndRange" value="{$PAGING_MODEL->getRecordEndRange()}" />
<input type="hidden" id="previousPageExist" value="{$PAGING_MODEL->isPrevPageExists()}" />
<input type="hidden" id="nextPageExist" value="{$PAGING_MODEL->isNextPageExists()}" />
<input type="hidden" id="alphabetSearchKey" value= "{$MODULE_MODEL->getAlphabetSearchField()}" />
<input type="hidden" id="Operator" value="{$OPERATOR}" />
<input type="hidden" id="alphabetValue" value="{$ALPHABET_VALUE}" />
<input type="hidden" id="totalCount" value="{$LISTVIEW_COUNT}" />
<input type='hidden' value="{$PAGE_NUMBER}" id='pageNumber'>
<input type='hidden' value="{$PAGING_MODEL->getPageLimit()}" id='pageLimit'>
<input type="hidden" value="{$LISTVIEW_ENTRIES_COUNT}" id="noOfEntries">

{assign var = ALPHABETS_LABEL value = vtranslate('LBL_ALPHABETS', 'Vtiger')}
{assign var = ALPHABETS value = ','|explode:$ALPHABETS_LABEL}


<div id="selectAllMsgDiv" class="alert-block msgDiv noprint">
	<strong><a id="selectAllMsg">{vtranslate('LBL_SELECT_ALL',$MODULE)}&nbsp;{vtranslate($MODULE ,$MODULE)}&nbsp;(<span id="totalRecordsCount"></span>)</a></strong>
</div>
<div id="deSelectAllMsgDiv" class="alert-block msgDiv noprint">
	<strong><a id="deSelectAllMsg">{vtranslate('LBL_DESELECT_ALL_RECORDS',$MODULE)}</a></strong>
</div>

<div class="listViewEntriesDiv ">
	<div class="">
	<input type="hidden" value="{$ORDER_BY}" id="orderBy">
	<input type="hidden" value="{$SORT_ORDER}" id="sortOrder">
	<span class="listViewLoadingImageBlock hide modal noprint" id="loadingListViewModal">
		<img class="listViewLoadingImage" src="{vimage_path('loading.gif')}" alt="no-image" title="{vtranslate('LBL_LOADING', $MODULE)}"/>
		<p class="listViewLoadingMsg">{vtranslate('LBL_LOADING_LISTVIEW_CONTENTS', $MODULE)}........</p>
	</span>
	{assign var=WIDTHTYPE value=$CURRENT_USER_MODEL->get('rowheight')}
	<table class="table table-bordered listViewEntriesTable">
		<thead>
			<tr class="listViewHeaders">
				<th width="1%">
					<input type="hidden" id="listViewEntriesMainCheckBox" />
				</th>
                                <th>Офис</th>
				{foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                    {if $LISTVIEW_HEADER->get('name') eq 'subject' or $LISTVIEW_HEADER->get('name') eq 'parent_id' or $LISTVIEW_HEADER->get('name') eq 'priority' or $LISTVIEW_HEADER->get('name') eq 'created_user_id' or $LISTVIEW_HEADER->get('name') eq 'activitytype'}{continue}{/if}
				<th nowrap {if $LISTVIEW_HEADER@last} {/if}>
                                    {if $LISTVIEW_HEADER->get('label') eq "Modified Time"}
                                        Активность
                                        {else}
					<a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="{if $COLUMN_NAME eq $LISTVIEW_HEADER->get('column')}{$NEXT_SORT_ORDER}{else}ASC{/if}" data-columnname="{$LISTVIEW_HEADER->get('column')}">{vtranslate($LISTVIEW_HEADER->get('label'), $MODULE)}
						&nbsp;&nbsp;{if $COLUMN_NAME eq $LISTVIEW_HEADER->get('column')}<img class="{$SORT_IMAGE} icon-white">{/if}</a>
                                        {/if}
                                        </th>
				{/foreach}
                                <th nowrap colspan="1">
                                    Телефон
                                    </th>
                                    <th nowrap colspan="2">
                                    Источник
                                    </th>
			</tr>
		</thead>
        <tr>
            <td></td>
             <td style="width:150px;">
               
                {include file=vtemplate_path('uitypes/searchoffice.tpl',$MODULE)
                    FIELD_MODEL= $LISTVIEW_HEADERS['assigned_user_id'] USER_MODEL=$CURRENT_USER_MODEL }
             </td>
         {foreach key=KEY item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
             {if $LISTVIEW_HEADER->get('name') eq 'subject' or $LISTVIEW_HEADER->get('name') eq 'parent_id' or $LISTVIEW_HEADER->get('name') eq 'priority' or $LISTVIEW_HEADER->get('name') eq 'created_user_id' or $LISTVIEW_HEADER->get('name') eq 'activitytype'}{continue}{/if}
             <td>
               {assign var=FIELD_UI_TYPE_MODEL value=$LISTVIEW_HEADER->getUITypeModel()}     
                {include file=vtemplate_path($FIELD_UI_TYPE_MODEL->getListSearchTemplateName(),$MODULE) 
                    FIELD_MODEL= $LISTVIEW_HEADER SEARCH_INFO=$SEARCH_DETAILS[$LISTVIEW_HEADER->getName()] USER_MODEL=$CURRENT_USER_MODEL}
             </td>
         {/foreach}
         <td><div class="row-fluid"><input name="mobile" class="span9 listSearchContributor phone" value="{$MOBILE}" {/strip}{literal}data-fieldinfo='{"mandatory":true,"presence":true,"quickcreate":true,"masseditable":true,"defaultvalue":false,"type":"phone","name":"mobile","label":"Телефон"}'{/literal}{strip} type="text"></div></td>
         <td>{include file=vtemplate_path('uitypes/searchsourse.tpl',$MODULE)}</td>
         <td> 
             <!-- SalesPlatform.ru begin add locale -->
             <button data-trigger="listSearch">{vtranslate('LBL_SEARCH', $MODULE)}</button>
             <!-- <button data-trigger="listSearch">Search</button> -->
             <!-- SalesPlatform.ru end -->
         </td>
        </tr>
		
	</table>

{assign var=EXPRESS value=$LIST_VIEW_MODEL->getListExpressTask($MOBILE,$OFFICE)}
{if count($EXPRESS) neq 0 }
    <div class="page-header" style="margin-bottom: 0;">
                                         <h3>Экспресс заявки</h3>
                        </div>
    <table class="table table-hover table-responsive table-striped">
                                    <thead>
                                    <tr>
                                        <th>Дата создания</th>
                                        <th>Имя туриста</th>
                                        <th>Телефон туриста</th>
                                        <th>Задача</th> 
                                        <th>Менеджер</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                               {foreach item=LISTVIEW_ENTRY from=$EXPRESS name=listview}
						
													
                                                                           {assign var=Ndate value=DateTimeField::convertToUserTimeZone($LISTVIEW_ENTRY->rawData.createdtime)}
									<tr class="top error">
										<td>{$Ndate->format('d.m.Y H:i')}</td>
										<td>{$LISTVIEW_ENTRY->rawData.cf_1115}</td>
										<td>{$LISTVIEW_ENTRY->rawData.cf_1117}</td>
										<td>{$LISTVIEW_ENTRY->rawData.description} </td>
                                                                                <td>{$LISTVIEW_ENTRY->rawData.name} </td>
										<td><a href="index.php?module=Leads&view=Edit&express={$LISTVIEW_ENTRY->getId()}&mobile={htmlspecialchars(str_replace("+7", "",$LISTVIEW_ENTRY->rawData.cf_1117))}&firstname={htmlspecialchars($LISTVIEW_ENTRY->rawData.cf_1115)}" class="btn btn-xs btn-warning pull-right" title="Позвонить"><i class="fa fa-phone"></i></a>
										</td>
									</tr>
						
						{/foreach}	
												
								</tbody>
							</table>
    {/if}
{assign var=ListCall value=$LIST_VIEW_MODEL->getListCall($MOBILE,$OFFICE)}
{if count($ListCall) > 0}
 <div class="page-header" style="margin-bottom: 0;">
                                         <h3>Прилетевшие туристы <span class='redColor'>({count($ListCall)}) <small> </span> <a onclick='jQuery("#obzbon").toggle();'>показать</a></small></h3> 
                        </div>
    <table class="table table-hover table-responsive table-striped hide" id='obzbon'>
                                    <thead>
                                    <tr>
                                        <th>Прилетел</th>
                                        <th>ФИО туриста</th>
                                        <th>Телефон</th>
                                        <th><i class="fa fa-phone"></i></th>
                                        <th>Место отдыха</th>  
                                        <th>Отель</th>
                                        <th>Оператор</th>
                                        <th>Кол-во ночей</th>
                                       
                                        <th>Стоимость тура</th>
                                        <th>Ответственный</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                         {foreach item=LISTVIEW_ENTRY from=$ListCall name=listview}
						
													
							
									<tr class="top error">
										<td>{date('d.m.Y H:i',strtotime($LISTVIEW_ENTRY->rawData.cf_1219))}</td>
										<td>{$LISTVIEW_ENTRY->rawData.lastname} {$LISTVIEW_ENTRY->rawData.firstname} {$LISTVIEW_ENTRY->rawData.midlename}</td>
                                                                                <td>{$LISTVIEW_ENTRY->rawData.mobile}</td>
                                                                                <td>{if $LISTVIEW_ENTRY->rawData.cf_1454 > 0}{$LISTVIEW_ENTRY->rawData.cf_1454}{/if}</td>
										<td>{$LISTVIEW_ENTRY->rawData['country_name']},<br>{$LISTVIEW_ENTRY->rawData['resort']}</td>
										<td>{$LISTVIEW_ENTRY->rawData.cf_1193} </td>
                                                                                <td>{$LISTVIEW_ENTRY->rawData.turoperator_name} </td>
                                                                                <td>{$LISTVIEW_ENTRY->rawData.cf_1201} </td>
                                                                                <td>{number_format($LISTVIEW_ENTRY->rawData.amount,2,",", " ")} </td>
                                                                                <td>{$LISTVIEW_ENTRY->get('assigned_user_id')}</td>
										<td><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=55&express={$LISTVIEW_ENTRY->getId()}&potentialid={$LISTVIEW_ENTRY->rawData.potentialid}" class="btn btn-xs btn-warning pull-right" title="Позвонить"><i class="fa fa-phone"></i></a>
										</td>
									</tr>
						
						{/foreach}	
                                    </tbody>
    </table>

 {/if}
        {assign var=ListErrors value=$LIST_VIEW_MODEL->getListErrors()}
        {assign var=ErrorKeys value=array_keys($ListErrors)}
        {if count($ListErrors) > 0}
            <div class="page-header" style="margin-bottom: 0;">
                                         <h3>Замечания:</h3>
                <table class="table-hover table table-bordered listViewEntriesTable">
                    <thead>
                    <tr>
                        <th >Дата</th>
                        <th width="15%">Модуль</th>

                        <th>Нарушение</th>

                        <th width='80px'>Статус</th>
                        <th width='180px'>Ответственный</th>
                        <th></th>



                    </tr>
                    </thead>
                    <tbody>
                    {foreach item=LISTVIEW_ENTRY from=$ListErrors name=listview}

                    <tr class="top error">

                        <td>

                            {if $LISTVIEW_ENTRY.due_date neq $DATE }
                                {date("d.m.y", strtotime($LISTVIEW_ENTRY.due_date))}
                                <br />
                            {/if}

                            {date("H:i", strtotime($LISTVIEW_ENTRY.time_end))} <br />
                        </td>
                        <td>
                            <span class="label label-{$LISTVIEW_ENTRY.modulename}">{vtranslate($LISTVIEW_ENTRY.modulename, $LISTVIEW_ENTRY.modulename)}</span>
                            <br> {$LISTVIEW_ENTRY.label_entity}
                            <br><small>от {date('d.m.y', strtotime($LISTVIEW_ENTRY.createdtime))}</small>
                        </td>

                        <td >
                                 {$LISTVIEW_ENTRY.description_foul}

                        </td>

                        <td>

                            <span class="label label-important">
                                 {vtranslate($LISTVIEW_ENTRY.eventstatus,'Calendar')}
                            </span>
                        </td>
                        <td><small>→{$LISTVIEW_ENTRY.notif}<br>Заявка: {$LISTVIEW_ENTRY.owner}</small></small></td>
                        <td class="right nowrap">
                            {if $LISTVIEW_ENTRY.modulename == 'Potentials'}
                                {assign var = view value="Edit"}
                            {else}
                                {assign var = view value="Detail"}
                            {/if}
                            <a href="index.php?module={$LISTVIEW_ENTRY.modulename}&view={$view}&record={$LISTVIEW_ENTRY.idrecord}" class="btn btn-xs btn-warning" title="Редактировать"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                {/foreach}
                    </tbody>
                </table>
    </div>
        {/if}
{assign var=NEWBLOCK value=1}
{assign var=DATE value=date('Y-m-d')}
{assign var=DATEFORMAT value="d.m.Y"}
{foreach item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES name=listview}
    {if $LISTVIEW_ENTRY->rawData.due_date gt $DATE }
        {assign var=NEWBLOCK value=2} 
        {assign var=DATE value=$LISTVIEW_ENTRY->rawData.due_date}
        {if $TABLEOPEN eq 1}
            {assign var=TABLEOPEN value=0}
            </tbody>
                </table>
        {/if}
    {/if} 
    {if $NEWBLOCK eq 1}
        <hr />
             <br />
        <h3>Задачи на сегодня</h3>
        
    {else if $NEWBLOCK eq 2}
        <hr />
             <br />
        <h3>Задачи на {date('d.m.Y', strtotime($DATE))}</h3>
        {/if}
    {if $NEWBLOCK neq 0 }
        {assign var=NEWBLOCK value=0}
        <table class="table-hover table table-bordered listViewEntriesTable">
                        <thead>
                        <tr>
                                <th colspan="2">Дата</th>
                            <th>Тип</th>
                            <th>Заявка</th>
                            <th>Задача</th>
                            <th>Приоритет</th>
                            <th width='80px'>Статус</th>
                            <th>Автор<br>→&nbsp;Исп.</th>
                            <th></th>
                            
                            
                            
                        </tr>
                        </thead>
                        <tbody>
        {assign var=TABLEOPEN value=1}
        {assign var=NEWBLOCK value=0} 
    {/if}
    {assign var=trClass value=$LISTVIEW_ENTRY->getClassTrDate()}
    {if $LISTVIEW_ENTRY->rawData.priority eq 'Ahight'}
        {assign var=trClass value='error'}
    {/if}
    <tr class="top {$trClass}" data-id='{$LISTVIEW_ENTRY->getId()}'>
         <td  width="2%" class="{$WIDTHTYPE}">
				<input type="checkbox" value="{$LISTVIEW_ENTRY->rawData['leadid']}" class="listViewEntriesCheckBox"/>
			</td>
        <td>
            {if $LISTVIEW_ENTRY->rawData.due_date neq $DATE }
                {date("d.m.y", strtotime($LISTVIEW_ENTRY->rawData.due_date))}
                <br />
           {/if}
              
               {date("H:i", strtotime($LISTVIEW_ENTRY->rawData.time_end))} <br />
        </td>
        {assign var=PARENTMODULE value=$LISTVIEW_ENTRY->getReferensModuleName()}
        
        {assign var=PARENTMODULENAME value=''}
        {if $PARENTMODULE}
        {assign var=PARENTMODULENAME value=$PARENTMODULE.setype}
        {/if}
        {if $PARENTMODULENAME == 'Leads'}
           
          {assign var=PARENTMODULENAME value=$PARENTMODULE.setype}
          {include file=vtemplate_path($LISTVIEW_ENTRY->getUitypeTemplate($PARENTMODULENAME) ,$MODULE)}
        {else}
            {include file=vtemplate_path('uitypes/events.tpl',$MODULE)}
        {/if}
        <td>
            {assign var=labelClass value=$LISTVIEW_ENTRY->getLabelStatusClass()}
                            <span class="label {$labelClass}">
                                 {vtranslate($LISTVIEW_ENTRY->rawData.status,$MODULE)}
                            </span>
                          
                            <br />
                           <span class="">
                                 {vtranslate($LISTVIEW_ENTRY->rawData.leadstatus,$MODULE)}
                            </span>
                            <br />
                           

        </td>
        <td>{$LISTVIEW_ENTRY->get('created_user_id')}<br><small>→{$LISTVIEW_ENTRY->rawData.owner}</small>{if $LISTVIEW_ENTRY->rawData.oldowner neq ''}<br><small>Передано от: <br>{$LISTVIEW_ENTRY->rawData.oldowner}</small>{/if}</td>
        <td class="right nowrap">

            {if $PARENTMODULENAME eq 'Leads'}
                <a href="{$LISTVIEW_ENTRY->getDetailLinkParentModule($PARENTMODULENAME,$LISTVIEW_ENTRY->get('id'))}" class="btn btn-xs btn-warning" title="Редактировать"><i class="fa fa-pencil"></i></a>
                <br/><br/><a href="{$LISTVIEW_ENTRY->getDetailLinkParentModule($PARENTMODULENAME,$LISTVIEW_ENTRY->get('id'),1)}" class="btn btn-xs btn-warning" title="Исходящий звонок"><i class="fa fa-phone"></i></a>{if $LISTVIEW_ENTRY->rawData.callid > 0}<span class="callid">{$LISTVIEW_ENTRY->rawData.callid}</span>{/if}
            {else}
                {if $IS_MODULE_EDITABLE}
                    <a class="btn btn-xs btn-warning" href='{$LISTVIEW_ENTRY->getEditViewUrl()}'><i class="fa fa-pencil"></i></a>&nbsp;


                {/if}
                {if $IS_MODULE_DELETABLE}
                    <br/>
                    <a class="btn btn-xs btn-error deleteRecordButton" ><i class="fa fa-trash"></i></a>
                {/if}
            {/if}
        </td>
                        
    </tr>
{/foreach}
    {if $TABLEOPEN eq 1}
            {assign var=TABLEOPEN value=0}
            </tbody>
                </table>
        {/if}    
       
<!--added this div for Temporarily -->
{if $LISTVIEW_ENTRIES_COUNT eq '0'}
	<table class="emptyRecordsDiv">
		<tbody>
			<tr>
				<td>
					{assign var=SINGLE_MODULE value="SINGLE_$MODULE"}
                    {* SalesPlatform.ru begin *}
                    {vtranslate('LBL_NOT_FOUND')} {vtranslate($MODULE, $MODULE)}.{if $IS_MODULE_EDITABLE} {vtranslate('LBL_CREATE')} <a href="{$MODULE_MODEL->getCreateRecordUrl()}">{vtranslate($SINGLE_MODULE, $MODULE)}</a>{/if}
					{*{vtranslate('LBL_NO')} {vtranslate($MODULE, $MODULE)} {vtranslate('LBL_FOUND')}.{if $IS_MODULE_EDITABLE} {vtranslate('LBL_CREATE')} <a href="{$MODULE_MODEL->getCreateRecordUrl()}">{vtranslate($SINGLE_MODULE, $MODULE)}</a>{/if}*}
                    {* SalesPlatform.ru end *}
				</td>
			</tr>
		</tbody>
	</table>
{/if}
</div>
</div>
             
{/strip}