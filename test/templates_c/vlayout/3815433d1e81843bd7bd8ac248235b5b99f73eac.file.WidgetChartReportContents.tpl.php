<?php /* Smarty version Smarty-3.1.7, created on 2016-09-02 17:11:25
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Reports/WidgetChartReportContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188352844157c9888dc1e046-27542515%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3815433d1e81843bd7bd8ac248235b5b99f73eac' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Reports/WidgetChartReportContents.tpl',
      1 => 1449237000,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188352844157c9888dc1e046-27542515',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CHART_TYPE' => 0,
    'DATA' => 0,
    'CLICK_THROUGH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57c9888dc3556',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c9888dc3556')) {function content_57c9888dc3556($_smarty_tpl) {?>

<input type='hidden' name='charttype' value="<?php echo $_smarty_tpl->tpl_vars['CHART_TYPE']->value;?>
" />
<input type='hidden' name='data' value='<?php echo $_smarty_tpl->tpl_vars['DATA']->value;?>
' />
<input type='hidden' name='clickthrough' value="<?php echo $_smarty_tpl->tpl_vars['CLICK_THROUGH']->value;?>
" />

<div class="widgetChartContainer" style="height:235px;width:85%">
</div><?php }} ?>