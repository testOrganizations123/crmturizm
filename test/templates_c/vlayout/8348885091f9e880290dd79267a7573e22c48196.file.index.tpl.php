<?php /* Smarty version Smarty-3.1.7, created on 2016-08-26 02:07:54
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/MailManager/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66286922957bf7a4a5fe382-66322288%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8348885091f9e880290dd79267a7573e22c48196' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/MailManager/index.tpl',
      1 => 1468060620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66286922957bf7a4a5fe382-66322288',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MAILBOX' => 0,
    'MODULE' => 0,
    'ERROR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57bf7a4a60f97',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57bf7a4a60f97')) {function content_57bf7a4a60f97($_smarty_tpl) {?>

<div class="span2 row-fluid"><div id="_quicklinks_mainuidiv_" class="quickWidgetContainer accordion"><?php echo $_smarty_tpl->getSubTemplate ("modules/MailManager/MainuiQuickLinks.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div class="clearfix">&nbsp;<input type="hidden" id="isMailBoxExists" value="<?php if ($_smarty_tpl->tpl_vars['MAILBOX']->value->exists()){?>1<?php }else{ ?>0<?php }?>"/></div><div class="quickWidget"><div class="accordion-heading accordion-toggle quickWidgetHeader" onclick="MailManager.getFoldersList();"><span class="pull-left"><img class="imageElement" data-rightimage="<?php echo vimage_path('rightArrowWhite.png');?>
" data-downimage="<?php echo vimage_path('downArrowWhite.png');?>
" src="<?php echo vimage_path('rightArrowWhite.png');?>
" /></span>&nbsp;<h5 class="title widgetTextOverflowEllipsis pull-right"><?php echo vtranslate('LBL_Folders',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5></div><div class="widgetContainer accordion-body collapse in" id="folders"><input type=hidden name="mm_selected_folder" id="mm_selected_folder"><input type="hidden" name="_folder" id="mailbox_folder"></div></div><div id="_mainfolderdiv_" class="quickWidgetContainer accordion"></div></div></div><div class="contentsDiv span10 marginLeftZero"><div id='_progress_' style='float: right; display: none; position: absolute; right: 35px; font-weight: bold;'><span id='_progressmsg_'>...</span><img src="<?php echo vimage_path('vtbusy.gif');?>
" border='0' align='absmiddle'></div><span id="_messagediv_"><?php if ($_smarty_tpl->tpl_vars['ERROR']->value){?><p><?php echo $_smarty_tpl->tpl_vars['ERROR']->value;?>
</p><?php }?></span><div id="_contentdiv_"></div><div id="_contentdiv2_" class="container-fluid"></div><div id="_settingsdiv_"></div><div id="_relationpopupdiv_" style="display:none;position:absolute;width:800px;z-index:80000;"></div><div id="_replydiv_" style="display:none;"></div><div id="replycontentdiv" style="display:none;"></div></div><div id = '__vtiger__'></div><script type='text/javascript'>
		jQuery(function(){MailManager.mainui()});
	</script><input type="hidden" name="module" value="MailManager"><?php }} ?>