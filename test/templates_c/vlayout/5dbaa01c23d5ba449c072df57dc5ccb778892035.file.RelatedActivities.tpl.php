<?php /* Smarty version Smarty-3.1.7, created on 2016-10-31 15:39:41
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/RelatedActivities.tpl" */ ?>
<?php /*%%SmartyHeaderCode:488712345787ae4dc70c60-78633179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5dbaa01c23d5ba449c072df57dc5ccb778892035' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Vtiger/RelatedActivities.tpl',
      1 => 1477917553,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '488712345787ae4dc70c60-78633179',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5787ae4dd7e08',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'ACTIVITIES' => 0,
    'RECORD' => 0,
    'START_DATE' => 0,
    'START_TIME' => 0,
    'FIELD_MODEL' => 0,
    'USER_MODEL' => 0,
    'EDITVIEW_PERMITTED' => 0,
    'RECORDID' => 0,
    'PAGING_MODEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787ae4dd7e08')) {function content_5787ae4dd7e08($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable("Calendar", null, 0);?><div  class="summaryWidgetContainer"><div class="widget_header row-fluid"><span class="span8"><h4 class="textOverflowEllipsis"><?php echo vtranslate('LBL_TASK',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></span></div><div class="widget_contents"><?php if (count($_smarty_tpl->tpl_vars['ACTIVITIES']->value)!='0'){?><?php  $_smarty_tpl->tpl_vars['RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORD']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ACTIVITIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->key => $_smarty_tpl->tpl_vars['RECORD']->value){
$_smarty_tpl->tpl_vars['RECORD']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['RECORD']->key;
?><?php $_smarty_tpl->tpl_vars['START_DATE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->get('date_start'), null, 0);?><?php $_smarty_tpl->tpl_vars['START_TIME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->get('time_start'), null, 0);?><?php $_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED'] = new Smarty_variable(isPermitted('Calendar','EditView',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')), null, 0);?><?php $_smarty_tpl->tpl_vars['DETAILVIEW_PERMITTED'] = new Smarty_variable(isPermitted('Calendar','DetailView',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')), null, 0);?><div class="activityEntries"><input type="hidden" class="activityId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activityid');?>
"/><div class="row-fluid"><span class="span6"><strong title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString(($_smarty_tpl->tpl_vars['START_DATE']->value)." ".($_smarty_tpl->tpl_vars['START_TIME']->value));?>
"><?php echo Vtiger_Util_Helper::formatDateIntoStrings($_smarty_tpl->tpl_vars['START_DATE']->value,$_smarty_tpl->tpl_vars['START_TIME']->value);?>
</strong></span><div class="activityStatus span6"><?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype')=='Task'){?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getModuleName(), null, 0);?><input type="hidden" class="activityModule" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getModuleName();?>
"/><input type="hidden" class="activityType" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype');?>
"/><div class="pull-right"><strong><span class="value"><?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('status'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></strong>&nbsp&nbsp;<span class="editStatus cursorPointer"><i class="icon-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></span><span class="edit hide"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getModule()->getField('taskstatus'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['RECORD']->value->get('status')), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'OCCUPY_COMPLETE_WIDTH'=>'true'), 0);?>
<input type="hidden" class="fieldname" value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
' /></span></div></div><?php }else{ ?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable("Events", null, 0);?><input type="hidden" class="activityModule" value="Events"/><input type="hidden" class="activityType" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype');?>
"/><?php if ($_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED']->value=='yes'){?><div class="pull-right"><strong><span class="value"><?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('eventstatus'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></strong>&nbsp&nbsp;</div><?php }?></div><?php }?></div><div class="summaryViewEntries"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
&nbsp;-&nbsp;<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('description');?>
</div></div><hr><?php } ?><form class="form-horizontal" action="index.php" method="POST" name="newEventForm"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" name="recordEvents" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" name="record" /><input type="hidden" value="Save" name="action" /><input type="hidden" value="newEvents" name="mode" /><input name="module" value="Leads" type="hidden"><div class=""><label>Что сделано по предыдущей задаче?<span class="redColor">*</span></label><textarea name="oldEvent" required></textarea></div><div class=""><label>Новая задача<span class="redColor">*</span></label><textarea name="newEvent" required></textarea></div><div class=""><label>Дата выполнения<span class="redColor">*</span></label><div class="row-fluid"><span class="span10"><div><div class="input-append row-fluid"><div class="span12 row-fluid date"><input id="Events_editView_fieldName_date_start" required class="dateField" name="date_start" data-date-format="dd.mm.yyyy" value="" data-validation-engine="validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"  type="text"><span class="add-on"><i class="icon-calendar"></i></span></div></div></div><div><div class="input-append time"><input required autocomplete="off" id="Events_editView_fieldName_time_start" data-format="24" class="timepicker-default input-small ui-timepicker-input" value="" name="time_start" data-validation-engine="validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" type="text"><span class="add-on cursorPointer"><i class="icon-time"></i></span></div></div></span></div></div><div class=""><label>Приоритет<span class="redColor">*</span></label><select required class="chzn-select" name="taskpriority" data-validation-engine="validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" data-selected-value=""><option value="">Выберите опцию</option><option value="High">Высокий</option><option value="Kmidle">Средний</option><option value="Low">Низкий</option></select></div><br /><div class=""><label>Статус<span class="redColor">*</span></label><select required class="chzn-select" name="eventstatus" data-validation-engine="validate[ required,funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" ><option value="">Выберите опцию</option><option value="Planned" selected="">В работе</option><option value="Отказ">Отказ</option><option value="Продажа">Продажа</option><option value="Новая">Новая</option></select></div><br /><input type="submit" value="Сохранить" class="btn btn-success" /></form><?php }else{ ?><div class="summaryWidgetContainer"><p class="textAlignCenter"><?php echo vtranslate('LBL_NO_PENDING_ACTIVITIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</p></div><?php }?><?php if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()){?><div class="row-fluid"><div class="pull-right"><a href="javascript:void(0)" class="moreRecentActivities"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
..</a></div></div><?php }?></div></div>
<?php }} ?>