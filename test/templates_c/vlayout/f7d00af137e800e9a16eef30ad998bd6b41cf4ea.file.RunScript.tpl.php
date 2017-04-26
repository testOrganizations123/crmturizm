<?php /* Smarty version Smarty-3.1.7, created on 2016-11-23 11:34:49
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/RunScript.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33701689257960d61ae42a9-39280972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7d00af137e800e9a16eef30ad998bd6b41cf4ea' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/RunScript.tpl',
      1 => 1479890081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33701689257960d61ae42a9-39280972',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57960d61b1d31',
  'variables' => 
  array (
    'RECORD_MODEL' => 0,
    'CONTACT' => 0,
    'RECORD' => 0,
    'EXPRESS' => 0,
    'potentialid' => 0,
    'hideinput' => 0,
    'MODULE_MODEL' => 0,
    'key' => 0,
    'item' => 0,
    'name' => 0,
    'FIELD_NAME' => 0,
    'FIELD_MODEL' => 0,
    'SOURCE_MODULE' => 0,
    'BLOCK_FIELDS' => 0,
    'modName' => 0,
    'MODULE' => 0,
    'BUTTON' => 0,
    'otziv' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57960d61b1d31')) {function content_57960d61b1d31($_smarty_tpl) {?>
<script>$categoryVDDialogue = '<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['subject'];?>
';var inputDialogueDesigner = new Object();<?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['firstname']!=''){?>inputDialogueDesigner.firstname = '<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['midlename'];?>
';inputDialogueDesigner.departure_old = '<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1217'];?>
';inputDialogueDesigner.country_old = '<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['country_name'];?>
';inputDialogueDesigner.hotel_old = '<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1193'];?>
';<?php }?></script><div class="VDDialogueDesigner_container" style="padding-left: 3%;padding-right: 3%"><br /><br /><h2><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['subject'];?>
: <span id="nameStep-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialog_name'];?>
</span><span id="history" class="pull-right">История диалога</span></h2><hr /><form id="VDDialogueDesigner_container" name="EditView" method="post" action="index.php" enctype="multipart/form-data"><?php if ($_smarty_tpl->tpl_vars['EXPRESS']->value>0){?><input type='hidden' name='express' value='<?php echo $_smarty_tpl->tpl_vars['EXPRESS']->value;?>
' /><?php }?><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['firstname']!=''){?><input type='hidden' name='firstname' value='<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['firstname'];?>
' /><input type='hidden' name='departure_old' value='<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1217'];?>
'><input type='hidden' name='country_old' value='<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['country_name'];?>
'><input type='hidden' name='hotel_old' value='<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1193'];?>
'><?php }?><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value['mobile']!=''){?><input type='hidden' name='mobile' value='<?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['mobile'];?>
' /><?php }?><?php if ($_smarty_tpl->tpl_vars['potentialid']->value!=''){?><input type='hidden' name='potentialid' value='<?php echo $_smarty_tpl->tpl_vars['potentialid']->value;?>
' /><?php }?><div class="row-fluid"><div class="span7" id="step-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
"><input type='hidden' id="type_answer-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" value='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer'];?>
' /><div class="dataContentDialogue"><?php if ($_smarty_tpl->tpl_vars['hideinput']->value){?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->inputs; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['item']->key;
?><?php if ($_smarty_tpl->tpl_vars['key']->value=='cf_1464'){?><?php $_smarty_tpl->tpl_vars['otziv'] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value, null, 0);?><?php }?><input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
' /><?php } ?><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialogue']!=''){?><div class="padding1per " style="border:1px solid #ccc;background: #b9fbac;padding: 20px 15px 12px; margin-bottom:20px;"><div class="DialogueDesigner_ques"><p><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialogue'];?>
</p></div></div><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['description']!=''){?><div class="DialogueDesigner_disc" style="border:1px solid #ccc;background: #f1f1f1;padding: 20px 15px 12px; margin-bottom:20px;"><p><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['description'];?>
</p></div><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='Module'||$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='Search'){?><?php $_smarty_tpl->tpl_vars['SOURCE_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fields']['name'], null, 0);?><div class="padding1per " style="border:1px solid #ccc;background: #caf0fe;padding: 20px 15px 12px;margin-bottom:20px;"><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fieldsModels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value]==''&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='arrival_by'&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='departure_by'){?><div class="control-group"><label from="choiceForm" class="control-label">  <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</label><div class="controls"><input name='label-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' value='<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
' type='hidden'/><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='leadsource'){?><?php $_smarty_tpl->tpl_vars['modName'] = new Smarty_variable('VDDialogueDesigner', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['modName'] = new Smarty_variable($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value, null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='departure'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='arrival'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/DateRange.tpl','VDDialogueDesigner'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), 0);?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='night'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='night'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/Night.tpl','VDDialogueDesigner'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['modName']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,'MODE'=>'VDDialogueDesigner'), 0);?>
<?php }?></div></div><?php }else{ ?><input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value];?>
' /><?php }?><?php } ?></div><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='ModuleButtons'){?><?php $_smarty_tpl->tpl_vars['SOURCE_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fields']['module']['module'], null, 0);?><div class='padding1per row-fluid' style='border:1px solid #ccc;background: #caf0fe;padding: 20px 15px 12px;margin-bottom:20px;width:auto;'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fieldsModels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value]==''&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='arrival_by'&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='departure_by'){?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName()=='uitypes/Picklist.tpl'&&$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value]!=''){?><input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['default'][$_smarty_tpl->tpl_vars['FIELD_NAME']->value];?>
' /><?php }else{ ?><div class='control-group <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="19"){?>span12<?php }else{ ?>span6<?php }?>' style='margin-left:0'><label from='choiceForm' class='control-label'>  <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</label><div class='controls'><?php $_smarty_tpl->tpl_vars['field'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->inputs[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='description'&&$_smarty_tpl->tpl_vars['RECORD']->value==108){?><?php $_smarty_tpl->tpl_vars['field'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',current($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->inputs['description'])), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='description'){?><?php $_smarty_tpl->tpl_vars['field'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',''), null, 0);?><?php }?><input name='label-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
' value='<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
' type='hidden'/><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName()=='date_start'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/DateTime.tpl',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,'RECORD_STRUCTURE_MODEL'=>$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['moduleModels']), 0);?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='departure'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='arrival'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/DateRange.tpl','VDDialogueDesigner'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), 0);?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='night'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='cf_1352'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/Night.tpl','VDDialogueDesigner'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), 0);?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='leadsource'){?><?php $_smarty_tpl->tpl_vars['modName'] = new Smarty_variable('VDDialogueDesigner', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['modName'] = new Smarty_variable($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value, null, 0);?><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['modName']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,'MODULE_MODEL'=>$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['moduleModels'],'MODE'=>'VDDialogueDesigner'), 0);?>
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
' /><?php } ?><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='String'||$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='LongString'){?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='String'&&$_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name']!=''){?><input class="dialogueData spanFull" name="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name'];?>
" /><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name']!=''){?><textarea class="dialogueData spanFull" rowspan="5" name="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['answer']['name'];?>
"></textarea><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type']=='Save'){?><input type='hidden' name='module' value='Leads' /><input type='hidden' name='action' value='Save' /><input type='submit' value='Сохранить' class='btn btn-large btn-success' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;' /><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type']=='Exit'){?><a class='btn btn-large btn-success'  onclick='VDDialogueDesignerExit();false' style='width: 100%;box-sizing: border-box; margin-bottom: 20px;'><?php echo vtranslate('Выход из скрипта',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='Search'){?><a class='btn btn-large btn-success' onclick='VDDialogueDesignerNextStepSearch(this);false;' data-url='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['step'];?>
' data-record = "<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" style="width: 100%;box-sizing: border-box;"><?php echo vtranslate('Найти',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']=='ModuleButtons'){?><?php  $_smarty_tpl->tpl_vars['BUTTON'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BUTTON']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fields']['buttons']['buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BUTTON']->key => $_smarty_tpl->tpl_vars['BUTTON']->value){
$_smarty_tpl->tpl_vars['BUTTON']->_loop = true;
?><a class='btn btn-large btn-<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['color'];?>
' onclick='VDDialogueDesignerNextStep(this);false;' data-url='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['step'];?>
' <?php if ($_smarty_tpl->tpl_vars['BUTTON']->value['stepExit']){?>data-exit='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['stepExit'];?>
'<?php }?> data-record = '<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' data-answer ='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['label'];?>
' style='width: 100%; margin-bottom: 20px;box-sizing: border-box;'><?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['label'];?>
</a><?php } ?><?php }elseif($_smarty_tpl->tpl_vars['RECORD_MODEL']->value['type_answer']!='Buttons'){?><a class='btn btn-large btn-success' onclick='VDDialogueDesignerNextStep(this);false;' data-url='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['step'];?>
' data-record = "<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" style="width: 100%;box-sizing: border-box;"><?php echo vtranslate('Далее',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['BUTTON'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BUTTON']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BUTTON']->key => $_smarty_tpl->tpl_vars['BUTTON']->value){
$_smarty_tpl->tpl_vars['BUTTON']->_loop = true;
?><a class='btn btn-large btn-<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['color'];?>
' onclick='VDDialogueDesignerNextStep(this);false;' data-url='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['step'];?>
' <?php if ($_smarty_tpl->tpl_vars['BUTTON']->value['stepExit']){?>data-exit='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['stepExit'];?>
'<?php }?> data-answer='<?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['label'];?>
' data-record = "<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" style="width: 100%; margin-bottom: 20px;box-sizing: border-box;"><?php echo $_smarty_tpl->tpl_vars['BUTTON']->value['label'];?>
</a><?php } ?><?php }?></div><br /><hr /><a class='btn' data-name='<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialog_name'];?>
' data-script='<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
' onClick='newSuggections(event,this,$categoryVDDialogue)'>Замечание и предложение по работе скрипта</a></div><div class="span5"><?php if ($_smarty_tpl->tpl_vars['CONTACT']->value){?><div class="padding1per " style="border:1px solid #ccc;background: #f1f1f1;padding: 20px 15px 12px;margin-bottom:20px;"><div ><h3>Информация о предыдущем туре</h3><small>Прилетел: <?php echo date('d.m.Y H:i',strtotime($_smarty_tpl->tpl_vars['CONTACT']->value['cf_1219']));?>
<br />Имя клиента: <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['lastname'];?>
 <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['midlename'];?>
<br />Телефон клиента: <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['mobile'];?>
<br />Страна тура: <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['country_name'];?>
<br />Город тура: <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['resort'];?>
<br />Название отеля: <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1193'];?>
<br />Название оператора: <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['turoperator_name'];?>
<br />Количество ночей: <?php echo $_smarty_tpl->tpl_vars['CONTACT']->value['cf_1201'];?>
<br />Стоимость предыдущего тура: <?php echo number_format($_smarty_tpl->tpl_vars['CONTACT']->value['amount'],2,","," ");?>
 <br /></small><?php if ($_smarty_tpl->tpl_vars['otziv']->value){?>Отзыв: <?php echo $_smarty_tpl->tpl_vars['otziv']->value;?>
<?php }?></div></div><?php }?><div class="padding1per " style="border:1px solid #ccc;background: #f1f1f1;padding: 20px 15px 12px;margin-bottom:20px;"><div id="historyStep-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
"><small><strong>Вы:</strong> <span class="question"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value['dialogue'];?>
</span></small><hr /><span id='answerHistory-<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
'></span></div></div></div></div></form></div>

<style>
    .VDDialogueDesigner_container p {
        padding: 5px 10px;
        font-size:17px;
    }
</style>
    
    
    
    
<?php }} ?>