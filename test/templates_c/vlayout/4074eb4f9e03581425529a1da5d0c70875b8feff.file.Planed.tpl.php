<?php /* Smarty version Smarty-3.1.7, created on 2016-11-18 12:51:27
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Planed.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1048068438582ae6bd7544f7-16300728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4074eb4f9e03581425529a1da5d0c70875b8feff' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Planed.tpl',
      1 => 1479462684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1048068438582ae6bd7544f7-16300728',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_582ae6bd7d355',
  'variables' => 
  array (
    'index' => 0,
    'MODULE' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'KEY' => 0,
    'FLY' => 0,
    'VALUE' => 0,
    'turist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582ae6bd7d355')) {function content_582ae6bd7d355($_smarty_tpl) {?>

<div class="row-fluid" id="planed-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;"><div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#planed-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div><!-- Авиакомпания --><div class="span2 margin0px"><div class="form-group"><label for="ind_flyte_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Авиакомпания',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][name]' required id="ind_flyte_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getAirlinePikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FLY']->value['name']))==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Рейс --><div class="span2"><div class="form-group"><label for="ind_flyte_fly_no_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Рейс',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><div class="input-group"><input style="height: 26px;" id="ind_flyte_fly_no_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control" required name="ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][fly_no]"value="<?php echo $_smarty_tpl->tpl_vars['FLY']->value['fly_no'];?>
"  /></div></div></div></div><!-- Тип рейса --><div class="span2"><div class="form-group"><label for="ind_flyte_type_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Тип рейса',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_flyte_food_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][type]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="регулярный" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['type']=='регулярный'){?>selected<?php }?>>Регуляный</option><option value="чартер" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['type']=='чартер'){?>selected<?php }?>>Чартер</option></select></div></div></div><!-- Класс --><div class="span2"><div class="form-group"><label for="ind_flyte_class_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Класс',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_flyte_class_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][class]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="экономичный" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['class']=='экономичный'){?>selected<?php }?>>Экономичный</option><option value="бизнес" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['class']=='бизнес'){?>selected<?php }?>>Бизнес</option><option value="комфорт" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['class']=='комфорт'){?>selected<?php }?>>Повышенной комфортности</option></select></div></div></div><div class="span1"><div class="form-group"><label for="ind_flyte_bagage_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Багаж',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_flyte_bagage_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][bagage]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="0" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['class']=='0'){?>selected<?php }?>>Нет</option><option value="10" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['bagage']=='10'){?>selected<?php }?>>10кг</option><option value="15" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['bagage']=='15'){?>selected<?php }?>>15кг</option><option value="20" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['bagage']=='20'){?>selected<?php }?>>20кг</option><option value="25" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['bagage']=='25'){?>selected<?php }?>>25кг</option><option value="30" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['bagage']=='30'){?>selected<?php }?>>30кг</option><option value="35" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['bagage']=='35'){?>selected<?php }?>>35кг</option><option value="40" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['bagage']=='40'){?>selected<?php }?>>40кг</option></select></div></div></div><div class="span2"><div class="form-group"><label for="ind_flyte_food_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Питание',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_flyte_class_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][food]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="Нет" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['food']=='Нет'){?>selected<?php }?>>Нет</option><option value="Есть" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['food']=='Есть'){?>selected<?php }?>>Есть</option></select></div></div></div><div class="clearfix"></div><!-- Откуда  --><div class="span2 margin0px"><div class="form-group"><label for="ind_flyte_departure_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Откуда',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_flyte_departure_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class='form-control ticket turPaket addShow ' name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][departure]' required ><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getAirportsPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['departure']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Вылет  --><div class="span2"><div class="form-group"><label for="ind_flyte_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Вылет',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input style="height: 26px;" id="ind_flyte_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control datetimepicker" onchange='' required name="ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][departure_date]"value="<?php echo $_smarty_tpl->tpl_vars['FLY']->value['departure_date'];?>
"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><!-- Куда  --><div class="span2"><div class="form-group"><label for="ind_flyte_arrival_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Куда',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_flyte_departure_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class='form-control ticket turPaket addShow ' name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][arrival]' required ><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getAirportsPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['arrival']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Прилет  --><div class="span2"><div class="form-group"><label for="ind_flyte_arrival_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Прилет',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input style="height: 26px;" id="ind_flyte_arrival_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control datetimepicker" onchange='' required name="ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][arrival_date]"value="<?php echo $_smarty_tpl->tpl_vars['FLY']->value['arrival_date'];?>
"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span4">&nbsp;</div><div class="clearfix"></div><!-- Туроператор --><div class="span4 margin0px" style="width:305px"><div class="form-group form-group-required"><label for="ind_flyte_turop_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туроператор',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turoperator]' required ><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getTuroperatorPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FLY']->value['turoperator']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Список туристов --><div class="span4" style="width:305px"><div class="form-group "><label for="ind_flyte_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туристы',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><select class='chzn-select form-control listTurist' multiple name='ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turlist][]'  required style="width:300px;"><?php  $_smarty_tpl->tpl_vars['turist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['turist']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FLY']->value['turlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['turist']->key => $_smarty_tpl->tpl_vars['turist']->value){
$_smarty_tpl->tpl_vars['turist']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['turist']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['turist']->value;?>
" selected=""></option><?php } ?></select></div></div><!-- Стоимость --><div class="span4" style="width:305px"><div class="form-group "><label for="ind_flyte_cost_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Стоимость',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><div class="input-group "><input id="ind_flyte_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="form-control suumTurOption" name="ind_flyte[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][cost]" value="<?php echo $_smarty_tpl->tpl_vars['FLY']->value['cost'];?>
" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div></div><?php }} ?>