<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 14:28:30
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/Detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150630528857b1a75ea447e4-45880869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67b214d496d492a59829137241856b2ec878f9d7' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/Detail.tpl',
      1 => 1471260282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150630528857b1a75ea447e4-45880869',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TEMPLATEID' => 0,
    'PARENTTAB' => 0,
    'FILENAME' => 0,
    'MODULENAME' => 0,
    'EDIT' => 0,
    'MODULE' => 0,
    'DELETE' => 0,
    'DESCRIPTION' => 0,
    'IS_ACTIVE' => 0,
    'IS_DEFAULT' => 0,
    'HEADER' => 0,
    'BODY' => 0,
    'FOOTER' => 0,
    'VERSION' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57b1a75ea85fc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b1a75ea85fc')) {function content_57b1a75ea85fc($_smarty_tpl) {?>
<script>
    function ExportTemplates()
    {
        window.location.href = "index.php?module=PDFMaker&action=ExportPDFTemplate&templates=<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
";
    }
</script>
<form id="detailView" method="post" action="index.php" name="etemplatedetailview" onsubmit="VtigerJS_DialogBox.block();">  
    <input type="hidden" name="action" value="">
    <input type="hidden" name="view" value="">
    <input type="hidden" name="module" value="PDFMaker">
    <input type="hidden" name="retur_module" value="PDFMaker">
    <input type="hidden" name="return_action" value="PDFMaker">
    <input type="hidden" name="return_view" value="Detail">
    <input type="hidden" name="templateid" value="<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
">
    <input type="hidden" name="parenttab" value="<?php echo $_smarty_tpl->tpl_vars['PARENTTAB']->value;?>
">
    <input type="hidden" name="isDuplicate" value="false">
    <input type="hidden" name="subjectChanged" value="">
    <input id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
" type="hidden">
    <div class="detailViewContainer">
        <div class="row-fluid detailViewTitle">
            <div class="row-fluid">
                <div class="span7">
                    <div class="row-fluid">
                        <span class="span2"></span>
                        <span class="span8 margin0px">
                            <span class="row-fluid">
                                <span class="recordLabel font-x-x-large textOverflowEllipsis pushDown span" title="<?php echo $_smarty_tpl->tpl_vars['FILENAME']->value;?>
">
                                    <span class="templatename"><?php echo $_smarty_tpl->tpl_vars['FILENAME']->value;?>
</span>
                                </span>
                            </span>
                            <span class="row-fluid">
                                <span class="modulename_label"><?php echo vtranslate('LBL_MODULENAMES','PDFMaker');?>
:</span>
                                &nbsp;<?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>

                            </span>
                        </span>
                    </div>
                </div>
                <div class="span5">
                    <div class="pull-right detailViewButtoncontainer">
                        <div class="btn-toolbar">
                            <?php if ($_smarty_tpl->tpl_vars['EDIT']->value=='permitted'){?>
                                <span class="btn-group">
                                  <button class="btn" id="PDFMaker_detailView_basicAction_LBL_EDIT" onclick="window.location.href = 'index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=Edit&templateid=<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
&return_view=Detail';
        return false;"><strong><?php echo vtranslate('LBL_EDIT');?>
</strong></button>
                                </span>
                                <span class="btn-group">
                                    <button class="btn" id="PDFMaker_detailView_basicAction_LBL_DUPLICATE" onclick="window.location.href = 'index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=Edit&templateid=<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
&isDuplicate=true&return_view=Detail';
        return false;"><strong><?php echo vtranslate('LBL_DUPLICATE');?>
</strong></button>
                                </span>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['DELETE']->value=='permitted'){?>
                                <span class="btn-group">
                                    <button class="btn" id="PDFMaker_detailView_basicAction_Delete" onclick="deleteRecord('index.php?module=PDFMaker&action=DeletePDFTemplate&templateid=<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
'); return false;" style="font-weight:bold" ><strong><?php echo vtranslate('LBL_DELETE');?>
</strong></button>
                                </span>
                            <?php }?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="detailViewInfo row-fluid">
            <div class="details">
                <div style="position: relative;" class="contents">
                    <table class="table table-bordered equalSplit detailview-table">
                        <thead>
                            <tr>
                                <th class="blockHeader" colspan="2"><?php echo vtranslate('LBL_TEMPLATE_INFORMATIONS','PDFMaker');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fieldLabel narrowWidthType" style="width:25%;"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_PDF_NAME','PDFMaker');?>
</label></td>
                                <td class="fieldValue narrowWidthType" style="width:75%;"><?php echo $_smarty_tpl->tpl_vars['FILENAME']->value;?>
</td>
                            </tr>
                            <tr>
                                <td class="fieldLabel narrowWidthType"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_DESCRIPTION','PDFMaker');?>
</label></td>
                                <td class="fieldValue narrowWidthType" valign=top><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</td>
                            </tr>
                            <tr>
                                <td class="fieldLabel narrowWidthType"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULENAMES','PDFMaker');?>
</label></td>
                                <td class="fieldValue narrowWidthType" valign=top><?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>
</td>
                            </tr>
                            <tr>
                                <td class="fieldLabel narrowWidthType"><label class="muted pull-right marginRight10px"><?php echo vtranslate('Status');?>
</label></td>
                                <td class="fieldValue narrowWidthType" valign=top><?php echo $_smarty_tpl->tpl_vars['IS_ACTIVE']->value;?>
</td>
                            </tr>
                            <tr>
                                <td class="fieldLabel narrowWidthType"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_SETASDEFAULT','PDFMaker');?>
</label></td>
                                <td class="fieldValue narrowWidthType" valign=top><?php echo $_smarty_tpl->tpl_vars['IS_DEFAULT']->value;?>
</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered equalSplit detailview-table">
                        <thead>
                            <tr>
                                <th class="blockHeader" colspan="2"><?php echo vtranslate('LBL_PDF_TEMPLATE','PDFMaker');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td valign="top" style="width:5%;"><?php echo vtranslate('LBL_HEADER_TAB','PDFMaker');?>
</td>
                                <td style="width:95%;"><?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>
</td>
                            </tr>

                            <tr>
                                <td valign="top"><?php echo vtranslate('LBL_BODY','PDFMaker');?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['BODY']->value;?>
</td>
                            </tr>

                            <tr>
                                <td valign="top"><?php echo vtranslate('LBL_FOOTER_TAB','PDFMaker');?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>
</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <center style="color: rgb(153, 153, 153);"><?php echo vtranslate('PDF_MAKER','PDFMaker');?>
 <?php echo $_smarty_tpl->tpl_vars['VERSION']->value;?>
 <?php echo vtranslate('COPYRIGHT','PDFMaker');?>
</center>
</form>


    <script type="text/javascript">
        function deleteRecord(deleteRecordActionUrl) {
            var message = app.vtranslate('LBL_DELETE_CONFIRMATION');
            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(function(data) {
                AppConnector.request(deleteRecordActionUrl + '&ajaxDelete=true').then(
                        function(data) {
                            if (data.success == true) {
                                window.location.href = 'index.php?module=PDFMaker&view=List';
                            } else {
                                Vtiger_Helper_Js.showPnotify(data.error.message);
                            }
                        });
            },
                    function(error, err) {
                    }
            );
        }
    </script>
<?php }} ?>