console.log(window.funelData);


AmCharts.makeChart("chartDiv", {
    "type": "funnel",
    "dataProvider": [{
        "title": "Андрей",
        "level": 300,
        "height": 1

    }, {
        "title": "Дима",
        "level": 123,
        "height": 1
    }, {
        "title": "Петя",
        "level": 98,
        "height": 1
    }, {
        "title": "Вася",
        "level": 72,
        "height": 1
    }, {
        "title": "Коля",
        "level": 35,
        "height": 1
    }, {
        "title": "Игорь",
        "level": 25,
        "height": 1
    }, {
        "title": "Вова",
        "level": 18,
        "height": 1
    }],
    "titles": [
        {
            "size": 15,
            "text": "Рейтинг"
        }
    ],
    "marginRight": 160,
    "titleField": "title",
    "labelsEnabled": true,
    "valueField": "height",
    "neckWidth": "0",
    "neckHeight": "0",
    "balloonText": "[[title]]: [[level]]",
    "labelText": "[[title]]: [[level]]",
    "legend": {
        "valueText" : "[[level]]"
    },
    "labelPosition": "right"
});