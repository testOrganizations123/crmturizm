{literal}
    <script type="text/javascript">
        function modulecreate_create_validate(form) {
            if (form.module_name.value == '') {
                alert("{/literal}{vtranslate('You have to set module name!', $MODULE)}{literal}");
                return false;
            }
            if (form.module_label.value == '') {
                alert("{/literal}{vtranslate('You have to set module label!', $MODULE)}{literal}");
                return false;
            }
            if (form.block_name.value == '') {
                alert("{/literal}{vtranslate('You have to set block label!', $MODULE)}{literal}");
                return false;
            }
            if (form.parentcategory.selectedIndex == 0) {
                alert("{/literal}{vtranslate('You have to set parent tab!', $MODULE)}{literal}");
                return false;
            }
            if (form.field_label.value == '') {
                alert("{/literal}{vtranslate('You have to set field label!', $MODULE)}{literal}");
                return false;
            }
            return true;
        }

        function updateblockname(form) {
            form.module_name.value = form.module_name.value.replace(/[^A-Za-z0-9]/gi, '');
            form.block_name.value = form.module_name.value + ' {/literal}{vtranslate('Informations', $MODULE)}{literal}';
            form.module_label.value = form.module_name.value;
        }

        
    </script>
{/literal}

<div id="vtlib_modulemanager_import" style="display:block;position:absolute;width:500px;"></div>
<br>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
            <br>

            <div align=center>
                <ul class="nav nav-tabs" style="margin-bottom: 0;border-bottom: 0">
                    <li class="active"><a href="#CreateModule" data-toggle="tab"><strong>{vtranslate('Module Creator', $MODULE)}</strong></a></li>
                    <li id="assignedToRoleTab"><a href="#ManageRelations" data-toggle="tab"><strong>{vtranslate('Relations Manager', $MODULE)}</strong></a></li>
					<li id="assignedToRoleTab" class="infoni"><a href="#Info" data-toggle="tab"><strong>{vtranslate('Informations', $MODULE)}</strong></a></li>
                </ul>
                <div class="tab-content layoutContent padding20 themeTableColor border1px overflowVisible" style="border-radius: 0px 4px 8px;position: static !important">
                    <div class="tab-pane active" id="CreateModule">
                        <table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tr>
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/modulecreator.png" alt="{$MOD.LBL_USERS}" title="{$MOD.LBL_USERS}" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b>{vtranslate('Create new module', $MODULE)} {$VER}</b></td>
                            </tr>

                            <tr>
                                <td class="small" valign="top">{vtranslate('Easy create new entity module in your vTiger CRM!', $MODULE)}</td>
                            </tr>
                        </table>

                        <br>
                        <table class="table table-bordered themeTableColor" border="0" cellpadding="10" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <div id="vtlib_modulemanager_import_div">
                                        <form method="POST" action="index.php">
                                            
                                            <table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%>
                                                <tr class="listViewHeaders">
                                                    <td class='big' colspan=2><b><font color=black>{vtranslate('Module Info', $MODULE)}</font></b></td>
                                                </tr>
                                            </table>
                                            <table cellpadding=5 cellspacing=0 border=0 width=100%>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b>{vtranslate('Module name', $MODULE)}</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="module_name" size="50" onkeyup="updateblockname(this.form);" value="{$module_name}">
                                                        <p>
                                                            {vtranslate('Module name. Only alphanumerical characters are allowed (A-Z, a-z, 0-9).', $MODULE)}
                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b>{vtranslate('Module label', $MODULE)}</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="module_label" size="50" onkeyup="" value="{$module_label}">
                                                        <p>
                                                            {vtranslate('Module label.', $MODULE)}
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b>{vtranslate('Choose parent', $MODULE)}</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <select name="parentcategory">
                                                            <option value="-1">{vtranslate('-- Select --', $MODULE)}</option>
                                                            {foreach from=$parenttabs item=tab}
                                                                {if $tab.parenttab_label != 'Settings'}
                                                                    <option value="{$tab.parenttab_label}" {if $tab.parenttab_label == $parentcategory}selected{/if}>{$tab.parenttab_label|@getTranslatedString:$MODULE}</option>
                                                                {/if}
                                                            {/foreach}
                                                        </select>
                                                        <p>
                                                            {vtranslate('Choose parent tab for your new module.', $MODULE)}
                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b>{vtranslate('Block label', $MODULE)}</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="block_name" size="50" value="{$block_name}">
                                                        <p>
                                                            {vtranslate('Main block label.', $MODULE)}
                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b>{vtranslate('Field label', $MODULE)}</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="field_label" size="50" value="{$field_label}">
                                                        <p>
                                                            {vtranslate('Main/name field label.', $MODULE)}
                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%>
                                                <tr valign=top>
                                                    <td class='cellText small' colspan=2 align=right>
                                                        <input type="hidden" name="module" value="ModuleCreator">
                                                        <input type="hidden" name="action" value="Create">
                                                        <input type="hidden" name="parent" value="Settings">
<button id="Accounts_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick="return modulecreate_create_validate(this.form)">
    <i class="icon-plus icon-white"></i>&nbsp;<strong>{vtranslate('Create module', $MODULE)}</strong>
</button>
                                                        
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane" id="ManageRelations">
                        <table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tr>
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/relationsmanager.png" alt="{$MOD.LBL_USERS}" title="{$MOD.LBL_USERS}" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b>{vtranslate('Manage relations', $MODULE)} {$VER}</b></td>
                            </tr>

                            <tr>
                                <td class="small" valign="top">{vtranslate('Easy create and manage relations between modules!', $MODULE)}</td>
                            </tr>
                        </table>
                            
                        <br>
                        <table class="table table-bordered themeTableColor" border="0" cellpadding="10" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <div id="vtlib_modulemanager_import_div">
                                        
                                            
                                            
                                          <table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%>
                                                <tr class="listViewHeaders">
	<td class="listViewHeaders big" ><b><font color="black">{vtranslate('Module name', $MODULE)}</font></b></td>
	<td class="listViewHeaders big"  width=10% align="center"><b><font color="black">{vtranslate('Options', $MODULE)}</font></b></td>
</tr>
</table>
<table class="" border="0" cellpadding="10" cellspacing="0" width="100%">
<tr>
</tr>
{foreach key=modulename item=modinfo from=$moduleslist}
	{if $modinfo.presence eq 0}
		{assign var="modulelabel" value=$modulename}
		{if $APP.$modulename}{assign var="modulelabel" value=$APP.$modulename}{/if}
		<tr>
			<!--td class="cellLabel small" width="20px">&nbsp;</td -->
			<td class="cellLabel small" >{$modulelabel|@getTranslatedString:$MODULE}</td>
			<!--<td class="cellText small" width="15px" align=center></td>-->
			<td class="cellText small" width="10%" align="center" style="margin: 0px auto;text-align: center">
				<a href="index.php?module=ModuleCreator&parent=Settings&view=Relations&modulename={$modulename}" title="{vtranslate('Manage relations', $MODULE)}"><i title="{vtranslate('Manage relations', $MODULE)}" class="icon-random alignMiddle"></i></a>
			</td>
			<!--<td class="cellText small" width="15px" align=center></td>-->
		</tr>
	{/if}
{/foreach}

</table> 
                                        
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
					<div class="tab-pane" id="Info">
                        <table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tr>
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/netinteractivelogo4848.png" alt="{$MOD.LBL_USERS}" title="{$MOD.LBL_USERS}" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b>{vtranslate('Developer Info', $MODULE)} {$VER}</b></td>
                            </tr>

                            <tr>
                                <td class="small" valign="top">{vtranslate('You want more for your vTigerCRM? Contact us!', $MODULE)}</td>
                            </tr>
                        </table>
                            
                
						
					
                        <table  align ="center" border="0" cellpadding="10" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                   <p><strong>NetInteractive</strong></p>
								      <p>Ogrodowa 58 00-876 Warszawa</p>
                                   <p><a href="http://www.netinteractive.pl">www.netinteractive.pl</a></p>
                                    <p><a href="mailto:biuro@netinteractive.pl">biuro@netinteractive.pl</a></p>      
                              
                                </td>
                            </tr>
                        </table>
                    </div> 

                </div>


                <!-- End of Display -->

        </td>
    </tr>
</table>
</td>
</tr>
</table>
</div>

</td>
</tr>
</table>
<br>
