<?php /* Smarty version Smarty-3.1.7, created on 2016-09-06 16:14:36
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDPreviewDoc/PreviewPDF.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140128134657cec13c106268-64691028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2455dcacd19537741d75f5d604f87a4b0f95ad2a' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDPreviewDoc/PreviewPDF.tpl',
      1 => 1473167664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140128134657cec13c106268-64691028',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'DOWNLOAD' => 0,
    'DOCUMENT' => 0,
    'SRC' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57cec13c11ec8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57cec13c11ec8')) {function content_57cec13c11ec8($_smarty_tpl) {?>
<div class="filePreview"><div class="modal-header backgroundColor"><button data-dismiss="modal" class="close pull-right" title="close">x</button><a class="btn btn-default btn-small pull-right" href="<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD']->value;?>
">Download File</a><h3><b><?php echo $_smarty_tpl->tpl_vars['DOCUMENT']->value['file_info']['name'];?>
</b></h3></div><div class="modal-body" style="height:550px;"><iframe id="viewer" src="<?php echo $_smarty_tpl->tpl_vars['SRC']->value;?>
" frameborder="0" height="100%" width="100%"></iframe></div></div><?php }} ?>