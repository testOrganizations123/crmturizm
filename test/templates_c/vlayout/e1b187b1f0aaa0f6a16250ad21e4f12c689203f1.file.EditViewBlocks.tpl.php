<?php /* Smarty version Smarty-3.1.7, created on 2017-02-03 10:25:39
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/EditViewBlocks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198687549457a6f7c29d5fd6-19957677%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1b187b1f0aaa0f6a16250ad21e4f12c689203f1' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/EditViewBlocks.tpl',
      1 => 1486106730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198687549457a6f7c29d5fd6-19957677',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57a6f7c2af941',
  'variables' => 
  array (
    'USER_MODEL' => 0,
    'PICKIST_DEPENDENCY_DATASOURCE' => 0,
    'MODULE' => 0,
    'IS_PARENT_EXISTS' => 0,
    'SPLITTED_MODULE' => 0,
    'RECORD_ID' => 0,
    'IS_RELATION_OPERATION' => 0,
    'SOURCE_MODULE' => 0,
    'SOURCE_RECORD' => 0,
    'MODE' => 0,
    'VALIDATION_DATA_FIELDNAME' => 0,
    'VALIDATION_DATA_FIELDLABEL' => 0,
    'VALIDATION_DATA_FIELDDATATYPE' => 0,
    'ID' => 0,
    'SINGLE_MODULE_NAME' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'ERROREDIT' => 0,
    'ERRORBUTTON' => 0,
    'TYPEUSER' => 0,
    'ERRORIN' => 0,
    'ERROR' => 0,
    'RECORD_STRUCTURE' => 0,
    'opportunity_type' => 0,
    'BLOCK_LABEL' => 0,
    'iblock' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_NAME' => 0,
    'FIELD_MODEL' => 0,
    'COUNTER' => 0,
    'WIDTHTYPE' => 0,
    'isReferenceField' => 0,
    'REFERENCE_LIST' => 0,
    'REFERENCE_LIST_COUNT' => 0,
    'DISPLAYID' => 0,
    'REFERENCED_MODULE_STRUCT' => 0,
    'value' => 0,
    'REFERENCED_MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a6f7c2af941')) {function content_57a6f7c2af941($_smarty_tpl) {?>

<script type="txt/javascript" src="layouts/vlayout/modules/Contacts/resources/Edit.js"></script>
 <?php $_smarty_tpl->tpl_vars['privelege'] = new Smarty_variable(explode('::',$_smarty_tpl->tpl_vars['USER_MODEL']->value->get('privileges')->get('parent_role_seq')), null, 0);?>
<div class='container-fluid editViewContainer'><form class="form-horizontal recordEditView" id="EditView" name="EditView" method="post" action="index.php" enctype="multipart/form-data"><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME'] = new Smarty_variable($_tmp1, null, 0);?><?php $_smarty_tpl->tpl_vars['IS_PARENT_EXISTS'] = new Smarty_variable(strpos($_smarty_tpl->tpl_vars['MODULE']->value,":"), null, 0);?><?php if ($_smarty_tpl->tpl_vars['IS_PARENT_EXISTS']->value){?><?php $_smarty_tpl->tpl_vars['SPLITTED_MODULE'] = new Smarty_variable(explode(":",$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['SPLITTED_MODULE']->value[1];?>
" /><input type="hidden" name="parent" value="<?php echo $_smarty_tpl->tpl_vars['SPLITTED_MODULE']->value[0];?>
" /><?php }else{ ?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><?php }?><input type="hidden" name="action" value="Save" /><input id="recordId" type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="defaultCallDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('callduration');?>
" /><input type="hidden" name="defaultOtherEventDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('othereventduration');?>
" /><?php if ($_smarty_tpl->tpl_vars['IS_RELATION_OPERATION']->value){?><input type="hidden" name="sourceModule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type="hidden" name="sourceRecord" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_RECORD']->value;?>
" /><input type="hidden" name="relationOperation" value="<?php echo $_smarty_tpl->tpl_vars['IS_RELATION_OPERATION']->value;?>
" /><?php }?><input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
"/><script>var fieldname = new Array(<?php echo $_smarty_tpl->tpl_vars['VALIDATION_DATA_FIELDNAME']->value;?>
);var fieldlabel = new Array(<?php echo $_smarty_tpl->tpl_vars['VALIDATION_DATA_FIELDLABEL']->value;?>
);var fielddatatype = new Array(<?php echo $_smarty_tpl->tpl_vars['VALIDATION_DATA_FIELDDATATYPE']->value;?>
);var crmId;<?php if (isset($_smarty_tpl->tpl_vars['ID']->value)&&!empty($_smarty_tpl->tpl_vars['ID']->value)){?>crmId = <?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
;<?php }?></script><div class="contentHeader row-fluid"><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value!=''){?><h3 class="span8 textOverflowEllipsis" title="<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecordName();?>
"><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecordName();?>
</h3><?php }else{ ?><h3 class="span8 textOverflowEllipsis"><?php echo vtranslate('LBL_CREATING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3><?php }?><span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['ERROREDIT']->value&&$_smarty_tpl->tpl_vars['ERRORBUTTON']->value){?><span> <a style="margin-right: 10px;" class="btn" onclick="foulReady()">Замечание</a></span><?php }elseif($_smarty_tpl->tpl_vars['ERRORBUTTON']->value){?><span id="createFoul"><a style="margin-right: 10px;" class="quickCreateModule btn" data-name="FoulList" data-url="index.php?module=FoulList&view=QuickCreateAjax&target=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" href="javascript:void(0)">Добавить Замечание</a></span><?php }?><button class="btn btn-success" type="submit"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" onclick="javascript:window.history.back();"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></span></div><?php if ($_smarty_tpl->tpl_vars['TYPEUSER']->value=='owner'&&$_smarty_tpl->tpl_vars['ERRORIN']->value){?><table class="table table-bordered blockContainer showInlineTable equalSplit"><thead><tr><th class="blockHeader" colspan="4"><?php echo vtranslate('Замечание',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><tr><td colspan="2" style="width:50% !important"><?php echo $_smarty_tpl->tpl_vars['ERRORIN']->value[0]['description'];?>
</td><td style="width:40% !important"><?php  $_smarty_tpl->tpl_vars['ERROR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ERROR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ERRORIN']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->key => $_smarty_tpl->tpl_vars['ERROR']->value){
$_smarty_tpl->tpl_vars['ERROR']->_loop = true;
?><b><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['name'];?>
</b>: <i><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['message'];?>
</i><br /><?php } ?></td><td style="width:10% !important"><span class="pull-right"><a ><a onclick="foulFix()">Исправить</a></span></td></tr></tbody></table><br><?php }elseif($_smarty_tpl->tpl_vars['TYPEUSER']->value=='smowner'){?><table class="table table-bordered blockContainer showInlineTable equalSplit"><thead><tr><th class="blockHeader" colspan="4"><?php echo vtranslate('Замечание',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><tr><td colspan="2" style="width:50% !important"><?php echo $_smarty_tpl->tpl_vars['ERRORIN']->value[0][0]['description'];?>
<br /></td><td style="width:40% !important"><?php  $_smarty_tpl->tpl_vars['ERROR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ERROR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ERRORIN']->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->key => $_smarty_tpl->tpl_vars['ERROR']->value){
$_smarty_tpl->tpl_vars['ERROR']->_loop = true;
?><b><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['name'];?>
</b>: <i><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['message'];?>
</i><br /><?php } ?></td><td style="width:10% !important"><span class="pull-right"><a ><a onclick="foulReady()">Передать</a></span></td></tr></tbody></table><br><?php }elseif($_smarty_tpl->tpl_vars['TYPEUSER']->value=='smcreator'){?><table class="table table-bordered blockContainer showInlineTable equalSplit"><thead><tr><th class="blockHeader" colspan="4"><?php echo vtranslate('Замечание',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><tr><td colspan="2" style="width:50% !important"><?php echo $_smarty_tpl->tpl_vars['ERRORIN']->value[0][0]['description'];?>
<br /></td><td style="width:40% !important"><?php  $_smarty_tpl->tpl_vars['ERROR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ERROR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ERRORIN']->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->key => $_smarty_tpl->tpl_vars['ERROR']->value){
$_smarty_tpl->tpl_vars['ERROR']->_loop = true;
?><b><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['name'];?>
</b>: <i><?php echo $_smarty_tpl->tpl_vars['ERROR']->value['messageDisplay'][0]['message'];?>
</i><br /><?php } ?></td><td style="width:10% !important"><span class="pull-right"><a ><a onclick="foulReady()">Передать</a></span></td></tr></tbody></table><br><?php }?><?php $_smarty_tpl->tpl_vars['iblock'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars['opportunity_type'] = new Smarty_variable('', null, 0);?><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value=='Индивидуальный Тур'){?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='indtur'){?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='LBL_DESCRIPTION_INFORMATION'){?><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value>0){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/Bookinginfo.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><input id="dataDogovora" value="<?php echo date('Y-m-d H:i:s');?>
" type="hidden" /><?php }?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['iblock']->value==1){?><?php }?><?php $_smarty_tpl->tpl_vars['iblock'] = new Smarty_variable($_smarty_tpl->tpl_vars['iblock']->value+1, null, 0);?><?php if (count($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value)<=0){?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='Туристы'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/ListTur.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='Стоимость тура'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/TurFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='Доплаты'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/AddPay.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='turblock'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/Turblock.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='Оплата туристом'){?><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value>0){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/PaymentTourist.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='Оплата оператору'){?><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value>0){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/PaymentOperator.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php continue 1?><?php }?><table class="table table-bordered blockContainer showInlineTable equalSplit"><thead><tr><th class="blockHeader" colspan="4"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration++;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->last = $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration === $_smarty_tpl->tpl_vars['FIELD_MODEL']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blockfields']['last'] = $_smarty_tpl->tpl_vars['FIELD_MODEL']->last;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=="opportunity_type"){?><?php $_smarty_tpl->tpl_vars['opportunity_type'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars["isReferenceField"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="20"||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="19"){?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value=='1'){?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value==2){?></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?><?php }?><td class="fieldLabel <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?><label align="right" class="muted pull-right marginRight10px"><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true&&$_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?> <span class="redColor">*</span> <?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value=="reference"){?><?php $_smarty_tpl->tpl_vars["REFERENCE_LIST"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList(), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCE_LIST_COUNT"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['REFERENCE_LIST']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['REFERENCE_LIST_COUNT']->value>1){?><?php $_smarty_tpl->tpl_vars["DISPLAYID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_STRUCT"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)){?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'), null, 0);?><?php }?><span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?><select id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
_dropDown" class="chzn-select referenceModulesList streched" style="width:160px;"><optgroup><?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value==$_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></optgroup></select></span><?php }else{ ?><label class="muted pull-right marginRight10px"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><?php }?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="83"){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('COUNTER'=>$_smarty_tpl->tpl_vars['COUNTER']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0);?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?></label><?php }?></td><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!="83"){?><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='19'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='20'){?> colspan="3" <?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?> <?php }?>><div class="row-fluid"><span class="span10"><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='office'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/office.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value), 0);?>
<?php }?></span></div></td><?php }?><?php if (count($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value)==1&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!="19"&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!="20"&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!="30"&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')!="recurringtype"){?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td><?php }?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Events'&&$_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='LBL_EVENT_INFORMATION'&&$_smarty_tpl->getVariable('smarty')->value['foreach']['blockfields']['last']){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/FollowUp.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('COUNTER'=>$_smarty_tpl->tpl_vars['COUNTER']->value), 0);?>
<?php }?><?php } ?><?php if (end($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value)==true&&count($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value)!=1&&$_smarty_tpl->tpl_vars['COUNTER']->value==1){?><td class="fieldLabel <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td><?php }?></tr></tbody></table><br><?php } ?><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value=='Индивидуальный Тур'){?><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value>0){?><?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['LBL_DESCRIPTION_INFORMATION'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/Bookinginfo.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['Оплата оператору'], null, 0);?><?php $_smarty_tpl->tpl_vars['IND_BLOCK'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['indtur'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/PaymentOperator.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><input id="dataDogovora" value="<?php echo date('Y-m-d H:i:s');?>
" type="hidden" /><?php }?><?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['Туристы'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/ListTur.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['Стоимость тура'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/TurFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['indtur'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/AllBlock.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value>0){?><?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['Оплата туристом'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/PaymentTourist.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php }?>
<?php }} ?>