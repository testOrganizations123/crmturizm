<?php /* Smarty version Smarty-3.1.7, created on 2017-04-20 05:12:27
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDCustomReports/uitypes/searchoffice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173718866580339db9a27e0-80073269%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee16d4e11754c3ac466d90e8d0f73028f8eaa7b2' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDCustomReports/uitypes/searchoffice.tpl',
      1 => 1492654196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173718866580339db9a27e0-80073269',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_580339dba20be',
  'variables' => 
  array (
    'USER_MODEL' => 0,
    'MODULE_MODEL' => 0,
    'office' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_VALUE' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_580339dba20be')) {function content_580339dba20be($_smarty_tpl) {?>

<div class="row-fluid"><?php $_smarty_tpl->tpl_vars['office'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('office'), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getPicklistValuesOffice(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['office']->value==''){?><select class='listSearchContributor office span12' name='filtre[office]'   data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}' onchange="changeAssignList(this)"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" data-officeid='<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
' data-picklistvalue= '<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
' <?php if ($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value==$_smarty_tpl->tpl_vars['item']->value['data']){?> selected <?php }?>data-userId="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('id');?>
"><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select><?php }else{ ?><select class='listSearchContributor office  span12' name='filtre[office]'  data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}' onchange="changeAssignList(this)"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?> <?php if ($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value!=$_smarty_tpl->tpl_vars['office']->value){?><?php continue 1?><?php }?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" data-officeid='<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
' data-picklistvalue= '<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
' selecteddata-userId="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('id');?>
"><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select><?php }?></div>
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