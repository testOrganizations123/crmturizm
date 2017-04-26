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
<div class="row-fluid" id="source-block-{$index}" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;">
               <div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#source-block-{$index}').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div>    
                   <!-- Страна -->
                    <div class="span3 margin0px">
                        <div class="form-group">
                            <label for="ind_source_name_{$index}">{vtranslate('Страна', $MODULE)} <span class="redColor">*</span></label>
                            <div class="">
                                <select class='form-control' name='ind_source[{$index}][name]' required id="ind_source_name_{$index}" onchange="getResorts({$index});">
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getCountryPikList()}
                                    <option value="{$KEY}" {if trim(decode_html($Source.name)) eq $KEY}{assign var=country value=$Source.name}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                              
                            </div>
                        </div>
                    </div>
<!-- Курорт -->

                    <div class="span3">
                        <div class="form-group">
                          <label for="ind_source_resort_{$index}">{vtranslate('Город/Курорт', $MODULE)} <span class="redColor">*</span></label>
                            <div id="type_room">
                                 <div class="input-group">
                                     <select class='form-control' name='ind_source[{$index}][resort]' required id="ind_source_resort_{$index}">
                                   <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                    {foreach key=KEY item=VALUE from=$RECORD_STRUCTURE_MODEL->getResortPikList($country)}
                                    <option value="{$KEY}" {if trim(decode_html($Source.name)) eq $KEY}selected{/if}>{$VALUE}</option>
                                    {/foreach}
                                    </select>
                                
                                
                                
                                
                            </div>
                              </div>
                        </div>
                    </div>
                                                                     
                      <div class="span6"></div>
                       
                        <div class="clearfix"></div>
                        
                    
</div>
          
{strip}
