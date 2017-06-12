{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ('License'); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{strip}

    {if !isset($EDITPLAN) && !isset($PLAN) && !isset($WORKING) && !isset($SALARY)}
        {assign var='dateFormat' value=$USER_MODEL->get('date_format')}
        <div class='row-fluid'>

            <input type='text' name="filtre[period]" class='span12 listSearchContributor dateField'
                   data-date-format='{$dateFormat}' data-calendar-type='range' value='{$item['data']}'/>
        </div>
    {else}

        <div class='row-fluid' style="position: relative">
            <input type='text' id="monthPeriod" name="filtre[period]" value="{$MONTHPERIOD}" class='span12 listSearchContributor' style="text-align: right; cursor:pointer; background: white" onclick="setTimeout(function(){
            $('#myPicker').css('display', 'block');
            }, 0);" readonly />
            <div id="myPicker" class="datepicker rangeCalendar" style="top: 31px">
                <div class="datepickerBorderT"></div>
                <div class="datepickerBorderB"></div>
                <div class="datepickerBorderL"></div>
                <div class="datepickerBorderR"></div>
                <div class="datepickerBorderTL"></div>
                <div class="datepickerBorderTR"></div>
                <div class="datepickerBorderBL"></div>
                <div class="datepickerBorderBR"></div>
                <div class="datepickerContainer">
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" class="datepickerViewMonths">
                                    <thead>
                                    <tr>
                                        <th class="datepickerGoPrev" onclick="changeYear(-1)"><a href="#"><span>◀</span></a></th>
                                        <th colspan="6" class="datepickerMonth"><a style="color: #eee"><span id="yearDatePicker">2017</span></a></th>
                                        <th class="datepickerGoNext" onclick="changeYear(1)"><a href="#"><span>▶</span></a></th>
                                    </tr>
                                    </thead>
                                    <tbody class="datepickerMonths">
                                    <tr>
                                        <td colspan="2" onclick="setDate('01')"><a href="#"><span>Янв</span></a></td>
                                        <td colspan="2" onclick="setDate('02')"><a href="#"><span>Фев</span></a></td>
                                        <td colspan="2" onclick="setDate('03')"><a href="#"><span>Мар</span></a></td>
                                        <td colspan="2" onclick="setDate('04')"><a href="#"><span>Апр</span></a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" onclick="setDate('05')"><a href="#"><span>Май</span></a></td>
                                        <td colspan="2" onclick="setDate('06')"><a href="#"><span>Июн</span></a></td>
                                        <td colspan="2" onclick="setDate('07')"><a href="#"><span>Июл</span></a></td>
                                        <td colspan="2" onclick="setDate('08')"><a href="#"><span>Авг</span></a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" onclick="setDate('09')"><a href="#"><span>Сен</span></a></td>
                                        <td colspan="2" onclick="setDate('10')"><a href="#"><span>Окт</span></a></td>
                                        <td colspan="2" onclick="setDate('11')"><a href="#"><span>Ноя</span></a></td>
                                        <td colspan="2" onclick="setDate('12')"><a href="#"><span>Дек</span></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function checkDataLength(data){
                var str = data.toString();
                if (str.length <2){
                    return "0" + str;
                } else {
                    return str;
                }
            }

            if (!$("#monthPeriod").val()){
                var nowDate = new Date();
                $("#monthPeriod").val("" + checkDataLength(nowDate.getMonth() + 1) + "." + nowDate.getFullYear());
            }

            function setDate(month){
                $("#monthPeriod").val("" + month + "." + $('#yearDatePicker').html());
                $("#myPicker").fadeOut("slow");
            }
            function changeYear(num){
                $('#yearDatePicker').html(parseInt($('#yearDatePicker').html()) + num);
            }

            $(document).click( function(event){
                if( $(event.target).closest("#myPicker").length )return;
                $("#myPicker").fadeOut("slow");
                event.stopPropagation();
            });


    </script>
    {/if}
{/strip}