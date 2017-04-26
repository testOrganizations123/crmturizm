<?php /* Smarty version Smarty-3.1.7, created on 2016-10-12 15:58:06
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_String.tpl" */ ?>
<?php /*%%SmartyHeaderCode:430079280579f7ea8e01097-42561284%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79a3a570058a65a4550be351dd95bfd3e7245d30' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_String.tpl',
      1 => 1476268813,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '430079280579f7ea8e01097-42561284',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579f7ea8e2059',
  'variables' => 
  array (
    'MODULE' => 0,
    'fields' => 0,
    'FIELD_MODEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579f7ea8e2059')) {function content_579f7ea8e2059($_smarty_tpl) {?>
<table class="table table-bordered blockContainer showInlineTable equalSplit"><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_STRING_VAR_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><input pattern="^[a-zA-Z]+$" requared name="type_answer_string_name" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value['name'];?>
"></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_string_step",'VALUE'=>$_smarty_tpl->tpl_vars['fields']->value['step'],'DISPLAYVALUE'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getStepName($_smarty_tpl->tpl_vars['fields']->value['step'])), 0);?>
</span></td></tr></table><?php }} ?>