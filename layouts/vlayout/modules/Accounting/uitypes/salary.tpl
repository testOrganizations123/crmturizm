<script>
    window.offices = {$SALARY};
    window.date = '{$MONTHPERIOD}';
    window.dateObject = JSON.parse('{$DATE}');



    var date = new Date(window.dateObject.year, window.dateObject.month - 1, "1");
    var mouthNumber = date.getMonth();

    var countWorkingDaysWithHolidays = 0;

    if (date.getDay() != 6 && date.getDay() != 0) {
        countWorkingDaysWithHolidays ++;
    }

    for (var i = 1; i<= 40; i++) {
        date.setDate(date.getDate() + 1);
        if (date.getMonth() !== mouthNumber) {
            break;
        }
        if (date.getDay() != 6 && date.getDay() != 0) {
            countWorkingDaysWithHolidays ++
        }
    }

    window.countWorkingDaysWithHolidays = countWorkingDaysWithHolidays;


</script>

<h3>Учет заработной платы</h3>

<br>

{foreach item=VALUE key=KEY from=$SALARY|json_decode}
    <div style="font-size: medium">{$VALUE->office}</div>
    <br>
    <div id="tableSalary_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>
{/foreach}


<style>
    .salary-cell{
        line-height: 17px;
        padding-right: 15px;

</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
