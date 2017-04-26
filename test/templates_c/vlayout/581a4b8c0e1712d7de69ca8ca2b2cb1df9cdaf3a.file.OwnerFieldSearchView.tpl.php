<?php /* Smarty version Smarty-3.1.7, created on 2017-04-20 05:12:27
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDCustomReports/uitypes/OwnerFieldSearchView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121751367658023e37b152f2-89208601%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '581a4b8c0e1712d7de69ca8ca2b2cb1df9cdaf3a' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDCustomReports/uitypes/OwnerFieldSearchView.tpl',
      1 => 1492654195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121751367658023e37b152f2-89208601',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58023e37ba31e',
  'variables' => 
  array (
    'office' => 0,
    'USER_MODEL' => 0,
    'SEARCH_INFO' => 0,
    'SEARCH_VALUES' => 0,
    'MODULE' => 0,
    'ASSIGNED_USER_ID' => 0,
    'ALL_ACTIVEUSER_LIST' => 0,
    'OFFICE' => 0,
    'LIST_OFFICE' => 0,
    'OWNER_ID' => 0,
    'OWNER_NAME' => 0,
    'item' => 0,
    'ACCESSIBLE_USER_LIST' => 0,
    'ALL_ACTIVEGROUP_LIST' => 0,
    'ACCESSIBLE_GROUP_LIST' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58023e37ba31e')) {function content_58023e37ba31e($_smarty_tpl) {?>
<div class="row-fluid"><?php $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleUsers2('',false,$_smarty_tpl->tpl_vars['office']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['SEARCH_VALUES'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']), null, 0);?><?php $_smarty_tpl->tpl_vars['SEARCH_VALUES'] = new Smarty_variable(array_map("trim",$_smarty_tpl->tpl_vars['SEARCH_VALUES']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['ACCESSIBLE_USER_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleUsersForModule($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['ACCESSIBLE_GROUP_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleGroupForModule($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><select class="listSearchContributor span12 <?php echo $_smarty_tpl->tpl_vars['ASSIGNED_USER_ID']->value;?>
"  name="filtre[user]"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['LIST_OFFICE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LIST_OFFICE']->_loop = false;
 $_smarty_tpl->tpl_vars['OFFICE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LIST_OFFICE']->key => $_smarty_tpl->tpl_vars['LIST_OFFICE']->value){
$_smarty_tpl->tpl_vars['LIST_OFFICE']->_loop = true;
 $_smarty_tpl->tpl_vars['OFFICE']->value = $_smarty_tpl->tpl_vars['LIST_OFFICE']->key;
?><?php if ($_smarty_tpl->tpl_vars['OFFICE']->value=='no'){?><optgroup label="<?php echo vtranslate('LBL_USERS');?>
" class="groupAll"><?php }else{ ?><optgroup label='<?php echo $_smarty_tpl->tpl_vars['OFFICE']->value;?>
' class="groupAll" id='search_<?php echo $_smarty_tpl->tpl_vars['LIST_OFFICE']->value['id'];?>
'><?php }?><?php  $_smarty_tpl->tpl_vars['OWNER_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = false;
 $_smarty_tpl->tpl_vars['OWNER_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LIST_OFFICE']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_NAME']->key => $_smarty_tpl->tpl_vars['OWNER_NAME']->value){
$_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = true;
 $_smarty_tpl->tpl_vars['OWNER_ID']->value = $_smarty_tpl->tpl_vars['OWNER_NAME']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
" data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
' <?php if ($_smarty_tpl->tpl_vars['OWNER_ID']->value==$_smarty_tpl->tpl_vars['item']->value['data']){?> selected <?php }?><?php if (array_key_exists($_smarty_tpl->tpl_vars['OWNER_ID']->value,$_smarty_tpl->tpl_vars['ACCESSIBLE_USER_LIST']->value)){?> data-recordaccess=true <?php }else{ ?> data-recordaccess=false <?php }?>data-userId=""><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option><?php } ?></optgroup><?php } ?><?php if (count($_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value)>0){?><optgroup label="<?php echo vtranslate('LBL_GROUPS');?>
"><?php  $_smarty_tpl->tpl_vars['OWNER_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = false;
 $_smarty_tpl->tpl_vars['OWNER_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_NAME']->key => $_smarty_tpl->tpl_vars['OWNER_NAME']->value){
$_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = true;
 $_smarty_tpl->tpl_vars['OWNER_ID']->value = $_smarty_tpl->tpl_vars['OWNER_NAME']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
" data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
' <?php if (in_array(trim($_smarty_tpl->tpl_vars['OWNER_ID']->value),$_smarty_tpl->tpl_vars['SEARCH_VALUES']->value)){?> selected <?php }?><?php if (array_key_exists($_smarty_tpl->tpl_vars['OWNER_ID']->value,$_smarty_tpl->tpl_vars['ACCESSIBLE_GROUP_LIST']->value)){?> data-recordaccess=true <?php }else{ ?> data-recordaccess=false <?php }?> ><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option><?php } ?></optgroup><?php }?></select></div><?php }} ?>