<?php /* Smarty version Smarty-3.1.7, created on 2016-07-21 15:04:05
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/EditScript.tpl" */ ?>
<?php /*%%SmartyHeaderCode:311961892578f9fc18e6e73-31847224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de1cbafec31989f28e1e18f4b8743e5ee7cf7a56' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/EditScript.tpl',
      1 => 1469102642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '311961892578f9fc18e6e73-31847224',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_578f9fc19458f',
  'variables' => 
  array (
    'USER_MODEL' => 0,
    'MODULE' => 0,
    'RECORD_ID' => 0,
    'SINGLE_MODULE_NAME' => 0,
    'RECORD_MODEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_578f9fc19458f')) {function content_578f9fc19458f($_smarty_tpl) {?>

<div class='container-fluid editViewContainer'><form class="form-horizontal recordEditView" id="EditView" name="EditView" method="post" action="index.php" enctype="multipart/form-data"><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'), null, 0);?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME'] = new Smarty_variable($_tmp1, null, 0);?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="Save" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="defaultCallDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('callduration');?>
" /><input type="hidden" name="defaultOtherEventDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('othereventduration');?>
" /><input type="hidden" name="mode" value="Script"/><script>var fieldname = new Array();var fieldlabel = new Array();var fielddatatype = new Array();var crmId;</script><div class="contentHeader row-fluid"><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value!=''){?><h3 class="span8 textOverflowEllipsis" title="<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" ><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('subject');?>
</h3><?php }else{ ?><h3 class="span8 textOverflowEllipsis"><?php echo vtranslate('LBL_CREATING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3><?php }?><span class="pull-right"><span class="pull-right"><button class="btn btn-success" type="submit"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" onclick="javascript:window.history.back();"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></span></div><table class="table table-bordered blockContainer showInlineTable equalSplit"><thead><tr><th class="blockHeader" colspan="4"><?php echo vtranslate('Information',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><tr><td class="fieldLabel "><label class="muted pull-right marginRight10px"><?php echo vtranslate('Name Script',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label></td><td class="fieldValue " ><div class="row-fluid"><span class="span10"><input name="subject" required value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('subject');?>
" /></span></div></td><td class="fieldLabel "><label class="muted pull-right marginRight10px"><?php echo vtranslate('Menu Active',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </label></td><td class="fieldValue " ><div class="row-fluid"><span class="span10"><input type="checkbox" name="menu_active" value="1" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('menu_active')==1){?> checked <?php }?>/></span></div></td></tr><tr><td class="fieldLabel " colspan="1"><label class="muted pull-right marginRight10px"><?php echo vtranslate('Description',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue " colspan="3"><div class="row-fluid"><span class="span10"><textarea name="description"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('description');?>
</textarea></span></div></td></tr></tbody></table><br><?php }} ?>