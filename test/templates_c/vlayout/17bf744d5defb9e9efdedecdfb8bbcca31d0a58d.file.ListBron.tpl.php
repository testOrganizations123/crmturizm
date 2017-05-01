<?php /* Smarty version Smarty-3.1.7, created on 2017-05-01 10:50:37
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\Potentials\part\ListBron.tpl" */ ?>
<?php /*%%SmartyHeaderCode:54965906e8cd2bc5c4-95818272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17bf744d5defb9e9efdedecdfb8bbcca31d0a58d' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\Potentials\\part\\ListBron.tpl',
      1 => 1493241804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54965906e8cd2bc5c4-95818272',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LISTVIEW_ENTRY' => 0,
    'MODULE' => 0,
    'privelege' => 0,
    'tuda_iz' => 0,
    'ITEM' => 0,
    'key_ot' => 0,
    'tuda_v' => 0,
    'otuda_iz' => 0,
    'otuda_v' => 0,
    'MODULE_MODEL' => 0,
    'DS' => 0,
    'IS_MODULE_EDITABLE' => 0,
    'IS_MODULE_DELETABLE' => 0,
    'CURRENT_USER_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5906e8cd832d1',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906e8cd832d1')) {function content_5906e8cd832d1($_smarty_tpl) {?>
<tr class="listViewEntries <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='Авиа билеты'){?>aviaticket<?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='ЖД билеты'){?>zhdticket<?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='Индивидуальный Тур'){?>indtur<?php }?>"  id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_row_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['listview']['index']+1;?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialid'];?>
"><td class="bg-2"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" class="listViewEntriesCheckBox"/></td><td class="bg-1 "><span class="<?php if (strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1217'])<strtotime("+24 hours",strtotime(date('Y-m-d H:i:s')))&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1236']==0){?>label label-warning<?php }?>"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1217']){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rus_date('j M H:i',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1217']));?>
<?php }else{ ?><center>-</center><?php }?> </span>                  </td><td class="bg-5 <?php if (strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1219'])<time()){?>danger<?php }?>"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1219']){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rus_date('j M H:i',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1219']));?>
<?php }else{ ?><center>-</center><?php }?>                      </td><?php if (count($_smarty_tpl->tpl_vars['privelege']->value)<7){?><td class="bg-2"><span class="block"><?php echo strip_tags($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('assigned_user_id'));?>
</span><?php echo strip_tags($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('office'));?>
</td><?php }?><!-- Контроль --><td class="nowrap bg-2"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1242']=='0000-00-00 00:00:00'){?><?php }else{ ?><span class="<?php if (strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1242'])<strtotime(date('Y-m-d'))){?>label-important label <?php }else{ ?>label label-warning<?php }?> popoverpop" data-trigger='hover' data-title='Контроль' data-content='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData[0];?>
'><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rus_date('d.m H:i',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1242']));?>
</span><?php }?></td><!-- Контакт --><td class="bg-2 nowrap"><?php echo strip_tags($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('contact_id'));?>
<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['oldowner']!=''){?><br><b><small>от: <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['oldowner'];?>
</small></b><?php }?></td><td class="bg-2"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['mobile'];?>
<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['phone']!=''){?>, <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['phone'];?>
<?php }?></td><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='Авиа билеты'||$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='ЖД билеты'){?><?php $_smarty_tpl->tpl_vars['tuda_iz'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1173']), null, 0);?><?php $_smarty_tpl->tpl_vars['tuda_v'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1177']), null, 0);?><?php $_smarty_tpl->tpl_vars['otuda_iz'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1185']), null, 0);?><?php $_smarty_tpl->tpl_vars['otuda_v'] = new Smarty_variable(explode('#',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1189']), null, 0);?><?php $_smarty_tpl->tpl_vars['otuda'] = new Smarty_variable('', null, 0);?><td class="bg-2"><?php  $_smarty_tpl->tpl_vars['ITEM'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ITEM']->_loop = false;
 $_smarty_tpl->tpl_vars['key_ot'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['tuda_iz']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ITEM']->key => $_smarty_tpl->tpl_vars['ITEM']->value){
$_smarty_tpl->tpl_vars['ITEM']->_loop = true;
 $_smarty_tpl->tpl_vars['key_ot']->value = $_smarty_tpl->tpl_vars['ITEM']->key;
?><?php echo $_smarty_tpl->tpl_vars['ITEM']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['tuda_v']->value[$_smarty_tpl->tpl_vars['key_ot']->value];?>
<?php if ($_smarty_tpl->tpl_vars['tuda_iz']->last){?><?php }else{ ?><br> <?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1185']!=''){?><?php  $_smarty_tpl->tpl_vars['ITEM'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ITEM']->_loop = false;
 $_smarty_tpl->tpl_vars['key_ot'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['otuda_iz']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ITEM']->key => $_smarty_tpl->tpl_vars['ITEM']->value){
$_smarty_tpl->tpl_vars['ITEM']->_loop = true;
 $_smarty_tpl->tpl_vars['key_ot']->value = $_smarty_tpl->tpl_vars['ITEM']->key;
?><?php echo $_smarty_tpl->tpl_vars['ITEM']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['otuda_v']->value[$_smarty_tpl->tpl_vars['key_ot']->value];?>
<?php if ($_smarty_tpl->tpl_vars['otuda_iz']->last){?><?php }else{ ?><br><?php }?><?php } ?><?php }?></td><td class="bg-2"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['vendorname'];?>
</td><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='Индивидуальный Тур'){?><td class="bg-2" colspan="2"><b><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype'];?>
</b></td><?php }else{ ?><td class="bg-2"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['country_name'];?>
,<br><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['resort'];?>
</td><td class="bg-2"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['turoperator'];?>
</td><?php }?><!-- Договор --><td class="bg-2">№<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1223'];?>
<br><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1225']!="0000-00-00"){?><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1225']));?>
<?php }?></td><!-- номер брони --><td class="bg-2"><span class="<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1234']!=1&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1227']!=''){?>label-warning label<?php }?>"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1227'];?>
</span></td><!-- документы на визу --><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='Авиа билеты'||$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype']=='ЖД билеты'){?><td class="bg-3" colspan="2"><b><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialtype'];?>
</b></td><?php }else{ ?><td class="bg-3"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1229'];?>
</td><!-- Дата для визы --><td class="bg-3"><?php if (empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1248'])){?><?php }else{ ?><span class="<?php if (strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1248'])<strtotime(date('Y-m-d'))&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1229']!='Выдана'){?>label-important label <?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1229']!='Выдана'){?>label-warning label<?php }?>"><?php echo date('d.m Y',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1248']));?>
</span><?php }?></td><?php }?><!-- сумма для оплаты туристом --><td class="right bg-4"><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['amount'],2,","," ");?>
</td><td class="right bg-4"><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1254'],2,","," ");?>
</td><!-- долг туриста --><td class="right bg-4"><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1250'],2,","," ");?>
<br><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1252']!="0000-00-00"&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1252']!=null){?><span class="<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1250']>0&&strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1252'])<strtotime(date('Y-m-d'))){?>label-important label <?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1250']>0){?>label-warning label<?php }?>"><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1252']));?>
</span><?php }?></td><?php $_smarty_tpl->tpl_vars['DS'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMoneyStatus($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1270']), null, 0);?><!-- Статус---><td class="bg-4"><?php echo $_smarty_tpl->tpl_vars['DS']->value;?>
</td><!-- Оператор стоимость ---><td class="bg-41 right"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1256']!=$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1264']&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1264']>0){?><span class="block"><small><s><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1264'],2,","," ");?>
</s></small></span><?php }?><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1256'],2,","," ");?>
</td><!-- Оператор долг ---><td class="bg-41 right"><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1258'],2,","," ");?>
<br><?php if (!empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1260'])){?>    <span class="<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1258']>0&&strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1260'])<strtotime(date('Y-m-d'))){?>label-important label<?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1258']>0){?>label-warning label<?php }?>"><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1260']));?>
</span> <?php }?></td><td class="bg-42 nowrap right"><span class="block "><span class="<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1266']<3.01){?>label-important label<?php }?>"><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1266'],2,","," ");?>
%</span></span><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1268'],2,","," ");?>
</td><td class="bg-5"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1231'];?>
</td><td class="right nowrap"><div class="actions pull-right"><span class="actionImages"><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value){?><a href='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getEditViewUrl();?>
' class="btn btn-warning"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil alignMiddle"></i></a>&nbsp;<br /><?php }?><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_DELETABLE']->value&&$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('is_admin')=='on'){?><a class="deleteRecordButton btn btn-danger"><i title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash-o alignMiddle"></i></a><?php }?></span></div></tr><?php }} ?>