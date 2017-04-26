<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 13:02:23
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/Uninstall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64073484257b1932f7c2350-92092767%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66e9efd2b04be42b076a8302d4292707bcf0a380' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/Uninstall.tpl',
      1 => 1471207122,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64073484257b1932f7c2350-92092767',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LICENSE' => 0,
    'MODE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57b1932f7e362',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b1932f7e362')) {function content_57b1932f7e362($_smarty_tpl) {?>
<div class="container-fluid" id="UninstallPDFMakerContainer"><form name="profiles_privilegies" action="index.php" method="post" class="form-horizontal"><br><label class="pull-left themeTextColor font-x-x-large"><?php echo vtranslate('LBL_UNINSTALL','PDFMaker');?>
</label><br clear="all"><hr><input type="hidden" name="module" value="PDFMaker" /><input type="hidden" name="view" value="" /><input type="hidden" name="license_key_val" id="license_key_val" value="<?php echo $_smarty_tpl->tpl_vars['LICENSE']->value;?>
" /><br /><div class="row-fluid"><label class="fieldLabel"><strong><?php echo vtranslate('LBL_UNINSTALL_DESC','PDFMaker');?>
:</strong></label><br><table class="table table-bordered table-condensed themeTableColor"><thead><tr class="blockHeader"><th class="mediumWidthType"><span class="alignMiddle"><?php echo vtranslate('LBL_UNINSTALL','PDFMaker');?>
</span></th></tr></thead><tbody><tr><td class="textAlignCenter"><button id="uninstall_pdfmaker_btn" type="button" class="btn btn-danger marginLeftZero"><?php echo vtranslate('LBL_UNINSTALL','PDFMaker');?>
</button></td></tr></tbody></table></div><?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?><div class="pull-right"><button class="btn btn-success" type="submit"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><a class="cancelLink" onclick="javascript:window.history.back();" type="reset">Cancel</a></div><?php }?></form></div><?php }} ?>