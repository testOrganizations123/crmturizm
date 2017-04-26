<?php /* Smarty version Smarty-3.1.7, created on 2016-08-08 11:36:31
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/ListScript.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10305868405795e28f59f4e7-96064298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16d79d65d2b745d7e2563bc34b1151de726a217e' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/VDDialogueDesigner/ListScript.tpl',
      1 => 1470645388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10305868405795e28f59f4e7-96064298',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5795e28f5b69b',
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULE_MODEL' => 0,
    'MODULE_LIST' => 0,
    'count_script' => 0,
    'sp' => 0,
    'SPAN' => 0,
    'SCRIPT' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5795e28f5b69b')) {function content_5795e28f5b69b($_smarty_tpl) {?>
<div class="VDDialogueDesigner_container" style="padding-left: 3%;padding-right: 3%"><br /><br /><h2><?php echo vtranslate('LBL_TITLE_LIST_SCRIPTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h2><hr /><div class="padding1per row-fluid" style="border:1px solid #ccc;"><?php $_smarty_tpl->tpl_vars['MODULE_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListScript(), null, 0);?><?php $_smarty_tpl->tpl_vars['count_script'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['MODULE_LIST']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['count_script']->value==1){?><?php $_smarty_tpl->tpl_vars['SPAN'] = new Smarty_variable("span12", null, 0);?><?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(1, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['count_script']->value==2){?> <?php $_smarty_tpl->tpl_vars['SPAN'] = new Smarty_variable("span6", null, 0);?><?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(2, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['count_script']->value==3){?> <?php $_smarty_tpl->tpl_vars['SPAN'] = new Smarty_variable("span4", null, 0);?><?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(3, null, 0);?><?php }else{ ?>   <?php $_smarty_tpl->tpl_vars['SPAN'] = new Smarty_variable("span3", null, 0);?> <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(4, null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['sp'] = new Smarty_variable(1, null, 0);?><?php  $_smarty_tpl->tpl_vars['SCRIPT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SCRIPT']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListScript(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SCRIPT']->key => $_smarty_tpl->tpl_vars['SCRIPT']->value){
$_smarty_tpl->tpl_vars['SCRIPT']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['SCRIPT']->key;
?><?php if ($_smarty_tpl->tpl_vars['sp']->value==1){?><div class="row-fluid"><?php }?><div class="<?php echo $_smarty_tpl->tpl_vars['SPAN']->value;?>
"><a class="listScript" href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT']->value['link'];?>
"><h3><?php echo $_smarty_tpl->tpl_vars['SCRIPT']->value['subject'];?>
</h3><p><?php echo $_smarty_tpl->tpl_vars['SCRIPT']->value['description'];?>
</p></a></div><?php if ($_smarty_tpl->tpl_vars['sp']->value==$_smarty_tpl->tpl_vars['count']->value){?></div> <br /><?php $_smarty_tpl->tpl_vars['sp'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['sp'] = new Smarty_variable($_smarty_tpl->tpl_vars['sp']->value+1, null, 0);?><?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['sp']->value!=1){?></div><?php }?></div></div>

<style>
    a.listScript {
        padding: 40px 20px;
        display: block;
        background: rgb(28, 116, 187) none repeat scroll 0% 0%;
        color: #fff !important;
        text-align: center;
        border-radius: 10px;
    }
    a.listScript h3{
        color: #fff;
    }
 </style>   
    
    
    
<?php }} ?>