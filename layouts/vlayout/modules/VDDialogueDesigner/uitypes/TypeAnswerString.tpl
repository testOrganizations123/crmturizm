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
    <table class="table table-bordered blockContainer showInlineTable equalSplit">
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_STRING_VAR_NAME', $MODULE)}</label></td>
            <td><span clas="span10"><input pattern="^[a-zA-Z]+$" requared name="type_answer_string_name" value="{$FIELDS.value}"></span></td>
            <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_STEP', $MODULE)}</label></td>
            <td><span clas="span10">
                    {include file=vtemplate_path('uitypes/SelectListSteps.tpl',$MODULE) NAME="type_answer_string_step" NAMEDISPLAY = "type_answer_string_step" }
                </span></td></tr>
    </table>


{/strip}