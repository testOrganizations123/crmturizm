<?php /* Smarty version Smarty-3.1.7, created on 2016-07-20 15:49:44
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/VDDialogueDesigner/EditScript.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1383435646578f6c09a3d5c6-82102076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30d08e55ea1e44b5b9511bcf3c5211f30247c657' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/VDDialogueDesigner/EditScript.tpl',
      1 => 1469018981,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1383435646578f6c09a3d5c6-82102076',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_578f6c09a50e4',
  'variables' => 
  array (
    'USER_MODEL' => 0,
    'PICKIST_DEPENDENCY_DATASOURCE' => 0,
    'MODULE' => 0,
    'IS_PARENT_EXISTS' => 0,
    'SPLITTED_MODULE' => 0,
    'RECORD_ID' => 0,
    'VALIDATION_DATA_FIELDNAME' => 0,
    'VALIDATION_DATA_FIELDLABEL' => 0,
    'VALIDATION_DATA_FIELDDATATYPE' => 0,
    'ID' => 0,
    'SINGLE_MODULE_NAME' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'FIELDS' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_578f6c09a50e4')) {function content_578f6c09a50e4($_smarty_tpl) {?>

<div class='container-fluid editViewContainer'><form class="form-horizontal recordEditView" id="EditView" name="EditView" method="post" action="index.php" enctype="multipart/form-data"><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME'] = new Smarty_variable($_tmp1, null, 0);?><?php $_smarty_tpl->tpl_vars['IS_PARENT_EXISTS'] = new Smarty_variable(strpos($_smarty_tpl->tpl_vars['MODULE']->value,":"), null, 0);?><?php if ($_smarty_tpl->tpl_vars['IS_PARENT_EXISTS']->value){?><?php $_smarty_tpl->tpl_vars['SPLITTED_MODULE'] = new Smarty_variable(explode(":",$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['SPLITTED_MODULE']->value[1];?>
" /><input type="hidden" name="parent" value="<?php echo $_smarty_tpl->tpl_vars['SPLITTED_MODULE']->value[0];?>
" /><?php }else{ ?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><?php }?><input type="hidden" name="action" value="Save" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="defaultCallDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('callduration');?>
" /><input type="hidden" name="defaultOtherEventDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('othereventduration');?>
" /><input type="hidden" name="mode" value="Script"/><script>var fieldname = new Array(<?php echo $_smarty_tpl->tpl_vars['VALIDATION_DATA_FIELDNAME']->value;?>
);var fieldlabel = new Array(<?php echo $_smarty_tpl->tpl_vars['VALIDATION_DATA_FIELDLABEL']->value;?>
);var fielddatatype = new Array(<?php echo $_smarty_tpl->tpl_vars['VALIDATION_DATA_FIELDDATATYPE']->value;?>
);var crmId;<?php if (isset($_smarty_tpl->tpl_vars['ID']->value)&&!empty($_smarty_tpl->tpl_vars['ID']->value)){?>crmId = <?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
;<?php }?></script><div class="contentHeader row-fluid"><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value!=''){?><h3 class="span8 textOverflowEllipsis" title="<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecordName();?>
"><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecordName();?>
</h3><?php }else{ ?><h3 class="span8 textOverflowEllipsis"><?php echo vtranslate('LBL_CREATING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3><?php }?><span class="pull-right"><span class="pull-right"><button class="btn btn-success" type="submit"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" onclick="javascript:window.history.back();"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></span></div><table class="table table-bordered blockContainer showInlineTable equalSplit"><thead><tr><th class="blockHeader" colspan="4"><?php echo vtranslate('Information',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><tr><td class="fieldLabel "><label class="muted pull-right marginRight10px"><?php echo vtranslate('Name Script',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span></label></td><td class="fieldValue " ><div class="row-fluid"><span class="span10"><input name="subject" required value="<?php echo $_smarty_tpl->tpl_vars['FIELDS']->value['subject'];?>
" /></span></div></td></tr><tr><td class="fieldLabel "><label class="muted pull-right marginRight10px"><?php echo vtranslate('Description',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue " ><div class="row-fluid"><span class="span10"><textarea name="description"><?php echo $_smarty_tpl->tpl_vars['FIELDS']->value['description'];?>
</textarea></span></div></td></tr></tbody></table><br><?php }} ?>