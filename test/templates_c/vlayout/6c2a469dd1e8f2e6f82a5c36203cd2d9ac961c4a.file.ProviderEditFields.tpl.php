<?php /* Smarty version Smarty-3.1.7, created on 2016-08-01 02:17:15
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/SMSNotifier/ProviderEditFields.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1213552570579e86fbe6ce10-89042772%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c2a469dd1e8f2e6f82a5c36203cd2d9ac961c4a' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/SMSNotifier/ProviderEditFields.tpl',
      1 => 1450875180,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1213552570579e86fbe6ce10-89042772',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PROVIDER_MODEL' => 0,
    'FIELD_MODEL' => 0,
    'QUALIFIED_MODULE_NAME' => 0,
    'FIELD_NAME' => 0,
    'RECORD_MODEL' => 0,
    'FIELD_TYPE' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_KEY' => 0,
    'FIELD_VALUE' => 0,
    'PICKLIST_VALUE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579e86fbe9a82',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579e86fbe9a82')) {function content_579e86fbe9a82($_smarty_tpl) {?>
<?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PROVIDER_MODEL']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><div class="control-group"><?php $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'), null, 0);?><span class="control-label"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
</strong></span><div class="controls"><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_TYPE']->value=='picklist'){?><select class="select2 span3 marginLeftZero" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" placeholder="<?php echo vtranslate('LBL_SELECT_ONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
"><option></option><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('picklistvalues'), null, 0);?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value==$_smarty_tpl->tpl_vars['PICKLIST_KEY']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
</option><?php } ?></select><?php }elseif($_smarty_tpl->tpl_vars['FIELD_TYPE']->value=='radio'){?><input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" value='1' <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value){?> checked="checked" <?php }?> />&nbsp;<?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
&nbsp;&nbsp;&nbsp;<input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" value='0' <?php if (!$_smarty_tpl->tpl_vars['FIELD_VALUE']->value){?> checked="checked" <?php }?>/>&nbsp;<?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_TYPE']->value=='password'){?><input type="password" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" class="span3" data-validation-engine="validate[required]" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" /><?php }else{ ?><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" class="span3" <?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='username'){?> data-validation-engine="validate[required]" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" /><?php }?></div></div><?php } ?><?php }} ?>