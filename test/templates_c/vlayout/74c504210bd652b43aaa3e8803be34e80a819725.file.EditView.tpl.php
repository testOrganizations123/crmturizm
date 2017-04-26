<?php /* Smarty version Smarty-3.1.7, created on 2016-07-09 19:22:43
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/ITS4YouLabels/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1201587598578124d3878316-34679122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74c504210bd652b43aaa3e8803be34e80a819725' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/ITS4YouLabels/EditView.tpl',
      1 => 1468075413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1201587598578124d3878316-34679122',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'BLOCKS' => 0,
    'BLOCK_MODEL' => 0,
    'BLOCK_ID' => 0,
    'IS_BLOCK_SORTABLE' => 0,
    'BLOCK_LABEL_KEY' => 0,
    'LANGUAGE' => 0,
    'STRING' => 0,
    'SELECTED_MODULE_NAME' => 0,
    'TRANSLATEDBLOCKSTRING' => 0,
    'SELECTED_MODULE' => 0,
    'SELECTED_MODULE_MODEL' => 0,
    'FIELDS_LIST' => 0,
    'FIELD_MODEL' => 0,
    'TRANSLATEDSTRING' => 0,
    'FIELDS_LABELS' => 0,
    'FIELDID' => 0,
    'fieldid' => 0,
    'LABEL' => 0,
    'FROMLANG' => 0,
    'SETTINGS_BLOCK' => 0,
    'SETTINGS_FIELDID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_578124d39f482',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_578124d39f482')) {function content_578124d39f482($_smarty_tpl) {?>
<div class="container-fluid"><div class="widget_header row-fluid"><div class="span8"><h2><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h2></div></div><hr><form method="post" action="index.php?module=ITS4YouLabels&parent=Settings&action=Save" id="moduleBlocksAndFields"><div class="widget_header row-fluid"><span class="span8"><strong><span class="lead span9 marginLeftZero"><?php echo vtranslate('LBL_EDIT_LANGUAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></strong></span><span class="span4"><span class="pull-right"><button class="btn btn-success" type="button"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button>&nbsp;<a class="cancelLink" id="backLink" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></span></span></div><br><div id="moduleBlocks"><?php  $_smarty_tpl->tpl_vars['BLOCK_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_MODEL']->key => $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value){
$_smarty_tpl->tpl_vars['BLOCK_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value = $_smarty_tpl->tpl_vars['BLOCK_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['FIELDS_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->getLayoutBlockActiveFields(), null, 0);?><?php $_smarty_tpl->tpl_vars['BLOCK_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('id'), null, 0);?><div id="block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" class="editFieldsTable block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
 marginBottom10px border1px <?php if ($_smarty_tpl->tpl_vars['IS_BLOCK_SORTABLE']->value){?> blockSortable<?php }?>" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-sequence="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('sequence');?>
" style="border-radius: 4px 4px 0px 0px;background: white;"><div class="row-fluid layoutBlockHeader"><div class="blockLabel span5 padding10 marginLeftZero" style="in"><img class="alignMiddle" src="<?php echo vimage_path('drag.png');?>
" />&nbsp;&nbsp;<?php $_smarty_tpl->tpl_vars['STRING'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['TRANSLATEDBLOCKSTRING'] = new Smarty_variable(Vtiger_Language_Handler::getLanguageTranslatedString($_smarty_tpl->tpl_vars['LANGUAGE']->value,$_smarty_tpl->tpl_vars['STRING']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['TRANSLATEDBLOCKSTRING']->value==''){?><?php $_smarty_tpl->tpl_vars['TRANSLATEDBLOCKSTRING'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value), null, 0);?><?php }?><span><strong><?php echo $_smarty_tpl->tpl_vars['TRANSLATEDBLOCKSTRING']->value;?>
</strong></span></div></div><div class="blockFieldsList <?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isFieldsSortableAllowed($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value)){?>blockFieldsSortable <?php }?> row-fluid" style="padding:5px;min-height: 27px"><ul name="sortable1" class="connectedSortable span6" style="list-style-type: none; float: left;min-height: 1px;padding:2px;"><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist']['index']++;
?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fieldlist']['index']%2==0){?><li><div class="opacity editFields marginLeftZero border1px" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
" data-sequence="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('sequence');?>
"><div class="row-fluid padding1per"><div class="span11 marginLeftZero" style="word-wrap: break-word;"><?php $_smarty_tpl->tpl_vars['STRING'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELDID'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id'), null, 0);?><?php $_smarty_tpl->tpl_vars['TRANSLATEDSTRING'] = new Smarty_variable(Vtiger_Language_Handler::getLanguageTranslatedString($_smarty_tpl->tpl_vars['LANGUAGE']->value,$_smarty_tpl->tpl_vars['STRING']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['FROMLANG'] = new Smarty_variable(Vtiger_Language_Handler::getLanguageTranslatedString($_smarty_tpl->tpl_vars['LANGUAGE']->value,$_smarty_tpl->tpl_vars['STRING']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['TRANSLATEDSTRING']->value==''){?><?php $_smarty_tpl->tpl_vars['TRANSLATEDSTRING'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value), null, 0);?><?php }?><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['fieldid'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_LABELS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['fieldid']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELDID']->value==$_smarty_tpl->tpl_vars['fieldid']->value){?><?php $_smarty_tpl->tpl_vars['TRANSLATEDSTRING'] = new Smarty_variable($_smarty_tpl->tpl_vars['LABEL']->value, null, 0);?><?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['FROMLANG']->value==''){?><?php $_smarty_tpl->tpl_vars['FROMLANG'] = new Smarty_variable($_smarty_tpl->tpl_vars['TRANSLATEDSTRING']->value, null, 0);?><?php }?><table><tr><td style="width: 50%;"><span class="muted pull-left" style="margin-left: 2px;"><?php echo $_smarty_tpl->tpl_vars['FROMLANG']->value;?>
</span></td><td style="width:50%;"><span class="pull-right" style="margin-right: 2px;"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
" value="<?php echo $_smarty_tpl->tpl_vars['TRANSLATEDSTRING']->value;?>
"></span></td></tr></table></div></div></div></li><?php }?><?php } ?></ul><ul <?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isFieldsSortableAllowed($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value)){?>name="sortable2"<?php }?> class="connectedSortable span6" style="list-style-type: none; margin: 0; float: left;min-height: 1px;padding:2px;"><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist1']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist1']['index']++;
?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fieldlist1']['index']%2!=0){?><li><div class="opacity editFields marginLeftZero border1px" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
" data-sequence="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('sequence');?>
"><div class="row-fluid padding1per"><div class="span11 marginLeftZero" style="word-wrap: break-word;"><?php $_smarty_tpl->tpl_vars['STRING'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELDID'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id'), null, 0);?><?php $_smarty_tpl->tpl_vars['TRANSLATEDSTRING'] = new Smarty_variable(Vtiger_Language_Handler::getLanguageTranslatedString($_smarty_tpl->tpl_vars['LANGUAGE']->value,$_smarty_tpl->tpl_vars['STRING']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['FROMLANG'] = new Smarty_variable(Vtiger_Language_Handler::getLanguageTranslatedString($_smarty_tpl->tpl_vars['LANGUAGE']->value,$_smarty_tpl->tpl_vars['STRING']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['TRANSLATEDSTRING']->value==''){?><?php $_smarty_tpl->tpl_vars['TRANSLATEDSTRING'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value), null, 0);?><?php }?><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['fieldid'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_LABELS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['fieldid']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELDID']->value==$_smarty_tpl->tpl_vars['fieldid']->value){?><?php $_smarty_tpl->tpl_vars['TRANSLATEDSTRING'] = new Smarty_variable($_smarty_tpl->tpl_vars['LABEL']->value, null, 0);?><?php }?><?php } ?><table><tr><td style="width: 50%;"><span class="muted pull-left" style="margin-left: 2px;"><?php echo $_smarty_tpl->tpl_vars['FROMLANG']->value;?>
</span></td><td style="width:50%;"><span class="pull-right" style="margin-right: 2px;"><input type="text" name="field_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
" value="<?php echo $_smarty_tpl->tpl_vars['TRANSLATEDSTRING']->value;?>
"></span></td></tr></table></div></div></div></li><?php }?><?php } ?></ul></div></div><?php } ?></div><div class="pull-right"><button class="btn btn-success" type="button"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button>&nbsp;<a class="cancelLink" id="backLink" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div><input type="hidden" name="<?php echo vtranslate('LBL_LANG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['LANGUAGE']->value;?>
"><input type="hidden" name="<?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value;?>
"><input type="hidden" name="<?php echo vtranslate('LBL_SETTINGS_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_BLOCK']->value;?>
"><input type="hidden" name="<?php echo vtranslate('LBL_SETTINGS_FIELDID',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_FIELDID']->value;?>
"></form></div><?php }} ?>