/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global sgdatatable, globals, _ */

(function () {

    var datatable;
    var moduleProcessor;
    var moduleListProcessor;
    var inlineCheckboxTemplate;

    $(document).ready(function () {

        inlineCheckboxTemplate = _.template($('#checkbox_inline_template').html());
        initializeDatatable();

        moduleProcessor = new ModuleProcessor([], globals.currentModule);

        moduleListProcessor = new ModuleListProcessor(datatable, globals.currentModule, moduleProcessor);
        moduleListProcessor.initializeActions();
        moduleListProcessor.initializeBatchFunctions();

    });

    function initializeDatatable() {
        datatable = $('#reasons-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "/administration/reason/datatable",
                contentType: 'application/datatable'
            },
            order: [2, "desc"],
            columns: [
                {data: 'actions'},
                {data: 'checkbox'},
                {data: 'R_Id'},
                {data: 'R_Description'},
                {data: 'R_Active'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0, 1]},
                {orderable: false, targets: [0, 1]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        return sgdatatable.generateAccessInlineView(rowData.R_Id, columnData);
                    }
                },
                {
                    targets: 1,
                    render: function (columnData, type, rowData, meta) {
                        return inlineCheckboxTemplate(rowData);
                    }
                },
                {
                    targets: 4,
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