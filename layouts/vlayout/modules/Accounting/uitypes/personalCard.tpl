<script>
    window.header = {$HEADER};
    window.data1 = {$DATA1};
    window.userInfo = {$USERINFO};
    window.writingAccess = {$WRITINGACCESS};
    window.vacationArchive = {$VACATIONARCHIVE};
    window.vacationPromotionalArchive = {$VACATIONPROMOTOINALARCHIVE};
    window.maternityLeave = [];

    console.log({$VACATIONPROMOTOINALARCHIVE});
</script>
<style>
    .header  {
        background: #edf !important;
        font-weight: bold;
        text-align: center;
    }
    .webix_cell{
        height: 33px!important;
    }
    #maternityLeave .webix_cell{
        height: 31px!important;
    }
</style>
<div style="display: inline-block; vertical-align: top">
    <h3>Ставка</h3>
    <br>
    <div id="rate"></div>
</div>
<div style="display: inline-block; margin-left: 15px; vertical-align: top">
    <h3>Этапы</h3>
    <br>
    <div id="levels"></div>
</div>
<br><br><br>
<h3>Аналитика по эффективности финансовых показателей</h3>
<br>
<div id="personal-card"></div>
<br><br>
<h3>Аналитика по эффективности выполнения стандартов (в разработке)</h3>
<br>
<div id="personal-card2"></div>
<br>
<br>
<br>
<div style="display: inline-block; vertical-align: top">
    <h3>Архив очередных отпусков</h3>
    {if !$VACATIONARCHIVE|json_decode}
        <div style="font-size: medium">нет отпусков</div>
    {/if}
    {foreach item=VALUE key=KEY from=$VACATIONARCHIVE|json_decode}
        <br>
        <div style="font-size: medium">{$KEY}</div>
        <br>
        <div id="vacation_{$KEY}" style="overflow-x: auto; padding-bottom: 20px">
        </div>
    {/foreach}
</div>

<div style="display: inline-block; margin-left: 40px; vertical-align: top">
    <h3>Архив 'рекламный тур'</h3>
    {if !$VACATIONPROMOTOINALARCHIVE|json_decode}
        <div style="font-size: medium">нет командировок</div>
    {/if}
    {foreach item=VALUE key=KEY from=$VACATIONPROMOTOINALARCHIVE|json_decode}
        <br>
        <div style="font-size: medium">{$KEY}</div>
        <br>
        <div id="vacation_advertising_tour_{$KEY}" style="overflow-x: auto; padding-bottom: 20px">
        </div>
    {/foreach}
</div>

<br>
<br>
<br>
<div>
    <h3>Декретный отпуск (в разработке)</h3>
    <br>
    <button style="width: 30px; height: 30px;font-weight: bold; font-size: 14px" onclick="addMaternityLeave()">+</button>
    <br>
    <br>
    <div id="maternityLeave"></div>
</div>

<br>
<br>
<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">

