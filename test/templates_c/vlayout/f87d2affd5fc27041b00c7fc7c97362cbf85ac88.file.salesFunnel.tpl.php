<?php /* Smarty version Smarty-3.1.7, created on 2017-04-29 00:23:23
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\uitypes\salesFunnel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105185903a1cb460d69-08660081%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f87d2affd5fc27041b00c7fc7c97362cbf85ac88' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\uitypes\\salesFunnel.tpl',
      1 => 1493414507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105185903a1cb460d69-08660081',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5903a1cb49728',
  'variables' => 
  array (
    'FUNNEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5903a1cb49728')) {function content_5903a1cb49728($_smarty_tpl) {?><script>
    window.funelData = <?php echo $_smarty_tpl->tpl_vars['FUNNEL']->value;?>
;
</script>

<style>
    #chartDiv{
        height: 500px;
        width: 700px;
    }
</style>

<div id="chartDiv"></div>
























<?php }} ?>