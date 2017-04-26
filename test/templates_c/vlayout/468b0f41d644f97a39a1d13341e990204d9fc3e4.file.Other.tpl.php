<?php /* Smarty version Smarty-3.1.7, created on 2016-11-17 12:12:24
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Other.tpl" */ ?>
<?php /*%%SmartyHeaderCode:643480210582d71a7b30656-48245291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '468b0f41d644f97a39a1d13341e990204d9fc3e4' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Other.tpl',
      1 => 1479373842,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '643480210582d71a7b30656-48245291',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_582d71a7b70db',
  'variables' => 
  array (
    'index' => 0,
    'MODULE' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'KEY' => 0,
    'Other' => 0,
    'VALUE' => 0,
    'turist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582d71a7b70db')) {function content_582d71a7b70db($_smarty_tpl) {?>

<div class="row-fluid" id="other-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;"><div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#other-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div><!-- Услуга --><div class="span2"><div class="form-group"><label for="ind_servise_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Услуга',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_servise[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][name]' required id="ind_servise_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getServicePickList('Дополнительные услуги'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['Other']->value['name']))==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Туроператор --><div class="span3 " ><div class="form-group form-group-required"><label for="ind_servise_turop_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туроператор',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_servise[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turoperator]' required ><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getTuroperatorPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['Other']->value['turoperator']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Список туристов --><div class="span4" ><div class="form-group "><label for="ind_servise_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туристы',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><select class='chzn-select form-control listTurist' multiple name='ind_servise[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turlist][]'  required style="width:300px;"><?php  $_smarty_tpl->tpl_vars['turist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['turist']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Other']->value['turlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['turist']->key => $_smarty_tpl->tpl_vars['turist']->value){
$_smarty_tpl->tpl_vars['turist']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['turist']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['turist']->value;?>
" selected=""></option><?php } ?></select></div></div><!-- Стоимость --><div class="span2" ><div class="form-group "><label for="ind_servise_cost_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Стоимость',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><div class="input-group "><input id="ind_servise_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="form-control suumTurOption" name="ind_servise[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][cost]" value="<?php echo $_smarty_tpl->tpl_vars['Other']->value['cost'];?>
" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div></div><?php }} ?>