console.log(window.funnelDataNew);
console.log(window.funnelDataAll);

for (var i=0; i< window.funnelDataNew.length; i++) {
    AmCharts.makeChart("div_" + i, {
        "type": "funnel",
        "dataProvider": window.funnelDataNew[i].value,
        "titles": [
            {
                "size": 15,
                "text": window.funnelDataNew[i].title + " (новые)"
            }
        ],
        "marginLeft": 200,
        "titleField": "title",
        "labelsEnabled": true,
        "valueField": "height",
        "neckWidth": "0",
        "neckHeight": "0",
        "balloonText": "[[text]] [[level]] [[percent]]",
        "labelText": "[[text]][[level]] [[percent]]",
        "legend": {
            "valueText": "[[level]]"
        },
        "labelPosition": "left"
    });

}

for (i=0; i< window.funnelDataAll.length; i++) {
    AmCharts.makeChart("div_new_" + i, {
        "type": "funnel",
        "dataProvider": window.funnelDataAll[i].value,
        "titles": [
            {
                "size": 15,
                "text": window.funnelDataAll[i].title
            }
        ],
        "marginRight": 200,
        "titleField": "title",
        "labelsEnabled": true,
        "valueField": "height",
        "neckWidth": "0",
        "neckHeight": "0",
        "balloonText": "[[text]] [[level]] [[percent]]",
        "labelText": "[[text]][[level]] [[percent]]",
        "legend": {
            "valueText": "[[level]]"
        },
        "labelPosition": "right"
    });

}