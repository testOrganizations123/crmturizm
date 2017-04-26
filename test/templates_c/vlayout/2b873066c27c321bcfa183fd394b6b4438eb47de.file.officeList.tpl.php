<?php /* Smarty version Smarty-3.1.7, created on 2016-09-01 00:09:05
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/uitypes/officeList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61177227857c745f74b19b3-39176358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b873066c27c321bcfa183fd394b6b4438eb47de' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/uitypes/officeList.tpl',
      1 => 1472677740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61177227857c745f74b19b3-39176358',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57c745f74c0f9',
  'variables' => 
  array (
    'LIST_VIEW_MODEL' => 0,
    'PICKLIST_VALUES' => 0,
    'listvalue' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_VALUE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c745f74c0f9')) {function content_57c745f74c0f9($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_VIEW_MODEL']->value->getPicklistValuesOffice(), null, 0);?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php if ($_smarty_tpl->tpl_vars['listvalue']->value==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
<?php }?><?php } ?><?php }} ?>