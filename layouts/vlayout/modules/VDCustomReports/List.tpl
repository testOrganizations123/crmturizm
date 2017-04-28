{*<!--
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: EntExt
 * The Initial Developer of the Original Code is EntExt.
 * All Rights Reserved.
 * If you have any questions or comments, please email: devel@entext.com
 ************************************************************************************/
-->*}

{strip}
    <div id="listViewContents" class="VDDialogueDesigner_container listViewPageDiv listViewContentDiv"
         style="padding-left: 3%;padding-right: 3%">
        <br/>
        <br/>
        <div class="listViewEntriesTable row-fluid">
            <form action="index.php?module=VDCustomReports&view=List&mode={$MODE}" method="GET">
                <input type="hidden" name="module" value="VDCustomReports">
                <input type="hidden" name="view" value="List">
                <input type="hidden" name="mode" value="{$MODE}">
                {foreach item=item from=$FILTER}
                    <div class="span2"><label>{$item['label']}</label>
                        {if isset($item['tpl'])}
                            {include file=vtemplate_path($item['tpl'],$MODULE) USER_MODEL=$USER_MODEL }
                        {elseif $item['type'] eq "select"}
                            <div class="row-fluid">

                                <select class='listSearchContributor region span12' name='filtre[region]'
                                        {literal}data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}'{/literal} />
                                <option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
                                {foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$item['option']}
                                    <option value="{$PICKLIST_VALUE['value']}"
                                            data-picklistvalue='{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE['value'])}' {if $PICKLIST_VALUE['value'] eq $item['data']} selected {/if}

                                            data-userId="{$USER_MODEL->get('id')}">
                                        {$PICKLIST_VALUE['label']}
                                    </option>
                                {/foreach}
                                </select>
                            </div>
                        {/if}
                    </div>
                {/foreach}
                <div class="span2"><label>&nbsp;</label>
                    <div class="row-fluid">
                        <input type="submit" value="Сгенерировать" class="btn btn-success span12"/>
                    </div>
                </div>
                {if isset($EDITPLANBUTTON) && $EDITPLANBUTTON == true }
                    <div class="span2"><label>&nbsp;</label>
                        <div class="row-fluid">
                            <input type="button" value="Редактировать" class="btn btn-success edit-button span12"
                                   onclick="window.location.href = 'index.php?module=VDCustomReports&view=List&mode=editSalesPlan'">
                        </div>
                    </div>
                {/if}
                {if isset($EDITPLAN)}
                    <div class="span2"><label>&nbsp;</label>
                        <div class="row-fluid">
                            <input type="button" value="Графики" class="btn btn-success edit-button span12"
                                   onclick="window.location.href = 'index.php?module=VDCustomReports&view=List&mode=getSalesPlan'">
                        </div>
                    </div>
                {/if}
                {if isset($FRANCHISECHECKBOX) && $FRANCHISECHECKBOX == true}
                    <div class="span2"><label>&nbsp;</label>
                        <div class="row-fluid">
                            <input type="checkbox" name="franchiseCheckbox" {if $VALCHECKBOX}checked{/if}> Франчайзинг
                        </div>
                    </div>
                {/if}
            </form>
        </div>
        <hr/>

        <div class="padding1per row-fluid" style="border:1px solid #ccc;">
            {if isset($EDITPLAN)}
                {include file=vtemplate_path("uitypes/editPlan.tpl",$MODULE) }
            {/if}

            {if isset($FUNNEL)}
                {include file=vtemplate_path("uitypes/salesFunnel.tpl",$MODULE) }
            {/if}

            {foreach item=iddiv from=$GRAFDIV}
                <div id="{$iddiv}" class="{if $DIVSTILE.$iddiv['class']}{$DIVSTILE.$iddiv['class']}{else}span12{/if}"
                     style=" height:{if $DIVSTILE.$iddiv['height']}{$DIVSTILE.$iddiv['height']}{else}500px{/if}; background-color: #FFFFFF; margin-left:0;">

                    {if !$PLAN}
                    {if $TABLE.$iddiv}
                        <table class="table-hover table">

                            <tr>{foreach item=title from=$DIVSTILE.$iddiv['title']}
                                    <th>{$title}</th>
                                {/foreach}
                            </tr>

                            {foreach key=name item=value from=$TABLE.$iddiv}
                                <tr {if $name eq 'Итого' || $name eq 'Средняя' } class="success bold"{/if}>
                                    <td>{$name}</td>
                                    {if is_array($DIVSTILE.$iddiv['dataField'])}

                                        {foreach item=title from=$DIVSTILE.$iddiv['dataField']}
                                            <td>
                                                {$value.$title}</td>
                                        {/foreach}
                                    {else}
                                        <td>{if $DIVSTILE.$iddiv['dataField'] eq 1}{number_format($value,0,'.',' ')}{elseif $DIVSTILE.$iddiv['dataField'] eq 2}{$value}%{else}{$value}{/if}</td>
                                    {/if}
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                    {else}
                        {include file=vtemplate_path("uitypes/tablePlan.tpl",$MODULE) }
                    {/if}
                </div>
            {/foreach}
        </div>
    </div>
    <script>
        {foreach item=script from=$ADDSCRIPTS}
        {$script}
        {/foreach}
    </script>
{/strip}
{literal}
    <style>
        a.listScript {
            padding: 40px 20px;
            display: block;
            background: rgb(28, 116, 187) none repeat scroll 0% 0%;
            color: #fff !important;
            text-align: center;
            border-radius: 10px;
        }

        a.listScript h3 {
            color: #fff;
        }

        .edit-button {
            background-color: #5bb75b !important;
        }

        .tableEditPlan {
            margin-left: -8px;
            cursor: pointer;
            border: 1px solid #aad5fd;
            height: 27px;
            width: 98px;
            padding-right: 5px;
            margin-top: 2px;
        }

        .spantable{
            margin-top: -3px;
            float: right;
        }

        .table-info{
            padding-top: 53px;
        }

        .w-25{
            float: right;
            width: 25%;
        }

        .abc{
            display: none;
        }

        #getTableSum .abc{
            display: table!important;
         }

        .brighttheme{background: red;} .brighttheme *{color: white;}.ui-pnotify{ top:36px;right:36px;position:absolute;height:auto;z-index:2}body>.ui-pnotify{position:fixed;z-index:100040}.ui-pnotify-modal-overlay{background-color:rgba(0,0,0,.4);top:0;left:0;position:absolute;height:100%;width:100%;z-index:1}body>.ui-pnotify-modal-overlay{position:fixed;z-index:100039}.ui-pnotify.ui-pnotify-in{display:block!important}.ui-pnotify.ui-pnotify-move{transition:left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-slow{transition:opacity .6s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-slow.ui-pnotify.ui-pnotify-move{transition:opacity .6s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-normal{transition:opacity .4s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-normal.ui-pnotify.ui-pnotify-move{transition:opacity .4s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-fast{transition:opacity .2s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-fast.ui-pnotify.ui-pnotify-move{transition:opacity .2s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-in{opacity:1}.ui-pnotify .ui-pnotify-shadow{-webkit-box-shadow:0 6px 28px 0 rgba(0,0,0,.1);-moz-box-shadow:0 6px 28px 0 rgba(0,0,0,.1);box-shadow:0 6px 28px 0 rgba(0,0,0,.1)}.ui-pnotify-container{background-position:0 0;padding:.8em;height:100%;margin:0}.ui-pnotify-container:after{content:" ";visibility:hidden;display:block;height:0;clear:both}.ui-pnotify-container.ui-pnotify-sharp{-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}.ui-pnotify-title{display:block;margin-bottom:.4em;margin-top:0}.ui-pnotify-text{display:block}.ui-pnotify-icon,.ui-pnotify-icon span{display:block;float:left;margin-right:.2em}.ui-pnotify.stack-bottomleft,.ui-pnotify.stack-topleft{left:25px;right:auto}.ui-pnotify.stack-bottomleft,.ui-pnotify.stack-bottomright{bottom:25px;top:auto}.ui-pnotify.stack-modal{left:50%;right:auto;margin-left:-150px}
    </style>

{/literal}