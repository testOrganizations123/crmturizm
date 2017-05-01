<?php /* Smarty version Smarty-3.1.7, created on 2017-05-01 22:12:34
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\uitypes\salesFunnel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1223259039a6a8d1b22-11590313%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79f6f63ad52f8800663a1a6dc41ecdfa0c39fe5f' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\uitypes\\salesFunnel.tpl',
      1 => 1493665949,
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
    'FUNNELNEW' => 0,
    'FUNNELALL' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59039a6a8d4ab')) {function content_59039a6a8d4ab($_smarty_tpl) {?><script>
    window.funnelDataNew = <?php echo $_smarty_tpl->tpl_vars['FUNNELNEW']->value;?>
;
    window.funnelDataAll = <?php echo $_smarty_tpl->tpl_vars['FUNNELALL']->value;?>
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
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = json_decode($_smarty_tpl->tpl_vars['FUNNELNEW']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
        <div style="height: 700px" class="funnel" id="div_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"></div>
    <?php } ?>
</div>

<div class="funnelBlock">
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = json_decode($_smarty_tpl->tpl_vars['FUNNELNEW']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
        <div style="height: 700px" class="funnel" id="div_new_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"></div>
    <?php } ?>
</div>

























<?php }} ?>