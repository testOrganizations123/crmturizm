<?php /* Smarty version Smarty-3.1.7, created on 2017-05-02 19:15:42
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\List.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1514459037f5c765292-33098851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92ea966187610c546b0ab57a7b4728988e10d0cc' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\List.tpl',
      1 => 1493667574,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1514459037f5c765292-33098851',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_59037f5c83f96',
  'variables' => 
  array (
    'MODE' => 0,
    'FILTER' => 0,
    'item' => 0,
    'MODULE' => 0,
    'USER_MODEL' => 0,
    'PICKLIST_VALUE' => 0,
    'EDITPLANBUTTON' => 0,
    'EDITPLAN' => 0,
    'FRANCHISECHECKBOX' => 0,
    'VALCHECKBOX' => 0,
    'FUNNELNEW' => 0,
    'GRAFDIV' => 0,
    'iddiv' => 0,
    'DIVSTILE' => 0,
    'PLAN' => 0,
    'TABLE' => 0,
    'title' => 0,
    'name' => 0,
    'value' => 0,
    'ADDSCRIPTS' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59037f5c83f96')) {function content_59037f5c83f96($_smarty_tpl) {?>

<div id="listViewContents" class="VDDialogueDesigner_container listViewPageDiv listViewContentDiv"style="padding-left: 3%;padding-right: 3%"><br/><br/><div class="listViewEntriesTable row-fluid"><form action="index.php?module=VDCustomReports&view=List&mode=<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
" method="GET"><input type="hidden" name="module" value="VDCustomReports"><input type="hidden" name="view" value="List"><input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
"><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FILTER']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><div class="span2"><label><?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
</label><?php if (isset($_smarty_tpl->tpl_vars['item']->value['tpl'])){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['item']->value['tpl'],$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value), 0);?>
<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="select"){?><div class="row-fluid"><select class='listSearchContributor region span12' name='filtre[region]'data-fieldinfo='{"mandatory":false,"presence":true,"quickcreate":false,"masseditable":true,"defaultvalue":false,"type":"reference","name":"office","label":"Офис"}' /><option value=''><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item']->value['option']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value['value'];?>
"data-picklistvalue='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value['value']);?>
' <?php if ($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value['value']==$_smarty_tpl->tpl_vars['item']->value['data']){?> selected <?php }?>data-userId="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('id');?>
"><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value['label'];?>
</option><?php } ?></select></div><?php }?></div><?php } ?><div class="span2"><label>&nbsp;</label><div class="row-fluid"><input type="submit" value="Сгенерировать" class="btn btn-success span12"/></div></div><?php if (isset($_smarty_tpl->tpl_vars['EDITPLANBUTTON']->value)&&$_smarty_tpl->tpl_vars['EDITPLANBUTTON']->value==true){?><div class="span2"><label>&nbsp;</label><div class="row-fluid"><input type="button" value="Редактировать" class="btn btn-success edit-button span12"onclick="window.location.href = 'index.php?module=VDCustomReports&view=List&mode=editSalesPlan'"></div></div><?php }?><?php if (isset($_smarty_tpl->tpl_vars['EDITPLAN']->value)){?><div class="span2"><label>&nbsp;</label><div class="row-fluid"><input type="button" value="Графики" class="btn btn-success edit-button span12"onclick="window.location.href = 'index.php?module=VDCustomReports&view=List&mode=getSalesPlan'"></div></div><?php }?><?php if (isset($_smarty_tpl->tpl_vars['FRANCHISECHECKBOX']->value)&&$_smarty_tpl->tpl_vars['FRANCHISECHECKBOX']->value==true){?><div class="span2"><label>&nbsp;</label><div class="row-fluid"><input type="checkbox" name="franchiseCheckbox" <?php if ($_smarty_tpl->tpl_vars['VALCHECKBOX']->value){?>checked<?php }?>> Франчайзинг</div></div><?php }?></form></div><hr/><div class="padding1per row-fluid" style="border:1px solid #ccc;"><?php if (isset($_smarty_tpl->tpl_vars['EDITPLAN']->value)){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("uitypes/editPlan.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['FUNNELNEW']->value)){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("uitypes/salesFunnel.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php  $_smarty_tpl->tpl_vars['iddiv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['iddiv']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['GRAFDIV']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['iddiv']->key => $_smarty_tpl->tpl_vars['iddiv']->value){
$_smarty_tpl->tpl_vars['iddiv']->_loop = true;
?><div id="<?php echo $_smarty_tpl->tpl_vars['iddiv']->value;?>
" class="<?php if ($_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['class']){?><?php echo $_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['class'];?>
<?php }else{ ?>span12<?php }?>"style=" height:<?php if ($_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['height']){?><?php echo $_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['height'];?>
<?php }else{ ?>500px<?php }?>; background-color: #FFFFFF; margin-left:0;"><?php if (!$_smarty_tpl->tpl_vars['PLAN']->value){?><?php if ($_smarty_tpl->tpl_vars['TABLE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]){?><table class="table-hover table"><tr><?php  $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['title']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['title']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['title']->key => $_smarty_tpl->tpl_vars['title']->value){
$_smarty_tpl->tpl_vars['title']->_loop = true;
?><th><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</th><?php } ?></tr><?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['TABLE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['value']->key;
?><tr <?php if ($_smarty_tpl->tpl_vars['name']->value=='Итого'||$_smarty_tpl->tpl_vars['name']->value=='Средняя'){?> class="success bold"<?php }?>><td><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</td><?php if (is_array($_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['dataField'])){?><?php  $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['title']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['dataField']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['title']->key => $_smarty_tpl->tpl_vars['title']->value){
$_smarty_tpl->tpl_vars['title']->_loop = true;
?><td><?php echo $_smarty_tpl->tpl_vars['value']->value[$_smarty_tpl->tpl_vars['title']->value];?>
</td><?php } ?><?php }else{ ?><td><?php if ($_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['dataField']==1){?><?php echo number_format($_smarty_tpl->tpl_vars['value']->value,0,'.',' ');?>
<?php }elseif($_smarty_tpl->tpl_vars['DIVSTILE']->value[$_smarty_tpl->tpl_vars['iddiv']->value]['dataField']==2){?><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
%<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
<?php }?></td><?php }?></tr><?php } ?></table><?php }?><?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("uitypes/tablePlan.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></div><?php } ?></div></div><script><?php  $_smarty_tpl->tpl_vars['script'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['script']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ADDSCRIPTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['script']->key => $_smarty_tpl->tpl_vars['script']->value){
$_smarty_tpl->tpl_vars['script']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['script']->value;?>
<?php } ?></script>

    <style>
        a.listScript {
            padding: 40px 20px;
            display: block;
            background: rgb(28, 116, 187) none repeat scroll 0% 0%;
            color: #fff !important;
            text-align: center;
            border-radius: 10px;
        }

        a.listScript h3 {
            color: #fff;
        }

        .edit-button {
            background-color: #5bb75b !important;
        }

        .tableEditPlan {
            margin-left: -8px;
            cursor: pointer;
            border: 1px solid #aad5fd;
            height: 27px;
            width: 98px;
            padding-right: 5px;
            margin-top: 2px;
        }

        .spantable{
            margin-top: -3px;
            float: right;
        }

        .table-info{
            padding-top: 53px;
        }

        .w-25{
            float: right;
            width: 25%;
        }

        .abc{
            display: none;
        }

        #getTableSum .abc{
            display: table!important;
         }

        .brighttheme{background: red;} .brighttheme *{color: white;}.ui-pnotify{ top:36px;right:36px;position:absolute;height:auto;z-index:2}body>.ui-pnotify{position:fixed;z-index:100040}.ui-pnotify-modal-overlay{background-color:rgba(0,0,0,.4);top:0;left:0;position:absolute;height:100%;width:100%;z-index:1}body>.ui-pnotify-modal-overlay{position:fixed;z-index:100039}.ui-pnotify.ui-pnotify-in{display:block!important}.ui-pnotify.ui-pnotify-move{transition:left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-slow{transition:opacity .6s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-slow.ui-pnotify.ui-pnotify-move{transition:opacity .6s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-normal{transition:opacity .4s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-normal.ui-pnotify.ui-pnotify-move{transition:opacity .4s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-fast{transition:opacity .2s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-fast.ui-pnotify.ui-pnotify-move{transition:opacity .2s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-in{opacity:1}.ui-pnotify .ui-pnotify-shadow{-webkit-box-shadow:0 6px 28px 0 rgba(0,0,0,.1);-moz-box-shadow:0 6px 28px 0 rgba(0,0,0,.1);box-shadow:0 6px 28px 0 rgba(0,0,0,.1)}.ui-pnotify-container{background-position:0 0;padding:.8em;height:100%;margin:0}.ui-pnotify-container:after{content:" ";visibility:hidden;display:block;height:0;clear:both}.ui-pnotify-container.ui-pnotify-sharp{-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}.ui-pnotify-title{display:block;margin-bottom:.4em;margin-top:0}.ui-pnotify-text{display:block}.ui-pnotify-icon,.ui-pnotify-icon span{display:block;float:left;margin-right:.2em}.ui-pnotify.stack-bottomleft,.ui-pnotify.stack-topleft{left:25px;right:auto}.ui-pnotify.stack-bottomleft,.ui-pnotify.stack-bottomright{bottom:25px;top:auto}.ui-pnotify.stack-modal{left:50%;right:auto;margin-left:-150px}
    </style>

<?php }} ?>