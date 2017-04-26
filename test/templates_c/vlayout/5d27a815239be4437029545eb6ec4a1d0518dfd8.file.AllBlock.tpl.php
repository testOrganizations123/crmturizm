<?php /* Smarty version Smarty-3.1.7, created on 2016-11-18 12:38:47
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/AllBlock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88512560357e243274fcf94-25829476%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d27a815239be4437029545eb6ec4a1d0518dfd8' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Potentials/part/individulal/AllBlock.tpl',
      1 => 1479461925,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88512560357e243274fcf94-25829476',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57e243274feb3',
  'variables' => 
  array (
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_VALUE' => 0,
    'Hotels' => 0,
    'MODULE' => 0,
    'Hotel' => 0,
    'KEY' => 0,
    'Planed' => 0,
    'Fly' => 0,
    'Trails' => 0,
    'Transfer' => 0,
    'Tran' => 0,
    'Gids' => 0,
    'Gid' => 0,
    'Inshures' => 0,
    'Others' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57e243274feb3')) {function content_57e243274feb3($_smarty_tpl) {?>

<div class="blockShow"><div class="cms-group cms-group-expanded"><div class="cms-group-label">Состав тура</div><!-- Блок отель --><div class="row-fluid" style="margin-top:25px"><div class="span12"><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span2"><span style="font-size:14px"><i class="fa fa-bed" aria-hidden="true" style="font-size:18px"></i>&nbsp;&nbsp;Проживание</span><a href="" onclick="addTurOption(event,'hotel')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Добавить</a></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['ind_hotel'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['Hotels'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div id="hotel-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  <?php if ($_smarty_tpl->tpl_vars['Hotels']->value){?>background:#eaeaea;border:1px solid #ccc;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['Hotels']->value){?><?php  $_smarty_tpl->tpl_vars['Hotel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Hotel']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Hotels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Hotel']->key => $_smarty_tpl->tpl_vars['Hotel']->value){
$_smarty_tpl->tpl_vars['Hotel']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['Hotel']->key;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/Hotel.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('HOTEL'=>$_smarty_tpl->tpl_vars['Hotel']->value,'index'=>$_smarty_tpl->tpl_vars['KEY']->value), 0);?>
<?php } ?><?php }?></div></div></div></div></div><!-- Блок перелет --><div class="row-fluid" ><div class="span12"><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span2"><span style="font-size:14px"><i class="fa fa-plane" aria-hidden="true" style="font-size:18px"></i>&nbsp;&nbsp;Перелет</span><a href="" onclick="addTurOption(event,'planed')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Добавить</a></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['ind_flyte'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['Planed'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div id="planed-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  <?php if ($_smarty_tpl->tpl_vars['Planed']->value){?>background:#eaeaea;border:1px solid #ccc;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['Planed']->value){?><?php  $_smarty_tpl->tpl_vars['Fly'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Fly']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Planed']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Fly']->key => $_smarty_tpl->tpl_vars['Fly']->value){
$_smarty_tpl->tpl_vars['Fly']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['Fly']->key;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/Planed.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FLY'=>$_smarty_tpl->tpl_vars['Fly']->value,'index'=>$_smarty_tpl->tpl_vars['KEY']->value), 0);?>
<?php } ?><?php }?></div></div></div></div></div><!-- Блок ЖД --><div class="row-fluid" ><div class="span12"><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span2"><span style="font-size:14px"><i class="fa fa-sliders" aria-hidden="true" style="font-size:18px"></i>&nbsp;&nbsp;ЖД переезд</span><a href="" onclick="addTurOption(event,'trail')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Добавить</a></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['ind_trail'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['Trails'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div id="trail-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  <?php if ($_smarty_tpl->tpl_vars['Trails']->value){?>background:#eaeaea;border:1px solid #ccc;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['Trails']->value){?><?php  $_smarty_tpl->tpl_vars['Trail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Trail']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Trails']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Trail']->key => $_smarty_tpl->tpl_vars['Trail']->value){
$_smarty_tpl->tpl_vars['Trail']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['Trail']->key;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/Trail.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('index'=>$_smarty_tpl->tpl_vars['KEY']->value), 0);?>
<?php } ?><?php }?></div></div></div></div></div><!-- Блок трансфер --><div class="row-fluid" ><div class="span12"><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span2"><span style="font-size:14px"><i class="fa fa-bus" aria-hidden="true" style="font-size:18px"></i>&nbsp;&nbsp;Трансфер</span><a href="" onclick="addTurOption(event,'transfer')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Добавить</a></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['ind_transfer'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['Transfer'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div id="transfer-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  <?php if ($_smarty_tpl->tpl_vars['Transfer']->value){?>background:#eaeaea;border:1px solid #ccc;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['Transfer']->value){?><?php  $_smarty_tpl->tpl_vars['Tran'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Tran']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Transfer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Tran']->key => $_smarty_tpl->tpl_vars['Tran']->value){
$_smarty_tpl->tpl_vars['Tran']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['Tran']->key;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/Transfer.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TRAN'=>$_smarty_tpl->tpl_vars['Tran']->value,'index'=>$_smarty_tpl->tpl_vars['KEY']->value), 0);?>
<?php } ?><?php }?></div></div></div></div></div><!-- Блок услуги гида --><div class="row-fluid" ><div class="span12"><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span2"><span style="font-size:14px"><i class="fa fa-user" aria-hidden="true" style="font-size:18px"></i>&nbsp;&nbsp;Услуги гида</span><a href="" onclick="addTurOption(event,'gid')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Добавить</a></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['ind_gid'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['Gids'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div id="gid-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  <?php if ($_smarty_tpl->tpl_vars['Gids']->value){?>background:#eaeaea;border:1px solid #ccc;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['Gids']->value){?><?php  $_smarty_tpl->tpl_vars['Gid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Gid']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Gids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Gid']->key => $_smarty_tpl->tpl_vars['Gid']->value){
$_smarty_tpl->tpl_vars['Gid']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['Gid']->key;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/Gid.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('GID'=>$_smarty_tpl->tpl_vars['Gid']->value,'index'=>$_smarty_tpl->tpl_vars['KEY']->value), 0);?>
<?php } ?><?php }?></div></div></div></div></div><!-- Блок страховки --><div class="row-fluid" ><div class="span12"><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span2"><span style="font-size:14px"><i class="fa fa-heartbeat" aria-hidden="true" style="font-size:18px"></i>&nbsp;&nbsp;Страховка</span><a href="" onclick="addTurOption(event,'inshur')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Добавить</a></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['ind_inshure'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['Inshures'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div id="inshur-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  <?php if ($_smarty_tpl->tpl_vars['Inshures']->value){?>background:#eaeaea;border:1px solid #ccc;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['Inshures']->value){?><?php  $_smarty_tpl->tpl_vars['Inshure'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Inshure']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Inshures']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Inshure']->key => $_smarty_tpl->tpl_vars['Inshure']->value){
$_smarty_tpl->tpl_vars['Inshure']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['Inshure']->key;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/Inshure.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('index'=>$_smarty_tpl->tpl_vars['KEY']->value), 0);?>
<?php } ?><?php }?></div></div></div></div></div><!-- Блок дополнительные услуги --><div class="row-fluid" ><div class="span12"><div class="cms-group cms-group-white"><div class="row-fluid"><div class="span2"><span style="font-size:14px"><i class="fa fa-th" aria-hidden="true" style="font-size:18px"></i>&nbsp;&nbsp;Доп. услуги</span><a href="" onclick="addTurOption(event,'other')" class="pull-right" style="line-height: 22px"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Добавить</a></div><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['ind_servise'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['Others'] = new Smarty_variable(unserialize(htmlspecialchars_decode($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)), null, 0);?><div id="other-container" class="span10" style="box-sizing:border-box;padding:5px 10px;border-radius:3px;  <?php if ($_smarty_tpl->tpl_vars['Others']->value){?>background:#eaeaea;border:1px solid #ccc;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['Others']->value){?><?php  $_smarty_tpl->tpl_vars['Other'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Other']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Others']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Other']->key => $_smarty_tpl->tpl_vars['Other']->value){
$_smarty_tpl->tpl_vars['Other']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['Other']->key;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/individulal/Other.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('index'=>$_smarty_tpl->tpl_vars['KEY']->value), 0);?>
<?php } ?><?php }?></div></div></div></div></div></div></div><?php }} ?>