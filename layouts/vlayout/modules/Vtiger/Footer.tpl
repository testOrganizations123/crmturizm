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
		<input id='activityReminder' class='hide noprint' type="hidden" value="{$ACTIVITY_REMINDER}"/>

		{* Feedback side-panel button *}
		{if $HEADER_LINKS && $MAIN_PRODUCT_SUPPORT && !$MAIN_PRODUCT_WHITELABEL}
		{assign var="FIRSTHEADERLINK" value=$HEADER_LINKS.0}
		{assign var="FIRSTHEADERLINKCHILDRENS" value=$FIRSTHEADERLINK->get('childlinks')}
		{assign var="FEEDBACKLINKMODEL" value=$FIRSTHEADERLINKCHILDRENS.2}
		
		{/if}
                
                
		{if !$MAIN_PRODUCT_WHITELABEL && isset($CURRENT_USER_MODEL)}
		<footer class="noprint">
                    <div class="vtFooter">
			<p>
				{vtranslate('VorDOOM.net vTiger CRM')} {$VTIGER_VERSION} &nbsp;
				&copy; 2004 - {date('Y')}&nbsp&nbsp;
				<a href="//www.vtiger.com" target="_blank">vtiger.com</a>
				&nbsp;|&nbsp;
                                
				&copy; 2014 - {date('Y')}&nbsp&nbsp;
				<a href="//vordoom.ru/" target="_blank">VorDOOM.net</a>
				
			</p>
                     </div>
		</footer>
		{/if}
		
		{* javascript files *}
		{include file='JSResources.tpl'|@vtemplate_path}
		</div>
		 
		 <!---->
		 <script type="text/javascript" src="layouts/vlayout/modules/VChat/resources/general.js"></script>
			
	</body>
</html>
{/strip}
