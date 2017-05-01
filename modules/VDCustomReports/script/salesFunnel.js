console.log(window.funelData);


AmCharts.makeChart("chartDiv", {
    "type": "funnel",
    "dataProvider": window.funelData.new["Все источники"],
    "titles": [
        {
            "size": 15,
            "text": "Рейтинг"
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
    "dataProvider": window.funelData.new["Все источники"],
    "titles": [
        {
            "size": 15,
            "text": "Рейтинг"
        }
    ],
    "marginRight": 200,
    "titleField": "title",
    "labelsEnabled": true,
    "valueField": "height",
    "neckWidth": "0",
    "neckHeight": "0",
    "balloonText": "[[title]][[level]]",
    "labelText": "[[title]][[level]]",
    "legend": {
        "valueText" : "[[level]]"
    },
    "labelPosition": "right"
});