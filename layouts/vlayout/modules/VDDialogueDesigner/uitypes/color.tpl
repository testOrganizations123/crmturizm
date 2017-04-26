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



<select class="chzn-select " name="{$_name}" >
		
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$RECORD_STRUCTURE_MODEL->getColorPickList()}
        <option value="{$PICKLIST_NAME}" {if trim(decode_html($_value)) eq trim($PICKLIST_NAME)} selected {/if}>{vtranslate($PICKLIST_VALUE,$MODULE)}</option>
    {/foreach}
</select>
{/strip}