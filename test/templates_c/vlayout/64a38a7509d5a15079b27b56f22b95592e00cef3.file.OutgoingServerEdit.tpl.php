<?php /* Smarty version Smarty-3.1.7, created on 2016-07-09 18:55:58
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/Vtiger/OutgoingServerEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17021906157811e8e5487a7-52143947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64a38a7509d5a15079b27b56f22b95592e00cef3' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/Vtiger/OutgoingServerEdit.tpl',
      1 => 1449237010,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17021906157811e8e5487a7-52143947',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CURRENT_USER_MODEL' => 0,
    'MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'WIDTHTYPE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57811e8e65af8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57811e8e65af8')) {function content_57811e8e65af8($_smarty_tpl) {?>
<div class="container-fluid"><div class="contents row-fluid"><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><form id="OutgoingServerForm" class="form-horizontal" data-detail-url="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getDetailViewUrl();?>
" method="POST"><div class="widget_header row-fluid"><div class="span8"><h3><?php echo vtranslate('LBL_OUTGOING_SERVER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3>&nbsp;<?php echo vtranslate('LBL_OUTGOING_SERVER_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="span4 btn-toolbar"><div class="pull-right"><button class="btn btn-success saveButton" type="submit" title="<?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><a type="reset" class="cancelLink" title="<?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></div><hr><input type="hidden" name="default" value="false" /><input type="hidden" name="server_port" value="0" /><input type="hidden" name="server_type" value="email" /><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('id');?>
" /><div class="row-fluid hide errorMessage"><div class="alert alert-error"><?php echo vtranslate('LBL_TESTMAILSTATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<strong><?php echo vtranslate('LBL_MAILSENDERROR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div></div><table class="table table-bordered table-condensed themeTableColor"><thead><tr class="blockHeader"><th colspan="2" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php echo vtranslate('LBL_MAIL_SERVER_SMTP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><tr><td width="25%" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_SENDMAIL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="checkbox" name="use_sendmail" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->isUseSendMailEnabled()!='false'){?>checked<?php }?>/></td></tr><tr><td width="25%" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_USE_MAIL_ACCOUNT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="checkbox" name="use_mail_account" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->isUseMailAccountEnabled()!='false'){?>checked<?php }?>/></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><span class="redColor">*</span><?php echo vtranslate('LBL_SERVER_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="text" name="server" data-validation-engine='validate[required]' value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server');?>
" /></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_SERVER_PORT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="text" name="server_port" data-validation-engine='validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]' value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server_port');?>
"</td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_USER_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="text" name="server_username" data-validation-engine='validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]' value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server_username');?>
"</td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="password" name="server_password" data-validation-engine='validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]' value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server_password');?>
"</td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_FROM_EMAIL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="text" name="from_email_field" data-validation-engine="validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" data-validator='<?php echo Zend_Json::encode(array(array('name'=>'Email')));?>
' value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('from_email_field');?>
"</td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_FROM_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="text" name="from_name" data-validation-engine='validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]' value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('from_name');?>
"</td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_REQUIRES_AUTHENTICATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="checkbox" name="smtp_auth" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->isSmtpAuthEnabled()!='false'){?>checked<?php }?>/></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_CONNECTION_SECURITY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><input type="radio" name="server_tls" value="no" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->get('server_tls')=='no'){?>checked=true<?php }elseif($_smarty_tpl->tpl_vars['MODEL']->value->get('server_tls')!='tls'&&$_smarty_tpl->tpl_vars['MODEL']->value->get('server_tls')!='ssl'){?>checked=true<?php }?>>&nbsp; <?php echo vtranslate('LBL_NO_TLS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<input type="radio" name="server_tls" value="tls" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->get('server_tls')=='tls'){?>checked=true<?php }?>>&nbsp; <?php echo vtranslate('LBL_TLS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<input type="radio" name="server_tls" value="ssl" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->get('server_tls')=='ssl'){?>checked=true<?php }?>>&nbsp; <?php echo vtranslate('LBL_SSL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </td></tr></tbody></table><br><div class="alert alert-info"><?php echo vtranslate('LBL_OUTGOING_SERVER_NOTE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="alert alert-info"><?php echo vtranslate('LBL_OUTGOING_SERVER_NOTE_2',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></form></div></div><?php }} ?>