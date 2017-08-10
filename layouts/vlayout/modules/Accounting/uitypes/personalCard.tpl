<script>
    window.header = {$HEADER};
    window.data1 = {$DATA1};
    window.userInfo = {$USERINFO};
    window.writingAccess = {$WRITINGACCESS};
    window.vacationArchive = {$VACATIONARCHIVE};
    window.vacationPromotionalArchive = {$VACATIONPROMOTOINALARCHIVE};
    window.maternityLeave = {$MATERNITYLEAVE};

    console.log({$VACATIONPROMOTOINALARCHIVE});
</script>
{*<style>*}
    {*.header  {*}
        {*background: #edf !important;*}
        {*font-weight: bold;*}
        {*text-align: center;*}
    {*}*}
    {*.webix_cell{*}
        {*height: 33px!important;*}
    {*}*}
    {*#maternityLeave .webix_cell{*}
        {*height: 31px!important;*}
    {*}*}

    {*.delbtn:hover{*}
        {*background: red;*}
        {*color: white;*}
    {*}*}
    {*.delbtn{*}
        {*display: block;*}
        {*text-align: center;*}
        {*margin-top: 5px;*}
        {*height: 25px;*}
        {*line-height: 24px;*}
        {*font-weight: bold;*}
        {*background: #eeeeee;*}
    {*}*}
    {*.webix_inp_static {*}
        {*border-radius: 0!important;*}
        {*margin-top: -3px;*}
        {*line-height: 25px!important;*}
        {*height: 28px!important;*}
        {*cursor: pointer;*}
    {*}*}

    {*.webix_input_icon.fa-calendar{*}
        {*border-radius: 0!important;*}
        {*height: 24px!important;*}
        {*padding-top: 4px!important;*}
        {*margin-top: -3px;*}
        {*cursor: pointer;*}
    {*}*}

    {*#holiday{*}
        {*box-shadow: none;*}
        {*width: 189px;*}
        {*height: 16px!important;*}
    {*}*}
{*</style>*}
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
    <h3>Декретный отпуск</h3>
    <br>

    <br>
    <div id="maternityLeave" style="display: inline-block;"></div>
    {if $WRITINGACCESS == 'true'}
        <div style="display: inline-block; vertical-align: top; margin-top: -18px;">
            <form style="margin-left:20px;width:200px">
                Начало <div  id="start" ></div>
                Конец <div  id="finish" ></div><br>
                <div  style="display: inline-block; "><input type="button" class="btn" value="Добавить" onclick="addMaternityLeave()"></div>
            </form>
        </div>
    {/if}
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">

