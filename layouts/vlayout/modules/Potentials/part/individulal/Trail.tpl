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
<div class="row-fluid" id="trail-block-{$index}" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;">
               <div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#trail-block-{$index}').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div>    
                   <!-- Авиакомпания -->
                    <div class="span2 margin0px">
                        <div class="form-group">
                            <label for="ind_trail_name_{$index}">{vtranslate('ЖД Компания', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input class='form-control' name='ind_trail[{$index}][name]' required id="ind_trail_name_{$index}" value="{$Trail.name}" />
                                   
                              
                            </div>
                        </div>
                    </div>
<!-- № поезда -->

                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_trail_no_{$index}">{vtranslate('Номер поезда', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                 <div class="input-group">
                                
                                <input style="height: 26px;" id="ind_trail_no_{$index}" type="text" class="form-control" required name="ind_trail[{$index}][no]"
value="{$Trail.no}"  />
                                
                                
                            </div>
                              </div>
                        </div>
                    </div>
                                                                     
                        
<!-- Тип вагона -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_trail_type_{$index}">{vtranslate('Тип вагона', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                <select id="ind_trail_type_{$index}" name='ind_trail[{$index}][type]' required class="form-control">
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                <option value="купе" {if $Trail.type eq 'купе'}selected{/if}>Купе</option>
                                <option value="СВ" {if $Trail.type eq 'СВ'}selected{/if}>СВ</option>
                                <option value="плацкард" {if $Trail.type eq 'плацкард'}selected{/if}>Плацкард</option>
                                <option value="женский" {if $Trail.type eq 'женский'}selected{/if}>Женский</option>
                                <option value="мужской" {if $Trail.type eq 'мужской'}selected{/if}>Мужской</option>
                                   
                        </select>
                              </div>
                        </div>
                        
                    </div>
<!-- № вагона -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_trail_vagno_{$index}">{vtranslate('№ вагона', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input id="ind_trail_vagno_{$index}" name='ind_trail[{$index}][vagno]' required class="form-control" value="{$Trail.vagno}">
                                
                              </div>
                        </div>
                        
                    </div>
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_trail_setno_{$index}">{vtranslate('Место', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input id="ind_trail_setno_{$index}" name='ind_trail[{$index}][setno]' required class="form-control" value="{$Trail.setno}">
                                
                              </div>
                        </div>
                        
                    </div>
                       
                        <div class="clearfix"></div>
                        
<!-- Откуда  -->
                    <div class="span2 margin0px">
                        <div class="form-group">
                          <label for="ind_trail_departure_{$index}">{vtranslate('Откуда', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input id="ind_trail_departure_{$index}" class='form-control ticket turPaket addShow ' name='ind_trail[{$index}][departure]' required value="{$Trail.departure}">
                                 
                              </div>
                        </div>
                    </div>
 <!-- Вылет  -->                                   
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_trail_departure_date_{$index}">{vtranslate('Отправление', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="ind_trail_departure_date_{$index}" type="text" class="form-control datetimepicker" onchange='' required name="ind_trail[{$index}][departure_date]"
value="{$Trail.departure_date}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>
                        </div>
                    </div>
<!-- Куда  -->
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_trail_arrival_{$index}">{vtranslate('Куда', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                <input id="ind_trail_arrival_{$index}" class='form-control' name='ind_trail[{$index}][arrival]' required value="{$Trail.arrival}">
                                   
                              
                              </div>
                        </div>
                    </div>
 <!-- Прилет  -->                                   
                    <div class="span2">
                        <div class="form-group">
                          <label for="ind_trail_arrival_date_{$index}">{vtranslate('Прибытие', $MODULE)} <span class="redColor">*</span></label>
                            <div class="input-group">
                                
                                <input style="height: 26px;" id="ind_trail_arrival_date_{$index}" type="text" class="form-control datetimepicker" onchange='' required name="ind_trail[{$index}][arrival_date]"
value="{$Trail.arrival_date}"  />
                               <span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                
                            </div>
                        </div>
                    </div>
                                <div class="span4">&nbsp;</div>
                        <div class="clearfix"></div>
                  
                                    <!-- Туроператор -->   
                                     <div class="span4 margin0px" style="width:305px">
                                   <div class="form-group form-group-required">
                            
                             
                           
                            <label for="ind_trail_turop_{$index}">{vtranslate('Туроператор', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_trail[{$index}][turoperator]' required >
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getTuroperatorPikList()}
                                    <option value="{$KEY}" {if $Trail.turoperator eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                                </div>

                                     <!-- Список туристов -->   
                                     <div class="span4" style="width:305px">
                                    <div class="form-group ">
                                      
                            <label for="ind_trail_turlist_{$index}">{vtranslate('Туристы', $MODULE)} <span class="redColor">*</span> </label>
                            
                               
                                <select class='chzn-select form-control listTurist' multiple name='ind_trail[{$index}][turlist][]'  required style="width:300px;">
                                   {foreach item=turist key=key from=$Trail.turlist}
                                       <option value="{$turist}" selected=""></option>
                                       {/foreach}
                                    
                                    
                                    </select>
                                   
                                </div>
                                </div>
                                 <!-- Стоимость -->   
                                     <div class="span4" style="width:305px">
                                    <div class="form-group ">
                                      
                            <label for="ind_trail_cost_{$index}">{vtranslate('Стоимость', $MODULE)} <span class="redColor">*</span> </label>
                            
                                 <div class="input-group ">
                               <input id="ind_trail_turlist_{$index}" class="form-control suumTurOption" name="ind_trail[{$index}][cost]" value="{$Trail.cost}" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span>
                                   
                                    
                                    
                                    </div>
                                   
                                </div>
                                </div>
</div>
          
{strip}
