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
      <div class="blockShow">
            <div class="cms-group cms-group-expanded">
                <div class="cms-group-label">Состав тура</div>
        {*         <!-- Блок Маршрут -
                <div class="row-fluid" style="margin-top:25px">
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-globe" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;Маршрут</span>
                                    <a href="" onclick="addTurOption(event,'source')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                 {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_source']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Sources value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                      
                                <div id="source-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Sources }background:#eaeaea;border:1px solid #ccc;{/if}">
                                    
                                     
                                     
                                     {if $Sources }
                                         {foreach key=KEY item=Source from=$Sources}
                                           
                                            {include file=vtemplate_path('part/individulal/Source.tpl',$MODULE) index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                                
                            </div>
                        
                    </div>
                    </div>
                </div> -->*}
                
             <!-- Блок отель -->
                <div class="row-fluid" style="margin-top:25px">
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-bed" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;Проживание</span>
                                    <a href="" onclick="addTurOption(event,'hotel')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                 {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_hotel']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Hotels value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                      
                                <div id="hotel-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Hotels }background:#eaeaea;border:1px solid #ccc;{/if}">
                                    
                                     
                                     
                                     {if $Hotels }
                                         {foreach key=KEY item=Hotel from=$Hotels}
                                           
                                            {include file=vtemplate_path('part/individulal/Hotel.tpl',$MODULE) HOTEL=$Hotel index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                                
                            </div>
                        
                    </div>
                    </div>
                </div>
             <!-- Блок перелет -->
                <div class="row-fluid" >
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-plane" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;Перелет</span>
                                    <a href="" onclick="addTurOption(event,'planed')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_flyte']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Planed value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                      
                                <div id="planed-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Planed }background:#eaeaea;border:1px solid #ccc;{/if}">
                                     {if $Planed }
                                         {foreach key=KEY item=Fly from=$Planed}
                                           
                                            {include file=vtemplate_path('part/individulal/Planed.tpl',$MODULE) FLY=$Fly index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                                
                            </div>
                        
                    </div>
                    </div>
                </div>
             <!-- Блок ЖД -->
                <div class="row-fluid" >
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-sliders" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;ЖД переезд</span>
                                    <a href="" onclick="addTurOption(event,'trail')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_trail']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Trails value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                      
                                <div id="trail-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Trails }background:#eaeaea;border:1px solid #ccc;{/if}">
                                     {if $Trails }
                                         {foreach key=KEY item=Trail from=$Trails}
                                           
                                            {include file=vtemplate_path('part/individulal/Trail.tpl',$MODULE) index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                                
                            </div>
                        
                    </div>
                    </div>
                </div>
             <!-- Блок трансфер -->
                <div class="row-fluid" >
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-bus" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;Трансфер</span>
                                    <a href="" onclick="addTurOption(event,'transfer')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_transfer']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Transfer value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                      
                                <div id="transfer-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Transfer }background:#eaeaea;border:1px solid #ccc;{/if}">
                                     {if $Transfer }
                                         {foreach key=KEY item=Tran from=$Transfer}
                                           
                                            {include file=vtemplate_path('part/individulal/Transfer.tpl',$MODULE) TRAN=$Tran index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                                
                                
                            </div>
                        
                    </div>
                    </div>
                </div>
             <!-- Блок услуги гида -->
                <div class="row-fluid" >
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-user" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;Услуги гида</span>
                                    <a href="" onclick="addTurOption(event,'gid')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_gid']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Gids value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                     
                                <div id="gid-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Gids }background:#eaeaea;border:1px solid #ccc;{/if}">
                                     {if $Gids }
                                         {foreach key=KEY item=Gid from=$Gids}
                                           
                                            {include file=vtemplate_path('part/individulal/Gid.tpl',$MODULE) GID=$Gid index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                               
                                
                            </div>
                        
                    </div>
                    </div>
                </div>
             <!-- Блок страховки -->
                <div class="row-fluid" >
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-heartbeat" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;Страховка</span>
                                    <a href="" onclick="addTurOption(event,'inshur')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_inshure']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Inshures value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                      
                                <div id="inshur-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Inshures }background:#eaeaea;border:1px solid #ccc;{/if}">
                                     {if $Inshures }
                                         {foreach key=KEY item=Inshure from=$Inshures}
                                           
                                            {include file=vtemplate_path('part/individulal/Inshure.tpl',$MODULE) index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                               
                                
                            </div>
                        
                    </div>
                    </div>
                </div>
             <!-- Блок дополнительные услуги -->
                <div class="row-fluid" >
                    <div class="span12">
                        <div class="cms-group cms-group-white">
                            <div class="row-fluid">
                                <div class="span2">
                                    <span style="font-size:14px"><i class="fa fa-th" aria-hidden="true" style="font-size:18px"></i>
                                        &nbsp;&nbsp;Доп. услуги</span>
                                    <a href="" onclick="addTurOption(event,'other')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
&nbsp;&nbsp;Добавить</a>
                                </div>
                                {assign var=FIELD_MODEL value=$BLOCK_FIELDS['ind_servise']}
                                     {assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
                                     
                                     {assign var=Others value=unserialize(htmlspecialchars_decode($FIELD_VALUE))}
                                      
                                <div id="other-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  {if $Others }background:#eaeaea;border:1px solid #ccc;{/if}">
                                     {if $Others }
                                         {foreach key=KEY item=Other from=$Others}
                                           
                                            {include file=vtemplate_path('part/individulal/Other.tpl',$MODULE) index=$KEY}
                                         {/foreach}
                                         {/if}
                                </div>
                                
                                
                            </div>
                        
                    </div>
                    </div>
                </div>
             
            </div>
      </div>
{strip}