





webix.ready(function () {
    grid = webix.ui({
        container: "personal-card",
        view: "datatable",
        columns: window.header,
        spans:true,
        autoheight: true,
        autowidth: true,
        data: window.data1

    });


});

webix.ready(function () {
    grid = webix.ui({
        container: "personal-card2",
        view: "datatable",
        columns: window.header,
        spans:true,
        autoheight: true,
        autowidth: true,
        data: window.data1

    });


});