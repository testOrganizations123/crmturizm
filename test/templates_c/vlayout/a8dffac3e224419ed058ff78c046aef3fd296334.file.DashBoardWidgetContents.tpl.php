<?php /* Smarty version Smarty-3.1.7, created on 2017-06-13 00:11:57
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\Vtiger\dashboards\DashBoardWidgetContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:313965901111e17eaf2-82777330%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a8dffac3e224419ed058ff78c046aef3fd296334' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\Vtiger\\dashboards\\DashBoardWidgetContents.tpl',
      1 => 1497301713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '313965901111e17eaf2-82777330',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5901111e1888b',
  'variables' => 
  array (
    'DATA' => 0,
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901111e1888b')) {function content_5901111e1888b($_smarty_tpl) {?>
<?php if (count($_smarty_tpl->tpl_vars['DATA']->value)>0){?><input class="widgetData" type=hidden value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATA']->value));?>
' /><div class="widgetChartContainer" style="height:250px;width:85%"></div><?php }else{ ?><span class="noDataMsg"><!-- SalesPlatform.ru begin --><?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_MATCHED_THIS_CRITERIA');?>
<!--<?php echo vtranslate('LBL_EQ_ZERO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_MATCHED_THIS_CRITERIA');?>
--><!-- SalesPlatform.ru end --></span><?php }?><?php }} ?>