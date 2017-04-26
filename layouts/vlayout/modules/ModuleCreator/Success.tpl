<div id="vtlib_modulemanager_import" style="display:block;position:absolute;width:500px;"></div>
<br>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
            <br>

            <div align=center>
                <ul class="nav nav-tabs" style="margin-bottom: 0;border-bottom: 0">
                    <li class="active"><a href="#allValuesLayout" data-toggle="tab"><strong>{vtranslate('Module Creator', $MODULE)}</strong></a></li>
                    <li id="assignedToRoleTab"><a href="#ManageRelations" data-toggle="tab"><strong>{vtranslate('Relations Manager', $MODULE)}</strong></a></li>
					<li id="assignedToRoleTab" class="infoni"><a href="#Info" data-toggle="tab"><strong>{vtranslate('Informations', $MODULE)}</strong></a></li>
                    
                </ul>
                <div class="tab-content layoutContent padding20 themeTableColor border1px overflowVisible" style="border-radius: 0px 4px 8px;position: static !important">
                    <div class="tab-pane active" id="allValuesLayout">
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
					<table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%>
					<tr class="listViewHeaders">
						<td class='big' colspan=2><b><font color=black>{vtranslate('Success!', $MODULE)}</font></b></td>
					</tr>
					</table>
					<table cellpadding=5 cellspacing=0 border=0 width=100%>
					<tr valign=top>
						<td class='cellLabel small'>
							<p>
								{vtranslate('Congratulations!', $MODULE)}<br>{vtranslate('Your module called', $MODULE)} <b>{$module_name}</b> {vtranslate('is successfully created!', $MODULE)}
								<a href="index.php?module=ModuleCreator&parent=Settings&view=List"><b>{vtranslate('Go back to Module Creator home.', $MODULE)}</b></a>
							</p>
						</td>
					</tr>
					</table>
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



