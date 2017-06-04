<script>
    window.vacationSchedule = {$VACATIONSCHEDULE};
</script>

<h3>График отпусков</h3>

<br>

<div style="font-size: medium">Кемерово</div>
<br>
<h4>Основной отпуск</h4>
<div id="tableVacation" style="margin-top: 2px"></div>
<br>
<h4>Рекламный тур</h4>
<div id="tableVacationPromo" style="margin-top: 2px"></div>

<h4>График</h4>
<div id="chart" style="margin-top: 2px"></div>

<style>

    #chart {
        width: 100%;
        height: 5000px;
    }

    #tableVacation *, #tableVacationPromo *{
        font-size: 14px;
    }
</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />