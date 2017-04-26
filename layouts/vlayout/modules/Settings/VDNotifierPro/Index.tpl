{*<!--
/* * *******************************************************************************
 * The content of this file is subject to the VD Notifier Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is http://www.vordoom.net
 * Portions created by Vordoom.net are Copyright(C) Vordoom.net
 * All Rights Reserved.
 * ****************************************************************************** */

-->*}
{strip}
	<div class="container-fluid" id="moduleManagerContents">
		<div class="widget_header row-fluid">
			<div class="span6"><h3>{vtranslate('LBL_NOTIFIERPRO_MANAGER', $MODULE)}</h3></div>
			<div class="span6">
				
			</div>
		</div>
		<hr>
		<div class="widget_header row-fluid">
			<div class="span2"><h5>{vtranslate('LBL_NOTIFIERPRO_SETTING', $MODULE)}:</h5></div>
			<div class="span2">
                            <span class="row-fluid">
                                <span class="span9">
                            <label>{vtranslate('LBL_NOTIFIERPRO_SETTING_ajaxNotifier', $MODULE)}</label>
                                </span>
                                <span class="span3">
                            <input name="ajaxVDNotifier" id="ajaxVDNotifier" value="1" type="checkbox" {if $SETTING['a'] eq 1}checked="checked" {/if}>
                                </span>
                            </span>
			</div>
                        <div class="span2">
                            <span class="row-fluid">
                                <span class="span6">
                            <label>{vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER', $MODULE)}</label>
                                </span>
                                <span class="span6">
                                    <select name="ajaxTime" id="ajaxTime" class="chzn-select" style="width:80px;">
                                        <option value="5000" {if $SETTING['t'] eq 5000}selected="selected" {/if}>{vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_5SEC', $MODULE)}</option>
                                        <option value="10000" {if $SETTING['t'] eq 10000}selected="selected" {/if}>{vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_10SEC', $MODULE)}</option>
                                        <option value="15000" {if $SETTING['t'] eq 15000}selected="selected" {/if}>{vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_15SEC', $MODULE)}</option>
                                        <option value="30000" {if $SETTING['t'] eq 30000}selected="selected" {/if}>{vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_30SEC', $MODULE)}</option>
                                        <option value="60000" {if $SETTING['t'] eq 60000}selected="selected" {/if}>{vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_1MIN', $MODULE)}</option>
                                    </select>
                                </span>
                            </span>
			</div>
                        <div class="span2" style="display:none">
                            <span class="row-fluid">
                                <span class="span3">
                            <label>{vtranslate('LBL_NOTIFIERPRO_SETTING_KEY', $MODULE)}</label>
                                </span>
                                <span class="span9">
                                    <input name="keyVDNotifier" id="keyVDNotifier" class="input-large" value="{$SETTING['k']}" {if $SETTING['k'] neq ''}readonly="readonly" {/if} type="text" />
                                </span>
                            </span>
			</div>
                                
                                <div class="span2" style="display:none">
                                    {if $SETTING['k'] neq ''}
                                        <button class="btn btn-success deleteDomen pull-left" ><strong>{vtranslate('LBL_DELETE')}</strong></button>
                                    {else}
                                         <button class="btn btn-success installDomen pull-left" ><strong>{vtranslate('LBL_INSTALL', $MODULE)}</strong></button>
                                    {/if}
                                    </div>
                                
                                    <div class="span2">
                                        <button class="btn btn-success saveSetting pull-right" ><strong>{vtranslate('LBL_SAVE')}</strong></button>
                                    </div>
		</div>
		<hr>
		<div class="contents">
			{assign var=COUNTER value=0}
			<table class="table table-bordered equalSplit">
                            <tr><th width="100%"><div class="row-fluid">
                                <span class="span3">{vtranslate('LBL_NOTIFIERPRO_MODULE_NAME', $MODULE)}</span>
                                <span class="span9">
                                    <div class="row-fluid">
                                        <span class="span2">{vtranslate('LBL_NOTIFIERPRO_STATUS', $MODULE)}</span>
                                <span class="span2">{vtranslate('LBL_NOTIFIERPRO_CREATOR', $MODULE)}</span>
                                <span class="span2">{vtranslate('LBL_NOTIFIERPRO_OWNER', $MODULE)}</span>
                                <span class="span2">{vtranslate('LBL_NOTIFIERPRO_MODIFICATOR', $MODULE)}</span>
                                <span class="span2">{vtranslate('LBL_NOTIFIERPRO_CREATE_SHOW', $MODULE)}</span>
                                <span class="span2">{vtranslate('LBL_NOTIFIERPRO_UPDATE_SHOW', $MODULE)}</span>
                                    </div>
                                </span>
                            </div>
                                </th></tr>
				
				{foreach item=MODULE_MODEL key=MODULE_ID from=$ALL_MODULES}
					{assign var=MODULE_NAME value=$MODULE_MODEL->get('name')}
					{assign var=MODULE_ACTIVE value=$MODULE_MODEL->isActive()}
                                        {assign var=MODULE_ID value=$MODULE_MODEL->getID()}
					<tr>

					<td class="opacity">
						<div class="row-fluid moduleManagerBlock">
							
							<span class="span3"><div class="row-fluid">
                                                                
							<span class="span2 moduleImage {if !$MODULE_ACTIVE}dull {/if}">
								{if vimage_path($MODULE_NAME|cat:'.png') != false}
									<img class="alignMiddle" src="{vimage_path($MODULE_NAME|cat:'.png')}" alt="{vtranslate($MODULE_NAME, $MODULE_NAME)}" title="{vtranslate($MODULE_NAME, $MODULE_NAME)}"/>
								{else}
									<img class="alignMiddle" src="{vimage_path('DefaultModule.png')}" alt="{vtranslate($MODULE_NAME, $MODULE_NAME)}" title="{vtranslate($MODULE_NAME, $MODULE_NAME)}"/>
								{/if}	
							</span>
							<span class="span10 moduleName {if !$MODULE_ACTIVE}dull {/if}"><h4>{vtranslate($MODULE_NAME, $MODULE_NAME)}</h4></span>
                                                        </div>
                                                        </span>
                                                        <span class="span9">
                                                            <div class="row-fluid">
                                                        <span class="span2" >
								<input class="VDNotifierProInput " data-placement="right" data-toggle="tooltips" data-original-title="{vtranslate('LBL_NOTIFIERPRO_STATUS', $MODULE)}" type="checkbox" value=""  name="status" data-module="{$MODULE_NAME}" data-module-translation="{vtranslate($MODULE_NAME, $MODULE_NAME)}" {if $MODULE_MODEL->setting['status']}checked{/if} />
							</span>
                                                        <span class="span2">
								<input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="{vtranslate('LBL_NOTIFIERPRO_CREATOR', $MODULE)}" type="checkbox" value="" title="" name="creator" data-module="{$MODULE_NAME}" data-module-translation="{vtranslate($MODULE_NAME, $MODULE_NAME)}" {if $MODULE_MODEL->setting['creator']}checked{/if} />
							</span>
                                                        <span class="span2">
								<input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="{vtranslate('LBL_NOTIFIERPRO_OWNER', $MODULE)}" type="checkbox" value="" title="" name="owner" data-module="{$MODULE_NAME}" data-module-translation="{vtranslate($MODULE_NAME, $MODULE_NAME)}" {if $MODULE_MODEL->setting['owner']}checked{/if} />
							</span>
                                                        <span class="span2">
								<input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="{vtranslate('LBL_NOTIFIERPRO_MODIFICATOR', $MODULE)}" type="checkbox" value="" title="" name="modif" data-module="{$MODULE_NAME}" data-module-translation="{vtranslate($MODULE_NAME, $MODULE_NAME)}" {if $MODULE_MODEL->setting['modif']}checked{/if} />
							</span>
                                                        <span class="span2">
								<input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="{vtranslate('LBL_NOTIFIERPRO_CREATE_SHOW', $MODULE)}" type="checkbox" value="" title="" name="newentity" data-module="{$MODULE_NAME}" data-module-translation="{vtranslate($MODULE_NAME, $MODULE_NAME)}" {if $MODULE_MODEL->setting['newentity']}checked{/if} />
							</span>
                                                        <span class="span2">
								<input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="{vtranslate('LBL_NOTIFIERPRO_UPDATE_SHOW', $MODULE)}" type="checkbox" value="" title="" name="updateentity" data-module="{$MODULE_NAME}" data-module-translation="{vtranslate($MODULE_NAME, $MODULE_NAME)}" {if $MODULE_MODEL->setting['updateentity']}checked{/if} />
							</span>
						</div></span>
                                                        </div>
						{assign var=COUNTER value=$COUNTER+1}
					</td>
                                        </tr>
				{/foreach}
				
			</table>
		</div>
                                
	</div>
                                <div><p class="small pull-right">Power by VD Notifier Pro. All rights reserved. Copyright &copy; {date('Y')} <a href='http://www.vordoom.net' target="_blank">www.vordoom.net</a> </p></div>
{/strip}
