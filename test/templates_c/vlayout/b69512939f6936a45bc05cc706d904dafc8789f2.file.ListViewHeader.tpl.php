<?php /* Smarty version Smarty-3.1.7, created on 2017-01-05 11:29:05
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/HRUser/ListViewHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:266888798586d1a1686ae94-88149343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b69512939f6936a45bc05cc706d904dafc8789f2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/HRUser/ListViewHeader.tpl',
      1 => 1483604942,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '266888798586d1a1686ae94-88149343',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_586d1a169cfb3',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_586d1a169cfb3')) {function content_586d1a169cfb3($_smarty_tpl) {?>
<div class="listViewPageDiv"><div class="listViewTopMenuDiv noprint"><div class="listViewActionsDiv row-fluid"><span class="btn-toolbar span4"><span class="btn-group listViewMassActions"></span></span><span class="btn-toolbar span4"><span class="customFilterMainSpan btn-group"></span></span><span class="span4 btn-toolbar"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ListViewActions.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</span></div></div><div class="listViewContentDiv" id="listViewContents"><?php }} ?>