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
    <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_MODULE_FIELD', $MODULE)}</label></td>
            <td><span clas="span10">
                    <select class="chzn-select"  name="type_answer_module_field[{$KEY}]" data-fields = "{$KEY}" onchange='changeFields(this);'>
    
		{assign var=MODULE_LABEL value=vtranslate($RELATED_MODULE, $RELATED_MODULE)}
		
			{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$MODULE_RECORD_STRUCTURE}
				<optgroup label='{vtranslate($BLOCK_LABEL, $SOURCE_MODULE)}'>
				{foreach key=FIELD_NAME item=FIELD_MODEL from=$BLOCK_FIELDS}
                                    {if $FIELD_NAME eq 'time_start'}{continue}{/if}
					{assign var=FIELD_INFO value=$FIELD_MODEL->getFieldInfo()}
					{assign var=MODULE_MODEL value=$FIELD_MODEL->getModule()}
                    {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
					
						{assign var=columnNameApi value=getCustomViewColumnName}
					
					<option value="{$FIELD_MODEL->$columnNameApi()}" data-fieldtype="{$FIELD_MODEL->getFieldType()}" data-field-name="{$FIELD_NAME}"
					
						{assign var=FIELD_TYPE value=$FIELD_MODEL->getFieldType()}
						{assign var=SELECTED_FIELD_MODEL value=$FIELD_MODEL}
						{if $FIELD_MODEL->getFieldDataType() == 'reference'}
							{$FIELD_TYPE='V'}
						{/if}
						{if $FIELD_MODEL->$columnNameApi() eq decode_html($CONDITION_INFO.field)}
						selected="selected"
					         {/if}
					{if ($MODULE_MODEL->get('name') eq 'Calendar') && ($FIELD_NAME eq 'recurringtype')}
						{assign var=PICKLIST_VALUES value = Calendar_Field_Model::getReccurencePicklistValues()}
						{$FIELD_INFO['picklistvalues'] = $PICKLIST_VALUES}
					{/if}
                    {if ($MODULE_MODEL->get('name') eq 'Calendar') && ($FIELD_NAME eq 'activitytype')}
						{$FIELD_INFO['picklistvalues']['Task'] = vtranslate('Task', 'Calendar')}
					{/if}
					{if $FIELD_MODEL->getFieldDataType() eq 'reference'}
						{assign var=referenceList value=$FIELD_MODEL->getWebserviceFieldObject()->getReferenceList()}
						{if is_array($referenceList) && in_array('Users', $referenceList)}
								{assign var=USERSLIST value=array()}
								{assign var=CURRENT_USER_MODEL value = Users_Record_Model::getCurrentUserModel()}
								{assign var=ACCESSIBLE_USERS value = $CURRENT_USER_MODEL->getAccessibleUsers()}
								{foreach item=USER_NAME from=$ACCESSIBLE_USERS}
										{$USERSLIST[$USER_NAME] = $USER_NAME}
								{/foreach}
								{$FIELD_INFO['picklistvalues'] = $USERSLIST}
								{$FIELD_INFO['type'] = 'picklist'}
						{/if}
					{/if}
					data-fieldinfo='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($FIELD_INFO))}' 
                    {if !empty($SPECIAL_VALIDATOR)}data-validator='{Zend_Json::encode($SPECIAL_VALIDATOR)}'{/if}>
					{if $SOURCE_MODULE neq $MODULE_MODEL->get('name')}
						({vtranslate($MODULE_MODEL->get('name'), $MODULE_MODEL->get('name'))})  {vtranslate($FIELD_MODEL->get('label'), $MODULE_MODEL->get('name'))}
					{else}
						{vtranslate($FIELD_MODEL->get('label'), $SOURCE_MODULE)}
					{/if}
                                    
                                     
				</option>
				{/foreach}
				</optgroup>
			{/foreach}
		

							
						</select>
            </span></td>
        <td><label class="muted pull-right marginRight10px">{vtranslate('Значение', $MODULE)}</label></td>
         <td>
       <span class="span10 fieldUiHolder">
		<input name="type_answer_module_comment[{$KEY}]" data-value="value"  type="text" value="{$CONDITION_INFO.comment}" />
	</span>
           
                {if $KEY neq 1}<span class="span1" style="float:right;"><i class="icon-trash alignMiddle" onclick="deleteAnswerModule(this);" title="Удалить"></i></span>{/if}</td>
            
            
        
{/strip}