<?php /* Smarty version Smarty-3.1.7, created on 2016-10-27 09:43:38
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerModuleFieldsDefault.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188999043758108b2bd3bcd1-28246750%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb764e187d22854a2703cdb8c2154bbc3318e3dd' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/uitypes/TypeAnswerModuleFieldsDefault.tpl',
      1 => 1477550587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188999043758108b2bd3bcd1-28246750',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58108b2be30d5',
  'variables' => 
  array (
    'MODULE' => 0,
    'KEY' => 0,
    'RELATED_MODULE' => 0,
    'MODULE_RECORD_STRUCTURE' => 0,
    'BLOCK_LABEL' => 0,
    'SOURCE_MODULE' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_NAME' => 0,
    'FIELD_MODEL' => 0,
    'columnNameApi' => 0,
    'CONDITION_INFO' => 0,
    'MODULE_MODEL' => 0,
    'PICKLIST_VALUES' => 0,
    'referenceList' => 0,
    'CURRENT_USER_MODEL' => 0,
    'ACCESSIBLE_USERS' => 0,
    'USER_NAME' => 0,
    'USERSLIST' => 0,
    'FIELD_INFO' => 0,
    'SPECIAL_VALIDATOR' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58108b2be30d5')) {function content_58108b2be30d5($_smarty_tpl) {?>
<td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_TYPEANSWER_MODULE_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span clas="span10"><select class="chzn-select"  name="type_answer_module_field[<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
]" data-fields = "<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
" onchange='changeFields(this);'><?php $_smarty_tpl->tpl_vars['MODULE_LABEL'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE']->value), null, 0);?><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='time_start'){?><?php continue 1?><?php }?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule(), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars['columnNameApi'] = new Smarty_variable('getCustomViewColumnName', null, 0);?><option value="<?php $_tmp1=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp1();?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType(), null, 0);?><?php $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'){?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable('V', null, 0);?><?php }?><?php $_tmp2=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp2()==decode_html($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['field'])){?>selected="selected"<?php }?><?php if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Calendar')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='recurringtype')){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable(Calendar_Field_Model::getReccurencePicklistValues(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }?><?php if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Calendar')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='activitytype')){?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']['Task'] = vtranslate('Task','Calendar');?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'){?><?php $_smarty_tpl->tpl_vars['referenceList'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getWebserviceFieldObject()->getReferenceList(), null, 0);?><?php if (is_array($_smarty_tpl->tpl_vars['referenceList']->value)&&in_array('Users',$_smarty_tpl->tpl_vars['referenceList']->value)){?><?php $_smarty_tpl->tpl_vars['USERSLIST'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL'] = new Smarty_variable(Users_Record_Model::getCurrentUserModel(), null, 0);?><?php $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->getAccessibleUsers(), null, 0);?><?php  $_smarty_tpl->tpl_vars['USER_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['USER_NAME']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['USER_NAME']->key => $_smarty_tpl->tpl_vars['USER_NAME']->value){
$_smarty_tpl->tpl_vars['USER_NAME']->_loop = true;
?><?php $_smarty_tpl->createLocalArrayVariable('USERSLIST', null, 0);
$_smarty_tpl->tpl_vars['USERSLIST']->value[$_smarty_tpl->tpl_vars['USER_NAME']->value] = $_smarty_tpl->tpl_vars['USER_NAME']->value;?><?php } ?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['USERSLIST']->value;?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['type'] = 'picklist';?><?php }?><?php }?>data-fieldinfo='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value));?>
'<?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?>><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value!=$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')){?>(<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
)  <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php }?></option><?php } ?></optgroup><?php } ?></select></span></td><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('Значение',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><span class="span10 fieldUiHolder"><input name="type_answer_module_comment[<?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
]" data-value="value"  type="text" value="<?php echo $_smarty_tpl->tpl_vars['CONDITION_INFO']->value['comment'];?>
" /></span><?php if ($_smarty_tpl->tpl_vars['KEY']->value!=1){?><span class="span1" style="float:right;"><i class="icon-trash alignMiddle" onclick="deleteAnswerModule(this);" title="Удалить"></i></span><?php }?></td><?php }} ?>