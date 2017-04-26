<?php /* Smarty version Smarty-3.1.7, created on 2016-07-16 18:02:13
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/VDDialogueDesigner/ListViewHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1219190572578a4b0761cc60-71760058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4aa7265b39251ef5674ee3961a2aa125ed6c260' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/VDDialogueDesigner/ListViewHeader.tpl',
      1 => 1468681221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1219190572578a4b0761cc60-71760058',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_578a4b0768c59',
  'variables' => 
  array (
    'MODULE' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE_MODEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_578a4b0768c59')) {function content_578a4b0768c59($_smarty_tpl) {?>
<div class="listViewPageDiv"><div class="listViewTopMenuDiv"><div class="row-fluid"><div class="span6"><h3><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div></div><hr><div class="row-fluid"><span class="span4 btn-toolbar"><button class="btn addButton" <?php if (stripos($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateViewUrl(),'javascript:')===0){?> onclick="<?php echo substr($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateViewUrl(),strlen('javascript:'));?>
;"<?php }else{ ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateViewUrl();?>
"' <?php }?>><i class="icon-plus"></i>&nbsp;<strong><?php echo vtranslate('LBL_ADD_SCRIPT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></span></div><div class="clearfix"></div></div><div class="listViewContentDiv" id="listViewContents">
<?php }} ?>