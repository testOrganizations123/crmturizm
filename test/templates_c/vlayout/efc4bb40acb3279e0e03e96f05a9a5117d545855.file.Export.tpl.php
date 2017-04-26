<?php /* Smarty version Smarty-3.1.7, created on 2016-08-08 11:59:34
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/Export.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53440600557a849f6877a33-55442341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efc4bb40acb3279e0e03e96f05a9a5117d545855' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/Export.tpl',
      1 => 1450875180,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53440600557a849f6877a33-55442341',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LEFTPANELHIDE' => 0,
    'MODULE' => 0,
    'SOURCE_MODULE' => 0,
    'VIEWID' => 0,
    'SELECTED_IDS' => 0,
    'EXCLUDED_IDS' => 0,
    'PAGE' => 0,
    'SEARCH_KEY' => 0,
    'OPERATOR' => 0,
    'ALPHABET_VALUE' => 0,
    'SEARCH_PARAMS' => 0,
    'SUPPORTED_FILE_ENCODING' => 0,
    'FILE_ENCODING' => 0,
    'FILE_ENCODING_LABEL' => 0,
    'SUPPORTED_DELIMITERS' => 0,
    'DELIMITER' => 0,
    'DELIMITER_LABEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57a849f68eac1',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a849f68eac1')) {function content_57a849f68eac1($_smarty_tpl) {?>
<div id="toggleButton" class="toggleButton" title="<?php echo vtranslate('LBL_LEFT_PANEL_SHOW_HIDE','Vtiger');?>
"><i id="tButtonImage" class="<?php if ($_smarty_tpl->tpl_vars['LEFTPANELHIDE']->value!='1'){?>icon-chevron-right <?php }else{ ?> icon-chevron-left<?php }?>"></i></div>&nbsp<div style="padding-left: 15px;"><form id="exportForm" class="form-horizontal row-fluid" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type="hidden" name="action" value="ExportData" /><input type="hidden" name="viewname" value="<?php echo $_smarty_tpl->tpl_vars['VIEWID']->value;?>
" /><input type="hidden" name="selected_ids" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_IDS']->value);?>
><input type="hidden" name="excluded_ids" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['EXCLUDED_IDS']->value);?>
><input type="hidden" id="page" name="page" value="<?php echo $_smarty_tpl->tpl_vars['PAGE']->value;?>
" /><input type="hidden" name="search_key" value= "<?php echo $_smarty_tpl->tpl_vars['SEARCH_KEY']->value;?>
" /><input type="hidden" name="operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" /><input type="hidden" name="search_value" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" /><input type="hidden" name="search_params" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_PARAMS']->value);?>
' /><div class="row-fluid"><div class="span">&nbsp;</div><div class="span8"><h4><?php echo vtranslate('LBL_EXPORT_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4><div class="well exportContents marginLeftZero"><div class="row-fluid"><div class="row-fluid" style="height:30px"><div class="span6 textAlignRight row-fluid"><div class="span8"><?php echo vtranslate('LBL_EXPORT_SELECTED_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</div><div class="span3"><input type="radio" name="mode" value="ExportSelectedRecords" <?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_IDS']->value)){?> checked="checked" <?php }else{ ?> disabled="disabled"<?php }?>/></div></div><?php if (empty($_smarty_tpl->tpl_vars['SELECTED_IDS']->value)){?>&nbsp; <span class="redColor"><?php echo vtranslate('LBL_NO_RECORD_SELECTED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php }?></div><div class="row-fluid" style="height:30px"><div class="span6 textAlignRight row-fluid"><div class="span8"><?php echo vtranslate('LBL_EXPORT_DATA_IN_CURRENT_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</div><div class="span3"><input type="radio" name="mode" value="ExportCurrentPage" /></div></div></div><div class="row-fluid" style="height:30px"><div class="span6 textAlignRight row-fluid"><div class="span8"><?php echo vtranslate('LBL_EXPORT_ALL_DATA',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</div><div class="span3"><input type="radio"  name="mode" value="ExportAllData"  <?php if (empty($_smarty_tpl->tpl_vars['SELECTED_IDS']->value)){?> checked="checked" <?php }?> /></div></div></div><div class="row-fluid" style="height:30px"><div class="span6 textAlignRight row-fluid"><div class="span8"><?php echo vtranslate('LBL_CHARACTER_ENCODING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</div><div class="span3"><select name="file_encoding" id="file_encoding"><?php  $_smarty_tpl->tpl_vars['FILE_ENCODING_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILE_ENCODING_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FILE_ENCODING'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUPPORTED_FILE_ENCODING']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILE_ENCODING_LABEL']->key => $_smarty_tpl->tpl_vars['FILE_ENCODING_LABEL']->value){
$_smarty_tpl->tpl_vars['FILE_ENCODING_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FILE_ENCODING']->value = $_smarty_tpl->tpl_vars['FILE_ENCODING_LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FILE_ENCODING']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FILE_ENCODING_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select></div></div></div><div class="row-fluid" style="height:30px" id="delimiter_container"><div class="span6 textAlignRight row-fluid"><div class="span8"><?php echo vtranslate('LBL_DELIMITER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</div><div class="span3"><select name="delimiter" id="delimiter"><?php  $_smarty_tpl->tpl_vars['DELIMITER_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DELIMITER_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['DELIMITER'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUPPORTED_DELIMITERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DELIMITER_LABEL']->key => $_smarty_tpl->tpl_vars['DELIMITER_LABEL']->value){
$_smarty_tpl->tpl_vars['DELIMITER_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['DELIMITER']->value = $_smarty_tpl->tpl_vars['DELIMITER_LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['DELIMITER']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['DELIMITER_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select></div></div></div></div><br><div class="textAlignCenter"><button class="btn btn-success" type="submit"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" onclick='window.history.back()'><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></form></div>
<?php }} ?>