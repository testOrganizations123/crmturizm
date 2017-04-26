<?php /* Smarty version Smarty-3.1.7, created on 2016-08-31 23:49:01
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/uitypes/officeView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131663876557c73f9cf2fa46-34236250%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45f98db8a868c364fedcb97109ebe94178f0f054' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/uitypes/officeView.tpl',
      1 => 1472676506,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131663876557c73f9cf2fa46-34236250',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57c73f9cf3ae5',
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_NAME' => 0,
    'listvalue' => 0,
    'PICKLIST_VALUE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c73f9cf3ae5')) {function content_57c73f9cf3ae5($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValuesOffice(), null, 0);?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)||$_smarty_tpl->tpl_vars['listvalue']->value==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
<?php }?><?php } ?><?php }} ?>