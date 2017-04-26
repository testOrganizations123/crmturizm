<?php /* Smarty version Smarty-3.1.7, created on 2017-01-08 17:38:37
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/VDNotifierPro/Index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30724094658724eed4ea8a9-36526813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d16582efd06c08a71b7a030c81ffe0c2f0c0caf' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/VDNotifierPro/Index.tpl',
      1 => 1483886289,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30724094658724eed4ea8a9-36526813',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'SETTING' => 0,
    'ALL_MODULES' => 0,
    'MODULE_MODEL' => 0,
    'MODULE_ACTIVE' => 0,
    'MODULE_NAME' => 0,
    'COUNTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58724eed5f720',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58724eed5f720')) {function content_58724eed5f720($_smarty_tpl) {?>
<div class="container-fluid" id="moduleManagerContents"><div class="widget_header row-fluid"><div class="span6"><h3><?php echo vtranslate('LBL_NOTIFIERPRO_MANAGER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3></div><div class="span6"></div></div><hr><div class="widget_header row-fluid"><div class="span2"><h5><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</h5></div><div class="span2"><span class="row-fluid"><span class="span9"><label><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_ajaxNotifier',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></span><span class="span3"><input name="ajaxVDNotifier" id="ajaxVDNotifier" value="1" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['SETTING']->value['a']==1){?>checked="checked" <?php }?>></span></span></div><div class="span2"><span class="row-fluid"><span class="span6"><label><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></span><span class="span6"><select name="ajaxTime" id="ajaxTime" class="chzn-select" style="width:80px;"><option value="5000" <?php if ($_smarty_tpl->tpl_vars['SETTING']->value['t']==5000){?>selected="selected" <?php }?>><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_5SEC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="10000" <?php if ($_smarty_tpl->tpl_vars['SETTING']->value['t']==10000){?>selected="selected" <?php }?>><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_10SEC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="15000" <?php if ($_smarty_tpl->tpl_vars['SETTING']->value['t']==15000){?>selected="selected" <?php }?>><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_15SEC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="30000" <?php if ($_smarty_tpl->tpl_vars['SETTING']->value['t']==30000){?>selected="selected" <?php }?>><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_30SEC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="60000" <?php if ($_smarty_tpl->tpl_vars['SETTING']->value['t']==60000){?>selected="selected" <?php }?>><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_TIMER_1MIN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></span></span></div><div class="span2" style="display:none"><span class="row-fluid"><span class="span3"><label><?php echo vtranslate('LBL_NOTIFIERPRO_SETTING_KEY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></span><span class="span9"><input name="keyVDNotifier" id="keyVDNotifier" class="input-large" value="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value['k'];?>
" <?php if ($_smarty_tpl->tpl_vars['SETTING']->value['k']!=''){?>readonly="readonly" <?php }?> type="text" /></span></span></div><div class="span2" style="display:none"><?php if ($_smarty_tpl->tpl_vars['SETTING']->value['k']!=''){?><button class="btn btn-success deleteDomen pull-left" ><strong><?php echo vtranslate('LBL_DELETE');?>
</strong></button><?php }else{ ?><button class="btn btn-success installDomen pull-left" ><strong><?php echo vtranslate('LBL_INSTALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php }?></div><div class="span2"><button class="btn btn-success saveSetting pull-right" ><strong><?php echo vtranslate('LBL_SAVE');?>
</strong></button></div></div><hr><div class="contents"><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><table class="table table-bordered equalSplit"><tr><th width="100%"><div class="row-fluid"><span class="span3"><?php echo vtranslate('LBL_NOTIFIERPRO_MODULE_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="span9"><div class="row-fluid"><span class="span2"><?php echo vtranslate('LBL_NOTIFIERPRO_STATUS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="span2"><?php echo vtranslate('LBL_NOTIFIERPRO_CREATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="span2"><?php echo vtranslate('LBL_NOTIFIERPRO_OWNER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="span2"><?php echo vtranslate('LBL_NOTIFIERPRO_MODIFICATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="span2"><?php echo vtranslate('LBL_NOTIFIERPRO_CREATE_SHOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="span2"><?php echo vtranslate('LBL_NOTIFIERPRO_UPDATE_SHOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div></span></div></th></tr><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_ID']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_ACTIVE'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive(), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getID(), null, 0);?><tr><td class="opacity"><div class="row-fluid moduleManagerBlock"><span class="span3"><div class="row-fluid"><span class="span2 moduleImage <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value){?>dull <?php }?>"><?php if (vimage_path(($_smarty_tpl->tpl_vars['MODULE_NAME']->value).('.png'))!=false){?><img class="alignMiddle" src="<?php echo vimage_path(($_smarty_tpl->tpl_vars['MODULE_NAME']->value).('.png'));?>
" alt="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"/><?php }else{ ?><img class="alignMiddle" src="<?php echo vimage_path('DefaultModule.png');?>
" alt="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"/><?php }?></span><span class="span10 moduleName <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value){?>dull <?php }?>"><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></span></div></span><span class="span9"><div class="row-fluid"><span class="span2" ><input class="VDNotifierProInput " data-placement="right" data-toggle="tooltips" data-original-title="<?php echo vtranslate('LBL_NOTIFIERPRO_STATUS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="checkbox" value=""  name="status" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->setting['status']){?>checked<?php }?> /></span><span class="span2"><input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="<?php echo vtranslate('LBL_NOTIFIERPRO_CREATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="checkbox" value="" title="" name="creator" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->setting['creator']){?>checked<?php }?> /></span><span class="span2"><input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="<?php echo vtranslate('LBL_NOTIFIERPRO_OWNER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="checkbox" value="" title="" name="owner" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->setting['owner']){?>checked<?php }?> /></span><span class="span2"><input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="<?php echo vtranslate('LBL_NOTIFIERPRO_MODIFICATOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="checkbox" value="" title="" name="modif" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->setting['modif']){?>checked<?php }?> /></span><span class="span2"><input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="<?php echo vtranslate('LBL_NOTIFIERPRO_CREATE_SHOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="checkbox" value="" title="" name="newentity" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->setting['newentity']){?>checked<?php }?> /></span><span class="span2"><input class="VDNotifierProInput" data-placement="right" data-toggle="tooltips" data-original-title="<?php echo vtranslate('LBL_NOTIFIERPRO_UPDATE_SHOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="checkbox" value="" title="" name="updateentity" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->setting['updateentity']){?>checked<?php }?> /></span></div></span></div><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?></td></tr><?php } ?></table></div></div><div><p class="small pull-right">Power by VD Notifier Pro. All rights reserved. Copyright &copy; <?php echo date('Y');?>
 <a href='http://www.vordoom.net' target="_blank">www.vordoom.net</a> </p></div>
<?php }} ?>