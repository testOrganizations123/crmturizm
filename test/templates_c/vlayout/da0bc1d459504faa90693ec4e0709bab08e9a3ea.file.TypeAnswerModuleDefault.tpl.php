<?php /* Smarty version Smarty-3.1.7, created on 2016-10-26 13:08:31
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerModuleDefault.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13948589705810809f08e406-55363529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da0bc1d459504faa90693ec4e0709bab08e9a3ea' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerModuleDefault.tpl',
      1 => 1477476496,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13948589705810809f08e406-55363529',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULELIST' => 0,
    'RELATED_MODULE_KEY' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5810809f0b4f0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5810809f0b4f0')) {function content_5810809f0b4f0($_smarty_tpl) {?>
<table class="table table-bordered blockContainer showInlineTable equalSplit" ><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_MODULE_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><select class="chzn-select"  name="type_answer_module_name" onchange="getModuleFields(this);"><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><optgroup><?php  $_smarty_tpl->tpl_vars['RELATED_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULELIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_MODULE']->key => $_smarty_tpl->tpl_vars['RELATED_MODULE']->value){
$_smarty_tpl->tpl_vars['RELATED_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value = $_smarty_tpl->tpl_vars['RELATED_MODULE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value;?>
" ><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value);?>
</option><?php } ?></optgroup></select></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_module_step"), 0);?>
</span></td></tr><tr id="moduleField-1"></tr></table><button type="button" class="btn addButton" data-current="1" onClick="addAnswerModuleDefault(this);"><strong><?php echo vtranslate('LBL_TYPEANSWER_MODULE_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php }} ?>