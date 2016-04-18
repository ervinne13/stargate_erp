
(function () {

    $(document).ready(function () {
        initializeDatatable();
    });
    function initializeDatatable() {
        $('#modules-table').dataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: false
            },
            ajax: {
                url: "/administration/modules/datatable",
                contentType: 'application/datatable'
            },
            columns: [
                {data: 'M_Module_id'},
                {data: 'M_Description'},
                {data: 'user_access'},
                {data: 'module_function'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [2, 3]},
                {
                    targets: 2,
                    render: function (columnData, type, rowData, meta) {

                        var aggregatedAccess = "";
                        if (columnData && columnData.map) {
                            aggregatedAccess = columnData.map(function (access) {
                                console.log(access["UA_AccessName"]);
                                return access["UA_AccessName"];
                            }).join(',');
                        }

                        return aggregatedAccess;
                    }
                },
                {
                    targets: 3,
                    render: function (columnData, type, rowData, meta) {
                        var aggregatedFunctions = "";
                        if (columnData && columnData.map) {
                            aggregatedFunctions = columnData.map(function (moduleFunction) {
                                return moduleFunction["F_FunctionName"];
                            }).join(',');
                        }

                        return aggregatedFunctions;
                    }
                }
            ]
        });
    }

})();
