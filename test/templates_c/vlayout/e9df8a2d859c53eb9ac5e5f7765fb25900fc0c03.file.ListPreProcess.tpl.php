<?php /* Smarty version Smarty-3.1.7, created on 2017-04-28 20:43:42
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\ListPreProcess.tpl" */ ?>
<?php /*%%SmartyHeaderCode:295895901111fd965f9-00259608%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9df8a2d859c53eb9ac5e5f7765fb25900fc0c03' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\ListPreProcess.tpl',
      1 => 1493401186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '295895901111fd965f9-00259608',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5901111fdcc62',
  'variables' => 
  array (
    'MODULE' => 0,
    'MODE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901111fdcc62')) {function content_5901111fdcc62($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Header.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("BasicHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div class="bodyContents"><div class="mainContainer row-fluid"><div class="span2 row-fluid " id="leftPanel" style="min-height: 821px;"><div class="row-fluid"><div class="sideBarContents"><div class="quickLinksDiv"><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getLeadsReport'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getLeadsReport'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getLeadsReport"><strong>Заявки</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getBookingReport'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getBookingReport'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getBookingReport"><strong>Брони</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getStatistic'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getStatistic'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getStatistic"><strong>Статистика</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getAverage'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getAverage'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getAverage"><strong>Средний чек</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getProceeds'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getProceeds'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getProceeds"><strong>Выручка и Доход</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getSalesPlan'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getSalesPlan'||$_smarty_tpl->tpl_vars['MODE']->value=='editSalesPlan'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getSalesPlan"><strong>План продаж</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getSalesFunnel'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getSalesFunnel'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getSalesFunnel"><strong>Воронка продаж</strong></a></p></div></div></div></div><div class="contentsDiv span10 marginLeftZero" id="rightPanel" style="min-height:550px;"><div id="toggleButton" class="toggleButton" title="Показать/скрыть левую панель"><i id="tButtonImage" class="icon-chevron-left"></i></div><?php }} ?>