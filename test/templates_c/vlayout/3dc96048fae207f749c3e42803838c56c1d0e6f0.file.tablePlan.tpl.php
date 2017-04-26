<?php /* Smarty version Smarty-3.1.7, created on 2017-04-27 00:29:03
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\uitypes\tablePlan.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1707458ff79b99f4aa6-19189812%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3dc96048fae207f749c3e42803838c56c1d0e6f0' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\uitypes\\tablePlan.tpl',
      1 => 1493241816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1707458ff79b99f4aa6-19189812',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58ff79b9a08d5',
  'variables' => 
  array (
    'TITLEONE' => 0,
    'SELLING' => 0,
    'v' => 0,
    'COLOR' => 0,
    'SUM' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58ff79b9a08d5')) {function content_58ff79b9a08d5($_smarty_tpl) {?>    <table class="table-hover table abc" style="width: 100%">
        <tbody>
        <tr>
            <th></th>
            <th><?php echo $_smarty_tpl->tpl_vars['TITLEONE']->value;?>
</th>
            <th>Прибыль/Продажи</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELLING']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
            <tr>
                <td><div style="width: 15px;height: 15px;background-color: <?php echo $_smarty_tpl->tpl_vars['v']->value['color'];?>
;"></div></td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['amount'];?>
</td>
            </tr>

        <?php } ?>


        <tr class="success bold">
            <td><div style="width: 15px;height: 15px;background-color: <?php echo $_smarty_tpl->tpl_vars['COLOR']->value;?>
;"></div></td>
            <td>Итого</td>
            <td><?php echo $_smarty_tpl->tpl_vars['SUM']->value;?>
</td>
        </tr>
        </tbody>
    </table><?php }} ?>