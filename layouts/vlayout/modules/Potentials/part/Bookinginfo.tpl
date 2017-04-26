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
    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['dogovor']}
    {assign var=dogovor value="{$FIELD_MODEL->get('fieldvalue')}"}
    {if $dogovor neq ""}
    <div class="">
            <div class="cms-group cms-group-expanded addPayContainer">
                <div class="cms-group-label">Договор №
                    
                    {$dogovor}
                   
                    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['datedogovor']}
                    &nbsp;от&nbsp;{if $FIELD_MODEL->get('fieldvalue') neq ""}{date('d.m.Y',strtotime($FIELD_MODEL->get('fieldvalue')))}{/if}
                    {if $FIELD_MODEL->get('fieldvalue') neq ""}<input id="dataDogovora" value="{$FIELD_MODEL->get('fieldvalue')}" type="hidden" />{else}<input id="dataDogovora" value="{date('Y-m-d H:i:s')}" type="hidden" />{/if}
                </div>
      {include file=vtemplate_path('part/bookDogovor.tpl',$MODULE)}
     
      {assign var=LINK_DOCUMENTS value=$RECORD_MODEL->getDocumentLinks($RECORD_ID)}
      
       <blockquote>
        <p>Печать документов</p>
         <table>
        {if isset($LINK_DOCUMENTS['dogovor']['href'])}
           
             <tr><td width="10%">
            {$LINK_DOCUMENTS['dogovor']['name']}:</td>
                    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['change_field']}
                    {assign var=changeField value=$FIELD_MODEL->get('fieldvalue')}
                    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['printdogovor']}
                    {assign var=printdogovor value=$FIELD_MODEL->get('fieldvalue')}
                     {assign var=FIELD_MODEL value=$BLOCK_FIELDS['print_dop_count']}
                     {assign var=printdop value=$FIELD_MODEL->get('fieldvalue')}
                     {assign var=AddText value=''}
                    {if $printdogovor eq 1} 
                      {assign var=FIELD_MODEL value=$BLOCK_FIELDS['print_dog_count']}
                       {if $changeField eq 1 }
                           {assign var=AddText value=sprintf('- Договор распечатан (%s). <span class="redColor">В броне имеются изменения, распечатайте доп.соглашение или если договор еще не подписан то основной договор</span>', $FIELD_MODEL->get('fieldvalue'))}
                       {else}
                            {assign var=AddText value=sprintf('- Договор распечатан (%s)', $FIELD_MODEL->get('fieldvalue'))}
                      {/if}
                    {/if}
                    
                <td width="90%">   
                    <a style="margin-top: 5px;" class="btn btn-success btn-ref" href="{$LINK_DOCUMENTS['dogovor']['href']}" onclick="{if $printdogovor eq 0}chekMailSend();{/if}{if $changeField eq 1 or $printdogovor eq 0 }printDogovor(){/if}" target="_blank"><i class="fa fa-file-o"></i> {$LINK_DOCUMENTS['dogovor']['description']}{if $changeField eq 1}(с изменениями){/if}</a> {$AddText}
                </td></tr>
                {if $changeField eq 1 or $printdop > 0}
                      {if $printdop > 0 and $changeField eq 1}
                        {assign var=AddText value=sprintf('- Дополнительное соглашение распечатано (%s). <span class="redColor">В броне имеются новые изменения, распечатайте доп.соглашение</span>', $printdop)} 
                      {else if $printdop > 0}
                        {assign var=AddText value=sprintf('- Дополнительное соглашение распечатано (%s)', $printdop)}
                      {else}
                         {assign var=AddText value=sprintf('<span class="redColor"> - В броне имеются новые изменения, распечатайте доп.соглашение</span>', $printdop)} 
                      {/if}
                   <tr>  <td> Доп. соглашение</td><td> <a style="margin-top: 5px;" class="btn btn-success btn-ref" href="{$LINK_DOCUMENTS['dopnik']['href']}" onclick="{if $changeField eq 1}printDopDogovor(){/if}" target="_blank"><i class="fa fa-file-o"></i> {$LINK_DOCUMENTS['dopnik']['description']}{if $printdop > 0 and $changeField eq 1}(новое с изменениями){/if}</a> {$AddText}
                     </td></tr>
                     {/if}
                {assign var=LINK_DOCUMENTS value=$RECORD_MODEL->unsetArray($LINK_DOCUMENTS, 'dogovor')}
                {assign var=LINK_DOCUMENTS value=$RECORD_MODEL->unsetArray($LINK_DOCUMENTS, 'dopnik')}
                {if $opportunity_type eq "Пакетный Тур"}
                    {assign var=MATERIAL value=$RECORD_MODEL->getContactEmail($RECORD_ID)}
                <tr>  <td>Дополнительные материалы для тура </td><td>{if $MATERIAL eq true && $printdogovor neq 0}<i><b>Отправлены на e-mail: {$MATERIAL}</b></i>{else if $MATERIAL eq true}<i><b>Будут отправлены на e-mail: {$MATERIAL} после печати договора</b></i> {else}<a style="margin-top: 5px;" class="btn btn-warning btn-ref" href="print_pdf.php?record={$RECORD_ID}" target="_blank"><i class="fa fa-file-o"></i> Печатать</a>{/if}</small>
                </td></tr>
                    {/if}
        {else}
        <tr>  <td colspan="2">(для печати договора должен быть выбран турист на кого оформляется договор)</small> </td></tr>
        {/if}
        
        {if count($LINK_DOCUMENTS) > 0}
            {foreach key=name_document item=DOCUMENT from=$LINK_DOCUMENTS}
             <tr>  <td>{$DOCUMENT['name']}</td><td>
                <a style="margin-top: 5px;" class="btn btn-warning btn-ref" href="{$DOCUMENT['href']}" target="_blank"><i class="fa fa-file-o"></i> {$DOCUMENT['description']}</a>
            </td></tr>
            {/foreach}
        {/if}	
        </table>
	</blockquote>
       {include file=vtemplate_path('part/bookto.tpl',$MODULE)}
            </div>
    </div>
   {else}
       <div class="alert alert-error"> 
<i class="fa fa-exclamation fa-4x" style="float: left;padding-top: 13px;margin-left: 20px;"></i> <h4 style="padding: 30px 50px 20px;">Для получения номера и даты договора необходимо выбрать Туроператора и Клиента на кого будет оформляться договор.</h4></div>
   {/if}   
{strip}