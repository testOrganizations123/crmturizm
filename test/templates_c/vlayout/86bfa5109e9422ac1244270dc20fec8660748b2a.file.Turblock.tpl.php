<?php /* Smarty version Smarty-3.1.7, created on 2017-02-03 14:39:21
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/Turblock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130210448857a7b3c8b61781-74030708%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86bfa5109e9422ac1244270dc20fec8660748b2a' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/Turblock.tpl',
      1 => 1486121949,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130210448857a7b3c8b61781-74030708',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57a7b3c8d4aac',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a7b3c8d4aac')) {function content_57a7b3c8d4aac($_smarty_tpl) {?>

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