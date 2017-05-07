<?php /* Smarty version Smarty-3.1.7, created on 2017-05-07 21:43:05
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\uitypes\salesFunnel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105185903a1cb460d69-08660081%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f87d2affd5fc27041b00c7fc7c97362cbf85ac88' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\uitypes\\salesFunnel.tpl',
      1 => 1494096470,
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
    'FUNNELNEW' => 0,
    'FUNNELALL' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5903a1cb49728')) {function content_5903a1cb49728($_smarty_tpl) {?><script>
    window.funnelDataNew = <?php echo $_smarty_tpl->tpl_vars['FUNNELNEW']->value;?>
;
    window.funnelDataAll = <?php echo $_smarty_tpl->tpl_vars['FUNNELALL']->value;?>
;
</script>

<style>
    .funnelBlock {
        width: 49.5%;
        display: inline-block;
        vertical-align: top;
    }

    .funnel {
        width: 100%;
    }
</style>

    <div class="funnelBlock">
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = json_decode($_smarty_tpl->tpl_vars['FUNNELALL']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
            <div style="height: 700px" class="funnel" id="div_new_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"></div>
            <br>
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
            <div style="height: 700px" class="funnel" id="div_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"></div>
            <br>
        <?php } ?>
    </div>


























<?php }} ?>