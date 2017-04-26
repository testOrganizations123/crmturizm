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
    
    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['visa_doc']}
                  
    {assign var=contact_number  value=0}
    {foreach key=contact_id item=visarow from=$LIST_CONTACT_DOCUMENTS}
        {assign var=contact_number  value=$contact_number+1}
        {if $contact_number eq 1}
        <div class="row-fluid" style="margin-top: 25px">
        {else if $contact_number eq 4}
            {assign var=contact_number  value=1}
            </div>
            <div class="row-fluid" >
        {/if}
                    <div class="span4">
                       
                        <div class="cms-group cms-group-white  cms-group-expanded" id="booking_edit_booking_flight_there">
                            <div class="cms-group-label">{$visarow['name']}<div class="pull-right"><label>Виза есть <input type="checkbox" name="visa_doc[{$contact_id}][off]" onchange="visaOff(this,{$contact_id})" value="1" {if $visarow['off'] eq 1}checked{/if}/></div></div>
                             <div class="form-group {if $visarow['off'] eq 1}hide{/if}" style="margin-top:25px;" id="cont_doc_{$contact_id}">
                                 <table width="100%"><tr><th width="80%" align="left">Название</th><th align="left" style="min-width:110px;max-width: 110px;width:20%">Дата сдачи</th></tr>
                                      {foreach key=KEY item=VALUE from=$visarow['documents']}
                                         <tr><td>{$VALUE}</td><td><input class="form-control datepicker" name='visa_doc[{$contact_id}][documents][{$KEY}]' value="{$visarow['selected'][$KEY]}" style="width:100px"/></td></tr>
                                         {/foreach}
                                </table>
                             </div>
                        </div>
                    </div>
                               
        {/foreach}
        </div>
        <div class="row-fluid" >
            <div class="span12 "><button class="btn btn-success pull-right" type="submit"><strong>Сохранить</strong></button></div>
        </div>

{strip}
