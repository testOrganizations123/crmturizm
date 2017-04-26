<?php /* Smarty version Smarty-3.1.7, created on 2017-01-31 21:39:14
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Leads/SummaryViewWidgets.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1629160558579f18e5f191f9-29240987%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddd69135729d4d20eaaf4e94b5f3c45cdd0387e2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Leads/SummaryViewWidgets.tpl',
      1 => 1485887943,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1629160558579f18e5f191f9-29240987',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579f18e60139c',
  'variables' => 
  array (
    'READONLY' => 0,
    'SUMMARY_RECORD_STRUCTURE' => 0,
    'FIELD_MODEL' => 0,
    'MODULE_NAME' => 0,
    'FIELD_NAME' => 0,
    'TYPEUSER' => 0,
    'ERRORIN' => 0,
    'ERROR' => 0,
    'USER_MODEL' => 0,
    'RECORD' => 0,
    'IS_AJAX_ENABLED' => 0,
    'CURRENT_VIEW' => 0,
    'CURRENT_MODE_LABEL' => 0,
    'FULL_MODE_URL' => 0,
    'DETAILVIEW_LINKS' => 0,
    'DETAIL_VIEW_WIDGET' => 0,
    'ADDTEXTINFO' => 0,
    'LinkScript' => 0,
    'RELATED_ACTIVITIES' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579f18e60139c')) {function content_579f18e60139c($_smarty_tpl) {?>
<div class="row-fluid"><div class="<?php if ($_smarty_tpl->tpl_vars['READONLY']->value!=1){?>span7<?php }else{ ?>span12<?php }?>"><div class="summaryView row-fluid"><div class="recordDetails"><table class="summary-table" style="width:100%;"><tbody><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUMMARY_RECORD_STRUCTURE']->value['SUMMARY_FIELDS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')!='modifiedtime'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')!='createdtime'){?><tr class="summaryViewEntries"><td class="fieldLabel" style="width:35%"><label class="muted"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td class="fieldValue" style="width:65%"><div class="row-fluid"><span class="value" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='19'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='20'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='21'){?>style="word-wrap: break-word;"<?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='checks'&&$_smarty_tpl->tpl_vars['TYPEUSER']->value=='owner'&&$_smarty_tpl->tpl_vars['ERRORIN']->value){?><?php echo $_smarty_tpl->tpl_vars['ERRORIN']->value[0]['description'];?>
<br /><?php  $_smarty_tpl->tpl_vars['ERROR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ERROR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ERRORIN']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->key => $_smarty_tpl->tpl_vars['ERROR']->value){
$_smarty_tpl->tpl_vars['ERROR']->_loop = true;
?><b><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['name'];?>
</b>: <i><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['message'];?>
</i><br /><?php } ?><span class="pull-right"><a ><a onclick="foulFix()">Исправить</a></span><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='checks'&&$_smarty_tpl->tpl_vars['TYPEUSER']->value=='smowner'){?><?php echo $_smarty_tpl->tpl_vars['ERRORIN']->value[0][0]['description'];?>
<br /><?php  $_smarty_tpl->tpl_vars['ERROR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ERROR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ERRORIN']->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->key => $_smarty_tpl->tpl_vars['ERROR']->value){
$_smarty_tpl->tpl_vars['ERROR']->_loop = true;
?><b><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['name'];?>
</b>: <i><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['message'];?>
</i><br /><?php } ?><span class="pull-right"><a ><a onclick="foulReady()">Замечание</a></span><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='checks'&&$_smarty_tpl->tpl_vars['TYPEUSER']->value=='smcreator'){?><?php echo $_smarty_tpl->tpl_vars['ERRORIN']->value[0][0]['description'];?>
<br /><?php  $_smarty_tpl->tpl_vars['ERROR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ERROR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ERRORIN']->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->key => $_smarty_tpl->tpl_vars['ERROR']->value){
$_smarty_tpl->tpl_vars['ERROR']->_loop = true;
?><b><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['name'];?>
</b>: <i><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['message'];?>
</i><br /><?php } ?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='checks'){?>Нет<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getDetailViewTemplateName()), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'RECORD'=>$_smarty_tpl->tpl_vars['RECORD']->value), 0);?>
<?php }?></span><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable()=='true'&&($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()!=Vtiger_Field_Model::REFERENCE_TYPE)&&$_smarty_tpl->tpl_vars['IS_AJAX_ENABLED']->value&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isAjaxEditable()=='true'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!=69&&$_smarty_tpl->tpl_vars['READONLY']->value==0){?><?php if (($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='rating'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')=='Скидочник')||($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='leadstatus'&&trim($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'))=='Готов купить тур')){?><?php $_smarty_tpl->tpl_vars['ADDTEXTINFO'] = new Smarty_variable('При приезде туриста повторно, следует идти по скрипту "работа с туристом-скидочником с шага "Готов купить тур"', null, 0);?><?php $_smarty_tpl->tpl_vars['LinkScript'] = new Smarty_variable(466383, null, 0);?><?php }elseif(($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='leadstatus'&&trim($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'))=='в другом агентстве дешевле')){?><?php $_smarty_tpl->tpl_vars['ADDTEXTINFO'] = new Smarty_variable('Переход на скрипт "а в другом агентстве дешевле" - узнайте цену (исх)"', null, 0);?><?php $_smarty_tpl->tpl_vars['LinkScript'] = new Smarty_variable(176, null, 0);?><?php }elseif(($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='leadstatus'&&trim($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'))=='Контекст')){?><?php $_smarty_tpl->tpl_vars['ADDTEXTINFO'] = new Smarty_variable('Переход на скрипт  "Выберите контекст (исх)"', null, 0);?><?php $_smarty_tpl->tpl_vars['LinkScript'] = new Smarty_variable(195, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='checks'){?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')==1){?><?php if ($_smarty_tpl->tpl_vars['TYPEUSER']->value=='owner'&&$_smarty_tpl->tpl_vars['ERRORIN']->value){?><?php }?><?php }?><?php }else{ ?><span class="hide edit"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='multipicklist'){?><input type="hidden" class="fieldname" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
[]" data-prev-value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
" /><?php }else{ ?><input type="hidden" class="fieldname" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
' /><?php }?></span><span class="summaryViewEdit cursorPointer pull-right">&nbsp;<i class="icon-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></span><?php }?><?php }?></div></td></tr><?php }?><?php } ?></tbody></table><hr><div class="row-fluid"><div class="span4 toggleViewByMode"><?php if ($_smarty_tpl->tpl_vars['READONLY']->value==0){?><?php $_smarty_tpl->tpl_vars["CURRENT_VIEW"] = new Smarty_variable("full", null, 0);?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate('LBL_COMPLETE_DETAILS',$_tmp1);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["CURRENT_MODE_LABEL"] = new Smarty_variable($_tmp2, null, 0);?><button type="button" class="btn changeDetailViewMode cursorPointer"><strong><?php echo vtranslate('LBL_SHOW_FULL_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></button><?php ob_start();?><?php echo ($_smarty_tpl->tpl_vars['RECORD']->value->getDetailViewUrl()).('&mode=showDetailViewByMode&requestMode=full');?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["FULL_MODE_URL"] = new Smarty_variable($_tmp3, null, 0);?><input type="hidden" name="viewMode" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_VIEW']->value;?>
" data-nextviewname="full" data-currentviewlabel="<?php echo $_smarty_tpl->tpl_vars['CURRENT_MODE_LABEL']->value;?>
"data-full-url="<?php echo $_smarty_tpl->tpl_vars['FULL_MODE_URL']->value;?>
"  /><?php }?></div><div class="span8"><div class="pull-right"><div><p><small><?php echo vtranslate('LBL_CREATED_ON',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RECORD']->value->get('createdtime'));?>
</small></p></div><div><p><small><?php echo vtranslate('LBL_MODIFIED_ON',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RECORD']->value->get('modifiedtime'));?>
</small></p></div></div></div></div></div></div><?php  $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWWIDGET']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['count']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->key => $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value){
$_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['count']['index']++;
?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['count']['index']%2==0){?><div class="summaryWidgetContainer"><div class="widgetContainer_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['count']['index'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel();?>
"><div class="widget_header row-fluid"><span class="span8 margin0px"><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel(),'Leads');?>
</h4></span></div><div class="widget_contents"></div></div></div><?php }?><?php } ?></div><div class="<?php if ($_smarty_tpl->tpl_vars['READONLY']->value!=1){?>span5<?php }else{ ?>hide<?php }?>" style="overflow: hidden"><div id="relatedActivities"><?php if ($_smarty_tpl->tpl_vars['ADDTEXTINFO']->value){?><div class='summaryWidgetContainer'><h4 ><?php echo $_smarty_tpl->tpl_vars['ADDTEXTINFO']->value;?>
</h4><br /><a class="btn btn-success" href="index.php?module=VDDialogueDesigner&view=RunScript&record=<?php echo $_smarty_tpl->tpl_vars['LinkScript']->value;?>
&leadid=<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
">Начать скрипт</a></div><?php }?><?php if ($_smarty_tpl->tpl_vars['READONLY']->value!=1){?><?php echo $_smarty_tpl->tpl_vars['RELATED_ACTIVITIES']->value;?>
<?php }?></div><?php  $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWWIDGET']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['count']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->key => $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value){
$_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['count']['index']++;
?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['count']['index']%2!=0){?><div class="summaryWidgetContainer"><div class="widgetContainer_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['count']['index'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel();?>
"><div class="widget_header row-fluid"><span class="span8 margin0px"><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></span></div><div class="widget_contents"></div></div></div><?php }?><?php } ?></div></div><?php }} ?>