
webix.ready(function () {

    window.offices.forEach(function (table, i, arr) {


        var dtable = new webix.ui({
            container: "tableSalary_" + i,
            view: "datatable",
            columns: [
                {id: "worker", header: "Сотрудник", width: 238},
                {id: "allowed", header: {text: "Итого"}}
            ],
            autoheight: true,
            autowidth: true,
            editable: true,
            rowHeight: 40,
            data: table.salary,
            on: {
                onAfterEditStop: function (cell, coordinates) {

                    var record = dtable.getItem(coordinates.row);

                    $.ajax({
                        type: "GET",
                        url: "/index.php?module=Accounting&view=List&mode=editSalary&value=",
                        success: function (data) {
                            if (data != "success") {
                                record[coordinates.column] = cell.old;
                                dtable.refresh();
                                $(function () {
                                    new PNotify({
                                        title: 'Ошибка валидации!',
                                        text: data,
                                        delay: 4000
                                    });

                                });

                            } else {

                            }
                        },
                        dataType: "json"
                    });


                }
            }
        });

    });


});