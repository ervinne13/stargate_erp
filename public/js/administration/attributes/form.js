/* global globals */

(function () {

    var moduleProcessor;

    $(document).ready(function () {

        moduleProcessor = new ModuleProcessor([], globals.currentModule);
        moduleProcessor.initialize();

    });

})();
