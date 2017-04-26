<?php /* Smarty version Smarty-3.1.7, created on 2016-08-01 19:41:43
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerString.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38818576057932c9d561744-68429550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '411319ddd8ab92aca56eb77652ca841ab5f269d2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerString.tpl',
      1 => 1469627822,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38818576057932c9d561744-68429550',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57932c9d57957',
  'variables' => 
  array (
    'MODULE' => 0,
    'FIELDS' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57932c9d57957')) {function content_57932c9d57957($_smarty_tpl) {?>
<table class="table table-bordered blockContainer showInlineTable equalSplit"><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_STRING_VAR_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><input pattern="^[a-zA-Z]+$" requared name="type_answer_string_name" value="<?php echo $_smarty_tpl->tpl_vars['FIELDS']->value['value'];?>
"></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_string_step",'NAMEDISPLAY'=>"type_answer_string_step"), 0);?>
</span></td></tr></table><?php }} ?>