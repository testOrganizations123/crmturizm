<?php /* Smarty version Smarty-3.1.7, created on 2016-11-18 13:16:31
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/TurFields.tpl" */ ?>
<?php /*%%SmartyHeaderCode:649535503582ed4ffb404a3-81401559%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '778dc42b26bd77d071d6e8e2677d837b8ded2ecb' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/TurFields.tpl',
      1 => 1479464167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '649535503582ed4ffb404a3-81401559',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'opportunity_type' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'MODULE' => 0,
    'FIELD_VALUE' => 0,
    'amoun_cur' => 0,
    'OCCUPY_COMPLETE_WIDTH' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_VALUE' => 0,
    'cur' => 0,
    'amount_cur' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_582ed4ffc1a16',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582ed4ffc1a16')) {function content_582ed4ffc1a16($_smarty_tpl) {?>

<div class="<?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value==''){?>hide<?php }?> blockShow"><div class="cms-group cms-group-expanded"><div class="cms-group-label" id="amount_tur_label"><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Индивидуальный Тур"){?>Стоимость тура<?php }else{ ?>Стоимость<?php }?></div><div class="row addShow turPaket <?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value!="Пакетный Тур"&&$_smarty_tpl->tpl_vars['opportunity_type']->value!="Индивидуальный Тур"){?> hide<?php }?>"><div class="span2" style="width: 170px;"><div class="form-group form-group-required"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['cena'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
">Цена <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><div class="input-group"><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required <?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" /><span class="input-group-addon"><i class="fa fa-rub"></i></span></div></div></div><div class="span1" style="width: 120px;"><div class="form-group "><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['discount'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?>
                            <label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
">Скидка<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label>
                            <div class="input-group">
                                
                                    <input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"
                                    value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><span class="input-group-addon">%</span>
                                
                               
                            </div>
                            
                        </div>
                    </div>
                    <div class="span2" style="width: 170px;">
                        <div class="form-group">
                            <?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['cenawithdiscount'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?>
                            <label for='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
'>Цена со скидкой<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span><?php }?></label>
                            <div class="input-group">
                                <input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"
value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  disabled/>
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            </div>
                        </div>
                    </div>
                                 <?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['amount_cur'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["amoun_cur"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?>  
                                <input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="hidden" name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?>
value="<?php echo $_smarty_tpl->tpl_vars['amoun_cur']->value;?>
"  />
                                 <?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['addcursamount'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?>  
                                <input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="hidden" name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?>
value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  />
                                <?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>
                                    <div class="span2 before-currency-change" style="width: 200px;">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <a href='#' class="btn btn-default" onclick='jQuery(".before-currency-change").hide();jQuery(".cursCon").show(); return false;'>Курс валюты изменен</a>
                                    </div>
                                    </div>
                                <?php }?>

                                        <div class="span1 <?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>hide cursCon<?php }?>" style="width: 110px;" >
                        <div class="form-group form-group-required">
                            <?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['currenc'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValues(), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['cur'] = new Smarty_variable(strtolower(trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))), null, 0);?>
                            <label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
">Валюта<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span><?php }?></label>
<select <?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>disabled<?php }?> class='form-control   <?php if ($_smarty_tpl->tpl_vars['OCCUPY_COMPLETE_WIDTH']->value){?> row-fluid <?php }?>' name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> data-selected-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
'>
		<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()){?><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php }?>
	<?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?>
        <option value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
' <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option>
    <?php } ?>
</select>
                           </div>
                    </div>

                    <div class="span2 <?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>hide cursCon<?php }?>" >
                        <div class="form-group form-group-required">
                            <?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['exchange'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?>
                            <label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"><?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>Начальный курс<?php }else{ ?>Курс<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span><?php }?></label>
                            <div class="input-group">
                                <input <?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>readonly<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?>
value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  />
                             
                            </div>
                            
                        </div>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?> <div class="span2 hide cursCon" >
                        <div class="form-group form-group-required">
                            <?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['exchange'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?>
                            <label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
">Текущий Курс<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span><?php }?></label>
                            <div class="input-group">
                                <input type="text" name='newexchange' class="form-control changeExchance" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  />
                             
                            </div>
                            
                        </div>
                    </div>
                    <div class="span2 hide cursCon" >
                            <div class="form-group form-group-required">
                                <label for="booking_edit_booking_additional_payment_type">Тип доплаты <i class="fa fa-check"></i></label>
                                <select class="form-control changeExchance" name="typeaddpayment" id="booking_edit_booking_additional_payment_type">
                                    <option value="PART" selected="">Остаток</option>
                                    <option value="FULL">Полная стоимость</option>
                                </select>
                                
                            </div>
                        </div>
                    <?php }?>

                                    </div>
               <div class="cms-group-content<?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value!="Пакетный Тур"&&$_smarty_tpl->tpl_vars['opportunity_type']->value!="Индивидуальный Тур"){?> row<?php }?>" id="booking_add_booking_price_total">
                    <blockquote>
                        <div class="row-fluid">
                            <div class="span8">
                                <p><span id="label_total"><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Индивидуальный Тур"){?>
                    Полная стоимость тура<?php }else{ ?>Полная стоимость<?php }?></span>: <span class="total_price">00.00</span> <i class="fa fa-rub"></i>&nbsp;
                                    <span class="curencyAmmount"><?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>
                                     (<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['cur']->value;?>
}"></i> <?php echo number_format($_smarty_tpl->tpl_vars['amount_cur']->value,2,'.',' ');?>
 )   
                                        <?php }?></span>
                                                                    </p>
                                <small class="total_price_phrase"></small>
                            </div>
                                                                    <?php if ($_smarty_tpl->tpl_vars['amoun_cur']->value>0){?>
                                                                    <div class="span4 hide cursCon">
                                    <button class="btn btn-success" type="submit">Все верно, сохранить</button>
                                    <a class="cancelLink" onclick="cancelCurs();">Отменить</a>
                                </div>
                                                                    <?php }?>
                                                    </div>


                        <div class="hide additional-payment">
                            <div class="row add-price-raw">
                                <div class="span12">
                                    <p>Доплата в связи с изменением курса валюты: <span class="add_price"></span> <i class="fa fa-rub"></i></p>
                                    <small class="add_price_phrase"></small>
                                </div>

                            </div>
                            <div class="row new-price-raw">
                                <div class="span10">
                                    <p><span id="label_total_change"><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"||$_smarty_tpl->tpl_vars['opportunity_type']->value=="Индивидуальный Тур"){?>
                    Новая стоимость тура<?php }else{ ?>Новая стоимость<?php }?></span>: <span class="new_price"></span> <i class="fa fa-rub"></i></p>
                                    <small class="new_price_phrase"></small>
                                </div>
                            </div>
                        </div>
                    </blockquote>
                    
                </div>
                    
                    
            </div>
        </div>

<?php }} ?>