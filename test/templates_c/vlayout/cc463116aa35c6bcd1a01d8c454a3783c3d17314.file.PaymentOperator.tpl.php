<?php /* Smarty version Smarty-3.1.7, created on 2016-11-19 11:40:07
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/PaymentOperator.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1995820737582ed28a6a4a21-40408188%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc463116aa35c6bcd1a01d8c454a3783c3d17314' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/PaymentOperator.tpl',
      1 => 1479544656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1995820737582ed28a6a4a21-40408188',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_582ed28a713d1',
  'variables' => 
  array (
    'IND_BLOCK' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_VALUE' => 0,
    'BLOCK_FIELDS' => 0,
    'MODULE' => 0,
    'turlist' => 0,
    'vendor' => 0,
    'operator' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'payto_vendor' => 0,
    'balance_vendor' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582ed28a713d1')) {function content_582ed28a713d1($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['IND_BLOCK']->value['payto_vendor'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['payto_vendor'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['IND_BLOCK']->value['balance_vendor'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['balance_vendor'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div class=""><div class="cms-group cms-group-expanded addPayContainer"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['paid_to'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" /><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['tur_vendor'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" /><div class="cms-group-label">Оплата оператору</div><div class="row-fluid" style="margin-top: 25px;"><div class="span3"><div class="form-group"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['pay_to'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"><?php echo vtranslate('К оплате всего',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><div class="input-group"><input id="payto_all_vendor" type="text" class="form-control"  <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" readonly/><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div><div class="span3"><div class="form-group"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['balance_to'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"><?php echo vtranslate('Долг всего',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><div class="input-group"><input id="balance_all_vendor" type="text" class="form-control"  <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  readonly /><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div><div class="span3"><div class="form-group form-group-required"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['date_pay_to'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><div class="input-group"><input style="height: 26px;" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="form-control datepicker" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value!=''&&$_smarty_tpl->tpl_vars['FIELD_VALUE']->value!="0000-00-00"){?><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['FIELD_VALUE']->value));?>
<?php }?>"  /><span style="cursor: pointer;" class="input-group-addon"><i class="fa fa-calendar"></i></span></div></div></div><div class="span3"><span class="help-block">Сначала необходимо поставить дату предоплаты, после внесения предоплаты, необходимо изменить на дату следующей предоплаты или полной оплаты</span></div><div class='clearfix'></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['IND_BLOCK']->value['listturoperator'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['turlist'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_smarty_tpl->tpl_vars['operator'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['turlist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
 $_smarty_tpl->tpl_vars['operator']->value = $_smarty_tpl->tpl_vars['vendor']->key;
?><div class="span3 margin0px"><div class="form-group"><label for="payto_vendor_<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getDisplayOperator($_smarty_tpl->tpl_vars['operator']->value);?>
 к оплате</label><div class="input-group"><input id="payto_vendor_<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
" type="text" class="form-control payto_vendor_input"  data-vendor="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
" name="payto_vendor[<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['payto_vendor']->value[$_smarty_tpl->tpl_vars['vendor']->value];?>
" onchange="changePaytoVendor(this,<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
);"/><input id="payto_vendor_old_<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
" type="hidden" class="form-control"  name="" value="<?php echo $_smarty_tpl->tpl_vars['payto_vendor']->value[$_smarty_tpl->tpl_vars['vendor']->value];?>
" /><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div><div class="span3"><div class="form-group"><label for="balance_vendor_<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
"><?php echo vtranslate('Долг',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><div class="input-group"><input id="balance_vendor_<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
" type="text" class="form-control"  name="balance_vendor[<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
]"value="<?php echo $_smarty_tpl->tpl_vars['balance_vendor']->value[$_smarty_tpl->tpl_vars['vendor']->value];?>
"  readonly /><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div><div class="span3"><label >&nbsp;</label><button class="btn "  onclick="addPaymentsTo(event, <?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
)" ><i class="fa fa-plus"></i> Добавить оплату</button>   </div><div class="clearfix"></div><?php } ?></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/PaymentListOperator.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><?php }} ?>