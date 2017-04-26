<?php /* Smarty version Smarty-3.1.7, created on 2017-04-27 00:29:03
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\Vtiger\Footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2998058ff796a9b5c61-21803124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49c2394caf26c2ff2e7e512b4e0d1b98ef893106' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\Vtiger\\Footer.tpl',
      1 => 1493241817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2998058ff796a9b5c61-21803124',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58ff796a9d9a2',
  'variables' => 
  array (
    'ACTIVITY_REMINDER' => 0,
    'HEADER_LINKS' => 0,
    'MAIN_PRODUCT_SUPPORT' => 0,
    'MAIN_PRODUCT_WHITELABEL' => 0,
    'FIRSTHEADERLINK' => 0,
    'FIRSTHEADERLINKCHILDRENS' => 0,
    'CURRENT_USER_MODEL' => 0,
    'VTIGER_VERSION' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58ff796a9d9a2')) {function content_58ff796a9d9a2($_smarty_tpl) {?>
<input id='activityReminder' class='hide noprint' type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ACTIVITY_REMINDER']->value;?>
"/><?php if ($_smarty_tpl->tpl_vars['HEADER_LINKS']->value&&$_smarty_tpl->tpl_vars['MAIN_PRODUCT_SUPPORT']->value&&!$_smarty_tpl->tpl_vars['MAIN_PRODUCT_WHITELABEL']->value){?><?php $_smarty_tpl->tpl_vars["FIRSTHEADERLINK"] = new Smarty_variable($_smarty_tpl->tpl_vars['HEADER_LINKS']->value[0], null, 0);?><?php $_smarty_tpl->tpl_vars["FIRSTHEADERLINKCHILDRENS"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIRSTHEADERLINK']->value->get('childlinks'), null, 0);?><?php $_smarty_tpl->tpl_vars["FEEDBACKLINKMODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIRSTHEADERLINKCHILDRENS']->value[2], null, 0);?><?php }?><?php if (!$_smarty_tpl->tpl_vars['MAIN_PRODUCT_WHITELABEL']->value&&isset($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value)){?><footer class="noprint"><div class="vtFooter"><p><?php echo vtranslate('VorDOOM.net vTiger CRM');?>
 <?php echo $_smarty_tpl->tpl_vars['VTIGER_VERSION']->value;?>
 &nbsp;&copy; 2004 - <?php echo date('Y');?>
&nbsp&nbsp;<a href="//www.vtiger.com" target="_blank">vtiger.com</a>&nbsp;|&nbsp;&copy; 2014 - <?php echo date('Y');?>
&nbsp&nbsp;<a href="//vordoom.ru/" target="_blank">VorDOOM.net</a></p></div></footer><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('JSResources.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><!----><script type="text/javascript" src="layouts/vlayout/modules/VChat/resources/general.js"></script></body></html>
<?php }} ?>