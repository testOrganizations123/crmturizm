<script>
    window.workerHoursData = {$WORKINGHOURSDATA};
    window.dataHeader = {$DATAHEADER};
    window.writingAccess = {$WRITINGACCESS};

</script>

<h3>Учет рабочего времени</h3>
<br>
<h5>Условные обозначения</h5>
<table>
    <tr>
        <td>Служебная командировка<td>
        <td>К<td>
    </tr>
    <tr>
        <td>Ежегодный основной оплачиваемый отпуск<td>
        <td>от<td>
    </tr>
    <tr>
        <td>Дополнительный отпуск в связи с обучением с сохранением среднего заработка работникам, совмещающим работу с обучением &nbsp;<td>
        <td>У<td>
    </tr>
    <tr>
        <td>Дополнительный отпуск в связи с обучением без сохранения заработной платы<td>
        <td>ДУ<td>
    </tr>
    <tr>
        <td>Отпуск по беременности и родам (отпуск в связи с усыновлением новорожденного ребенка)<td>
        <td>р<td>
    </tr>
    <tr>
        <td>Отпуск по уходу за ребенком до достижения им возраста трех лет<td>
        <td>ож<td>
    </tr>
    <tr>
        <td>Отпуск без сохранения заработной платы, предоставляемый работнику по разрешению работодателя<td>
        <td >до<td>
    </tr>
    <tr>
        <td>Рекламный тур<td>
        <td>РТ<td>
    </tr>
    <tr>
        <td>Больничный<td>
        <td>Б<td>
    </tr>
    <tr>
        <td>Выходные дни<td>
        <td>Вх<td>
    </tr>
</table>
<br>

{foreach item=VALUE key=KEY from=$WORKINGHOURSDATA|json_decode}
    <div style="font-size: medium">{$VALUE->nameOffice}</div>
    <br>
    <div id="tableHours_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>
{/foreach}


<style>
    .webix_column:not(.webix_first):not(.webix_last){
        cursor: pointer;
    }
</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">