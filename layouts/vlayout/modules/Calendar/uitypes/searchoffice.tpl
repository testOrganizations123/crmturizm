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
      
   
   
       {assign var=office value=$CURRENT_USER_MODEL->get('office') }
       {assign var=user_id value=$CURRENT_USER_MODEL->getId() }
       {assign var=PICKLIST_VALUES value=$FIELD_MODEL->getPicklistValuesOffice()}
       {if $office eq "" }
     

<div class="row-fluid">
    
 

<select class='listSearchContributor office' style="width:140px;"name='office'  {/strip}{literal}data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}'{/literal}{strip} onchange="changeAssignList(this)">
	<option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>	
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
       
         <option value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}" data-officeid='{$PICKLIST_NAME}' data-picklistvalue= '{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' {if $PICKLIST_NAME eq $OFFICE} selected {/if}
						
						data-userId="{$CURRENT_USER_MODEL->get('id')}">
                    {$PICKLIST_VALUE}
         </option>
        {/foreach}
</select>
        </div>
{else}
    <select class='listSearchContributor office' name='office' style="width:140px;"name='office' {/strip}{literal}data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}'{/literal}{strip} onchange="changeAssignList(this)">
	
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES} {if $PICKLIST_NAME neq $office and $user_id neq 19}{continue}{/if}
       {if $PICKLIST_NAME eq 404 or $PICKLIST_NAME eq 405 or $PICKLIST_NAME eq 406}{else}{continue}{/if}
         <option value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}" data-officeid='{$PICKLIST_NAME}' data-picklistvalue= '{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' selected 
						
						data-userId="{$CURRENT_USER_MODEL->get('id')}">
                    {$PICKLIST_VALUE}
         </option>
        {/foreach}
</select>
    
    {/if}
           
{strip}
{literal}
    <script>
    jQuery(document).ready(function(){
        var id = jQuery('select[name="office"]').find('option:selected').data('officeid');
        console.log(id);
       if (id){
        jQuery(".groupAll").hide();
        jQuery("#search_"+id).show();
    }
    });
    function changeAssignList(element){
        element = jQuery(element);
        var id = element.find('option:selected').data('officeid');
        if (id != 'undefined'){
        jQuery(".groupAll").hide();
        jQuery("#search_"+id).show();
    }
    }
    </script>
    {/literal}