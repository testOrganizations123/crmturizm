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
    {assign var=fields value=Zend_Json::decode(htmlspecialchars_decode($FIELD_MODEL->get('fieldvalue')))}
    
    {if $type_answer == 'Buttons'}
<table class="table table-bordered blockContainer showInlineTable equalSplit" >
    {foreach $fields as $field}
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_LABEL', $MODULE_NAME)}</label></td>
            <td><span clas="span10">{$field.label}</span></td>
        <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_STEP', $MODULE_NAME)}</label></td>
            <td><span clas="span10">
                    {$FIELD_MODEL->getStepName($field.step)}
                </span></td></tr>
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_COLOR', $MODULE_NAME)}</label></td>
            <td><span clas="span10">
                    {vtranslate($field.color, $MODULE_NAME)}
                </span></td>
                <td></td>
                <td>
                </td>
        </tr>
      {/foreach}
    </table>
   {else if $type_answer == 'Module'}
       <table class="table table-bordered blockContainer showInlineTable equalSplit" >
    
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_MODULE_LABEL', $MODULE_NAME)}</label></td>
            <td><span clas="span10">{vtranslate($fields.name,$fields.name)}</span></td>
        <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_STEP', $MODULE_NAME)}</label></td>
            <td><span clas="span10">
                    {$FIELD_MODEL->getStepName($fields.step)}
                </span></td></tr>
        {foreach key=KEY item=field from=$fields.field }
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_MODULE_FIELD', $MODULE_NAME)}</label></td>
            <td><span clas="span10">
                    {vtranslate($FIELD_MODEL->getFieldNameRelatedModule($field.field), $fields.name)}
                </span></td>
                <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_MODULE_COMENT', $MODULE)}</label></td>
                <td><span clas="span10">{$field.comment}</span>
                </td>
        </tr>
        {/foreach}
    </table>
    {/if}
   
{/strip}