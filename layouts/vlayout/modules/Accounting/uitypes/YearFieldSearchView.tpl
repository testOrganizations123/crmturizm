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

    <div class='row-fluid' style="position: relative">
        <input type='text' id="yearPeriod" name="filtre[period]"
               class='span12 listSearchContributor dateField' style="text-align: right; cursor:pointer; background: white"
                readonly/>

    </div>
    <script>
        $(document).ready(function () {


            $('#yearPeriod').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'MM yy',
                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });
        })
    </script>




