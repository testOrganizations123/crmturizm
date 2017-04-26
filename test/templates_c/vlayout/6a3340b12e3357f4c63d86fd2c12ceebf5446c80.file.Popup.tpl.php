<?php /* Smarty version Smarty-3.1.7, created on 2016-08-09 17:11:20
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/Popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89842823457810e3f9d1370-17546662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a3340b12e3357f4c63d86fd2c12ceebf5446c80' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/Popup.tpl',
      1 => 1470751870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89842823457810e3f9d1370-17546662',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57810e3fa0b06',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57810e3fa0b06')) {function content_57810e3fa0b06($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Contacts'){?><a id="menubar_quickCreate_Contacts" class="quickCreateModule" data-name="Contacts" data-url="index.php?module=Contacts&amp;view=QuickCreateAjax" href="javascript:void(0)">Клиент</a><?php }?><div id="popupPageContainer" class="contentsDiv"><div class="paddingLeftRight10px"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('PopupSearch.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><div id="popupContents" class="paddingLeftRight10px"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('PopupContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><input type="hidden" class="triggerEventName" value="<?php echo getPurifiedSmartyParameters('triggerEventName');?>
"/></div></div><?php }} ?>