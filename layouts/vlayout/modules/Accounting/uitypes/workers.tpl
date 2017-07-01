<script>
    window.offices = {$OFFICES};
</script>

<h3>Сотрудники</h3>
<br>

{*{foreach item=VALUE key=KEY from=$WORKINGHOURSDATA|json_decode}*}
    {*<div style="font-size: medium">{$VALUE->nameOffice}</div>*}
    {*<br>*}
    {*<div id="tableHours_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>*}
{*{/foreach}*}


{foreach item=VALUE key=KEY from=$OFFICES|json_decode}
    <div style="font-size: medium">{$VALUE->office}</div>
    <br>
    <div id="tableWorkers_{$KEY}" style="overflow-x: auto; padding-bottom: 20px">
    </div>
{/foreach}


<style>
    .webix_column:not(.webix_first){
        cursor: pointer;
    }
</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">