<?php /* Smarty version Smarty-3.1.7, created on 2016-11-10 13:33:09
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerModuleButtons.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78086997858244ce5c109a5-76602573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf32bbd0e067d80d7202ca3c0727bd081bcc95e2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerModuleButtons.tpl',
      1 => 1478773982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78086997858244ce5c109a5-76602573',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULELIST' => 0,
    'RELATED_MODULE_KEY' => 0,
    'i' => 0,
    'FIELDS' => 0,
    'field' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58244ce5c4bc4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58244ce5c4bc4')) {function content_58244ce5c4bc4($_smarty_tpl) {?>
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
</label></td><td><span clas="span10"></span></td></tr><tr id="moduleField-1"></tr></table><button type="button" class="btn addButton" data-current="1" onClick="addAnswerModule(this);"><strong><?php echo vtranslate('LBL_TYPEANSWER_MODULE_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><table class="table table-bordered blockContainer showInlineTable equalSplit" ><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><input requared name="type_answer_buttons_label[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['FIELDS']->value->value;?>
"></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_buttons_step_".($_smarty_tpl->tpl_vars['i']->value)), 0);?>
</span></td></tr><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_COLOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/color.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('_name'=>"type_answer_buttons_color[".($_smarty_tpl->tpl_vars['i']->value)."]",'_value'=>''), 0);?>
</span></td><td><select name="type_answer_buttons_stepExit"><option value="">Выход из скрипта в:</option><option value="Calendar" <?php if ($_smarty_tpl->tpl_vars['field']->value['stepExit']=='Calendar'){?>selected<?php }?>>Календарь</option></select></td><td><button type="button" class="btn addButton" data-current="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" onClick="addAnswerBotton(this);"><strong><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php if ($_smarty_tpl->tpl_vars['i']->value!=1){?><span class="span1" style="float:right;"><i class="icon-trash alignMiddle" onclick="deleteAnswerBotton(this);" title="Удалить"></i></span><?php }?></td></tr></table><?php }} ?>