<?php /* Smarty version Smarty-3.1.7, created on 2016-08-06 13:01:55
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_Module.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1912478712579a1cd9423409-85233776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bd368fa2b210b81f55f7cb024c4da1cf3195261' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/Answer_Module.tpl',
      1 => 1470477706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1912478712579a1cd9423409-85233776',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579a1cd9467e4',
  'variables' => 
  array (
    'fields' => 0,
    'MODULE' => 0,
    'MODULELIST' => 0,
    'RELATED_MODULE_KEY' => 0,
    'FIELD_MODEL' => 0,
    'CONDITION' => 0,
    'KEY' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579a1cd9467e4')) {function content_579a1cd9467e4($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['c'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['fields']->value), null, 0);?><table class="table table-bordered blockContainer showInlineTable equalSplit" ><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_MODULE_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><select class="chzn-select"  name="type_answer_module_name" onchange="getModuleFields(this);"><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><optgroup><?php  $_smarty_tpl->tpl_vars['RELATED_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULELIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_MODULE']->key => $_smarty_tpl->tpl_vars['RELATED_MODULE']->value){
$_smarty_tpl->tpl_vars['RELATED_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value = $_smarty_tpl->tpl_vars['RELATED_MODULE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value==$_smarty_tpl->tpl_vars['fields']->value['name']){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_KEY']->value);?>
</option><?php } ?></optgroup></select></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/SelectListSteps.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NAME'=>"type_answer_module_step",'VALUE'=>$_smarty_tpl->tpl_vars['fields']->value['step'],'DISPLAYVALUE'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getStepName($_smarty_tpl->tpl_vars['fields']->value['step'])), 0);?>
</span></td></tr><?php if ($_smarty_tpl->tpl_vars['fields']->value['name']==''){?><tr id="moduleField"></tr><?php }elseif(count($_smarty_tpl->tpl_vars['CONDITION']->value)==0){?><?php $_smarty_tpl->tpl_vars[$_smarty_tpl->tpl_vars['KEY']->value] = new Smarty_variable(1, null, 0);?><tr id="moduleField-<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
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
</strong></button><?php }} ?>