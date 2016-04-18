
/* global sgdatatable, globals */

(function () {

    var datatable;

    $(document).ready(function () {

        initializeDatatable();

        var moduleListProcessor = new ModuleListProcessor(datatable, globals.currentModule);
        moduleListProcessor.initializeActions();

    });

    function initializeDatatable() {
        datatable = $('#number-series-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "/administration/no-series/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'actions'},
                {data: 'NS_Id'},
                {data: 'NS_Description'},
                {data: 'M_Description'},
                {data: 'NS_Location'},
                {data: 'NS_StartNo'},
                {data: 'NS_EndingNo'},
                {data: 'NS_LastNoUsed'},
                {data: 'NS_LastDateUsed'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        return sgdatatable.generateAccessInlineView(rowData.id, columnData);
                    }
                }
            ]
        });
    }

})();
