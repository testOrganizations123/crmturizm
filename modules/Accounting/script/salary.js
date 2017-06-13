webix.ready(function () {

    window.offices.forEach(function (table, i, arr) {


        var dtable = new webix.ui({
            container: "tableSalary_" + i,
            view: "datatable",
            columns: [
                {id: "worker", header: "Сотрудник", width: 238},
                {id: "salary", header:{text: "базовый оклад", rotate: true, height: 175}, width: 79},
                {id: "vacation", header: {text:"отпуск/больничный", rotate: true, height: 175}, width: 79},
                {id: "allowedSalary", header: {text:"итого фактический оклад", rotate: true, height: 175}, width: 79},
                {id: "salesRevenue", header: {text:"доход от продаж", rotate: true, height: 175}, width: 79},
                {id: "stage", header: {text:"достигнутый этап в виде цифры", rotate: true, height: 175}, width: 79},
                {id: "salesPremiums", header: {text:"премии за продажи (в рублях) факт", rotate: true, height: 175}, width: 79},
                {id: "possiblePremiums", header: {text:"возможная премии за продажи (в рублях)", rotate: true, height: 175}, width: 79},
                {id: "siteNotification", header: {text:"уведомления по сайту. Руб", rotate: true, height: 175}, width: 79},
                {id: "updateSite", header: {text:"обновление сайта", rotate: true, height: 175}, width: 79},
                {id: "transfer", header: {text:"трансфер", rotate: true, height: 175}, width: 79},
                {id: "sharesTicket", header:{text: "акции: авиа-жд билеты + страховки", rotate: true, height: 175}, width: 79},
                {id: "sharesCoaching", header: {text:"акция наставничество", rotate: true, height: 175}, width: 79},
                {id: "birthday", header:{text:"день рождения", rotate: true, height: 175}, width: 79},
                {id: "allowedShares", header:{text: "день рождения", rotate: true, height: 175}, width: 79},
                {id: "totalWages", header: {text:"ВСЕГО ЗП к выдаче сотруднику за месяц", rotate: true, height: 175}, width: 79},
                {id: "possibleSalary", header: {text:"ВСЕГО возможная ЗП оклад + премии (без акций)", rotate: true, height: 175}, width: 79}
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