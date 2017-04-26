<?php /* Smarty version Smarty-3.1.7, created on 2016-08-06 14:09:12
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_LongString.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96807924257a5c558065d76-45426881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '005b9bc1ba79b4dd8f702d7d7d416c5358caf17b' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_LongString.tpl',
      1 => 1470481691,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96807924257a5c558065d76-45426881',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'fields' => 0,
    'FIELD_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57a5c558088fd',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a5c558088fd')) {function content_57a5c558088fd($_smarty_tpl) {?>
<table class="table table-bordered blockContainer showInlineTable equalSplit"><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_STRING_VAR_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><input pattern="^[a-zA-Z]+$" requared name="type_answer_string_name" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value['name'];?>
"></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_string_step",'VALUE'=>$_smarty_tpl->tpl_vars['fields']->value['step'],'DISPLAYVALUE'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getStepName($_smarty_tpl->tpl_vars['fields']->value['step'])), 0);?>
</span></td></tr></table><?php }} ?>