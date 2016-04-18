
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
function ModuleListProcessor(datatableInstance, module) {

    console.log(datatableInstance);

    this.module = module;
    this.datatableInstance = datatableInstance;

    this.csrfToken = $('meta[name=_token]').attr('content');

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

})();