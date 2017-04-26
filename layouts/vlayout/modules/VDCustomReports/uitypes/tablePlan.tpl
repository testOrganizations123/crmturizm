    <table class="table-hover table abc" style="width: 100%">
        <tbody>
        <tr>
            <th></th>
            <th>{$TITLEONE}</th>
            <th>Прибыль/Продажи</th>
        </tr>
        {foreach from = $SELLING key=k item = v}
            <tr>
                <td><div style="width: 15px;height: 15px;background-color: {$v.color};"></div></td>
                <td>{$v.name}</td>
                <td>{$v.amount}</td>
            </tr>

        {/foreach}


        <tr class="success bold">
            <td><div style="width: 15px;height: 15px;background-color: {$COLOR};"></div></td>
            <td>Итого</td>
            <td>{$SUM}</td>
        </tr>
        </tbody>
    </table>