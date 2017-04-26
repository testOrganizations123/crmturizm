<?php /* Smarty version Smarty-3.1.7, created on 2016-07-09 20:05:59
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/ModuleDesigner/Filters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:208404669757812ef77cad51-65990200%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ba1e947563bb5ff6d1076a892773744c299c6c1' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/ModuleDesigner/Filters.tpl',
      1 => 1468083951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208404669757812ef77cad51-65990200',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57812ef77da19',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57812ef77da19')) {function content_57812ef77da19($_smarty_tpl) {?><table id="md-filters-table">
<tr>
<td>
<div id="md-filters-toolbar">
	<h2><?php echo vtranslate('LBL_FILTER_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h2>
	
	<ul id="md-filter-fields-list">
	<!-- Fields added with JS -->
	</ul>
</div>
</td>
<td>

<div id="md-add-filter-btn">
	<img src="layouts/vlayout/modules/Settings/<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
/assets/images/filter.png" alt="<?php echo vtranslate('LBL_ADD_FILTER_ALT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/> <a href="#" onclick="md_addFilter(); return false;"><?php echo vtranslate('LBL_ADD_FILTER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
</div>

<div>
<ul id="md-filters-ul">
<!-- Filters added with JS -->
</ul>
</div>
</td>
</table><?php }} ?>