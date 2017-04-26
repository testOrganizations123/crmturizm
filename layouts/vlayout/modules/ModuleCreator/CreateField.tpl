{literal}
<script type="text/javascript">
   function createrelatedfield_validate(form) {
   	if(form.relatedmodule.selectedIndex == 0) {
   		alert("{/literal}{vtranslate('You have to select related module.', $MODULE)}{literal}");
   		return false;
   	}
   	if(form.blockid.selectedIndex == 0) {
   		alert("{/literal}{vtranslate('You have to select block.', $MODULE)}{literal}");
   		return false;
   	}
   	if(form.field_label.value == '') {
   		alert("{/literal}{vtranslate('You have to set field label.', $MODULE)}{literal}");
   		return false;
   	}
   	if(form.field_name.value == '') {
   		alert("{/literal}{vtranslate('You have to set field name.', $MODULE)}{literal}");
   		return false;
   	}
   	if(form.createrelatedlist.checked == true){
   		if (form.relatedlistlabel.value == ''){
   			alert('{/literal}{vtranslate('You have to set related list label', $MODULE)}{literal}');
   			return false;
   		}
   	}
   	return true;
   }
</script>
{/literal}
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
                        <td class="small" valign="top">{vtranslate('Create new related field for module', $MODULE)} {$modulename|@getTranslatedString:$MODULE}</td>
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
                                       <td class='big' colspan=2><b><font color=black>{vtranslate('Create new field', $MODULE)}</font></b></td>
                                    </tr>
                                 </table>
                                 <table cellpadding=5 cellspacing=0 border=0 width=100%>
                                    <tr valign=top>
                                       <td class='cellLabel small'>
                                          <p><font color=red>*</font> <b>{vtranslate('Module name', $MODULE)}</b></p>
                                       </td>
                                       <td class='cellText small'>
                                          <p>
                                             <b>{$modulename|@getTranslatedString:$MODULE}</b>
                                          </p>
                                       </td>
                                    </tr>
                                    <tr valign=top>
                                       <td class='cellLabel small'>
                                          <font color=red>*</font> <b>{vtranslate('Field name', $MODULE)}</b>
                                       </td>
                                       <td class='cellText small'>
                                          <input type="text" class="small" name="field_name" size=50>
                                          <p>
                                             {vtranslate('Type your new related field name.', $MODULE)}
                                          </p>
                                       </td>
                                    </tr>
                                    <tr valign=top>
                                       <td class='cellLabel small'>
                                          <font color=red>*</font> <b>{vtranslate('Field label', $MODULE)}</b>
                                       </td>
                                       <td class='cellText small'>
                                          <input type="text" class="small" name="field_label" size=50>
                                          <p>
                                             {vtranslate('Type your new related field label.', $MODULE)}
                                          </p>
                                       </td>
                                    </tr>
                                    <tr valign=top>
                                       <td class='cellLabel small'>
                                          <font color=red>*</font> <b>{vtranslate('Block', $MODULE)}</b>
                                       </td>
                                       <td class='cellText small'>
                                          <select name="blockid">
                                             <option value="-1">{vtranslate('-- Select --', $MODULE)}</option>
                                             {foreach from=$blockslist item=block}
                                             {if $modinfo.presence eq 0}
                                             <option value="{$block.blockid}">{$block.blocklabel|@getTranslatedString:$modulename}</option>
                                             {/if}
                                             {/foreach}
                                          </select>
                                          <p>
                                             {vtranslate('Select block.', $MODULE)}
                                          </p>
                                       </td>
                                    </tr>
                                    <tr valign=top>
                                       <td class='cellLabel small'>
                                          <font color=red>*</font> <b>{vtranslate('Relation to module', $MODULE)}</b>
                                       </td>
                                       <td class='cellText small'>
                                          <select name="relatedmodule">
                                             <option value="-1">{vtranslate('-- Select --', $MODULE)}</option>
                                             {foreach from=$moduleslist item=modinfo key=modname}
                                             {if $modinfo.presence eq 0}
                                             <option value="{$modname}">{$modname|@getTranslatedString:$MODULE}</option>
                                             {/if}
                                             {/foreach}
                                          </select>
                                          <p>
                                             {vtranslate('Select related module.', $MODULE)}
                                          </p>
                                       </td>
                                    </tr>
                                    <tr valign=top>
                                       <td class='cellLabel small'>
                                          <b>{vtranslate('Related List', $MODULE)}</b>
                                       </td>
                                       <td class='cellText small'>
                                          <input type="checkbox" name="createrelatedlist" value="yes" checked="checked"/>
                                          <input type="text" name="relatedlistlabel" value="{$modulename|@getTranslatedString:$modulename}"/>
                                          <p>
                                             {vtranslate('Show Related List for this field in destination module. Type List Label', $MODULE)}
                                          </p>
                                       </td>
                                    </tr>
                                 </table>
                                 <table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%>
                                    <tr valign=top>
                                       <td class='cellText small' colspan=2 align=right>
                                          <input type="hidden" name="module" value="ModuleCreator">
                                          <input type="hidden" name="action" value="CreateField">
                                          <input type="hidden" name="modulename" value="{$modulename}">
                                          <input type="hidden" name="parent" value="Settings">
                                          <button id="Accounts_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick="return createrelatedfield_validate(this.form)">
                                          <i class="icon-plus icon-white"></i>&nbsp;<strong>{vtranslate('Create field', $MODULE)}</strong>
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