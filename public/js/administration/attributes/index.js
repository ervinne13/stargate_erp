
/* global sgdatatable, _, globals */

(function () {

    var moduleProcessor;
    var inlineCheckboxTemplate;
    var attributeCode;

    $(document).ready(function () {

        attributeCode = $('meta[name=module_id]').attr('content');
        inlineCheckboxTemplate = _.template($('#checkbox_inline_template').html());

        initializeDatatable();

        moduleProcessor = new ModuleProcessor([], globals.currentModule);
        moduleProcessor.initializeBatchFunctions();
    });

    function initializeDatatable() {
        $('#attributes-table').dataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "/administration/attributes/" + attributeCode + "/datatable",
                contentType: 'application/datatable'
            },
            order: [2, "desc"],
            columns: [
                {data: 'actions'},
                {data: 'checkbox'},
                {data: 'AD_Code'},
                {data: 'AD_Desc'},
                {data: 'AD_Active'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0, 1]},
                {orderable: false, targets: [0, 1]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        return sgdatatable.generateAccessInlineView(rowData.AD_Code, columnData);
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
                }
            ]
        });
    }

})();
