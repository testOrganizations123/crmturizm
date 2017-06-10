<script>
    window.salary = {$VACATIONSCHEDULE};

</script>

<h3>Учет заработной платы</h3>

<br>




{*{foreach item=VALUE key=KEY from=$VACATIONSCHEDULE|json_decode}*}
    {*<div style="font-size: medium">{$VALUE->office}</div>*}
    {*<br>*}
    {*<h4>Основной отпуск</h4>*}
    <br>
    <div id="tableSalary" style="overflow-x: auto; padding-bottom: 20px"></div>
    {*<br>*}
    {*<h4>Рекламный тур</h4>*}
    {*<br>*}
    {*<div id="tableVacationPromo_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>*}
    {*<br>*}
    {*<h4>Сессии</h4>*}
    {*<br>*}
    {*<div id="tableVacationSession_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>*}
    {*<br>*}
    {*<h4>График</h4>*}
    {*<br>*}
    {*<div class="charts" id="{$VALUE->officeId}" style="overflow-x: auto; padding-bottom: 20px; height: {$VALUE->height}px"></div>*}
{*{/foreach}*}




<style>

</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
