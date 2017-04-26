<?php /* Smarty version Smarty-3.1.7, created on 2017-01-25 12:18:35
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/FoulList/QuickCreate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1986993547586f8d96c68977-18904865%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fdebd81e53c8b4b1948be554391bf4f18c07665' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/FoulList/QuickCreate.tpl',
      1 => 1485335897,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1986993547586f8d96c68977-18904865',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_586f8d96d7473',
  'variables' => 
  array (
    'SCRIPTS' => 0,
    'jsModel' => 0,
    'RECORD_STRUCTURE' => 0,
    'userId' => 0,
    'targetId' => 0,
    'PICKIST_DEPENDENCY_DATASOURCE' => 0,
    'MODULE' => 0,
    'FIELD_NAME' => 0,
    'FIELD_MODEL' => 0,
    'USER_MODEL' => 0,
    'refrenceList' => 0,
    'COUNTER' => 0,
    'isReferenceField' => 0,
    'refrenceListCount' => 0,
    'DISPLAYID' => 0,
    'REFERENCED_MODULE_STRUCT' => 0,
    'value' => 0,
    'REFERENCED_MODULE_NAME' => 0,
    'MODULE_MODEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_586f8d96d7473')) {function content_586f8d96d7473($_smarty_tpl) {?>

    <style>
        .modelContainer td.fieldLabel{width:120px !important;}
        .modelContainer td.fieldValue{width:203px !important;}
        .modelContainer input.dateField{width:80% !important}
    </style>
    
<?php  $_smarty_tpl->tpl_vars['jsModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jsModel']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SCRIPTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jsModel']->key => $_smarty_tpl->tpl_vars['jsModel']->value){
$_smarty_tpl->tpl_vars['jsModel']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['jsModel']->key;
?><script type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"></script><?php } ?><div class="modelContainer"><div class="modal-header contentsBackground"><?php $_smarty_tpl->tpl_vars['userId'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['users']->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['targetId'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['target']->get('fieldvalue'), null, 0);?><button class="close" aria-hidden="true" data-dismiss="modal" type="button" title="<?php echo vtranslate('LBL_CLOSE');?>
">x</button><h3>Замечание для <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['users']->getEditViewDisplayValue($_smarty_tpl->tpl_vars['userId']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['target']->getEditViewDisplayValue($_smarty_tpl->tpl_vars['targetId']->value);?>
</h3></div><form class="form-horizontal recordEditView" name="QuickCreate" method="post" action="index.php"><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="action" value="SaveAjax"><input type="hidden" name="foul" value="Замечание для <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['users']->getEditViewDisplayValue($_smarty_tpl->tpl_vars['userId']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['target']->getEditViewDisplayValue($_smarty_tpl->tpl_vars['targetId']->value);?>
"><div class="quickCreateContent"><div class="modal-body"><table class="massEditTable table table-bordered"><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if (($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='users'&&$_smarty_tpl->tpl_vars['userId']->value>0)){?><input name='users' value='<?php echo $_smarty_tpl->tpl_vars['userId']->value;?>
' type='hidden'/><?php continue 1?><?php }elseif(($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='target'&&$_smarty_tpl->tpl_vars['targetId']->value>0)){?><input name='target' value='<?php echo $_smarty_tpl->tpl_vars['targetId']->value;?>
' type='hidden'/><?php continue 1?><?php }elseif(($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='date_foul')){?><input name='date_foul' value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
' type='hidden'/><?php continue 1?><?php }elseif(($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='assigned_user_id')){?><input name='assigned_user_id' value='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->getId();?>
' type='hidden'/><?php continue 1?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='checks'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='answer'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='foul'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='point'){?><?php continue 1?><?php }?><?php $_smarty_tpl->tpl_vars["isReferenceField"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php $_smarty_tpl->tpl_vars["refrenceList"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList(), null, 0);?><?php $_smarty_tpl->tpl_vars["refrenceListCount"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['refrenceList']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="19"){?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value=='1'){?><td></td><td></td></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value==2){?></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?><?php }?><td class='fieldLabel' width="123"><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?><label class="muted pull-right"><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true&&($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!='')){?> <span class="redColor">*</span> <?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value=="reference"&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')==''){?><?php if ($_smarty_tpl->tpl_vars['refrenceListCount']->value>1){?><?php $_smarty_tpl->tpl_vars["DISPLAYID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_STRUCT"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)){?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'), null, 0);?><?php }?><span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?><select style="width: 150px;" class="chzn-select referenceModulesList" id="referenceModulesList"><optgroup><?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['refrenceList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value==$_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value){?> selected <?php }?> ><?php echo vtranslate($_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['value']->value);?>
</option><?php } ?></optgroup></select></span><?php }else{ ?><label class="muted pull-right"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><?php }?><?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?></label><?php }?></td><td class="fieldValue" width="200"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='19'){?> colspan="3" <?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?> <?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='notif'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/PicklistNotif.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></td><?php } ?></tr></table></div></div><div class="modal-footer quickCreateActions"><?php $_smarty_tpl->tpl_vars["EDIT_VIEW_URL"] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRecordUrl(), null, 0);?><a class="cancelLink cancelLinkContainer pull-right" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><button class="btn btn-success" type="submit"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></form></div><?php }} ?>