webix.ready(function () {

    var date = new Date(window.dateObject.year, window.dateObject.month - 1, "1");
    var mouthNumber = date.getMonth();

    var countWorkingDaysWithHolidays = 0;

    if (date.getDay() != 6 && date.getDay() != 0) {
        countWorkingDaysWithHolidays ++;
    }

    for (var i = 1; i<= 40; i++) {
        date.setDate(date.getDate() + 1);
        if (date.getMonth() !== mouthNumber) {
            break;
        }
        if (date.getDay() != 6 && date.getDay() != 0) {
            countWorkingDaysWithHolidays ++
        }
    }

    var countWorkingDays = countWorkingDaysWithHolidays - window.amountHoliday;

    window.offices.forEach(function (table, i, arr) {

        table.salary.forEach(function (item, i, arr) {

            item['allowedShares'] = 0;

            if (item['update_site']) {
                item['allowedShares'] = item['allowedShares'] + parseInt(item['update_site']);
            }

            if (item['transfer']) {
                item['allowedShares'] = item['allowedShares'] + parseInt(item['transfer']);
            }

            if (item['site_notification']) {
                item['allowedShares'] = item['allowedShares'] + parseInt(item['site_notification']);
            }

            if (item['ticket_insurance']) {
                item['allowedShares'] = item['allowedShares'] + parseInt(item['ticket_insurance']);
            }

            if (item['coaching']) {
                item['allowedShares'] = item['allowedShares'] + parseInt(item['coaching']);
            }

            if (item['birthday']) {
                item['allowedShares'] = item['allowedShares'] + parseInt(item['birthday']);
            }



            if (parseInt(item['base_salary']) >=0 && parseInt(item['stagePercent']) >= 0) {
                item['salesPremiums'] = parseInt(item['base_salary']) * parseInt(item['stagePercent']) / 100;
            }

            if (parseInt(item['base_salary']) >= 0 && parseInt(item['maxPercent']) >=0) {
                item['possiblePremiums'] = parseInt(item['base_salary']) * parseInt(item['maxPercent']) / 100;
            }

            if (parseInt(item['base_salary']) >=0) {
                item['allowedSalary'] = parseInt(item['base_salary']) / countWorkingDays * parseInt(item['workingHoursDays']) / 8;
            }

            if (parseInt(item['base_salary']) >=0) {
                item['vacation'] = parseInt(item['base_salary']) / countWorkingDays * 0.8 * parseInt(item['hospitalDays'])
                                 + parseInt(item['base_salary']) / countWorkingDays * parseInt(item['vacationDays']);
            }


        });


        var dtable = new webix.ui({
            container: "tableSalary_" + i,
            view: "datatable",
            columns: [
                {id: "worker", header: "Сотрудник", width: 238},
                {
                    id: "base_salary",
                    header: {text: "<div class='salary-cell'>Базовый оклад", rotate: true, height: 185},
                    width: 74,
                    editor: 'text'
                },
                {
                    id: "vacation",
                    header: {text: "<div class='salary-cell'>Отпуск / больничный</div>", rotate: true, height: 185},
                    width: 74
                },
                {
                    id: "allowedSalary",
                    header: {text: "<div class='salary-cell'>Итого фактический оклад</div>", rotate: true, height: 185},
                    width: 74
                },
                {
                    id: "salesRevenue",
                    header: {text: "<div class='salary-cell'>Доход от продаж</div>", rotate: true, height: 185},
                    width: 94
                },
                {
                    id: "stage",
                    header: {
                        text: "<div class='salary-cell'>Достигнутый этап в виде цифры</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 57
                },
                {
                    id: "stagePercent",
                    header: {text: "<div class='salary-cell'>% за достигнутый этап</div>", rotate: true, height: 185},
                    width: 57
                },
                {
                    id: "salesPremiums",
                    header: {
                        text: "<div class='salary-cell'>Премии за продажи<br>(в рублях) факт</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74
                },
                {
                    id: "possiblePremiums",
                    header: {
                        text: "<div class='salary-cell'>Возможная премии за продажи (в рублях)</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74
                },
                {
                    id: "site_notification",
                    header: {
                        text: "<div class='salary-cell'>Уведомления по сайту (в рублях)</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74,
                    editor: 'text'
                },
                {
                    id: "update_site",
                    header: {text: "<div class='salary-cell'>Обновление сайта</div>", rotate: true, height: 185},
                    width: 74,
                    editor: 'text'
                },
                {
                    id: "transfer",
                    header: {text: "<div class='salary-cell'>Трансфер</div>", rotate: true, height: 185},
                    width: 74,
                    editor: 'text'
                },
                {
                    id: "ticket_insurance",
                    header: {
                        text: "<div class='salary-cell'>Акции: авиа-жд билеты + страховки</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74,
                    editor: 'text'
                },
                {
                    id: "coaching",
                    header: {text: "<div class='salary-cell'>Акция наставничество</div>", rotate: true, height: 185},
                    width: 74,
                    editor: 'text'
                },
                {
                    id: "birthday",
                    header: {text: "<div class='salary-cell'>День рождения</div>", rotate: true, height: 185},
                    width: 74,
                    editor: 'text'
                },
                {
                    id: "allowedShares",
                    header: {
                        text: "<div class='salary-cell'>Итого по акциям<br>(в рублях)</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74
                },
                {
                    id: "totalWages",
                    header: {
                        text: "<div class='salary-cell'><b>ВСЕГО</b> ЗП к выдаче сотруднику за месяц</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74
                },
                {
                    id: "possibleSalary",
                    header: {
                        text: "<div class='salary-cell'>ВСЕГО возможная ЗП оклад + премии<br>(без акций)</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74
                }
            ],
            autoheight: true,
            autowidth: true,
            editable: window.writingAccess,
            rowHeight: 40,
            data: table.salary,
            on: {
                onAfterEditStop: function (cell, coordinates) {

                    var record = dtable.getItem(coordinates.row);

                    var column = coordinates.column;
                    var value = cell.value;
                    var worker = coordinates.row;

                    var monthPeriod = $('#monthPeriod').val();

                    value = value.trim();

                    $.ajax({
                        type: "GET",
                        url: "/index.php?module=Accounting&view=List&mode=editSalary&value=" + value + "&column=" + column + "&worker=" + worker + "&date=" + monthPeriod,
                        success: function (data) {

                            var d = 6;

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

                                table.salary.forEach(function (item, i, arr) {
                                    if (item.id == coordinates.row) {
                                        item[coordinates.column] = cell.value.replace(/ /g, "");
                                        console.log(coordinates.column);
                                        console.log(item[coordinates.column]);
                                    }

                                });


                                var record = dtable.getItem(coordinates.row);

                                record['allowedShares'] = 0;

                                if (record['update_site']) {
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['update_site']);
                                }

                                if (record['transfer']) {
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['transfer']);
                                }

                                if (record['site_notification']) {
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['site_notification']);
                                }

                                if (record['ticket_insurance']) {
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['ticket_insurance']);
                                }

                                if (record['coaching']) {
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['coaching']);
                                }

                                if (record['birthday']) {
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['birthday']);
                                }

                                if (parseInt(record['base_salary']) >=0 && parseInt(record['stagePercent'])>=0) {
                                    record['salesPremiums'] = parseInt(record['base_salary']) * parseInt(record['stagePercent']) / 100;
                                } else {
                                    record['salesPremiums'] = '';
                                }

                                if (parseInt(record['base_salary']) >=0 && parseInt(record['maxPercent'])>=0) {
                                    record['possiblePremiums'] = parseInt(record['base_salary']) * parseInt(record['maxPercent']) / 100;
                                } else {
                                    record['possiblePremiums'] = '';
                                }

                                if (parseInt(record['base_salary']) >=0) {
                                    record['allowedSalary'] = parseInt(record['base_salary']) / countWorkingDays * parseInt(record['workingHoursDays']) / 8;
                                } else {
                                    record['allowedSalary'] = '';
                                }

                                if (parseInt(record['base_salary']) >=0) {
                                    record['vacation'] = parseInt(record['base_salary']) / countWorkingDays * 0.8 * parseInt(record['hospitalDays'])
                                        + parseInt(record['base_salary']) / countWorkingDays * parseInt(record['vacationDays']);
                                }

                                dtable.refresh();
                            }
                        },
                        dataType: "json"
                    });


                }
            },
            onClick: {
                "user": function (ev, id) {

                    $.ajax({
                        type: "GET",
                        url: "/index.php?module=Accounting&view=List&mode=getSales&date=" + window.date + "&worker=" + id,
                        success: function (data) {
                            var dataProvider = $.parseJSON(data);
                            webix.ui({
                                view: "window",
                                id: 'win3',
                                width: 600, height: 500,
                                top: 200, left: 300,

                                position: function (state) {
                                    state.top = 200;
                                },
                                zIndex: 99999,
                                modal: true,
                                head: {
                                    view: "toolbar", margin: -4, cols: [
                                        {view: "label", label: "Продажи. "+dataProvider.name },

                                        {
                                            view: "icon", icon: "times-circle",
                                            click: "$$('win3').close();"
                                        }
                                    ]
                                },
                                body: {
                                    view: "scrollview", body: {
                                        view: "datatable",
                                        columns: [
                                            {id: "id", header: "", css: "rank", width: 50, sort: "int"},
                                            {id: "date", header: "Дата", css: "rank", width: 150, sort: "int"},
                                            {id: "amount", header: "Доход", width: 150, sort: "string"}
                                        ],
                                        select: "row",
                                        autoheight: true,
                                        autowidth: true,
                                        data: dataProvider.table
                                    }
                                }
                            }).show();

                        }
                    })
                }
            }
        });

    });


});