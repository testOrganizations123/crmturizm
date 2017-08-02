webix.ready(function () {
    grid = webix.ui({
        container: "employees",
        view: "datatable",
        columns: [
            {id: "name", header: ["Сотрудник", {content: "selectFilter"}], width: 300, sort: "string"},
            {id: "region", header: ["Регион", {content: "selectFilter"}], width: 300, sort: "string"},
            {id: "office", header: ["Офис", {content: "selectFilter"}], width: 300, sort: "string"},
            {id: "position", header: ["Должность", {content: "selectFilter"}], width: 300, sort: "string"}
        ],
        hover: "myhover",
        on: {

            "onItemClick": function (id, e, trg) {

                var url = "/index.php?module=Accounting&view=List&mode=personalCard&id="+id.row;
                $(location).attr('href',url);
            }
        },
        autoheight: true,
        autowidth: true,
        data: window.users
    });


});
