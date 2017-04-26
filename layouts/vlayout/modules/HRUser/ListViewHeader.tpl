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
	<div class="listViewPageDiv">
		<div class="listViewTopMenuDiv noprint">
			<div class="listViewActionsDiv row-fluid">
				<span class="btn-toolbar span4">
					<span class="btn-group listViewMassActions">
						
					</span>
					
				</span>
			<span class="btn-toolbar span4">
				<span class="customFilterMainSpan btn-group">
					
				</span>
			</span>
			
			<span class="span4 btn-toolbar">
				{include file='ListViewActions.tpl'|@vtemplate_path:$MODULE_NAME}
			</span>
		</div>
		</div>
	<div class="listViewContentDiv" id="listViewContents">
{/strip}