{strip}
    <div id="listViewContents" class="VDDialogueDesigner_container listViewPageDiv listViewContentDiv"
         style="padding-right: 3%">
        <br/>
        <br/>
        <div class="listViewEntriesTable row-fluid">
            <form action="index.php?module=Accounting&view=List&mode={$MODE}" method="GET">
                <input type="hidden" name="module" value="Accounting">
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

            </form>
        </div>
        <hr/>

        <div class="padding1per row-fluid" style="border:1px solid #ccc;">
            {if isset($WORKINGHOURS)}
                {include file=vtemplate_path("uitypes/workingHours.tpl",$MODULE) }
            {/if}
        </div>
    </div>
{/strip}
{literal}
    <style>

    </style>
{/literal}