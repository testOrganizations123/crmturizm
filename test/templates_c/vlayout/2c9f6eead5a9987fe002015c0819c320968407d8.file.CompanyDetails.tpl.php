<?php /* Smarty version Smarty-3.1.7, created on 2016-07-09 15:19:21
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/Vtiger/CompanyDetails.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9702305915780ebc9d5d327-18464651%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c9f6eead5a9987fe002015c0819c320968407d8' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Settings/Vtiger/CompanyDetails.tpl',
      1 => 1450875195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9702305915780ebc9d5d327-18464651',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'DESCRIPTION' => 0,
    'CURRENT_USER_MODEL' => 0,
    'ERROR_MESSAGE' => 0,
    'WIDTHTYPE' => 0,
    'MODULE_MODEL' => 0,
    'COMPANY' => 0,
    'SELECTED_COMPANY' => 0,
    'FIELD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5780ebc9e80e8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5780ebc9e80e8')) {function content_5780ebc9e80e8($_smarty_tpl) {?>
<input type="hidden" id="supportedImageFormats" value='<?php echo ZEND_JSON::encode(Settings_Vtiger_CompanyDetails_Model::$logoSupportedFormats);?>
' /><div class="padding-left1per"><div class="row-fluid widget_header"><div class="span8"><h3><?php echo vtranslate('LBL_COMPANY_DETAILS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3><?php if ($_smarty_tpl->tpl_vars['DESCRIPTION']->value){?><span style="font-size:12px;color: black;"> - &nbsp;<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_tmp1,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php }?></div><div class="span4"><button id="updateCompanyDetails" class="btn pull-right"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div><hr><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><form id="companyControlForm" method="post" action="index.php"><div id="company" class="<?php if (!empty($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)){?>hide<?php }?> row-fluid"><table class="table table-bordered"><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="width:50%"><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('company')!='Default'){?><button id="deleteCompany" class="input btn btn-danger pull-left"><?php echo vtranslate('LBL_DELETE');?>
</button><span>&nbsp&nbsp&nbsp&nbsp</span><?php }?><span><strong><?php echo vtranslate('LBL_COMPANY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></span><span>&nbsp&nbsp&nbsp&nbsp</span><select id="currentCompany" name="currentCompany"><?php  $_smarty_tpl->tpl_vars['COMPANY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['COMPANY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCompanies(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['COMPANY']->key => $_smarty_tpl->tpl_vars['COMPANY']->value){
$_smarty_tpl->tpl_vars['COMPANY']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['COMPANY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['COMPANY']->value==$_smarty_tpl->tpl_vars['SELECTED_COMPANY']->value){?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['COMPANY']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php } ?></select></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="text-align: right; width:50%"><input type="hidden" name="module" value="Vtiger" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value=""/><span><strong><?php echo vtranslate('LBL_NEW_COMPANY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></span><span>&nbsp&nbsp&nbsp&nbsp</span><input type="text" name="newCompany" id="newCompany" class="input-large"/><span>&nbsp&nbsp</span><button id="createCompany" class="btn btn-success pull-right"><?php echo vtranslate('LBL_CREATE');?>
</button></td></table></div></form><br><div  id="CompanyDetailsContainer" class="<?php if (!empty($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)){?>hide<?php }?>"><div class="row-fluid"><table class="table table-bordered"><thead><tr class="blockHeader"><th colspan="2" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><strong><?php echo vtranslate('LBL_COMPANY_LOGO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th></tr></thead><tbody><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class="companyLogo"><img src="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getLogoPath();?>
" class="alignMiddle" /></div></td></tr></tbody></table><br><table class="table table-bordered"><thead><tr class="blockHeader"><th colspan="2" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><strong><?php echo vtranslate('LBL_COMPANY_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->key => $_smarty_tpl->tpl_vars['FIELD_TYPE']->value){
$_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD']->value = $_smarty_tpl->tpl_vars['FIELD_TYPE']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD']->value!='logoname'&&$_smarty_tpl->tpl_vars['FIELD']->value!='logo'&&$_smarty_tpl->tpl_vars['FIELD']->value!='company'){?><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="width:25%"><label class="pull-right"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['FIELD']->value=='address'){?> <?php echo nl2br($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value));?>
 <?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value);?>
 <?php }?></td></tr><?php }?><?php } ?></tbody></table></div></div><form class="form-horizontal <?php if (empty($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)){?>hide<?php }?>"  id="updateCompanyDetailsForm" method="post" action="index.php" enctype="multipart/form-data"><input type="hidden" name="module" value="Vtiger" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="CompanyDetailsSave" /><input type="hidden" name="company" value="<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['SELECTED_COMPANY']->value);?>
" /><div class="control-group"><div class="control-label"><?php echo vtranslate('LBL_COMPANY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls"> <input type="text" value="<?php echo vtranslate(htmlspecialchars($_smarty_tpl->tpl_vars['SELECTED_COMPANY']->value, ENT_QUOTES, 'UTF-8', true),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" readonly /> </div></div><div class="control-group"><div class="control-label"><?php echo vtranslate('LBL_COMPANY_LOGO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls"><div class="companyLogo"><img src="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getLogoPath();?>
" class="alignMiddle" /></div><input type="file" name="logo" id="logoFile" />&nbsp;&nbsp;<span class="alert alert-info"><?php echo vtranslate('LBL_LOGO_RECOMMENDED_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php if (!empty($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)){?><br><br><div class="marginLeftZero span9 alert alert-error"><?php echo vtranslate($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php }?></div></div><?php  $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->key => $_smarty_tpl->tpl_vars['FIELD_TYPE']->value){
$_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD']->value = $_smarty_tpl->tpl_vars['FIELD_TYPE']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD']->value!='logoname'&&$_smarty_tpl->tpl_vars['FIELD']->value!='logo'&&$_smarty_tpl->tpl_vars['FIELD']->value!='company'){?><div class="control-group"><div class="control-label"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD']->value=='organizationname'){?><span class="redColor">*</span><?php }?></div><div class="controls"><?php if ($_smarty_tpl->tpl_vars['FIELD']->value=='address'){?><textarea name="<?php echo $_smarty_tpl->tpl_vars['FIELD']->value;?>
" style="width: 40%"><?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value);?>
</textarea><?php }else{ ?><input type="text" <?php if ($_smarty_tpl->tpl_vars['FIELD']->value=='organizationname'){?> data-validation-engine="validate[required]" <?php }?> class="input-xlarge" name="<?php echo $_smarty_tpl->tpl_vars['FIELD']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value);?>
"/><?php }?></div></div><?php }?><?php } ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalFooter.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>