<?php /* Smarty version Smarty-3.1.7, created on 2017-04-28 20:43:56
         compiled from "C:\os\OpenServer\domains\crmturizm\includes\runtime/../../layouts/vlayout\modules\VDCustomReports\uitypes\DateFieldSearchView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2333559037f5c99a842-86736912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '220b40773d25254ffa925962ada948267e3a4268' => 
    array (
      0 => 'C:\\os\\OpenServer\\domains\\crmturizm\\includes\\runtime/../../layouts/vlayout\\modules\\VDCustomReports\\uitypes\\DateFieldSearchView.tpl',
      1 => 1493241762,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2333559037f5c99a842-86736912',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'EDITPLAN' => 0,
    'PLAN' => 0,
    'USER_MODEL' => 0,
    'dateFormat' => 0,
    'item' => 0,
    'MONTHPERIOD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_59037f5c9b9e2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59037f5c9b9e2')) {function content_59037f5c9b9e2($_smarty_tpl) {?>
<?php if (!isset($_smarty_tpl->tpl_vars['EDITPLAN']->value)&&!isset($_smarty_tpl->tpl_vars['PLAN']->value)){?><?php $_smarty_tpl->tpl_vars['dateFormat'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('date_format'), null, 0);?><div class='row-fluid'><input type='text' name="filtre[period]" class='span12 listSearchContributor dateField'data-date-format='<?php echo $_smarty_tpl->tpl_vars['dateFormat']->value;?>
' data-calendar-type='range' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['data'];?>
'/></div><?php }else{ ?><div class='row-fluid' style="position: relative"><input type='text' id="monthPeriod" name="filtre[period]" value="<?php echo $_smarty_tpl->tpl_vars['MONTHPERIOD']->value;?>
" class='span12 listSearchContributor' style="text-align: right; cursor:pointer; background: white" onclick="setTimeout(function(){$('#myPicker').css('display', 'block');}, 0);" readonly /><div id="myPicker" class="datepicker rangeCalendar" style="top: 31px"><div class="datepickerBorderT"></div><div class="datepickerBorderB"></div><div class="datepickerBorderL"></div><div class="datepickerBorderR"></div><div class="datepickerBorderTL"></div><div class="datepickerBorderTR"></div><div class="datepickerBorderBL"></div><div class="datepickerBorderBR"></div><div class="datepickerContainer"><table cellspacing="0" cellpadding="0"><tbody><tr><td><table cellspacing="0" cellpadding="0" class="datepickerViewMonths"><thead><tr><th class="datepickerGoPrev" onclick="changeYear(-1)"><a href="#"><span>◀</span></a></th><th colspan="6" class="datepickerMonth"><a style="color: #eee"><span id="yearDatePicker">2017</span></a></th><th class="datepickerGoNext" onclick="changeYear(1)"><a href="#"><span>▶</span></a></th></tr></thead><tbody class="datepickerMonths"><tr><td colspan="2" onclick="setDate('01')"><a href="#"><span>Янв</span></a></td><td colspan="2" onclick="setDate('02')"><a href="#"><span>Фев</span></a></td><td colspan="2" onclick="setDate('03')"><a href="#"><span>Мар</span></a></td><td colspan="2" onclick="setDate('04')"><a href="#"><span>Апр</span></a></td></tr><tr><td colspan="2" onclick="setDate('05')"><a href="#"><span>Май</span></a></td><td colspan="2" onclick="setDate('06')"><a href="#"><span>Июн</span></a></td><td colspan="2" onclick="setDate('07')"><a href="#"><span>Июл</span></a></td><td colspan="2" onclick="setDate('08')"><a href="#"><span>Авг</span></a></td></tr><tr><td colspan="2" onclick="setDate('09')"><a href="#"><span>Сен</span></a></td><td colspan="2" onclick="setDate('10')"><a href="#"><span>Окт</span></a></td><td colspan="2" onclick="setDate('11')"><a href="#"><span>Ноя</span></a></td><td colspan="2" onclick="setDate('12')"><a href="#"><span>Дек</span></a></td></tr></tbody></table></td></tr></tbody></table></div></div></div><script>function checkDataLength(data){var str = data.toString();if (str.length <2){return "0" + str;} else {return str;}}if (!$("#monthPeriod").val()){var nowDate = new Date();$("#monthPeriod").val("" + checkDataLength(nowDate.getMonth() + 1) + "." + nowDate.getFullYear());}function setDate(month){$("#monthPeriod").val("" + month + "." + $('#yearDatePicker').html());$("#myPicker").fadeOut("slow");}function changeYear(num){$('#yearDatePicker').html(parseInt($('#yearDatePicker').html()) + num);}$(document).click( function(event){if( $(event.target).closest("#myPicker").length )return;$("#myPicker").fadeOut("slow");event.stopPropagation();});</script><?php }?><?php }} ?>