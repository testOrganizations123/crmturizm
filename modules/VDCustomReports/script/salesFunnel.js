console.log(window.funelData);


AmCharts.makeChart("chartDiv", {
    "type": "funnel",
    "dataProvider": window.funelData.new[0].value,
    "titles": [
        {
            "size": 15,
            "text": window.funelData.new[0].title
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
        "valueText" : "[[level]]"
    },
    "labelPosition": "right"
});

AmCharts.makeChart("chartDiv2", {
    "type": "funnel",
    "dataProvider": window.funelData.new[0].value,
    "titles": [
        {
            "size": 15,
            "text": window.funelData.new[0].title + ' (Новые)'
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
        "valueText" : "[[level]]"
    },
    "labelPosition": "right"
});