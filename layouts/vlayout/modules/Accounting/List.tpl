{strip}
    <div id="listViewContents" class="VDDialogueDesigner_container listViewPageDiv listViewContentDiv"
         style="padding-right: 3%">
        <br/>
        <br/>
        <div class="listViewEntriesTable row-fluid">
            {if (!isset($OPTIONSALARY))}
                <form action="index.php?module=Accounting&view=List&mode={$MODE}" method="GET">
                    <input type="hidden" name="module" value="Accounting">
                    <input type="hidden" name="view" value="List">
                    <input type="hidden" name="mode" value="{$MODE}">
                    {if isset($USERID)}
                        <input type="hidden" name="id" value='{$USERID}'>
                    {/if}
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

                </form>
            {/if}
        </div>
        <hr/>

        <div class="padding1per row-fluid" style="border:1px solid #ccc;">
            {if isset($OPTIONSALARY)}
                {include file=vtemplate_path("uitypes/optionSalary.tpl",$MODULE) }
            {/if}

            {if isset($WORKINGHOURS)}
                {include file=vtemplate_path("uitypes/workingHours.tpl",$MODULE) }
            {/if}
            {if isset($VACATIONSCHEDULE)}
                {include file=vtemplate_path("uitypes/vacationSchedule.tpl",$MODULE) }
            {/if}
            {if isset($HOLIDAYS) && !isset($VACATIONSCHEDULE)}
                {include file=vtemplate_path("uitypes/holidays.tpl",$MODULE) }
            {/if}
            {if isset($SALARY)}
                {include file=vtemplate_path("uitypes/salary.tpl",$MODULE) }
            {/if}
           {if isset($WORKERS)}
                {include file=vtemplate_path("uitypes/workers.tpl",$MODULE) }
           {/if}
            {if isset($PERSONALCARD)}
                {include file=vtemplate_path("uitypes/personalCard.tpl",$MODULE) }
            {/if}
            {if isset($EMPLOYEES)}
                {include file=vtemplate_path("uitypes/employees.tpl",$MODULE) }
            {/if}
        </div>
    </div>
{/strip}
{literal}
    <style>
        .brighttheme {
            background: red;
        }

        .brighttheme * {
            color: white;
        }

        .ui-pnotify {
            top: 36px;
            right: 36px;
            position: absolute;
            height: auto;
            z-index: 2
        }

        body > .ui-pnotify {
            position: fixed;
            z-index: 100040
        }

        .ui-pnotify-modal-overlay {
            background-color: rgba(0, 0, 0, .4);
            top: 0;
            left: 0;
            position: absolute;
            height: 100%;
            width: 100%;
            z-index: 1
        }

        body > .ui-pnotify-modal-overlay {
            position: fixed;
            z-index: 100039
        }

        .ui-pnotify.ui-pnotify-in {
            display: block !important
        }

        .ui-pnotify.ui-pnotify-move {
            transition: left .5s ease, top .5s ease, right .5s ease, bottom .5s ease
        }

        .ui-pnotify.ui-pnotify-fade-slow {
            transition: opacity .6s linear;
            opacity: 0
        }

        .ui-pnotify.ui-pnotify-fade-slow.ui-pnotify.ui-pnotify-move {
            transition: opacity .6s linear, left .5s ease, top .5s ease, right .5s ease, bottom .5s ease
        }

        .ui-pnotify.ui-pnotify-fade-normal {
            transition: opacity .4s linear;
            opacity: 0
        }

        .ui-pnotify.ui-pnotify-fade-normal.ui-pnotify.ui-pnotify-move {
            transition: opacity .4s linear, left .5s ease, top .5s ease, right .5s ease, bottom .5s ease
        }

        .ui-pnotify.ui-pnotify-fade-fast {
            transition: opacity .2s linear;
            opacity: 0
        }

        .ui-pnotify.ui-pnotify-fade-fast.ui-pnotify.ui-pnotify-move {
            transition: opacity .2s linear, left .5s ease, top .5s ease, right .5s ease, bottom .5s ease
        }

        .ui-pnotify.ui-pnotify-fade-in {
            opacity: 1
        }

        .ui-pnotify .ui-pnotify-shadow {
            -webkit-box-shadow: 0 6px 28px 0 rgba(0, 0, 0, .1);
            -moz-box-shadow: 0 6px 28px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 6px 28px 0 rgba(0, 0, 0, .1)
        }

        .ui-pnotify-container {
            background-position: 0 0;
            padding: .8em;
            height: 100%;
            margin: 0
        }

        .ui-pnotify-container:after {
            content: " ";
            visibility: hidden;
            display: block;
            height: 0;
            clear: both
        }

        .ui-pnotify-container.ui-pnotify-sharp {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0
        }

        .ui-pnotify-title {
            display: block;
            margin-bottom: .4em;
            margin-top: 0
        }

        .ui-pnotify-text {
            display: block
        }

        .ui-pnotify-icon, .ui-pnotify-icon span {
            display: block;
            float: left;
            margin-right: .2em
        }

        .ui-pnotify.stack-bottomleft, .ui-pnotify.stack-topleft {
            left: 25px;
            right: auto
        }

        .ui-pnotify.stack-bottomleft, .ui-pnotify.stack-bottomright {
            bottom: 25px;
            top: auto
        }

        .ui-pnotify.stack-modal {
            left: 50%;
            right: auto;
            margin-left: -150px
        }
    </style>
{/literal}