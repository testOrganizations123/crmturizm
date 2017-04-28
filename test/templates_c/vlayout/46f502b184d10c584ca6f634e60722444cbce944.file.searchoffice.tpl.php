<?php /* Smarty version Smarty-3.1.7, created on 2016-11-25 18:46:26
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/uitypes/searchoffice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68083736457c9ec33071545-94845956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46f502b184d10c584ca6f634e60722444cbce944' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/uitypes/searchoffice.tpl',
      1 => 1480088782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68083736457c9ec33071545-94845956',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57c9ec3308e85',
  'variables' => 
  array (
    'CURRENT_USER_MODEL' => 0,
    'FIELD_MODEL' => 0,
    'office' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_VALUE' => 0,
    'OFFICE' => 0,
    'user_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c9ec3308e85')) {function content_57c9ec3308e85($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['office'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('office'), null, 0);?><?php $_smarty_tpl->tpl_vars['user_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->getId(), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValuesOffice(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['office']->value==''){?><div class="row-fluid"><select class='listSearchContributor office' style="width:140px;"name='office'  data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}' onchange="changeAssignList(this)"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" data-officeid='<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
' data-picklistvalue= '<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
' <?php if ($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value==$_smarty_tpl->tpl_vars['OFFICE']->value){?> selected <?php }?>data-userId="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('id');?>
"><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select></div><?php }else{ ?><select class='listSearchContributor office' name='office' style="width:140px;"name='office' data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}' onchange="changeAssignList(this)"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?> <?php if ($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value!=$_smarty_tpl->tpl_vars['office']->value&&$_smarty_tpl->tpl_vars['user_id']->value!=19){?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value==404||$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value==405||$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value==406){?><?php }else{ ?><?php continue 1?><?php }?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" data-officeid='<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
' data-picklistvalue= '<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
' selecteddata-userId="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('id');?>
"><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select><?php }?>
    <script>
    jQuery(document).ready(function(){
        var id = jQuery('select[name="office"]').find('option:selected').data('officeid');
       if (id){
        jQuery(".groupAll").hide();
        jQuery("#search_"+id).show();
    }
    });
    function changeAssignList(element){
        element = jQuery(element);
        var id = element.find('option:selected').data('officeid');
        if (id != 'undefined'){
        jQuery(".groupAll").hide();
        jQuery("#search_"+id).show();
    }
    }
    </script>
    <?php }} ?>