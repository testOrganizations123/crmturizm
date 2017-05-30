<script>
    window.holidays = {$HOLIDAYS};

</script>

<h3>Праздничные дни</h3>
<br>
<div id="tableHolidays"  style="overflow-x: auto; display: inline-block; vertical-align: top; padding-bottom: 20px"></div>
<div style="display: inline-block; vertical-align: top; margin-top: -18px;">
<form style="margin-left:20px;width:200px">
    Дата <input type="text" id="date" value=""><br>
    Праздник <input type="text" id="holiday" value=""><br>
    <div  style="display: inline-block; "><input type="button" class="btn" value="Добавить" onclick="addData()"></div>

</form>
</div>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
