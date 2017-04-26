<?php /* Smarty version Smarty-3.1.7, created on 2016-10-25 10:13:24
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/SPCMLConnector/Index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1676119850580f06140b0f84-73765198%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '991c2ab6c56f037c0864b60f0e4d09e75a98d214' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/SPCMLConnector/Index.tpl',
      1 => 1468060680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1676119850580f06140b0f84-73765198',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODEL' => 0,
    'USERS' => 0,
    'USER_MODEL' => 0,
    'USER_NAME' => 0,
    'LISTVIEW_HEADERS' => 0,
    'WIDTHTYPE' => 0,
    'COLUMN_NAME' => 0,
    'LISTVIEW_HEADER' => 0,
    'NEXT_SORT_ORDER' => 0,
    'SORT_IMAGE' => 0,
    'LISTVIEW_ENTRIES' => 0,
    'LISTVIEW_ENTRY' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_580f0614184e0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_580f0614184e0')) {function content_580f0614184e0($_smarty_tpl) {?><div class="container-fluid"><div class="widget_header"><h3><?php echo vtranslate('LBL_CML_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><hr><form id="cmlSettingsForm"><table class="table-nobordered table"><tr><td class="textAlignRight"> <label class="muted control-label"><?php echo vtranslate('LBL_ADMIN_LOGIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label> </td><td> <input class="input-xxlarge" type="text" name="adminLogin" id="adminLogin" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getAdminLogin();?>
"> </td></tr><tr><td class="textAlignRight"> <label class="muted control-label"><?php echo vtranslate('LBL_ADMIN_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td> <input class="input-xxlarge" type="text" name="adminPassword" id="adminPassword" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getAdminPassword();?>
"></td></tr><tr><td class="textAlignRight"> <label class="muted control-label"><?php echo vtranslate('LBL_WEBSITE_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td> <input class="input-xxlarge" type="text" name="websiteURL" id="websiteURL" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getSiteUrl();?>
"></td></tr><tr><td class="textAlignRight"> <label class="muted control-label"><?php echo vtranslate('LBL_ASSIGNED_USER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td><select name="assignedUser" id="assignedUser" class="small"><?php  $_smarty_tpl->tpl_vars['USER_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['USER_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['USERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['USER_MODEL']->key => $_smarty_tpl->tpl_vars['USER_MODEL']->value){
$_smarty_tpl->tpl_vars['USER_MODEL']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['USER_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('user_name'), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->getAssignedUser()==$_smarty_tpl->tpl_vars['USER_NAME']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['USER_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php } ?></select></td></tr></table><div class="row-fluid"><div class="span6 padding1per"><button class="btn addButton pull-right" type="submit" name="saveCmlSettings"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></div><div class="span6">&nbsp;</div></div></form><div class="widget_header"><h3><?php echo vtranslate('LBL_STATUSES_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><hr><button id="editStatus" class="btn addButton"  onclick="location.href='index.php?module=SPCMLConnector&view=List&parent=Settings'"><strong><?php echo vtranslate('LBL_EDIT_STATUSES_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><button id="history" class="btn addButton pull-right"  onclick="location.href='index.php?module=SPCMLConnector&view=History&parent=Settings'"><strong><?php echo vtranslate('LBL_TRANSACTION_HISTORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><br><br><table class="table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><th nowrap <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last){?> colspan="2" <?php }?> class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
 icon-white"><?php }?></a></th><?php } ?></tr></thead><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
'><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><td class="listViewEntryValue  nowrap"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td><?php } ?></tr><?php } ?></table></div>	
<?php }} ?>