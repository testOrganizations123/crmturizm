<?php /* Smarty version Smarty-3.1.7, created on 2016-12-21 19:23:12
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/uitypes/events.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210045084657a3c13b9c7050-21677117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b890b5ac70fa066ccdb4a41032f3db207ab8d75' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/uitypes/events.tpl',
      1 => 1480574229,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210045084657a3c13b9c7050-21677117',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57a3c13ba793a',
  'variables' => 
  array (
    'PARENTMODULENAME' => 0,
    'LISTVIEW_ENTRY' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a3c13ba793a')) {function content_57a3c13ba793a($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['PARENTMODULENAME']->value), null, 0);?><td><span class="label label-info">Задача</span><br><small>от <?php echo date('d.m.y',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['createdtime']));?>
</small></td><td><strong> <?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['activitytype'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><td><h4><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['subject'];?>
</h4><strong><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['description'];?>
</strong></td><td><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['priority'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
<?php }} ?>