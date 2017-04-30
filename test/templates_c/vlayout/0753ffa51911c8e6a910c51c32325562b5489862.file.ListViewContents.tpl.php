<?php /* Smarty version Smarty-3.1.7, created on 2017-04-29 01:29:09
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\Potentials\ListViewContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:80615903c23522a287-35651011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0753ffa51911c8e6a910c51c32325562b5489862' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\Potentials\\ListViewContents.tpl',
      1 => 1493241761,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80615903c23522a287-35651011',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW' => 0,
    'PAGING_MODEL' => 0,
    'MODULE_MODEL' => 0,
    'OPERATOR' => 0,
    'ALPHABET_VALUE' => 0,
    'LISTVIEW_COUNT' => 0,
    'PAGE_NUMBER' => 0,
    'LISTVIEW_ENTRIES_COUNT' => 0,
    'ALPHABETS_LABEL' => 0,
    'ALPHABETS' => 0,
    'ALPHABET' => 0,
    'MODULE' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'CURRENT_USER_MODEL' => 0,
    'LISTVIEW_HEADERS' => 0,
    'NAME' => 0,
    'COLUMN_NAME' => 0,
    'LISTVIEW_HEADER' => 0,
    'NEXT_SORT_ORDER' => 0,
    'SORT_IMAGE' => 0,
    'SEARCH_DETAILS' => 0,
    'FIELD_UI_TYPE_MODEL' => 0,
    'MODULE_NAME' => 0,
    'statbron' => 0,
    'PHONE' => 0,
    'leadsource_header' => 0,
    'LIST_VIEW_MODEL' => 0,
    'LISTALERT' => 0,
    'ITEM' => 0,
    'IS_MODULE_EDITABLE' => 0,
    'SINGLE_MODULE' => 0,
    'privelege' => 0,
    'LISTVIEW_ENTRIES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5903c2353a924',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5903c2353a924')) {function content_5903c2353a924($_smarty_tpl) {?>
<input type="hidden" id="view" value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
" /><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="alphabetSearchKey" value= "<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getAlphabetSearchField();?>
" /><input type="hidden" id="Operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" /><input type="hidden" id="alphabetValue" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
" id='pageNumber'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" id='pageLimit'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" id="noOfEntries"><?php $_smarty_tpl->tpl_vars['ALPHABETS_LABEL'] = new Smarty_variable(vtranslate('LBL_ALPHABETS','Vtiger'), null, 0);?><?php $_smarty_tpl->tpl_vars['ALPHABETS'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['ALPHABETS_LABEL']->value), null, 0);?><div class="alphabetSorting noprint"><table width="100%" class="table-bordered" style="border: 1px solid #ddd;table-layout: fixed"><tbody><tr><?php  $_smarty_tpl->tpl_vars['ALPHABET'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALPHABET']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALPHABETS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ALPHABET']->key => $_smarty_tpl->tpl_vars['ALPHABET']->value){
$_smarty_tpl->tpl_vars['ALPHABET']->_loop = true;
?><td class="alphabetSearch textAlignCenter cursorPointer <?php if ($_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value==$_smarty_tpl->tpl_vars['ALPHABET']->value){?> highlightBackgroundColor <?php }?>" style="padding : 0px !important"><a id="<?php echo $_smarty_tpl->tpl_vars['ALPHABET']->value;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['ALPHABET']->value;?>
</a></td><?php } ?></tr></tbody></table></div><div id="selectAllMsgDiv" class="alert-block msgDiv noprint"><strong><a id="selectAllMsg"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount"></span>)</a></strong></div><div id="deSelectAllMsgDiv" class="alert-block msgDiv noprint"><strong><a id="deSelectAllMsg"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></strong></div><div class="listViewEntriesDiv "><div class=""><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><span class="listViewLoadingImageBlock hide modal noprint" id="loadingListViewModal"><img class="listViewLoadingImage" src="<?php echo vimage_path('loading.gif');?>
" alt="no-image" title="<?php echo vtranslate('LBL_LOADING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><p class="listViewLoadingMsg"><?php echo vtranslate('LBL_LOADING_LISTVIEW_CONTENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
........</p></span><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><table class="table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_smarty_tpl->tpl_vars['NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['NAME']->value = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><?php if ($_smarty_tpl->tpl_vars['NAME']->value=='leadsource'){?><?php }else{ ?><th nowrap <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last){?> colspan="2" <?php }?>><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
 icon-white"><?php }?></a></th><?php }?><?php } ?></tr></thead><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled()){?><tr><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_smarty_tpl->tpl_vars['NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['NAME']->value = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><?php if ($_smarty_tpl->tpl_vars['NAME']->value=='office'){?><td width='150px'><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/searchoffice.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
<?php }elseif($_smarty_tpl->tpl_vars['NAME']->value=='leadsource'){?><?php $_smarty_tpl->tpl_vars['leadsource_header'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value, null, 0);?><?php }else{ ?><td><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
<?php }?></td><?php } ?><td><button class="btn" data-trigger="listSearch"><?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></td></tr><tr> <td colspan="2"><select class="listSearchContributor statbron" name="statbron" data-fieldinfo='{"mandatory":true,"presence":true,"quickcreate":true,"masseditable":true,"defaultvalue":false,"type":"text","name":"statbron","label":"Состояние"}'><option value="">Состояние брони</option><option value="1" <?php if ($_smarty_tpl->tpl_vars['statbron']->value=="1"){?>selected<?php }?>>Не оплачено туристом</option><option value="2" <?php if ($_smarty_tpl->tpl_vars['statbron']->value=="2"){?>selected<?php }?>>Не оплачено туроператору</option><option value="3" <?php if ($_smarty_tpl->tpl_vars['statbron']->value=="3"){?>selected<?php }?>>Не подтверждено</option></select></td><td><b class="pull-right">Телефон</b></td><td><input name="mobile" style="width:100px;" class="listSearchContributor phone" value="<?php echo $_smarty_tpl->tpl_vars['PHONE']->value;?>
" data-fieldinfo="{&quot;mandatory&quot;:true,&quot;presence&quot;:true,&quot;quickcreate&quot;:true,&quot;masseditable&quot;:true,&quot;defaultvalue&quot;:false,&quot;type&quot;:&quot;phone&quot;,&quot;name&quot;:&quot;mobile&quot;,&quot;label&quot;:&quot;Телефон&quot;}"  type="text"></td><?php if ($_smarty_tpl->tpl_vars['leadsource_header']->value){?><td><b class="pull-right">Источник обращения</b></td><td><?php $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_variable($_smarty_tpl->tpl_vars['leadsource_header']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
</td><?php }?></tr><?php }?></table><?php $_smarty_tpl->tpl_vars['LISTALERT'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_VIEW_MODEL']->value->getListAlert(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['LISTALERT']->value['count']>0){?><br /><div class="alert alert-error"><h4>Задачи по этим броням просрочены более чем на сутки:</h4><ul class='alertBlock'><?php if (count($_smarty_tpl->tpl_vars['LISTALERT']->value['visa'])>0){?><li>Дата для визы: &nbsp;<?php  $_smarty_tpl->tpl_vars['ITEM'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ITEM']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTALERT']->value['visa']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ITEM']->key => $_smarty_tpl->tpl_vars['ITEM']->value){
$_smarty_tpl->tpl_vars['ITEM']->_loop = true;
?><a href="<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['link'];?>
"><span class='label-important label'>Договор №<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['dogovor'];?>
</span></a>&nbsp;<?php } ?></li><?php }?><?php if (count($_smarty_tpl->tpl_vars['LISTALERT']->value['control'])>0){?><li>Контрольная дата: &nbsp;<?php  $_smarty_tpl->tpl_vars['ITEM'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ITEM']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTALERT']->value['control']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ITEM']->key => $_smarty_tpl->tpl_vars['ITEM']->value){
$_smarty_tpl->tpl_vars['ITEM']->_loop = true;
?><a href="<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['link'];?>
"><span class='label-important label'>Договор №<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['dogovor'];?>
</span></a>&nbsp;<?php } ?></li><?php }?><?php if (count($_smarty_tpl->tpl_vars['LISTALERT']->value['turoperator'])>0){?><li>Срок оплаты оператору: &nbsp;<?php  $_smarty_tpl->tpl_vars['ITEM'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ITEM']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTALERT']->value['turoperator']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ITEM']->key => $_smarty_tpl->tpl_vars['ITEM']->value){
$_smarty_tpl->tpl_vars['ITEM']->_loop = true;
?><a href="<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['link'];?>
"><span class='label-important label'>Договор №<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['dogovor'];?>
</span></a>&nbsp;<?php } ?></li><?php }?><?php if (count($_smarty_tpl->tpl_vars['LISTALERT']->value['turist'])>0){?><li>Срок оплаты туристом: &nbsp;<?php  $_smarty_tpl->tpl_vars['ITEM'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ITEM']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTALERT']->value['turist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ITEM']->key => $_smarty_tpl->tpl_vars['ITEM']->value){
$_smarty_tpl->tpl_vars['ITEM']->_loop = true;
?><a href="<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['link'];?>
"><span class='label-important label'>Договор №<?php echo $_smarty_tpl->tpl_vars['ITEM']->value['dogovor'];?>
</span></a>&nbsp;<?php } ?></li><?php }?></ul></div><?php }?><!--added this div for Temporarily --><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value=='0'){?><table class="emptyRecordsDiv"><tbody><tr><td><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE'] = new Smarty_variable("SINGLE_".($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php echo vtranslate('LBL_NOT_FOUND');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
.<?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value){?> <?php echo vtranslate('LBL_CREATE');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRecordUrl();?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }?></td></tr></tbody></table><?php }else{ ?><?php $_smarty_tpl->tpl_vars['privelege'] = new Smarty_variable(explode('::',$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('privileges')->get('parent_role_seq')), null, 0);?><table class="table table-small table-hover table-responsive table-condensed table-bordered listViewEntriesTable" id="brontab"><thead><tr><th width="10px" rowspan="2"></th><th colspan="2" class="bg-1 center">Вылет</th><?php if (count($_smarty_tpl->tpl_vars['privelege']->value)<7){?><th rowspan="2" class="bg-2 center">Сотрудник<br>/Офис</th><?php }?><th rowspan="2" class="bg-2 center" style="min-width: 35px;">Конт-<br>роль</th><th rowspan="2" class="bg-2 center">Турист</th><th rowspan="2" class="bg-2 center">Телефон</th><th rowspan="2" class="bg-2 center">Направ-<br>ление</th><th rowspan="2" class="bg-2 center">Оператор</th><th rowspan="2" class="bg-2 center">Договор</th><th rowspan="2" class="bg-2 center">Бронь</th><th colspan="2" class="bg-3 center">Виза</th><th colspan="4" class="bg-4 center">Оплата туристом</th><th colspan="2" class="bg-41 center">Оператор</th><th rowspan="2" class="bg-42 right">Комиссия</th><th rowspan="2" class="bg-5 center" width="80">Документы на вылет</th><th rowspan="2"></th></tr><tr><th class="bg-1 center" colspan="" style="min-width:50px">Туда</th><th class="bg-5 center" style="min-width:40px">Об-<br>ратно</th><th class="bg-3 center">Статус</th><th class="bg-3 center" style="min-width: 35px;">Срок</th><th class="right bg-4">Стоимость</th><th class="right bg-4">Оплачено</th><th class="right bg-4">Долг</th><th class="left bg-4">Статус</th><th class="right bg-41">Стоимость</th><th class="right bg-41">Долг</th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/ListBron.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php } ?></tbody></table><?php }?></div></div>
<?php }} ?>