<script>
    window.offices = {$SALARY};
    window.date = '{$MONTHPERIOD}';
    window.dateObject = JSON.parse('{$DATE}');
    window.amountHoliday = '{$AMOUNTHOLIDAY}';
    window.writingAccess = {$WRITINGACCESS};
</script>

<h3>Учет заработной платы</h3>

<br>

{foreach item=VALUE key=KEY from=$SALARY|json_decode}
    <div style="font-size: medium">{$VALUE->office}</div>
    <br>
    <div id="tableSalary_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>
{/foreach}


<style>
    .salary-cell {
        line-height: 17px;
        padding-right: 15px;
    }

    .webix_column.webix_first *:hover{
        color: blue!important;
        text-decoration: underline;
    }

    .webix_column.webix_first *{
        text-decoration: underline;
    }

</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
