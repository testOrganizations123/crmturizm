<?php /* Smarty version Smarty-3.1.7, created on 2017-01-05 12:47:32
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/SolaryBlockAlert/uitypes/positionView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1393342129586e15b344aa68-31944365%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '000e5dba5c1241c341d54f7e524d6e8c23316b98' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/SolaryBlockAlert/uitypes/positionView.tpl',
      1 => 1483609650,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1393342129586e15b344aa68-31944365',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_586e15b3465df',
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'position' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_586e15b3465df')) {function content_586e15b3465df($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['position'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><span><?php echo trim(implode(', ',$_smarty_tpl->tpl_vars['position']->value),', ');?>
</span><?php }} ?>