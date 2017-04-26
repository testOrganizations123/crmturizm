<?php /* Smarty version Smarty-3.1.7, created on 2016-09-08 22:16:20
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ListViewSelect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189846287157d1b9045e5ed2-98121804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '800d13df84264d8e5ae6539a84f041f3b133ca74' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ListViewSelect.tpl',
      1 => 1471260282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189846287157d1b9045e5ed2-98121804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'relmodule' => 0,
    'idslist' => 0,
    'templates_select' => 0,
    'languages_select' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57d1b9046298e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57d1b9046298e')) {function content_57d1b9046298e($_smarty_tpl) {?>
<div id="PDFMakerContainer" class="modelContainer" style="min-width:500px;">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" title="<?php echo vtranslate('LBL_CLOSE');?>
">x</button>
        <h3><?php echo vtranslate('LBL_PDF_ACTIONS','PDFMaker');?>
</h3>
    </div>
    <form id="generatePDFForm" method="post" action="index.php">
        <input type="hidden" name="module" value="PDFMaker" />
        <input type="hidden" name="relmodule" value="<?php echo $_smarty_tpl->tpl_vars['relmodule']->value;?>
" />
        <input type="hidden" name="action" value="CreatePDFFromTemplate" />
        <input type="hidden" name="idslist" value="<?php echo $_smarty_tpl->tpl_vars['idslist']->value;?>
">
        <input type="hidden" name="commontemplateid" value="">
        <input type="hidden" name="language" value="">
    </form>
    <form class="form-horizontal contentsBackground" id="massSave" method="post" action="index.php">
        <input type="hidden" name="module" value="PDFMaker" />
        <input type="hidden" name="relmodule" value="<?php echo $_smarty_tpl->tpl_vars['relmodule']->value;?>
" />
        <input type="hidden" name="action" value="CreatePDFFromTemplate" />
        <input type="hidden" name="idslist" value="<?php echo $_smarty_tpl->tpl_vars['idslist']->value;?>
">
        <div class="modal-body tabbable"> 
            <div class="control-group">
                <span class="control-label">
                    <?php echo vtranslate('LBL_PDF_TEMPLATE','PDFMaker');?>

                </span>
                <div class="controls">
                    <div class="row-fluid">
                        <span class="span10">
                            <?php echo $_smarty_tpl->tpl_vars['templates_select']->value;?>

                        </span>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <span class="control-label">
                    <?php echo vtranslate('LBL_PDF_LANGUAGE','PDFMaker');?>

                </span>
                <div class="controls">
                    <div class="row-fluid">
                        <span class="span10">
                            <?php echo $_smarty_tpl->tpl_vars['languages_select']->value;?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class=" pull-right cancelLinkContainer">
                <a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CLOSE');?>
</a>
            </div>
            <button class="btn btn-success" type="button" id="printButton" name="printButton"><strong><?php echo vtranslate('LBL_PRINT','PDFMaker');?>
</strong></button>
            <button class="btn btn-success" type="button" id="generateButton" name="generateButton"><strong><?php echo vtranslate('LBL_EXPORT_TO_PDF','PDFMaker');?>
</strong></button>
        </div>
    </form>
</div><?php }} ?>