<?php /* Smarty version Smarty-3.1.7, created on 2017-05-01 10:50:59
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\Potentials\uitypes\Picklist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146435906e8e32805b8-27225535%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a7fa46bc4e413dcc44371053553bb05a650c6cc' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\Potentials\\uitypes\\Picklist.tpl',
      1 => 1493241805,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146435906e8e32805b8-27225535',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'FIELD_NAME' => 0,
    'CHOSEN' => 0,
    'OCCUPY_COMPLETE_WIDTH' => 0,
    'CLASS' => 0,
    'FIELD_INFO' => 0,
    'SPECIAL_VALIDATOR' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_VALUE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5906e8e340426',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906e8e340426')) {function content_5906e8e340426($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValues(), null, 0);?><?php $_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='opportunity_type'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?><input type="hidden" name="opportunity_type" value="<?php echo trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
" /><?php echo trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName()=='placement'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName()=='food'){?><?php $_smarty_tpl->tpl_vars['CHOSEN'] = new Smarty_variable('chzn-select', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['CHOSEN'] = new Smarty_variable('', null, 0);?><?php }?><select class='<?php echo $_smarty_tpl->tpl_vars['CHOSEN']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['OCCUPY_COMPLETE_WIDTH']->value){?> row-fluid <?php }?><?php if ($_smarty_tpl->tpl_vars['CLASS']->value){?> <?php echo $_smarty_tpl->tpl_vars['CLASS']->value;?>
 <?php }?>' <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName()=='spcompany'){?><?php }?> name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' data-validation-engine='validate[<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required,<?php }?>funcCall[Vtiger_Base_Validator_Js.invokeValidation]]' data-fieldinfo='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
' <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?> data-selected-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
'><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()){?><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php }?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
' <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select><?php }?><?php }} ?>