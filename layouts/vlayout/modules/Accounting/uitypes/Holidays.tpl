<script>
    window.holidays = {$HOLIDAYS};
    window.dateStart = '{$MONTHPERIOD}';
    window.writingAccess = {$WRITINGACCESS};

</script>

<h3>Праздничные дни</h3>
<br>
<div id="tableHolidays"  style="overflow-x: auto; display: inline-block; vertical-align: top; padding-bottom: 20px"></div>

{if $WRITINGACCESS == 'true'}
    <div style="display: inline-block; vertical-align: top; margin-top: -18px;">
        <form style="margin-left:20px;width:200px">
            Дата <div  id="date" ></div>
            Праздник <input type="text" id="holiday" value=""><br>
            <div  style="display: inline-block; "><input type="button" class="btn" value="Добавить" onclick="addData()"></div>
        </form>
    </div>
{/if}

<style>
    .delbtn:hover{
        background: red;
        color: white;
    }
    .delbtn{
        display: block;
        text-align: center;
        margin-top: 5px;
        height: 25px;
        line-height: 24px;
        font-weight: bold;
        background: #eeeeee;
    }
    .webix_inp_static {
        border-radius: 0!important;
        margin-top: -3px;
        line-height: 25px!important;
        height: 28px!important;
        cursor: pointer;
    }

    .webix_input_icon.fa-calendar{
        border-radius: 0!important;
        height: 24px!important;
        padding-top: 4px!important;
        margin-top: -3px;
        cursor: pointer;
    }

    #holiday{
        box-shadow: none;
        width: 189px;
        height: 16px!important;
    }
</style>

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">
