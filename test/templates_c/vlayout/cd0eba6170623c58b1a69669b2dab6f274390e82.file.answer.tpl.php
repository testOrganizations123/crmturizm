<?php /* Smarty version Smarty-3.1.7, created on 2016-07-28 23:40:11
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/answer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2937842115798f488ec7cb2-09786373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd0eba6170623c58b1a69669b2dab6f274390e82' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/answer.tpl',
      1 => 1469738347,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2937842115798f488ec7cb2-09786373',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5798f488edb56',
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'type_answer' => 0,
    'fields' => 0,
    'MODULE_NAME' => 0,
    'field' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5798f488edb56')) {function content_5798f488edb56($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['fields'] = new Smarty_variable(Zend_Json::decode(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'))), null, 0);?><?php if ($_smarty_tpl->tpl_vars['type_answer']->value=='Buttons'){?><table class="table table-bordered blockContainer showInlineTable equalSplit" ><?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_LABEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
</span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getStepName($_smarty_tpl->tpl_vars['field']->value['step']);?>
</span></td></tr><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_COLOR',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td><span clas="span10"><?php echo vtranslate($_smarty_tpl->tpl_vars['field']->value['color'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></td><td></td><td></td></tr><?php } ?></table><?php }elseif($_smarty_tpl->tpl_vars['type_answer']->value=='Module'){?><table class="table table-bordered blockContainer showInlineTable equalSplit" ><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_MODULE_LABEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td><span clas="span10"><?php echo vtranslate($_smarty_tpl->tpl_vars['fields']->value['name'],$_smarty_tpl->tpl_vars['fields']->value['name']);?>
</span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_BUTTONS_STEP',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getStepName($_smarty_tpl->tpl_vars['fields']->value['step']);?>
</span></td></tr><?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value['field']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['field']->key;
?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_MODULE_FIELD',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td><span clas="span10"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldNameRelatedModule($_smarty_tpl->tpl_vars['field']->value['field']),$_smarty_tpl->tpl_vars['fields']->value['name']);?>
</span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_MODULE_COMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><?php echo $_smarty_tpl->tpl_vars['field']->value['comment'];?>
</span></td></tr><?php } ?></table><?php }?><?php }} ?>