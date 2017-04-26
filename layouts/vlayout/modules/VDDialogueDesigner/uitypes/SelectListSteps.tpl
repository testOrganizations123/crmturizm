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
{assign var=FIELD_NAME value=$FIELDS->name}
{assign var="REFERENCE_LIST" value=$FIELDS->value}
{assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELDS->info))}



<input name="popupReferenceModule" type="hidden" value="VDDialogueDesigner" />

<input name="{$NAME}" type="hidden" value="{$VALUE}" class="sourceField" data-displayvalue='{$VALUE}' data-fieldinfo="{$FIELD_INFO}" />
{assign var="displayId" value=$FIELD.value}
<div class="row-fluid input-prepend input-append">
<span class="add-on clearReferenceSelection cursorPointer">
	<i id="{$MODULE}_editView_fieldName_{$FIELD_NAME}_clear" class='icon-remove-sign' title="{vtranslate('LBL_CLEAR', $MODULE)}"></i>
</span>
{assign var=VIEW_NAME value={getPurifiedSmartyParameters('view')}}
{assign var=MODULE_NAME value={getPurifiedSmartyParameters('module')}}
<input id="{$NAME}_display" name="{$NAME}_display" type="text" class="span7 marginLeftZero autoComplete" 
 value="{$DISPLAYVALUE}" 
 placeholder="{vtranslate('LBL_TYPE_SEARCH',$MODULE)}"/>
<span class="add-on relatedPopup cursorPointer">
	<i id="{$MODULE}_editView_fieldName_{$NAME}_select" class="icon-search relatedPopup" title="{vtranslate('LBL_SELECT', $MODULE)}" ></i>
</span>
<span class="add-on cursorPointer createReferenceRecord">
	<i id="{$MODULE}_editView_fieldName_{$NAME}_create" class='icon-plus' title="{vtranslate('LBL_CREATE', $MODULE)}"></i>
</span>
</div>
{/strip}
