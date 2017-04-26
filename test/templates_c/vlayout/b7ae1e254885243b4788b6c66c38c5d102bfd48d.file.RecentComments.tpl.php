<?php /* Smarty version Smarty-3.1.7, created on 2016-11-09 13:17:56
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Leads/RecentComments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78783952857fbd0a60cc0b8-17031092%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7ae1e254885243b4788b6c66c38c5d102bfd48d' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Leads/RecentComments.tpl',
      1 => 1478686674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78783952857fbd0a60cc0b8-17031092',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57fbd0a61a408',
  'variables' => 
  array (
    'COMMENTS' => 0,
    'COMMENT' => 0,
    'FIELD_MODEL' => 0,
    'MODULE_NAME' => 0,
    'PAGING_MODEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57fbd0a61a408')) {function content_57fbd0a61a408($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["COMMENT_TEXTAREA_DEFAULT_ROWS"] = new Smarty_variable("2", null, 0);?><div class="commentContainer recentComments"><hr><br><div class="commentsBody"><?php if (!empty($_smarty_tpl->tpl_vars['COMMENTS']->value)){?><?php  $_smarty_tpl->tpl_vars['COMMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['COMMENT']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['COMMENTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['COMMENT']->key => $_smarty_tpl->tpl_vars['COMMENT']->value){
$_smarty_tpl->tpl_vars['COMMENT']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['COMMENT']->key;
?><div class="commentDetails"><div class="commentDiv"><div class="singleComment"><div class="commentInfoHeader row-fluid" data-commentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->getId();?>
" data-parentcommentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('parent_comments');?>
"><div class="commentTitle"><div class="row-fluid"><div class="span1"><img class="alignMiddle pull-left" src="<?php echo vimage_path('DefaultUserIcon.png');?>
"></div><div class="span11 commentorInfo"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getModule()->getField('assigned_user_id'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['COMMENT']->value->get('smcreatorid')), null, 0);?><div class="inner"><span class="commentorName"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['COMMENT']->value->get('smcreatorid'),$_smarty_tpl->tpl_vars['COMMENT']->value->getId(),$_smarty_tpl->tpl_vars['COMMENT']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></span><span class="pull-right"><p class="muted"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['COMMENT']->value->get('createdtime'));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['COMMENT']->value->get('createdtime'));?>
</small></p></span><div class="clearfix"></div></div><div class="commentInfoContent"><b>Задача:</b> <?php echo nl2br($_smarty_tpl->tpl_vars['COMMENT']->value->get('description'));?>
<br /><p>  <b>Выполнено:</b> <?php if ($_smarty_tpl->tpl_vars['COMMENT']->value->get('cf_1085')!=''){?><?php echo nl2br($_smarty_tpl->tpl_vars['COMMENT']->value->get('cf_1085'));?>
<?php }else{ ?><i><?php echo vtranslate($_smarty_tpl->tpl_vars['COMMENT']->value->get('eventstatus'),'Calendar');?>
</i><?php }?><?php if ((strtotime($_smarty_tpl->tpl_vars['COMMENT']->value->get('modifiedtime'))-strtotime($_smarty_tpl->tpl_vars['COMMENT']->value->get('createdtime')))>180){?><span class="pull-right muted"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['COMMENT']->value->get('modifiedtime'));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['COMMENT']->value->get('modifiedtime'));?>
</small></span></p><?php }?></div></div></div></div></div></div></div></div><?php } ?><?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("NoComments.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></div><?php if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()){?><div class="row-fluid"><div class="pull-right"><a href="javascript:void(0)" class="moreRecentComments"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
..</a></div></div><?php }?></div><?php }} ?>