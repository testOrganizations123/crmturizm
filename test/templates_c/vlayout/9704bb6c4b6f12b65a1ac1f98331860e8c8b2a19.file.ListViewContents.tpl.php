<?php /* Smarty version Smarty-3.1.7, created on 2017-04-17 13:40:43
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/ListViewContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:691258486579c84b1051586-57097695%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9704bb6c4b6f12b65a1ac1f98331860e8c8b2a19' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Calendar/ListViewContents.tpl',
      1 => 1492425643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '691258486579c84b1051586-57097695',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_579c84b116544',
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
    'MODULE' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'CURRENT_USER_MODEL' => 0,
    'LISTVIEW_HEADERS' => 0,
    'LISTVIEW_HEADER' => 0,
    'COLUMN_NAME' => 0,
    'NEXT_SORT_ORDER' => 0,
    'SORT_IMAGE' => 0,
    'FIELD_UI_TYPE_MODEL' => 0,
    'SEARCH_DETAILS' => 0,
    'MOBILE' => 0,
    'OFFICE' => 0,
    'LIST_VIEW_MODEL' => 0,
    'EXPRESS' => 0,
    'LISTVIEW_ENTRY' => 0,
    'Ndate' => 0,
    'ListCall' => 0,
    'ListErrors' => 0,
    'DATE' => 0,
    'view' => 0,
    'LISTVIEW_ENTRIES' => 0,
    'TABLEOPEN' => 0,
    'NEWBLOCK' => 0,
    'trClass' => 0,
    'WIDTHTYPE' => 0,
    'PARENTMODULE' => 0,
    'PARENTMODULENAME' => 0,
    'labelClass' => 0,
    'IS_MODULE_EDITABLE' => 0,
    'IS_MODULE_DELETABLE' => 0,
    'SINGLE_MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_579c84b116544')) {function content_579c84b116544($_smarty_tpl) {?>
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
" id="noOfEntries"><?php $_smarty_tpl->tpl_vars['ALPHABETS_LABEL'] = new Smarty_variable(vtranslate('LBL_ALPHABETS','Vtiger'), null, 0);?><?php $_smarty_tpl->tpl_vars['ALPHABETS'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['ALPHABETS_LABEL']->value), null, 0);?><div id="selectAllMsgDiv" class="alert-block msgDiv noprint"><strong><a id="selectAllMsg"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount"></span>)</a></strong></div><div id="deSelectAllMsgDiv" class="alert-block msgDiv noprint"><strong><a id="deSelectAllMsg"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></strong></div><div class="listViewEntriesDiv "><div class=""><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><span class="listViewLoadingImageBlock hide modal noprint" id="loadingListViewModal"><img class="listViewLoadingImage" src="<?php echo vimage_path('loading.gif');?>
" alt="no-image" title="<?php echo vtranslate('LBL_LOADING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><p class="listViewLoadingMsg"><?php echo vtranslate('LBL_LOADING_LISTVIEW_CONTENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
........</p></span><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><table class="table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><th width="1%"><input type="hidden" id="listViewEntriesMainCheckBox" /></th><th>Офис</th><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='subject'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='parent_id'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='priority'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='created_user_id'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='activitytype'){?><?php continue 1?><?php }?><th nowrap <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last){?> <?php }?>><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label')=="Modified Time"){?>Активность<?php }else{ ?><a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
 icon-white"><?php }?></a><?php }?></th><?php } ?><th nowrap colspan="1">Телефон</th><th nowrap colspan="2">Источник</th></tr></thead><tr><td></td><td style="width:150px;"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/searchoffice.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value['assigned_user_id'],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
</td><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='subject'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='parent_id'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='priority'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='created_user_id'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='activitytype'){?><?php continue 1?><?php }?><td><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
</td><?php } ?><td><div class="row-fluid"><input name="mobile" class="span9 listSearchContributor phone" value="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
" data-fieldinfo='{"mandatory":true,"presence":true,"quickcreate":true,"masseditable":true,"defaultvalue":false,"type":"phone","name":"mobile","label":"Телефон"}' type="text"></div></td><td><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/searchsourse.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><td><!-- SalesPlatform.ru begin add locale --><button data-trigger="listSearch"><?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><!-- <button data-trigger="listSearch">Search</button> --><!-- SalesPlatform.ru end --></td></tr></table><?php $_smarty_tpl->tpl_vars['EXPRESS'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_VIEW_MODEL']->value->getListExpressTask($_smarty_tpl->tpl_vars['MOBILE']->value,$_smarty_tpl->tpl_vars['OFFICE']->value), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['EXPRESS']->value)!=0){?><div class="page-header" style="margin-bottom: 0;"><h3>Экспресс заявки</h3></div><table class="table table-hover table-responsive table-striped"><thead><tr><th>Дата создания</th><th>Имя туриста</th><th>Телефон туриста</th><th>Задача</th><th>Менеджер</th><th></th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['EXPRESS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['Ndate'] = new Smarty_variable(DateTimeField::convertToUserTimeZone($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['createdtime']), null, 0);?><tr class="top error"><td><?php echo $_smarty_tpl->tpl_vars['Ndate']->value->format('d.m.Y H:i');?>
</td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1115'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1117'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['description'];?>
 </td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['name'];?>
 </td><td><a href="index.php?module=Leads&view=Edit&express=<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
&mobile=<?php echo htmlspecialchars(str_replace("+7",'',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1117']));?>
&firstname=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1115']);?>
" class="btn btn-xs btn-warning pull-right" title="Позвонить"><i class="fa fa-phone"></i></a></td></tr><?php } ?></tbody></table><?php }?><?php $_smarty_tpl->tpl_vars['ListCall'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_VIEW_MODEL']->value->getListCall($_smarty_tpl->tpl_vars['MOBILE']->value,$_smarty_tpl->tpl_vars['OFFICE']->value), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['ListCall']->value)>0){?><div class="page-header" style="margin-bottom: 0;"><h3>Прилетевшие туристы <span class='redColor'>(<?php echo count($_smarty_tpl->tpl_vars['ListCall']->value);?>
) <small> </span> <a onclick='jQuery("#obzbon").toggle();'>показать</a></small></h3></div><table class="table table-hover table-responsive table-striped hide" id='obzbon'><thead><tr><th>Прилетел</th><th>ФИО туриста</th><th>Телефон</th><th><i class="fa fa-phone"></i></th><th>Место отдыха</th><th>Отель</th><th>Оператор</th><th>Кол-во ночей</th><th>Стоимость тура</th><th>Ответственный</th><th></th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ListCall']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
?><tr class="top error"><td><?php echo date('d.m.Y H:i',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1219']));?>
</td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['lastname'];?>
 <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['midlename'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['mobile'];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1454']>0){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1454'];?>
<?php }?></td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['country_name'];?>
,<br><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['resort'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1193'];?>
 </td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['turoperator_name'];?>
 </td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['cf_1201'];?>
 </td><td><?php echo number_format($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['amount'],2,","," ");?>
 </td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('assigned_user_id');?>
</td><td><a href="index.php?module=VDDialogueDesigner&view=RunScript&record=55&express=<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
&potentialid=<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['potentialid'];?>
" class="btn btn-xs btn-warning pull-right" title="Позвонить"><i class="fa fa-phone"></i></a></td></tr><?php } ?></tbody></table><?php }?><?php $_smarty_tpl->tpl_vars['ListErrors'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_VIEW_MODEL']->value->getListErrors(), null, 0);?><?php $_smarty_tpl->tpl_vars['ErrorKeys'] = new Smarty_variable(array_keys($_smarty_tpl->tpl_vars['ListErrors']->value), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['ListErrors']->value)>0){?><div class="page-header" style="margin-bottom: 0;"><h3>Замечания:</h3><table class="table-hover table table-bordered listViewEntriesTable"><thead><tr><th >Дата</th><th width="15%">Модуль</th><th>Нарушение</th><th width='80px'>Статус</th><th width='180px'>Ответственный</th><th></th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ListErrors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
?><tr class="top error"><td><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['due_date']!=$_smarty_tpl->tpl_vars['DATE']->value){?><?php echo date("d.m.y",strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['due_date']));?>
<br /><?php }?><?php echo date("H:i",strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['time_end']));?>
 <br /></td><td><span class="label label-<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['modulename'];?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['modulename'],$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['modulename']);?>
</span><br> <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['label_entity'];?>
<br><small>от <?php echo date('d.m.y',strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['createdtime']));?>
</small></td><td ><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['description_foul'];?>
</td><td><span class="label label-important"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['eventstatus'],'Calendar');?>
</span></td><td><small>→<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['notif'];?>
<br>Заявка: <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['owner'];?>
</small></small></td><td class="right nowrap"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['modulename']=='Potentials'){?><?php $_smarty_tpl->tpl_vars['view'] = new Smarty_variable("Edit", null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['view'] = new Smarty_variable("Detail", null, 0);?><?php }?><a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['modulename'];?>
&view=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&record=<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['idrecord'];?>
" class="btn btn-xs btn-warning" title="Редактировать"><i class="fa fa-pencil"></i></a></td></tr><?php } ?></tbody></table></div><?php }?><?php $_smarty_tpl->tpl_vars['NEWBLOCK'] = new Smarty_variable(1, null, 0);?><?php $_smarty_tpl->tpl_vars['DATE'] = new Smarty_variable(date('Y-m-d'), null, 0);?><?php $_smarty_tpl->tpl_vars['DATEFORMAT'] = new Smarty_variable("d.m.Y", null, 0);?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['due_date']>$_smarty_tpl->tpl_vars['DATE']->value){?><?php $_smarty_tpl->tpl_vars['NEWBLOCK'] = new Smarty_variable(2, null, 0);?><?php $_smarty_tpl->tpl_vars['DATE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['due_date'], null, 0);?><?php if ($_smarty_tpl->tpl_vars['TABLEOPEN']->value==1){?><?php $_smarty_tpl->tpl_vars['TABLEOPEN'] = new Smarty_variable(0, null, 0);?></tbody></table><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['NEWBLOCK']->value==1){?><hr /><br /><h3>Задачи на сегодня</h3><?php }elseif($_smarty_tpl->tpl_vars['NEWBLOCK']->value==2){?><hr /><br /><h3>Задачи на <?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['DATE']->value));?>
</h3><?php }?><?php if ($_smarty_tpl->tpl_vars['NEWBLOCK']->value!=0){?><?php $_smarty_tpl->tpl_vars['NEWBLOCK'] = new Smarty_variable(0, null, 0);?><table class="table-hover table table-bordered listViewEntriesTable"><thead><tr><th colspan="2">Дата</th><th>Тип</th><th>Заявка</th><th>Задача</th><th>Приоритет</th><th width='80px'>Статус</th><th>Автор<br>→&nbsp;Исп.</th><th></th></tr></thead><tbody><?php $_smarty_tpl->tpl_vars['TABLEOPEN'] = new Smarty_variable(1, null, 0);?><?php $_smarty_tpl->tpl_vars['NEWBLOCK'] = new Smarty_variable(0, null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['trClass'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getClassTrDate(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['priority']=='Ahight'){?><?php $_smarty_tpl->tpl_vars['trClass'] = new Smarty_variable('error', null, 0);?><?php }?><tr class="top <?php echo $_smarty_tpl->tpl_vars['trClass']->value;?>
" data-id='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
'><td  width="2%" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['leadid'];?>
" class="listViewEntriesCheckBox"/></td><td><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['due_date']!=$_smarty_tpl->tpl_vars['DATE']->value){?><?php echo date("d.m.y",strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['due_date']));?>
<br /><?php }?><?php echo date("H:i",strtotime($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['time_end']));?>
 <br /></td><?php $_smarty_tpl->tpl_vars['PARENTMODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getReferensModuleName(), null, 0);?><?php $_smarty_tpl->tpl_vars['PARENTMODULENAME'] = new Smarty_variable('', null, 0);?><?php if ($_smarty_tpl->tpl_vars['PARENTMODULE']->value){?><?php $_smarty_tpl->tpl_vars['PARENTMODULENAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['PARENTMODULE']->value['setype'], null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['PARENTMODULENAME']->value=='Leads'){?><?php $_smarty_tpl->tpl_vars['PARENTMODULENAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['PARENTMODULE']->value['setype'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getUitypeTemplate($_smarty_tpl->tpl_vars['PARENTMODULENAME']->value),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('uitypes/events.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><td><?php $_smarty_tpl->tpl_vars['labelClass'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getLabelStatusClass(), null, 0);?><span class="label <?php echo $_smarty_tpl->tpl_vars['labelClass']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['status'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><br /><span class=""><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['leadstatus'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><br /></td><td><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('created_user_id');?>
<br><small>→<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['owner'];?>
</small><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['oldowner']!=''){?><br><small>Передано от: <br><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['oldowner'];?>
</small><?php }?></td><td class="right nowrap"><?php if ($_smarty_tpl->tpl_vars['PARENTMODULENAME']->value=='Leads'){?><a href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDetailLinkParentModule($_smarty_tpl->tpl_vars['PARENTMODULENAME']->value,$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('id'));?>
" class="btn btn-xs btn-warning" title="Редактировать"><i class="fa fa-pencil"></i></a><br/><br/><a href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDetailLinkParentModule($_smarty_tpl->tpl_vars['PARENTMODULENAME']->value,$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('id'),1);?>
" class="btn btn-xs btn-warning" title="Исходящий звонок"><i class="fa fa-phone"></i></a><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['callid']>0){?><span class="callid"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->rawData['callid'];?>
</span><?php }?><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value){?><a class="btn btn-xs btn-warning" href='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getEditViewUrl();?>
'><i class="fa fa-pencil"></i></a>&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_DELETABLE']->value){?><br/><a class="btn btn-xs btn-error deleteRecordButton" ><i class="fa fa-trash"></i></a><?php }?><?php }?></td></tr><?php } ?><?php if ($_smarty_tpl->tpl_vars['TABLEOPEN']->value==1){?><?php $_smarty_tpl->tpl_vars['TABLEOPEN'] = new Smarty_variable(0, null, 0);?></tbody></table><?php }?><!--added this div for Temporarily --><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value=='0'){?><table class="emptyRecordsDiv"><tbody><tr><td><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE'] = new Smarty_variable("SINGLE_".($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php echo vtranslate('LBL_NOT_FOUND');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
.<?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value){?> <?php echo vtranslate('LBL_CREATE');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRecordUrl();?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }?></td></tr></tbody></table><?php }?></div></div><?php }} ?>