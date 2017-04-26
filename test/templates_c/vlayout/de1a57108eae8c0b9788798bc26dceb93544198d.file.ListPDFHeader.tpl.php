<?php /* Smarty version Smarty-3.1.7, created on 2016-08-15 14:25:37
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ListPDFHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205530951757b0d896e2cff7-84083785%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de1a57108eae8c0b9788798bc26dceb93544198d' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ListPDFHeader.tpl',
      1 => 1471260282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205530951757b0d896e2cff7-84083785',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57b0d896e581f',
  'variables' => 
  array (
    'LISTVIEW_MASSACTIONS' => 0,
    'LISTVIEW_LINKS' => 0,
    'MODULE' => 0,
    'LISTVIEW_MASSACTION' => 0,
    'LISTVIEW_ADVANCEDACTIONS' => 0,
    'EDIT' => 0,
    'VERSION_TYPE' => 0,
    'IS_ADMIN' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b0d896e581f')) {function content_57b0d896e581f($_smarty_tpl) {?>
<div class="listViewTopMenuDiv">
    <div class="listViewActionsDiv row-fluid">
        <span class="btn-toolbar span4">
            <span class="btn-group listViewMassActions">
                    <?php if (count($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS']->value)>0||count($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEW'])>0){?>
                            <button class="btn dropdown-toggle" data-toggle="dropdown"><strong><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>&nbsp;&nbsp;<i class="caret"></i></button>
                            <ul class="dropdown-menu">
                                    <?php if (count($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS']->value)>0){?>
                                        <?php  $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->key => $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->value){
$_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->_loop = true;
?>
                                                <li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getLabel());?>
"><a href="javascript:void(0);" <?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl(),'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?> onclick="Vtiger_List_Js.triggerMassAction('<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl();?>
')"<?php }?> ><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li>
                                        <?php } ?>
                                        
                                        <?php if (count($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEW'])>0){?><li class="divider"></li> <?php }?>
                                    <?php }?>
                                    
                                    <?php if (count($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEW'])>0){?>
                                            <?php  $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEW']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->_loop = true;
?>
                                                    <li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_advancedAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getLabel());?>
"><a <?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getUrl(),'javascript:')===0){?> href="javascript:void(0);" onclick='<?php echo substr($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?> href='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getUrl();?>
' <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li>
                                            <?php } ?>
                                    <?php }?>
                            </ul>
                    <?php }?>
            </span>
            <?php if ($_smarty_tpl->tpl_vars['EDIT']->value=='permitted'){?>
                <span class="btn-group"><button class="btn addButton" type="submit" onclick="this.form.view.value = 'Edit';"><i class="icon-plus icon-white"></i>&nbsp;<strong><?php echo vtranslate("LBL_ADD_TEMPLATE","PDFMaker");?>
</strong></button></span>
            <?php }?>
            
            <span class="btn-group"><button class="btn saveButton" onclick="window.location.href = 'http://www.its4you.sk/images/pdf_maker/pdf_maker_for_vtiger6_crm.pdf'; return false;"><?php echo vtranslate("PDFMakerManual","PDFMaker");?>
</button></span>
            
            
        </span>
        <span class="btn-toolbar span4">
            <span class="customFilterMainSpan btn-group">                
                <?php if ($_smarty_tpl->tpl_vars['VERSION_TYPE']->value=="deactivate"||$_smarty_tpl->tpl_vars['VERSION_TYPE']->value==''){?> 
                    <span class="btn-group">
                    <?php if ($_smarty_tpl->tpl_vars['IS_ADMIN']->value=="1"){?>
                        <a href='index.php?module=PDFMaker&view=License'>
                            <span class="btn btn-danger">
                                <?php echo vtranslate("LBL_ACTIVATE_BTN",$_smarty_tpl->tpl_vars['MODULE']->value);?>

                            </span>
                        </a>
                    <?php }else{ ?>
                        <div class='alert alert-danger margin0px'>
                            <?php echo vtranslate("LBL_ACTIVATE_BTN",$_smarty_tpl->tpl_vars['MODULE']->value);?>

                        </div>
                    <?php }?> 
                    </span>
                <?php }?>                
                
                
            </span>
        </span>
        <span class="hide filterActionImages pull-right">
                <i title="<?php echo vtranslate('LBL_DENY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="deny" class="icon-ban-circle alignMiddle denyFilter filterActionImage pull-right"></i>
                <i title="<?php echo vtranslate('LBL_APPROVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="approve" class="icon-ok alignMiddle approveFilter filterActionImage pull-right"></i>
                <i title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="delete" class="icon-trash alignMiddle deleteFilter filterActionImage pull-right"></i>
                <i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-value="edit" class="icon-pencil alignMiddle editFilter filterActionImage pull-right"></i>
        </span>
        <span class="span4 btn-toolbar">
                <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ListPDFActions.tpl','PDFMaker'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </span>
    </div>
</div><?php }} ?>