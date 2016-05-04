
/* global bootbox, globals, datatableInstance */

/**
 * 
 * @param {type} datatableInstance
 * The datatable instance.
 * IMPORTANT make sure this is not the jquery instance made from .dataTable({...
 * Use .DataTable({..., otherwise, the events will fire off a "Cannot read property 'reload' of undefined"
 * error
 * @param {type} module
 * The current module object. Get it with blade using @include("partials.module_js_info")
 * @returns {ModuleListProcessor}
 */
function ModuleListProcessor(datatableInstance, module, moduleProcessor) {

    console.log(datatableInstance);

    this.module = module;
    this.datatableInstance = datatableInstance;
    this.moduleProcessor = moduleProcessor; //  required for batch functions

    this.csrfToken = $('meta[name=_token]').attr('content');

    //  for batch functions
    this.checkboxSelector = ".doc:checked";
    this.setActiveFunction = "active";
    this.setInactiveFunction = "inactive";

}

(function () {

    ModuleListProcessor.prototype.initializeActions = function () {

        var moduleDescription = this.module.M_Description;
        var moduleTrigger = this.module.M_Trigger;
        var datatableInstance = this.datatableInstance;
        var csrfToken = this.csrfToken;

        $(document).on('click', '.Delete', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            bootbox.confirm({
                title: "You are about to delete an entry",
                message: "Delete " + moduleDescription + "?",
                callback: function (confirmed) {
                    if (confirmed) {
                        $.ajax({
                            url: globals.baseUrl + "/" + moduleTrigger + "/" + id,
                            type: 'POST',
                            data: {_method: 'delete', _token: csrfToken},
                            success: function (response) {
                                console.log(response);

                                datatableInstance.ajax.reload();
                            }
                        });
                    }
                }
            });

        });
    };

    ModuleListProcessor.prototype.initializeBatchFunctions = function () {

        var instance = this;

        $('[data-trigger="activate"]').click(function (e) {
            e.preventDefault();
            instance.batchSetActive(true);
        });

        $('[data-trigger="deactivate"]').click(function (e) {
            e.preventDefault();
            instance.batchSetActive(false);
        });
    };

    ModuleListProcessor.prototype.batchSetActive = function (active) {

        //  get all selected records
        var documentIdList = [];
        var formData = new FormData();
        var datatableInstance = this.datatableInstance;

        $(this.checkboxSelector).each(function () {
            documentIdList.push($(this).attr('id'));
        });

        if (documentIdList.length <= 0) {
            bootbox.alert({
                title: "Validation",
                message: "Please select documents to process"
            });
            return;
        }

        console.log(documentIdList);

        formData.append("idList", documentIdList);

        var action = active ? this.setActiveFunction : this.setInactiveFunction;

        this.moduleProcessor.sendAction(action, '', formData, function (response) {
            console.log(response);
//            window.location.reload();
            datatableInstance.ajax.reload();
            $('.toggle-check').attr('checked', false);
        });

    };

})();