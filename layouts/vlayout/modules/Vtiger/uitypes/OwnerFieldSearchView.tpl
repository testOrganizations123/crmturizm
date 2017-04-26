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
    {assign var="FIELD_INFO" value=Zend_Json::encode($FIELD_MODEL->getFieldInfo())}
    <div class="row-fluid">
    {assign var=ASSIGNED_USER_ID value=$FIELD_MODEL->get('name')}
    {assign var=ALL_ACTIVEUSER_LIST value=$USER_MODEL->getAccessibleUsers2('',false,$office)}
    {assign var=SEARCH_VALUES value=explode(',',$SEARCH_INFO['searchValue'])}
    {assign var=SEARCH_VALUES value=array_map("trim",$SEARCH_VALUES)}

    {if $ASSIGNED_USER_ID neq 'modifiedby'}
	{assign var=ALL_ACTIVEGROUP_LIST value=$USER_MODEL->getAccessibleGroups()}
    {else}
        {assign var=ALL_ACTIVEGROUP_LIST value=array()}
    {/if}

	{assign var=ACCESSIBLE_USER_LIST value=$USER_MODEL->getAccessibleUsersForModule($MODULE)}
	{assign var=ACCESSIBLE_GROUP_LIST value=$USER_MODEL->getAccessibleGroupForModule($MODULE)}

	<select class="listSearchContributor span10 {$ASSIGNED_USER_ID}"  name="{$ASSIGNED_USER_ID}" style="width:100%;"data-fieldinfo='{$FIELD_INFO|escape}'>
		<option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
            {foreach key=OFFICE item=LIST_OFFICE from=$ALL_ACTIVEUSER_LIST}
                {if $OFFICE eq 'no'}
            <optgroup label="{vtranslate('LBL_USERS')}" class="groupAll">
                {else}
                    <optgroup label='{$OFFICE}' class="groupAll" id='search_{$LIST_OFFICE['id']}'>
                    {/if}
			{foreach key=OWNER_ID item=OWNER_NAME from=$LIST_OFFICE['value']}
                    <option value="{$OWNER_NAME}" data-picklistvalue= '{$OWNER_NAME}' {if in_array(trim(decode_html($OWNER_NAME)),$SEARCH_VALUES)} selected {/if}
						{if array_key_exists($OWNER_ID, $ACCESSIBLE_USER_LIST)} data-recordaccess=true {else} data-recordaccess=false {/if}
						data-userId="">
                    {$OWNER_NAME}
                    </option>
			{/foreach}
		</optgroup>
                {/foreach}
        {if count($ALL_ACTIVEGROUP_LIST) gt 0}
		<optgroup label="{vtranslate('LBL_GROUPS')}">
			{foreach key=OWNER_ID item=OWNER_NAME from=$ALL_ACTIVEGROUP_LIST}
				<option value="{$OWNER_NAME}" data-picklistvalue= '{$OWNER_NAME}' {if in_array(trim($OWNER_NAME),$SEARCH_VALUES)} selected {/if}
					{if array_key_exists($OWNER_ID, $ACCESSIBLE_GROUP_LIST)} data-recordaccess=true {else} data-recordaccess=false {/if} >
				{$OWNER_NAME}
				</option>
			{/foreach}
		</optgroup>
        {/if}
	</select>
    </div>
{/strip}