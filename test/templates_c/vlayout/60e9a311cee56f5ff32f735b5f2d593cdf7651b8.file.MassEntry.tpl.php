<?php /* Smarty version Smarty-3.1.7, created on 2016-09-10 12:11:26
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Fosa/MassEntry.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66520950457d3ce3e840089-81084470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60e9a311cee56f5ff32f735b5f2d593cdf7651b8' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Fosa/MassEntry.tpl',
      1 => 1473498632,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66520950457d3ce3e840089-81084470',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BLOCK_LABEL' => 0,
    'MODULE' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_VALUE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57d3ce3e891e6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57d3ce3e891e6')) {function content_57d3ce3e891e6($_smarty_tpl) {?>

<table class="table table-bordered blockContainer showInlineTable equalSplit"><thead><tr><th class="blockHeader" colspan="4"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['seria'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><tr><td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Серия бланков</td><td><div class="row-fluid"><span class="span10"><input style="height: 26px;" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  /></span></div></td><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['office'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Выдано офису</td><td><div class="row-fluid"><span class="span10"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/office.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</span></div></td></tr><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['number'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo())), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><tr><td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Начальный номер</td><td><div class="row-fluid"><span class="span10"><input style="height: 26px;" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  /></span></div></td><td><label class="muted pull-right marginRight10px"><span class="redColor">*</span>Конечный номер</td><td><div class="row-fluid"><span class="span10"><input style="height: 26px;" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_number_off" type="text" class="form-control" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> required<?php }?> name="number_off"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
"  /></span></div></td></tr></tbody></table><?php }} ?>