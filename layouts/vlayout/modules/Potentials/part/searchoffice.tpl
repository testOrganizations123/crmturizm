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
      
   
    {assign var=SEARCH_VALUES value=explode(',',$SEARCH_INFO['searchValue'])}
    {assign var=SEARCH_VALUES value=array_map("trim",$SEARCH_VALUES)}
       {assign var=OFFICE value=$CURRENT_USER_MODEL->get('office') }
       
        {assign var='FIELD_INFO' value=Zend_Json::encode($FIELD_MODEL->getFieldInfo())}
        {assign var=PICKLIST_VALUES value=$FIELD_MODEL->getPicklistValuesOffice()}
     
      

<div class="row-fluid">
    
 
{assign var='SPECIAL_VALIDATOR' value=$FIELD_MODEL->getValidator()}
<select class='listSearchContributor span12 office' name='office' data-fieldinfo='{$FIELD_INFO|escape}' onchange="changeAssignList(this)">
	<option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>	
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
       
         <option value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}" data-officeid='{$PICKLIST_NAME}' data-picklistvalue= '{Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)}' {if in_array(trim(decode_html({Vtiger_Util_Helper::toSafeHTML($PICKLIST_VALUE)})),$SEARCH_VALUES)} selected {/if}
						
						data-userId="{$CURRENT_USER_ID}">
                    {$PICKLIST_VALUE}
         </option>
        {/foreach}
</select>
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