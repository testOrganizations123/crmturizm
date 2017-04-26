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

<div class="{if $opportunity_type eq ""}hide{/if} blockShow">
    <div class="cms-group">
        {include file=vtemplate_path('part/direction.tpl',$MODULE)}
        {if $opportunity_type eq "" || $opportunity_type eq "Пакетный Тур"}
            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['country']}
            {assign var="Country" value=$FIELD_MODEL->get('fieldvalue')}
            {assign var=LIST_CONTACT_DOCUMENTS value =$RECORD_MODEL->getListDocumentVisa()}
            {if $Country > 0 && count($LIST_CONTACT_DOCUMENTS) > 0}
                {assign var=visa value=$RECORD_STRUCTURE_MODEL->getCountryIsVisa($Country)}
                {if $visa eq true and $visa_status neq "Виза не нужна"}
                    <!-- документы на визу -->
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="cms-group cms-group-white  cms-group-expanded"
                                 id="booking_edit_booking_flight_there">
                                <div class="cms-group-label">Документы на визу</div>
                                {include file=vtemplate_path('part/visadoc.tpl',$MODULE)}
                            </div>
                        </div>
                    </div>
                {/if}
            {/if}
        {/if}
        <!-- Туда -->

        <div class="row-fluid">
            <div class="span12">
                <div class="cms-group cms-group-white  cms-group-expanded" id="booking_edit_booking_flight_there">
                    <div class="cms-group-label">Туда</div>
                    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['dep_airline']}
                    {assign var=FIELD_VALUE value=$FIELD_MODEL->get('fieldvalue')}
                    {assign var=check_array value=explode('#', $FIELD_VALUE)}
                    {if count($check_array) > 1}
                        {include file=vtemplate_path('part/departure_rows.tpl',$MODULE)}

                    {else}
                        {include file=vtemplate_path('part/departure.tpl',$MODULE)}
                    {/if}
                </div>

            </div>
            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_airline']}
            {assign var=FIELD_VALUE value=$FIELD_MODEL->get('fieldvalue')}
            {assign var=check_array value=explode('#', $FIELD_VALUE)}
            <div class="row-fluid compressed ticket addShow rail {if $opportunity_type eq "" || $opportunity_type eq "Пакетный Тур" || $opportunity_type eq "Индивидуальный Тур" || $FIELD_VALUE neq ""}hide{/if}">
                <div class="span3">
                    <button class="btn btn-default add-row-fluid"
                            onclick="event.preventDefault();jQuery('.checkComeback').show();jQuery(this).hide();"><i
                                class="fa fa-plus"></i>Обратно
                    </button>
                </div>
            </div>
        </div>

        <!-- Туда - КОНЕЦ -->

        <div class="row-fluid {if $opportunity_type eq "" || ($opportunity_type eq "Авиа билеты" && $FIELD_VALUE eq "") || ($opportunity_type eq "ЖД билеты" && $FIELD_VALUE eq "")}hide{/if} turPaket checkComeback addShow">
            <div class="span12">
                <div class="cms-group cms-group-white  cms-group-expanded" id="booking_edit_booking_flight_back">
                    <div class="cms-group-label">Обратно {count($check_array)}</div>
                    {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_airline']}
                    {assign var=FIELD_VALUE value=$FIELD_MODEL->get('fieldvalue')}
                    {assign var=check_array value=explode('#', $FIELD_VALUE)}
                    {if count($check_array) > 1}
                        {include file=vtemplate_path('part/arrival_rows.tpl',$MODULE)}

                    {else}
                        {include file=vtemplate_path('part/arrival.tpl',$MODULE)}
                    {/if}

                </div>
            </div>
        </div>
        <!-- Обратно КОНЕЦ -->
        {if $opportunity_type eq "" || $opportunity_type eq "Пакетный Тур"}
            {include file=vtemplate_path('part/hotel.tpl',$MODULE)}
            {include file=vtemplate_path('part/transfer.tpl',$MODULE)}
        {/if}
    </div>
</div>


{strip}
