webix.ready(function () {


    // var dtable = new webix.ui({
    //     container: "tableHolidays",
    //     view: "datatable",
    //     columns: [
    //         {id: "date", header: "Дата", width: 120},
    //         {id: "holiday", header: "Праздник", width: 400}
    //     ],
    //     autoheight: true,
    //     autowidth: true,
    //     data: [
    //         {id: 1, date: "01.01.2016", holiday: "Праздник"},
    //         {id: 2, date: "01.02.2016", holiday: "Праздник"},
    //         {id: 3, date: "01.03.2016", holiday: "Праздник"},
    //         {id: 3, date: "01.04.2016", holiday: "Праздник"}
    //     ]
    //
    // });



    webix.ui({
        id:"data",
        view:"datatable",
        container:"tableHolidays",
            autoheight: true,
            autowidth: true,
        columns: [
            {id: "date", header: "Дата", width: 120},
            {id: "holiday", header: "Праздник", width: 400}
        ],
        select:"row",
        data:[
            {id: 1, date: "01.01.2016", holiday: "Праздник"},
            {id: 2, date: "01.02.2016", holiday: "Праздник"},
            {id: 3, date: "01.03.2016", holiday: "Праздник"},
            {id: 3, date: "01.04.2016", holiday: "Праздник"}
        ]
    });




});

function addData() {
    $$("data").add({
        date: document.getElementById("date").value,
        holiday: document.getElementById("holiday").value
    },0)
}
function removeData(){
    if(!$$("data").getSelectedId()){
        webix.message("No item is selected!");
        return;
    }
    $$("data").remove($$("data").getSelectedId());
}