<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
            <br>

            <div align=center>
                <ul class="nav nav-tabs" style="margin-bottom: 0;border-bottom: 0">
                    <li onclick="window.location.href='/index.php?module=ModuleCreator&parent=Settings&view=List&block=2'"><a href="#" data-toggle="tab"><strong>{vtranslate('Module Creator', $MODULE)}</strong></a></li>
                    <li class="active"><a href="#ManageRelations" data-toggle="tab"><strong>{vtranslate('Relations Manager', $MODULE)}</strong></a></li>
                    <li id="assignedToRoleTab" class="infoni"><a href="#Info" data-toggle="tab"><strong>{vtranslate('Informations', $MODULE)}</strong></a></li>
                </ul>
                <div class="tab-content layoutContent padding20 themeTableColor border1px overflowVisible" style="border-radius: 0px 4px 8px;position: static !important">
                    
                    <div class="tab-pane active" id="ManageRelations">
                        <table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tr>
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/relationsmanager.png" alt="{$MOD.LBL_USERS}" title="{$MOD.LBL_USERS}" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b>{vtranslate('Manage relations', $MODULE)} &raquo; </b>{$modulename|@getTranslatedString:$MODULE}</td>
                            </tr>

                            <tr>
                                <td class="small" valign="top">{vtranslate('Easy create and manage relations between modules!', $MODULE)}</td>
                            </tr>
                        </table>
                            
                        <br>


                     
<table class="table table-bordered themeTableColor" border="0" cellpadding="10" cellspacing="0" width="100%">
<tr>
    <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
    <br>

	<div align=center>
		
		
		<table border="0" cellpadding="10" cellspacing="0" width="100%">
		<tr>
			<td>
				<div id="vtlib_modulemanager_list">
<!-- start -->

<button id="Accounts_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick="window.location='index.php?module=ModuleCreator&parent=Settings&view=CreateRelation&modulename={$modulename}'">
    <i class="icon-plus icon-white"></i>&nbsp;<strong>{vtranslate('Create new relation (type n:m) for module', $MODULE)} {$modulename|@getTranslatedString:$MODULE}</strong>
</button>

<br><br>
<!-- Standard modules -->
<table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%>
                                                
<tr class="listViewHeaders" style="color:black;font-weight: bold">
	<td class="big tableHeading">{vtranslate('Relation function', $MODULE)}</td>
	<td class="big tableHeading">{vtranslate('Relation label', $MODULE)}</td>
	<td class="big tableHeading"  width="10%" align="center">{vtranslate('Options', $MODULE)}</td>
</tr>
<tr>
</tr>
{foreach key=relationkey item=relation from=$relationslist}
	<tr>
		<!--td class="cellLabel small" width="20px">&nbsp;</td -->
		<td class="cellLabel small">{$relation.name}</td>
		<td class="cellLabel small">{$relation.label|@getTranslatedString:$MODULE}</td>
		
		<td class="cellText small"  align="center" style="margin: 0px auto;text-align: center">
			<a href="index.php?module=ModuleCreator&parent=Settings&view=EditRelation&modulename={$modulename}&relationid={$relation.relation_id}" ><i title="{vtranslate('Edit', $MODULE)}" class="icon-pencil alignMiddle"></i></a>
		&nbsp;&nbsp;&nbsp;
                    <a href="index.php?module=ModuleCreator&parent=Settings&action=DeleteRelation&modulename={$modulename}&relationid={$relation.relation_id}" onclick="return confirm('{vtranslate('Are you sure?', $MODULE)}');"><i title="{vtranslate('Delete', $MODULE)}" class="icon-trash alignMiddle"></i></a>
		</td>
		
	</tr>
{/foreach}

</table>

<!-- related fields -->
<br><br>
<button id="Accounts_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick="window.location='index.php?module=ModuleCreator&parent=Settings&view=CreateField&modulename={$modulename}'">
    <i class="icon-plus icon-white"></i>&nbsp;<strong>{vtranslate('Create new related field (type 1:n) for module', $MODULE)} {$modulename|@getTranslatedString:$MODULE}</strong>
</button>

<br/><br/>

<!-- Standard modules -->
<table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%>
<tr class="listViewHeaders" style="color:black;font-weight: bold">
	<td class="big tableHeading">{vtranslate('Field label', $MODULE)}</td>
	<td class="big tableHeading">{vtranslate('Relation module', $MODULE)}</td>
	<td class="big tableHeading" width=10% align="center">{vtranslate('Options', $MODULE)}</td>
</tr>
<tr>
</tr>
{foreach key=fieldkey item=field from=$fieldslist}
	<tr>
		<!--td class="cellLabel small" width="20px">&nbsp;</td -->
		<td class="cellLabel small" >{$field.fieldlabel}</td>
		<td class="cellLabel small" >{$field.relmodule|@getTranslatedString:$MODULE}</td>
		
		<td class="cellText small"  align="center" style="margin: 0px auto;text-align: center">
			<a href="index.php?module=ModuleCreator&parent=Settings&view=EditField&modulename={$modulename}&fieldid={$field.fieldid}" title="{vtranslate('Edit field relation', $MODULE)}"><i title="{vtranslate('Edit', $MODULE)}" class="icon-pencil alignMiddle"></i></a>
		&nbsp;&nbsp;&nbsp;
                    <a href="index.php?module=ModuleCreator&parent=Settings&action=DeleteField&modulename={$modulename}&fieldid={$field.fieldid}" title="{vtranslate('Delete related field', $MODULE)}" onclick="return confirm('{vtranslate('Are you sure?', $MODULE)}');"><i title="{vtranslate('Delete', $MODULE)}" class="icon-trash alignMiddle"></i></a>
		</td>
	</tr>
{/foreach}

</table>

<!-- end -->
                </div>	
			
				<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr>
				  	<td class="small" align="right" nowrap="nowrap"><a href="#top">{$MOD.LBL_SCROLL}</a></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		<!-- End of Display -->
		
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






        </td>
        </tr>
        </table>
   </div>

        </td>
	</tr>
</table>
<br>

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
