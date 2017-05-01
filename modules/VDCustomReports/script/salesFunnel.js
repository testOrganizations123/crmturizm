console.log(window.funnelDataNew);
console.log(window.funnelDataAll);

for (var i=0; i< window.funnelDataNew.length; i++) {
    AmCharts.makeChart("div_" + i, {
        "type": "funnel",
        "dataProvider": window.funnelDataNew[i].value,
        "titles": [
            {
                "size": 15,
                "text": window.funnelDataNew[i].title
            }
        ],
        "marginRight": 200,
        "titleField": "title",
        "labelsEnabled": true,
        "valueField": "height",
        "neckWidth": "0",
        "neckHeight": "0",
        "balloonText": "[[text]] [[level]]",
        "labelText": "[[text]][[level]]",
        "legend": {
            "valueText": "[[level]]"
        },
        "labelPosition": "right"
    });

}

for (var i=0; i< window.funnelDataNew.length; i++) {
    AmCharts.makeChart("div_new_" + i, {
        "type": "funnel",
        "dataProvider": window.funnelDataNew[i].value,
        "titles": [
            {
                "size": 15,
                "text": window.funnelDataNew[i].title + " (новые)"
            }
        ],
        "marginRight": 200,
        "titleField": "title",
        "labelsEnabled": true,
        "valueField": "height",
        "neckWidth": "0",
        "neckHeight": "0",
        "balloonText": "[[text]] [[level]]",
        "labelText": "[[text]][[level]]",
        "legend": {
            "valueText": "[[level]]"
        },
        "labelPosition": "right"
    });

}