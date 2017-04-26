<?php /* Smarty version Smarty-3.1.7, created on 2016-10-30 18:11:13
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_Buttons.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1446435366579a0be72845a1-94487461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2267ac1225359f25c2b4c189bd728fde7896f63' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_Buttons.tpl',
      1 => 1477840262,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1446435366579a0be72845a1-94487461',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579a0be72b25a',
  'variables' => 
  array (
    'fields' => 0,
    'i' => 0,
    'MODULE' => 0,
    'field' => 0,
    'FIELD_MODEL' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579a0be72b25a')) {function content_579a0be72b25a($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['c'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['fields']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?><table class="table table-bordered blockContainer showInlineTable equalSplit" ><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><input requared name="type_answer_buttons_label[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
]" value='<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_buttons_step_".($_smarty_tpl->tpl_vars['i']->value),'VALUE'=>$_smarty_tpl->tpl_vars['field']->value['step'],'DISPLAYVALUE'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getStepName($_smarty_tpl->tpl_vars['field']->value['step'])), 0);?>
</span></td></tr><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_COLOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/color.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('_name'=>"type_answer_buttons_color[".($_smarty_tpl->tpl_vars['i']->value)."]",'_value'=>$_smarty_tpl->tpl_vars['field']->value['color']), 0);?>
</span></td><td><select name="type_answer_buttons_stepExit[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
]"><option value="">Выход из скрипта в:</option><option value="Calendar" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['field']->value['stepExit']))=='Calendar'){?>selected<?php }?>>Календарь</option></select></td><td><button type="button" class="btn addButton <?php if ($_smarty_tpl->tpl_vars['c']->value!=$_smarty_tpl->tpl_vars['i']->value){?>hide<?php }?>" data-current="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" onClick="addAnswerBotton(this);"><strong><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php if ($_smarty_tpl->tpl_vars['i']->value!=1){?><span class="span1" style="float:right;"><i class="icon-trash alignMiddle" onclick="deleteAnswerBotton(this);" title="Удалить"></i></span><?php }?></td></tr></table><?php } ?><?php }} ?>