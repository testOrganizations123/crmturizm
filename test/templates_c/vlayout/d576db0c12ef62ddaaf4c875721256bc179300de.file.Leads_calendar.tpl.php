<?php /* Smarty version Smarty-3.1.7, created on 2017-02-07 12:35:18
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/uitypes/Leads_calendar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:93013988579db438b1d0a3-93988035%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd576db0c12ef62ddaaf4c875721256bc179300de' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/uitypes/Leads_calendar.tpl',
      1 => 1486460108,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93013988579db438b1d0a3-93988035',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579db438b2960',
  'variables' => 
  array (
    'PARENTMODULENAME' => 0,
    'SINGLE_MODULE_NAME' => 0,
    'PARENTMODULE' => 0,
    'LISTVIEW_ENTRY' => 0,
    'LISTEVENT' => 0,
    'keyEvent' => 0,
    'EVENT' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579db438b2960')) {function content_579db438b2960($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['PARENTMODULENAME']->value), null, 0);?><td><span class="label label-success"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PARENTMODULENAME']->value);?>
</span><br><small>от <?php echo date('d.m.y',strtotime($_smarty_tpl->tpl_vars['PARENTMODULE']->value['createdtime']));?>
</small></td><td><small><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['designation']!=''||$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1077']!=''){?><i class="fa fa-university"></i> <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['designation'];?>
<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['designation']!=''||$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1077']!=''){?>, <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1077'];?>
<?php }?><br><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['noofemployees']!=''||$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1065']!=''){?><i class="fa fa-male"></i><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['noofemployees']!=''){?> Взрослых: <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['noofemployees'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1065']!=''){?>, детей: <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1065'];?>
 <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1079']!=''){?>(<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1079'];?>
)<?php }?><?php }?><br><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['annualrevenue']!=''){?><i class="fa fa-rub"></i> Бюджет: <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['annualrevenue'];?>
<br><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1111']!=''){?><i class="fa fa-plane"></i> Вылет:<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1111']!=''){?>с <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1111'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1159']!=''){?> по <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1159'];?>
<?php }?><br><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1113']!=''){?><i class="fa fa-plane"></i> Прилёт:<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1113']!=''){?>с <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1113'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1161']!=''){?> по <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1161'];?>
<?php }?><br><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1075']!=''){?><i class="fa calendar-o"></i> Длительность: <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1075'];?>
 - <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1352'];?>
<br><?php }?></small><?php if ($_smarty_tpl->tpl_vars['PARENTMODULE']->value['description']!=''){?><p><?php echo $_smarty_tpl->tpl_vars['PARENTMODULE']->value['description'];?>
</p><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['firstname']!=''||$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['lastname']!=''){?><p><strong><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['firstname']!=''){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['firstname'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['lastname']!=''){?> <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['lastname'];?>
<?php }?><br><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['mobile']!=''){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['mobile'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['phone']!=''){?><br /><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['phone'];?>
<?php }?></strong></p><?php }?></td><td width="40%"><?php $_smarty_tpl->tpl_vars['LISTEVENT'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getListEvent(), null, 0);?><?php $_smarty_tpl->tpl_vars['counList'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['LISTEVENT']->value), null, 0);?><!--   <?php  $_smarty_tpl->tpl_vars['EVENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['EVENT']->_loop = false;
 $_smarty_tpl->tpl_vars[$_smarty_tpl->tpl_vars['keyEvent']->value] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LISTEVENT']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['EVENT']->key => $_smarty_tpl->tpl_vars['EVENT']->value){
$_smarty_tpl->tpl_vars['EVENT']->_loop = true;
 $_smarty_tpl->tpl_vars[$_smarty_tpl->tpl_vars['keyEvent']->value]->value = $_smarty_tpl->tpl_vars['EVENT']->key;
?><?php if ($_smarty_tpl->tpl_vars['keyEvent']->value==0&&$_smarty_tpl->tpl_vars['EVENT']->value['cf_1085']==''){?><label style="font-weight: bold">Новая задача <?php echo date('d.m.y H:i',strtotime($_smarty_tpl->tpl_vars['EVENT']->value['createdtime']));?>
</label><?php echo $_smarty_tpl->tpl_vars['EVENT']->value['subject'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['EVENT']->value['description'];?>
<?php }else{ ?><small style="color: #999;"><?php echo date('d.m.y H:i',strtotime($_smarty_tpl->tpl_vars['EVENT']->value['createdtime']));?>
<br /><?php echo $_smarty_tpl->tpl_vars['EVENT']->value['description'];?>
</small><label style="font-weight: bold">Сделано по предыдущей задаче: </label><?php echo $_smarty_tpl->tpl_vars['EVENT']->value['cf_1085'];?>
<?php }?><?php } ?>--><?php if (count($_smarty_tpl->tpl_vars['LISTEVENT']->value[1])!=0){?><small style="color: #999;"><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['subject'];?>
 <?php echo date('d.m.y H:i',strtotime($_smarty_tpl->tpl_vars['LISTEVENT']->value[1]['createdtime']));?>
<br /><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[1]['description'];?>
</small><label style="font-weight: bold">Сделано по предыдущей задаче: </label><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[1]['cf_1085'];?>
<hr /><?php }?><?php if (count($_smarty_tpl->tpl_vars['LISTEVENT']->value[0])!=0&&$_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['cf_1085']==''){?><label style="font-weight: bold">Новая задача <?php echo date('d.m.y H:i',strtotime($_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['createdtime']));?>
</label><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['subject'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['description'];?>
<?php }else{ ?><small style="color: #999;"><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['subject'];?>
 <?php echo date('d.m.y H:i',strtotime($_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['createdtime']));?>
<br /><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['description'];?>
</small><label style="font-weight: bold">Сделано по предыдущей задаче: </label><?php echo $_smarty_tpl->tpl_vars['LISTEVENT']->value[0]['cf_1085'];?>
<?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['priority']!=''){?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['priority']=='Ahight'){?><b><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['priority'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b><?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['priority'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?><hr /><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['rating']!=''){?><b>Тип клиента:</b><br /><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['rating'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['leadsource']!=''){?><br /><b>Источник:</b><br /><span class=""><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['leadsource'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php }?></td>
<?php }} ?>