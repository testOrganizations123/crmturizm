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
<div class="row-fluid" id="trans-block-{$index}" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;">
     <div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#trans-block-{$index}').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div>              
                   <!-- Авиакомпания -->
                   <div class="span2 margin0px">
                        <div class="form-group">
                            <label for="ind_transfer_vendor_{$index}">{vtranslate('Перевозчик', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input class='form-control' name='ind_transfer[{$index}][vendor]' required id="ind_transfer_vendor_{$index}" value="{$TRAN.vendor}" />
                              
                            </div>
                        </div>
                    </div>
                    <div class="span2">
                        <div class="form-group">
                            <label for="ind_transfer_name_{$index}">{vtranslate('Транспорт', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_transfer[{$index}][name]' required id="ind_transfer_type_{$index}">
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getTransferPikList()}
                                    <option value="{$KEY}" {if trim(decode_html($TRAN.name)) eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                              
                            </div>
                        </div>
                    </div>
                                    <div class="span2">
                        <div class="form-group">
                            <label for="ind_transfer_type_{$index}">{vtranslate('Тип трансфера', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_transfer[{$index}][type]' required id="ind_transfer_type_{$index}">
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                   
                                    <option value="Индивидуальный" {if trim(decode_html($TRAN.type)) eq 'Индивидуальный'}selected{/if}>Индивидуальный</option>
                                     <option value="Групповой" {if trim(decode_html($TRAN.type)) eq 'Групповой'}selected{/if}>Групповой</option>
                                   
                                    </select>
                              
                            </div>
                        </div>
                    </div>
                                     <div class="span2">
                        <div class="form-group">
                            <label for="ind_transfer_class_{$index}">{vtranslate('Класс', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_transfer[{$index}][class]' required id="ind_transfer_type_{$index}">
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                   
                                    <option value="Premium" {if trim(decode_html($TRAN.class)) eq 'Premium'}selected{/if}>Premium</option>
                                     <option value="Comfort" {if trim(decode_html($TRAN.class)) eq 'Comfort'}selected{/if}>Comfort</option>
                                   
                                    </select>
                              
                            </div>
                        </div>
                    </div><div class="clearfix"></div>
                                     <div class="span2 margin0px">
                        <div class="form-group">
                        <label for="ind_transfer_departure_{$index}">{vtranslate('Откуда', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input class='form-control' name='ind_transfer[{$index}][departure]' required id="ind_transfer_departure_{$index}" value="{$TRAN.departure}" />
                              
                            </div>
                        </div>
                    </div>
                                <div class="span2">
                        <div class="form-group">
                          <label for="ind_transfer_departure_date_{$index}">{vtranslate('Время отправления', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="ind_transfer_departure_date_{$index}" type="text" class="form-control datetimepicker" onchange='' required name="ind_transfer[{$index}][departure_date]"
value="{$TRAN.departure_date}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>
                        </div>
                    </div>
                                <div class="span2">
                                <div class="form-group">
                        <label for="ind_transfer_arrival_{$index}">{vtranslate('Куда', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input class='form-control' name='ind_transfer[{$index}][arrival]' required id="ind_transfer_arrival_{$index}" value="{$TRAN.arrival}" />
                              
                            </div>
                        </div>
                    </div>
                                 <div class="span2">
                                <div class="form-group">
                        <label for="ind_transfer_time_{$index}">{vtranslate('Время в пути', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input class='form-control' name='ind_transfer[{$index}][time]' required id="ind_transfer_time_{$index}" value="{$TRAN.time}" />
                              
                            </div>
                        </div>
                    </div>
                                <div class="clearfix"></div>

                                    <!-- Туроператор -->   
                                     <div class="span3 margin0px" >
                                   <div class="form-group form-group-required">
                            
                             
                           
                            <label for="ind_transfer_turop_{$index}">{vtranslate('Туроператор', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_transfer[{$index}][turoperator]' required >
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getTuroperatorPikList()}
                                    <option value="{$KEY}" {if $TRAN.turoperator eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                                </div>

                                     <!-- Список туристов -->   
                                     <div class="span4" >
                                    <div class="form-group ">
                                      
                            <label for="ind_transfer_turlist_{$index}">{vtranslate('Туристы', $MODULE)} <span class="redColor">*</span> </label>
                            
                               
                                <select class='chzn-select form-control listTurist' multiple name='ind_transfer[{$index}][turlist][]'  required style="width:300px;">
                                   {foreach item=turist key=key from=$TRAN.turlist}
                                       <option value="{$turist}" selected=""></option>
                                       {/foreach}
                                    
                                    
                                    </select>
                                   
                                </div>
                                </div>
                                 <!-- Стоимость -->   
                                     <div class="span2" >
                                    <div class="form-group ">
                                      
                            <label for="ind_transfer_cost_{$index}">{vtranslate('Стоимость', $MODULE)} <span class="redColor">*</span> </label>
                            
                                 <div class="input-group ">
                               <input id="ind_transfer_turlist_{$index}" class="form-control suumTurOption" name="ind_transfer[{$index}][cost]" value="{$TRAN.cost}" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span>
                                   
                                    
                                    
                                    </div>
                                   
                                </div>
                                </div>
</div>
          
{strip}
