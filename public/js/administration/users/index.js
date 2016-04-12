/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global sgdatatable */

(function () {

    var actionsTemplate;

    $(document).ready(function () {
        actionsTemplate = _.template($("#actions_template").html());
        initializeDatatable();
    });

    function initializeDatatable() {
        $('#users-table').dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/administration/users",
                contentType: 'application/datatable'
            },
            columns: [
                {data: 'U_User_id'},
                {data: 'U_User_id'},
                {data: 'U_Username'},
                {data: 'position.P_Position'}
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
    }

})();