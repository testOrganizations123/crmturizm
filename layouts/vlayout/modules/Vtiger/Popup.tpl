{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
-->*}
{strip}
    {if $MODULE_NAME eq 'Contacts'}
        <a id="menubar_quickCreate_Contacts" class="quickCreateModule" data-name="Contacts" data-url="index.php?module=Contacts&amp;view=QuickCreateAjax" href="javascript:void(0)">Клиент</a>
        {/if}
<div id="popupPageContainer" class="contentsDiv">
	<div class="paddingLeftRight10px">{include file='PopupSearch.tpl'|vtemplate_path:$MODULE}</div>
	<div id="popupContents" class="paddingLeftRight10px">{include file='PopupContents.tpl'|vtemplate_path:$MODULE_NAME}</div>
	<input type="hidden" class="triggerEventName" value="{getPurifiedSmartyParameters('triggerEventName')}"/>
</div>
</div>
{/strip}