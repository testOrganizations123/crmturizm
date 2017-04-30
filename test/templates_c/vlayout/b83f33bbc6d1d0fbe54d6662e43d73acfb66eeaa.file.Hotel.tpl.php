<?php /* Smarty version Smarty-3.1.7, created on 2017-04-30 15:37:24
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\Potentials\part\individulal\Hotel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:223635905da84df14d2-32655382%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b83f33bbc6d1d0fbe54d6662e43d73acfb66eeaa' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\Potentials\\part\\individulal\\Hotel.tpl',
      1 => 1493241761,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '223635905da84df14d2-32655382',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'index' => 0,
    'MODULE' => 0,
    'HOTEL' => 0,
    'MODULE_MODEL' => 0,
    'PICKLIST_VALUE' => 0,
    'KEY' => 0,
    'FIELD_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5905da84e965c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5905da84e965c')) {function content_5905da84e965c($_smarty_tpl) {?>

<div class="row-fluid" id="hotel-block-<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" style="background: #f5f5f5;padding:5px;box-sizing:border-box;margin-bottom:5px;"><!-- Отель --><div class="span3"><div class="form-group"><label for="ind_hotel_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo vtranslate('Название отеля',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label><div class=""><input style="height: 26px;" id="ind_hotel_name_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" type="text" class="form-control" required name="ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][name]" value="<?php echo $_smarty_tpl->tpl_vars['HOTEL']->value['name'];?>
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
</option><?php } ?></select></div></div><div class="span4" style="width:305px"><div class="form-group form-group-required"><label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"><?php echo vtranslate('Туристы',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><select class='addServiseCalculate chzn-select form-control listTurist' multiple name='ind_hotel[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][turlist]'  required style="width:300px;"></select></div></div></div></div><?php }} ?>