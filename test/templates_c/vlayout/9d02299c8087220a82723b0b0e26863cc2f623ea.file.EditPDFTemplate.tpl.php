<?php /* Smarty version Smarty-3.1.7, created on 2016-07-11 04:13:42
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/SPPDFTemplates/EditPDFTemplate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5323951035782f2c626ee30-24291384%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d02299c8087220a82723b0b0e26863cc2f623ea' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/SPPDFTemplates/EditPDFTemplate.tpl',
      1 => 1468060779,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5323951035782f2c626ee30-24291384',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODEL' => 0,
    'EMODE' => 0,
    'DUPLICATE_FILENAME' => 0,
    'MODULE' => 0,
    'NAME' => 0,
    'DUPLICATE_NAME' => 0,
    'MODULENAMES' => 0,
    'PAGE_ORIENTATIONS' => 0,
    'SP_PDF_COMPANIES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5782f2c637718',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5782f2c637718')) {function content_5782f2c637718($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/var/www/moihottur/data/www/crmturizm.ru/libraries/Smarty/libs/plugins/function.html_options.php';
?>

<!-- If include it in module view, in reguest will be parameter ?v=6.0.0 and js and css will not included   -->
<link rel="stylesheet" href="includes/SalesPlatform/CodeMirror/lib/codemirror.css">
<script src="includes/SalesPlatform/CodeMirror/lib/codemirror.js"></script>
<script src="includes/SalesPlatform/CodeMirror/mode/xml/xml.js"></script>
<script src="includes/SalesPlatform/CodeMirror/mode/css/css.js"></script>


<div class="container-fluid">  
    <form name="mainform" action="index.php?module=SPPDFTemplates&action=SavePDFTemplate" method="post" enctype="multipart/form-data">
    <input type="hidden" name="templateid" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('templateid');?>
">

    <!-- HEADER of Edit view -->
    <?php if ($_smarty_tpl->tpl_vars['EMODE']->value=='edit'){?>
        <?php if ($_smarty_tpl->tpl_vars['DUPLICATE_FILENAME']->value==''){?>
            <div class="widget_header">
                <h3><b><a href="index.php?module=SPPDFTemplates&view=List"><?php echo vtranslate('LBL_TEMPLATE_GENERATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a> &gt; <?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 &quot;<?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
&quot; </b></h3>
            </div>
                
        <?php }else{ ?>
            <div class="widget_header">
                <h3><b><a href="index.php?module=SPPDFTemplates&view=List"><?php echo vtranslate('LBL_TEMPLATE_GENERATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a> &gt; <?php echo vtranslate('LBL_DUPLICATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&quot;<?php echo $_smarty_tpl->tpl_vars['DUPLICATE_NAME']->value;?>
&quot; </b></h3>
            </div>
        <?php }?>
    <?php }else{ ?>
            <div class="widget_header">
                <h3><b><a href="index.php?module=SPPDFTemplates&view=List"><?php echo vtranslate('LBL_TEMPLATE_GENERATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a> > <?php echo vtranslate('LBL_NEW_TEMPLATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </b></h3>
            </div>
    <?php }?>

    <?php echo vtranslate('LBL_TEMPLATE_GENERATOR_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>

    <hr>
    <br>
          
    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"> 
        <tr>
            <td align="left" valign="top">
                <div style="diplay:block;" id="properties_div">       
                    <table class="table table-bordered">                        
                        <tr>
                            <td width=25% class="small cellLabel"><font color="red">*</font><strong><?php echo vtranslate('LBL_TEMPLATE_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</strong></td>
                            <td width=75% class="small cellText"><input name="templatename" id="templatename" type="text" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('name');?>
" class="detailedViewTextBox" tabindex="1"></td>
                        </tr>
                        <tr>
                            <td valign=top class="small cellLabel"><font color="red">*</font><strong><?php echo vtranslate('LBL_MODULENAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</strong></td>
                            <td class="cellText small" valign="top">
                                <select name="modulename" id="modulename" class="small">
                                        <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->get('module')!=''){?>
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['MODULENAMES']->value,'selected'=>$_smarty_tpl->tpl_vars['MODEL']->value->get('module')),$_smarty_tpl);?>

                                    <?php }else{ ?>
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['MODULENAMES']->value),$_smarty_tpl);?>

                                    <?php }?>
                                </select>
                            </td>      						
                        </tr>    					
                        <tr>
                            <td width=25% class="small cellLabel"><font color="red">*</font><strong><?php echo vtranslate('LBL_HEADER_SIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</strong></td>
                            <td width=75% class="small cellText"><input name="header_size" id="header_size" type="text" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('header_size');?>
" class="detailedViewTextBox" tabindex="2" style="width: 100px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width=25% class="small cellLabel"><font color="red">*</font><strong><?php echo vtranslate('LBL_FOOTER_SIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</strong></td>
                            <td width=75% class="small cellText"><input name="footer_size" id="footer_size" type="text" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('footer_size');?>
" class="detailedViewTextBox" tabindex="3" style="width: 100px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign=top class="small cellLabel"><font color="red">*</font><strong><?php echo vtranslate('LBL_PAGE_ORIENTATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</strong></td>
                            <td class="cellText small" valign="top">
                                <select name="page_orientation" id="page_orientation" class="small">
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['PAGE_ORIENTATIONS']->value,'selected'=>$_smarty_tpl->tpl_vars['MODEL']->value->get('page_orientation')),$_smarty_tpl);?>

                                </select>
                            </td>      						
                        </tr>
                        <tr> 
                            <td valign=top class="small cellLabel"><font color="red">*</font><strong><?php echo vtranslate('LBL_COMPANY','Settings:Vtiger');?>
:</strong></td> 
                            <td class="cellText small" valign="top"> 
                                <select name="spcompany" id="spcompany" class="small"> 
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['SP_PDF_COMPANIES']->value,'selected'=>$_smarty_tpl->tpl_vars['MODEL']->value->get('spcompany')),$_smarty_tpl);?>
 
                                </select> 
                            </td> 
                        </tr>                         
                    </table>              
                </div>
            </td>
        </tr>
        
        <tr>
            <td>
                <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"> 
                   <tr>
                       <td style="text-align:center;padding:15px 0px 10px 0px;">
                          <input type="submit" style="color: white !important;" value="<?php echo vtranslate('LBL_SAVE_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="btn btn-success" onclick="return saveTemplate();"> 
                          <input type="button" style="color: white !important;" value="<?php echo vtranslate('LBL_CANCEL_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="btn btn-danger" onclick="window.history.back();">
                       </td>
                   </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td>
                <div style="diplay:block; max-width: 80%" id="body_div2">
                    <style>.CodeMirror { border: 1px solid #cccccc; }</style>
                    <textarea name="body" id="body" style="width:100%;height:500px" class=small tabindex="5"><?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('template');?>
</textarea>
                </div>
            </td>
        </tr>
        
        <tr>
            <td>
                 <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"> 
                    <tr>
                        <td style="text-align:center;padding:15px 0px 10px 0px;">
                           <input type="submit" style="color: white !important;" value="<?php echo vtranslate('LBL_SAVE_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="btn btn-success" onclick="return saveTemplate();"> 

                           <input type="button" style="color: white !important;" value="<?php echo vtranslate('LBL_CANCEL_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="btn btn-danger" onclick="window.history.back();">
                        </td>
                    </tr>
                 </table>
            </td>
        </tr>
        
    </table>
    
    </form>
</div>



			
			
<script>
var editor = CodeMirror.fromTextArea(document.getElementById("body"),
{
mode: "text/html", tabMode: "indent"
}
);

function trim(str)
{
        while (str.substring(0,1) == ' ') // check for white spaces from beginning
        {
                str = str.substring(1, str.length);
        }
        while (str.substring(str.length-1, str.length) == ' ') // check white space from end
        {
                str = str.substring(0,str.length-1);
        }
        return str;
}

function check4null(form)
{

        var isError = false;
        var errorMessage = "";
        // Here we decide whether to submit the form.
        if (trim(form.templatename.value) =='') {
                isError = true;
                errorMessage += "\n " + "<?php echo vtranslate('LBL_TEMPLATE_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
";
                form.templatename.focus();
        }

        if (trim(form.modulename.value) =='') {
                isError = true;
                errorMessage += "\n " + "<?php echo vtranslate('LBL_MODULENAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
";
                form.templatename.focus();
        }

        if (trim(form.header_size.value) =='') {
                isError = true;
                errorMessage += "\n " + "<?php echo vtranslate('LBL_HEADER_SIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
";
                form.templatename.focus();
        }

        if (trim(form.footer_size.value) =='') {
                isError = true;
                errorMessage += "\n " + "<?php echo vtranslate('LBL_FOOTER_SIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
";
                form.templatename.focus();
        }

        if (trim(form.page_orientation.value) =='') {
                isError = true;
                errorMessage += "\n " + "<?php echo vtranslate('LBL_PAGE_ORIENTATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
";
                form.templatename.focus();
        }
            
        // Here we decide whether to submit the form.
        if (isError == true) {
                alert("<?php echo vtranslate('LBL_MISSING_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" + errorMessage);
                return false;
        }
 return true;

}

function saveTemplate()
{
    
    if (!check4null(document.mainform))
       return false;
    else
       return true;
}


</script>
<?php }} ?>