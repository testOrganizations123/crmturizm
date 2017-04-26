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
   
    {foreach key=recordId item=CONTACT from=$LIST_CONTACT}
        {assign var=dogovor value=false}
        {if $CONTACT['mailingstreet'] }
           {assign var=dogovor value=true}
           
        {/if}
        
    <tr id='turist-{$recordId}' class="turist">
       <td>
            <input class="listTurist" name="list_tourist[]" value="{$recordId}" type="hidden" />
            <input id="touristName_{$recordId}" value="{$CONTACT['lastname']}{if $CONTACT['firstname'] neq "" } {mb_substr($CONTACT['firstname'], 0, 1)}.{/if}{if $CONTACT['cf_1087'] neq "" } {mb_substr($CONTACT['cf_1087'], 0, 1)}.{/if}" type="hidden" />
    <div class="cms-group cms-group-white">
    <div class="row-fluid">
       
        <div class="span3">
            <div class="form-group">
                <label>ФИО</label>
                <p class="fio">{$CONTACT['lastname']} {$CONTACT['firstname']} {$CONTACT['cf_1087']}<br>{$CONTACT['cf_1089']} {$CONTACT['cf_1091']}</p>
            </div>
        </div>
        <div class="span2">
            <div class="form-group">
                <label>Дата рождения</label>
                <p class="form-control-static">{if !empty($CONTACT['birthday'])}{date('d.m.Y', strtotime($CONTACT['birthday']))}{/if}</p>
                <p class="form-control-static"><b>Email:</b> {if $CONTACT['email'] neq ''}{$CONTACT['email']}{else}-{/if}</p>
            </div>
        </div>
        <div class="span3">
            <div class="form-group">
                <label>Паспорт</label>
                <p class="form-control-static">{$CONTACT['cf_1093']} {$CONTACT['cf_1095']}, {$CONTACT['cf_1097']}
                    <br>выдан c {if !empty($CONTACT['cf_1099'])}{date('d.m.Y', strtotime($CONTACT['cf_1099']))}{else} --- {/if} по {if !empty($CONTACT['cf_1101'])}{date('d.m.Y', strtotime($CONTACT['cf_1101']))}{else} --- {/if} </p>
            </div>
        </div>
            <div class="span4">
            <div class="form-group">
                <label>Адрес</label>
                <p class="form-control-static">{if $CONTACT['mailingstate'] neq ''}{$CONTACT['mailingstate']}, {/if}{$CONTACT['mailingcity']}, {$CONTACT['mailingstreet']}</p>
            <p class="form-control-static"><b>Телефон:</b>{if $CONTACT['phone'] neq ''}{$CONTACT['phone']}{if $CONTACT['mobile'] neq ''}<br />{/if}{/if}{if $CONTACT['mobile'] neq ''}{$CONTACT['mobile']}{/if}</p>
            </div>
        </div>
    </div>
    
    <div class="row-fluid">
        <div class="span10">
           
                <label class="radio">
                    <input name="dogovor_id_turist" value="{$recordId}" type="radio" {if $dogovor eq false}disabled{/if} onclick="changeDogovor({$recordId});"> Оформить договор на этого туриста
                    
                </label>
                <label class="radio">
                    <input name="dogovor_id_turist" value="{$recordId}:none" type="radio" {if $dogovor eq false}disabled{/if} onclick="changeDogovor({$recordId});"> Оформить договор на этого клиента (не является туристом) 
                </label>
            
        </div>
        <div class="span2">
            <button class="btn btn-default" onclick="editTurist(event,{$recordId});">
                <i class="fa fa-pencil"></i> Редактировать
            </button>&nbsp;&nbsp;
            <button class="btn btn-default btn-block-remove" onclick="removeTurist(event,{$recordId});">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>
        </td></tr>
    {/foreach}
{/strip}