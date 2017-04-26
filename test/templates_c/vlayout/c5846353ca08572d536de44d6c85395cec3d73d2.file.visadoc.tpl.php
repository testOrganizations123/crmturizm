<?php /* Smarty version Smarty-3.1.7, created on 2016-08-21 19:21:04
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/visadoc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34428728557b6d3ecb0be46-76283898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5846353ca08572d536de44d6c85395cec3d73d2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/visadoc.tpl',
      1 => 1471796408,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34428728557b6d3ecb0be46-76283898',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57b6d3ecc1855',
  'variables' => 
  array (
    'BLOCK_FIELDS' => 0,
    'LIST_CONTACT_DOCUMENTS' => 0,
    'contact_number' => 0,
    'visarow' => 0,
    'contact_id' => 0,
    'VALUE' => 0,
    'KEY' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b6d3ecc1855')) {function content_57b6d3ecc1855($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['visa_doc'], null, 0);?><?php $_smarty_tpl->tpl_vars['contact_number'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['visarow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['visarow']->_loop = false;
 $_smarty_tpl->tpl_vars['contact_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LIST_CONTACT_DOCUMENTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['visarow']->key => $_smarty_tpl->tpl_vars['visarow']->value){
$_smarty_tpl->tpl_vars['visarow']->_loop = true;
 $_smarty_tpl->tpl_vars['contact_id']->value = $_smarty_tpl->tpl_vars['visarow']->key;
?><?php $_smarty_tpl->tpl_vars['contact_number'] = new Smarty_variable($_smarty_tpl->tpl_vars['contact_number']->value+1, null, 0);?><?php if ($_smarty_tpl->tpl_vars['contact_number']->value==1){?><div class="row-fluid" style="margin-top: 25px"><?php }elseif($_smarty_tpl->tpl_vars['contact_number']->value==4){?><?php $_smarty_tpl->tpl_vars['contact_number'] = new Smarty_variable(1, null, 0);?></div><div class="row-fluid" ><?php }?><div class="span4"><div class="cms-group cms-group-white  cms-group-expanded" id="booking_edit_booking_flight_there"><div class="cms-group-label"><?php echo $_smarty_tpl->tpl_vars['visarow']->value['name'];?>
<div class="pull-right"><label>Виза есть <input type="checkbox" name="visa_doc[<?php echo $_smarty_tpl->tpl_vars['contact_id']->value;?>
][off]" onchange="visaOff(this,<?php echo $_smarty_tpl->tpl_vars['contact_id']->value;?>
)" value="1" <?php if ($_smarty_tpl->tpl_vars['visarow']->value['off']==1){?>checked<?php }?>/></div></div><div class="form-group <?php if ($_smarty_tpl->tpl_vars['visarow']->value['off']==1){?>hide<?php }?>" style="margin-top:25px;" id="cont_doc_<?php echo $_smarty_tpl->tpl_vars['contact_id']->value;?>
"><table width="100%"><tr><th width="80%" align="left">Название</th><th align="left" style="min-width:110px;max-width: 110px;width:20%">Дата сдачи</th></tr><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['visarow']->value['documents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><tr><td><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><td><input class="form-control datepicker" name='visa_doc[<?php echo $_smarty_tpl->tpl_vars['contact_id']->value;?>
][documents][<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
]' value="<?php echo $_smarty_tpl->tpl_vars['visarow']->value['selected'][$_smarty_tpl->tpl_vars['KEY']->value];?>
" style="width:100px"/></td></tr><?php } ?></table></div></div></div><?php } ?></div><div class="row-fluid" ><div class="span12 "><button class="btn btn-success pull-right" type="submit"><strong>Сохранить</strong></button></div></div><?php }} ?>