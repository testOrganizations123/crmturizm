<?php /* Smarty version Smarty-3.1.7, created on 2016-11-18 11:20:35
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Hotel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:133864272357ee2bf931bb89-19426850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a9984ff10182150f09efa42a98ff2f0433953d8' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/Hotel.tpl',
      1 => 1479457224,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133864272357ee2bf931bb89-19426850',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57ee2bf935ea5',
  'variables' => 
  array (
    'index' => 0,
    'MODULE' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'KEY' => 0,
    'Hotel' => 0,
    'Source' => 0,
    'VALUE' => 0,
    'country' => 0,
    'MODULE_MODEL' => 0,
    'PICKLIST_VALUE' => 0,
    'HOTEL' => 0,
    'turist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ee2bf935ea5')) {function content_57ee2bf935ea5($_smarty_tpl) {?>

<div class="row-fluid" id="hotel-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;position: relative;"><div class="deleted_container" style="position:absolute;right:10px;"><a href="javaScript:void();" onclick="jQuery('#hotel-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').remove()" title="удалить" alt="удалить"><i class="fa fa-trash-o"></i></a></div><!-- Страна --><div class="span3 margin0px"><div class="form-group"><label for="ind_hotel_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Страна',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][country]' required id="ind_source_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" onchange="getResorts(<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getCountryPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['Hotel']->value['country']))==$_smarty_tpl->tpl_vars['KEY']->value){?><?php $_smarty_tpl->tpl_vars['country'] = new Smarty_variable($_smarty_tpl->tpl_vars['Source']->value['name'], null, 0);?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Курорт --><div class="span3"><div class="form-group"><label for="ind_source_resort_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Город/Курорт',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </label><div id="type_room"><div class="input-group"><select class='form-control' name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][resort]'  id="ind_source_resort_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getResortPikList($_smarty_tpl->tpl_vars['country']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['Hotel']->value['resort']))==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div></div><div class="span2"><div class="form-group"><label for="ind_hotel_arrival_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Заезд',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input style="height: 26px;" id="ind_hotel_arrival_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control datepicker" onchange='' required name="ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][arrival]"value="<?php echo $_smarty_tpl->tpl_vars['Hotel']->value['arrival'];?>
"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span2"><div class="form-group"><label for="ind_hotel_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Выезд',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class="input-group"><input style="height: 26px;" id="ind_hotel_departure_date_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control datepicker" onchange='' required name="ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][departure]"value="<?php echo $_smarty_tpl->tpl_vars['Hotel']->value['departure'];?>
"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span2"></div><div class="clearfix"></div><!-- Отель --><div class="span3 margin0px"><div class="form-group"><label for="ind_hotel_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Название отеля',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><input style="height: 26px;" id="ind_hotel_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control" required name="ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][name]" value="<?php echo $_smarty_tpl->tpl_vars['Hotel']->value['name'];?>
"  /></div></div></div><!-- тип номера --><div class="span2"><div class="form-group"><label for="ind_hotel_room_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Тип номера',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_hotel_room_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][room]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getRoomsType(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
' <?php if (trim(decode_html($_smarty_tpl->tpl_vars['HOTEL']->value['room']))==trim($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value)){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Питание --><div class="span2"><div class="form-group"><label for="ind_hotel_food_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Питание',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_hotel_food_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][food]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFoodsType(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
' <?php if (trim(decode_html($_smarty_tpl->tpl_vars['HOTEL']->value['food']))==trim($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value)){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Размещение --><div class="span2"><div class="form-group"><label for="ind_hotel_placement_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Размещение',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_hotel_placement_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][placement]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getPlacementsType(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
' <?php if (trim(decode_html($_smarty_tpl->tpl_vars['HOTEL']->value['placement']))==trim($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value)){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Количество ночей --><div class="span2"><div class="form-group"><label for="ind_hotel_night_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Количество ночей',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div id="type_room"><select id="ind_hotel_night_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][night]' required class="form-control"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['KEY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCountArrayNumber(31); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->key => $_smarty_tpl->tpl_vars['KEY']->value){
$_smarty_tpl->tpl_vars['KEY']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['HOTEL']->value['night']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
</option><?php } ?></select></div></div></div><div class="clearfix"></div><!-- Туроператор --><div class="span4 margin0px" style="width:305px"><div class="form-group form-group-required"><label for="ind_hotel_turop_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туроператор',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><select class='form-control' name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turoperator]' required ><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getTuroperatorPikList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['HOTEL']->value['turoperator']==$_smarty_tpl->tpl_vars['KEY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</option><?php } ?></select></div></div></div><!-- Список туристов --><div class="span4" style="width:305px"><div class="form-group "><label for="ind_hotel_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Туристы',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><select class='chzn-select form-control listTurist' multiple name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turlist][]'  required style="width:300px;"><?php  $_smarty_tpl->tpl_vars['turist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['turist']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['HOTEL']->value['turlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['turist']->key => $_smarty_tpl->tpl_vars['turist']->value){
$_smarty_tpl->tpl_vars['turist']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['turist']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['turist']->value;?>
" selected=""></option><?php } ?></select></div></div><!-- Стоимость --><div class="span4" style="width:305px"><div class="form-group "><label for="ind_hotel_cost_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Стоимость',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span> </label><div class="input-group "><input id="ind_hotel_turlist_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="form-control suumTurOption" name="ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][cost]" value="<?php echo $_smarty_tpl->tpl_vars['HOTEL']->value['cost'];?>
" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div></div><?php }} ?>