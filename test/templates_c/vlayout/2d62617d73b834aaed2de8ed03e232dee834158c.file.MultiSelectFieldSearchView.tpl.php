<?php /* Smarty version Smarty-3.1.7, created on 2016-07-14 13:39:43
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/uitypes/MultiSelectFieldSearchView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129720934657876bef5fb313-36370752%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d62617d73b834aaed2de8ed03e232dee834158c' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/uitypes/MultiSelectFieldSearchView.tpl',
      1 => 1450875195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129720934657876bef5fb313-36370752',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'SEARCH_INFO' => 0,
    'FIELD_INFO' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_KEY' => 0,
    'SEARCH_VALUES' => 0,
    'PICKLIST_LABEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57876bef65b83',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57876bef65b83')) {function content_57876bef65b83($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValues(), null, 0);?><?php $_smarty_tpl->tpl_vars['SEARCH_VALUES'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']), null, 0);?><div class="row-fluid"><select class="select2 listSearchContributor span9" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" multiple style="width:150px;" data-fieldinfo='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'><?php  $_smarty_tpl->tpl_vars['PICKLIST_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->key => $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->value){
$_smarty_tpl->tpl_vars['PICKLIST_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['PICKLIST_KEY']->value,$_smarty_tpl->tpl_vars['SEARCH_VALUES']->value)&&($_smarty_tpl->tpl_vars['PICKLIST_KEY']->value!='')){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->value;?>
</option><?php } ?></select></div><?php }} ?>