/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var sgdatatable = {
    ACTIONS_COLUMN: "sg_actions"
};

(function (sgdatatable) {

    sgdatatable.datatable = function (config) {

        if (!config) {
            console.err("please define config");
            return;
        }

        var actionsTemplate;

        if (config.actionColumn && config.templateSelector) {
            actionsTemplate = _.template($(config.templateSelector).html());
        }

        $('#users-table').dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: config.url,
                contentType: 'application/datatable'
            },
            columns: [
                {data: 'U_User_id'},
                {data: 'U_User_id'},
                {data: 'U_Username'},
                {data: 'P_Position'}
            ],
            columnDefs: [
                {
                    render: function (data, type, row) {
                        return actionsTemplate({id: data});
                    },
                    targets: [0],
                    orderable: false,
                    searchable: false
                }
            ]
        });

    };

})(sgdatatable);