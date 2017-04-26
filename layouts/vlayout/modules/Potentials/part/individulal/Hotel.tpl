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
<div class="row-fluid" id="hotel-block-{$index}" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;">
                    <!-- Отель -->
                    <div class="span3">
                        <div class="form-group">
                            <label for="ind_hotel_name_{$index}">{vtranslate('Название отеля', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                               <input style="height: 26px;" id="ind_hotel_name_{$index}" type="text" class="form-control" required name="ind_hotel[{$index}][name]" value="{$HOTEL.name}"  />
                            </div>
                        </div>
                    </div>
<!-- тип номера -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_hotel_room_{$index}">{vtranslate('Тип номера', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_hotel_room_{$index}" name='ind_hotel[{$index}][room]' required class="form-control">
                        <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                        {foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$MODULE_MODEL->getRoomsType()}
                        <option value='{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' {if trim(decode_html($HOTEL.room)) eq trim($PICKLIST_VALUE)} selected {/if}>{$PICKLIST_VALUE}</option>
                        {/foreach}
                        </select>
                              </div>
                        </div>
                    </div>
                                                                     
                        
<!-- Питание -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_hotel_food_{$index}">{vtranslate('Питание', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_hotel_food_{$index}" name='ind_hotel[{$index}][food]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                        {foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$MODULE_MODEL->getFoodsType()}
                        <option value='{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' {if trim(decode_html($HOTEL.food)) eq trim($PICKLIST_VALUE)} selected {/if}>{$PICKLIST_VALUE}</option>
                        {/foreach}
                        </select>
                              </div>
                        </div>
                    </div>
                                <!-- Размещение -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_hotel_placement_{$index}">{vtranslate('Размещение', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_hotel_placement_{$index}" name='ind_hotel[{$index}][placement]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                        {foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$MODULE_MODEL->getPlacementsType()}
                        <option value='{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' {if trim(decode_html($HOTEL.placement)) eq trim($PICKLIST_VALUE)} selected {/if}>{$PICKLIST_VALUE}</option>
                        {/foreach}
                        </select>
                              </div>
                        </div>
                    </div>
                                <!-- Количество ночей -->
                     <div class="span2">
                        <div class="form-group">
                          <label for="ind_hotel_night_{$index}">{vtranslate('Количество ночей', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_hotel_night_{$index}" name='ind_hotel[{$index}][night]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                   {foreach item=KEY from=$MODULE_MODEL->getCountArrayNumber(31)}
                                    <option value="{$KEY}" {if $HOTEL.night eq $KEY}selected{/if}>{$KEY}</option>
                                    {/foreach}
                                    </select>
                                  
                                </div>
                    </div>
                    <div class="span4" style="width:305px">
                                    <div class="form-group form-group-required">
                                      
                            <label for="{$FIELD_MODEL->getFieldName()}">{vtranslate('Туристы', $MODULE)} {if $FIELD_MODEL->isMandatory() eq true} <span class="redColor">*</span> {/if}</label>
                           
                                
                                <select class='addServiseCalculate chzn-select form-control listTurist' multiple name='ind_hotel[{$index}][turlist]'  required style="width:300px;">
                                   
                                    
                                    
                                    </select>
                                   
                                </div>
                                </div>
                </div>
</div>
          
{strip}
