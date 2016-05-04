/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global sgdatatable, globals, _ */

(function () {

    var inlineCheckboxTemplate;

    var datatable;
    var moduleProcessor;
    var moduleListProcessor;

    $(document).ready(function () {

        initializeTemplates();
        initializeDatatable();

        moduleProcessor = new ModuleProcessor([], globals.currentModule);

        moduleListProcessor = new ModuleListProcessor(datatable, globals.currentModule, moduleProcessor);
        moduleListProcessor.initializeActions();
        moduleListProcessor.initializeBatchFunctions();

        sgdatatable.initializeInlineFormTriggerEvents('#user_form_template');

    });

    function initializeTemplates() {
        inlineCheckboxTemplate = _.template($('#checkbox_inline_template').html());
    }

    function initializeDatatable() {
        datatable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "/test/ift/datatable",
                contentType: 'application/datatable'
            },
            order: [2, "desc"],
            columns: [
                {data: 'inline_form_trigger'},
                {data: 'actions'},
                {data: 'checkbox'},
                {data: 'U_User_id'},
                {data: 'U_Username'},
                {data: 'position.P_Position'},
                {data: 'U_Status'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0, 1, 2, 4]},
                {orderable: false, targets: [0, 1, 2]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        return sgdatatable.generateInlineFormTrigger(rowData.id);
                    }
                },
                {
                    targets: 1,
                    render: function (columnData, type, rowData, meta) {
                        return sgdatatable.generateAccessInlineView(rowData.id, columnData);
                    }
                },
                {
                    targets: 2,
                    render: function (columnData, type, rowData, meta) {
                        return inlineCheckboxTemplate(rowData);
                    }
                },
                {
                    targets: 6,
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