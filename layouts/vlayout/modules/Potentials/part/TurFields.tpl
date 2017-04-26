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
            <div class="cms-group cms-group-expanded">
                <div class="cms-group-label" id="amount_tur_label">{if $opportunity_type eq "Пакетный Тур" or $opportunity_type eq "Индивидуальный Тур"}
                    Стоимость тура{else}Стоимость{/if}
                </div>
                <div class="row addShow turPaket {if $opportunity_type neq "Пакетный Тур" and $opportunity_type neq "Индивидуальный Тур"} hide{/if}">
                    <div class="span2" style="width: 170px;">
                        <div class="form-group form-group-required">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['cena']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">Цена {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required {/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}" />
                                
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="span1" style="width: 120px;">
                        <div class="form-group ">
                             {assign var=FIELD_MODEL value=$BLOCK_FIELDS['discount']}
                            {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                            {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}

{/strip}
                            <label for="{$FIELD_MODEL->getFieldName()}">Скидка{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="input-group">
                                
                                    <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
                                    value="{$FIELD_MODEL->get('fieldvalue')}" /><span class="input-group-addon">%</span>
                                
                               
                            </div>
                            
                        </div>
                    </div>
                    <div class="span2" style="width: 170px;">
                        <div class="form-group">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['cenawithdiscount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for='{$FIELD_MODEL->getFieldName()}'>Цена со скидкой{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span>{/if}</label>
                            <div class="input-group">
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if} name="{$FIELD_MODEL->getFieldName()}"
value="{$FIELD_VALUE}"  disabled/>
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                        </div>
                    </div>
                                 {assign var=FIELD_MODEL value=$BLOCK_FIELDS['amount_cur']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="amoun_cur" value=$FIELD_MODEL->get('fieldvalue')}  
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="hidden" name='{$FIELD_MODEL->getFieldName()}' class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if}
value="{$amoun_cur}"  />
                                 {assign var=FIELD_MODEL value=$BLOCK_FIELDS['addcursamount']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}  
                                <input id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="hidden" name='{$FIELD_MODEL->getFieldName()}' class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if}
value="{$FIELD_VALUE}"  />
                                {if $amoun_cur > 0}
                                    <div class="span2 before-currency-change" style="width: 200px;">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <a href='#' class="btn btn-default" onclick='jQuery(".before-currency-change").hide();jQuery(".cursCon").show(); return false;'>Курс валюты изменен</a>
                                    </div>
                                    </div>
                                {/if}

                    <div class="span1 {if $amoun_cur > 0}hide cursCon{/if}" style="width: 110px;" >
                        <div class="form-group form-group-required">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['currenc']}
                            {assign var='FIELD_INFO' value=Zend_Json::encode($FIELD_MODEL->getFieldInfo())}
                            {assign var=PICKLIST_VALUES value=$FIELD_MODEL->getPicklistValues()}
                            {assign var='SPECIAL_VALIDATOR' value=$FIELD_MODEL->getValidator()}
                            {assign var='cur' value=strtolower(trim(decode_html($FIELD_MODEL->get('fieldvalue'))))}
                            <label for="{$FIELD_MODEL->getFieldName()}">Валюта{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span>{/if}</label>
<select  class='form-control   {if $OCCUPY_COMPLETE_WIDTH} row-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
		{if $FIELD_MODEL->isEmptyPicklistOptionAllowed()}<option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>{/if}
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
        <option value='{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}' {if trim(decode_html($FIELD_MODEL->get('fieldvalue'))) eq trim($PICKLIST_NAME)} selected {/if}>{$PICKLIST_VALUE}</option>
    {/foreach}
</select>
                           </div>
                    </div>

                    <div class="span2 {if $amoun_cur > 0}hide cursCon{/if}" >
                        <div class="form-group form-group-required">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['exchange']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">{if $amoun_cur > 0}Начальный курс{else}Курс{/if}{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span>{/if}</label>
                            <div class="input-group">
                                <input {if $amoun_cur > 0}readonly{/if} id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" type="text" name='{$FIELD_MODEL->getFieldName()}' class="form-control" {if $FIELD_MODEL->isMandatory() eq true} required{/if}
value="{$FIELD_VALUE}"  />
                             
                            </div>
                            
                        </div>
                    </div>
                    {if $amoun_cur > 0} <div class="span2 hide cursCon" >
                        <div class="form-group form-group-required">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['exchange']}
                                {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                                {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                                {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            <label for="{$FIELD_MODEL->getFieldName()}">Текущий Курс{if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span>{/if}</label>
                            <div class="input-group">
                                <input type="text" name='newexchange' class="form-control changeExchance" {if $FIELD_MODEL->isMandatory() eq true} required{/if} value="{$FIELD_VALUE}"  />
                             
                            </div>
                            
                        </div>
                    </div>
                    <div class="span2 hide cursCon" >
                            <div class="form-group form-group-required">
                                <label for="booking_edit_booking_additional_payment_type">Тип доплаты <i class="fa fa-check"></i></label>
                                <select class="form-control changeExchance" name="typeaddpayment" id="booking_edit_booking_additional_payment_type">
                                    <option value="PART" selected="">Остаток</option>
                                    <option value="FULL">Полная стоимость</option>
                                </select>
                                
                            </div>
                        </div>
                    {/if}

                                    </div>
               <div class="cms-group-content{if $opportunity_type neq "Пакетный Тур" and $opportunity_type neq "Индивидуальный Тур"} row{/if}" id="booking_add_booking_price_total">
                    <blockquote>
                        <div class="row-fluid">
                            <div class="span8">
                                <p><span id="label_total">{if $opportunity_type eq "Пакетный Тур" or $opportunity_type eq "Индивидуальный Тур"}
                    Полная стоимость тура{else}Полная стоимость{/if}</span>: <span class="total_price">00.00</span> <i class="fa fa-rub"></i>&nbsp;
                                    <span class="curencyAmmount">{if $amoun_cur > 0}
                                     (<i class="fa fa-{$cur}}"></i> {number_format($amount_cur, 2, '.', ' ')} )   
                                        {/if}</span>
                                                                    </p>
                                <small class="total_price_phrase"></small>
                            </div>
                                                                    {if $amoun_cur > 0}
                                                                    <div class="span4 hide cursCon">
                                    <a class="cancelLink" onclick="changeStartCurs();">Изменить валюту/курс</a>
                                    <button class="btn btn-success" type="submit">Все верно, сохранить</button>
                                    <a class="cancelLink" onclick="cancelCurs();">Отменить</a>

                                </div>
                                                                    {/if}
                                                    </div>


                        <div class="hide additional-payment">
                            <div class="row add-price-raw">
                                <div class="span12">
                                    <p>Доплата в связи с изменением курса валюты: <span class="add_price"></span> <i class="fa fa-rub"></i></p>
                                    <small class="add_price_phrase"></small>
                                </div>

                            </div>
                            <div class="row new-price-raw">
                                <div class="span10">
                                    <p><span id="label_total_change">{if $opportunity_type eq "Пакетный Тур" or $opportunity_type eq "Индивидуальный Тур"}
                    Новая стоимость тура{else}Новая стоимость{/if}</span>: <span class="new_price"></span> <i class="fa fa-rub"></i></p>
                                    <small class="new_price_phrase"></small>
                                </div>
                            </div>
                        </div>
                    </blockquote>
                    
                </div>
                    
                    
            </div>
        </div>

{strip}