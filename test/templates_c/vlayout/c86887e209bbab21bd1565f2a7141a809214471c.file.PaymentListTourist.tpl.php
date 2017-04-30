<?php /* Smarty version Smarty-3.1.7, created on 2017-04-30 15:37:25
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\Potentials\part\PaymentListTourist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104495905da850f21b9-42453906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c86887e209bbab21bd1565f2a7141a809214471c' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\Potentials\\part\\PaymentListTourist.tpl',
      1 => 1493241761,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104495905da850f21b9-42453906',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD_ID' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'LIST_PAYMENT' => 0,
    'record_payment' => 0,
    'PAYMENT' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_VALUE' => 0,
    'listNumber' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5905da8516b59',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5905da8516b59')) {function content_5905da8516b59($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['LIST_PAYMENT'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getListPayment($_smarty_tpl->tpl_vars['RECORD_ID']->value,'Receipt'), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['LIST_PAYMENT']->value)>0){?><div class="row-fluid"><div class="span12"><div class="cms-group cms-group-white" id="booking_edit_booking_payment_in"><?php $_smarty_tpl->tpl_vars['listNumber'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['PAYMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PAYMENT']->_loop = false;
 $_smarty_tpl->tpl_vars['record_payment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LIST_PAYMENT']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PAYMENT']->key => $_smarty_tpl->tpl_vars['PAYMENT']->value){
$_smarty_tpl->tpl_vars['PAYMENT']->_loop = true;
 $_smarty_tpl->tpl_vars['record_payment']->value = $_smarty_tpl->tpl_vars['PAYMENT']->key;
?><div class="row-fluid" id="payment-id-<?php echo $_smarty_tpl->tpl_vars['record_payment']->value;?>
"><div class="span2"><div class="form-group form-group-required"><label>Оплачено<i class="fa fa-check"></i></label><div class="input-group"><input class="form-control price-amount" readonly value="<?php echo number_format($_smarty_tpl->tpl_vars['PAYMENT']->value['amount'],2,'.',' ');?>
" type="text"><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div><div class="span2"><div class="form-group form-group-required"><label>Дата <i class="fa fa-check"></i></label><div class="input-group"><input id="dp1471166515669" class="form-control" readonly value="<?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['PAYMENT']->value['pay_date']));?>
" type="text"><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span3"><div class="form-group form-group-required"><label>Форма оплаты <i class="fa fa-check"></i></label><select class="form-control" readonly ><option value=""><?php echo vtranslate($_smarty_tpl->tpl_vars['PAYMENT']->value['type_payment'],'SPPayments');?>
</option></select></div></div><div class="span2"><div class="form-group form-group-required"><label>Статус денег <i class="fa fa-check"></i></label><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['cf_1270'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable(Zend_Json::decode(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><select class="form-control" name="cf_1270[<?php echo $_smarty_tpl->tpl_vars['record_payment']->value;?>
]"><?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value[$_smarty_tpl->tpl_vars['record_payment']->value]==''){?> <option value="">&nbsp;</option><?php }?><option value="MY" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value[$_smarty_tpl->tpl_vars['record_payment']->value]=="MY"){?>selected<?php }?>>Моя касса</option><option value="OTV" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value[$_smarty_tpl->tpl_vars['record_payment']->value]=="OTV"){?>selected<?php }?>>Отв. лицо</option><option value="BANK" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value[$_smarty_tpl->tpl_vars['record_payment']->value]=="BANK"){?>selected<?php }?>>Банк (выдан кредит)</option><option value="TO" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value[$_smarty_tpl->tpl_vars['record_payment']->value]=="TO"){?>selected<?php }?>>Оплачено ТО</option></select></div><?php $_smarty_tpl->tpl_vars['listNumber'] = new Smarty_variable($_smarty_tpl->tpl_vars['listNumber']->value+1, null, 0);?></div><div class="span2"><label>&nbsp;</label><div class="form-group "><button class="btn btn-default pencil" onclick='editPayment(event,<?php echo $_smarty_tpl->tpl_vars['record_payment']->value;?>
)' title="Редактировать"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-default del-row" onclick='deletePayment(event,<?php echo $_smarty_tpl->tpl_vars['record_payment']->value;?>
)' title="Удалить"><i class="fa fa-times"></i></button></div></div></div><?php } ?></div></div></div><?php }?><?php }} ?>