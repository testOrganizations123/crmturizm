<?php /* Smarty version Smarty-3.1.7, created on 2016-07-24 13:23:52
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/color.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12236398535791e6304e2784-04811970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1173a806da883ca537278fe8ce2d78a134fd805d' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/color.tpl',
      1 => 1469355826,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12236398535791e6304e2784-04811970',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5791e6304f9b2',
  'variables' => 
  array (
    '_name' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'PICKLIST_NAME' => 0,
    '_value' => 0,
    'PICKLIST_VALUE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5791e6304f9b2')) {function content_5791e6304f9b2($_smarty_tpl) {?>
<select class="chzn-select " name="<?php echo $_smarty_tpl->tpl_vars['_name']->value;?>
" ><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getColorPickList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['_value']->value))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select><?php }} ?>