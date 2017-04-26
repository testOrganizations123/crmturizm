{*<!--
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: Vordoom.net
 * The Initial Developer of the Original Code is Vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
-->*}
{strip}
<div class="listViewPageDiv">
	<div class="listViewTopMenuDiv">
        <div class="row-fluid">
            <div class="span6">
                <h3>{vtranslate($MODULE,$QUALIFIED_MODULE)}</h3>
            </div>
        </div>
        <hr>
		<div class="row-fluid">
			<span class="span4 btn-toolbar">
				<button class="btn addButton" {if stripos($MODULE_MODEL->getCreateViewUrl(), 'javascript:')===0} onclick="{$MODULE_MODEL->getCreateViewUrl()|substr:strlen('javascript:')};"
                        {else} onclick='window.location.href="{$MODULE_MODEL->getCreateViewUrl()}"' {/if}>
					<i class="icon-plus"></i>&nbsp;
					<strong>{vtranslate('LBL_ADD_SCRIPT', $QUALIFIED_MODULE)}</strong>
				</button>
			</span>
			
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="listViewContentDiv" id="listViewContents">
{/strip}
