<script>
    {*window.workerHoursData = {$WORKINGHOURSDATA};*}
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


<style>

    #tableVacation *, #tableVacationPromo *{
        font-size: 14px;
    }

    .tableVacation {
        cursor: pointer;
        border: 1px solid #aad5fd;
        height: 85%;
        width: 85px;
        margin-left: -9px;
        margin-top: 2px;
        text-align: center;
        line-height: 35px;
    }
</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">