
/* global _, globals */

(function () {

    var currentModule = globals.currentModule;
    var moduleProcessor;

    var roleParentTemplate;

    $(document).ready(function () {

        roleParentTemplate = _.template($('#role_parent_template').html());

        moduleProcessor = new ModuleProcessor([], currentModule);
        moduleProcessor.initializeActions();

        initializeUI();
        initializeEvents();

    });

    function initializeUI() {
        $('.select2').select2();

        var type = $('.select2[name=P_Type]').val();
        if (!type) {
            $('.select2[name=P_Parent]').prop("disabled", true);
        }

    }

    function initializeEvents() {
        $('.select2[name=P_Type]').on('change', function (e) {
            var type = $(this).val();
            loadRoleParents(type);
        });
    }

    function loadRoleParents(selectedType) {

        var url = globals.baseUrl + "/" + currentModule.M_Trigger + "/type/" + selectedType;
        $.get(url, function (roles) {
            if (roles && roles.length > 0) {
                displayRoleParents(roles);
            }
        });

        $('.select2[name=P_Parent]').select2("val", "");
        $('.select2[name=P_Parent]').prop("disabled", true);

    }

    function displayRoleParents(roles) {

        var options = [];
        for (var i in roles) {
            options.push({
                id: roles[i].P_Position_id,
                text: roles[i].P_Position
            });
        }

        console.log(options);

//        var url = globals.baseUrl + "/" + currentModule.M_Trigger + "/type/" + selectedType;

        $('.select2[name=P_Parent]').select2({
//            ajax: {
//                url: url,
//                cache: true
//            },
            data: options,
//            templateSelection: function (role) {
//                console.log(role);                
//                return role.P_Position;
//            }
        });

        $('.select2[name=P_Parent]').prop("disabled", false);
    }

})();
