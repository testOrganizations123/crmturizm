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
       <div class="row-fluid">
            <div class="pull-right">

                {* SalesPlatform.ru begin Add import button from social nets to Leads, Accounts, Contacts *}
                {if $FL_IMPORT_BUTTON && ($MODULE eq 'Leads' || $MODULE eq 'Accounts' || $MODULE eq 'Contacts')}
                    <button class="btn btn-info" type="button" onclick="SPSocialConnector_Edit_Js.triggerEnterURL('index.php?module={$MODULE}&record_id={$RECORD_ID}&view=MassActionAjax&mode=showEnterURLForm');"><strong>{vtranslate('LBL_IMPORT', $MODULE)}</strong></button>
                    &nbsp;&nbsp;
                {/if}
                {* SalesPlatform.ru end *}
				<button class="btn btn-success" type="submit"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button>
				<a class="cancelLink" type="reset" onclick="javascript:window.history.back();">{vtranslate('LBL_CANCEL', $MODULE)}</a>
			</div>
			<div class="clearfix"></div>
        </div>
		<br>
    </form>
</div>
{/strip}