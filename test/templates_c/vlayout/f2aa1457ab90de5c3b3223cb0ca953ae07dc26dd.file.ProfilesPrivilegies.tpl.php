<?php /* Smarty version Smarty-3.1.7, created on 2017-03-01 01:16:09
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ProfilesPrivilegies.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189095852658b5f6a911fc84-87003483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2aa1457ab90de5c3b3223cb0ca953ae07dc26dd' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ProfilesPrivilegies.tpl',
      1 => 1471260282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189095852658b5f6a911fc84-87003483',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODE' => 0,
    'IS_RTF_ACTIVATED' => 0,
    'PERMISSIONS' => 0,
    'arr' => 0,
    'profile_name' => 0,
    'profile_arr' => 0,
    'ENABLE_IMAGE_PATH' => 0,
    'DISABLE_IMAGE_PATH' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58b5f6a91bede',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5f6a91bede')) {function content_58b5f6a91bede($_smarty_tpl) {?>
<?php ob_start();?><?php echo vimage_path('Enable.png');?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["ENABLE_IMAGE_PATH"] = new Smarty_variable($_tmp1, null, 0);?>
<?php ob_start();?><?php echo vimage_path('Disable.png');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["DISABLE_IMAGE_PATH"] = new Smarty_variable($_tmp2, null, 0);?>
<div class="container-fluid">
    
    <form name="profiles_privilegies" action="index.php" method="post" class="form-horizontal">
    <br>
    <label class="pull-left themeTextColor font-x-x-large"><?php echo vtranslate('LBL_PROFILES','PDFMaker');?>
</label>
    <?php if ($_smarty_tpl->tpl_vars['MODE']->value!="edit"){?><button class="btn pull-right" type="submit"><?php echo vtranslate('LBL_EDIT','PDFMaker');?>
</button><?php }?>
    <br clear="all"><?php echo vtranslate('LBL_PROFILES_DESC','PDFMaker');?>

    <hr>

    <input type="hidden" name="module" value="PDFMaker" />
    <?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?>
        <input type="hidden" name="action" value="SaveProfilesPrivilegies" />
    <?php }else{ ?>
        <input type="hidden" name="view" value="ProfilesPrivilegies" />
        <input type="hidden" name="mode" value="edit" />
    <?php }?>
    <br />
    <div class="row-fluid">
        <label class="fieldLabel"><strong><?php echo vtranslate('LBL_SETPRIVILEGIES','PDFMaker');?>
:</strong></label><br>

        <table class="table table-striped table-bordered profilesEditView">
            <thead>
                <tr class="blockHeader">
                    <th style="border-left: 1px solid #DDD !important;" width="40%"><?php echo vtranslate('LBL_PROFILES','PDFMaker');?>
</th>
                    <th style="border-left: 1px solid #DDD !important;" width="15%" align="center"><?php echo vtranslate('LBL_CREATE_EDIT','PDFMaker');?>
</th>
                    <th style="border-left: 1px solid #DDD !important;" width="15%" align="center"><?php echo vtranslate('LBL_VIEW','PDFMaker');?>
</th>
                    <th style="border-left: 1px solid #DDD !important;" width="15%" align="center"><?php echo vtranslate('LBL_DELETE','PDFMaker');?>
</th>
                    <th style="border-left: 1px solid #DDD !important;" width="15%" align="center" class="<?php if ($_smarty_tpl->tpl_vars['IS_RTF_ACTIVATED']->value=="no"){?>hide<?php }?>"><?php echo vtranslate('LBL_EXPORT_TO_RTF','PDFMaker');?>
</th>
                </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['arr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['arr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PERMISSIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arr']->key => $_smarty_tpl->tpl_vars['arr']->value){
$_smarty_tpl->tpl_vars['arr']->_loop = true;
?>
                <?php  $_smarty_tpl->tpl_vars['profile_arr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['profile_arr']->_loop = false;
 $_smarty_tpl->tpl_vars['profile_name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['profile_arr']->key => $_smarty_tpl->tpl_vars['profile_arr']->value){
$_smarty_tpl->tpl_vars['profile_arr']->_loop = true;
 $_smarty_tpl->tpl_vars['profile_name']->value = $_smarty_tpl->tpl_vars['profile_arr']->key;
?>
                    <tr>
                        <td class="cellLabel">
                            <?php echo $_smarty_tpl->tpl_vars['profile_name']->value;?>
                                    
                        </td>
                        <td class="cellText" align="center">
                            <?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?>
                                <input type="checkbox" <?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['EDIT']['checked'];?>
 id="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['EDIT']['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['EDIT']['name'];?>
" onclick="other_chk_clicked(this, '<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DETAIL']['name'];?>
');"/> 
                            <?php }else{ ?>    
                                <img style="margin-left: 40%" class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['profile_arr']->value['EDIT']['checked']!=''){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" />
                            <?php }?>
                        </td>
                        <td class="cellText" align="center">
                            <?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?>
                                <input type="checkbox" <?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DETAIL']['checked'];?>
 id="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DETAIL']['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DETAIL']['name'];?>
" onclick="view_chk_clicked(this, '<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['EDIT']['name'];?>
', '<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DELETE']['name'];?>
');"/>                                    
                            <?php }else{ ?>    
                                <img style="margin-left: 40%" class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['profile_arr']->value['DETAIL']['checked']!=''){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" />
                            <?php }?>
                        </td>
                        <td class="cellText" align="center">
                            <?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?>
                                <input type="checkbox" <?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DELETE']['checked'];?>
 id="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DELETE']['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DELETE']['name'];?>
" onclick="other_chk_clicked(this, '<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DETAIL']['name'];?>
');"/>
                            <?php }else{ ?>    
                                <img style="margin-left: 40%" class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['profile_arr']->value['DELETE']['checked']!=''){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" />
                            <?php }?>
                        </td>
                        <td class="cellText <?php if ($_smarty_tpl->tpl_vars['IS_RTF_ACTIVATED']->value=="no"){?>hide<?php }?>" align="center">
                            <?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?>
                                <input type="checkbox" <?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['EXPORT_RTF']['checked'];?>
 id="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['EXPORT_RTF']['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['EXPORT_RTF']['name'];?>
" onclick="other_chk_clicked(this, '<?php echo $_smarty_tpl->tpl_vars['profile_arr']->value['DETAIL']['name'];?>
');"/>
                            <?php }else{ ?>    
                                <img style="margin-left: 40%" class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['profile_arr']->value['EXPORT_RTF']['checked']!=''){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" />
                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>    
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?>        
        <div class="pull-right">
            <button class="btn btn-success" type="submit"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>
            <a class="cancelLink" onclick="javascript:window.history.back();" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
        </div> 
    <?php }?>
    </form>        

</div>
      

<script language="javascript" type="text/javascript">
function view_chk_clicked(source_chk, edit_chk_id, delete_chk_id, export_rtf_chk_id)
{
    if(source_chk.checked == false)
    {
        document.getElementById(edit_chk_id).checked = false;
        document.getElementById(delete_chk_id).checked = false;
        document.getElementById(export_rtf_chk_id).checked = false;
    }
}

function other_chk_clicked(source_chk, detail_chk)
{   
    if(source_chk.checked == true)
    {
        document.getElementById(detail_chk).checked = true;
    }
}
</script>
    <?php }} ?>