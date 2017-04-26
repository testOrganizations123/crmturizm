<?php /* Smarty version Smarty-3.1.7, created on 2016-08-25 22:47:30
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/TemplateTools.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203429377857bf4b52e56962-34557923%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99240e09198f068c588b9a914e76845b9900c72b' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/TemplateTools.tpl',
      1 => 1471260282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203429377857bf4b52e56962-34557923',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ALLOW_SET_AS' => 0,
    'IS_ACTIVE' => 0,
    'TEMPLATEID' => 0,
    'DEFAULT_BUTTON' => 0,
    'ACTIVATE_BUTTON' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57bf4b52e7695',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57bf4b52e7695')) {function content_57bf4b52e7695($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['ALLOW_SET_AS']->value=='yes'){?>
 
    <div class="recordNamesList">
        <div class="row-fluid">
            <div class="span10">
                <ul class="nav nav-list">
                    <?php if ($_smarty_tpl->tpl_vars['ALLOW_SET_AS']->value=='yes'){?>
                    <?php if ($_smarty_tpl->tpl_vars['IS_ACTIVE']->value!=vtranslate('Inactive','PDFMaker')){?>
                    <li><a href="javascript:void(0);" onClick="PDFMaker_Detail_Js.changeActiveOrDefault('<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
','default');"><?php echo $_smarty_tpl->tpl_vars['DEFAULT_BUTTON']->value;?>
</a></li>
                    <?php }?>
                    <li><a href="javascript:void(0);" onClick="PDFMaker_Detail_Js.changeActiveOrDefault('<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
','active');"><?php echo $_smarty_tpl->tpl_vars['ACTIVATE_BUTTON']->value;?>
</a></li>
                    <?php }?>
            </div>
        </div>
    </div>
<?php }?><?php }} ?>