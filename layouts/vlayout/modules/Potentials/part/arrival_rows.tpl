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
    {assign var=width15 value="15%"}
    {assign var=width14 value="14%"} 
    {assign var=width11 value="11%"} 
    {if $opportunity_type eq "Авиа билеты"}
         {assign var=width15 value="11%"}
    {assign var=width14 value="11%"} 
    {assign var=width11 value="6%"} 
    {/if}
    {if $opportunity_type eq "ЖД билеты"}
         {assign var=width15 value="12%"}
    {assign var=width14 value="13%"} 
    {assign var=width11 value="7%"} 
    {/if}
   
    {foreach key=key_air item=delta from=$check_array} 
        
                     <div class="row-fluid compressed flite" {if $key_air eq 0}style="margin-top: 25px;"{/if}>
                 <!-- Туда - Авиалинии -->
     {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}            
    <div class="span3 width15" style="width: {$width15}; padding-right: 0;margin-left:1%"> 
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_airline']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                           {if $key_air eq 0} <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label> {/if}
                            <div class="">
                                <select class='form-control  ' name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getAirlinePikList()}
                                    <option value="{$KEY}" {if $FIELD_VALUE.$key_air eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
    </div>
                                    {/if}
     {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}                               
    <div class="span3 width15 rail addShow" style="width: {$width15}; padding-right: 0;margin-left:1%"> 
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_airline']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                              {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                           {if $key_air eq 0}
                               <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Поезд', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                               <div class="">
                                <input type="text" class='form-control  ' name='{$FIELD_MODEL->getFieldName()}_rail[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}' value="{$FIELD_VALUE.$key_air}">
                                
                                  
                            </div>
                        </div>
    </div>
    {/if}
                                     <!-- Туда - Рейс -->
    <div class="span1" style="width: 5%; padding-right: 0;margin-left:1%">
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_flite']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                            {if $key_air eq 0} 
                                 {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}
                            <label class="ticket turPaket addShow" for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                            {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
                            <label class="rail addShow" for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Номер', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                            {/if}
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}[]"
value="{$FIELD_VALUE.$key_air}"  />
                                
                                
                            </div>
                        </div>
    </div>
<div class="span1 width11" style="width: {$width11}; padding-right: 0;margin-left:1%">
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_type_flite']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                              {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                             {if $key_air eq 0}
                             {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}
                                <label class="ticket turPaket addShow" for="{$FIELD_MODEL->getFieldName()}">Тип рейса{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                            {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
                                <label class="rail addShow" for="{$FIELD_MODEL->getFieldName()}">Тип вагона{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                             {/if}
                            <div class="">
                                <select class='form-control  ' name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                   {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}
                                   <optgroup class="ticket turPaket addShow">
                                    <option value="регулярный" {if $FIELD_VALUE.$key_air  eq 'регулярный'}selected{/if}>Регуляный</option>
                                    <option value="чартер" {if $FIELD_VALUE.$key_air  eq 'чартер'}selected{/if}>Чартер</option>
                                   </optgroup>
                                   {/if}
                                   {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
                                       <optgroup class="rail addShow">
                                    <option value="купе" {if $FIELD_VALUE.$key_air  eq 'купе'}selected{/if}>Купе</option>
                                    <option value="СВ" {if $FIELD_VALUE.$key_air  eq 'СВ'}selected{/if}>СВ</option>
                                    <option value="плацкард" {if $FIELD_VALUE.$key_air eq 'плацкард'}selected{/if}>Плацкард</option>
                                    <option value="женский" {if $FIELD_VALUE.$key_air  eq 'женский'}selected{/if}>Женский</option>
                                    <option value="мужской" {if $FIELD_VALUE.$key_air  eq 'мужской'}selected{/if}>Мужской</option>
                                   </optgroup>
                                       {/if}
                                   
                                    </select>
                                
                                
                                
                            </div>
                        </div>
    </div>
                                    {if $opportunity_type eq "Авиа билеты"}
        <div class="span1 ticket addShow" style="width: 5%; padding-right: 0;margin-left:1%">
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_type_class']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                              {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                           {if $key_air eq 0} <label for="{$FIELD_MODEL->getFieldName()}">Класс{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>{/if}
                            <div class="input-group">
                                <select class='form-control  ' name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                   
                                    <option value="экономичный" {if $FIELD_VALUE.$key_air eq 'экономичный'}selected{/if}>Экономичный</option>
                                    <option value="бизнес" {if $FIELD_VALUE.$key_air eq 'бизнес'}selected{/if}>Бизнес</option>
                                    <option value="комфорт" {if $FIELD_VALUE.$key_air eq 'комфорт'}selected{/if}>Повышенной комфортности</option>
                                   
                                    </select>
                                
                                
                                
                            </div>
                        </div>
    </div>
                                    {/if}
         <!-- Туда - Откуда -->
    <div class="span2 width15" style="width: {$width15}; padding-right: 0;margin-left:1%">
         <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_departure']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                            {if $key_air eq 0} <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>{/if}
                            <div class="">
                                 {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}
                                <select class='form-control ticket turPaket addShow ' name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getAirportsPikList()}
                                    <option value="{$KEY}" {if $FIELD_VALUE.$key_air eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                 {/if} 
                                 {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
                                      <input value="{$FIELD_VALUE.$key_air}" class='form-control rail addShow ' name='{$FIELD_MODEL->getFieldName()}_rail[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                 {/if}
                                
                                  
                            </div>
                        </div>
    </div>
                                     <!-- Туда - время вылета-->
    <div class="span3 width14" style="width: {$width14}; padding-right: 0;margin-left:1%">
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_time_departure']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                           {if $key_air eq 0}  
                           {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}
                            <label class="ticket turPaket addShow" for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                            {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
                            <label class="rail addShow" for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Отправление', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                           {/if}
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}{$key_air}" type="text" class="form-control datetimepicker vilet arrvilet" onchange='validDate(this)' {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}[]"
value="{$FIELD_VALUE.$key_air}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>
                        </div>
            
       
    </div>
                                <!-- Туда - Куда -->
    <div class="span2 width15" style="width: {$width15}; padding-right: 0;margin-left:1%">
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_arrival']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                           {if $key_air eq 0}  <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>{/if}
                            <div class="">
                                 {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}
                                <select class='form-control turPaket ticket addShow  ' name='{$FIELD_MODEL->getFieldName()}[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getAirportsPikList()}
                                    <option value="{$KEY}" {if $FIELD_VALUE.$key_air eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                {/if}
                                 {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
                                      <input value="{$FIELD_VALUE.$key_air}" class='form-control rail addShow ' name='{$FIELD_MODEL->getFieldName()}_rail[]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                 {/if}
                                  
                                
                                  
                            </div>
                        </div>
    </div>
                                     <!-- Туда - время прибытия -->
    <div class="span3 width14" style="width: {$width14}; padding-right: 0;margin-left:1%">
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_time_arrival']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                           {if $key_air eq 0} 
                           {if $opportunity_type neq "ЖД билеты" || $opportunity_type eq ""}
                            <label class="ticket turPaket addShow" for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                            {if $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
                            <label class="rail addShow" for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Прибытие', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            {/if}
                           {/if}
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}{$key_air}" type="text" class="form-control datetimepicker prilet arrprilet" onchange='validDate2(this)' {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}[]"
value="{$FIELD_VALUE.$key_air}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>
                        </div>
          
    </div>
                               {if $opportunity_type eq "Авиа билеты" || $opportunity_type eq "ЖД билеты"}
    <div class="span1 ticket addShow" style="width: 13%; padding-right: 0;margin-left:1%">
        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['arr_list_pass']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                                {assign var="FIELD_VALUE" value=explode(',',$FIELD_VALUE.$key_air)}
                             
                          {if $key_air eq 0}  <label for="{$FIELD_MODEL->getFieldName()}">Пасажиры{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>{/if}
                            <div class="input-group">
                                <select class='chzn-select form-control {if $OCCUPY_COMPLETE_WIDTH} row-fluid-fluid {/if} listTurist listTuristPrice' multiple name='{$FIELD_MODEL->getFieldName()}[{$key_air}][]' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}' style="width:160px;">
                                  
                                   
                                    {foreach item=KEY from=$FIELD_VALUE}
                                       <option value="{$KEY}" selected >{$KEY}</option>
                                       {/foreach}
                                    
                             
                                   
                                    </select>
                                
                                
                                
                            </div>
                        </div>
    </div>
                                    {/if}

    <div class="span1" style="width: 2%; padding-right: 0;margin-left:1%">
        {if $key_air eq 0} <label>&nbsp;</label>{/if}
        <div class="form-group addButtonContainer">
            
         {if $key_air eq 0}   <button class="btn btn-default add-row-fluid" onclick="addFlite(event,this);"><i class="fa fa-plus"></i></button>
        {else}
        <button class="btn btn-default del-row-fluid" onclick="deleteFlite(event, this)"><i class="fa fa-times"></i></button>
         {/if}
        </div>
    </div>
        {if $opportunity_type eq "Авиа билеты" || $opportunity_type eq "ЖД билеты" || $opportunity_type eq ""}
            <div class="span4 ticket rai addShow" style="width: 100px; padding-right: 0;margin-left:1%">
                <span>Цена билета:</span>
                
            </div>
            <div class="span2 ticket rai addShow" style="width: 13%; padding-right: 0;margin-left:1%">
                <div class="form-group form-group-required">
                                        {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ticketprice_arr']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                {assign var="FIELD_VALUE" value=explode('#', $FIELD_VALUE)}
                           
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}_{$key_air}" type="text" class="form-control ticketprice"  {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}[]"
value="{$FIELD_VALUE.$key_air}"  />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                                       
                                    </div>
            </div>
<div class="span4 ticket rai addShow" style="width: 300px; padding-right: 0;margin-left:1%">
                <span>*Указывается стоимость на одного пассажира</span>
                
            </div>
   
        {/if}
</div>
     <hr />
{/foreach}
       
{strip}
