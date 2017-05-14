<script>
    window.funnelDataNew = {$FUNNELNEW};
    window.funnelDataAll = {$FUNNELALL};
</script>

<style>
    .funnelBlock {
        width: 49.5%;
        display: inline-block;
        vertical-align: top;
    }

    .funnel {
        width: 100%;
    }
</style>

    <div class="funnelBlock">
        {foreach from=json_decode($FUNNELALL) key=i item=value}
            <div style="height: 900px" class="funnel" id="div_new_{$i}"></div>
            <br>
        {/foreach}
    </div>

    <div class="funnelBlock">
        {foreach from=json_decode($FUNNELNEW) key=i item=value}
            <div style="height: 900px" class="funnel" id="div_{$i}"></div>
            <br>
        {/foreach}
    </div>


























