<?php /* Smarty version Smarty-3.1.7, created on 2016-07-09 20:02:36
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/ModuleCreator/Relations.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85796600257812e2cc603c3-46439174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b8fba6642eec44baf8e12d55487eb083030c8a2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/ModuleCreator/Relations.tpl',
      1 => 1468083597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85796600257812e2cc603c3-46439174',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MOD' => 0,
    'modulename' => 0,
    'relationslist' => 0,
    'relation' => 0,
    'fieldslist' => 0,
    'field' => 0,
    'VER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57812e2cd3b4a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57812e2cd3b4a')) {function content_57812e2cd3b4a($_smarty_tpl) {?><table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
            <br>

            <div align=center>
                <ul class="nav nav-tabs" style="margin-bottom: 0;border-bottom: 0">
                    <li onclick="window.location.href='/index.php?module=ModuleCreator&parent=Settings&view=List&block=2'"><a href="#" data-toggle="tab"><strong><?php echo vtranslate('Module Creator',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a></li>
                    <li class="active"><a href="#ManageRelations" data-toggle="tab"><strong><?php echo vtranslate('Relations Manager',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a></li>
                    <li id="assignedToRoleTab" class="infoni"><a href="#Info" data-toggle="tab"><strong><?php echo vtranslate('Informations',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a></li>
                </ul>
                <div class="tab-content layoutContent padding20 themeTableColor border1px overflowVisible" style="border-radius: 0px 4px 8px;position: static !important">
                    
                    <div class="tab-pane active" id="ManageRelations">
                        <table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tr>
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/relationsmanager.png" alt="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b><?php echo vtranslate('Manage relations',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 &raquo; </b><?php echo getTranslatedString($_smarty_tpl->tpl_vars['modulename']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                            </tr>

                            <tr>
                                <td class="small" valign="top"><?php echo vtranslate('Easy create and manage relations between modules!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
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

<button id="Accounts_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick="window.location='index.php?module=ModuleCreator&parent=Settings&view=CreateRelation&modulename=<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
'">
    <i class="icon-plus icon-white"></i>&nbsp;<strong><?php echo vtranslate('Create new relation (type n:m) for module',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo getTranslatedString($_smarty_tpl->tpl_vars['modulename']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
</button>

<br><br>
<!-- Standard modules -->
<table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%<?php ?>>
                                                
<tr class="listViewHeaders" style="color:black;font-weight: bold">
	<td class="big tableHeading"><?php echo vtranslate('Relation function',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
	<td class="big tableHeading"><?php echo vtranslate('Relation label',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
	<td class="big tableHeading"  width="10%" align="center"><?php echo vtranslate('Options',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
</tr>
<tr>
</tr>
<?php  $_smarty_tpl->tpl_vars['relation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relation']->_loop = false;
 $_smarty_tpl->tpl_vars['relationkey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['relationslist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relation']->key => $_smarty_tpl->tpl_vars['relation']->value){
$_smarty_tpl->tpl_vars['relation']->_loop = true;
 $_smarty_tpl->tpl_vars['relationkey']->value = $_smarty_tpl->tpl_vars['relation']->key;
?>
	<tr>
		<!--td class="cellLabel small" width="20px">&nbsp;</td -->
		<td class="cellLabel small"><?php echo $_smarty_tpl->tpl_vars['relation']->value['name'];?>
</td>
		<td class="cellLabel small"><?php echo getTranslatedString($_smarty_tpl->tpl_vars['relation']->value['label'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
		
		<td class="cellText small"  align="center" style="margin: 0px auto;text-align: center">
			<a href="index.php?module=ModuleCreator&parent=Settings&view=EditRelation&modulename=<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
&relationid=<?php echo $_smarty_tpl->tpl_vars['relation']->value['relation_id'];?>
" ><i title="<?php echo vtranslate('Edit',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="icon-pencil alignMiddle"></i></a>
		&nbsp;&nbsp;&nbsp;
                    <a href="index.php?module=ModuleCreator&parent=Settings&action=DeleteRelation&modulename=<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
&relationid=<?php echo $_smarty_tpl->tpl_vars['relation']->value['relation_id'];?>
" onclick="return confirm('<?php echo vtranslate('Are you sure?',$_smarty_tpl->tpl_vars['MODULE']->value);?>
');"><i title="<?php echo vtranslate('Delete',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="icon-trash alignMiddle"></i></a>
		</td>
		
	</tr>
<?php } ?>

</table>

<!-- related fields -->
<br><br>
<button id="Accounts_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick="window.location='index.php?module=ModuleCreator&parent=Settings&view=CreateField&modulename=<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
'">
    <i class="icon-plus icon-white"></i>&nbsp;<strong><?php echo vtranslate('Create new related field (type 1:n) for module',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo getTranslatedString($_smarty_tpl->tpl_vars['modulename']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
</button>

<br/><br/>

<!-- Standard modules -->
<table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%<?php ?>>
<tr class="listViewHeaders" style="color:black;font-weight: bold">
	<td class="big tableHeading"><?php echo vtranslate('Field label',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
	<td class="big tableHeading"><?php echo vtranslate('Relation module',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
	<td class="big tableHeading" width=10% align="center"><?php echo vtranslate('Options',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
</tr>
<tr>
</tr>
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['fieldkey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fieldslist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['fieldkey']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
	<tr>
		<!--td class="cellLabel small" width="20px">&nbsp;</td -->
		<td class="cellLabel small" ><?php echo $_smarty_tpl->tpl_vars['field']->value['fieldlabel'];?>
</td>
		<td class="cellLabel small" ><?php echo getTranslatedString($_smarty_tpl->tpl_vars['field']->value['relmodule'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
		
		<td class="cellText small"  align="center" style="margin: 0px auto;text-align: center">
			<a href="index.php?module=ModuleCreator&parent=Settings&view=EditField&modulename=<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
&fieldid=<?php echo $_smarty_tpl->tpl_vars['field']->value['fieldid'];?>
" title="<?php echo vtranslate('Edit field relation',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i title="<?php echo vtranslate('Edit',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="icon-pencil alignMiddle"></i></a>
		&nbsp;&nbsp;&nbsp;
                    <a href="index.php?module=ModuleCreator&parent=Settings&action=DeleteField&modulename=<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
&fieldid=<?php echo $_smarty_tpl->tpl_vars['field']->value['fieldid'];?>
" title="<?php echo vtranslate('Delete related field',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" onclick="return confirm('<?php echo vtranslate('Are you sure?',$_smarty_tpl->tpl_vars['MODULE']->value);?>
');"><i title="<?php echo vtranslate('Delete',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="icon-trash alignMiddle"></i></a>
		</td>
	</tr>
<?php } ?>

</table>

<!-- end -->
                </div>	
			
				<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr>
				  	<td class="small" align="right" nowrap="nowrap"><a href="#top"><?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_SCROLL'];?>
</a></td>
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
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/netinteractivelogo4848.png" alt="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b><?php echo vtranslate('Developer Info',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['VER']->value;?>
</b></td>
                            </tr>

                            <tr>
                                <td class="small" valign="top"><?php echo vtranslate('You want more for your vTigerCRM? Contact us!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
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
<?php }} ?>