<?php /* Smarty version Smarty-3.1.7, created on 2016-07-11 04:13:11
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/SPPDFTemplates/ListPDFTemplates.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1494629845782f2a76a1a46-46450698%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63d3729b0e365baafd3dc90d2116047a6dfa030e' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/SPPDFTemplates/ListPDFTemplates.tpl',
      1 => 1468060779,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1494629845782f2a76a1a46-46450698',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'MODEL' => 0,
    'template' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5782f2a7780ca',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5782f2a7780ca')) {function content_5782f2a7780ca($_smarty_tpl) {?>

<!-- If you want, you can place it in JS file -->
<script>
function massDelete()
{
	if(typeof(document.massdelete.selected_id) == 'undefined')
		return false;
        x = document.massdelete.selected_id.length;
        idstring = "";

        if ( x == undefined)
        {

                if (document.massdelete.selected_id.checked)
               {
                        document.massdelete.idlist.value=document.massdelete.selected_id.value+';';
			xx=1;
                }
                else
                {
                        alert("<?php echo vtranslate('SELECT_ATLEAST_ONE');?>
");
                        return false;
                }
        }
        else
        {
                xx = 0;
                for(i = 0; i < x ; i++)
                {
                        if(document.massdelete.selected_id[i].checked)
                        {
                                idstring = document.massdelete.selected_id[i].value +";"+idstring
                        xx++
                        }
                }
                if (xx != 0)
                {
                        document.massdelete.idlist.value=idstring;
                }
               else
                {
                        alert("<?php echo vtranslate('SELECT_ATLEAST_ONE');?>
");
                        return false;
                }
       }
		if(confirm("<?php echo vtranslate('DELETE_CONFIRMATION');?>
 "+xx+" <?php echo vtranslate('RECORDS');?>
?"))
		{
	        	document.massdelete.action.value= "DeletePDFTemplate";
		}
		else
		{
			return false;
		}

}
</script>

<div class="container-fluid"><div class="widget_header"><h3><?php echo vtranslate('LBL_TEMPLATE_GENERATOR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3><?php echo vtranslate('LBL_TEMPLATE_GENERATOR_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><hr><form  name="massdelete" action="index.php?module=SPPDFTemplates&action=DeletePDFTemplate" method="post"><input name="idlist" type="hidden"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getName();?>
"><input type="submit" class="btn btn-danger" onclick="return massDelete();"  value="<?php echo vtranslate('LBL_DELETE');?>
"><input type="button" class="btn addButton pull-right" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getCreateRecordUrl();?>
'" value="<?php echo vtranslate('LBL_ADD_TEMPLATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><br><br><table class="table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><th width=2% class="listViewHeaderValues">#</th><th width=3% class="listViewHeaderValues"><?php echo vtranslate('LBL_LIST_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th width=20% class="listViewHeaderValues"><?php echo vtranslate('LBL_TEMPLATE_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th width=20% class="listViewHeaderValues"><?php echo vtranslate('LBL_MODULENAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th width=20% class="listViewHeaderValues"><?php echo vtranslate('LBL_COMPANY','Settings:Vtiger');?>
</th><th width=10% class="listViewHeaderValues"><?php echo vtranslate('LBL_ACTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><?php  $_smarty_tpl->tpl_vars['template'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['template']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODEL']->value->getListTemplates(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['mailmerge']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['template']->key => $_smarty_tpl->tpl_vars['template']->value){
$_smarty_tpl->tpl_vars['template']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['mailmerge']['iteration']++;
?><tr><td class="listViewEntryValue" valign=top><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['mailmerge']['iteration'];?>
</td><td class="listViewEntryValue" valign=top><input type="checkbox" class=small name="selected_id" value="<?php echo $_smarty_tpl->tpl_vars['template']->value->getId();?>
"></td><td class="listViewEntryValue" valign=top>  <b><a href="<?php echo $_smarty_tpl->tpl_vars['template']->value->getDetailViewUrl();?>
"> <?php echo $_smarty_tpl->tpl_vars['template']->value->get('name');?>
 </a></b></td><td class="listViewEntryValue" valign=top><?php echo vtranslate($_smarty_tpl->tpl_vars['template']->value->get('module'));?>
</td><td class="listViewEntryValue" valign=top><b><?php echo vtranslate($_smarty_tpl->tpl_vars['template']->value->get('spcompany'),'Settings:Vtiger');?>
</b></a></td><td class="listViewEntryValue" valign=top nowrap><a href="<?php echo $_smarty_tpl->tpl_vars['template']->value->getEditViewUrl();?>
"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['template']->value->getDuplicateRecordUrl();?>
"><?php echo vtranslate('LBL_DUPLICATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></td></tr><?php } ?></table></form></div><?php }} ?>