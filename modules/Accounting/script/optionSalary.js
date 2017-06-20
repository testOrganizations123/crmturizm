/**
 * Created by HP on 14.06.2017.
 */
var dtable = new webix.ui({
    container: "tableOptionSalary",
    view: "datatable",
    columns: [
        {id: "level", header: "Этап", width: 100},
        {id: "percent", header:"Процент", width: 100, editor: "text"}

    ],

    autoheight: true,
    autowidth: true,
    editable: window.writingAccess,
    rowHeight: 40,
    data: window.data,
    on: {
        onAfterEditStop: function (cell, coordinates) {

            var record = dtable.getItem(coordinates.row);
         console.log(record);

            $.ajax({
                type: "GET",
                url: "/index.php?module=Accounting&view=List&mode=editLevelPercent&id="+record.id+"&level="+record.level+"&percent="+record.percent,
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