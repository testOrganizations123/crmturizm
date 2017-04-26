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
<div class="row-fluid" id="planed-block-{$index}" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;">
               <div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#planed-block-{$index}').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div>    
                   <!-- Авиакомпания -->
                    <div class="span2 margin0px">
                        <div class="form-group">
                            <label for="ind_flyte_name_{$index}">{vtranslate('Авиакомпания', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_flyte[{$index}][name]' required id="ind_flyte_name_{$index}">
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getAirlinePikList()}
                                    <option value="{$KEY}" {if trim(decode_html($FLY.name)) eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                              
                            </div>
                        </div>
                    </div>
<!-- Рейс -->

                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_flyte_fly_no_{$index}">{vtranslate('Рейс', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                 <div class="input-group">
                                
                                <input style="height: 26px;" id="ind_flyte_fly_no_{$index}" type="text" class="form-control" required name="ind_flyte[{$index}][fly_no]"
value="{$FLY.fly_no}"  />
                                
                                
                            </div>
                              </div>
                        </div>
                    </div>
                                                                     
                        
<!-- Тип рейса -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_flyte_type_{$index}">{vtranslate('Тип рейса', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_flyte_food_{$index}" name='ind_flyte[{$index}][type]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                         <option value="регулярный" {if $FLY.type eq 'регулярный'}selected{/if}>Регуляный</option>
                                    <option value="чартер" {if $FLY.type eq 'чартер'}selected{/if}>Чартер</option>
                        </select>
                              </div>
                        </div>
                        
                    </div>
<!-- Класс -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_flyte_class_{$index}">{vtranslate('Класс', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_flyte_class_{$index}" name='ind_flyte[{$index}][class]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                         <option value="экономичный" {if $FLY.class eq 'экономичный'}selected{/if}>Экономичный</option>
                                    <option value="бизнес" {if $FLY.class eq 'бизнес'}selected{/if}>Бизнес</option>
                                    <option value="комфорт" {if $FLY.class eq 'комфорт'}selected{/if}>Повышенной комфортности</option>
                        </select>
                              </div>
                        </div>
                        
                    </div>
                        <div class="span1">
                        <div class="form-group">
                          <label for="ind_flyte_bagage_{$index}">{vtranslate('Багаж', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_flyte_bagage_{$index}" name='ind_flyte[{$index}][bagage]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                         <option value="0" {if $FLY.class eq '0'}selected{/if}>Нет</option>
                                    <option value="10" {if $FLY.bagage eq '10'}selected{/if}>10кг</option>
                                    <option value="15" {if $FLY.bagage eq '15'}selected{/if}>15кг</option>
                                    <option value="20" {if $FLY.bagage eq '20'}selected{/if}>20кг</option>
                                    <option value="25" {if $FLY.bagage eq '25'}selected{/if}>25кг</option>
                                    <option value="30" {if $FLY.bagage eq '30'}selected{/if}>30кг</option>
                                    <option value="35" {if $FLY.bagage eq '35'}selected{/if}>35кг</option>
                                    <option value="40" {if $FLY.bagage eq '40'}selected{/if}>40кг</option>
                        </select>
                              </div>
                        </div>
                        
                    </div>
                        <div class="span2">
                        <div class="form-group">
                          <label for="ind_flyte_food_{$index}">{vtranslate('Питание', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_flyte_class_{$index}" name='ind_flyte[{$index}][food]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                         <option value="Нет" {if $FLY.food eq 'Нет'}selected{/if}>Нет</option>
                                    <option value="Есть" {if $FLY.food eq 'Есть'}selected{/if}>Есть</option>
                                   
                        </select>
                              </div>
                        </div>
                        
                    </div>
                       
                        <div class="clearfix"></div>
                        
<!-- Откуда  -->
                    <div class="span2 margin0px">
                        <div class="form-group">
                          <label for="ind_flyte_departure_{$index}">{vtranslate('Откуда', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_flyte_departure_{$index}" class='form-control ticket turPaket addShow ' name='ind_flyte[{$index}][departure]' required >
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getAirportsPikList()}
                                    <option value="{$KEY}" {if $FLY.departure eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                              
                              </div>
                        </div>
                    </div>
 <!-- Вылет  -->                                   
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_flyte_departure_date_{$index}">{vtranslate('Вылет', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="ind_flyte_departure_date_{$index}" type="text" class="form-control datetimepicker" onchange='' required name="ind_flyte[{$index}][departure_date]"
value="{$FLY.departure_date}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>
                        </div>
                    </div>
<!-- Куда  -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_flyte_arrival_{$index}">{vtranslate('Куда', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_flyte_departure_{$index}" class='form-control ticket turPaket addShow ' name='ind_flyte[{$index}][arrival]' required >
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getAirportsPikList()}
                                    <option value="{$KEY}" {if $FLY.arrival eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                              
                              </div>
                        </div>
                    </div>
 <!-- Прилет  -->                                   
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_flyte_arrival_date_{$index}">{vtranslate('Прилет', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="ind_flyte_arrival_date_{$index}" type="text" class="form-control datetimepicker" onchange='' required name="ind_flyte[{$index}][arrival_date]"
value="{$FLY.arrival_date}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>
                        </div>
                    </div>
                                <div class="span4">&nbsp;</div>
                        <div class="clearfix"></div>
                  
                                    <!-- Туроператор -->   
                                     <div class="span4 margin0px" style="width:305px">
                                   <div class="form-group form-group-required">
                            
                             
                           
                            <label for="ind_flyte_turop_{$index}">{vtranslate('Туроператор', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_flyte[{$index}][turoperator]' required >
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getTuroperatorPikList()}
                                    <option value="{$KEY}" {if $FLY.turoperator eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                                </div>

                                     <!-- Список туристов -->   
                                     <div class="span4" style="width:305px">
                                    <div class="form-group ">
                                      
                            <label for="ind_flyte_turlist_{$index}">{vtranslate('Туристы', $MODULE)} <span class="redColor">*</span> </label>
                            
                               
                                <select class='chzn-select form-control listTurist' multiple name='ind_flyte[{$index}][turlist][]'  required style="width:300px;">
                                   {foreach item=turist key=key from=$FLY.turlist}
                                       <option value="{$turist}" selected=""></option>
                                       {/foreach}
                                    
                                    
                                    </select>
                                   
                                </div>
                                </div>
                                 <!-- Стоимость -->   
                                     <div class="span4" style="width:305px">
                                    <div class="form-group ">
                                      
                            <label for="ind_flyte_cost_{$index}">{vtranslate('Стоимость', $MODULE)} <span class="redColor">*</span> </label>
                            
                                 <div class="input-group ">
                               <input id="ind_flyte_turlist_{$index}" class="form-control suumTurOption" name="ind_flyte[{$index}][cost]" value="{$FLY.cost}" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span>
                                   
                                    
                                    
                                    </div>
                                   
                                </div>
                                </div>
</div>
          
{strip}
