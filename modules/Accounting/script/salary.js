webix.ready(function () {

    window.offices.forEach(function (table, i, arr) {


        var dtable = new webix.ui({
            container: "tableSalary_" + i,
            view: "datatable",
            columns: [
                {id: "worker", header: "Сотрудник", width: 238},
                {id: "salary", header:{text:"<div class='salary-cell'>Базовый оклад", rotate: true, height: 185}, width: 79},
                {id: "vacation", header: {text:"<div class='salary-cell'>Отпуск / больничный</div>", rotate: true, height: 185}, width: 79},
                {id: "allowedSalary", header: {text:"<div class='salary-cell'>Итого фактический оклад</div>", rotate: true, height: 185}, width: 79},
                {id: "salesRevenue", header: {text:"<div class='salary-cell'>Доход от продаж</div>", rotate: true, height: 185}, width: 79},
                {id: "stage", header: {text:"<div class='salary-cell'>Достигнутый этап в виде цифры</div>", rotate: true, height: 185}, width: 79},
                {id: "salesPremiums", header: {text:"<div class='salary-cell'>Премии за продажи<br>(в рублях) факт</div>", rotate: true, height: 185}, width: 79},
                {id: "possiblePremiums", header: {text:"<div class='salary-cell'>Возможная премии за продажи (в рублях)</div>", rotate: true, height: 185}, width: 79},
                {id: "siteNotification", header: {text:"<div class='salary-cell'>Уведомления по сайту (в рублях)</div>", rotate: true, height: 185}, width: 79},
                {id: "updateSite", header: {text:"<div class='salary-cell'>Обновление сайта</div>", rotate: true, height: 185}, width: 79},
                {id: "transfer", header: {text:"<div class='salary-cell'>Трансфер</div>", rotate: true, height: 185}, width: 79},
                {id: "sharesTicket", header:{text:"<div class='salary-cell'>Акции: авиа-жд билеты + страховки</div>", rotate: true, height: 185}, width: 79},
                {id: "sharesCoaching", header: {text:"<div class='salary-cell'>Акция наставничество</div>", rotate: true, height: 185}, width: 79},
                {id: "birthday", header:{text:"<div class='salary-cell'>День рождения</div>", rotate: true, height: 185}, width: 79},
                {id: "allowedShares", header:{text:"<div class='salary-cell'>Итого по акциям<br>(в рублях)</div>", rotate: true, height: 185}, width: 79},
                {id: "totalWages", header: {text:"<div class='salary-cell'><b>ВСЕГО</b> ЗП к выдаче сотруднику за месяц</div>", rotate: true, height: 185}, width: 79},
                {id: "possibleSalary", header: {text:"<div class='salary-cell'>ВСЕГО возможная ЗП оклад + премии<br>(без акций)</div>", rotate: true, height: 185}, width: 79}
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