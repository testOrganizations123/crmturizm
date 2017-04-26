<?php /* Smarty version Smarty-3.1.7, created on 2016-11-19 11:48:23
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/PaymentListOperator.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190784471583010033c89a6-99559588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d2456c4f63958bbf3da698d74f8ceb17b942f1a' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/PaymentListOperator.tpl',
      1 => 1479544957,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190784471583010033c89a6-99559588',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_583010033f86c',
  'variables' => 
  array (
    'RECORD_ID' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'LIST_PAYMENT' => 0,
    'record_payment' => 0,
    'PAYMENT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_583010033f86c')) {function content_583010033f86c($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['LIST_PAYMENT'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getListPayment($_smarty_tpl->tpl_vars['RECORD_ID']->value,'Expense'), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['LIST_PAYMENT']->value)>0){?><div class="row-fluid"><div class="span12"><div class="cms-group cms-group-white" id="booking_edit_booking_payment_in"><?php $_smarty_tpl->tpl_vars['listNumber'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['PAYMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PAYMENT']->_loop = false;
 $_smarty_tpl->tpl_vars['record_payment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LIST_PAYMENT']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PAYMENT']->key => $_smarty_tpl->tpl_vars['PAYMENT']->value){
$_smarty_tpl->tpl_vars['PAYMENT']->_loop = true;
 $_smarty_tpl->tpl_vars['record_payment']->value = $_smarty_tpl->tpl_vars['PAYMENT']->key;
?><div class="row-fluid" id="payment-id-<?php echo $_smarty_tpl->tpl_vars['record_payment']->value;?>
"><div class="span3"><div class="form-group form-group-required"><label>Оплачено <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getDisplayVendorToOperator($_smarty_tpl->tpl_vars['PAYMENT']->value['payer']);?>
<i class="fa fa-check"></i></label><div class="input-group"><input class="form-control price-amount" readonly value="<?php echo number_format($_smarty_tpl->tpl_vars['PAYMENT']->value['amount'],2,'.',' ');?>
" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div><div class="span3"><div class="form-group form-group-required"><label>Дата <i class="fa fa-check"></i></label><div class="input-group"><input id="dp1471166515669" class="form-control" readonly value="<?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['PAYMENT']->value['pay_date']));?>
" type="text"><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span3"><div class="form-group form-group-required"><label>Форма оплаты <i class="fa fa-check"></i></label><select class="form-control" readonly ><option value=""><?php echo vtranslate($_smarty_tpl->tpl_vars['PAYMENT']->value['type_payment'],'SPPayments');?>
</option></select></div></div><div class="span2"><label>&nbsp;</label><div class="form-group "><button class="btn btn-default pencil" onclick='editPayment(event,<?php echo $_smarty_tpl->tpl_vars['record_payment']->value;?>
)' title="Редактировать"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-default del-row" onclick='deletePayment(event,<?php echo $_smarty_tpl->tpl_vars['record_payment']->value;?>
)' title="Удалить"><i class="fa fa-times"></i></button></div></div></div><?php } ?></div></div></div><?php }?><?php }} ?>