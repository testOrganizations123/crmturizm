{*
/*********************************************************************************
* The content of this file is subject to the PDF Maker license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
* Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
* All Rights Reserved.
********************************************************************************/
*}
{strip}
    <div class="padding20" id="composePDFContainer">
        <form class="form-horizontal" id="editPDFForm" method="post" action="index.php" enctype="multipart/form-data" name="editPDFForm">
            <input type="hidden" name="action" id="action" value='CreatePDFFromTemplate' />
            <input type="hidden" name="module" value="PDFMaker"/>
            <input type="hidden" name="commontemplateid" value='{$COMMONTEMPLATEIDS}' />
            <input type="hidden" name="template_ids" value='{$COMMONTEMPLATEIDS}' />
            <input type="hidden" name="idslist" value="{$RECORDS}" />
            <input type="hidden" name="relmodule" value="{$smarty.request.formodule}" />
            <input type="hidden" name="language" value='{$smarty.request.language}' />
            <input type="hidden" name="pmodule" value="{$smarty.request.formodule}" />
            <input type="hidden" name="pid" value="{$smarty.request.record}" />
            <input type="hidden" name="mode" value="edit" />
            <input type="hidden" name="print" value="" />
            
            <div id='editTemplate'>
                <div>
                    <h3>{vtranslate('LBL_EDIT')} {vtranslate('LBL_AND')} {vtranslate('LBL_EXPORT','PDFMaker')}</h3>
                    <hr style='margin:5px 0;width:100%'>
                </div>
                <div class="row-fluid" style="margin-bottom:7px;">  
                    <div class="span6">
                        <div class="modal-body tabbable" style="padding:0px;">
                           <ul class="nav nav-pills" style="margin-bottom:0px; padding-left:5px;">
                               <li class="active" id="body_tab_a" onclick="showHideTab('body');"><a data-toggle="tab1" href="javascript:void(0);">{vtranslate('LBL_BODY','PDFMaker')}</a></li>
                               <li id="header_tab_a" onclick="showHideTab('header');"><a data-toggle="tab1" href="javascript:void(0);">{vtranslate('LBL_HEADER_TAB','PDFMaker')}</a></li>
                               <li id="footer_tab_a" onclick="showHideTab('footer');"><a data-toggle="tab1" href="javascript:void(0);">{vtranslate('LBL_FOOTER_TAB','PDFMaker')}</a></li>
                           </ul>
                        </div>                      
                    </div>
                    <div class="span6">
                        <span class="pull-right">
                            {vtranslate('LBL_TEMPLATE','PDFMaker')}:&nbsp;{$TEMPLATE_SELECT}
                        </span>
                    </div>
                </div>
                {$PDF_DIVS}
                <div class="padding-bottom1per row-fluid">
                    <div class="span8">
                        <div class="btn-toolbar">
                            <span class="btn-group">
                                <button class="floatNone btn btn-success" id="PDFExportButton" type="submit" title="{vtranslate('LBL_EXPORT_TO_PDF','PDFMaker')}"><strong>{vtranslate('LBL_EXPORT_TO_PDF','PDFMaker')}</strong></button>
                            </span>
                            {*<span class="btn-group">
                                <button class="floatNone btn btn-success" type="submit" title="{vtranslate('LBL_PRINT','PDFMaker')}" onclick="return printPDF();"><strong>{vtranslate('LBL_PRINT','PDFMaker')}</strong></button>
                            </span>*}
                            <span class="btn-group">
                                <button class="floatNone btn btn-success" id="SavePDFAsDocButton" title="{vtranslate('LBL_SAVEASDOC','PDFMaker')}" onclick="return showDocSettings();"><strong>{vtranslate('LBL_SAVEASDOC','PDFMaker')}</strong></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="docSettings" class="hide">
                <div>
                    <h3>{vtranslate("LBL_SAVEASDOC",'PDFMaker')}</h3>
                    <hr style='margin:5px 0;width:100%'>
                </div>
                <table border="0" cellspacing="0" cellpadding="5" width="100%" align="center">
                    <tr><td class="small">
                            <table border="0" cellspacing="0" cellpadding="5" width="100%" align="center">
                                <tr>
                                    <td class="dvtCellLabel" width="20%" align="right"><font color="red">*</font>{vtranslate("Title",'Documents')}</td>
                                    <td class="dvtCellInfo" width="80%" align="left"><input name="notes_title" type="text" class="detailedViewTextBox"></td>
                                </tr>
                                <tr>
                                    <td class="dvtCellLabel" width="20%" align="right">{vtranslate("Folder Name",'Documents')}</td>
                                    <td class="dvtCellInfo" width="80%" align="left">
                                        <select name="folderid" class="small">
                                            {$FOLDER_OPTIONS}
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dvtCellLabel" width="20%" align="right">{vtranslate("Note",'Documents')}</td>
                                    <td class="dvtCellInfo" width="80%" align="left"><textarea name="notecontent" class="detailedViewTextBox"></textarea></td>
                                </tr>
                            </table>
                        </td></tr>
                </table>
                <div class="padding-bottom1per row-fluid">
                    <div class="span8">
                        <div class="btn-toolbar">
                            <span class="btn-group">
                                <button class="floatNone btn btn-success saveIntoDoc" type="button" title="{vtranslate('LBL_SAVE','PDFMaker')}"><strong>{vtranslate('LBL_SAVE','PDFMaker')}</strong></button>
                            </span>
                            
                            <span class="btn-group">
                                <button class="floatNone btn btn-danger cancelDocDiv" type="button" title="{vtranslate('LBL_CANCEL','PDFMaker')}"><strong>{vtranslate('LBL_CANCEL','PDFMaker')}</strong></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="alert_doc_title" class="hide">{vtranslate('ALERT_DOC_TITLE','PDFMaker')}</div>
{/strip}
<script type="text/javascript">
var selectedTab = 'body';
var selectedTemplate = '{$ST}';
document.getElementById('body_div' + selectedTemplate).style.display = 'block';
function changeTemplate(newtemplate){

    jQuery('#'+selectedTab + '_div' + selectedTemplate).hide();
    jQuery('#'+selectedTab + '_div' + newtemplate).show();

    selectedTemplate = newtemplate;
}

function showDocSettings(){
    jQuery('#editTemplate').hide();
    jQuery('#docSettings').show();
    document.getElementById('action').value = 'SaveIntoDocuments';
    
    return false;
}

function printPDF(){
    jQuery('input[name="print"]').val('true');
    return true;
}


function showHideTab(tabname){
 
    jQuery('#' + selectedTab + '_tab_a').removeClass("active");
    jQuery('#' + tabname + '_tab_a').addClass("active");

    jQuery('#'+selectedTab + '_div' + selectedTemplate).hide();
    jQuery('#'+tabname + '_div' + selectedTemplate).show();


    var formerTab = selectedTab;
    selectedTab = tabname;
}
</script>