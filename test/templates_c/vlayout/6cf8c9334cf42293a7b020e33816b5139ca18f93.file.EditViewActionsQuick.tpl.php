<?php /* Smarty version Smarty-3.1.7, created on 2016-08-21 21:16:46
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Contacts/EditViewActionsQuick.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64737462557b9f00e6858b7-87122468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cf8c9334cf42293a7b020e33816b5139ca18f93' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Contacts/EditViewActionsQuick.tpl',
      1 => 1471802398,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64737462557b9f00e6858b7-87122468',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FL_IMPORT_BUTTON' => 0,
    'MODULE' => 0,
    'RECORD_ID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57b9f00e69766',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b9f00e69766')) {function content_57b9f00e69766($_smarty_tpl) {?>

<div class="row-fluid"><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['FL_IMPORT_BUTTON']->value&&($_smarty_tpl->tpl_vars['MODULE']->value=='Leads'||$_smarty_tpl->tpl_vars['MODULE']->value=='Accounts'||$_smarty_tpl->tpl_vars['MODULE']->value=='Contacts')){?><button class="btn btn-info" type="button" onclick="SPSocialConnector_Edit_Js.triggerEnterURL('index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&record_id=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
&view=MassActionAjax&mode=showEnterURLForm');"><strong><?php echo vtranslate('LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<?php }?><button class="btn btn-success" type="submit"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" onclick="javascript:window.history.back();"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><div class="clearfix"></div></div><br></form></div><?php }} ?>