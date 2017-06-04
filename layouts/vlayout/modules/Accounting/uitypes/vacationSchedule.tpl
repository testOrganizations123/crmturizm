<script>
    window.offices = {$VACATIONSCHEDULE};
    window.dateStart = '{$MONTHPERIOD}';
    window.writingAccess = {$WRITINGACCESS};
    console.log(window.writingAccess);
</script>

<h3>График отпусков</h3>

<br>


{foreach item=VALUE key=KEY from=$VACATIONSCHEDULE|json_decode}
    <div style="font-size: medium">{$VALUE->office}</div>
    <br>
    <h4>Основной отпуск</h4>
    <br>
    <div id="tableVacation_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>
    <br>
    <h4>Рекламный тур</h4>
    <br>
    <div id="tableVacationPromo_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>
    <br>
    <h4>График</h4>
    <br>
    <div class="charts" id="{$VALUE->office}" style="overflow-x: auto; padding-bottom: 20px"></div>
{/foreach}




<style>

    .charts {
        width: 100%;
        height: 400px;
    }

    #tableVacation *, #tableVacationPromo *{
        font-size: 14px;
    }
</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />