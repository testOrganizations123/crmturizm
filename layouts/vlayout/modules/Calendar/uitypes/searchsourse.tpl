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
    
   
       {assign var=PICKLIST_VALUES value=$LISTVIEW_HEADER->getPicklistValuesSorse()}
      
     

<div class="row-fluid">
    

<select class='listSearchContributor' style="width:140px;"name='source'  {/strip}{literal}data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"source","label":"Источник"}'{/literal}{strip} >
	<option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>	
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
       
         <option value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}" data-officeid='{$PICKLIST_NAME}' data-picklistvalue= '{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' {if $PICKLIST_NAME eq $SOURCE} selected {/if}
						
						data-userId="{$CURRENT_USER_MODEL->get('id')}">
                    {$PICKLIST_VALUE}
         </option>
        {/foreach}
</select>
        </div>

{strip}
