/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global sgdatatable */

(function () {

    var inlineCheckboxTemplate;

    $(document).ready(function () {

        initializeTemplates();
        initializeDatatable();

    });

    function initializeTemplates() {
        inlineCheckboxTemplate = _.template($('#checkbox_inline_template').html());
    }

    function initializeDatatable() {
        $('#users-table').dataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "/administration/users/datatable",
                contentType: 'application/datatable'
            },
            order: [2, "desc"],
            columns: [
                {data: 'actions'},
                {data: 'checkbox'},
                {data: 'U_User_id'},
                {data: 'U_Username'},
                {data: 'position.P_Position'},
                {data: 'U_Status'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0, 1, 4]},
                {orderable: false, targets: [0, 1]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        return sgdatatable.generateAccessInlineView(rowData.id, columnData);
                    }
                },
                {
                    targets: 1,
                    render: function (columnData, type, rowData, meta) {
                        return inlineCheckboxTemplate(rowData);
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        if (data == 1) {
                            return "Active";
                        } else {
                            return "Inactive";
                        }
                    }
                },
            ]
        });
    }

})();