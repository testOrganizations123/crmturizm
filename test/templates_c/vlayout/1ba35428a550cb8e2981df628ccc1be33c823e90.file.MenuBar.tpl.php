<?php /* Smarty version Smarty-3.1.7, created on 2017-06-30 17:18:43
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\Vtiger\MenuBar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1809858ff79af718904-27621964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1ba35428a550cb8e2981df628ccc1be33c823e90' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\Vtiger\\MenuBar.tpl',
      1 => 1498004396,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1809858ff79af718904-27621964',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58ff79af907d0',
  'variables' => 
  array (
    'MENU_STRUCTURE' => 0,
    'moreMenus' => 0,
    'MODULE' => 0,
    'HOME_MODULE_MODEL' => 0,
    'moduleName' => 0,
    'USER_MODEL' => 0,
    'topMenus' => 0,
    'moduleModel' => 0,
    'MENU_TOPITEMS_LIMIT' => 0,
    'MENU_SELECTED_MODULENAME' => 0,
    'VIEW' => 0,
    'topmenuClassName' => 0,
    'translatedModuleLabel' => 0,
    'moduleList' => 0,
    'NUMBER_OF_PARENT_TABS' => 0,
    'parent' => 0,
    'SPAN_CLASS' => 0,
    'REGION' => 0,
    'THEMES_LIST' => 0,
    'COUNTER' => 0,
    'SKIN_NAME' => 0,
    'SKIN_COLOR' => 0,
    'HEADER_LINKS' => 0,
    'obj' => 0,
    'src' => 0,
    'title' => 0,
    'childLinks' => 0,
    'href' => 0,
    'label' => 0,
    'onclick' => 0,
    'MENUS' => 0,
    'quickCreateModule' => 0,
    'singularLabel' => 0,
    'ANNOUNCEMENT' => 0,
    'announcement' => 0,
    'PARENT_MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58ff79af907d0')) {function content_58ff79af907d0($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["topMenus"] = new Smarty_variable($_smarty_tpl->tpl_vars['MENU_STRUCTURE']->value->getTop(), null, 0);?><?php $_smarty_tpl->tpl_vars["moreMenus"] = new Smarty_variable($_smarty_tpl->tpl_vars['MENU_STRUCTURE']->value->getMore(), null, 0);?><?php $_smarty_tpl->tpl_vars['NUMBER_OF_PARENT_TABS'] = new Smarty_variable(count(array_keys($_smarty_tpl->tpl_vars['moreMenus']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars['REGION'] = new Smarty_variable(array("H10","H11","H16","H49","H55","H62"), null, 0);?><div class="navbar" id="topMenus" style="overflow: hidden;height:40px;"><div class="navbar-inner" id="nav-inner"><div class="menuBar row-fluid"><div class="span9"><ul class="nav modulesList" id="largeNav"><li class="tabs"><a class="alignMiddle <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Home'){?> selected <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['HOME_MODULE_MODEL']->value->getDefaultUrl();?>
"><img src="<?php echo vimage_path('home.png');?>
" alt="<?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['moduleName']->value);?>
" title="<?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['moduleName']->value);?>
" /></a></li><!-- если админ - идем по настройкам системы --><?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()){?><?php  $_smarty_tpl->tpl_vars['moduleModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['moduleModel']->_loop = false;
 $_smarty_tpl->tpl_vars['moduleName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['topMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['topmenu']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['moduleModel']->key => $_smarty_tpl->tpl_vars['moduleModel']->value){
$_smarty_tpl->tpl_vars['moduleModel']->_loop = true;
 $_smarty_tpl->tpl_vars['moduleName']->value = $_smarty_tpl->tpl_vars['moduleModel']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['topmenu']['index']++;
?><?php $_smarty_tpl->tpl_vars['translatedModuleLabel'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['moduleModel']->value->get('label'),$_smarty_tpl->tpl_vars['moduleName']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["topmenuClassName"] = new Smarty_variable("tabs", null, 0);?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['topmenu']['index']>$_smarty_tpl->tpl_vars['MENU_TOPITEMS_LIMIT']->value&&$_smarty_tpl->tpl_vars['MENU_SELECTED_MODULENAME']->value!=$_smarty_tpl->tpl_vars['moduleName']->value){?><?php $_smarty_tpl->tpl_vars["topmenuClassName"] = new Smarty_variable("tabs opttabs", null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['moduleName']->value=='VDDialogueDesigner'&&($_smarty_tpl->tpl_vars['VIEW']->value=='ListScript'||$_smarty_tpl->tpl_vars['VIEW']->value=='RunScript')){?><?php }else{ ?><li class="<?php echo $_smarty_tpl->tpl_vars['topmenuClassName']->value;?>
"><a id="menubar_item_<?php echo $_smarty_tpl->tpl_vars['moduleName']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getDefaultUrl();?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE']->value==$_smarty_tpl->tpl_vars['moduleName']->value){?> class="selected" <?php }?>><strong><?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
</strong></a></li><?php }?><?php } ?><li class="tabs"><a class="<?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='VDDialogueDesigner'&&($_smarty_tpl->tpl_vars['VIEW']->value=='ListScript'||$_smarty_tpl->tpl_vars['VIEW']->value=='RunScript')){?> selected <?php }?>" href="index.php?module=VDDialogueDesigner&view=ListScript"><strong>Скрипты</strong></a></li><!-- если НЕ АДМИН - модули перечислены вручную --><?php }else{ ?><li class="tabs"><a id="menubar_item_Calendar" href="index.php?module=Calendar&amp;view=List"><strong>Календарь</strong></a></li><li class="tabs"><a id="menubar_item_Potentials" href="index.php?module=Potentials&amp;view=List"><strong>Брони</strong></a></li><li class="tabs"><a id="menubar_item_MailManager" href="index.php?module=MailManager&amp;view=List"><strong>Менеджер почты</strong></a></li><li class="tabs"><a id="menubar_item_MailManager" href="index.php?module=VChat&amp;view=List"><strong>Чат</strong></a></li> <?php }?></ul><ul class="nav" id="shortNav"><li class="tabs"><a class="alignMiddle <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Home'){?> selected <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['HOME_MODULE_MODEL']->value->getDefaultUrl();?>
"><img src="<?php echo vimage_path('home.png');?>
" alt="<?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['moduleName']->value);?>
" title="<?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['moduleName']->value);?>
" /></a></li><li class="dropdown tabs" id="collapsedMenu"><a class="dropdown-toggle" data-toggle="dropdown" href="#collapsedMenu"><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<b class="caret"></b></a><div class="dropdown-menu"><div class="shortDropdown"><?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()){?><?php  $_smarty_tpl->tpl_vars['moduleList'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['moduleList']->_loop = false;
 $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['moreMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['moduleList']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['moduleList']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['more']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['moduleList']->key => $_smarty_tpl->tpl_vars['moduleList']->value){
$_smarty_tpl->tpl_vars['moduleList']->_loop = true;
 $_smarty_tpl->tpl_vars['parent']->value = $_smarty_tpl->tpl_vars['moduleList']->key;
 $_smarty_tpl->tpl_vars['moduleList']->iteration++;
 $_smarty_tpl->tpl_vars['moduleList']->last = $_smarty_tpl->tpl_vars['moduleList']->iteration === $_smarty_tpl->tpl_vars['moduleList']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['more']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['more']['last'] = $_smarty_tpl->tpl_vars['moduleList']->last;
?><?php if ($_smarty_tpl->tpl_vars['moduleList']->value){?><strong><?php echo vtranslate("LBL_".($_smarty_tpl->tpl_vars['parent']->value),$_smarty_tpl->tpl_vars['moduleName']->value);?>
</strong><hr><?php  $_smarty_tpl->tpl_vars['moduleModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['moduleModel']->_loop = false;
 $_smarty_tpl->tpl_vars['moduleName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['moduleList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['moduleModel']->key => $_smarty_tpl->tpl_vars['moduleModel']->value){
$_smarty_tpl->tpl_vars['moduleModel']->_loop = true;
 $_smarty_tpl->tpl_vars['moduleName']->value = $_smarty_tpl->tpl_vars['moduleModel']->key;
?><?php $_smarty_tpl->tpl_vars['translatedModuleLabel'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['moduleModel']->value->get('label'),$_smarty_tpl->tpl_vars['moduleName']->value), null, 0);?><label class="moduleNames"><a id="menubar_item_<?php echo $_smarty_tpl->tpl_vars['moduleName']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getDefaultUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
</a></label><?php } ?><?php }?><?php } ?><?php }else{ ?><!-- перечень модулей НЕ АДМИНА для мобильной версии --><label class="moduleNames"><a id="menubar_item_Calendar" href="index.php?module=Calendar&amp;view=List">Календарь</a></label><label class="moduleNames"><a id="menubar_item_Potentials" href="index.php?module=Potentials&amp;view=List">Брони</a></label><label class="moduleNames"><a id="menubar_item_Contacts" href="index.php?module=Contacts&amp;view=List">Клиенты</a></label><label class="moduleNames"><a id="menubar_item_MailManager" href="index.php?module=MailManager&amp;view=List">Менеджер почты</a></label><?php }?></div></div></li></ul><ul class="nav modulesList" id="mediumNav"><li class="tabs"><a class="alignMiddle <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Home'){?> selected <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['HOME_MODULE_MODEL']->value->getDefaultUrl();?>
"><img src="<?php echo vimage_path('home.png');?>
" alt="<?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['moduleName']->value);?>
" title="<?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['moduleName']->value);?>
" /></a></li><?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()){?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['moduleModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['moduleModel']->_loop = false;
 $_smarty_tpl->tpl_vars['moduleName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['topMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['topmenu']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['moduleModel']->key => $_smarty_tpl->tpl_vars['moduleModel']->value){
$_smarty_tpl->tpl_vars['moduleModel']->_loop = true;
 $_smarty_tpl->tpl_vars['moduleName']->value = $_smarty_tpl->tpl_vars['moduleModel']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['topmenu']['index']++;
?><?php $_smarty_tpl->tpl_vars['translatedModuleLabel'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['moduleModel']->value->get('label'),$_smarty_tpl->tpl_vars['moduleName']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["topmenuClassName"] = new Smarty_variable("tabs", null, 0);?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['topmenu']['index']>2&&$_smarty_tpl->tpl_vars['MENU_SELECTED_MODULENAME']->value!=$_smarty_tpl->tpl_vars['moduleName']->value){?><?php $_smarty_tpl->tpl_vars["topmenuClassName"] = new Smarty_variable("tabs opttabs", null, 0);?><?php }?><li class="<?php echo $_smarty_tpl->tpl_vars['topmenuClassName']->value;?>
"><a id="menubar_item_<?php echo $_smarty_tpl->tpl_vars['moduleName']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getDefaultUrl();?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE']->value==$_smarty_tpl->tpl_vars['moduleName']->value){?> class="selected" <?php }?>><strong><?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
</strong></a></li><?php } ?><?php }else{ ?><li class="tabs"><a id="menubar_item_Calendar" href="index.php?module=Calendar&amp;view=List"><strong>Календарь</strong></a></li><li class="tabs"><a id="menubar_item_Potentials" href="index.php?module=Potentials&amp;view=List"><strong>Брони</strong></a></li><li class="tabs"><a id="menubar_item_Contacts" href="index.php?module=Contacts&amp;view=List"><strong>Клиенты</strong></a></li><li class="tabs"><a id="menubar_item_MailManager" href="index.php?module=MailManager&amp;view=List"><strong>Менеджер почты</strong></a></li><?php }?></ul><?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()){?><ul class="nav" id="commonMoreMenu"><li class="dropdown" id="moreMenu"><a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu"><strong><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</strong><b class="caret"></b></a><div class="dropdown-menu moreMenus" <?php if (($_smarty_tpl->tpl_vars['NUMBER_OF_PARENT_TABS']->value<=2)&&($_smarty_tpl->tpl_vars['NUMBER_OF_PARENT_TABS']->value!=0)){?>style="width: 30em;"<?php }elseif($_smarty_tpl->tpl_vars['NUMBER_OF_PARENT_TABS']->value==0){?>style="width: 10em;"<?php }?>><?php  $_smarty_tpl->tpl_vars['moduleList'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['moduleList']->_loop = false;
 $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['moreMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['moduleList']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['moduleList']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['more']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['moduleList']->key => $_smarty_tpl->tpl_vars['moduleList']->value){
$_smarty_tpl->tpl_vars['moduleList']->_loop = true;
 $_smarty_tpl->tpl_vars['parent']->value = $_smarty_tpl->tpl_vars['moduleList']->key;
 $_smarty_tpl->tpl_vars['moduleList']->iteration++;
 $_smarty_tpl->tpl_vars['moduleList']->last = $_smarty_tpl->tpl_vars['moduleList']->iteration === $_smarty_tpl->tpl_vars['moduleList']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['more']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['more']['last'] = $_smarty_tpl->tpl_vars['moduleList']->last;
?><?php if ($_smarty_tpl->tpl_vars['NUMBER_OF_PARENT_TABS']->value>=4){?><?php $_smarty_tpl->tpl_vars['SPAN_CLASS'] = new Smarty_variable('span3', null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['NUMBER_OF_PARENT_TABS']->value==3){?><?php $_smarty_tpl->tpl_vars['SPAN_CLASS'] = new Smarty_variable('span4', null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['NUMBER_OF_PARENT_TABS']->value<=2){?><?php $_smarty_tpl->tpl_vars['SPAN_CLASS'] = new Smarty_variable('span6', null, 0);?><?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['more']['index']%4==0){?><?php if ($_smarty_tpl->tpl_vars['parent']->value=='ANALYTICS'){?><br><?php }?><div class="row-fluid"><?php }?><span class="<?php echo $_smarty_tpl->tpl_vars['SPAN_CLASS']->value;?>
"><strong><?php echo vtranslate("LBL_".($_smarty_tpl->tpl_vars['parent']->value),$_smarty_tpl->tpl_vars['moduleName']->value);?>
</strong><hr><?php  $_smarty_tpl->tpl_vars['moduleModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['moduleModel']->_loop = false;
 $_smarty_tpl->tpl_vars['moduleName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['moduleList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['moduleModel']->key => $_smarty_tpl->tpl_vars['moduleModel']->value){
$_smarty_tpl->tpl_vars['moduleModel']->_loop = true;
 $_smarty_tpl->tpl_vars['moduleName']->value = $_smarty_tpl->tpl_vars['moduleModel']->key;
?><?php $_smarty_tpl->tpl_vars['translatedModuleLabel'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['moduleModel']->value->get('label'),$_smarty_tpl->tpl_vars['moduleName']->value), null, 0);?><label class="moduleNames"><a id="menubar_item_<?php echo $_smarty_tpl->tpl_vars['moduleName']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getDefaultUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
</a></label><?php } ?></span><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['more']['last']||($_smarty_tpl->getVariable('smarty')->value['foreach']['more']['index']+1)%4==0){?></div><?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()){?><div class="row-fluid"><a id="menubar_item_moduleManager" href="index.php?module=MenuEditor&parent=Settings&view=Index" class="pull-right"><?php echo vtranslate('LBL_CUSTOMIZE_MAIN_MENU',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><div class="row-fluid"><a id="menubar_item_moduleManager" href="index.php?module=ModuleManager&parent=Settings&view=List" class="pull-right"><?php echo vtranslate('LBL_ADD_MANAGE_MODULES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><?php }?></div></li></ul><?php }else{ ?><ul class="nav" id="commonMoreMenu1"><li class="dropdown" id="moreMenu"><a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu" style="color:#fff"><strong><?php echo vtranslate('Справочники',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</strong><b class="caret"></b></a><div class="dropdown-menu"><div class="shortDropdown"><label class="moduleNames"><a id="menubar_item_ClientTypes" href="index.php?module=ClientTypes&amp;view=List">Типы Номеров</a></label><label class="moduleNames"><a id="menubar_item_ListAccommodations" href="index.php?module=ListAccommodations&amp;view=List">Тип размешения</a></label><?php if (is_array($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('roleid'),$_smarty_tpl->tpl_vars['REGION']->value)){?><label class="moduleNames"><a id="menubar_item_ListCountry" href="index.php?module=ListCountry&view=List">Страны</a></label><label class="moduleNames"><a id="menubar_item_ListTouroperators" href="index.php?module=ListTouroperators&view=List">Туроператоры</a></label><label class="moduleNames"><a id="menubar_item_Documents" href="index.php?module=Documents&view=List">Доп.Материалы</a></label><?php }?></div></div></li></ul><?php }?><ul class="nav" id="commonMoreMenu2"><li class="dropdown" id="moreMenu2"><a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu2" style="color:#fff"><strong><?php echo vtranslate('Аналитика',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</strong><b class="caret"></b></a><div class="dropdown-menu"><div class="shortDropdown"><label class="moduleNames"><a id="report_leads" href="index.php?module=VDCustomReports&view=List&mode=getLeadsReport">Заявки</a></label><label class="moduleNames"><a id="report_bron" href="index.php?module=VDCustomReports&view=List&mode=getBookingReport">Брони</a></label><label class="moduleNames"><a id="report_stat" href="index.php?module=VDCustomReports&view=List&mode=getStatistic">Статистика</a></label><label class="moduleNames"><a id="report_avg" href="index.php?module=VDCustomReports&view=List&mode=getAverage">Средний чек</a></label><label class="moduleNames"><a id="report_proceeds" href="index.php?module=VDCustomReports&view=List&mode=getProceeds">Выручка и Доход</a></label><label class="moduleNames"><a id="sales_plan" href="index.php?module=VDCustomReports&view=List&mode=getSalesPlan">План продаж</a></label><label class="moduleNames"><a id="sales_funnel" href="index.php?module=VDCustomReports&view=List&mode=getSalesFunnel">Воронка продаж</a></label><label class="moduleNames"><a id="vilety" href="index.php?module=VDCustomReports&view=List&mode=getPolet">Города вылетов(в разработке)</a></label></div></div></li></ul><?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->getRole()=='H10'||$_smarty_tpl->tpl_vars['USER_MODEL']->value->getRole()=='H11'||$_smarty_tpl->tpl_vars['USER_MODEL']->value->getRole()=='H16'||$_smarty_tpl->tpl_vars['USER_MODEL']->value->getRole()=='H49'||$_smarty_tpl->tpl_vars['USER_MODEL']->value->getRole()=='H55'||$_smarty_tpl->tpl_vars['USER_MODEL']->value->getRole()=='H62'||$_smarty_tpl->tpl_vars['USER_MODEL']->value->getRole()=='H3'){?><ul class="nav" id="commonMoreMenu3"><li class="dropdown" id="moreMenu3"><a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu3" style="color:#fff"><strong><?php echo vtranslate('Мастер тура',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</strong><b class="caret"></b></a><div class="dropdown-menu"><div class="shortDropdown"><label class="moduleNames"><a id="report_leads" href="index.php?module=ListTouroperators&view=List">Туроператоры</a></label><label class="moduleNames"><a id="report_bron" href="index.php?module=ClientTypes&view=List">Типы Номеров</a></label><label class="moduleNames"><a id="report_stat" href="index.php?module=VisaDocuments&view=List">Документы на визу</a></label><label class="moduleNames"><a id="report_avg" href="index.php?module=TypeTourisVisa&view=List">Типы туристов для визы</a></label><label class="moduleNames"><a id="report_proceeds" href="index.php?module=ListFoods&view=List">Типы питания</a></label><label class="moduleNames"><a id="sales_plan" href="index.php?module=ListAccommodations&view=List">Типы размещения</a></label><label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListResorts&view=List">Курорты</a></label><label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListCountry&view=List">Страны</a></label><label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListAirports&view=List">Аэропорты</a></label><label class="moduleNames"><a id="sales_funnel" href="index.php?module=ListAirlines&view=List">Авиалинии</a></label><label class="moduleNames"><a id="sales_funnel" href="index.php?module=Services&view=List">Услуги</a></label></div></div></li></ul><?php }?><ul class="nav" id="commonMoreMenu234"><li class="dropdown" id="moreMenu234"><a class="dropdown-toggle" data-toggle="dropdown" href="#moreMenu234" style="color:#fff"><strong><?php echo vtranslate('Бухгалтерия',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</strong><b class="caret"></b></a><div class="dropdown-menu"><div class="shortDropdown"><label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=workingHours">Учет рабочего времени</a></label><label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=vacationSchedule">График отпусков</a></label><label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=salary">Учет заработной платы</a></label><label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=holidays">Праздничные дни</a></label><label class="moduleNames"><a href="/index.php?module=Accounting&view=List&mode=optionSalary">Параметры начисления заработной платы</a></label></div></div></li></ul></div><div class="span3 marginLeftZero pull-right" id="headerLinks"><span id="headerLinksBig" class="pull-right headerLinksContainer"><span class="dropdown span settingIcons"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo vimage_path('theme_brush.png');?>
" alt="theme roller" title="<?php echo vtranslate('Theme Roller',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" /></a><ul class="dropdown-menu themeMenuContainer"><div id="themeContainer"><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars['THEMES_LIST'] = new Smarty_variable(Vtiger_Theme::getAllSkins(), null, 0);?><div class="row-fluid themeMenu"><?php  $_smarty_tpl->tpl_vars['SKIN_COLOR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SKIN_COLOR']->_loop = false;
 $_smarty_tpl->tpl_vars['SKIN_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['THEMES_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SKIN_COLOR']->key => $_smarty_tpl->tpl_vars['SKIN_COLOR']->value){
$_smarty_tpl->tpl_vars['SKIN_COLOR']->_loop = true;
 $_smarty_tpl->tpl_vars['SKIN_NAME']->value = $_smarty_tpl->tpl_vars['SKIN_COLOR']->key;
?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value==3){?></div><div class="row-fluid themeMenu"><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?><?php }?><div class="span4 themeElement <?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('theme')==$_smarty_tpl->tpl_vars['SKIN_NAME']->value){?>themeSelected<?php }?>" data-skin-name="<?php echo $_smarty_tpl->tpl_vars['SKIN_NAME']->value;?>
" title="<?php echo ucfirst($_smarty_tpl->tpl_vars['SKIN_NAME']->value);?>
" style="background-color:<?php echo $_smarty_tpl->tpl_vars['SKIN_COLOR']->value;?>
;"></div><?php } ?></div></div><div id="progressDiv"></div></ul></span><?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['HEADER_LINKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value){
$_smarty_tpl->tpl_vars['obj']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['obj']->key;
?><?php $_smarty_tpl->tpl_vars["src"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getIconPath(), null, 0);?><?php $_smarty_tpl->tpl_vars["icon"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getIcon(), null, 0);?><?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getLabel(), null, 0);?><?php $_smarty_tpl->tpl_vars["childLinks"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getChildLinks(), null, 0);?><span class="dropdown span<?php if (!empty($_smarty_tpl->tpl_vars['src']->value)){?> settingIcons <?php }?>"><?php if (!empty($_smarty_tpl->tpl_vars['src']->value)){?><a id="menubar_item_right_<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['src']->value;?>
" alt="<?php echo vtranslate($_smarty_tpl->tpl_vars['title']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['title']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" /></a><?php }else{ ?><?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('first_name'), null, 0);?><?php if (empty($_smarty_tpl->tpl_vars['title']->value)){?><?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('last_name'), null, 0);?><?php }?><span class="dropdown-toggle" data-toggle="dropdown" href="#"><a id="menubar_item_right_<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"  class="userName textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"><strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>&nbsp;<i class="caret"></i> </a> </span><?php }?><?php if (!empty($_smarty_tpl->tpl_vars['childLinks']->value)){?><ul class="dropdown-menu pull-right"><?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['childLinks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value){
$_smarty_tpl->tpl_vars['obj']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['obj']->key;
?><?php if ($_smarty_tpl->tpl_vars['obj']->value->getLabel()==null){?><li class="divider">&nbsp;</li><?php }else{ ?><?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getId(), null, 0);?><?php $_smarty_tpl->tpl_vars["href"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getUrl(), null, 0);?><?php $_smarty_tpl->tpl_vars["label"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getLabel(), null, 0);?><?php $_smarty_tpl->tpl_vars["onclick"] = new Smarty_variable('', null, 0);?><?php if (stripos($_smarty_tpl->tpl_vars['obj']->value->getUrl(),'javascript:')===0){?><?php $_smarty_tpl->tpl_vars["onclick"] = new Smarty_variable(("onclick=").($_smarty_tpl->tpl_vars['href']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["href"] = new Smarty_variable("javascript:;", null, 0);?><?php }?><li><a target="<?php echo $_smarty_tpl->tpl_vars['obj']->value->target;?>
" id="menubar_item_right_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['label']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['label']->value=='Switch to old look'){?>switchLook<?php }?> href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['onclick']->value;?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['label']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><?php } ?></ul><?php }?></span><?php } ?></span><div id="headerLinksCompact"><span class="btn-group dropdown qCreate cursorPointer"><img src="<?php echo vimage_path('btnAdd_white.png');?>
" class="" alt="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" title="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-toggle="dropdown"/><ul class="dropdown-menu dropdownStyles pull-right commonActionsButtonDropDown"><li class="title"><strong><?php echo vtranslate('Quick Create',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></li><hr/><li id="compactquickCreate"><div class="CompactQC"><?php  $_smarty_tpl->tpl_vars['moduleModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['moduleModel']->_loop = false;
 $_smarty_tpl->tpl_vars['moduleName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MENUS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['moduleModel']->key => $_smarty_tpl->tpl_vars['moduleModel']->value){
$_smarty_tpl->tpl_vars['moduleModel']->_loop = true;
 $_smarty_tpl->tpl_vars['moduleName']->value = $_smarty_tpl->tpl_vars['moduleModel']->key;
?><?php if ($_smarty_tpl->tpl_vars['moduleModel']->value->isPermitted('EditView')){?><?php $_smarty_tpl->tpl_vars['quickCreateModule'] = new Smarty_variable($_smarty_tpl->tpl_vars['moduleModel']->value->isQuickCreateSupported(), null, 0);?><?php $_smarty_tpl->tpl_vars['singularLabel'] = new Smarty_variable($_smarty_tpl->tpl_vars['moduleModel']->value->getSingularLabelKey(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['quickCreateModule']->value=='1'){?><a class="quickCreateModule" data-name="<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getName();?>
"data-url="<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getQuickCreateUrl();?>
" href="javascript:void(0)"><?php echo vtranslate($_smarty_tpl->tpl_vars['singularLabel']->value,$_smarty_tpl->tpl_vars['moduleName']->value);?>
</a><?php }?><?php }?><?php } ?></div></li></ul></span><span  class="dropdown"><a class="dropdown-toggle btn-navbar" data-toggle="dropdown" href="#"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><ul class="dropdown-menu pull-right"><?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['HEADER_LINKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["compactIndex"]['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value){
$_smarty_tpl->tpl_vars['obj']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['obj']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["compactIndex"]['index']++;
?><?php $_smarty_tpl->tpl_vars["src"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getIconPath(), null, 0);?><?php $_smarty_tpl->tpl_vars["icon"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getIcon(), null, 0);?><?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getLabel(), null, 0);?><?php $_smarty_tpl->tpl_vars["childLinks"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getChildLinks(), null, 0);?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['compactIndex']['index']!=0){?><li class="divider">&nbsp;</li><?php }?><?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['childLinks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value){
$_smarty_tpl->tpl_vars['obj']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['obj']->key;
?><?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getId(), null, 0);?><?php $_smarty_tpl->tpl_vars["href"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getUrl(), null, 0);?><?php $_smarty_tpl->tpl_vars["label"] = new Smarty_variable($_smarty_tpl->tpl_vars['obj']->value->getLabel(), null, 0);?><?php $_smarty_tpl->tpl_vars["onclick"] = new Smarty_variable('', null, 0);?><?php if (stripos($_smarty_tpl->tpl_vars['obj']->value->getUrl(),'javascript:')===0){?><?php $_smarty_tpl->tpl_vars["onclick"] = new Smarty_variable(("onclick=").($_smarty_tpl->tpl_vars['href']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["href"] = new Smarty_variable("javascript:;", null, 0);?><?php }?><li><a target="<?php echo $_smarty_tpl->tpl_vars['obj']->value->target;?>
" id="menubar_item_right_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['label']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['label']->value=='Switch to old look'){?>switchLook<?php }?> href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['onclick']->value;?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['label']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php } ?><?php } ?></ul></span></div></div></div><div class="clearfix"></div></div></div><?php $_smarty_tpl->tpl_vars["announcement"] = new Smarty_variable($_smarty_tpl->tpl_vars['ANNOUNCEMENT']->value->get('announcement'), null, 0);?><div class="announcement noprint" id="announcement"><marquee direction="left" scrolldelay="10" scrollamount="3" behavior="scroll" class="marStyle" onMouseOver="this.setAttribute('scrollamount', 0, 0);" OnMouseOut="this.setAttribute('scrollamount', 6, 0);"><?php if (!empty($_smarty_tpl->tpl_vars['announcement']->value)){?><?php echo $_smarty_tpl->tpl_vars['announcement']->value;?>
<?php }else{ ?><?php echo vtranslate('LBL_NO_ANNOUNCEMENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?></marquee></div><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" id='module' name='module'/><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_MODULE']->value;?>
" id="parent" name='parent' /><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
" id='view' name='view'/>
<?php }} ?>