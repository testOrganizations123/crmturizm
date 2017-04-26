<?php /* Smarty version Smarty-3.1.7, created on 2017-03-11 13:43:04
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/MailConverter/Rule.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58768153858c3d4b82f1257-64331447%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75a453b4a0bbd349bb5bc58797f864adc339e0ca' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/MailConverter/Rule.tpl',
      1 => 1450875180,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58768153858c3d4b82f1257-64331447',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'RULE_COUNT' => 0,
    'RULE_MODEL' => 0,
    'ACTION_LINK' => 0,
    'MODULE' => 0,
    'ASSIGNED_TO_RULES_ARRAY' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58c3d4b83852a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c3d4b83852a')) {function content_58c3d4b83852a($_smarty_tpl) {?>
<div class="mailConverterRuleBlock"><div class="blockHeader ruleHead" style="cursor: move;"><div colspan="4"><img class="alignMiddle" src="<?php echo vimage_path('drag.png');?>
" style="margin-left: 10px;" />&nbsp;&nbsp;<?php echo vtranslate('LBL_RULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="sequenceNumber"><?php echo $_smarty_tpl->tpl_vars['RULE_COUNT']->value;?>
</span>&nbsp;:&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('action'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<div class="pull-right"><?php  $_smarty_tpl->tpl_vars['ACTION_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ACTION_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RULE_MODEL']->value->getRecordLinks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_LINK']->key => $_smarty_tpl->tpl_vars['ACTION_LINK']->value){
$_smarty_tpl->tpl_vars['ACTION_LINK']->_loop = true;
?><a <?php if (stripos($_smarty_tpl->tpl_vars['ACTION_LINK']->value->getUrl(),'javascript:')===0){?> onclick='<?php echo substr($_smarty_tpl->tpl_vars['ACTION_LINK']->value->getUrl(),strlen("javascript:"));?>
'<?php }else{ ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['ACTION_LINK']->value->getUrl();?>
"' <?php }?>><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['ACTION_LINK']->value->get('linklabel'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="<?php echo $_smarty_tpl->tpl_vars['ACTION_LINK']->value->get('linkicon');?>
 alignMiddle cursorPointer"></i></a>&nbsp;&nbsp;<?php } ?></div></div></div><div><fieldset><legend class="mailConverterRuleLegend"><div style="margin-left: 20px;"><?php echo vtranslate('LBL_CONDITIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></legend><div class="span12 row-fluid"><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_FROM',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span3" style="margin-left: 17px;">&nbsp;<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('fromaddress');?>
</div><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span5" style="margin-left: 17px;">&nbsp;<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('toaddress');?>
</div></div><div class="span12 row-fluid"><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_CC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span3" style="margin-left: 17px;">&nbsp;<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('cc');?>
</div><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_BCC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span5" style="margin-left: 17px;">&nbsp;<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('bcc');?>
</div></div><div class="span12 row-fluid"><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_SUBJECT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span10"><p class="pull-left"><small><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('subjectop'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></small></p>&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('subject');?>
</div></div><div class="span12 row-fluid"><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_BODY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span10"><p class="pull-left"><small><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('bodyop'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></small></p>&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('body');?>
</div></div><div class="span12 row-fluid"><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_MATCH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span10"><small><?php if ($_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('matchusing')=='AND'){?><?php echo vtranslate('LBL_ALL_CONDITIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_ANY_CONDITIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></small></div></div><?php $_smarty_tpl->tpl_vars['ASSIGNED_TO_RULES_ARRAY'] = new Smarty_variable(array('CREATE_HelpDesk_FROM','CREATE_Leads_SUBJECT','CREATE_Contacts_SUBJECT','CREATE_Accounts_SUBJECT'), null, 0);?><?php if (in_array($_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('action'),$_smarty_tpl->tpl_vars['ASSIGNED_TO_RULES_ARRAY']->value)){?><div class="span12 row-fluid"><div class="span2 rightAligned"><strong><?php echo vtranslate('Assigned To');?>
</strong></div><div class="span10"><small><?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('assigned_to');?>
</small></div></div><?php }?></fieldset><fieldset style="margin-top: 10px;"><legend class="mailConverterRuleLegend"><div style="margin-left: 20px;"><?php echo vtranslate('action',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></legend><div class="span12 row-fluid"><div class="span2 rightAligned"><strong><?php echo vtranslate('LBL_ACTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div><div class="span10"><small><?php echo vtranslate($_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('action'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</small></div></div></fieldset></div></div><div class="clearfix"></div>							
<?php }} ?>