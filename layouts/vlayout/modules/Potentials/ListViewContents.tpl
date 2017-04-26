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

<div class="alphabetSorting noprint">
	<table width="100%" class="table-bordered" style="border: 1px solid #ddd;table-layout: fixed">
		<tbody>
			<tr>
			{foreach item=ALPHABET from=$ALPHABETS}
				<td class="alphabetSearch textAlignCenter cursorPointer {if $ALPHABET_VALUE eq $ALPHABET} highlightBackgroundColor {/if}" style="padding : 0px !important"><a id="{$ALPHABET}" href="#">{$ALPHABET}</a></td>
			{/foreach}
			</tr>
		</tbody>
	</table>
</div>
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
				
				{foreach key=NAME item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                {if $NAME eq 'leadsource'}
                                    {else}
				<th nowrap {if $LISTVIEW_HEADER@last} colspan="2" {/if}>
					<a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="{if $COLUMN_NAME eq $LISTVIEW_HEADER->get('column')}{$NEXT_SORT_ORDER}{else}ASC{/if}" data-columnname="{$LISTVIEW_HEADER->get('column')}">{vtranslate($LISTVIEW_HEADER->get('label'), $MODULE)}
						&nbsp;&nbsp;{if $COLUMN_NAME eq $LISTVIEW_HEADER->get('column')}<img class="{$SORT_IMAGE} icon-white">{/if}</a>
				</th>
                                {/if}
				{/foreach}
			</tr>
		</thead>
        {if $MODULE_MODEL->isQuickSearchEnabled()}
        <tr>
          
			{foreach key=NAME item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
            
                 {if $NAME eq 'office'}
                      <td width='150px'>
                {include file=vtemplate_path('part/searchoffice.tpl',$MODULE)
                    FIELD_MODEL= $LISTVIEW_HEADER SEARCH_INFO=$SEARCH_DETAILS[$LISTVIEW_HEADER->getName()] USER_MODEL=$CURRENT_USER_MODEL}
                    
             {else if $NAME eq 'leadsource'}
                 
                 {assign var=leadsource_header value=$LISTVIEW_HEADER}
                
                 {else}
                  <td>
                 {assign var=FIELD_UI_TYPE_MODEL value=$LISTVIEW_HEADER->getUITypeModel()}
                {include file=vtemplate_path($FIELD_UI_TYPE_MODEL->getListSearchTemplateName(),$MODULE_NAME)
                    FIELD_MODEL= $LISTVIEW_HEADER SEARCH_INFO=$SEARCH_DETAILS[$LISTVIEW_HEADER->getName()] USER_MODEL=$CURRENT_USER_MODEL}
                    {/if}
             </td>
             
			{/foreach}
			<td>
				<button class="btn" data-trigger="listSearch">{vtranslate('LBL_SEARCH', $MODULE )}</button>
			</td>
        </tr>
        <tr> <td colspan="2">
                <select class="listSearchContributor statbron" name="statbron" {/strip}{literal}data-fieldinfo='{"mandatory":true,"presence":true,"quickcreate":true,"masseditable":true,"defaultvalue":false,"type":"text","name":"statbron","label":"Состояние"}'{/literal}{strip}>
            <option value="">Состояние брони</option>
            <option value="1" {if $statbron eq "1"}selected{/if}>Не оплачено туристом</option>
            <option value="2" {if $statbron eq "2"}selected{/if}>Не оплачено туроператору</option>
             <option value="3" {if $statbron eq "3"}selected{/if}>Не подтверждено</option>
                </select></td>
                <td><b class="pull-right">Телефон</b></td><td><input name="mobile" style="width:100px;" class="listSearchContributor phone" value="{$PHONE}" {/strip}{literal}data-fieldinfo="{&quot;mandatory&quot;:true,&quot;presence&quot;:true,&quot;quickcreate&quot;:true,&quot;masseditable&quot;:true,&quot;defaultvalue&quot;:false,&quot;type&quot;:&quot;phone&quot;,&quot;name&quot;:&quot;mobile&quot;,&quot;label&quot;:&quot;Телефон&quot;}" {/literal}{strip} type="text"></td>
                {if $leadsource_header}
                <td><b class="pull-right">Источник обращения</b></td>
                
                <td>
                     {assign var=LISTVIEW_HEADER value=$leadsource_header}
                    {assign var=FIELD_UI_TYPE_MODEL value=$LISTVIEW_HEADER->getUITypeModel()}
                {include file=vtemplate_path($FIELD_UI_TYPE_MODEL->getListSearchTemplateName(),$MODULE_NAME)
                    FIELD_MODEL= $LISTVIEW_HEADER SEARCH_INFO=$SEARCH_DETAILS[$LISTVIEW_HEADER->getName()] USER_MODEL=$CURRENT_USER_MODEL}
                </td>
                {/if}
        </tr>
        {/if}
		
	</table>
        {assign var=LISTALERT value=$LIST_VIEW_MODEL->getListAlert()} 
   {if $LISTALERT['count']>0}
       <br />
       <div class="alert alert-error">
           <h4>Задачи по этим броням просрочены более чем на сутки:</h4>
           <ul class='alertBlock'>
               {if count($LISTALERT['visa'])>0}
                   <li>Дата для визы: &nbsp;
                       {foreach item=ITEM from=$LISTALERT['visa']}<a href="{$ITEM['link']}"><span class='label-important label'>Договор №{$ITEM['dogovor']}</span></a>&nbsp;{/foreach}</li>
               {/if}
               {if count($LISTALERT['control'])>0}
                   <li>Контрольная дата: &nbsp;
                       {foreach item=ITEM from=$LISTALERT['control']}<a href="{$ITEM['link']}"><span class='label-important label'>Договор №{$ITEM['dogovor']}</span></a>&nbsp;{/foreach}</li>
               {/if}
               {if count($LISTALERT['turoperator'])>0}
                   <li>Срок оплаты оператору: &nbsp;
                       {foreach item=ITEM from=$LISTALERT['turoperator']}<a href="{$ITEM['link']}"><span class='label-important label'>Договор №{$ITEM['dogovor']}</span></a>&nbsp;{/foreach}</li>
               {/if}
               {if count($LISTALERT['turist'])>0}
                   <li>Срок оплаты туристом: &nbsp;
                       {foreach item=ITEM from=$LISTALERT['turist']}<a href="{$ITEM['link']}"><span class='label-important label'>Договор №{$ITEM['dogovor']}</span></a>&nbsp;{/foreach}</li>
               {/if}
           </ul>
       </div>
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

{else}
  {assign var=privelege value=explode('::',$CURRENT_USER_MODEL->get('privileges')->get('parent_role_seq'))}
<table class="table table-small table-hover table-responsive table-condensed table-bordered listViewEntriesTable" id="brontab">
    <thead>
                    <tr>

                        
                        <th width="10px" rowspan="2"></th>
                        <th colspan="2" class="bg-1 center">Вылет</th>
                        {if count($privelege) < 7}
                        <th rowspan="2" class="bg-2 center">Сотрудник<br>/Офис</th>
                        {/if}
                        
                        <th rowspan="2" class="bg-2 center" style="min-width: 35px;">Конт-<br>роль</th>
                        <th rowspan="2" class="bg-2 center">Турист</th>
                        <th rowspan="2" class="bg-2 center">Телефон</th>
                        <th rowspan="2" class="bg-2 center">Направ-<br>ление</th>
                        <th rowspan="2" class="bg-2 center">Оператор</th>
                        <th rowspan="2" class="bg-2 center">Договор</th>
                        <th rowspan="2" class="bg-2 center">Бронь</th>

                        <th colspan="2" class="bg-3 center">Виза</th>

                        <th colspan="4" class="bg-4 center">Оплата туристом</th>
                        <th colspan="2" class="bg-41 center">Оператор</th>
                        <th rowspan="2" class="bg-42 right">Комиссия</th>
                        <th rowspan="2" class="bg-5 center" width="80">Документы на вылет</th>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        
                        <th class="bg-1 center" colspan="" style="min-width:50px">Туда</th>
                        <th class="bg-5 center" style="min-width:40px">Об-<br>ратно</th>
                        <th class="bg-3 center">Статус</th>
                        <th class="bg-3 center" style="min-width: 35px;">Срок</th>

                        <th class="right bg-4">Стоимость</th>
                        <th class="right bg-4">Оплачено</th>
                        <th class="right bg-4">Долг</th>
                        <th class="left bg-4">Статус</th>
                        <th class="right bg-41">Стоимость</th>
                        <th class="right bg-41">Долг</th>
                    </tr>

                    </thead>
                    
                    <tbody>
                        {foreach item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES name=listview}
                            {include file=vtemplate_path('part/ListBron.tpl',$MODULE)}
                            {/foreach}
                       
                        </tbody>
</table>
                            {/if}
                           
</div>
</div>
   
{/strip}
