
webix.ready(function () {



    dtable = webix.ui({
        id: "data",
        view: "datatable",
        container: "tableHolidays",
        autoheight: true,
        autowidth: true,
        columns: [
            {id: "date", header: "Дата", width: 120},
            {id: "holiday", header: "Праздник", width: 400},
            {id: "", template: "<button class='delbtn' >x</button>", width: 45}
        ],
        data: window.holidays
    });
    dtable.on_click.delbtn = function (e, id, trg) {
        $.ajax({
            type: 'get',
            url: '/index.php?module=Accounting&view=List&mode=deleteHoliday&id=' + id,
            success: function (dataJSON) {
           var data = $.parseJSON(dataJSON);
                if (data.status == 'success'){

                    $$("data").remove(id);

                }

            }

        });


        return false; //here it blocks default behavior
    };


});

function addData() {

    var date = $("#date").find('.webix_inp_static').html();
    var holiday = $("#holiday").val();
    $.ajax({
        type: 'get',
        url: '/index.php?module=Accounting&view=List&mode=addHoliday&date=' + date + '&holiday=' + holiday,
        success: function (dataJson) {
            var data = $.parseJSON(dataJson);
            if (data.status == 'success') {

                $$("data").add({
                    date: date,
                    holiday: holiday

                }, 0);
                dtable.sort("date", "asc");
                $("#date").find('.webix_inp_static').html("");
                 $("#holiday").val("");

            }

        }

    });


}
var arrDate = window.dateStart.split('.');
var i = arrDate.length;


var dateFilter = webix.ui({
    container: "dateFilter",


    view:"datepicker",align:"right",value : arrDate[i-1],type:"year", format:"%Y"

});

dateFilter.attachEvent("onChange", function(newv, oldv){
   $('#dateHidden').val($("#dateFilter").find('.webix_inp_static').html());
});

var dateWebix = webix.ui({
    container: "date",


    view:"datepicker",align:"right", format:"%Y-%m-%d"

});