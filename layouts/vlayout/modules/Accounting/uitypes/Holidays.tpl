<script>
    window.holidays = {$HOLIDAYS};

</script>

<h3>Праздничные дни</h3>
<br>
<div id="tableHolidays"  style="overflow-x: auto; display: inline-block; padding-bottom: 20px"></div>
<div style="display: inline-block">
<form style="margin-left:20px;width:200px">
    Дата <input type="text" id="date" value=""><br>
    Праздник <input type="text" id="holiday" value=""><br>
    <div  style="display: inline-block"><input type="button" value="Добавить" onclick="addData()"></div>
    <div  style="display: inline-block"><input type="button" value="Удалить" onclick="removeData()"></div>

</form>
</div>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
