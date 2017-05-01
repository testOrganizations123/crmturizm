<?php /* Smarty version Smarty-3.1.7, created on 2017-05-01 10:53:50
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\Potentials\part\Turblock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187655906e98e1f5172-50812613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2b9d010b6bdafde015cc848aaf2a14694198e9b' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\Potentials\\part\\Turblock.tpl',
      1 => 1493241805,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187655906e98e1f5172-50812613',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'opportunity_type' => 0,
    'MODULE' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'RECORD_MODEL' => 0,
    'Country' => 0,
    'LIST_CONTACT_DOCUMENTS' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'visa' => 0,
    'visa_status' => 0,
    'FIELD_VALUE' => 0,
    'check_array' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5906e98e422d2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906e98e422d2')) {function content_5906e98e422d2($_smarty_tpl) {?>

<div class="<?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value==''){?>hide<?php }?> blockShow"><div class="cms-group"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/direction.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value==''||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"){?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['country'], null, 0);?><?php $_smarty_tpl->tpl_vars["Country"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['LIST_CONTACT_DOCUMENTS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getListDocumentVisa(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['Country']->value>0&&count($_smarty_tpl->tpl_vars['LIST_CONTACT_DOCUMENTS']->value)>0){?><?php $_smarty_tpl->tpl_vars['visa'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getCountryIsVisa($_smarty_tpl->tpl_vars['Country']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['visa']->value==true&&$_smarty_tpl->tpl_vars['visa_status']->value!="Виза не нужна"){?><!-- документы на визу --><div class="row-fluid"><div class="span12"><div class="cms-group cms-group-white  cms-group-expanded"id="booking_edit_booking_flight_there"><div class="cms-group-label">Документы на визу</div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/visadoc.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div></div><?php }?><?php }?><?php }?><!-- Туда --><div class="row-fluid"><div class="span12"><div class="cms-group cms-group-white  cms-group-expanded" id="booking_edit_booking_flight_there"><div class="cms-group-label">Туда</div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['dep_airline'], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['check_array'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['FIELD_VALUE']->value), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['check_array']->value)>1){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/departure_rows.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/departure.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></div></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['arr_airline'], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['check_array'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['FIELD_VALUE']->value), null, 0);?><div class="row-fluid compressed ticket addShow rail <?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value==''||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Индивидуальный Тур"||$_smarty_tpl->tpl_vars['FIELD_VALUE']->value!=''){?>hide<?php }?>"><div class="span3"><button class="btn btn-default add-row-fluid"onclick="event.preventDefault();jQuery('.checkComeback').show();jQuery(this).hide();"><iclass="fa fa-plus"></i>Обратно</button></div></div></div><!-- Туда - КОНЕЦ --><div class="row-fluid <?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value==''||($_smarty_tpl->tpl_vars['opportunity_type']->value=="Авиа билеты"&&$_smarty_tpl->tpl_vars['FIELD_VALUE']->value=='')||($_smarty_tpl->tpl_vars['opportunity_type']->value=="ЖД билеты"&&$_smarty_tpl->tpl_vars['FIELD_VALUE']->value=='')){?>hide<?php }?> turPaket checkComeback addShow"><div class="span12"><div class="cms-group cms-group-white  cms-group-expanded" id="booking_edit_booking_flight_back"><div class="cms-group-label">Обратно <?php echo count($_smarty_tpl->tpl_vars['check_array']->value);?>
</div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['arr_airline'], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['check_array'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['FIELD_VALUE']->value), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['check_array']->value)>1){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/arrival_rows.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/arrival.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></div></div></div><!-- Обратно КОНЕЦ --><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value==''||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/hotel.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/transfer.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></div></div><?php }} ?>