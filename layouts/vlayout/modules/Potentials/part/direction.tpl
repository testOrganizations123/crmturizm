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
 <div class="row-fluid {if $opportunity_type eq ""}hide{/if} ticket turPaket addShow">
                    <!-- Туроператор -->
                    {if $opportunity_type eq "" || $opportunity_type eq "Пакетный Тур" || $opportunity_type eq "Индивидуальный Тур"}
                    <div class="span3 {if $opportunity_type eq ""}hide{/if} turPaket addShow">
                        <div class="form-group form-group-required">
                             {assign var=FIELD_MODEL value=$BLOCK_FIELDS['turoperator']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                             
                           
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                <select {if $RECORD_ID > 0}onchange="document.getElementById('EditView').submit();" {/if}class='form-control fieldTurPaket' name='{$FIELD_MODEL->getFieldName()}' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getTuroperatorPikList()}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                    </div>
                    {/if}
                    {if $opportunity_type eq "" || $opportunity_type eq "Авиа билеты" || $opportunity_type eq "ЖД билеты"}
                           <!-- Контрагент -->          
                     <div class="span3 {if $opportunity_type eq "" }hide{/if} ticket addShow">
                        <div class="form-group form-group-required">
                             {assign var=FIELD_MODEL value=$BLOCK_FIELDS['turoperator']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            
                           
                            <label for="{$FIELD_MODEL->getFieldName()}">Поставщик авиа-жд билетов</label>
                            <div class="">
                                <select {if $RECORD_ID > 0}onchange="document.getElementById('EditView').submit();" {/if}class='form-control  fieldFlite' name='{$FIELD_MODEL->getFieldName()}_ticket' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getVendorPikList()}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                    </div>
                                    {/if}
                                    {if $opportunity_type eq "" || $opportunity_type eq "Пакетный Тур" || $opportunity_type eq "Индивидуальный Тур"}
                                     <!-- Страна -->
                    <div class="span3 {if $opportunity_type eq "" || $opportunity_type eq "Авиа билеты" || $opportunity_type eq "ЖД билеты"}hide{/if} turPaket addShow">
                        <div class="form-group form-group-required">
                             {assign var=FIELD_MODEL value=$BLOCK_FIELDS['country']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                         
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                <select class='form-control  fieldTurPaket' name='{$FIELD_MODEL->getFieldName()}' {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getCountryPikList()}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}{assign var=country value=$FIELD_VALUE}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                    </div>
                                     <!-- Курорт -->
                    <div class="span3 {if $opportunity_type eq "" || $opportunity_type eq "Авиа билеты" || $opportunity_type eq "ЖД билеты"}hide{/if} turPaket addShow">
                        <div class="form-group form-group-required">
                            {assign var=FIELD_MODEL value=$BLOCK_FIELDS['resort']}
                             {assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
                             {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
                             {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                            
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate($FIELD_MODEL->get('label'), $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                            <div class="">
                                <select class='form-control  fieldTurPaket' name='{$FIELD_MODEL->getFieldName()}'  {if $FIELD_MODEL->isMandatory() eq true} required{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getResortPikList($country)}
                                    <option value="{$KEY}" {if $FIELD_VALUE eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                    </div>
                                    {/if}

</div>
{strip}
