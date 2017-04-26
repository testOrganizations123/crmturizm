<?php /* Smarty version Smarty-3.1.7, created on 2016-11-02 13:47:32
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerButtons.tpl" */ ?>
<?php /*%%SmartyHeaderCode:736187784579338e583e405-01612522%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db517c1716c2738756015a09f61733fcdd107237' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerButtons.tpl',
      1 => 1477892124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '736187784579338e583e405-01612522',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579338e5862e9',
  'variables' => 
  array (
    'MODULE' => 0,
    'i' => 0,
    'FIELDS' => 0,
    'field' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579338e5862e9')) {function content_579338e5862e9($_smarty_tpl) {?>
<table class="table table-bordered blockContainer showInlineTable equalSplit" ><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><input requared name="type_answer_buttons_label[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['FIELDS']->value->value;?>
"></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_buttons_step_".($_smarty_tpl->tpl_vars['i']->value)), 0);?>
</span></td></tr><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_COLOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/color.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('_name'=>"type_answer_buttons_color[".($_smarty_tpl->tpl_vars['i']->value)."]",'_value'=>''), 0);?>
</span></td><td><select name="type_answer_buttons_stepExit"><option value="">Выход из скрипта в:</option><option value="Calendar" <?php if ($_smarty_tpl->tpl_vars['field']->value['stepExit']=='Calendar'){?>selected<?php }?>>Календарь</option></select></td><td><button type="button" class="btn addButton" data-current="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" onClick="addAnswerBotton(this);"><strong><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php if ($_smarty_tpl->tpl_vars['i']->value!=1){?><span class="span1" style="float:right;"><i class="icon-trash alignMiddle" onclick="deleteAnswerBotton(this);" title="Удалить"></i></span><?php }?></td></tr></table><?php }} ?>