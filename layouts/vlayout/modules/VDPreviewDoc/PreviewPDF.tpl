{*<!--
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
-->*}
{strip}
<div class="filePreview">
                        <div class="modal-header backgroundColor">
                            <button data-dismiss="modal" class="close pull-right" title="close">x</button>
                            <a class="btn btn-default btn-small pull-right" href="{$DOWNLOAD}">Download File</a>
                            <h3><b>{$DOCUMENT.file_info.name}</b></h3>
                        </div>
                        <div class="modal-body" style="height:550px;">
                        <iframe id="viewer" src="{$SRC}" frameborder="0" height="100%" width="100%">
                        </iframe>
                        </div>
                    </div> 
{/strip}