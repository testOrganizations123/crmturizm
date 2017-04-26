<?php /* Smarty version Smarty-3.1.7, created on 2016-08-26 02:07:54
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/MailManager/MainuiQuickLinks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:202775425857bf7a4a611850-83209496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80737ffd90d41fb62d543f825784f6d6da6859be' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/MailManager/MainuiQuickLinks.tpl',
      1 => 1468060620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202775425857bf7a4a611850-83209496',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MAILBOX' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57bf7a4a61db5',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57bf7a4a61db5')) {function content_57bf7a4a61db5($_smarty_tpl) {?>

<br><div class="quickWidget"><div class="accordion-heading accordion-toggle quickWidgetHeader"><table width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td class="span5"><div class="dashboardTitle textOverflowEllipsis" title="<?php echo vtranslate('LBL_Mailbox','MailManager');?>
"><h5 class="title widgetTextOverflowEllipsis"><?php echo vtranslate('LBL_Mailbox','MailManager');?>
</h5></div></td><td class="widgeticons span5" align="right"><div class="box pull-right"><a href='#Reload' id="_mailfolder_mm_reload" onclick="MailManager.reload_now();"><!-- SalesPlatform.ru begin --><i alt="Refresh" title="<?php echo vtranslate('LBL_REFRESH','MailManager');?>
" align="absmiddle" border="0" hspace="2" class="icon-refresh"></i><!-- <i alt="Refresh" title="Refresh" align="absmiddle" border="0" hspace="2" class="icon-refresh"></i> --><!-- SalesPlatform.ru end --></a><a href='#Settings' id="_mailfolder_mm_settings" onclick="MailManager.open_settings_detail();"><!-- SalesPlatform.ru begin --><i alt="Settings" title="<?php echo vtranslate('LBL_SETTINGS','MailManager');?>
" align="absmiddle" border="0" hspace="2" class="icon-cog"></i><!-- <i alt="Settings" title="Settings" align="absmiddle" border="0" hspace="2" class="icon-cog"></i> --><!-- SalesPlatform.ru end --></a></div></td></tr></tbody></table><div class="clearfix"></div></div><div class="defaultContainer <?php if ($_smarty_tpl->tpl_vars['MAILBOX']->value->exists()==false){?>hide<?php }?>"><div class="widgetContainer accordion-body collapse in"><input type=hidden name="mm_selected_folder" id="mm_selected_folder"><input type="hidden" name="_folder" id="mailbox_folder"><div class="row-fluid"><div class="span12"><ul class="nav nav-list"><li><a href="javascript:void(0);" onclick="MailManager.mail_compose();"><?php echo vtranslate('LBL_Compose','MailManager');?>
</a></li><li><a href="#Drafts" id="_mailfolder_mm_drafts" onclick="MailManager.folder_drafts(0);"><?php echo vtranslate('LBL_Drafts','MailManager');?>
</a></li></ul></div></div></div></div></div>
<?php }} ?>