<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 14:35:41
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/GetPDFActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94963512857b1a90d44a026-84111452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9b2e1bb21cd8e88d3fb1821b861d3318e2f14f8' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/GetPDFActions.tpl',
      1 => 1471260282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94963512857b1a90d44a026-84111452',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ENABLE_EMAILMAKER' => 0,
    'ENABLE_PDFMAKER' => 0,
    'CRM_TEMPLATES_EXIST' => 0,
    'templateid' => 0,
    'itemArr' => 0,
    'TEMPLATE_LANGUAGES' => 0,
    'CURRENT_LANGUAGE' => 0,
    'lang_key' => 0,
    'EMAIL_FUNCTION' => 0,
    'MODULE' => 0,
    'ID' => 0,
    'PDFMAKER_MOD' => 0,
    'SEND_EMAIL_PDF_ACTION' => 0,
    'RELMODULE' => 0,
    'RELMODULE_SELID' => 0,
    'EDIT_AND_EXPORT_ACTION' => 0,
    'SAVE_AS_DOC_ACTION' => 0,
    'EXPORT_TO_RTF_ACTION' => 0,
    'IS_ADMIN' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57b1a90d4deb4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b1a90d4deb4')) {function content_57b1a90d4deb4($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/var/www/moihottur/data/www/crmturizm.ru/libraries/Smarty/libs/plugins/function.html_options.php';
?>
<?php if ($_smarty_tpl->tpl_vars['ENABLE_EMAILMAKER']->value!='true'){?>
    <?php $_smarty_tpl->tpl_vars["EMAIL_FUNCTION"] = new Smarty_variable("sendPDFmail", null, 0);?>
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars["EMAIL_FUNCTION"] = new Smarty_variable("sendEMAILMakerPDFmail", null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['ENABLE_PDFMAKER']->value=='true'){?>
<div class="row-fluid">
    <div class="span10">
        <?php if ($_smarty_tpl->tpl_vars['CRM_TEMPLATES_EXIST']->value=='0'){?>
            <ul class="nav nav-list row-fluid">
		<li>
                    <select name="use_common_template" id="use_common_template" class="detailedViewTextBox" multiple size="5">
                    <?php  $_smarty_tpl->tpl_vars["itemArr"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["itemArr"]->_loop = false;
 $_smarty_tpl->tpl_vars["templateid"] = new Smarty_Variable;
 $_from = ($_smarty_tpl->tpl_vars['CRM_TEMPLATES']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["itemArr"]->key => $_smarty_tpl->tpl_vars["itemArr"]->value){
$_smarty_tpl->tpl_vars["itemArr"]->_loop = true;
 $_smarty_tpl->tpl_vars["templateid"]->value = $_smarty_tpl->tpl_vars["itemArr"]->key;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['templateid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['itemArr']->value['title']!=''){?>title="<?php echo $_smarty_tpl->tpl_vars['itemArr']->value['title'];?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['itemArr']->value['is_default']=='1'||$_smarty_tpl->tpl_vars['itemArr']->value['is_default']=='3'){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['itemArr']->value['templatename'];?>
</option>
                    <?php } ?>
                    </select>        
		</li>
		<?php if (sizeof($_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value)>1){?>
                    <li>   	
                        <select name="template_language" id="template_language" class="detailedViewTextBox" size="1">
                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value,'selected'=>$_smarty_tpl->tpl_vars['CURRENT_LANGUAGE']->value),$_smarty_tpl);?>

                        </select>
                    </li>
		<?php }else{ ?>
                    <?php  $_smarty_tpl->tpl_vars["lang"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["lang"]->_loop = false;
 $_smarty_tpl->tpl_vars["lang_key"] = new Smarty_Variable;
 $_from = ($_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["lang"]->key => $_smarty_tpl->tpl_vars["lang"]->value){
$_smarty_tpl->tpl_vars["lang"]->_loop = true;
 $_smarty_tpl->tpl_vars["lang_key"]->value = $_smarty_tpl->tpl_vars["lang"]->key;
?>
		    	<input type="hidden" name="template_language" id="template_language" value="<?php echo $_smarty_tpl->tpl_vars['lang_key']->value;?>
"/>
                    <?php } ?>
		<?php }?>
                <input type="hidden" name="email_function" id="email_function" value="<?php echo $_smarty_tpl->tpl_vars['EMAIL_FUNCTION']->value;?>
"/>
                
		<li>
		    <a href="javascript:;" onclick="PDFMaker_Actions_Js.exportPDF('<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['SELECT_TEMPLATE'];?>
');" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/actionGeneratePDF.gif" hspace="5" align="absmiddle" border="0" style="border-radius:3px;" /> <?php echo vtranslate('LBL_EXPORT','PDFMaker');?>
</a>
                </li>
                
                <li>
		    <a href="javascript:;" onclick="if(PDFMaker_Actions_Js.getSelectedTemplates()=='') alert('<?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['SELECT_TEMPLATE'];?>
'); else window.open('index.php?module=PDFMaker&relmodule=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&action=CreatePDFFromTemplate&print=true&record=<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
&commontemplateid='+PDFMaker_Actions_Js.getSelectedTemplates()+'&language='+document.getElementById('template_language').value,'_newtab' + (Math.floor(new Date().getTime() / 1000)) );" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/PDF_print.png" hspace="5" align="absmiddle" border="0" style="border-radius:3px;" /> <?php echo vtranslate('LBL_PRINT','PDFMaker');?>
</a>
		</li>

                
                <?php if ($_smarty_tpl->tpl_vars['SEND_EMAIL_PDF_ACTION']->value=="1"){?>
		<li>
                    <a href="javascript:;" onclick="PDFMaker_Actions_Js.sendEmailWithPDF('<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['RELMODULE']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['RELMODULE_SELID']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['SELECT_TEMPLATE'];?>
');" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/PDFMail.gif" hspace="5" align="absmiddle" border="0" style="border-radius:3px;" /> <?php echo vtranslate('LBL_SEND_EMAIL');?>
</a>
                </li>
                <?php }?>
                            
                <?php if ($_smarty_tpl->tpl_vars['EDIT_AND_EXPORT_ACTION']->value=="1"){?>
		<li>
                    <a href="javascript:;" onclick="if(PDFMaker_Actions_Js.getSelectedTemplates()=='') alert('<?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['SELECT_TEMPLATE'];?>
'); else PDFMakerCommon.getEditAndExportForm('<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
',PDFMaker_Actions_Js.getSelectedTemplates(),document.getElementById('template_language').value);" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/PDF_edit.png" hspace="5" align="absmiddle" border="0" style="border-radius:3px;" /> <?php echo vtranslate('LBL_EDIT');?>
 <?php echo vtranslate('LBL_AND');?>
 <?php echo vtranslate('LBL_EXPORT','PDFMaker');?>
</a>
		</li>
                <?php }?>
                
                <?php if ($_smarty_tpl->tpl_vars['SAVE_AS_DOC_ACTION']->value=="1"){?>
		<li>
                    <a href="javascript:;" onclick="if(PDFMaker_Actions_Js.getSelectedTemplates()=='') alert('<?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['SELECT_TEMPLATE'];?>
'); else PDFMakerCommon.getPDFDocDivContent(this,'<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
');" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/PDFDoc.png" hspace="5" align="absmiddle" border="0" style="border-radius:3px;" /> <?php echo vtranslate('LBL_SAVEASDOC','PDFMaker');?>
</a>
		</li>
                <?php }?>
                
                <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Invoice'||$_smarty_tpl->tpl_vars['MODULE']->value=='SalesOrder'||$_smarty_tpl->tpl_vars['MODULE']->value=='PurchaseOrder'||$_smarty_tpl->tpl_vars['MODULE']->value=='Quotes'||$_smarty_tpl->tpl_vars['MODULE']->value=='Receiptcards'||$_smarty_tpl->tpl_vars['MODULE']->value=='Issuecards'){?>
                    <li>
                        <a href="javascript:PDFMakerCommon.showPDFBreakline('<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
');" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/PDF_bl.png" hspace="5" align="absmiddle" border="0" style="border-radius:3px;" /><?php echo vtranslate('LBL_PRODUCT_BREAKLINE','PDFMaker');?>
</a>                
                        <div id="PDFBreaklineDiv" style="display:none; width:350px; position:absolute;" class="layerPopup"></div>                
                    </li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Invoice'||$_smarty_tpl->tpl_vars['MODULE']->value=='SalesOrder'||$_smarty_tpl->tpl_vars['MODULE']->value=='PurchaseOrder'||$_smarty_tpl->tpl_vars['MODULE']->value=='Quotes'||$_smarty_tpl->tpl_vars['MODULE']->value=='Receiptcards'||$_smarty_tpl->tpl_vars['MODULE']->value=='Issuecards'||$_smarty_tpl->tpl_vars['MODULE']->value=='Products'){?>
                <li>
                    <a href="javascript:PDFMakerCommon.showproductimages('<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
');" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/PDF_img.png" hspace="5" align="absmiddle" border="0" style="border-radius:3px;" /> <?php echo vtranslate('LBL_PRODUCT_IMAGE','PDFMaker');?>
</a>                
                </li>
                <?php }?>
                
                
                
                <?php if ($_smarty_tpl->tpl_vars['EXPORT_TO_RTF_ACTION']->value=="1"){?>
                    <li>		    
                        <a href="javascript:;" onclick="if(PDFMaker_Actions_Js.getSelectedTemplates()=='') alert('<?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['SELECT_TEMPLATE'];?>
'); else document.location.href = 'index.php?module=PDFMaker&relmodule=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&action=CreatePDFFromTemplate&record=<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
&type=rtf&commontemplateid=' + PDFMaker_Actions_Js.getSelectedTemplates() + '&language=' + document.getElementById('template_language').value;" class="webMnu" style="padding-left:10px;"><img src="layouts/vlayout/modules/PDFMaker/images/actionGenerateRTF.gif" hspace="5" align="absmiddle" border="0" style="border-radius:3px;"/><?php echo vtranslate('LBL_EXPORT_TO_RTF','PDFMaker');?>
</a>
                    </li>
                <?php }?>
                
            </ul>
        <?php }else{ ?>
                <tr>
  		<td class="rightMailMergeContent">
  		  <?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['CRM_TEMPLATES_DONT_EXIST'];?>

                  <?php if ($_smarty_tpl->tpl_vars['IS_ADMIN']->value=='1'){?>
    		  <?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['CRM_TEMPLATES_ADMIN'];?>

                    <a href="index.php?module=PDFMaker&view=List&return_module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&return_id=<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" class="webMnu"><?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['TEMPLATE_CREATE_HERE'];?>
</a>
                  <?php }?>
                </td>
		</tr>
	<?php }?>
	</div>
	<br clear="all"/>
 	<div id="alert_doc_title" style="display:none;"><?php echo $_smarty_tpl->tpl_vars['PDFMAKER_MOD']->value['ALERT_DOC_TITLE'];?>
</div>
</div>
<?php }else{ ?>
<div class="row-fluid">
	<div class="span10">
		<ul class="nav nav-list">
			<li><a href="index.php?module=PDFMaker&view=List"><?php echo vtranslate('LBL_PLEASE_FINISH_INSTALLATION','PDFMaker');?>
</a></li>
		</ul>
	</div>
</div>
<?php }?>
<?php }} ?>