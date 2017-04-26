<?php /* Smarty version Smarty-3.1.7, created on 2016-11-19 22:12:02
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/RunScriptAjaxSearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98526382958170386876d41-36840065%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a8db2fb482d0c75843dea06485994c273a617242' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/RunScriptAjaxSearch.tpl',
      1 => 1479582711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98526382958170386876d41-36840065',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5817038691681',
  'variables' => 
  array (
    'RECORD' => 0,
    'RECORD_MODEL' => 0,
    'SEARCHRESULT' => 0,
    'leads' => 0,
    'FIELD_NAME' => 0,
    'FIELD_MODEL' => 0,
    'SOURCE_MODULE' => 0,
    'BLOCK_FIELDS' => 0,
    'MODULE' => 0,
    'BUTTON' => 0,
    'backstep' => 0,
    'clientAnswer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5817038691681')) {function content_5817038691681($_smarty_tpl) {?>
{
"qustion":"<div class='span7' id='step-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' style='margin-left:0'><input type='hidden' id='type_answer-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer'];?>
' /><div class='searchResult'><?php if (count($_smarty_tpl->tpl_vars['SEARCHRESULT']->value)>0){?><table class='table table-hover table-responsive table-striped'><tr><td>Выбрать</td><td>Дата назначения задачи</td><td colspan='2'>Менеджер</td><td></td></tr><?php  $_smarty_tpl->tpl_vars['leads'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['leads']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['SEARCHRESULT']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['leads']->key => $_smarty_tpl->tpl_vars['leads']->value){
$_smarty_tpl->tpl_vars['leads']->_loop = true;
?><tr><td><input type='radio' value='<?php echo $_smarty_tpl->tpl_vars['leads']->value['leadid'];?>
' name='leadid' <?php if (count($_smarty_tpl->tpl_vars['SEARCHRESULT']->value)==1){?>checked<?php }?>></td><td><?php echo date('d.m.y',strtotime($_smarty_tpl->tpl_vars['leads']->value['due_date']));?>
<br /><?php echo date('H:i',strtotime($_smarty_tpl->tpl_vars['leads']->value['time_end']));?>
</td><td><span class='label label-success'>Заявка</span><br><small>от <?php echo date('d.m.y',strtotime($_smarty_tpl->tpl_vars['leads']->value['datecreate']));?>
</small></td><td><?php echo $_smarty_tpl->tpl_vars['leads']->value['owner'];?>
<?php if ($_smarty_tpl->tpl_vars['leads']->value['oldowner']!=''){?><br><small>Передано от: <br><?php echo $_smarty_tpl->tpl_vars['leads']->value['oldowner'];?>
</small><?php }?><br /><?php echo vtranslate($_smarty_tpl->tpl_vars['leads']->value['status'],'Calendar');?>
</td><td class='right nowrap'><a data-record='<?php echo $_smarty_tpl->tpl_vars['leads']->value['leadid'];?>
' onclick='openLeads(this)' class='btn btn-xs btn-warning' title='Посмотреть' target='_blank'><i class='fa fa-pencil'></i></a></td> </tr><?php } ?></table><?php }else{ ?><h2>Заявка не найдена!!!</h2><?php }?></div><div class='dataContentDialogue'><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialogue']!=''){?><div class='padding1per ' style='border:1px solid #ccc;background: #b9fbac;padding: 20px 15px 12px; margin-bottom:20px;'><div class='DialogueDesigner_ques'><p><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialogue'];?>
</p></div></div><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['description']!=''){?><div class='DialogueDesigner_disc' style='border:1px solid #ccc;background: #f1f1f1;padding: 20px 15px 12px; margin-bottom:20px;'><p><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['description'];?>
</p></div><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='Module'){?><?php $_smarty_tpl->tpl_vars['SOURCE_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fields']['name'], null, 0);?><div class='padding1per row-fluid' style='border:1px solid #ccc;background: #caf0fe;padding: 20px 15px 12px;margin-bottom:20px;width:auto;'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fieldsModels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value]==''){?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName()=='uitypes/Picklist.tpl'&&$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value]!=''){?><input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value];?>
' /><?php }else{ ?><div class='control-group <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="19"){?>span12<?php }else{ ?>span6<?php }?>' style='margin-left:0'><label from='choiceForm' class='control-label'>  <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</label><div class='controls'><input name='label-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' value='<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
' type='hidden'/><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName()=='date_start'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/DateTime.tpl',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,'RECORD_STRUCTURE_MODEL'=>$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['moduleModels']), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,'MODULE_MODEL'=>$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['moduleModels'],'MODE'=>'VDDialogueDesigner'), 0);?>
<?php }?></div></div><?php }?><?php }else{ ?><input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value];?>
' /><?php }?><?php } ?></div><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='ModuleDefault'){?><?php $_smarty_tpl->tpl_vars['SOURCE_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fields']['name'], null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fieldsModels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value];?>
' /><?php } ?><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='String'||$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='LongString'){?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='String'&&$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name']!=''){?><input class='dialogueData spanFull' name='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name'];?>
' /><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name']!=''){?><textarea class='dialogueData spanFull' rowspan='5' name='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name'];?>
'></textarea><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type']=='Save'){?><input type='hidden' name='module' value='Leads' /><input type='hidden' name='action' value='Save' /><input type='hidden' name='record' value='' /><input type='submit' value='Сохранить' class='btn btn-large btn-success' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;' /><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type']=='Exit'){?><a class='btn btn-large btn-success'  onclick='VDDialogueDesignerExit();false' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;'><?php echo vtranslate('Выход из скрипта',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='Search'){?><a class='btn btn-large btn-success' onclick='VDDialogueDesignerNextStepSearch(this);false;' data-url='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['step'];?>
' data-record = "<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" style="width: 100%;box-sizing: border-box;"><?php echo vtranslate('Найти',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']!='Buttons'){?><a class='btn btn-large btn-success' onclick='VDDialogueDesignerNextStep(this);false;' data-url='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['step'];?>
' data-record = '<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;'><?php echo vtranslate('Далее',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['BUTTON'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BUTTON']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BUTTON']->key => $_smarty_tpl->tpl_vars['BUTTON']->value){
$_smarty_tpl->tpl_vars['BUTTON']->_loop = true;
?><a class='btn btn-large btn-<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['color'];?>
' onclick='VDDialogueDesignerNextStep(this);false;' data-url='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['step'];?>
' <?php if ($_smarty_tpl->tpl_vars['BUTTON']->value['stepExit']){?>data-exit='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['stepExit'];?>
'<?php }?> data-record = '<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' data-answer ='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['label'];?>
' style='width: 100%; margin-bottom: 20px;box-sizing: border-box;'><?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['label'];?>
</a><?php } ?><?php }?></div><a class='btn btn-large' onclick='VDDialogueDesignerBackStep(this);false;' data-backstep = '<?php echo $_smarty_tpl->tpl_vars['backstep']->value;?>
' data-record = '<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' style='margin-bottom: 20px;'><?php echo vtranslate('Назад',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><br /><br /><hr /><a class='btn' data-name='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialog_name'];?>
' data-script='<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' onClick='newSuggections(event,this)'>Замечание и предложение по работе скрипта</a><br /><br /></div>",
"answer":"<?php if ($_smarty_tpl->tpl_vars['clientAnswer']->value!=''){?><small><strong>Клиент:</strong> <span class='question'><?php echo $_smarty_tpl->tpl_vars['clientAnswer']->value;?>
</span></small><?php }?>",
"newqustion":"<div id='historyStep-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
'><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialogue']!=''){?><hr /><small><strong>Вы:</strong> <span class='question'><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialogue'];?>
</span></small><hr /><span id='answerHistory-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
'></span><?php }?></div>",
"header":"<span id='nameStep-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialog_name'];?>
</span>"
}<?php }} ?>