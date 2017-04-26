<?php /* Smarty version Smarty-3.1.7, created on 2016-11-14 10:35:28
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/ListTur.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138226271657ab1296032365-03993382%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f237610efbf228ce5752b64ae1fd8bf77d257f6' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/ListTur.tpl',
      1 => 1479108923,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138226271657ab1296032365-03993382',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57ab129606e60',
  'variables' => 
  array (
    'opportunity_type' => 0,
    'MODULE' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_VALUE' => 0,
    'DOGOVOR_VALUE' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'LIST_CONTACT' => 0,
    'CONTACT' => 0,
    'recordId' => 0,
    'dogovor' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ab129606e60')) {function content_57ab129606e60($_smarty_tpl) {?>
<table class="table table-bordered blockContainer showInlineTable equalSplit <?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value==''){?>hide<?php }?> blockShow"><thead><tr><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Индивидуальный Тур"){?><th class="blockHeader" id="turist_label" colspan="4"><?php echo vtranslate('Туристы',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><?php }else{ ?><th class="blockHeader" id="turist_label" colspan="4"><?php echo vtranslate('Пассажиры',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><?php }?></tr></thead><tbody><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['dogovor_id_turist'], null, 0);?><?php $_smarty_tpl->tpl_vars['DOGOVOR_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['list_tourist'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['LIST_CONTACT'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getListContact($_smarty_tpl->tpl_vars['FIELD_VALUE']->value,$_smarty_tpl->tpl_vars['DOGOVOR_VALUE']->value), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['LIST_CONTACT']->value)>0){?><?php  $_smarty_tpl->tpl_vars['CONTACT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CONTACT']->_loop = false;
 $_smarty_tpl->tpl_vars['recordId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LIST_CONTACT']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CONTACT']->key => $_smarty_tpl->tpl_vars['CONTACT']->value){
$_smarty_tpl->tpl_vars['CONTACT']->_loop = true;
 $_smarty_tpl->tpl_vars['recordId']->value = $_smarty_tpl->tpl_vars['CONTACT']->key;
?><?php $_smarty_tpl->tpl_vars['dogovor'] = new Smarty_variable(false, null, 0);?><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['mailingstreet']){?><?php $_smarty_tpl->tpl_vars['dogovor'] = new Smarty_variable(true, null, 0);?><?php }?><tr id='turist-<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
' class="turist"><td><input class="listTurist" name="list_tourist[]" value="<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
" type="hidden" /><input id="touristName_<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['lastname'];?>
<?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['firstname']!=''){?> <?php echo mb_substr($_smarty_tpl->tpl_vars['CONTACT']->value['firstname'],0,1);?>
.<?php }?><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['cf_1087']!=''){?> <?php echo mb_substr($_smarty_tpl->tpl_vars['CONTACT']->value['cf_1087'],0,1);?>
.<?php }?>" type="hidden" /><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span3"><div class="form-group"><label>ФИО</label><p class="fio"><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['lastname'];?>
 <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1087'];?>
<br><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1089'];?>
 <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1091'];?>
</p></div></div><div class="span2"><div class="form-group"><label>Дата рождения</label><p class="form-control-static"><?php if (!empty($_smarty_tpl->tpl_vars['CONTACT']->value['birthday'])){?><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['CONTACT']->value['birthday']));?>
<?php }?></p><p class="form-control-static"><b>Email:</b> <?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['email']!=''){?><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['email'];?>
<?php }else{ ?>-<?php }?></p></div></div><div class="span3"><div class="form-group"><label>Паспорт</label><p class="form-control-static"><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1093'];?>
 <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1095'];?>
, <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1097'];?>
<br>выдан c <?php if (!empty($_smarty_tpl->tpl_vars['CONTACT']->value['cf_1099'])){?><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['CONTACT']->value['cf_1099']));?>
<?php }else{ ?> --- <?php }?> по <?php if (!empty($_smarty_tpl->tpl_vars['CONTACT']->value['cf_1101'])){?><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['CONTACT']->value['cf_1101']));?>
<?php }else{ ?> --- <?php }?> </p></div></div><div class="span4"><div class="form-group"><label>Адрес</label><p class="form-control-static"><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['mailingstate']!=''){?><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['mailingstate'];?>
, <?php }?><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['mailingcity'];?>
, <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['mailingstreet'];?>
</p><p class="form-control-static"><b>Телефон:</b><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['phone']!=''){?><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['phone'];?>
<?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['mobile']!=''){?><br /><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['mobile']!=''){?><?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['mobile'];?>
<?php }?></p></div></div></div><div class="row-fluid"><div class="span10"><label class="radio"><input name="dogovor_id_turist" value="<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
" type="radio" <?php if ($_smarty_tpl->tpl_vars['dogovor']->value==false){?>disabled<?php }?> <?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['TYPEDOGOVOR']=='turist'){?>checked<?php }?> onclick="changeDogovor(<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"> Оформить договор на этого туриста</label><label class="radio"><input name="dogovor_id_turist" value="<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
:none" type="radio" <?php if ($_smarty_tpl->tpl_vars['dogovor']->value==false){?>disabled<?php }?> <?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['TYPEDOGOVOR']=='none'){?>checked<?php }?> onclick="changeDogovor(<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"> Оформить договор на этого клиента (не является туристом)</label></div><div class="span2"><button class="btn btn-default" onclick="editTurist(event,<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-default btn-block-remove" onclick="removeTurist(event,<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"><i class="fa fa-times"></i></button></div></div></div></td></tr><?php } ?><?php }?><tr class="addturist"><td><input type="hidden" class="sourceField" name="turist_id[]"><input name="popupReferenceModule" value="Contacts" type="hidden"><a href="#" id="addTurist" class="btn"><i class="fa fa-search"></i> Выбор из списка</a><span class="btn add-on cursorPointer createReferenceRecord"><i id="Potentials_editView_fieldName_contact_id_create" class="icon-plus" title="Создать"></i> Создать нового</span><button class="btn btn-success pull-right" type="submit"><strong>Сохранить</strong></button></td></tr></tbody></table><br><?php }} ?>