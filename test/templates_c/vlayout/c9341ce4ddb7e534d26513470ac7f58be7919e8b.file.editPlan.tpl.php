<?php /* Smarty version Smarty-3.1.7, created on 2017-04-20 05:17:33
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDCustomReports/uitypes/editPlan.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2782555558f33c8ab80b87-97730506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9341ce4ddb7e534d26513470ac7f58be7919e8b' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDCustomReports/uitypes/editPlan.tpl',
      1 => 1492654195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2782555558f33c8ab80b87-97730506',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58f33c8abb05f',
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
<?php if ($_valid && !is_callable('content_58f33c8abb05f')) {function content_58f33c8abb05f($_smarty_tpl) {?><script>
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