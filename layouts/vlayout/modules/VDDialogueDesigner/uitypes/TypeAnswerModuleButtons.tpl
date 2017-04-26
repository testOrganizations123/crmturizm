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
    <table class="table table-bordered blockContainer showInlineTable equalSplit" >
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_MODULE_LABEL', $MODULE)}</label></td>
            <td><span clas="span10">
                    <select class="chzn-select"  name="type_answer_module_name" onchange="getModuleFields(this);">
                <option value="">{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
							<optgroup>
								{foreach key=RELATED_MODULE_KEY item=RELATED_MODULE from=$MODULELIST}
									<option value="{$RELATED_MODULE_KEY}" >
										{vtranslate($RELATED_MODULE_KEY,$RELATED_MODULE_KEY)}
									</option>
								{/foreach}
							</optgroup>
						</select>
            </span></td>
        <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_STEP', $MODULE)}</label></td>
            <td><span clas="span10">
                    
                </span></td></tr>
        <tr id="moduleField-1">
        </tr>
    </table>
    <button type="button" class="btn addButton" data-current="1" onClick="addAnswerModule(this);"><strong>{vtranslate('LBL_TYPEANSWER_MODULE_ADD', $MODULE)}</strong></button>
    <table class="table table-bordered blockContainer showInlineTable equalSplit" >
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_LABEL', $MODULE)}</label></td>
            <td><span clas="span10"><input requared name="type_answer_buttons_label[{$i}]" value="{$FIELDS->value}"></span></td>
        <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_STEP', $MODULE)}</label></td>
            <td><span clas="span10">
                    {include file=vtemplate_path('uitypes/SelectListSteps.tpl',$MODULE) NAME="type_answer_buttons_step_{$i}" }
                </span></td></tr>
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_COLOR', $MODULE)}</label></td>
            <td><span clas="span10">
                    {include file=vtemplate_path('uitypes/color.tpl',$MODULE) _name="type_answer_buttons_color[{$i}]" _value=""}
                </span></td>
                <td><select name="type_answer_buttons_stepExit"><option value="">Выход из скрипта в:</option><option value="Calendar" {if $field.stepExit eq 'Calendar'}selected{/if}>Календарь</option></select></td>
                <td><button type="button" class="btn addButton" data-current="{$i}" onClick="addAnswerBotton(this);"><strong>{vtranslate('LBL_TYPEANSWER_BUTTONS_ADD', $MODULE)}</strong></button>
                {if $i neq 1}<span class="span1" style="float:right;"><i class="icon-trash alignMiddle" onclick="deleteAnswerBotton(this);" title="Удалить"></i></span>{/if}
                </td>
        </tr>
    </table>
{/strip}