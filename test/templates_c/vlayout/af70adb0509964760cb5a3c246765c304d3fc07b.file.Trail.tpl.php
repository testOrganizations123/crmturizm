<?php /* Smarty version Smarty-3.1.7, created on 2016-11-18 12:50:08
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Trail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1694560018582ecbd0253727-62514003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af70adb0509964760cb5a3c246765c304d3fc07b' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Trail.tpl',
      1 => 1479462482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1694560018582ecbd0253727-62514003',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_582ecbd02c1dc',
  'variables' => 
  array (
    'index' => 0,
    'MODULE' => 0,
    'Trail' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'KEY' => 0,
    'VALUE' => 0,
    'turist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582ecbd02c1dc')) {function content_582ecbd02c1dc($_smarty_tpl) {?>

<div class="row-fluid" id="trail-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;"><div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#trail-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div><!-- Авиакомпания --><div class="span2 margin0px"><div class="form-group"><label for="ind_trail_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('ЖД Компания',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input class='form-control' name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][name]' required id="ind_trail_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['name'];?>
" /></div></div></div><!-- № поезда --><div class="span2"><div class="form-group"><label for="ind_trail_no_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Номер поезда',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><div class="input-group"><input style="height: 26px;" id="ind_trail_no_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control" required name="ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][no]"value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['no'];?>
"  /></div></div></div></div><!-- Тип вагона --><div class="span2"><div class="form-group"><label for="ind_trail_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Тип вагона',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_trail_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][type]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="купе" <?php if ($_smarty_tpl->tpl_vars['Trail']->value['type']=='купе'){?>selected<?php }?>>Купе</option><option value="СВ" <?php if ($_smarty_tpl->tpl_vars['Trail']->value['type']=='СВ'){?>selected<?php }?>>СВ</option><option value="плацкард" <?php if ($_smarty_tpl->tpl_vars['Trail']->value['type']=='плацкард'){?>selected<?php }?>>Плацкард</option><option value="женский" <?php if ($_smarty_tpl->tpl_vars['Trail']->value['type']=='женский'){?>selected<?php }?>>Женский</option><option value="мужской" <?php if ($_smarty_tpl->tpl_vars['Trail']->value['type']=='мужской'){?>selected<?php }?>>Мужской</option></select></div></div></div><!-- № вагона --><div class="span2"><div class="form-group"><label for="ind_trail_vagno_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('№ вагона',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input id="ind_trail_vagno_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][vagno]' required class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['vagno'];?>
"></div></div></div><div class="span2"><div class="form-group"><label for="ind_trail_setno_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Место',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input id="ind_trail_setno_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][setno]' required class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['setno'];?>
"></div></div></div><div class="clearfix"></div><!-- Откуда  --><div class="span2 margin0px"><div class="form-group"><label for="ind_trail_departure_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Откуда',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input id="ind_trail_departure_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class='form-control ticket turPaket addShow ' name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][departure]' required value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['departure'];?>
"></div></div></div><!-- Вылет  --><div class="span2"><div class="form-group"><label for="ind_trail_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Отправление',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input style="height: 26px;" id="ind_trail_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control datetimepicker" onchange='' required name="ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][departure_date]"value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['departure_date'];?>
"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><!-- Куда  --><div class="span2"><div class="form-group"><label for="ind_trail_arrival_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Куда',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input id="ind_trail_arrival_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class='form-control' name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][arrival]' required value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['arrival'];?>
"></div></div></div><!-- Прилет  --><div class="span2"><div class="form-group"><label for="ind_trail_arrival_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Прибытие',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input style="height: 26px;" id="ind_trail_arrival_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control datetimepicker" onchange='' required name="ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][arrival_date]"value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['arrival_date'];?>
"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span4">&nbsp;</div><div class="clearfix"></div><!-- Туроператор --><div class="span4 margin0px" style="width:305px"><div class="form-group form-group-required"><label for="ind_trail_turop_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туроператор',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turoperator]' required ><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getTuroperatorPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['Trail']->value['turoperator']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Список туристов --><div class="span4" style="width:305px"><div class="form-group "><label for="ind_trail_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туристы',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><select class='chzn-select form-control listTurist' multiple name='ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turlist][]'  required style="width:300px;"><?php  $_smarty_tpl->tpl_vars['turist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['turist']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Trail']->value['turlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['turist']->key => $_smarty_tpl->tpl_vars['turist']->value){
$_smarty_tpl->tpl_vars['turist']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['turist']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['turist']->value;?>
" selected=""></option><?php } ?></select></div></div><!-- Стоимость --><div class="span4" style="width:305px"><div class="form-group "><label for="ind_trail_cost_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Стоимость',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><div class="input-group "><input id="ind_trail_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="form-control suumTurOption" name="ind_trail[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][cost]" value="<?php echo $_smarty_tpl->tpl_vars['Trail']->value['cost'];?>
" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div></div><?php }} ?>