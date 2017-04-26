<div id="vtlib_modulemanager_import" style="display:block;position:absolute;width:500px;"></div>
<br>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
            <br>

            <div align=center>
                <ul class="nav nav-tabs" style="margin-bottom: 0;border-bottom: 0">
                    <li class="active"><a href="#allValuesLayout" data-toggle="tab"><strong>{vtranslate('Module Creator', $MODULE)}</strong></a></li>
                    <li id="assignedToRoleTab" class="infoni"><a href="#Info" data-toggle="tab"><strong>{vtranslate('Informations', $MODULE)}</strong></a></li>
                    
                </ul>
                <div class="tab-content layoutContent padding20 themeTableColor border1px overflowVisible" style="border-radius: 0px 4px 8px;position: static !important">
                    <div class="tab-pane active" id="allValuesLayout">
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
						<td class='big' colspan=2><b><font color=white>{vtranslate('Error!', $MODULE)}</font></b></td>
					</tr>
					</table>
					<table cellpadding=5 cellspacing=0 border=0 width=100%>
					<tr valign=top>
						<td class='cellLabel small'>
                                                    {if $errormc eq 'ERR_MODULE_EXISTS'}
							<p>
								{vtranslate('Error!', $MODULE)}<br>{vtranslate('Module called', $MODULE)} <b>{$module_name}</b> {vtranslate('exists! Choose other module name.', $MODULE)}
								<a href="index.php?module=ModuleCreator&parent=Settings&view=List"><b>{vtranslate('Go back to Module Creator home.', $MODULE)}</b></a>
							</p>
                                                    {/if}
                                                    {if $errormc eq 'ERR_NOT_ALNUM'}
                                                        {vtranslate('Only alphanumerical characters are allowed (A-Z, a-z, 0-9) in field name', $MODULE)}
                                                    {/if}
						</td>
					</tr>
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



