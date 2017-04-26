{*<!--
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ('License'); You may not use this file except in compliance with the License
 * The Original Code is: EntExt
 * The Initial Developer of the Original Code is EntExt.
 * All Rights Reserved.
 * If you have any questions or comments, please email: devel@entext.com
 ************************************************************************************/
-->*}
{ldelim}
"qustion":"{strip}
          <div class='span7' id='step-{$RECORD}' style='margin-left:0'>
              <input type='hidden' id='type_answer-{$RECORD}' value='{$RECORD_MODEL.type_answer}' />
              <div class='searchResult'>
                  {if count($SEARCHRESULT) > 0}
                      <table class='table table-hover table-responsive table-striped'>
                          <tr><td>Выбрать</td><td>Дата назначения задачи</td><td colspan='2'>Менеджер</td><td></td></tr>
                          {foreach item=leads from=$SEARCHRESULT}
                              <tr><td><input type='radio' value='{$leads.leadid}' name='leadid' {if count($SEARCHRESULT) eq 1}checked{/if}></td>
                                   <td>{date('d.m.y', strtotime($leads.due_date))}<br />{date('H:i', strtotime($leads.time_end))}</td>
                             <td><span class='label label-success'>Заявка</span><br><small>от {date('d.m.y', strtotime($leads.datecreate))}</small></td>
                               <td>{$leads.owner}{if $leads.oldowner neq ''}<br><small>Передано от: <br>{$leads.oldowner}</small>{/if}<br />{vtranslate($leads.status, 'Calendar')}</td>
                               <td class='right nowrap'>
            <a data-record='{$leads.leadid}' onclick='openLeads(this)' class='btn btn-xs btn-warning' title='Посмотреть' target='_blank'><i class='fa fa-pencil'></i></a>                                                    
        </td> </tr>
                          {/foreach}
                      </table>
                  {else}
                      <h2>Заявка не найдена!!!</h2>
                  {/if}
              </div>
              <div class='dataContentDialogue'>
                  {if $RECORD_MODEL.dialogue neq ''}
              <div class='padding1per ' style='border:1px solid #ccc;background: #b9fbac;padding: 20px 15px 12px; margin-bottom:20px;'>
                  <div class='DialogueDesigner_ques'>
                        <p>{$RECORD_MODEL.dialogue}</p>
                    </div>
                  </div>{/if}
                    {if $RECORD_MODEL.description neq ''}
                         <div class='DialogueDesigner_disc' style='border:1px solid #ccc;background: #f1f1f1;padding: 20px 15px 12px; margin-bottom:20px;'>
                        <p>{$RECORD_MODEL.description}</p>
                    </div>
                    {/if}
                {if $RECORD_MODEL.type_answer eq 'Module'}
                     {assign var=SOURCE_MODULE value=$RECORD_MODEL.fields.name}
                     
                    <div class='padding1per row-fluid' style='border:1px solid #ccc;background: #caf0fe;padding: 20px 15px 12px;margin-bottom:20px;width:auto;'>
                       
                        {foreach key=FIELD_NAME item=FIELD_MODEL from=$RECORD_MODEL.fieldsModels name=blockfields}
                             {if $RECORD_MODEL.default.$FIELD_NAME eq ''}
                            {if $FIELD_MODEL->getUITypeModel()->getTemplateName() eq 'uitypes/Picklist.tpl' and $RECORD_MODEL.default.$FIELD_NAME neq ''}
                                <input type='hidden' name='{$FIELD_NAME}' value='{$RECORD_MODEL.default.$FIELD_NAME}' />
                                {else}
                            <div class='control-group {if $FIELD_MODEL->get('uitype') eq "19"}span12{else}span6{/if}' style='margin-left:0'>
                                     <label from='choiceForm' class='control-label'>  {vtranslate($FIELD_MODEL->get('label'), $SOURCE_MODULE)}</label>
                                     <div class='controls'>
                                         <input name='label-{$FIELD_MODEL->getFieldName()}' value='{vtranslate($FIELD_MODEL->get('label'), $SOURCE_MODULE)}' type='hidden'/>
                                         {if $FIELD_MODEL->getFieldName() eq 'date_start'}
                                         {include file=vtemplate_path('uitypes/DateTime.tpl', $SOURCE_MODULE) BLOCK_FIELDS=$BLOCK_FIELDS MODULE_NAME=$SOURCE_MODULE RECORD_STRUCTURE_MODEL=$RECORD_MODEL.moduleModels}
                                         
                                         {else}
                                             
                                        {include file=vtemplate_path($FIELD_MODEL->getUITypeModel()->getTemplateName(), $SOURCE_MODULE) BLOCK_FIELDS=$BLOCK_FIELDS MODULE_NAME=$SOURCE_MODULE MODULE_MODEL=$RECORD_MODEL.moduleModels MODE='VDDialogueDesigner'}
                                     {/if}
                                         </div>
                                </div>
                              {/if}
                              {else}
                                 <input type='hidden' name='{$FIELD_NAME}' value='{$RECORD_MODEL.default.$FIELD_NAME}' />
                                 {/if}
                            {/foreach}
                            
                    </div>
                 {else if $RECORD_MODEL.type_answer eq 'ModuleDefault'}
                     {assign var=SOURCE_MODULE value=$RECORD_MODEL.fields.name}
                     {foreach key=FIELD_NAME item=FIELD_MODEL from=$RECORD_MODEL.fieldsModels name=blockfields}
                          <input type='hidden' name='{$FIELD_NAME}' value='{$RECORD_MODEL.default.$FIELD_NAME}' />
                         {/foreach}
                     
                {else if $RECORD_MODEL.type_answer eq 'String' or $RECORD_MODEL.type_answer eq 'LongString'}
                    {if $RECORD_MODEL.type_answer eq 'String' and $RECORD_MODEL.answer.name neq ''}
                        <input class='dialogueData spanFull' name='{$RECORD_MODEL.answer.name}' />
                    {else if $RECORD_MODEL.answer.name neq ''}
                        <textarea class='dialogueData spanFull' rowspan='5' name='{$RECORD_MODEL.answer.name}'></textarea>
                    {/if}
                {/if}
                {if $RECORD_MODEL.type eq 'Save'}
                   <input type='hidden' name='module' value='Leads' />
                   <input type='hidden' name='action' value='Save' />
                   <input type='hidden' name='record' value='' />
                   <input type='submit' value='Сохранить' class='btn btn-large btn-success' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;' />
                {else if $RECORD_MODEL.type eq 'Exit'}
                    <a class='btn btn-large btn-success'  onclick='VDDialogueDesignerExit();false' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;'>{vtranslate('Выход из скрипта', $MODULE)}</a>
                {else if $RECORD_MODEL.type_answer eq 'Search'}
               
                         <a class='btn btn-large btn-success' onclick='VDDialogueDesignerNextStepSearch(this);false;' data-url='{$RECORD_MODEL.step}' data-record = "{$RECORD}" style="width: 100%;box-sizing: border-box;">{vtranslate('Найти', $MODULE)}</a>
                
                {else if $RECORD_MODEL.type_answer neq 'Buttons'}
                         <a class='btn btn-large btn-success' onclick='VDDialogueDesignerNextStep(this);false;' data-url='{$RECORD_MODEL.step}' data-record = '{$RECORD}' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;'>{vtranslate('Далее', $MODULE)}</a>
                {else}
                    {foreach item=BUTTON from=$RECORD_MODEL.fields}
                         <a class='btn btn-large btn-{$BUTTON.color}' onclick='VDDialogueDesignerNextStep(this);false;' data-url='{$BUTTON.step}' {if $BUTTON.stepExit}data-exit='{$BUTTON.stepExit}'{/if} data-record = '{$RECORD}' data-answer ='{$BUTTON.label}' style='width: 100%; margin-bottom: 20px;box-sizing: border-box;'>{$BUTTON.label}</a>
                       
                    {/foreach}
                {/if}
               </div>
               <a class='btn btn-large' onclick='VDDialogueDesignerBackStep(this);false;' data-backstep = '{$backstep}' data-record = '{$RECORD}' style='margin-bottom: 20px;'>{vtranslate('Назад', $MODULE)}</a><br />
               <br />
            <hr />
           <a class='btn' data-name='{$RECORD_MODEL.dialog_name}' data-script='{$RECORD}' onClick='newSuggections(event,this)'>Замечание и предложение по работе скрипта</a>
                  <br />
               <br />
                  </div>
          {/strip}",
"answer":"{strip}{if $clientAnswer neq ''}
          <small><strong>Клиент:</strong> <span class='question'>{$clientAnswer}</span></small>
          {/if}
        {/strip}",
"newqustion":"{strip}<div id='historyStep-{$RECORD}'>{if $RECORD_MODEL.dialogue neq ''}<hr />
                    
                    <small><strong>Вы:</strong> <span class='question'>{$RECORD_MODEL.dialogue}</span></small>
                    <hr />
                        <span id='answerHistory-{$RECORD}'></span>
                 {/if}  
                </div>{/strip}",
"header":"{strip}<span id='nameStep-{$RECORD}'>{$RECORD_MODEL.dialog_name}</span>{/strip}"
{rdelim}