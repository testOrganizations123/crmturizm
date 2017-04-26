<?php /* Smarty version Smarty-3.1.7, created on 2016-07-09 20:00:12
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/ModuleCreator/Index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110401313657812d9c46bed4-88729279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49c63015198731af15babc014c5ee555838f843f' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/ModuleCreator/Index.tpl',
      1 => 1468083597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110401313657812d9c46bed4-88729279',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MOD' => 0,
    'VER' => 0,
    'module_name' => 0,
    'module_label' => 0,
    'parenttabs' => 0,
    'tab' => 0,
    'parentcategory' => 0,
    'block_name' => 0,
    'field_label' => 0,
    'moduleslist' => 0,
    'modinfo' => 0,
    'modulename' => 0,
    'APP' => 0,
    'modulelabel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57812d9c5782e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57812d9c5782e')) {function content_57812d9c5782e($_smarty_tpl) {?>
    <script type="text/javascript">
        function modulecreate_create_validate(form) {
            if (form.module_name.value == '') {
                alert("<?php echo vtranslate('You have to set module name!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
");
                return false;
            }
            if (form.module_label.value == '') {
                alert("<?php echo vtranslate('You have to set module label!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
");
                return false;
            }
            if (form.block_name.value == '') {
                alert("<?php echo vtranslate('You have to set block label!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
");
                return false;
            }
            if (form.parentcategory.selectedIndex == 0) {
                alert("<?php echo vtranslate('You have to set parent tab!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
");
                return false;
            }
            if (form.field_label.value == '') {
                alert("<?php echo vtranslate('You have to set field label!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
");
                return false;
            }
            return true;
        }

        function updateblockname(form) {
            form.module_name.value = form.module_name.value.replace(/[^A-Za-z0-9]/gi, '');
            form.block_name.value = form.module_name.value + ' <?php echo vtranslate('Informations',$_smarty_tpl->tpl_vars['MODULE']->value);?>
';
            form.module_label.value = form.module_name.value;
        }

        
    </script>


<div id="vtlib_modulemanager_import" style="display:block;position:absolute;width:500px;"></div>
<br>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
            <br>

            <div align=center>
                <ul class="nav nav-tabs" style="margin-bottom: 0;border-bottom: 0">
                    <li class="active"><a href="#CreateModule" data-toggle="tab"><strong><?php echo vtranslate('Module Creator',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a></li>
                    <li id="assignedToRoleTab"><a href="#ManageRelations" data-toggle="tab"><strong><?php echo vtranslate('Relations Manager',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a></li>
					<li id="assignedToRoleTab" class="infoni"><a href="#Info" data-toggle="tab"><strong><?php echo vtranslate('Informations',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a></li>
                </ul>
                <div class="tab-content layoutContent padding20 themeTableColor border1px overflowVisible" style="border-radius: 0px 4px 8px;position: static !important">
                    <div class="tab-pane active" id="CreateModule">
                        <table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tr>
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/modulecreator.png" alt="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b><?php echo vtranslate('Create new module',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['VER']->value;?>
</b></td>
                            </tr>

                            <tr>
                                <td class="small" valign="top"><?php echo vtranslate('Easy create new entity module in your vTiger CRM!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                            </tr>
                        </table>

                        <br>
                        <table class="table table-bordered themeTableColor" border="0" cellpadding="10" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <div id="vtlib_modulemanager_import_div">
                                        <form method="POST" action="index.php">
                                            
                                            <table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%<?php ?>>
                                                <tr class="listViewHeaders">
                                                    <td class='big' colspan=2><b><font color=black><?php echo vtranslate('Module Info',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</font></b></td>
                                                </tr>
                                            </table>
                                            <table cellpadding=5 cellspacing=0 border=0 width=100%<?php ?>>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b><?php echo vtranslate('Module name',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="module_name" size="50" onkeyup="updateblockname(this.form);" value="<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
">
                                                        <p>
                                                            <?php echo vtranslate('Module name. Only alphanumerical characters are allowed (A-Z, a-z, 0-9).',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b><?php echo vtranslate('Module label',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="module_label" size="50" onkeyup="" value="<?php echo $_smarty_tpl->tpl_vars['module_label']->value;?>
">
                                                        <p>
                                                            <?php echo vtranslate('Module label.',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b><?php echo vtranslate('Choose parent',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <select name="parentcategory">
                                                            <option value="-1"><?php echo vtranslate('-- Select --',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                                                            <?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['parenttabs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value){
$_smarty_tpl->tpl_vars['tab']->_loop = true;
?>
                                                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['parenttab_label']!='Settings'){?>
                                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['tab']->value['parenttab_label'];?>
" <?php if ($_smarty_tpl->tpl_vars['tab']->value['parenttab_label']==$_smarty_tpl->tpl_vars['parentcategory']->value){?>selected<?php }?>><?php echo getTranslatedString($_smarty_tpl->tpl_vars['tab']->value['parenttab_label'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                                                                <?php }?>
                                                            <?php } ?>
                                                        </select>
                                                        <p>
                                                            <?php echo vtranslate('Choose parent tab for your new module.',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b><?php echo vtranslate('Block label',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="block_name" size="50" value="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
">
                                                        <p>
                                                            <?php echo vtranslate('Main block label.',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr valign=top>
                                                    <td class='cellLabel small'>
                                                        <font color=red>*</font> <b><?php echo vtranslate('Field label',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b>
                                                    </td>
                                                    <td class='cellText small'>
                                                        <input type="text" class="small" name="field_label" size="50" value="<?php echo $_smarty_tpl->tpl_vars['field_label']->value;?>
">
                                                        <p>
                                                            <?php echo vtranslate('Main/name field label.',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                            
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%<?php ?>>
                                                <tr valign=top>
                                                    <td class='cellText small' colspan=2 align=right>
                                                        <input type="hidden" name="module" value="ModuleCreator">
                                                        <input type="hidden" name="action" value="Create">
                                                        <input type="hidden" name="parent" value="Settings">
<button id="Accounts_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick="return modulecreate_create_validate(this.form)">
    <i class="icon-plus icon-white"></i>&nbsp;<strong><?php echo vtranslate('Create module',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
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
                                <td rowspan="2" valign="top" width="50"><img src="layouts/vlayout/modules/ModuleCreator/relationsmanager.png" alt="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['MOD']->value['LBL_USERS'];?>
" border="0" height="48" width="48"></td>
                                <td class="heading2" valign="bottom"><b><?php echo vtranslate('Manage relations',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['VER']->value;?>
</b></td>
                            </tr>

                            <tr>
                                <td class="small" valign="top"><?php echo vtranslate('Easy create and manage relations between modules!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                            </tr>
                        </table>
                            
                        <br>
                        <table class="table table-bordered themeTableColor" border="0" cellpadding="10" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <div id="vtlib_modulemanager_import_div">
                                        
                                            
                                            
                                          <table class='tableHeading' cellpadding=5 cellspacing=0 border=0 width=100%<?php ?>>
                                                <tr class="listViewHeaders">
	<td class="listViewHeaders big" ><b><font color="black"><?php echo vtranslate('Module name',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</font></b></td>
	<td class="listViewHeaders big"  width=10% align="center"><b><font color="black"><?php echo vtranslate('Options',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</font></b></td>
</tr>
</table>
<table class="" border="0" cellpadding="10" cellspacing="0" width="100%">
<tr>
</tr>
<?php  $_smarty_tpl->tpl_vars['modinfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['modinfo']->_loop = false;
 $_smarty_tpl->tpl_vars['modulename'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['moduleslist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['modinfo']->key => $_smarty_tpl->tpl_vars['modinfo']->value){
$_smarty_tpl->tpl_vars['modinfo']->_loop = true;
 $_smarty_tpl->tpl_vars['modulename']->value = $_smarty_tpl->tpl_vars['modinfo']->key;
?>
	<?php if ($_smarty_tpl->tpl_vars['modinfo']->value['presence']==0){?>
		<?php $_smarty_tpl->tpl_vars["modulelabel"] = new Smarty_variable($_smarty_tpl->tpl_vars['modulename']->value, null, 0);?>
		<?php if ($_smarty_tpl->tpl_vars['APP']->value[$_smarty_tpl->tpl_vars['modulename']->value]){?><?php $_smarty_tpl->tpl_vars["modulelabel"] = new Smarty_variable($_smarty_tpl->tpl_vars['APP']->value[$_smarty_tpl->tpl_vars['modulename']->value], null, 0);?><?php }?>
		<tr>
			<!--td class="cellLabel small" width="20px">&nbsp;</td -->
			<td class="cellLabel small" ><?php echo getTranslatedString($_smarty_tpl->tpl_vars['modulelabel']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
			<!--<td class="cellText small" width="15px" align=center></td>-->
			<td class="cellText small" width="10%" align="center" style="margin: 0px auto;text-align: center">
				<a href="index.php?module=ModuleCreator&parent=Settings&view=Relations&modulename=<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
" title="<?php echo vtranslate('Manage relations',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i title="<?php echo vtranslate('Manage relations',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="icon-random alignMiddle"></i></a>
			</td>
			<!--<td class="cellText small" width="15px" align=center></td>-->
		</tr>
	<?php }?>
<?php } ?>

</table> 
                                        
                                    </div>
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