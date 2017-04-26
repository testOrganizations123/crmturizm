<?php /* Smarty version Smarty-3.1.7, created on 2017-04-27 00:28:54
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\ListPreProcess.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1312458ff79b72593b7-90618240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3dd75be0c15a8b9ed9079a6dee973c4492022eaf' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\ListPreProcess.tpl',
      1 => 1493241812,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1312458ff79b72593b7-90618240',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58ff79b72a15f',
  'variables' => 
  array (
    'MODULE' => 0,
    'MODE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58ff79b72a15f')) {function content_58ff79b72a15f($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Header.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("BasicHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div class="bodyContents"><div class="mainContainer row-fluid"><div class="span2 row-fluid " id="leftPanel" style="min-height: 821px;"><div class="row-fluid"><div class="sideBarContents"><div class="quickLinksDiv"><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getLeadsReport'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getLeadsReport'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getLeadsReport"><strong>Заявки</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getBookingReport'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getBookingReport'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getBookingReport"><strong>Брони</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getStatistic'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getStatistic'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getStatistic"><strong>Статистика</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getAverage'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getAverage'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getAverage"><strong>Средний чек</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getProceeds'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getProceeds'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getProceeds"><strong>Выручка и Доход</strong></a></p><p onclick="window.location.href='index.php?module=VDCustomReports&view=List&mode=getSalesPlan'" id="Contacts_sideBar_link_LBL_DASHBOARD" class="<?php if ($_smarty_tpl->tpl_vars['MODE']->value=='getSalesPlan'||$_smarty_tpl->tpl_vars['MODE']->value=='editSalesPlan'){?>selectedQuickLink<?php }else{ ?>unSelectedQuickLink<?php }?>"><a class="quickLinks" href="index.php?module=VDCustomReports&view=List&mode=getSalesPlan"><strong>План продаж</strong></a></p></div></div></div></div><div class="contentsDiv span10 marginLeftZero" id="rightPanel" style="min-height:550px;"><div id="toggleButton" class="toggleButton" title="Показать/скрыть левую панель"><i id="tButtonImage" class="icon-chevron-left"></i></div><?php }} ?>