<?php /* Smarty version Smarty-3.1.7, created on 2016-07-14 17:55:09
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/dashboards/MiniListWizard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20757055345787a7cd9de4e9-93867335%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2ffd0cf182a7044d74e24099a5783f337a7c6e2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/dashboards/MiniListWizard.tpl',
      1 => 1450875195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20757055345787a7cd9de4e9-93867335',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WIZARD_STEP' => 0,
    'MODULE' => 0,
    'MODULES' => 0,
    'MODULE_NAME' => 0,
    'ALLFILTERS' => 0,
    'FILTERGROUP' => 0,
    'FILTERS' => 0,
    'FILTER' => 0,
    'LIST_VIEW_CONTROLLER' => 0,
    'FIELD_NAME' => 0,
    'FIELD' => 0,
    'SELECTED_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5787a7cda760a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787a7cda760a')) {function content_5787a7cda760a($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['WIZARD_STEP']->value=='step1'){?><div id="minilistWizardContainer" class='modelContainer'><div class="modal-header contentsBackground"><button data-dismiss="modal" class="close" title="<?php echo vtranslate('LBL_CLOSE');?>
">&times;</button><h3 id="massEditHeader"><?php echo vtranslate('LBL_MINI_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3></div><form class="form-horizontal" method="post" action="javascript:;"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="MassSave" /><table class="table table-bordered"><tbody><tr><td class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_SELECT_MODULE');?>
</td><td class="fieldValue"><select class="span4" name="module"><option></option><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_NAME']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php } ?></select></td></tr><tr><td class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_FILTER');?>
</td><td class="fieldValue"><select class="span4" name="filterid"><option></option></select></td></tr><tr><td class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_EDIT_FIELDS');?>
</td><td class="fieldValue"><select class="span4" name="fields" size="2" multiple="true"><option></option></select></td></tr></tbody></table><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div><?php }elseif($_smarty_tpl->tpl_vars['WIZARD_STEP']->value=='step2'){?><option></option><?php  $_smarty_tpl->tpl_vars['FILTERS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILTERS']->_loop = false;
 $_smarty_tpl->tpl_vars['FILTERGROUP'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALLFILTERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILTERS']->key => $_smarty_tpl->tpl_vars['FILTERS']->value){
$_smarty_tpl->tpl_vars['FILTERS']->_loop = true;
 $_smarty_tpl->tpl_vars['FILTERGROUP']->value = $_smarty_tpl->tpl_vars['FILTERS']->key;
?><!-- SalesPlatform.ru begin add locale --><optgroup label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FILTERGROUP']->value);?>
"><?php  $_smarty_tpl->tpl_vars['FILTER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILTER']->_loop = false;
 $_smarty_tpl->tpl_vars['FILTERNAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FILTERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILTER']->key => $_smarty_tpl->tpl_vars['FILTER']->value){
$_smarty_tpl->tpl_vars['FILTER']->_loop = true;
 $_smarty_tpl->tpl_vars['FILTERNAME']->value = $_smarty_tpl->tpl_vars['FILTER']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FILTER']->value->getId();?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FILTER']->value->get('viewname'));?>
</option><?php } ?></optgroup><!--<optgroup label="$FILTERGROUP"><?php  $_smarty_tpl->tpl_vars['FILTER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILTER']->_loop = false;
 $_smarty_tpl->tpl_vars['FILTERNAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FILTERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILTER']->key => $_smarty_tpl->tpl_vars['FILTER']->value){
$_smarty_tpl->tpl_vars['FILTER']->_loop = true;
 $_smarty_tpl->tpl_vars['FILTERNAME']->value = $_smarty_tpl->tpl_vars['FILTER']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FILTER']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['FILTER']->value->get('viewname');?>
</option><?php } ?></optgroup>--><!-- SalesPlatform.ru end --><?php } ?><?php }elseif($_smarty_tpl->tpl_vars['WIZARD_STEP']->value=='step3'){?><option></option><?php  $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LIST_VIEW_CONTROLLER']->value->getListViewHeaderFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->key => $_smarty_tpl->tpl_vars['FIELD']->value){
$_smarty_tpl->tpl_vars['FIELD']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->getFieldLabelKey(),$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
</option><?php } ?><?php }?><?php }} ?>