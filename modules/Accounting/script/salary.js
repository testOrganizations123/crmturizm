webix.ready(function () {

    window.offices.forEach(function (table, i, arr) {

        table.salary.forEach(function (item, i, arr) {

            item['allowedShares'] = 0;

            if (item['update_site']){
                item['allowedShares'] = item['allowedShares'] + parseInt(item['update_site']);
            }

            if (item['transfer']) {
                item['allowedShares'] = item['allowedShares'] + parseInt(item['transfer']);
            }

            if (item['site_notification']){
                item['allowedShares'] = item['allowedShares'] + parseInt( item['site_notification']);
            }

            if (item['ticket_insurance']){
                item['allowedShares'] = item['allowedShares'] + parseInt( item['ticket_insurance']);
            }

            if (item['coaching']){
                item['allowedShares'] = item['allowedShares'] + parseInt( item['coaching']);
            }

            if (item['birthday']){
                item['allowedShares'] = item['allowedShares'] + parseInt( item['birthday']);
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
                    width: 74
                },
                {
                    id: "stage",
                    header: {
                        text: "<div class='salary-cell'>Достигнутый этап в виде цифры</div>",
                        rotate: true,
                        height: 185
                    },
                    width: 74
                },
                {
                    id: "stagePercent",
                    header: {text: "<div class='salary-cell'>% за достигнутый этап</div>", rotate: true, height: 185},
                    width: 74
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
            editable: true,
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

                                if (record['update_site']){
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['update_site']);
                                }

                                if (record['transfer']) {
                                    record['allowedShares'] = record['allowedShares'] + parseInt(record['transfer']);
                                }

                                if (record['site_notification']){
                                    record['allowedShares'] = record['allowedShares'] + parseInt( record['site_notification']);
                                }

                                if (record['ticket_insurance']){
                                    record['allowedShares'] = record['allowedShares'] + parseInt( record['ticket_insurance']);
                                }

                                if (record['coaching']){
                                    record['allowedShares'] = record['allowedShares'] + parseInt( record['coaching']);
                                }

                                if (record['birthday']){
                                    record['allowedShares'] = record['allowedShares'] + parseInt( record['birthday']);
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


                    webix.ui({
                        view:"window",
                        id:'win3',
                        width: 600, height:500,
                        top:150, left: 300,
                        position: 'absolute',
                        zIndex: 99999,
                        modal:true,
                        head:{
                            view:"toolbar", margin:-4, cols:[
                                {view:"label", label: "Продажи. Иванов И.И." },

                                { view:"icon", icon:"times-circle",
                                    click:"$$('win3').close();"}
                            ]
                        },
                        body:{
                            view:"datatable",
                            columns:[
                                { id:"rank",	header:"", css:"rank",  		width:50,	sort:"int"},
                                { id:"title",	header:"Film title",width:200,	sort:"string"},
                                { id:"year",	header:"Released" , width:80,	sort:"int"},
                                { id:"votes",	header:"Votes", 	width:100,	sort:"int"}
                            ],
                            select:"row",
                            autoheight:true,
                            autowidth:true,
                            data:""
                        }
                    }).show();

                }
            }
        });

    });


});