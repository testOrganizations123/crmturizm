<?php /* Smarty version Smarty-3.1.7, created on 2016-11-08 16:26:21
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/DateRange.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21456374475821d12f5974d5-74464981%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '276d61ca9800a7652603c8f07ac1296f2b952275' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/DateRange.tpl',
      1 => 1478611572,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21456374475821d12f5974d5-74464981',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5821d12f5b967',
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'USER_MODEL' => 0,
    'dateFormat' => 0,
    'SEARCH_INFO' => 0,
    'FIELD_INFO' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5821d12f5b967')) {function content_5821d12f5b967($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()), null, 0);?><?php $_smarty_tpl->tpl_vars['dateFormat'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('date_format'), null, 0);?><div class='row-fluid'><input type='text' name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' class='span8 dateField' data-date-format='<?php echo $_smarty_tpl->tpl_vars['dateFormat']->value;?>
' data-calendar-type='range' value='<?php echo $_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue'];?>
' data-fieldinfo='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'/></div><?php }} ?>