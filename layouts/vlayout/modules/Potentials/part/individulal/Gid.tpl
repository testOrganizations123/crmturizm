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
<div class="row-fluid" id="gid-block-{$index}" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;">
     <div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#gid-block-{$index}').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div>             
                   <!-- Услуга -->
                    <div class="span2">
                        <div class="form-group">
                            <label for="ind_gid_name_{$index}">{vtranslate('Услуга', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_gid[{$index}][name]' required id="ind_gid_type_{$index}">
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getServicePickList('Услуги гида индтур')}
                                    <option value="{$KEY}" {if trim(decode_html($GID.name)) eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                              
                            </div>
                        </div>
                    </div>

                                    <!-- Туроператор -->   
                                     <div class="span3 " >
                                   <div class="form-group form-group-required">
                            
                             
                           
                            <label for="ind_gid_turop_{$index}">{vtranslate('Туроператор', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_gid[{$index}][turoperator]' required >
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getTuroperatorPikList()}
                                    <option value="{$KEY}" {if $GID.turoperator eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                  
                            </div>
                        </div>
                                </div>

                                     <!-- Список туристов -->   
                                     <div class="span4" >
                                    <div class="form-group ">
                                      
                            <label for="ind_gid_turlist_{$index}">{vtranslate('Туристы', $MODULE)} <span class="redColor">*</span> </label>
                            
                               
                                <select class='chzn-select form-control listTurist' multiple name='ind_gid[{$index}][turlist][]'  required style="width:300px;">
                                   {foreach item=turist key=key from=$GID.turlist}
                                       <option value="{$turist}" selected=""></option>
                                       {/foreach}
                                    
                                    
                                    </select>
                                   
                                </div>
                                </div>
                                 <!-- Стоимость -->   
                                     <div class="span2" >
                                    <div class="form-group ">
                                      
                            <label for="ind_gid_cost_{$index}">{vtranslate('Стоимость', $MODULE)} <span class="redColor">*</span> </label>
                            
                                 <div class="input-group ">
                               <input id="ind_gid_turlist_{$index}" class="form-control suumTurOption" name="ind_gid[{$index}][cost]" value="{$GID.cost}" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span>
                                   
                                    
                                    
                                    </div>
                                   
                                </div>
                                </div>
</div>
          
{strip}
