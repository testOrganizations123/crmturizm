<?php /* Smarty version Smarty-3.1.7, created on 2017-02-15 12:57:57
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/ListViewHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1434362428579f016029b5e0-29311281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '658bc8b8a1ca7f27351c82b8f7d9a68f9652d988' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/ListViewHeader.tpl',
      1 => 1487152671,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1434362428579f016029b5e0-29311281',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579f0160339eb',
  'variables' => 
  array (
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579f0160339eb')) {function content_579f0160339eb($_smarty_tpl) {?>
<div class="listViewPageDiv"><div class="listViewTopMenuDiv noprint"><div class="listViewActionsDiv row-fluid"><span class="btn-toolbar span7"><span class="btn-group"><button id="Calendar_listView_basicAction_LBL_ADD_TASK" class="btn addButton" onclick="window.location.href=&quot;index.php?module=Calendar&amp;view=Edit&amp;mode=Events&quot;"><i class="icon-plus"></i>&nbsp;<strong>Добавить Задачу</strong></button></span><span class="btn-group listViewMassActions"><button class="btn dropdown-toggle" data-toggle="dropdown"><strong>Добавить заявку</strong>&nbsp;&nbsp;<i class="caret"></i></button><ul class="dropdown-menu"><li ><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=579413" >Входящий звонок</a></li><li ><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=720999">Исходящий звонок</a></li><li ><a href="index.php?module=Leads&view=Edit&mb=1">Соц.сети</a></li><li class="divider"></li><li><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=203176">Встреча</a></li></ul></span><span class="btn-group"><button id="addExTask" class="btn addButton" ><i class="icon-plus"></i>&nbsp;<strong><?php echo vtranslate("Экспресс заявка",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></span><span class="btn-group"><button id="leads_mass_transfer" class="btn addButton" onclick="Leads_mass_transfer(event)"><i class="icon-refresh"></i>&nbsp;<strong>Передать Заявку</strong></button></span></span><span class="btn-toolbar span1"></span><span class="hide filterActionImages pull-right"><i title="<?php echo vtranslate('LBL_DENY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="deny" class="icon-ban-circle alignMiddle denyFilter filterActionImage pull-right"></i><i title="<?php echo vtranslate('LBL_APPROVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="approve" class="icon-ok alignMiddle approveFilter filterActionImage pull-right"></i><i title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="delete" class="icon-trash alignMiddle deleteFilter filterActionImage pull-right"></i><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="edit" class="icon-pencil alignMiddle editFilter filterActionImage pull-right"></i></span><span class="span4 btn-toolbar"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ListViewActions.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</span></div></div><div class="listViewContentDiv" id="listViewContents"><?php }} ?>