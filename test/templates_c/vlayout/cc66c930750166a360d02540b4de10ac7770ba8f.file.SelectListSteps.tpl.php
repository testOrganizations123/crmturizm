<?php /* Smarty version Smarty-3.1.7, created on 2016-08-02 01:57:37
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/SelectListSteps.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45987445757933e23c1f238-69032185%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc66c930750166a360d02540b4de10ac7770ba8f' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/SelectListSteps.tpl',
      1 => 1470092239,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45987445757933e23c1f238-69032185',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57933e23c52cf',
  'variables' => 
  array (
    'FIELDS' => 0,
    'NAME' => 0,
    'VALUE' => 0,
    'FIELD_INFO' => 0,
    'FIELD' => 0,
    'MODULE' => 0,
    'FIELD_NAME' => 0,
    'DISPLAYVALUE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57933e23c52cf')) {function content_57933e23c52cf($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELDS']->value->name, null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCE_LIST"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELDS']->value->value, null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELDS']->value->info)), null, 0);?><input name="popupReferenceModule" type="hidden" value="VDDialogueDesigner" /><input name="<?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
" class="sourceField" data-displayvalue='<?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
' data-fieldinfo="<?php echo $_smarty_tpl->tpl_vars['FIELD_INFO']->value;?>
" /><?php $_smarty_tpl->tpl_vars["displayId"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD']->value['value'], null, 0);?><div class="row-fluid input-prepend input-append"><span class="add-on clearReferenceSelection cursorPointer"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_clear" class='icon-remove-sign' title="<?php echo vtranslate('LBL_CLEAR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></span><?php ob_start();?><?php echo getPurifiedSmartyParameters('view');?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['VIEW_NAME'] = new Smarty_variable($_tmp1, null, 0);?><?php ob_start();?><?php echo getPurifiedSmartyParameters('module');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_tmp2, null, 0);?><input id="<?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
_display" name="<?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
_display" type="text" class="span7 marginLeftZero autoComplete"value="<?php echo $_smarty_tpl->tpl_vars['DISPLAYVALUE']->value;?>
"placeholder="<?php echo vtranslate('LBL_TYPE_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><span class="add-on relatedPopup cursorPointer"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
_select" class="icon-search relatedPopup" title="<?php echo vtranslate('LBL_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" ></i></span><span class="add-on cursorPointer createReferenceRecord"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
_create" class='icon-plus' title="<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></span></div>
<?php }} ?>