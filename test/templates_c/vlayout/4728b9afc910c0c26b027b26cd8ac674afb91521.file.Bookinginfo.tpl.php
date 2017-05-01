<?php /* Smarty version Smarty-3.1.7, created on 2017-05-01 10:54:21
         compiled from "C:\OpenServer\domains\crmturizm.test\includes\runtime/../../layouts/vlayout\modules\Potentials\part\Bookinginfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:42055906e9ad563261-45636415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4728b9afc910c0c26b027b26cd8ac674afb91521' => 
    array (
      0 => 'C:\\OpenServer\\domains\\crmturizm.test\\includes\\runtime/../../layouts/vlayout\\modules\\Potentials\\part\\Bookinginfo.tpl',
      1 => 1493241804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42055906e9ad563261-45636415',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'dogovor' => 0,
    'MODULE' => 0,
    'RECORD_ID' => 0,
    'RECORD_MODEL' => 0,
    'LINK_DOCUMENTS' => 0,
    'printdogovor' => 0,
    'changeField' => 0,
    'AddText' => 0,
    'printdop' => 0,
    'opportunity_type' => 0,
    'MATERIAL' => 0,
    'DOCUMENT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5906e9ad8c0ed',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906e9ad8c0ed')) {function content_5906e9ad8c0ed($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['dogovor'], null, 0);?><?php $_smarty_tpl->tpl_vars['dogovor'] = new Smarty_variable(($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><?php if ($_smarty_tpl->tpl_vars['dogovor']->value!=''){?><div class=""><div class="cms-group cms-group-expanded addPayContainer"><div class="cms-group-label">Договор №<?php echo $_smarty_tpl->tpl_vars['dogovor']->value;?>
<?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['datedogovor'], null, 0);?>&nbsp;от&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?><?php echo date('d.m.Y',strtotime($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?><input id="dataDogovora" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" type="hidden" /><?php }else{ ?><input id="dataDogovora" value="<?php echo date('Y-m-d H:i:s');?>
" type="hidden" /><?php }?></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/bookDogovor.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php $_smarty_tpl->tpl_vars['LINK_DOCUMENTS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getDocumentLinks($_smarty_tpl->tpl_vars['RECORD_ID']->value), null, 0);?><blockquote><p>Печать документов</p><table><?php if (isset($_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value['dogovor']['href'])){?><tr><td width="10%"><?php echo $_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value['dogovor']['name'];?>
:</td><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['change_field'], null, 0);?><?php $_smarty_tpl->tpl_vars['changeField'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['printdogovor'], null, 0);?><?php $_smarty_tpl->tpl_vars['printdogovor'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['print_dop_count'], null, 0);?><?php $_smarty_tpl->tpl_vars['printdop'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars['AddText'] = new Smarty_variable('', null, 0);?><?php if ($_smarty_tpl->tpl_vars['printdogovor']->value==1){?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value['print_dog_count'], null, 0);?><?php if ($_smarty_tpl->tpl_vars['changeField']->value==1){?><?php $_smarty_tpl->tpl_vars['AddText'] = new Smarty_variable(sprintf('- Договор распечатан (%s). <span class="redColor">В броне имеются изменения, распечатайте доп.соглашение или если договор еще не подписан то основной договор</span>',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['AddText'] = new Smarty_variable(sprintf('- Договор распечатан (%s)',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><?php }?><?php }?><td width="90%"><a style="margin-top: 5px;" class="btn btn-success btn-ref" href="<?php echo $_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value['dogovor']['href'];?>
" onclick="<?php if ($_smarty_tpl->tpl_vars['printdogovor']->value==0){?>chekMailSend();<?php }?><?php if ($_smarty_tpl->tpl_vars['changeField']->value==1||$_smarty_tpl->tpl_vars['printdogovor']->value==0){?>printDogovor()<?php }?>" target="_blank"><i class="fa fa-file-o"></i> <?php echo $_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value['dogovor']['description'];?>
<?php if ($_smarty_tpl->tpl_vars['changeField']->value==1){?>(с изменениями)<?php }?></a> <?php echo $_smarty_tpl->tpl_vars['AddText']->value;?>
</td></tr><?php if ($_smarty_tpl->tpl_vars['changeField']->value==1||$_smarty_tpl->tpl_vars['printdop']->value>0){?><?php if ($_smarty_tpl->tpl_vars['printdop']->value>0&&$_smarty_tpl->tpl_vars['changeField']->value==1){?><?php $_smarty_tpl->tpl_vars['AddText'] = new Smarty_variable(sprintf('- Дополнительное соглашение распечатано (%s). <span class="redColor">В броне имеются новые изменения, распечатайте доп.соглашение</span>',$_smarty_tpl->tpl_vars['printdop']->value), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['printdop']->value>0){?><?php $_smarty_tpl->tpl_vars['AddText'] = new Smarty_variable(sprintf('- Дополнительное соглашение распечатано (%s)',$_smarty_tpl->tpl_vars['printdop']->value), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['AddText'] = new Smarty_variable(sprintf('<span class="redColor"> - В броне имеются новые изменения, распечатайте доп.соглашение</span>',$_smarty_tpl->tpl_vars['printdop']->value), null, 0);?><?php }?><tr>  <td> Доп. соглашение</td><td> <a style="margin-top: 5px;" class="btn btn-success btn-ref" href="<?php echo $_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value['dopnik']['href'];?>
" onclick="<?php if ($_smarty_tpl->tpl_vars['changeField']->value==1){?>printDopDogovor()<?php }?>" target="_blank"><i class="fa fa-file-o"></i> <?php echo $_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value['dopnik']['description'];?>
<?php if ($_smarty_tpl->tpl_vars['printdop']->value>0&&$_smarty_tpl->tpl_vars['changeField']->value==1){?>(новое с изменениями)<?php }?></a> <?php echo $_smarty_tpl->tpl_vars['AddText']->value;?>
</td></tr><?php }?><?php $_smarty_tpl->tpl_vars['LINK_DOCUMENTS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->unsetArray($_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value,'dogovor'), null, 0);?><?php $_smarty_tpl->tpl_vars['LINK_DOCUMENTS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->unsetArray($_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value,'dopnik'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['opportunity_type']->value=="Пакетный Тур"){?><?php $_smarty_tpl->tpl_vars['MATERIAL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getContactEmail($_smarty_tpl->tpl_vars['RECORD_ID']->value), null, 0);?><tr>  <td>Дополнительные материалы для тура </td><td><?php if ($_smarty_tpl->tpl_vars['MATERIAL']->value==true&&$_smarty_tpl->tpl_vars['printdogovor']->value!=0){?><i><b>Отправлены на e-mail: <?php echo $_smarty_tpl->tpl_vars['MATERIAL']->value;?>
</b></i><?php }elseif($_smarty_tpl->tpl_vars['MATERIAL']->value==true){?><i><b>Будут отправлены на e-mail: <?php echo $_smarty_tpl->tpl_vars['MATERIAL']->value;?>
 после печати договора</b></i> <?php }else{ ?><a style="margin-top: 5px;" class="btn btn-warning btn-ref" href="print_pdf.php?record=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" target="_blank"><i class="fa fa-file-o"></i> Печатать</a><?php }?></small></td></tr><?php }?><?php }else{ ?><tr>  <td colspan="2">(для печати договора должен быть выбран турист на кого оформляется договор)</small> </td></tr><?php }?><?php if (count($_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value)>0){?><?php  $_smarty_tpl->tpl_vars['DOCUMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DOCUMENT']->_loop = false;
 $_smarty_tpl->tpl_vars['name_document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LINK_DOCUMENTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DOCUMENT']->key => $_smarty_tpl->tpl_vars['DOCUMENT']->value){
$_smarty_tpl->tpl_vars['DOCUMENT']->_loop = true;
 $_smarty_tpl->tpl_vars['name_document']->value = $_smarty_tpl->tpl_vars['DOCUMENT']->key;
?><tr>  <td><?php echo $_smarty_tpl->tpl_vars['DOCUMENT']->value['name'];?>
</td><td><a style="margin-top: 5px;" class="btn btn-warning btn-ref" href="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT']->value['href'];?>
" target="_blank"><i class="fa fa-file-o"></i> <?php echo $_smarty_tpl->tpl_vars['DOCUMENT']->value['description'];?>
</a></td></tr><?php } ?><?php }?></table></blockquote><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('part/bookto.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><?php }else{ ?><div class="alert alert-error"><i class="fa fa-exclamation fa-4x" style="float: left;padding-top: 13px;margin-left: 20px;"></i> <h4 style="padding: 30px 50px 20px;">Для получения номера и даты договора необходимо выбрать Туроператора и Клиента на кого будет оформляться договор.</h4></div><?php }?><?php }} ?>