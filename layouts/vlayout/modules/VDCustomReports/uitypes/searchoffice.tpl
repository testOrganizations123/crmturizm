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

       {assign var=office value=$USER_MODEL->get('office') }
       {assign var=PICKLIST_VALUES value=$MODULE_MODEL->getPicklistValuesOffice()}
       {if $office eq ""}






<select class='listSearchContributor office span12' name='filtre[office]'   {/strip}{literal}data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}'{/literal}{strip} onchange="changeAssignList(this)">
	<option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}

         <option value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}" data-officeid='{$PICKLIST_NAME}' data-picklistvalue= '{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' {if $PICKLIST_NAME eq $item['data']} selected {/if}

						data-userId="{$USER_MODEL->get('id')}">
                    {$PICKLIST_VALUE}
         </option>
        {/foreach}
</select>

{else}

    <select class='listSearchContributor office  span12' name='filtre[office]'  {/strip}{literal}data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}'{/literal}{strip} onchange="changeAssignList(this)">

	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES} {if $PICKLIST_NAME neq $office}{continue}{/if}

         <option value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}" data-officeid='{$PICKLIST_NAME}' data-picklistvalue= '{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' selected

						data-userId="{$USER_MODEL->get('id')}">
                    {$PICKLIST_VALUE}
         </option>
        {/foreach}
</select>

    {/if}
  </div>
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