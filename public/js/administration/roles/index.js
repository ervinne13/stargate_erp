
/* global sgdatatable, globals */

(function () {

    var datatable;

    $(document).ready(function () {

        initializeDatatable();

        var moduleListProcessor = new ModuleListProcessor(datatable, globals.currentModule);
        moduleListProcessor.initializeActions();

    });

    function initializeDatatable() {
        datatable = $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "/administration/position/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'actions'},
                {data: 'P_Position_id'},
                {data: 'P_Position'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        return sgdatatable.generateAccessInlineView(rowData.P_Position_id, columnData);
                    }
                }
            ]
        });
    }

})();
