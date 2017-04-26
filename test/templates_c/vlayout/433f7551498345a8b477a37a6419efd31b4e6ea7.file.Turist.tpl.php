<?php /* Smarty version Smarty-3.1.7, created on 2016-11-14 10:55:53
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/Turist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:54936402457a9fe04bc4ee8-41173961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '433f7551498345a8b477a37a6419efd31b4e6ea7' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/Turist.tpl',
      1 => 1479110126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54936402457a9fe04bc4ee8-41173961',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57a9fe04bd95c',
  'variables' => 
  array (
    'LIST_CONTACT' => 0,
    'CONTACT' => 0,
    'recordId' => 0,
    'dogovor' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a9fe04bd95c')) {function content_57a9fe04bd95c($_smarty_tpl) {?>
<?php  $_smarty_tpl->tpl_vars['CONTACT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CONTACT']->_loop = false;
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
" type="radio" <?php if ($_smarty_tpl->tpl_vars['dogovor']->value==false){?>disabled<?php }?> onclick="changeDogovor(<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"> Оформить договор на этого туриста</label><label class="radio"><input name="dogovor_id_turist" value="<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
:none" type="radio" <?php if ($_smarty_tpl->tpl_vars['dogovor']->value==false){?>disabled<?php }?> onclick="changeDogovor(<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"> Оформить договор на этого клиента (не является туристом)</label></div><div class="span2"><button class="btn btn-default" onclick="editTurist(event,<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"><i class="fa fa-pencil"></i> Редактировать</button>&nbsp;&nbsp;<button class="btn btn-default btn-block-remove" onclick="removeTurist(event,<?php echo $_smarty_tpl->tpl_vars['recordId']->value;?>
);"><i class="fa fa-times"></i></button></div></div></div></td></tr><?php } ?><?php }} ?>