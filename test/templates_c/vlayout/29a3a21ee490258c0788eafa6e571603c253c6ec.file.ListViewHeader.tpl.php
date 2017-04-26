<?php /* Smarty version Smarty-3.1.7, created on 2016-07-21 18:07:25
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/ListViewHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19687589875790e52d36ebe9-30209761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29a3a21ee490258c0788eafa6e571603c253c6ec' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/ListViewHeader.tpl',
      1 => 1469030318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19687589875790e52d36ebe9-30209761',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5790e52d39202',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5790e52d39202')) {function content_5790e52d39202($_smarty_tpl) {?>
<div class="listViewPageDiv"><div class="listViewTopMenuDiv"><div class="row-fluid"><div class="span6"><h3><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div></div><hr><div class="row-fluid"><span class="span4 btn-toolbar"><button class="btn addButton" <?php if (stripos($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateViewUrl(),'javascript:')===0){?> onclick="<?php echo substr($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateViewUrl(),strlen('javascript:'));?>
;"<?php }else{ ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateViewUrl();?>
"' <?php }?>><i class="icon-plus"></i>&nbsp;<strong><?php echo vtranslate('LBL_ADD_SCRIPT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></span></div><div class="clearfix"></div></div><div class="listViewContentDiv" id="listViewContents">
<?php }} ?>