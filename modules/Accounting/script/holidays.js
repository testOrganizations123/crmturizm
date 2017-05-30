var dtable;
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


    dtable = webix.ui({
        id: "data",
        view: "datatable",
        container: "tableHolidays",
        autoheight: true,
        autowidth: true,
        columns: [
            {id: "date", header: "Дата", width: 120},
            {id: "holiday", header: "Праздник", width: 400},
            {id:"", template:"<input class='delbtn' type='button' value='Delete'>",css:"padding_less",width:100}
        ],
        select: "row",
        data: window.holidays
    });


});

function addData() {

    var date = document.getElementById("date").value;
    var holiday = document.getElementById("holiday").value;
    $.ajax({
        type: 'get',
        url: '/index.php?module=Accounting&view=List&mode=addHoliday&date=' + date + '&holiday=' + holiday,
        success: function (data) {
            if (data.status == 'success') {

                $$("data").add({
                    date: date,
                    holiday: holiday

                }, 0);

            }

        }

    });

    $$("data").add({
        date: date,
        holiday: holiday

    }, 0);
    dtable.markSorting("date", "asc");

}
function removeData() {

    if (!$$("data").getSelectedId()) {
        webix.message("No item is selected!");
        return;
    }
    var row = $$("data").getSelectedId();

    $.ajax({
        type: 'get',
        url: '/index.php?module=Accounting&view=List&mode=deleteHoliday&id='+row.id,
        success: function (data) {
            if (data.status == 'success') {
                $$("data").remove($$("data").getSelectedId());

            }

        }

    });


}