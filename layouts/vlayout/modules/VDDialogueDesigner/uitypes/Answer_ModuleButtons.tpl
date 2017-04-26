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
    {assign var = c value= count($fields.module.fields)}
       
    <table class="table table-bordered blockContainer showInlineTable equalSplit" >
        
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_MODULE_LABEL', $MODULE)}</label></td>
            <td><span clas="span10">
                    <select class="chzn-select"  name="type_answer_module_name" onchange="getModuleFields(this);">
                <option value="">{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
							<optgroup>
								{foreach key=RELATED_MODULE_KEY item=RELATED_MODULE from=$MODULELIST}
									<option value="{$RELATED_MODULE_KEY}" 
                                                                                {if $RELATED_MODULE_KEY eq $fields.module.module} selected {/if}>
										{vtranslate($RELATED_MODULE_KEY,$RELATED_MODULE_KEY)}
									</option>
								{/foreach}
							</optgroup>
						</select>
            </span></td>
        <td></td>
            <td><span clas="span10">
                    
                </span></td></tr>
          {if $fields.module.module eq ''}
            <tr id="moduleField">
        </tr>
        {else if count($CONDITION) eq 0}
        {assign var=$KEY value=1}
            <tr id="moduleField-{$KEY}">
                    {include file=vtemplate_path('uitypes/TypeAnswerModuleFields.tpl',$MODULE) }
                
        </tr>
       
        {else }
        {foreach key=KEY item=CONDITION_INFO from=$CONDITION }
        <tr id="moduleField-{$KEY}">
                    {include file=vtemplate_path('uitypes/TypeAnswerModuleFields.tpl',$MODULE) }
                
        </tr>
       {/foreach}
       {/if}
    </table>
     <button type="button" class="btn addButton pull-right" data-current="{$KEY}" onClick="addAnswerModule(this);"><strong>{vtranslate('LBL_TYPEANSWER_MODULE_ADD', $MODULE)}</strong></button>     
     {assign var = c value= count($fields.buttons)}
        {assign var = i value= 0}
        
        {foreach $fields.buttons as $field}
            
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