<script>
    window.offices = {$SALARY};

</script>

<h3>Учет заработной платы</h3>

<br>

{foreach item=VALUE key=KEY from=$SALARY|json_decode}
    <div style="font-size: medium">{$VALUE->office}</div>
    <br>
    <div id="tableSalary_{$KEY}" style="overflow-x: auto; padding-bottom: 20px"></div>
{/foreach}


<style>

</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
