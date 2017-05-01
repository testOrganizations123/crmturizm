<?php /* Smarty version Smarty-3.1.7, created on 2017-05-01 20:44:52
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\uitypes\salesFunnel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1223259039a6a8d1b22-11590313%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79f6f63ad52f8800663a1a6dc41ecdfa0c39fe5f' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\uitypes\\salesFunnel.tpl',
      1 => 1493660688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1223259039a6a8d1b22-11590313',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_59039a6a8d4ab',
  'variables' => 
  array (
    'FUNNEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59039a6a8d4ab')) {function content_59039a6a8d4ab($_smarty_tpl) {?><script>
    window.funelData = <?php echo $_smarty_tpl->tpl_vars['FUNNEL']->value;?>
;
</script>

<style>
    .funnelBlock{
        width: 740px;
        display: inline-block;
    }
    .funnel{
        width: 100%;
    }
</style>

<div class="funnelBlock">
    <div style="height: 700px" class="funnel"  id="chartDiv"></div>
</div>

<div class="funnelBlock">
    <div  style="height: 700px" class="funnel" id="chartDiv2"></div>
</div>
























<?php }} ?>