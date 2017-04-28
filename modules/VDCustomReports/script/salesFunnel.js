console.log(window.funelData);


AmCharts.makeChart("chartDiv", {
    "type": "funnel",
    "dataProvider": [{
        "title": "Андрей",
        "value1": 300,
        "b": 1

    }, {
        "title": "Дима",
        "value1": 123,
        "b": 1
    }, {
        "title": "Петя",
        "value1": 98,
        "b": 1
    }, {
        "title": "Вася",
        "value1": 72,
        "b": 1
    }, {
        "title": "Коля",
        "value1": 35,
        "b": 1
    }, {
        "title": "Игорь",
        "value1": 25,
        "b": 1
    }, {
        "title": "Вова",
        "value1": 18,
        "b": 1
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
    "valueField": "b",
    "neckWidth": "0",
    "startAlpha": 0,
    "outlineThickness": 1,
    "neckHeight": "0",
    "balloonText": "[[title]]: [[value1]]",
    "labelText": "[[title]]: [[value1]]",
    "legend": {
        "valueText" : "[[value1]]"
    },
    "labelPosition": "right"
});