<?php /* Smarty version Smarty-3.1.7, created on 2016-10-25 10:16:23
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/SPCMLConnector/History.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1121735485580f06c7d53e36-73736776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c900634f75479d3cc24a0d4d29a56f8d5dc44a8' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/SPCMLConnector/History.tpl',
      1 => 1468060680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1121735485580f06c7d53e36-73736776',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODEL' => 0,
    'HEADER' => 0,
    'ENTRY' => 0,
    'ENTRY_ELEMENT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_580f06c7d9803',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_580f06c7d9803')) {function content_580f06c7d9803($_smarty_tpl) {?><div class="container-fluid"><div class="widget_header"><h3><?php echo vtranslate('LBL_TRANSACTION_HISTORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><hr><table class="table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><?php  $_smarty_tpl->tpl_vars['HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODEL']->value->getHeaders(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER']->key => $_smarty_tpl->tpl_vars['HEADER']->value){
$_smarty_tpl->tpl_vars['HEADER']->_loop = true;
?><th nowrap><?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php } ?></tr></thead><?php  $_smarty_tpl->tpl_vars['ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODEL']->value->getEntries(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ENTRY']->key => $_smarty_tpl->tpl_vars['ENTRY']->value){
$_smarty_tpl->tpl_vars['ENTRY']->_loop = true;
?><tr class="listViewEntries"><?php  $_smarty_tpl->tpl_vars['ENTRY_ELEMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ENTRY_ELEMENT']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ENTRY']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ENTRY_ELEMENT']->key => $_smarty_tpl->tpl_vars['ENTRY_ELEMENT']->value){
$_smarty_tpl->tpl_vars['ENTRY_ELEMENT']->_loop = true;
?><td class="listViewEntryValue  nowrap"><?php echo vtranslate($_smarty_tpl->tpl_vars['ENTRY_ELEMENT']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td><?php } ?></tr><?php } ?></table></div><?php }} ?>