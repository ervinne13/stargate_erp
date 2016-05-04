
/* global globals */

(function () {

    var moduleProcessor;

    $(document).ready(function () {

        moduleProcessor = new ModuleProcessor([], globals.currentModule);
        moduleProcessor.initializeActions();

        $('.select2').select2({dropdownCssClass: 'select2-wide-dropdown-600'});

    });

})();
