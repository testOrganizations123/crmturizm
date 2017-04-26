<?php /* Smarty version Smarty-3.1.7, created on 2016-11-20 16:49:25
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Transfer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158993989582d6179114bf4-38592837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44d1356794131979163c1ef373be923a986e2da1' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Transfer.tpl',
      1 => 1479649763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158993989582d6179114bf4-38592837',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_582d6179154e1',
  'variables' => 
  array (
    'index' => 0,
    'MODULE' => 0,
    'TRAN' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'KEY' => 0,
    'VALUE' => 0,
    'turist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582d6179154e1')) {function content_582d6179154e1($_smarty_tpl) {?>

<div class="row-fluid" id="trans-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;"><div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#trans-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div><!-- Авиакомпания --><div class="span2 margin0px"><div class="form-group"><label for="ind_transfer_vendor_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Перевозчик',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][vendor]' required id="ind_transfer_vendor_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['TRAN']->value['vendor'];?>
" /></div></div></div><div class="span2"><div class="form-group"><label for="ind_transfer_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Транспорт',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][name]' required id="ind_transfer_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getTransferPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['TRAN']->value['name']))==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><div class="span2"><div class="form-group"><label for="ind_transfer_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Тип трансфера',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][type]' required id="ind_transfer_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="Индивидуальный" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['TRAN']->value['type']))=='Индивидуальный'){?>selected<?php }?>>Индивидуальный</option><option value="Групповой" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['TRAN']->value['type']))=='Групповой'){?>selected<?php }?>>Групповой</option></select></div></div></div><div class="span2"><div class="form-group"><label for="ind_transfer_class_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Класс',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][class]' required id="ind_transfer_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="Premium" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['TRAN']->value['class']))=='Premium'){?>selected<?php }?>>Premium</option><option value="Comfort" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['TRAN']->value['class']))=='Comfort'){?>selected<?php }?>>Comfort</option></select></div></div></div><div class="clearfix"></div><div class="span2 margin0px"><div class="form-group"><label for="ind_transfer_departure_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Откуда',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][departure]' required id="ind_transfer_departure_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['TRAN']->value['departure'];?>
" /></div></div></div><div class="span2"><div class="form-group"><label for="ind_transfer_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Время отправления',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input style="height: 26px;" id="ind_transfer_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control datetimepicker" onchange='' required name="ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][departure_date]"value="<?php echo $_smarty_tpl->tpl_vars['TRAN']->value['departure_date'];?>
"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span2"><div class="form-group"><label for="ind_transfer_arrival_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Куда',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][arrival]' required id="ind_transfer_arrival_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['TRAN']->value['arrival'];?>
" /></div></div></div><div class="span2"><div class="form-group"><label for="ind_transfer_time_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Время в пути',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][time]' required id="ind_transfer_time_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['TRAN']->value['time'];?>
" /></div></div></div><div class="clearfix"></div><!-- Туроператор --><div class="span3 margin0px" ><div class="form-group form-group-required"><label for="ind_transfer_turop_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туроператор',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turoperator]' required ><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getTuroperatorPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['TRAN']->value['turoperator']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Список туристов --><div class="span4" ><div class="form-group "><label for="ind_transfer_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туристы',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><select class='chzn-select form-control listTurist' multiple name='ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turlist][]'  required style="width:300px;"><?php  $_smarty_tpl->tpl_vars['turist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['turist']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['TRAN']->value['turlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['turist']->key => $_smarty_tpl->tpl_vars['turist']->value){
$_smarty_tpl->tpl_vars['turist']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['turist']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['turist']->value;?>
" selected=""></option><?php } ?></select></div></div><!-- Стоимость --><div class="span2" ><div class="form-group "><label for="ind_transfer_cost_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Стоимость',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><div class="input-group "><input id="ind_transfer_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="form-control suumTurOption" name="ind_transfer[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][cost]" value="<?php echo $_smarty_tpl->tpl_vars['TRAN']->value['cost'];?>
" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div></div><?php }} ?>