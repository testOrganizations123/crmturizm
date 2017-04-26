<?php /* Smarty version Smarty-3.1.7, created on 2016-09-02 17:11:25
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Reports/dashboards/ChartReportWidget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11126652257c9888dc38629-90062912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0fb3fa99531188b82f6a679c5a04ddb6c6de28a' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Reports/dashboards/ChartReportWidget.tpl',
      1 => 1449237000,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11126652257c9888dc38629-90062912',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'CHART_REPORT_WIDGET_CONTENTS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57c9888dc3f51',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c9888dc3f51')) {function content_57c9888dc3f51($_smarty_tpl) {?>


<div class="dashboardWidgetHeader">
	<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/WidgetHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="dashboardWidgetContent">
    <?php echo $_smarty_tpl->tpl_vars['CHART_REPORT_WIDGET_CONTENTS']->value;?>

</div><?php }} ?>