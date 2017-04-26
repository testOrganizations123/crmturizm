<script>
    window.officePlan = {$OFFICEPLANJSON};
    {*window.allPlan = {$ALLPLANJSON};*}
    window.workerPlan = {$WORKERPLANJSON};
</script>

{if $TYPEPLAN == "all"}
    <h3>Общий план продаж на {$STRDATE}</h3>
    <br>
    <div id="allPlan"></div>
    <br>
    <hr>
    <br>
    <h3>План продаж по офисам на {$STRDATE}</h3>
    <br>
    <div id="officesPlan"></div>
{/if}

{if $TYPEPLAN == "region"}
    <h3>План продаж по офисам на {$STRDATE}</h3>
    <br>
    <div id="officesPlan"></div>
{/if}

{if $TYPEPLAN == "office"}
    <h3>План продаж по офису  "{$OFFICESELECT}"  на {$STRDATE}</h3>
    <br>
    <div id="officesPlan"></div>
    <br>
    <hr>
    <br>
    <h3>План продаж по сотрудникам  на {$STRDATE}</h3>
    <br>
    <div id="workersPlan"></div>
{/if}

{if $TYPEPLAN == "worker"}
    <h3>План продаж по сотруднику  на {$STRDATE}</h3>
    <br>
    <div id="workersPlan"></div>
{/if}

<link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css">

