var chart = [];

var time = 1000;

function updateChartVacation(valueDate, column, worker, year) {

    var dateObj = new Date(valueDate);
    var month;
    if ((dateObj.getMonth() + 1) < 10) {
        month = "0" + (dateObj.getMonth() + 1);
    } else {
        month = dateObj.getMonth() + 1
    }
    var day;
    if (dateObj.getDate() < 10) {
        day = "0" + dateObj.getDate();
    } else {
        day = dateObj.getDate();
    }

    var date = dateObj.getFullYear() + '-' + month + '-' + day;

    $.each(chart, function (i, value) {

        $.each(value.dataProvider, function (key, item) {
            if (!chart[i].dataProvider[key].segments) {
                chart[i].dataProvider[key].segments = []

            }
            if (!chart[i].dataProvider[key].segments[0]) {
                chart[i].dataProvider[key].segments[0] = {

                    color: '#FF0000'
                }
            }

            if (!chart[i].dataProvider[key].segments[1]) {
                chart[i].dataProvider[key].segments[1] = {

                    color: '#FF0000'
                }
            }

            if (!chart[i].dataProvider[key].segments[2]) {
                chart[i].dataProvider[key].segments[2] = {

                    color: '#FF0000'
                }
            }

            if (!chart[i].dataProvider[key].segments[3]) {
                chart[i].dataProvider[key].segments[3] = {

                    color: '#FF0000'
                }
            }
            if (item.id == worker) {

                if (valueDate) {
                    if (column == 'start1') {
                        chart[i].dataProvider[key].segments[0].start = date;
                        if (!chart[i].dataProvider[key].segments[0].end) {

                            chart[i].dataProvider[key].segments[0].end = date;
                        }
                    } else if (column == 'finish1') {
                        chart[i].dataProvider[key].segments[0].end = date;
                        if (!chart[i].dataProvider[key].segments[0].start) {
                            chart[i].dataProvider[key].segments[0].start = date;
                        }
                    } else if (column == 'start2') {
                        chart[i].dataProvider[key].segments[1].start = date;
                        if (!chart[i].dataProvider[key].segments[1].end) {
                            chart[i].dataProvider[key].segments[1].end = date;
                        }
                    } else if (column == 'finish2') {
                        chart[i].dataProvider[key].segments[1].end = date;
                        if (!chart[i].dataProvider[key].segments[1].start) {
                            chart[i].dataProvider[key].segments[1].start = date;
                        }
                    } else if (column == 'start3') {
                        chart[i].dataProvider[key].segments[2].start = date;
                        if (!chart[i].dataProvider[key].segments[2].end) {
                            chart[i].dataProvider[key].segments[2].end = date;
                        }
                    } else if (column == 'finish3') {
                        chart[i].dataProvider[key].segments[2].end = date;
                        if (!chart[i].dataProvider[key].segments[2].start) {
                            chart[i].dataProvider[key].segments[2].start = date;
                        }
                    } else if (column == 'start4') {
                        chart[i].dataProvider[key].segments[3].start = date;
                        if (!chart[i].dataProvider[key].segments[3].end) {
                            chart[i].dataProvider[key].segments[3].end = date;
                        }
                    } else if (column == 'finish4') {
                        chart[i].dataProvider[key].segments[3].end = date;
                        if (!chart[i].dataProvider[key].segments[3].start) {
                            chart[i].dataProvider[key].segments[3].start = date;
                        }
                    }
                    chart[i].validateData();
                } else {

                    if (column == 'start1') {

                        if (chart[i].dataProvider[key].segments[0].end) {

                            chart[i].dataProvider[key].segments[0].start = chart[i].dataProvider[key].segments[0].end;
                        } else {
                            chart[i].dataProvider[key].segments[0] = {};
                        }
                    } else if (column == 'finish1') {

                        if (chart[i].dataProvider[key].segments[0].start) {
                            chart[i].dataProvider[key].segments[0].end = chart[i].dataProvider[key].segments[0].start;
                        } else {
                            chart[i].dataProvider[key].segments[0] = {};
                        }
                    } else if (column == 'start2') {
                        if (chart[i].dataProvider[key].segments[1].end) {

                            chart[i].dataProvider[key].segments[1].start = chart[i].dataProvider[key].segments[1].end;
                        } else {
                            chart[i].dataProvider[key].segments[1] = {};
                        }
                    } else if (column == 'finish2') {

                        if (chart[i].dataProvider[key].segments[1].start) {
                            chart[i].dataProvider[key].segments[1].end = chart[i].dataProvider[key].segments[1].start;
                        } else {
                            chart[i].dataProvider[key].segments[1] = {};
                        }
                    } else if (column == 'start3') {
                        if (chart[i].dataProvider[key].segments[2].end) {

                            chart[i].dataProvider[key].segments[2].start = chart[i].dataProvider[key].segments[2].end;
                        } else {
                            chart[i].dataProvider[key].segments[2] = {};
                        }
                    } else if (column == 'finish3') {

                        if (chart[i].dataProvider[key].segments[2].start) {
                            chart[i].dataProvider[key].segments[2].end = chart[i].dataProvider[key].segments[2].start;
                        } else {
                            chart[i].dataProvider[key].segments[2] = {};
                        }
                    } else if (column == 'start4') {
                        if (chart[i].dataProvider[key].segments[3].end) {

                            chart[i].dataProvider[key].segments[3].start = chart[i].dataProvider[key].segments[3].end;
                        } else {
                            chart[i].dataProvider[key].segments[3] = {};
                        }
                    } else if (column == 'finish4') {

                        if (chart[i].dataProvider[key].segments[3].start) {
                            chart[i].dataProvider[key].segments[3].end = chart[i].dataProvider[key].segments[3].start;
                        } else {
                            chart[i].dataProvider[key].segments[3] = {};
                        }
                    }
                    chart[i].validateData();


                }
            }
        })

    });


}

function updateChartVacationPromo(valueDate, column, worker, year) {

    var dateObj = new Date(valueDate);
    var month;
    if ((dateObj.getMonth() + 1) < 10) {
        month = "0" + (dateObj.getMonth() + 1);
    } else {
        month = dateObj.getMonth() + 1
    }
    var day;
    if (dateObj.getDate() < 10) {
        day = "0" + dateObj.getDate();
    } else {
        day = dateObj.getDate();
    }

    var date = dateObj.getFullYear() + '-' + month + '-' + day;

    $.each(chart, function (i, value) {

        $.each(value.dataProvider, function (key, item) {
            if (!chart[i].dataProvider[key].segments) {
                chart[i].dataProvider[key].segments = []

            }
            if (!chart[i].dataProvider[key].segments[4]) {
                chart[i].dataProvider[key].segments[4] = {

                    color: '#FFF000'
                }
            }

            if (!chart[i].dataProvider[key].segments[5]) {
                chart[i].dataProvider[key].segments[5] = {

                    color: '#FFF000'
                }
            }

            if (!chart[i].dataProvider[key].segments[6]) {
                chart[i].dataProvider[key].segments[6] = {

                    color: '#FFF000'
                }
            }

            if (!chart[i].dataProvider[key].segments[7]) {
                chart[i].dataProvider[key].segments[7] = {

                    color: '#FFF000'
                }
            }


            if (item.id == worker) {
                if (valueDate) {
                    if (column == 'start1') {
                        chart[i].dataProvider[key].segments[4].start = date;
                        if (!chart[i].dataProvider[key].segments[4].end) {

                            chart[i].dataProvider[key].segments[4].end = date;
                        }
                    } else if (column == 'finish1') {
                        chart[i].dataProvider[key].segments[4].end = date;
                        if (!chart[i].dataProvider[key].segments[4].start) {
                            chart[i].dataProvider[key].segments[4].start = date;
                        }
                    } else if (column == 'start2') {
                        chart[i].dataProvider[key].segments[5].start = date;
                        if (!chart[i].dataProvider[key].segments[5].end) {
                            chart[i].dataProvider[key].segments[5].end = date;
                        }
                    } else if (column == 'finish2') {
                        chart[i].dataProvider[key].segments[5].end = date;
                        if (!chart[i].dataProvider[key].segments[5].start) {
                            chart[i].dataProvider[key].segments[5].start = date;
                        }
                    } else if (column == 'start3') {
                        chart[i].dataProvider[key].segments[6].start = date;
                        if (!chart[i].dataProvider[key].segments[6].end) {
                            chart[i].dataProvider[key].segments[6].end = date;
                        }
                    } else if (column == 'finish3') {
                        chart[i].dataProvider[key].segments[6].end = date;
                        if (!chart[i].dataProvider[key].segments[6].start) {
                            chart[i].dataProvider[key].segments[6].start = date;
                        }
                    } else if (column == 'start4') {
                        chart[i].dataProvider[key].segments[7].start = date;
                        if (!chart[i].dataProvider[key].segments[7].end) {
                            chart[i].dataProvider[key].segments[7].end = date;
                        }
                    } else if (column == 'finish4') {
                        chart[i].dataProvider[key].segments[7].end = date;
                        if (!chart[i].dataProvider[key].segments[7].start) {
                            chart[i].dataProvider[key].segments[7].start = date;
                        }
                    }
                    chart[i].validateData();
                } else {

                    if (column == 'start1') {

                        if (chart[i].dataProvider[key].segments[4].end) {

                            chart[i].dataProvider[key].segments[4].start = chart[i].dataProvider[key].segments[4].end;
                        } else {
                            chart[i].dataProvider[key].segments[4] = {};
                        }
                    } else if (column == 'finish1') {

                        if (chart[i].dataProvider[key].segments[4].start) {
                            chart[i].dataProvider[key].segments[4].end = chart[i].dataProvider[key].segments[4].start;
                        } else {
                            chart[i].dataProvider[key].segments[4] = {};
                        }
                    } else if (column == 'start2') {
                        if (chart[i].dataProvider[key].segments[5].end) {

                            chart[i].dataProvider[key].segments[5].start = chart[i].dataProvider[key].segments[5].end;
                        } else {
                            chart[i].dataProvider[key].segments[5] = {};
                        }
                    } else if (column == 'finish2') {

                        if (chart[i].dataProvider[key].segments[5].start) {
                            chart[i].dataProvider[key].segments[5].end = chart[i].dataProvider[key].segments[5].start;
                        } else {
                            chart[i].dataProvider[key].segments[5] = {};
                        }
                    } else if (column == 'start3') {
                        if (chart[i].dataProvider[key].segments[6].end) {

                            chart[i].dataProvider[key].segments[6].start = chart[i].dataProvider[key].segments[6].end;
                        } else {
                            chart[i].dataProvider[key].segments[6] = {};
                        }
                    } else if (column == 'finish3') {

                        if (chart[i].dataProvider[key].segments[6].start) {
                            chart[i].dataProvider[key].segments[6].end = chart[i].dataProvider[key].segments[6].start;
                        } else {
                            chart[i].dataProvider[key].segments[6] = {};
                        }
                    } else if (column == 'start4') {
                        if (chart[i].dataProvider[key].segments[7].end) {

                            chart[i].dataProvider[key].segments[7].start = chart[i].dataProvider[key].segments[7].end;
                        } else {
                            chart[i].dataProvider[key].segments[7] = {};
                        }
                    } else if (column == 'finish4') {

                        if (chart[i].dataProvider[key].segments[7].start) {
                            chart[i].dataProvider[key].segments[7].end = chart[i].dataProvider[key].segments[7].start;
                        } else {
                            chart[i].dataProvider[key].segments[7] = {};
                        }
                    }
                    chart[i].validateData();


                }
            }
        })

    });


}

// function updateChartVacationSession(valueDate, column, worker, year) {
//
//     var dateObj = new Date(valueDate);
//     var month;
//     if ((dateObj.getMonth() + 1) < 10) {
//         month = "0" + (dateObj.getMonth() + 1);
//     } else {
//         month = dateObj.getMonth() + 1
//     }
//     var day;
//     if (dateObj.getDate() < 10) {
//         day = "0" + dateObj.getDate();
//     } else {
//         day = dateObj.getDate();
//     }
//
//     var date = dateObj.getFullYear() + '-' + month + '-' + day;
//
//     $.each(chart, function (i, value) {
//
//         $.each(value.dataProvider, function (key, item) {
//             if (!chart[i].dataProvider[key].segments) {
//                 chart[i].dataProvider[key].segments = []
//
//             }
//             if (!chart[i].dataProvider[key].segments[0]) {
//                 chart[i].dataProvider[key].segments[0] = {
//
//                     color: '#FF0000'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[1]) {
//                 chart[i].dataProvider[key].segments[1] = {
//
//                     color: '#FF0000'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[2]) {
//                 chart[i].dataProvider[key].segments[2] = {
//
//                     color: '#FF0000'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[3]) {
//                 chart[i].dataProvider[key].segments[3] = {
//
//                     color: '#FF0000'
//                 }
//             }
//
//
//             if (!chart[i].dataProvider[key].segments[4]) {
//                 chart[i].dataProvider[key].segments[4] = {
//
//                     color: '#FFF000'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[5]) {
//                 chart[i].dataProvider[key].segments[5] = {
//
//                     color: '#FFF000'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[6]) {
//                 chart[i].dataProvider[key].segments[6] = {
//
//                     color: '#FFF000'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[7]) {
//                 chart[i].dataProvider[key].segments[7] = {
//
//                     color: '#FFF000'
//                 }
//             }
//
//
//             if (!chart[i].dataProvider[key].segments[8]) {
//                 chart[i].dataProvider[key].segments[8] = {
//
//                     color: '#4744f6'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[9]) {
//                 chart[i].dataProvider[key].segments[9] = {
//
//                     color: '#4744f6'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[10]) {
//                 chart[i].dataProvider[key].segments[10] = {
//
//                     color: '#4744f6'
//                 }
//             }
//
//             if (!chart[i].dataProvider[key].segments[11]) {
//                 chart[i].dataProvider[key].segments[11] = {
//
//                     color: '#4744f6'
//                 }
//             }
//             if (item.id == worker) {
//                 if (valueDate) {
//                     if (column == 'start1') {
//                         chart[i].dataProvider[key].segments[8].start = date;
//                         if (!chart[i].dataProvider[key].segments[8].end) {
//
//                             chart[i].dataProvider[key].segments[8].end = date;
//                         }
//                     } else if (column == 'finish1') {
//                         chart[i].dataProvider[key].segments[8].end = date;
//                         if (!chart[i].dataProvider[key].segments[8].start) {
//                             chart[i].dataProvider[key].segments[8].start = date;
//                         }
//                     } else if (column == 'start2') {
//                         chart[i].dataProvider[key].segments[9].start = date;
//                         if (!chart[i].dataProvider[key].segments[9].end) {
//                             chart[i].dataProvider[key].segments[9].end = date;
//                         }
//                     } else if (column == 'finish2') {
//                         chart[i].dataProvider[key].segments[9].end = date;
//                         if (!chart[i].dataProvider[key].segments[9].start) {
//                             chart[i].dataProvider[key].segments[9].start = date;
//                         }
//                     } else if (column == 'start3') {
//                         chart[i].dataProvider[key].segments[10].start = date;
//                         if (!chart[i].dataProvider[key].segments[10].end) {
//                             chart[i].dataProvider[key].segments[10].end = date;
//                         }
//                     } else if (column == 'finish3') {
//                         chart[i].dataProvider[key].segments[10].end = date;
//                         if (!chart[i].dataProvider[key].segments[10].start) {
//                             chart[i].dataProvider[key].segments[10].start = date;
//                         }
//                     } else if (column == 'start4') {
//                         chart[i].dataProvider[key].segments[11].start = date;
//                         if (!chart[i].dataProvider[key].segments[11].end) {
//                             chart[i].dataProvider[key].segments[11].end = date;
//                         }
//                     } else if (column == 'finish4') {
//                         chart[i].dataProvider[key].segments[11].end = date;
//                         if (!chart[i].dataProvider[key].segments[11].start) {
//                             chart[i].dataProvider[key].segments[11].start = date;
//                         }
//                     }
//                     chart[i].validateData();
//                 }else {
//
//                     if (column == 'start1') {
//
//                         if (chart[i].dataProvider[key].segments[8].end) {
//
//                             chart[i].dataProvider[key].segments[8].start = chart[i].dataProvider[key].segments[8].end;
//                         } else {
//                             chart[i].dataProvider[key].segments[8] = {};
//                         }
//                     } else if (column == 'finish1') {
//
//                         if (chart[i].dataProvider[key].segments[8].start) {
//                             chart[i].dataProvider[key].segments[8].end = chart[i].dataProvider[key].segments[8].start;
//                         } else {
//                             chart[i].dataProvider[key].segments[8] = {};
//                         }
//                     } else if (column == 'start2') {
//                         if (chart[i].dataProvider[key].segments[9].end) {
//
//                             chart[i].dataProvider[key].segments[9].start = chart[i].dataProvider[key].segments[9].end;
//                         } else {
//                             chart[i].dataProvider[key].segments[9] = {};
//                         }
//                     } else if (column == 'finish2') {
//
//                         if (chart[i].dataProvider[key].segments[9].start) {
//                             chart[i].dataProvider[key].segments[9].end = chart[i].dataProvider[key].segments[9].start;
//                         } else {
//                             chart[i].dataProvider[key].segments[9] = {};
//                         }
//                     } else if (column == 'start3') {
//                         if (chart[i].dataProvider[key].segments[10].end) {
//
//                             chart[i].dataProvider[key].segments[10].start = chart[i].dataProvider[key].segments[10].end;
//                         } else {
//                             chart[i].dataProvider[key].segments[10] = {};
//                         }
//                     } else if (column == 'finish3') {
//
//                         if (chart[i].dataProvider[key].segments[10].start) {
//                             chart[i].dataProvider[key].segments[10].end = chart[i].dataProvider[key].segments[10].start;
//                         } else {
//                             chart[i].dataProvider[key].segments[10] = {};
//                         }
//                     } else if (column == 'start4') {
//                         if (chart[i].dataProvider[key].segments[11].end) {
//
//                             chart[i].dataProvider[key].segments[11].start = chart[i].dataProvider[key].segments[11].end;
//                         } else {
//                             chart[i].dataProvider[key].segments[11] = {};
//                         }
//                     } else if (column == 'finish4') {
//
//                         if (chart[i].dataProvider[key].segments[11].start) {
//                             chart[i].dataProvider[key].segments[11].end = chart[i].dataProvider[key].segments[11].start;
//                         } else {
//                             chart[i].dataProvider[key].segments[11] = {};
//                         }
//                     }
//                     chart[i].validateData();
//
//
//
//
//                 }
//             }
//         })
//
//     });
//
//
// }

function dateDiff(date1, date2) {
    return ((date2 - date1) / 86400000);
}

function changeCountWithoutHolidays(date1, date2) {

    var result = dateDiff(date1, date2) + 1;
    var holidayCount = 0;

    window.holidays.forEach(function (elem) {
        var holidayDay = new Date(elem.date);
        holidayDay.setHours(0);

        if (date1 <= holidayDay && holidayDay <= date2) {
            result = result - 1;
            holidayCount = holidayCount + 1;
        }

    });

    return {"day": result, "holidays": holidayCount};
}

function countDays(line) {

    var holidays = 0;

    if (line.start1 && line.finish1) {
        var date = this.changeCountWithoutHolidays(new Date(line.start1), new Date(line.finish1));
        line.duration1 = date.day;
        holidays = holidays + date.holidays;
    } else {
        line.duration1 = 0;
    }
    if (line.start2 && line.finish2) {
        date = this.changeCountWithoutHolidays(new Date(line.start2), new Date(line.finish2));
        line.duration2 = date.day;
        holidays = holidays + date.holidays;
    } else {
        line.duration2 = 0;
    }
    if (line.start3 && line.finish3) {
        date = this.changeCountWithoutHolidays(new Date(line.start3), new Date(line.finish3));
        line.duration3 = date.day;
        holidays = holidays + date.holidays;
    } else {
        line.duration3 = 0;
    }
    if (line.start4 && line.finish4) {
        date = this.changeCountWithoutHolidays(new Date(line.start4), new Date(line.finish4));
        line.duration4 = date.day;
        holidays = holidays + date.holidays;
    } else {
        line.duration4 = 0;
    }

    line.spent = parseInt(line.duration1) + parseInt(line.duration2) + parseInt(line.duration3) + parseInt(line.duration4);

    line.left = parseInt(line.allowed) - parseInt(line.spent);

    line.holidays = holidays;

    return line;
}

function parseDate(input, format) {
    format = format || 'yyyy-mm-dd'; // default format
    var parts = input.match(/(\d+)/g),
        i = 0, fmt = {};
    // extract date-part indexes from the format
    format.replace(/(yyyy|dd|mm)/g, function (part) {
        fmt[part] = i++;
    });

    return new Date(parts[fmt['yyyy']], parts[fmt['mm']] - 1, parts[fmt['dd']]);
}

function renderWebixVacation(i, show_date, show_editor, parse_editor) {

    
    var self = this;

    var table = window.offices[i];

        offices[i].vacation.forEach(function (vac, j, arr) {
            offices[i].vacation[j] = self.countDays(vac);
        });

        offices[i].promotionalTour.forEach(function (vac, j, arr) {
            offices[i].promotionalTour[j] = self.countDays(vac);
        });

        offices[i].vacationSession.forEach(function (vac, j, arr) {
            offices[i].vacationSession[j] = self.countDays(vac);
        });

        var dtable = new webix.ui({
            container: "tableVacation_" + i,
            view: "datatable",
            columns: [
                {id: "worker", header: "Сотрудник", width: 238},
                {id: "position", header: "Должность", width: 230},
                {
                    id: "start1",
                    header: [{
                        text: "1-я часть отпуска",
                        colspan: 3,
                        css: {"text-align": "center!important"}
                    }, "Начало"],
                    width: 90,
                    editor: "date",
                    format: show_date,
                    editFormat: show_editor,
                    editParse: parse_editor
                },
                {id: "duration1", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
                {
                    id: "finish1", header: ["", "Конец"], width: 90, editor: "date",
                    format: show_date, editFormat: show_editor, editParse: parse_editor
                },
                {
                    id: "start2",
                    header: [{
                        text: "2-я часть отпуска",
                        colspan: 3,
                        css: {"text-align": "center!important"}
                    }, "Начало"],
                    width: 90,
                    editor: "date",
                    format: show_date,
                    editFormat: show_editor,
                    editParse: parse_editor
                },
                {id: "duration2", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
                {
                    id: "finish2", header: ["", "Конец"], width: 90, editor: "date",
                    format: show_date, editFormat: show_editor, editParse: parse_editor
                },
                {
                    id: "start3",
                    header: [{
                        text: "3-я часть отпуска",
                        colspan: 3,
                        css: {"text-align": "center!important"}
                    }, "Начало"],
                    width: 90,
                    editor: "date",
                    format: show_date,
                    editFormat: show_editor,
                    editParse: parse_editor
                },
                {id: "duration3", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
                {
                    id: "finish3", header: ["", "Конец"], width: 90, editor: "date",
                    format: show_date, editFormat: show_editor, editParse: parse_editor
                },
                {
                    id: "start4",
                    header: [{
                        text: "4-я часть отпуска",
                        colspan: 3,
                        css: {"text-align": "center!important"}
                    }, "Начало"],
                    width: 90,
                    editor: "date",
                    format: show_date,
                    editFormat: show_editor,
                    editParse: parse_editor
                },
                {id: "duration4", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
                {
                    id: "finish4", header: ["", "Конец"], width: 90, editor: "date",
                    format: show_date, editFormat: show_editor, editParse: parse_editor
                },
                {id: "allowed", header: {text: "Положено", rotate: true}, width: 40, editor: "text"},
                {id: "spent", header: {text: "Потрачено", rotate: true}, width: 40},
                {id: "left", header: {text: "Осталось", rotate: true}, width: 40}
                //{id: "holidays", header: {text: "Праздники", rotate: true}, width: 40}
            ],
            autoheight: true,
            autowidth: true,
            editable: window.writingAccess,
            rowHeight: 40,
            data: table.vacation,
            on: {
                onAfterLoad: function() {
                    setTimeout(function () {
                        self.renderWebixPromo(i, show_date, show_editor, parse_editor);
                    }, 0);
                },
                onAfterEditStart: function () {
                    var elements = $('.webix_cal_footer');

                    var elem2 = elements.find('.webix_cal_icon');
                    elem2.click(function () {

                        setTimeout(function () {
                            $('#tableVacation_0').click();
                            setTimeout(function () {
                                $('#listViewContents').click();
                                setTimeout(function () {
                                    $('#listViewContents').click();
                                    setTimeout(function () {
                                        $('#listViewContents').click();
                                        setTimeout(function () {
                                            $('#listViewContents').click();
                                            setTimeout(function () {
                                                $('#listViewContents').click();
                                            }, 100);
                                        }, 100);
                                    }, 100);
                                }, 100);
                            }, 100);
                        }, 100);

                    });
                },
                onAfterEditStop: function (cell, coordinates) {


                    var record = dtable.getItem(coordinates.row);

                    var column = coordinates.column;
                    var value = cell.value;
                    var worker = coordinates.row;

                    if (column === "allowed") {
                        value = value.trim();

                        if (value === "") {
                            value = '0';
                            record[coordinates.column] = '0';
                        }
                    }

                    var year = $('#dateFilter').find('.webix_inp_static')[0].innerHTML;

                    $.ajax({
                        type: "GET",
                        url: "/index.php?module=Accounting&view=List&mode=editVacation&value=" + value + "&column=" + column + "&worker=" + worker + "&year=" + year,
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
                                table.vacation.forEach(function (item, i, arr) {
                                    if (item.id == coordinates.row) {

                                        if (coordinates.column != 'allowed') {


                                            if (cell.value.length == undefined) {
                                                val = $.datepicker.formatDate('yy-mm-dd 00:00:00', cell.value);

                                            } else if (cell.value.length == 0) {
                                                val = '';
                                            } else {
                                                val = cell.value.replace(/ /g, "");
                                                val = val.substr(0, val.length - 5) + " 00:00:00";
                                            }
                                        } else {
                                            val = cell.value.replace(/ /g, "");
                                        }

                                        item[coordinates.column] = val;
                                        table.vacation[i] = self.countDays(item);

                                    }
                                });

                                dtable.refresh();


                                updateChartVacation(value, column, worker, year);

                            }
                        },
                        dataType: "json"
                    });


                }
            }
        });

        // var dtableSession = new webix.ui({
        //     container: "tableVacationSession_" + i,
        //     view: "datatable",
        //     columns: [
        //         {id: "worker", header: "Сотрудник", width: 238},
        //         {id: "position", header: "Должность", width: 230},
        //         {
        //             id: "start1",
        //             header: [{text: "Период 1", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
        //             width: 90,
        //             editor: "date",
        //             format: show_date,
        //             editFormat: show_editor,
        //             editParse: parse_editor
        //         },
        //         {id: "duration1", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
        //         {
        //             id: "finish1", header: ["", "Конец"], width: 90, editor: "date",
        //             format: show_date, editFormat: show_editor, editParse: parse_editor
        //         },
        //         {
        //             id: "start2",
        //             header: [{text: "Период 2", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
        //             width: 90,
        //             editor: "date",
        //             format: show_date,
        //             editFormat: show_editor,
        //             editParse: parse_editor
        //         },
        //         {id: "duration2", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
        //         {
        //             id: "finish2", header: ["", "Конец"], width: 90, editor: "date",
        //             format: show_date, editFormat: show_editor, editParse: parse_editor
        //         },
        //         {
        //             id: "start3",
        //             header: [{text: "Период 3", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
        //             width: 90,
        //             editor: "date",
        //             format: show_date,
        //             editFormat: show_editor,
        //             editParse: parse_editor
        //         },
        //         {id: "duration3", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
        //         {
        //             id: "finish3", header: ["", "Конец"], width: 90, editor: "date",
        //             format: show_date, editFormat: show_editor, editParse: parse_editor
        //         },
        //         {
        //             id: "start4",
        //             header: [{text: "Период 4", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
        //             width: 90,
        //             editor: "date",
        //             format: show_date,
        //             editFormat: show_editor,
        //             editParse: parse_editor
        //         },
        //         {id: "duration4", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
        //         {
        //             id: "finish4", header: ["", "Конец"], width: 90, editor: "date",
        //             format: show_date, editFormat: show_editor, editParse: parse_editor
        //         },
        //         {id: "allowed", header: {text: "Положено", rotate: true}, editor: "text", width: 40},
        //         {id: "spent", header: {text: "Потрачено", rotate: true}, width: 40},
        //         {id: "left", header: {text: "Осталось", rotate: true}, width: 40},
        //         {id: "holidays", header: {text: "Праздники", rotate: true}, width: 40}
        //     ],
        //     autoheight: true,
        //     autowidth: true,
        //     editable: window.writingAccess,
        //     rowHeight: 40,
        //     data: table.vacationSession,
        //     on: {
        //         onAfterEditStart: function () {
        //             var elements = $('.webix_cal_footer');
        //
        //             var elem2 = elements.find('.webix_cal_icon');
        //             elem2.click(function () {
        //                 setTimeout(function () {
        //                     $('#tableVacation_0').click();
        //                     setTimeout(function () {
        //                         $('#listViewContents').click();
        //                         setTimeout(function () {
        //                             $('#listViewContents').click();
        //                             setTimeout(function () {
        //                                 $('#listViewContents').click();
        //                                 setTimeout(function () {
        //                                     $('#listViewContents').click();
        //                                     setTimeout(function () {
        //                                         $('#listViewContents').click();
        //                                     }, 100);
        //                                 }, 100);
        //                             }, 100);
        //                         }, 100);
        //                     }, 100);
        //                 }, 100);
        //             });
        //         },
        //         onAfterEditStop: function (cell, coordinates) {
        //
        //
        //             var record = dtableSession.getItem(coordinates.row);
        //
        //             var column = coordinates.column;
        //             var value = cell.value;
        //             var worker = coordinates.row;
        //
        //             if (column === "allowed") {
        //                 value = value.trim();
        //
        //                 if (value === "") {
        //                     value = '0';
        //                     record[coordinates.column] = '0';
        //                 }
        //             }
        //
        //             var year = $('#dateFilter').find('.webix_inp_static')[0].innerHTML;
        //
        //             $.ajax({
        //                 type: "GET",
        //                 url: "/index.php?module=Accounting&view=List&mode=editVacationSession&value=" + value + "&column=" + column + "&worker=" + worker + "&year=" + year,
        //                 success: function (data) {
        //
        //                     if (data != "success") {
        //                         record[coordinates.column] = cell.old;
        //                         dtableSession.refresh();
        //                         $(function () {
        //                             new PNotify({
        //                                 title: 'Ошибка валидации!',
        //                                 text: data,
        //                                 delay: 4000
        //                             });
        //
        //                         });
        //
        //                     } else {
        //                         table.vacationSession.forEach(function (item, i, arr) {
        //                             if (item.id == coordinates.row) {
        //
        //                                 if (coordinates.column != 'allowed') {
        //
        //                                     if (cell.value.length == undefined) {
        //                                         val = $.datepicker.formatDate('yy-mm-dd 00:00:00', cell.value);
        //                                     } else if (cell.value.length == 0) {
        //                                         val = '';
        //                                     } else {
        //                                         val = cell.value.replace(/ /g, "");
        //                                         val = val.substr(0, val.length - 5) + " 00:00:00";
        //                                     }
        //                                 } else {
        //                                     val = cell.value.replace(/ /g, "");
        //                                 }
        //
        //                                 item[coordinates.column] = val;
        //                                 table.vacationSession[i] = self.countDays(item);
        //
        //                             }
        //                         });
        //
        //                         dtableSession.refresh();
        //                         updateChartVacationSession(value, column, worker, year)
        //                     }
        //
        //
        //                 },
        //                 dataType: "json"
        //             });
        //
        //
        //         }
        //     }
        // });

}

function renderWebixPromo(i, show_date, show_editor, parse_editor) {

    var self = this;

    var table = window.offices[i];

    var dtablePromo = new webix.ui({
        container: "tableVacationPromo_" + i,
        view: "datatable",
        columns: [
            {id: "worker", header: "Сотрудник", width: 238},
            {id: "position", header: "Должность", width: 230},
            {
                id: "start1",
                header: [{text: "Рекламный тур 1", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
                width: 90,
                editor: "date",
                format: show_date,
                editFormat: show_editor,
                editParse: parse_editor
            },
            {id: "duration1", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
            {
                id: "finish1", header: ["", "Конец"], width: 90, editor: "date",
                format: show_date, editFormat: show_editor, editParse: parse_editor
            },
            {
                id: "start2",
                header: [{text: "Рекламный тур 2", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
                width: 90,
                editor: "date",
                format: show_date,
                editFormat: show_editor,
                editParse: parse_editor
            },
            {id: "duration2", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
            {
                id: "finish2", header: ["", "Конец"], width: 90, editor: "date",
                format: show_date, editFormat: show_editor, editParse: parse_editor
            },
            {
                id: "start3",
                header: [{text: "Рекламный тур 3", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
                width: 90,
                editor: "date",
                format: show_date,
                editFormat: show_editor,
                editParse: parse_editor
            },
            {id: "duration3", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
            {
                id: "finish3", header: ["", "Конец"], width: 90, editor: "date",
                format: show_date, editFormat: show_editor, editParse: parse_editor
            },
            {
                id: "start4",
                header: [{text: "Рекламный тур 4", colspan: 3, css: {"text-align": "center!important"}}, "Начало"],
                width: 90,
                editor: "date",
                format: show_date,
                editFormat: show_editor,
                editParse: parse_editor
            },
            {id: "duration4", header: ["", {text: "дней", rotate: true, height: 55}], width: 40},
            {
                id: "finish4", header: ["", "Конец"], width: 90, editor: "date",
                format: show_date, editFormat: show_editor, editParse: parse_editor
            },
            {id: "allowed", header: {text: "Положено", rotate: true}, editor: "text", width: 40},
            {id: "spent", header: {text: "Потрачено", rotate: true}, width: 40},
            {id: "left", header: {text: "Осталось", rotate: true}, width: 40},
            // {id: "holidays", header: {text: "Праздники", rotate: true}, width: 40}
        ],
        autoheight: true,
        autowidth: true,
        editable: window.writingAccess,
        rowHeight: 40,
        data: table.promotionalTour,
        on: {
            onAfterLoad: function() {
                self.loadChart(i, show_date, show_editor, parse_editor);
            },
            onAfterEditStart: function () {
                var elements = $('.webix_cal_footer');

                var elem2 = elements.find('.webix_cal_icon');
                elem2.click(function () {
                    setTimeout(function () {
                        $('#tableVacation_0').click();
                        setTimeout(function () {
                            $('#listViewContents').click();
                            setTimeout(function () {
                                $('#listViewContents').click();
                                setTimeout(function () {
                                    $('#listViewContents').click();
                                    setTimeout(function () {
                                        $('#listViewContents').click();
                                        setTimeout(function () {
                                            $('#listViewContents').click();
                                        }, 100);
                                    }, 100);
                                }, 100);
                            }, 100);
                        }, 100);
                    }, 100);
                });
            },
            onAfterEditStop: function (cell, coordinates) {


                var record = dtablePromo.getItem(coordinates.row);

                var column = coordinates.column;
                var value = cell.value;
                var worker = coordinates.row;

                if (column === "allowed") {
                    value = value.trim();

                    if (value === "") {
                        value = '0';
                        record[coordinates.column] = '0';
                    }
                }

                var year = $('#dateFilter').find('.webix_inp_static')[0].innerHTML;

                $.ajax({
                    type: "GET",
                    url: "/index.php?module=Accounting&view=List&mode=editVacationTour&value=" + value + "&column=" + column + "&worker=" + worker + "&year=" + year,
                    success: function (data) {

                        if (data != "success") {
                            record[coordinates.column] = cell.old;
                            dtablePromo.refresh();
                            $(function () {
                                new PNotify({
                                    title: 'Ошибка валидации!',
                                    text: data,
                                    delay: 4000
                                });

                            });

                        } else {
                            table.promotionalTour.forEach(function (item, i, arr) {
                                if (item.id == coordinates.row) {

                                    if (coordinates.column != 'allowed') {

                                        if (cell.value.length == undefined) {
                                            val = $.datepicker.formatDate('yy-mm-dd 00:00:00', cell.value);
                                        } else if (cell.value.length == 0) {
                                            val = '';
                                        } else {
                                            val = cell.value.replace(/ /g, "");
                                            val = val.substr(0, val.length - 5) + " 00:00:00";
                                        }
                                    } else {
                                        val = cell.value.replace(/ /g, "");
                                    }

                                    item[coordinates.column] = val;
                                    table.promotionalTour[i] = self.countDays(item);

                                }
                            });

                            dtablePromo.refresh();
                            updateChartVacationPromo(value, column, worker, year)
                        }


                    },
                    dataType: "json"
                });


            }
        }
    });
}

var arrDate = window.dateStart.split('.');
var i = arrDate.length;
var dateFilter = webix.ui({
    container: "dateFilter",
    view: "datepicker", align: "right", value: arrDate[i - 1], type: "year", format: "%Y"
});
$('#dateHidden').val($("#dateFilter").find('.webix_inp_static').html());
dateFilter.attachEvent("onChange", function (newv, oldv) {

    $('#dateHidden').val($("#dateFilter").find('.webix_inp_static').html());
});

var start = new Date(arrDate[i - 1], 0, 1);
var finish = new Date(arrDate[i - 1], 11, 31);


function loadChart(i, show_date, show_editor, parse_editor) {

    var value = window.offices[i];

        $.each(value.dataProvider, function (key, item) {
            if (item.segments) {
                $.each(item.segments, function (key1, item1) {
                    if ((item1.start && !item1.end)) {
                        value.dataProvider[key].segments[key1].end = item1.start
                    }
                    if ((!item1.start && item1.end)) {
                        value.dataProvider[key].segments[key1].start = item1.end
                    }
                })
            }
        });

        chart[i] = AmCharts.makeChart(value.officeId, {
            "type": "gantt",
            "theme": "light",
            "language": 'ru',
            "marginRight": 70,
            "period": "DD",
            "dataDateFormat": "YYYY-MM-DD",
            "columnWidth": 0.5,
            "valueAxis": {
                "type": "date",
                "minimumDate": start,
                "maximumDate": finish

            },
            "brightnessStep": 7,
            "graph": {
                "lineAlpha": 1,
                "lineColor": "#fff",
                "fillAlphas": 0.85
            },
            "rotate": true,
            "categoryField": "category",
            "segmentsField": "segments",
            "colorField": "color",

            "startDateField": "start",
            "endDateField": "end",

            "dataProvider": value.dataProvider,

            "chartCursor": {
                "cursorColor": "#55bb76",
                "valueBalloonsEnabled": false,
                "cursorAlpha": 0,
                "valueLineAlpha": 0.5,
                "valueLineBalloonEnabled": true,
                "valueLineEnabled": true,
                "zoomable": false,
                "valueZoomable": true
            },
            "legend": {
                "data": [{
                    "title": "Очередной отпуск",
                    "color": "#FF0000"
                }, {
                    "title": "Рекламные туры",
                    "color": "#FFFF00"
                }
                // ,
                //     {
                //         "title": "Отпуск в связи с обучением",
                //         "color": "#4744f6"
                //     }
                ]
            }
        });

    if (window.offices[i+1]) {
        self.renderWebixVacation(i+1, show_date, show_editor, parse_editor);
    } else {
        self.notify();
    }

}

webix.ready(function () {

    var self = this;

    var show_editor = webix.Date.dateToStr("%Y / %m / %d");
    var parse_editor = webix.Date.strToDate("%Y / %m / %d");
    //format in grid
    var show_date = webix.Date.dateToStr("%d.%m.%Y");

    this.renderWebixVacation(0, show_date, show_editor, parse_editor);

});


function in_array(what, where) {
    for (var i = 0; i < where.length; i++)
        if (what == where[i])
            return true;
    return false;
}

/* PNotify modules included in this custom build file:
 confirm
 */
/*
 PNotify 3.0.0 sciactive.com/pnotify/
 (C) 2015 Hunter Perrin; Google, Inc.
 license Apache-2.0
 */
/*
 * ====== PNotify ======
 *
 * http://sciactive.com/pnotify/
 *
 * Copyright 2009-2015 Hunter Perrin
 * Copyright 2015 Google, Inc.
 *
 * Licensed under Apache License, Version 2.0.
 * 	http://www.apache.org/licenses/LICENSE-2.0
 */
function notify() {
    (function (root, factory) {
        if (typeof define === 'function' && define.amd) {
            // AMD. Register as a module.
            define('pnotify', ['jquery'], function ($) {
                return factory($, root);
            });
        } else if (typeof exports === 'object' && typeof module !== 'undefined') {
            // CommonJS
            module.exports = factory(require('jquery'), global || root);
        } else {
            // Browser globals
            root.PNotify = factory(root.jQuery, root);
        }
    }(typeof window !== "undefined" ? window : this, function ($, root) {
        var init = function (root) {
            var default_stack = {
                dir1: "down",
                dir2: "left",
                push: "bottom",
                spacing1: 36,
                spacing2: 36,
                context: $("body"),
                modal: false
            };
            var posTimer, // Position all timer.
                body,
                jwindow = $(root);
            // Set global variables.
            var do_when_ready = function () {
                body = $("body");
                PNotify.prototype.options.stack.context = body;
                jwindow = $(root);
                // Reposition the notices when the window resizes.
                jwindow.bind('resize', function () {
                    if (posTimer) {
                        clearTimeout(posTimer);
                    }
                    posTimer = setTimeout(function () {
                        PNotify.positionAll(true);
                    }, 10);
                });
            };
            var createStackOverlay = function (stack) {
                var overlay = $("<div />", {"class": "ui-pnotify-modal-overlay"});
                overlay.prependTo(stack.context);
                if (stack.overlay_close) {
                    // Close the notices on overlay click.
                    overlay.click(function () {
                        PNotify.removeStack(stack);
                    });
                }
                return overlay;
            };
            var PNotify = function (options) {
                this.parseOptions(options);
                this.init();
            };
            $.extend(PNotify.prototype, {
                // The current version of PNotify.
                version: "3.0.0",

                // === Options ===

                // Options defaults.
                options: {
                    // The notice's title.
                    title: false,
                    // Whether to escape the content of the title. (Not allow HTML.)
                    title_escape: false,
                    // The notice's text.
                    text: false,
                    // Whether to escape the content of the text. (Not allow HTML.)
                    text_escape: false,
                    // What styling classes to use. (Can be either "brighttheme", "jqueryui", "bootstrap2", "bootstrap3", or "fontawesome".)
                    styling: "brighttheme",
                    // Additional classes to be added to the notice. (For custom styling.)
                    addclass: "",
                    // Class to be added to the notice for corner styling.
                    cornerclass: "",
                    // Display the notice when it is created.
                    auto_display: true,
                    // Width of the notice.
                    width: "300px",
                    // Minimum height of the notice. It will expand to fit content.
                    min_height: "16px",
                    // Type of the notice. "notice", "info", "success", or "error".
                    type: "notice",
                    // Set icon to true to use the default icon for the selected
                    // style/type, false for no icon, or a string for your own icon class.
                    icon: true,
                    // The animation to use when displaying and hiding the notice. "none"
                    // and "fade" are supported through CSS. Others are supported
                    // through the Animate module and Animate.css.
                    animation: "fade",
                    // Speed at which the notice animates in and out. "slow", "normal",
                    // or "fast". Respectively, 600ms, 400ms, 200ms.
                    animate_speed: "normal",
                    // Display a drop shadow.
                    shadow: true,
                    // After a delay, remove the notice.
                    hide: true,
                    // Delay in milliseconds before the notice is removed.
                    delay: 8000,
                    // Reset the hide timer if the mouse moves over the notice.
                    mouse_reset: true,
                    // Remove the notice's elements from the DOM after it is removed.
                    remove: true,
                    // Change new lines to br tags.
                    insert_brs: true,
                    // Whether to remove notices from the global array.
                    destroy: true,
                    // The stack on which the notices will be placed. Also controls the
                    // direction the notices stack.
                    stack: default_stack
                },

                // === Modules ===

                // This object holds all the PNotify modules. They are used to provide
                // additional functionality.
                modules: {},
                // This runs an event on all the modules.
                runModules: function (event, arg) {
                    var curArg;
                    for (var module in this.modules) {
                        curArg = ((typeof arg === "object" && module in arg) ? arg[module] : arg);
                        if (typeof this.modules[module][event] === 'function') {
                            this.modules[module].notice = this;
                            this.modules[module].options = typeof this.options[module] === 'object' ? this.options[module] : {};
                            this.modules[module][event](this, typeof this.options[module] === 'object' ? this.options[module] : {}, curArg);
                        }
                    }
                },

                // === Class Variables ===

                state: "initializing", // The state can be "initializing", "opening", "open", "closing", and "closed".
                timer: null, // Auto close timer.
                animTimer: null, // Animation timer.
                styles: null,
                elem: null,
                container: null,
                title_container: null,
                text_container: null,
                animating: false, // Stores what is currently being animated (in or out).
                timerHide: false, // Stores whether the notice was hidden by a timer.

                // === Events ===

                init: function () {
                    var that = this;

                    // First and foremost, we don't want our module objects all referencing the prototype.
                    this.modules = {};
                    $.extend(true, this.modules, PNotify.prototype.modules);

                    // Get our styling object.
                    if (typeof this.options.styling === "object") {
                        this.styles = this.options.styling;
                    } else {
                        this.styles = PNotify.styling[this.options.styling];
                    }

                    // Create our widget.
                    // Stop animation, reset the removal timer when the user mouses over.
                    this.elem = $("<div />", {
                        "class": "ui-pnotify " + this.options.addclass,
                        "css": {"display": "none"},
                        "aria-live": "assertive",
                        "aria-role": "alertdialog",
                        "mouseenter": function (e) {
                            if (that.options.mouse_reset && that.animating === "out") {
                                if (!that.timerHide) {
                                    return;
                                }
                                that.cancelRemove();
                            }
                            // Stop the close timer.
                            if (that.options.hide && that.options.mouse_reset) {
                                that.cancelRemove();
                            }
                        },
                        "mouseleave": function (e) {
                            // Start the close timer.
                            if (that.options.hide && that.options.mouse_reset && that.animating !== "out") {
                                that.queueRemove();
                            }
                            PNotify.positionAll();
                        }
                    });
                    // Maybe we need to fade in/out.
                    if (this.options.animation === "fade") {
                        this.elem.addClass("ui-pnotify-fade-" + this.options.animate_speed);
                    }
                    // Create a container for the notice contents.
                    this.container = $("<div />", {
                        "class": this.styles.container + " ui-pnotify-container " + (this.options.type === "error" ? this.styles.error : (this.options.type === "info" ? this.styles.info : (this.options.type === "success" ? this.styles.success : this.styles.notice))),
                        "role": "alert"
                    }).appendTo(this.elem);
                    if (this.options.cornerclass !== "") {
                        this.container.removeClass("ui-corner-all").addClass(this.options.cornerclass);
                    }
                    // Create a drop shadow.
                    if (this.options.shadow) {
                        this.container.addClass("ui-pnotify-shadow");
                    }


                    // Add the appropriate icon.
                    if (this.options.icon !== false) {
                        $("<div />", {"class": "ui-pnotify-icon"})
                            .append($("<span />", {"class": this.options.icon === true ? (this.options.type === "error" ? this.styles.error_icon : (this.options.type === "info" ? this.styles.info_icon : (this.options.type === "success" ? this.styles.success_icon : this.styles.notice_icon))) : this.options.icon}))
                            .prependTo(this.container);
                    }

                    // Add a title.
                    this.title_container = $("<h4 />", {
                        "class": "ui-pnotify-title"
                    })
                        .appendTo(this.container);
                    if (this.options.title === false) {
                        this.title_container.hide();
                    } else if (this.options.title_escape) {
                        this.title_container.text(this.options.title);
                    } else {
                        this.title_container.html(this.options.title);
                    }

                    // Add text.
                    this.text_container = $("<div />", {
                        "class": "ui-pnotify-text",
                        "aria-role": "alert"
                    })
                        .appendTo(this.container);
                    if (this.options.text === false) {
                        this.text_container.hide();
                    } else if (this.options.text_escape) {
                        this.text_container.text(this.options.text);
                    } else {
                        this.text_container.html(this.options.insert_brs ? String(this.options.text).replace(/\n/g, "<br />") : this.options.text);
                    }

                    // Set width and min height.
                    if (typeof this.options.width === "string") {
                        this.elem.css("width", this.options.width);
                    }
                    if (typeof this.options.min_height === "string") {
                        this.container.css("min-height", this.options.min_height);
                    }


                    // Add the notice to the notice array.
                    if (this.options.stack.push === "top") {
                        PNotify.notices = $.merge([this], PNotify.notices);
                    } else {
                        PNotify.notices = $.merge(PNotify.notices, [this]);
                    }
                    // Now position all the notices if they are to push to the top.
                    if (this.options.stack.push === "top") {
                        this.queuePosition(false, 1);
                    }


                    // Mark the stack so it won't animate the new notice.
                    this.options.stack.animation = false;

                    // Run the modules.
                    this.runModules('init');

                    // Display the notice.
                    if (this.options.auto_display) {
                        this.open();
                    }
                    return this;
                },

                // This function is for updating the notice.
                update: function (options) {
                    // Save old options.
                    var oldOpts = this.options;
                    // Then update to the new options.
                    this.parseOptions(oldOpts, options);
                    // Maybe we need to fade in/out.
                    this.elem.removeClass("ui-pnotify-fade-slow ui-pnotify-fade-normal ui-pnotify-fade-fast");
                    if (this.options.animation === "fade") {
                        this.elem.addClass("ui-pnotify-fade-" + this.options.animate_speed);
                    }
                    // Update the corner class.
                    if (this.options.cornerclass !== oldOpts.cornerclass) {
                        this.container.removeClass("ui-corner-all " + oldOpts.cornerclass).addClass(this.options.cornerclass);
                    }
                    // Update the shadow.
                    if (this.options.shadow !== oldOpts.shadow) {
                        if (this.options.shadow) {
                            this.container.addClass("ui-pnotify-shadow");
                        } else {
                            this.container.removeClass("ui-pnotify-shadow");
                        }
                    }
                    // Update the additional classes.
                    if (this.options.addclass === false) {
                        this.elem.removeClass(oldOpts.addclass);
                    } else if (this.options.addclass !== oldOpts.addclass) {
                        this.elem.removeClass(oldOpts.addclass).addClass(this.options.addclass);
                    }
                    // Update the title.
                    if (this.options.title === false) {
                        this.title_container.slideUp("fast");
                    } else if (this.options.title !== oldOpts.title) {
                        if (this.options.title_escape) {
                            this.title_container.text(this.options.title);
                        } else {
                            this.title_container.html(this.options.title);
                        }
                        if (oldOpts.title === false) {
                            this.title_container.slideDown(200);
                        }
                    }
                    // Update the text.
                    if (this.options.text === false) {
                        this.text_container.slideUp("fast");
                    } else if (this.options.text !== oldOpts.text) {
                        if (this.options.text_escape) {
                            this.text_container.text(this.options.text);
                        } else {
                            this.text_container.html(this.options.insert_brs ? String(this.options.text).replace(/\n/g, "<br />") : this.options.text);
                        }
                        if (oldOpts.text === false) {
                            this.text_container.slideDown(200);
                        }
                    }
                    // Change the notice type.
                    if (this.options.type !== oldOpts.type)
                        this.container.removeClass(
                            this.styles.error + " " + this.styles.notice + " " + this.styles.success + " " + this.styles.info
                        ).addClass(this.options.type === "error" ?
                            this.styles.error :
                            (this.options.type === "info" ?
                                    this.styles.info :
                                    (this.options.type === "success" ?
                                            this.styles.success :
                                            this.styles.notice
                                    )
                            )
                        );
                    if (this.options.icon !== oldOpts.icon || (this.options.icon === true && this.options.type !== oldOpts.type)) {
                        // Remove any old icon.
                        this.container.find("div.ui-pnotify-icon").remove();
                        if (this.options.icon !== false) {
                            // Build the new icon.
                            $("<div />", {"class": "ui-pnotify-icon"})
                                .append($("<span />", {"class": this.options.icon === true ? (this.options.type === "error" ? this.styles.error_icon : (this.options.type === "info" ? this.styles.info_icon : (this.options.type === "success" ? this.styles.success_icon : this.styles.notice_icon))) : this.options.icon}))
                                .prependTo(this.container);
                        }
                    }
                    // Update the width.
                    if (this.options.width !== oldOpts.width) {
                        this.elem.animate({width: this.options.width});
                    }
                    // Update the minimum height.
                    if (this.options.min_height !== oldOpts.min_height) {
                        this.container.animate({minHeight: this.options.min_height});
                    }
                    // Update the timed hiding.
                    if (!this.options.hide) {
                        this.cancelRemove();
                    } else if (!oldOpts.hide) {
                        this.queueRemove();
                    }
                    this.queuePosition(true);

                    // Run the modules.
                    this.runModules('update', oldOpts);
                    return this;
                },

                // Display the notice.
                open: function () {
                    this.state = "opening";
                    // Run the modules.
                    this.runModules('beforeOpen');

                    var that = this;
                    // If the notice is not in the DOM, append it.
                    if (!this.elem.parent().length) {
                        this.elem.appendTo(this.options.stack.context ? this.options.stack.context : body);
                    }
                    // Try to put it in the right position.
                    if (this.options.stack.push !== "top") {
                        this.position(true);
                    }
                    this.animateIn(function () {
                        that.queuePosition(true);

                        // Now set it to hide.
                        if (that.options.hide) {
                            that.queueRemove();
                        }

                        that.state = "open";

                        // Run the modules.
                        that.runModules('afterOpen');
                    });

                    return this;
                },

                // Remove the notice.
                remove: function (timer_hide) {
                    this.state = "closing";
                    this.timerHide = !!timer_hide; // Make sure it's a boolean.
                    // Run the modules.
                    this.runModules('beforeClose');

                    var that = this;
                    if (this.timer) {
                        root.clearTimeout(this.timer);
                        this.timer = null;
                    }
                    this.animateOut(function () {
                        that.state = "closed";
                        // Run the modules.
                        that.runModules('afterClose');
                        that.queuePosition(true);
                        // If we're supposed to remove the notice from the DOM, do it.
                        if (that.options.remove) {
                            that.elem.detach();
                        }
                        // Run the modules.
                        that.runModules('beforeDestroy');
                        // Remove object from PNotify.notices to prevent memory leak (issue #49)
                        // unless destroy is off
                        if (that.options.destroy) {
                            if (PNotify.notices !== null) {
                                var idx = $.inArray(that, PNotify.notices);
                                if (idx !== -1) {
                                    PNotify.notices.splice(idx, 1);
                                }
                            }
                        }
                        // Run the modules.
                        that.runModules('afterDestroy');
                    });

                    return this;
                },

                // === Class Methods ===

                // Get the DOM element.
                get: function () {
                    return this.elem;
                },

                // Put all the options in the right places.
                parseOptions: function (options, moreOptions) {
                    this.options = $.extend(true, {}, PNotify.prototype.options);
                    // This is the only thing that *should* be copied by reference.
                    this.options.stack = PNotify.prototype.options.stack;
                    var optArray = [options, moreOptions], curOpts;
                    for (var curIndex = 0; curIndex < optArray.length; curIndex++) {
                        curOpts = optArray[curIndex];
                        if (typeof curOpts === "undefined") {
                            break;
                        }
                        if (typeof curOpts !== 'object') {
                            this.options.text = curOpts;
                        } else {
                            for (var option in curOpts) {
                                if (this.modules[option]) {
                                    // Avoid overwriting module defaults.
                                    $.extend(true, this.options[option], curOpts[option]);
                                } else {
                                    this.options[option] = curOpts[option];
                                }
                            }
                        }
                    }
                },

                // Animate the notice in.
                animateIn: function (callback) {
                    // Declare that the notice is animating in.
                    this.animating = "in";
                    var that = this;
                    callback = (function () {
                        if (that.animTimer) {
                            clearTimeout(that.animTimer);
                        }
                        if (that.animating !== "in") {
                            return;
                        }
                        if (that.elem.is(":visible")) {
                            if (this) {
                                this.call();
                            }
                            // Declare that the notice has completed animating.
                            that.animating = false;
                        } else {
                            that.animTimer = setTimeout(callback, 40);
                        }
                    }).bind(callback);

                    if (this.options.animation === "fade") {
                        this.elem.one('webkitTransitionEnd mozTransitionEnd MSTransitionEnd oTransitionEnd transitionend', callback).addClass("ui-pnotify-in");
                        this.elem.css("opacity"); // This line is necessary for some reason. Some notices don't fade without it.
                        this.elem.addClass("ui-pnotify-fade-in");
                        // Just in case the event doesn't fire, call it after 650 ms.
                        this.animTimer = setTimeout(callback, 650);
                    } else {
                        this.elem.addClass("ui-pnotify-in");
                        callback();
                    }
                },

                // Animate the notice out.
                animateOut: function (callback) {
                    // Declare that the notice is animating out.
                    this.animating = "out";
                    var that = this;
                    callback = (function () {
                        if (that.animTimer) {
                            clearTimeout(that.animTimer);
                        }
                        if (that.animating !== "out") {
                            return;
                        }
                        if (that.elem.css("opacity") == "0" || !that.elem.is(":visible")) {
                            that.elem.removeClass("ui-pnotify-in");
                            if (this) {
                                this.call();
                            }
                            // Declare that the notice has completed animating.
                            that.animating = false;
                        } else {
                            // In case this was called before the notice finished animating.
                            that.animTimer = setTimeout(callback, 40);
                        }
                    }).bind(callback);

                    if (this.options.animation === "fade") {
                        this.elem.one('webkitTransitionEnd mozTransitionEnd MSTransitionEnd oTransitionEnd transitionend', callback).removeClass("ui-pnotify-fade-in");
                        // Just in case the event doesn't fire, call it after 650 ms.
                        this.animTimer = setTimeout(callback, 650);
                    } else {
                        this.elem.removeClass("ui-pnotify-in");
                        callback();
                    }
                },

                // Position the notice. dont_skip_hidden causes the notice to
                // position even if it's not visible.
                position: function (dontSkipHidden) {
                    // Get the notice's stack.
                    var stack = this.options.stack,
                        elem = this.elem;
                    if (typeof stack.context === "undefined") {
                        stack.context = body;
                    }
                    if (!stack) {
                        return;
                    }
                    if (typeof stack.nextpos1 !== "number") {
                        stack.nextpos1 = stack.firstpos1;
                    }
                    if (typeof stack.nextpos2 !== "number") {
                        stack.nextpos2 = stack.firstpos2;
                    }
                    if (typeof stack.addpos2 !== "number") {
                        stack.addpos2 = 0;
                    }
                    var hidden = !elem.hasClass("ui-pnotify-in");
                    // Skip this notice if it's not shown.
                    if (!hidden || dontSkipHidden) {
                        if (stack.modal) {
                            if (stack.overlay) {
                                stack.overlay.show();
                            } else {
                                stack.overlay = createStackOverlay(stack);
                            }
                        }
                        // Add animate class by default.
                        elem.addClass("ui-pnotify-move");
                        var curpos1, curpos2;
                        // Calculate the current pos1 value.
                        var csspos1;
                        switch (stack.dir1) {
                            case "down":
                                csspos1 = "top";
                                break;
                            case "up":
                                csspos1 = "bottom";
                                break;
                            case "left":
                                csspos1 = "right";
                                break;
                            case "right":
                                csspos1 = "left";
                                break;
                        }
                        curpos1 = parseInt(elem.css(csspos1).replace(/(?:\..*|[^0-9.])/g, ''));
                        if (isNaN(curpos1)) {
                            curpos1 = 0;
                        }
                        // Remember the first pos1, so the first visible notice goes there.
                        if (typeof stack.firstpos1 === "undefined" && !hidden) {
                            stack.firstpos1 = curpos1;
                            stack.nextpos1 = stack.firstpos1;
                        }
                        // Calculate the current pos2 value.
                        var csspos2;
                        switch (stack.dir2) {
                            case "down":
                                csspos2 = "top";
                                break;
                            case "up":
                                csspos2 = "bottom";
                                break;
                            case "left":
                                csspos2 = "right";
                                break;
                            case "right":
                                csspos2 = "left";
                                break;
                        }
                        curpos2 = parseInt(elem.css(csspos2).replace(/(?:\..*|[^0-9.])/g, ''));
                        if (isNaN(curpos2)) {
                            curpos2 = 0;
                        }
                        // Remember the first pos2, so the first visible notice goes there.
                        if (typeof stack.firstpos2 === "undefined" && !hidden) {
                            stack.firstpos2 = curpos2;
                            stack.nextpos2 = stack.firstpos2;
                        }
                        // Check that it's not beyond the viewport edge.
                        if (
                            (stack.dir1 === "down" && stack.nextpos1 + elem.height() > (stack.context.is(body) ? jwindow.height() : stack.context.prop('scrollHeight')) ) ||
                            (stack.dir1 === "up" && stack.nextpos1 + elem.height() > (stack.context.is(body) ? jwindow.height() : stack.context.prop('scrollHeight')) ) ||
                            (stack.dir1 === "left" && stack.nextpos1 + elem.width() > (stack.context.is(body) ? jwindow.width() : stack.context.prop('scrollWidth')) ) ||
                            (stack.dir1 === "right" && stack.nextpos1 + elem.width() > (stack.context.is(body) ? jwindow.width() : stack.context.prop('scrollWidth')) )
                        ) {
                            // If it is, it needs to go back to the first pos1, and over on pos2.
                            stack.nextpos1 = stack.firstpos1;
                            stack.nextpos2 += stack.addpos2 + (typeof stack.spacing2 === "undefined" ? 25 : stack.spacing2);
                            stack.addpos2 = 0;
                        }
                        if (typeof stack.nextpos2 === "number") {
                            if (!stack.animation) {
                                elem.removeClass("ui-pnotify-move");
                                elem.css(csspos2, stack.nextpos2 + "px");
                                elem.css(csspos2);
                                elem.addClass("ui-pnotify-move");
                            } else {
                                elem.css(csspos2, stack.nextpos2 + "px");
                            }
                        }
                        // Keep track of the widest/tallest notice in the column/row, so we can push the next column/row.
                        switch (stack.dir2) {
                            case "down":
                            case "up":
                                if (elem.outerHeight(true) > stack.addpos2) {
                                    stack.addpos2 = elem.height();
                                }
                                break;
                            case "left":
                            case "right":
                                if (elem.outerWidth(true) > stack.addpos2) {
                                    stack.addpos2 = elem.width();
                                }
                                break;
                        }
                        // Move the notice on dir1.
                        if (typeof stack.nextpos1 === "number") {
                            if (!stack.animation) {
                                elem.removeClass("ui-pnotify-move");
                                elem.css(csspos1, stack.nextpos1 + "px");
                                elem.css(csspos1);
                                elem.addClass("ui-pnotify-move");
                            } else {
                                elem.css(csspos1, stack.nextpos1 + "px");
                            }
                        }
                        // Calculate the next dir1 position.
                        switch (stack.dir1) {
                            case "down":
                            case "up":
                                stack.nextpos1 += elem.height() + (typeof stack.spacing1 === "undefined" ? 25 : stack.spacing1);
                                break;
                            case "left":
                            case "right":
                                stack.nextpos1 += elem.width() + (typeof stack.spacing1 === "undefined" ? 25 : stack.spacing1);
                                break;
                        }
                    }
                    return this;
                },
                // Queue the position all function so it doesn't run repeatedly and
                // use up resources.
                queuePosition: function (animate, milliseconds) {
                    if (posTimer) {
                        clearTimeout(posTimer);
                    }
                    if (!milliseconds) {
                        milliseconds = 10;
                    }
                    posTimer = setTimeout(function () {
                        PNotify.positionAll(animate);
                    }, milliseconds);
                    return this;
                },


                // Cancel any pending removal timer.
                cancelRemove: function () {
                    if (this.timer) {
                        root.clearTimeout(this.timer);
                    }
                    if (this.animTimer) {
                        root.clearTimeout(this.animTimer);
                    }
                    if (this.state === "closing") {
                        // If it's animating out, stop it.
                        this.state = "open";
                        this.animating = false;
                        this.elem.addClass("ui-pnotify-in");
                        if (this.options.animation === "fade") {
                            this.elem.addClass("ui-pnotify-fade-in");
                        }
                    }
                    return this;
                },
                // Queue a removal timer.
                queueRemove: function () {
                    var that = this;
                    // Cancel any current removal timer.
                    this.cancelRemove();
                    this.timer = root.setTimeout(function () {
                        that.remove(true);
                    }, (isNaN(this.options.delay) ? 0 : this.options.delay));
                    return this;
                }
            });
            // These functions affect all notices.
            $.extend(PNotify, {
                // This holds all the notices.
                notices: [],
                reload: init,
                removeAll: function () {
                    $.each(PNotify.notices, function () {
                        if (this.remove) {
                            this.remove(false);
                        }
                    });
                },
                removeStack: function (stack) {
                    $.each(PNotify.notices, function () {
                        if (this.remove && this.options.stack === stack) {
                            this.remove(false);
                        }
                    });
                },
                positionAll: function (animate) {
                    // This timer is used for queueing this function so it doesn't run
                    // repeatedly.
                    if (posTimer) {
                        clearTimeout(posTimer);
                    }
                    posTimer = null;
                    // Reset the next position data.
                    if (PNotify.notices && PNotify.notices.length) {
                        $.each(PNotify.notices, function () {
                            var s = this.options.stack;
                            if (!s) {
                                return;
                            }
                            if (s.overlay) {
                                s.overlay.hide();
                            }
                            s.nextpos1 = s.firstpos1;
                            s.nextpos2 = s.firstpos2;
                            s.addpos2 = 0;
                            s.animation = animate;
                        });
                        $.each(PNotify.notices, function () {
                            this.position();
                        });
                    } else {
                        var s = PNotify.prototype.options.stack;
                        if (s) {
                            delete s.nextpos1;
                            delete s.nextpos2;
                        }
                    }
                },
                styling: {
                    brighttheme: {
                        // Bright Theme doesn't require any UI libraries.
                        container: "brighttheme",
                        notice: "brighttheme-notice",
                        notice_icon: "brighttheme-icon-notice",
                        info: "brighttheme-info",
                        info_icon: "brighttheme-icon-info",
                        success: "brighttheme-success",
                        success_icon: "brighttheme-icon-success",
                        error: "brighttheme-error",
                        error_icon: "brighttheme-icon-error"
                    },
                    jqueryui: {
                        container: "ui-widget ui-widget-content ui-corner-all",
                        notice: "ui-state-highlight",
                        // (The actual jQUI notice icon looks terrible.)
                        notice_icon: "ui-icon ui-icon-info",
                        info: "",
                        info_icon: "ui-icon ui-icon-info",
                        success: "ui-state-default",
                        success_icon: "ui-icon ui-icon-circle-check",
                        error: "ui-state-error",
                        error_icon: "ui-icon ui-icon-alert"
                    },
                    bootstrap3: {
                        container: "alert",
                        notice: "alert-warning",
                        notice_icon: "glyphicon glyphicon-exclamation-sign",
                        info: "alert-info",
                        info_icon: "glyphicon glyphicon-info-sign",
                        success: "alert-success",
                        success_icon: "glyphicon glyphicon-ok-sign",
                        error: "alert-danger",
                        error_icon: "glyphicon glyphicon-warning-sign"
                    }
                }
            });
            /*
             * uses icons from http://fontawesome.io/
             * version 4.0.3
             */
            PNotify.styling.fontawesome = $.extend({}, PNotify.styling.bootstrap3);
            $.extend(PNotify.styling.fontawesome, {
                notice_icon: "fa fa-exclamation-circle",
                info_icon: "fa fa-info",
                success_icon: "fa fa-check",
                error_icon: "fa fa-warning"
            });

            if (root.document.body) {
                do_when_ready();
            } else {
                $(do_when_ready);
            }
            return PNotify;
        };
        return init(root);
    }));
// Confirm
    (function (root, factory) {
        if (typeof define === 'function' && define.amd) {
            // AMD. Register as a module.
            define('pnotify.confirm', ['jquery', 'pnotify'], factory);
        } else if (typeof exports === 'object' && typeof module !== 'undefined') {
            // CommonJS
            module.exports = factory(require('jquery'), require('./pnotify'));
        } else {
            // Browser globals
            factory(root.jQuery, root.PNotify);
        }
    }(typeof window !== "undefined" ? window : this, function ($, PNotify) {
        PNotify.prototype.options.confirm = {
            // Make a confirmation box.
            confirm: false,
            // Make a prompt.
            prompt: false,
            // Classes to add to the input element of the prompt.
            prompt_class: "",
            // The default value of the prompt.
            prompt_default: "",
            // Whether the prompt should accept multiple lines of text.
            prompt_multi_line: false,
            // Where to align the buttons. (right, center, left, justify)
            align: "right",
            // The buttons to display, and their callbacks.
            buttons: [
                {
                    text: "Ok",
                    addClass: "",
                    // Whether to trigger this button when the user hits enter in a single line prompt.
                    promptTrigger: true,
                    click: function (notice, value) {
                        notice.remove();
                        notice.get().trigger("pnotify.confirm", [notice, value]);
                    }
                },
                {
                    text: "Cancel",
                    addClass: "",
                    click: function (notice) {
                        notice.remove();
                        notice.get().trigger("pnotify.cancel", notice);
                    }
                }
            ]
        };
        PNotify.prototype.modules.confirm = {
            // The div that contains the buttons.
            container: null,
            // The input element of a prompt.
            prompt: null,

            init: function (notice, options) {
                this.container = $('<div class="ui-pnotify-action-bar" style="margin-top:5px;clear:both;" />').css('text-align', options.align).appendTo(notice.container);

                if (options.confirm || options.prompt)
                    this.makeDialog(notice, options);
                else
                    this.container.hide();
            },

            update: function (notice, options) {
                if (options.confirm) {
                    this.makeDialog(notice, options);
                    this.container.show();
                } else {
                    this.container.hide().empty();
                }
            },

            afterOpen: function (notice, options) {
                if (options.prompt)
                    this.prompt.focus();
            },

            makeDialog: function (notice, options) {
                var already = false, that = this, btn, elem;
                this.container.empty();
                if (options.prompt) {
                    this.prompt = $('<' + (options.prompt_multi_line ? 'textarea rows="5"' : 'input type="text"') + ' style="margin-bottom:5px;clear:both;" />')
                        .addClass((typeof notice.styles.input === "undefined" ? "" : notice.styles.input) + " " + (typeof options.prompt_class === "undefined" ? "" : options.prompt_class))
                        .val(options.prompt_default)
                        .appendTo(this.container);
                }
                var customButtons = (options.buttons[0] && options.buttons[0] !== PNotify.prototype.options.confirm.buttons[0]);
                for (var i = 0; i < options.buttons.length; i++) {
                    if (options.buttons[i] === null || (customButtons && PNotify.prototype.options.confirm.buttons[i] && PNotify.prototype.options.confirm.buttons[i] === options.buttons[i])) {
                        continue;
                    }
                    btn = options.buttons[i];
                    if (already)
                        this.container.append(' ');
                    else
                        already = true;
                    elem = $('<button type="button" class="ui-pnotify-action-button" />')
                        .addClass((typeof notice.styles.btn === "undefined" ? "" : notice.styles.btn) + " " + (typeof btn.addClass === "undefined" ? "" : btn.addClass))
                        .text(btn.text)
                        .appendTo(this.container)
                        .on("click", (function (btn) {
                            return function () {
                                if (typeof btn.click == "function") {
                                    btn.click(notice, options.prompt ? that.prompt.val() : null);
                                }
                            }
                        })(btn));
                    if (options.prompt && !options.prompt_multi_line && btn.promptTrigger)
                        this.prompt.keypress((function (elem) {
                            return function (e) {
                                if (e.keyCode == 13)
                                    elem.click();
                            }
                        })(elem));
                    if (notice.styles.text) {
                        elem.wrapInner('<span class="' + notice.styles.text + '"></span>');
                    }
                    if (notice.styles.btnhover) {
                        elem.hover((function (elem) {
                            return function () {
                                elem.addClass(notice.styles.btnhover);
                            }
                        })(elem), (function (elem) {
                            return function () {
                                elem.removeClass(notice.styles.btnhover);
                            }
                        })(elem));
                    }
                    if (notice.styles.btnactive) {
                        elem.on("mousedown", (function (elem) {
                            return function () {
                                elem.addClass(notice.styles.btnactive);
                            }
                        })(elem)).on("mouseup", (function (elem) {
                            return function () {
                                elem.removeClass(notice.styles.btnactive);
                            }
                        })(elem));
                    }
                    if (notice.styles.btnfocus) {
                        elem.on("focus", (function (elem) {
                            return function () {
                                elem.addClass(notice.styles.btnfocus);
                            }
                        })(elem)).on("blur", (function (elem) {
                            return function () {
                                elem.removeClass(notice.styles.btnfocus);
                            }
                        })(elem));
                    }
                }
            }
        };
        $.extend(PNotify.styling.jqueryui, {
            btn: "ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only",
            btnhover: "ui-state-hover",
            btnactive: "ui-state-active",
            btnfocus: "ui-state-focus",
            input: "",
            text: "ui-button-text"
        });
        $.extend(PNotify.styling.bootstrap2, {
            btn: "btn",
            input: ""
        });
        $.extend(PNotify.styling.bootstrap3, {
            btn: "btn btn-default",
            input: "form-control"
        });
        $.extend(PNotify.styling.fontawesome, {
            btn: "btn btn-default",
            input: "form-control"
        });
    }));

};