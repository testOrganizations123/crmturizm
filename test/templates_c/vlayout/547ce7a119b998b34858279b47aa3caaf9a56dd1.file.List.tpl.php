<?php /* Smarty version Smarty-3.1.7, created on 2016-07-09 19:22:36
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/ITS4YouLabels/List.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1632449824578124cc79b895-04450170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '547ce7a119b998b34858279b47aa3caaf9a56dd1' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/ITS4YouLabels/List.tpl',
      1 => 1468075413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1632449824578124cc79b895-04450170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'SETTINGS_BLOCK' => 0,
    'SETTINGS_FIELDID' => 0,
    'LANGUAGES' => 0,
    'KEY' => 0,
    'LANGUAGE' => 0,
    'ALL_MODULES' => 0,
    'MODULE_MODEL' => 0,
    'MODULE_ID' => 0,
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_578124cc809ea',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_578124cc809ea')) {function content_578124cc809ea($_smarty_tpl) {?>
<div class="contentsDiv marginLeftZero" ><div class="padding1per"><div class="editContainer" style="padding-left: 3%;padding-right: 3%"><h2><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h2><hr><div class="padding1per" style="border:1px solid #ccc;"><div class="controls"><div><label><strong><?php echo vtranslate('LBL_WELCOME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></label></div></div><div class="clearfix"></div><br><form name="languageAndModul" id="langAndModulForm" method="POST"  class="form-horizontal"><input type="hidden" name="sourceModule" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="<?php echo vtranslate('LBL_SETTINGS_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_BLOCK']->value;?>
"><input type="hidden" name="<?php echo vtranslate('LBL_SETTINGS_FIELDID',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_FIELDID']->value;?>
"><table style="width:100%;"><tr><td><span class="pull-right"><?php echo vtranslate('LBL_CHOOSE_LANG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:&nbsp;</span></td><td><span class="pull-left"><select name="language" class="chzn-select"><?php  $_smarty_tpl->tpl_vars['LANGUAGE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LANGUAGE']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LANGUAGES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LANGUAGE']->key => $_smarty_tpl->tpl_vars['LANGUAGE']->value){
$_smarty_tpl->tpl_vars['LANGUAGE']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['LANGUAGE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['LANGUAGE']->value;?>
</option><?php } ?></select></span></td><td><span class="pull-right"><?php echo vtranslate('LBL_CHOOSE_MODUL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:&nbsp;</span></td><td><span class="pull-left"><select name="module" class="chzn-select"><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_ID']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php } ?></select></span></td></tr><tr><td colspan="10"><span class="pull-right"><button type="button" class="btn btn-success"><strong><?php echo vtranslate('LBL_SUBMIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></span></td></tr></table></form></div></div></div></div>

<?php }} ?>