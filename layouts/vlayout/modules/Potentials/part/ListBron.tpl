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
    
      <tr class="listViewEntries {if $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'Авиа билеты'}aviaticket{else if $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'ЖД билеты'}zhdticket{else if $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'Индивидуальный Тур'}indtur{/if}"  id="{$MODULE}_listView_row_{$smarty.foreach.listview.index+1}" data-id="{$LISTVIEW_ENTRY->rawData['potentialid']}">

                        <td class="bg-2"><input type="checkbox" value="{$LISTVIEW_ENTRY->getId()}" class="listViewEntriesCheckBox"/></td>
                        
                        <td class="bg-1 ">
                              <span class="{if strtotime($LISTVIEW_ENTRY->rawData['cf_1217']) < strtotime("+24 hours", strtotime(date('Y-m-d H:i:s'))) and $LISTVIEW_ENTRY->rawData['cf_1236'] eq 0}label label-warning{/if}">
                           {if $LISTVIEW_ENTRY->rawData['cf_1217']}{$LISTVIEW_ENTRY->rus_date('j M H:i', strtotime($LISTVIEW_ENTRY->rawData['cf_1217']))}{else}<center>-</center>{/if} </span>                  </td>
                        <td class="bg-5 {if strtotime($LISTVIEW_ENTRY->rawData['cf_1219'])< time() }danger{/if}">
                           {if $LISTVIEW_ENTRY->rawData['cf_1219']}{$LISTVIEW_ENTRY->rus_date('j M H:i', strtotime($LISTVIEW_ENTRY->rawData['cf_1219']))}{else}<center>-</center>{/if}                      </td>

                         {if count($privelege) < 7}
                        <td class="bg-2"><span class="block">{strip_tags($LISTVIEW_ENTRY->get('assigned_user_id'))}</span>
                            {strip_tags($LISTVIEW_ENTRY->get('office'))}
                        </td>

                        {/if}
<!-- Контроль -->
                        <td class="nowrap bg-2">
                            {if $LISTVIEW_ENTRY->rawData['cf_1242'] eq '0000-00-00 00:00:00'}
                                {else}
                                 <span class="{if strtotime($LISTVIEW_ENTRY->rawData['cf_1242']) < strtotime(date('Y-m-d'))}label-important label {else}label label-warning{/if} popoverpop" data-trigger='hover' data-title='Контроль' data-content='{$LISTVIEW_ENTRY->rawData[0]}'>
                                           
                                           {$LISTVIEW_ENTRY->rus_date('d.m H:i', strtotime($LISTVIEW_ENTRY->rawData['cf_1242']))}
                                         </span>     
                                         {/if}
                            </td>
  <!-- Контакт -->           
                        <td class="bg-2 nowrap">{strip_tags($LISTVIEW_ENTRY->get('contact_id'))}
                            {if $LISTVIEW_ENTRY->rawData.oldowner neq ''}<br><b><small>от: {$LISTVIEW_ENTRY->rawData.oldowner}</small></b>{/if}
                        </td>
        
                        <td class="bg-2">{$LISTVIEW_ENTRY->rawData['mobile']}{if $LISTVIEW_ENTRY->rawData['phone'] neq "" }, {$LISTVIEW_ENTRY->rawData['phone']}{/if}</td>
        {if $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'Авиа билеты' or $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'ЖД билеты'}
            {assign var=tuda_iz value=explode('#',$LISTVIEW_ENTRY->rawData['cf_1173'])}
            {assign var=tuda_v value=explode('#',$LISTVIEW_ENTRY->rawData['cf_1177'])}
            {assign var=otuda_iz value=explode('#',$LISTVIEW_ENTRY->rawData['cf_1185'])}
            {assign var=otuda_v value=explode('#',$LISTVIEW_ENTRY->rawData['cf_1189'])}
            {assign var=otuda value=""}
            <td class="bg-2">
            {foreach key=key_ot item=ITEM from=$tuda_iz}
                {$ITEM}-{$tuda_v.$key_ot}{if $tuda_iz@last}{else}<br> {/if} 
            {/foreach}
            {if $LISTVIEW_ENTRY->rawData['cf_1185'] neq ""}
                
                {foreach key=key_ot item=ITEM from=$otuda_iz}
                {$ITEM}-{$otuda_v.$key_ot}{if $otuda_iz@last}{else}<br>{/if} 
            {/foreach}
            {/if}
        </td>
         <td class="bg-2">{$LISTVIEW_ENTRY->rawData['vendorname']}</td>
 {elseif $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'Индивидуальный Тур'}
       <td class="bg-2" colspan="2"><b>{$LISTVIEW_ENTRY->rawData['potentialtype']}</b></td>
 {else}
                        <td class="bg-2">{$LISTVIEW_ENTRY->rawData['country_name']},<br>{$LISTVIEW_ENTRY->rawData['resort']}</td>
                        <td class="bg-2">{$LISTVIEW_ENTRY->rawData['turoperator']}</td>
                        {/if}
   <!-- Договор -->
                        <td class="bg-2">№{$LISTVIEW_ENTRY->rawData['cf_1223']}<br>{if $LISTVIEW_ENTRY->rawData['cf_1225'] neq "0000-00-00"}{date('d.m.Y', strtotime($LISTVIEW_ENTRY->rawData['cf_1225']))}{/if}</td>
   <!-- номер брони -->                  
                        <td class="bg-2"><span class="{if $LISTVIEW_ENTRY->rawData['cf_1234'] neq 1 and $LISTVIEW_ENTRY->rawData['cf_1227'] neq ''}label-warning label{/if}">{$LISTVIEW_ENTRY->rawData['cf_1227']}</span></td>
   <!-- документы на визу -->
   {if $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'Авиа билеты' or $LISTVIEW_ENTRY->rawData['potentialtype'] eq 'ЖД билеты'}
       <td class="bg-3" colspan="2"><b>{$LISTVIEW_ENTRY->rawData['potentialtype']}</b></td>
 {else}
                        <td class="bg-3">{$LISTVIEW_ENTRY->rawData['cf_1229']}</td>

    <!-- Дата для визы -->
                            <td class="bg-3">
                            {if empty($LISTVIEW_ENTRY->rawData['cf_1248'])}
                                {else}
                           <span class="{if strtotime($LISTVIEW_ENTRY->rawData['cf_1248']) < strtotime(date('Y-m-d')) && $LISTVIEW_ENTRY->rawData['cf_1229'] neq 'Выдана'}label-important label {else if $LISTVIEW_ENTRY->rawData['cf_1229'] neq 'Выдана'}label-warning label{/if}">{date('d.m Y', strtotime($LISTVIEW_ENTRY->rawData['cf_1248']))}</span>
                           {/if}
                        </td>
                        {/if}
        <!-- сумма для оплаты туристом -->
                        <td class="right bg-4">{number_format($LISTVIEW_ENTRY->rawData['amount'],2,","," ")}</td>
                       
                        <td class="right bg-4">{number_format($LISTVIEW_ENTRY->rawData['cf_1254'],2,","," ")}</td>
          <!-- долг туриста -->
                        <td class="right bg-4">
                            {number_format($LISTVIEW_ENTRY->rawData['cf_1250'],2,","," ")}<br> 
                            {if $LISTVIEW_ENTRY->rawData['cf_1252'] neq "0000-00-00" and $LISTVIEW_ENTRY->rawData['cf_1252'] neq NULL}<span class="{if $LISTVIEW_ENTRY->rawData['cf_1250'] > 0 and strtotime($LISTVIEW_ENTRY->rawData['cf_1252']) < strtotime(date('Y-m-d'))}label-important label {else if $LISTVIEW_ENTRY->rawData['cf_1250'] > 0}label-warning label{/if}">{date('d.m.Y', strtotime($LISTVIEW_ENTRY->rawData['cf_1252']))}</span>{/if}
                        </td>
                        {assign var=DS value=$MODULE_MODEL->getMoneyStatus($LISTVIEW_ENTRY->rawData['cf_1270'])}
              <!-- Статус--->          
                        <td class="bg-4">{$DS}</td>
  <!-- Оператор стоимость ---> 
                        <td class="bg-41 right">
                            {if $LISTVIEW_ENTRY->rawData['cf_1256'] != $LISTVIEW_ENTRY->rawData['cf_1264'] and $LISTVIEW_ENTRY->rawData['cf_1264'] > 0}
                                <span class="block"><small><s>{number_format($LISTVIEW_ENTRY->rawData['cf_1264'],2,","," ")}</s></small></span>
                                {/if}
                            {number_format($LISTVIEW_ENTRY->rawData['cf_1256'],2,","," ")}
                            </td>
     <!-- Оператор долг ---> 
                        <td class="bg-41 right">
                            {number_format($LISTVIEW_ENTRY->rawData['cf_1258'],2,","," ")}<br>
                        {if !empty($LISTVIEW_ENTRY->rawData['cf_1260'])}    <span class="{if $LISTVIEW_ENTRY->rawData['cf_1258'] > 0 and strtotime($LISTVIEW_ENTRY->rawData['cf_1260']) < strtotime(date('Y-m-d'))}label-important label{else if $LISTVIEW_ENTRY->rawData['cf_1258'] > 0}label-warning label{/if}">{date('d.m.Y', strtotime($LISTVIEW_ENTRY->rawData['cf_1260']))}</span> {/if}
                        </td>
                        
                        <td class="bg-42 nowrap right"><span class="block "><span class="{if $LISTVIEW_ENTRY->rawData['cf_1266'] < 3.01 }label-important label{/if}">{number_format($LISTVIEW_ENTRY->rawData['cf_1266'],2,","," ")}%</span></span>{number_format($LISTVIEW_ENTRY->rawData['cf_1268'],2,","," ")}</td>
                        <td class="bg-5">{$LISTVIEW_ENTRY->rawData['cf_1231']}</td>
                        <td class="right nowrap">
                            <div class="actions pull-right">
					<span class="actionImages">
                            {if $IS_MODULE_EDITABLE}
							<a href='{$LISTVIEW_ENTRY->getEditViewUrl()}' class="btn btn-warning"><i title="{vtranslate('LBL_EDIT', $MODULE)}" class="fa fa-pencil alignMiddle"></i></a>&nbsp;
					<br />	
                            {/if}
						{if $IS_MODULE_DELETABLE and $CURRENT_USER_MODEL->get('is_admin') eq 'on'}
                                                
							<a class="deleteRecordButton btn btn-danger"><i title="{vtranslate('LBL_DELETE', $MODULE)}" class="fa fa-trash-o alignMiddle"></i></a>
						{/if}
                                        </span>
                            </div>
                    </tr>
{/strip}