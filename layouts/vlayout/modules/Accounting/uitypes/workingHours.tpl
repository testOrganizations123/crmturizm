<script>
    window.workerHoursData = {$WORKINGHOURSDATA};
    window.dataHeader = {$DATAHEADER};
</script>

<h3>Учет рабочего времени</h3>
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