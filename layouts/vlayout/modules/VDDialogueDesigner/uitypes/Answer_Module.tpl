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
       
    <table class="table table-bordered blockContainer showInlineTable equalSplit" >
        
        <tr><td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_MODULE_LABEL', $MODULE)}</label></td>
            <td><span clas="span10">
                    <select class="chzn-select"  name="type_answer_module_name" onchange="getModuleFields(this);">
                <option value="">{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>
							<optgroup>
								{foreach key=RELATED_MODULE_KEY item=RELATED_MODULE from=$MODULELIST}
									<option value="{$RELATED_MODULE_KEY}" 
                                                                                {if $RELATED_MODULE_KEY eq $fields.name} selected {/if}>
										{vtranslate($RELATED_MODULE_KEY,$RELATED_MODULE_KEY)}
									</option>
								{/foreach}
							</optgroup>
						</select>
            </span></td>
        <td><label class="muted pull-right marginRight10px">{vtranslate('LBL_TYPEANSWER_BUTTONS_STEP', $MODULE)}</label></td>
            <td><span clas="span10">
                    {include file=vtemplate_path('uitypes/SelectListSteps.tpl',$MODULE) NAME="type_answer_module_step" VALUE=$fields.step DISPLAYVALUE = $FIELD_MODEL->getStepName($fields.step)}
                </span></td></tr>
          {if $fields.name eq ''}
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


{/strip}