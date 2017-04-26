<?php /* Smarty version Smarty-3.1.7, created on 2016-11-10 14:18:42
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_ModuleButtons.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1918886898582451ef92e0f9-39268974%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f4b547eb788f9019d9c63641ac162eb413c3817' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_ModuleButtons.tpl',
      1 => 1478776720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1918886898582451ef92e0f9-39268974',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_582451ef98d54',
  'variables' => 
  array (
    'fields' => 0,
    'MODULE' => 0,
    'MODULELIST' => 0,
    'RELATED_MODULE_KEY' => 0,
    'CONDITION' => 0,
    'KEY' => 0,
    'i' => 0,
    'field' => 0,
    'FIELD_MODEL' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582451ef98d54')) {function content_582451ef98d54($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['c'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['fields']->value['module']['fields']), null, 0);?><table class="table table-bordered blockContainer showInlineTable equalSplit" ><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_MODULE_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><select class="chzn-select"  name="type_answer_module_name" onchange="getModuleFields(this);"><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><optgroup><?php  $_smarty_tpl->tpl_vars['RELATED_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULELIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_MODULE']->key => $_smarty_tpl->tpl_vars['RELATED_MODULE']->value){
$_smarty_tpl->tpl_vars['RELATED_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value = $_smarty_tpl->tpl_vars['RELATED_MODULE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value==$_smarty_tpl->tpl_vars['fields']->value['module']['module']){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value);?>
</option><?php } ?></optgroup></select></span></td><td></td><td><span clas="span10"></span></td></tr><?php if ($_smarty_tpl->tpl_vars['fields']->value['module']['module']==''){?><tr id="moduleField"></tr><?php }elseif(count($_smarty_tpl->tpl_vars['CONDITION']->value)==0){?><?php $_smarty_tpl->tpl_vars[$_smarty_tpl->tpl_vars['KEY']->value] = new Smarty_variable(1, null, 0);?><tr id="moduleField-<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/TypeAnswerModuleFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</tr><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['CONDITION_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CONDITION_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CONDITION']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CONDITION_INFO']->key => $_smarty_tpl->tpl_vars['CONDITION_INFO']->value){
$_smarty_tpl->tpl_vars['CONDITION_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['CONDITION_INFO']->key;
?><tr id="moduleField-<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/TypeAnswerModuleFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</tr><?php } ?><?php }?></table><button type="button" class="btn addButton pull-right" data-current="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" onClick="addAnswerModule(this);"><strong><?php echo vtranslate('LBL_TYPEANSWER_MODULE_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php $_smarty_tpl->tpl_vars['c'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['fields']->value['buttons']), null, 0);?><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value['buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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