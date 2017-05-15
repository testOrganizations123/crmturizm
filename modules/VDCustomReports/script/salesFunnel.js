
for (var i=0; i< window.funnelDataNew.length; i++) {

    for(j=0; j< window.funnelDataNew[i].value.length; j++){
        if (window.funnelDataNew[i].value[j].level == 0 || window.funnelDataNew[i].value[j].level[0] === '0'){
            window.funnelDataNew[i].value[j].height = 1;
        }
    }

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
        "balloonText": "[[text]] [[level]]\n[[percent]]",
        "labelText": "[[text]][[level]]\n[[percent]]",
        "legend": {
            "valueText": "[[level]] [[percent]]",
            "valueWidth": 200
        },
        "labelPosition": "left"
    });

}

for (i=0; i< window.funnelDataAll.length; i++) {

    for(j=0; j< window.funnelDataAll[i].value.length; j++){
        if (window.funnelDataAll[i].value[j].level == 0 || window.funnelDataAll[i].value[j].level[0] === '0'){
            window.funnelDataAll[i].value[j].height = 1;
        }
    }

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
        "balloonText": "[[text]] [[level]]\n[[percent]]",
        "labelText": "[[text]][[level]]\n[[percent]]",
        "legend": {
            "valueText": "[[level]] [[percent]]",
            "valueWidth": 200
        },
        "labelPosition": "right"
    });

}