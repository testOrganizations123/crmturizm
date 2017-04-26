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
    {assign var = c value= count($fields)}
        {assign var = i value= 0}
        
        {foreach $fields as $field}
            
            {assign var = i value= $i+1}
    <table class="table table-bordered blockContainer showInlineTable equalSplit" >
        
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_LABEL', $MODULE)}</label></td>
            <td><span clas="span10"><input requared name="type_answer_buttons_label[{$i}]" value='{$field.label}'></span></td>
        <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_STEP', $MODULE)}</label></td>
            <td><span clas="span10">
                    {include file=vtemplate_path('uitypes/SelectListSteps.tpl',$MODULE) NAME="type_answer_buttons_step_{$i}" VALUE=$field.step DISPLAYVALUE = $FIELD_MODEL->getStepName($field.step)}
                </span></td></tr>
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_COLOR', $MODULE)}</label></td>
            <td><span clas="span10">
                    {include file=vtemplate_path('uitypes/color.tpl',$MODULE) _name="type_answer_buttons_color[{$i}]" _value=$field.color}
                </span></td>
                <td><select name="type_answer_buttons_stepExit[{$i}]"><option value="">Выход из скрипта в:</option><option value="Calendar" {if trim(decode_html($field.stepExit)) eq 'Calendar'}selected{/if}>Календарь</option></select></td>
                <td><button type="button" class="btn addButton {if $c neq $i}hide{/if}" data-current="{$i}" onClick="addAnswerBotton(this);"><strong>{vtranslate('LBL_TYPEANSWER_BUTTONS_ADD', $MODULE)}</strong></button>
                {if $i neq 1}<span class="span1" style="float:right;"><i class="icon-trash alignMiddle" onclick="deleteAnswerBotton(this);" title="Удалить"></i></span>{/if}</td>
        </tr>
       
    </table>
          {/foreach}


{/strip}