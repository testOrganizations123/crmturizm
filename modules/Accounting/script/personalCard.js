

var data = [
    {id:"1"},
    {id:"2"}

];



webix.ready(function () {
    grid = webix.ui({
        container: "personal-card",
        view: "datatable",
        columns: window.header,
        spans:true,
        autoheight: true,
        autowidth: true,
        data: {
            data:data,
            spans:[

                [1, "name",8 , 1, "Аналитика по эффективности финансовых показателей ", "header"]
            ]
        }

    });


});
