<?php /* Smarty version Smarty-3.1.7, created on 2017-05-04 20:07:39
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\uitypes\editPlan.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2158ff79cf085028-40453929%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0828c4e8fe7a5287fbfab5c6976c83288954c36' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\uitypes\\editPlan.tpl',
      1 => 1493241816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2158ff79cf085028-40453929',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58ff79cf0c351',
  'variables' => 
  array (
    'OFFICEPLANJSON' => 0,
    'WORKERPLANJSON' => 0,
    'TYPEPLAN' => 0,
    'STRDATE' => 0,
    'OFFICESELECT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58ff79cf0c351')) {function content_58ff79cf0c351($_smarty_tpl) {?><script>
    window.officePlan = <?php echo $_smarty_tpl->tpl_vars['OFFICEPLANJSON']->value;?>
;
    
    window.workerPlan = <?php echo $_smarty_tpl->tpl_vars['WORKERPLANJSON']->value;?>
;
</script>

<?php if ($_smarty_tpl->tpl_vars['TYPEPLAN']->value=="all"){?>
    <h3>Общий план продаж на <?php echo $_smarty_tpl->tpl_vars['STRDATE']->value;?>
</h3>
    <br>
    <div id="allPlan"></div>
    <br>
    <hr>
    <br>
    <h3>План продаж по офисам на <?php echo $_smarty_tpl->tpl_vars['STRDATE']->value;?>
</h3>
    <br>
    <div id="officesPlan"></div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['TYPEPLAN']->value=="region"){?>
    <h3>План продаж по офисам на <?php echo $_smarty_tpl->tpl_vars['STRDATE']->value;?>
</h3>
    <br>
    <div id="officesPlan"></div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['TYPEPLAN']->value=="office"){?>
    <h3>План продаж по офису  "<?php echo $_smarty_tpl->tpl_vars['OFFICESELECT']->value;?>
"  на <?php echo $_smarty_tpl->tpl_vars['STRDATE']->value;?>
</h3>
    <br>
    <div id="officesPlan"></div>
    <br>
    <hr>
    <br>
    <h3>План продаж по сотрудникам  на <?php echo $_smarty_tpl->tpl_vars['STRDATE']->value;?>
</h3>
    <br>
    <div id="workersPlan"></div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['TYPEPLAN']->value=="worker"){?>
    <h3>План продаж по сотруднику  на <?php echo $_smarty_tpl->tpl_vars['STRDATE']->value;?>
</h3>
    <br>
    <div id="workersPlan"></div>
<?php }?>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">

<?php }} ?>