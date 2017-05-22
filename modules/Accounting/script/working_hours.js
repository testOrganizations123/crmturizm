webix.ready(function () {

    window.workerHoursData.forEach(function (table, i, arr) {

        table.bodyTable.forEach(function (item, i, arr) {
            var sum = 0;

            Object.keys(item).map(function (objectKey, index) {
                if (parseInt(item[objectKey]) == item[objectKey] && objectKey != "id" && objectKey != "name") {
                    sum = sum + parseInt(item[objectKey]);
                }
            });


            item.sum = sum;

        });

        var dtable = new webix.ui({
            container: "tableHours_" + i,
            view: "datatable",
            width: 1000,
            columns:table.headerTable ,
            autoheight: true,
            autowidth: true,
            editable: window.writingAccess,
            data:  table.bodyTable,
            on: {
                onAfterEditStop: function (cell, coordinates) {

                    if (cell.old == cell.value || (!cell.old && !cell.value)) {
                        return;
                    }

                    var time = cell.value.replace(/ /g, "");

                    var availableChars = [
                        "к",
                        "К",
                        "от",
                        "ОТ",
                        "у",
                        "У",
                        "ДУ",
                        "ду",
                        "р",
                        "Р",
                        "ож",
                        "ОЖ",
                        "до",
                        "ДО",
                        "рт",
                        "РТ"
                    ];

                    if (time && parseInt(time) != time && !in_array(time, availableChars)) {
                        $(function () {
                            new PNotify({
                                title: 'Error!',
                                text: 'Ошибка валидации',
                                delay: 4000
                            });
                        });
                        var record = dtable.getItem(coordinates.row);
                        record[coordinates.column] = cell.old;
                        dtable.refresh();

                        return;
                    }

                    if (!in_array(time, availableChars) && parseInt(time) > 24) {
                        // $(function () {
                        //     new PNotify({
                        //         title: 'Error!',
                        //         text: 'Время не может быть больше 24',
                        //         delay: 4000
                        //     });
                        // });

                        record = dtable.getItem(coordinates.row);
                        record[coordinates.column] = cell.old;
                        dtable.refresh();

                        return;
                    }

                    var day = coordinates.column;
                    var user = coordinates.row;
                    var month = window.dataHeader.month;
                    var year = window.dataHeader.year;

                    $.ajax({
                        type: "GET",
                        url: "/index.php?module=Accounting&view=List&mode=workingHoursEdit&time=" + time + "&day=" + day + "&user=" + user + "&month=" + month + "&year=" + year,
                        success: function (data) {
                            if (data != "success") {
                                var record = dtable.getItem(coordinates.row);
                                record[coordinates.column] = cell.old;
                                dtable.refresh();
                                // $(function () {
                                //     new PNotify({
                                //         title: 'Ошибка сервера!',
                                //         text: data,
                                //         delay: 4000
                                //     });
                                //
                                // });
                            } else {
                                table.bodyTable.forEach(function (item, i, arr) {
                                    if (item.id == coordinates.row) {
                                        item[coordinates.column] = cell.value.replace(/ /g, "");
                                    }

                                });

                                record = dtable.getItem(coordinates.row);

                                var sum = 0;

                                Object.keys(record).map(function (objectKey, index) {
                                    if (parseInt(record[objectKey]) == record[objectKey] && objectKey != "id" && objectKey != "name" && objectKey != "sum") {
                                        sum = sum + parseInt(record[objectKey]);
                                    }
                                });

                                record["sum"] = sum;
                                dtable.refresh();
                            }
                        },
                        dataType: "json"
                    });

                }
            }
        });

    });

});

function in_array(what, where) {
    for (var i = 0; i < where.length; i++)
        if (what == where[i])
            return true;
    return false;
}













