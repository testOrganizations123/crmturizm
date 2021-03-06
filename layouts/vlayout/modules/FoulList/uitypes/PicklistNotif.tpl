{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ('License'); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{strip}
{assign var='FIELD_INFO' value=Zend_Json::encode($FIELD_MODEL->getFieldInfo())}
{assign var=PICKLIST_VALUES value=$leadsource}
{assign var='SPECIAL_VALIDATOR' value=$FIELD_MODEL->getValidator()}
<select class='chzn-select {if $OCCUPY_COMPLETE_WIDTH} row-fluid {/if}' name='{$FIELD_MODEL->getFieldName()}' required data-validation-engine='validate[{if $FIELD_MODEL->isMandatory() eq true} required,{/if}funcCall[Vtiger_Base_Validator_Js.invokeValidation]]' data-fieldinfo='{$FIELD_INFO|escape}' {if !empty($SPECIAL_VALIDATOR)}data-validator='{Zend_Json::encode($SPECIAL_VALIDATOR)}'{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'>
		{if $FIELD_MODEL->isEmptyPicklistOptionAllowed()}<option value=''>{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>{/if}
                {foreach item=PICKLIST_VALUES key=Groupname from=$PIKLIST_NOTIF}
                     <optgroup label="{$Groupname}">
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
        <option value='{$PICKLIST_NAME}' {if $FIELD_MODEL->get('fieldvalue') eq $PICKLIST_NAME} selected {/if}>{$PICKLIST_VALUE}</option>
        {/foreach}
                     </optgroup>
    {/foreach}
</select>
{/strip}