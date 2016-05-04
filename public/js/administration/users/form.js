
/* global globals */

(function () {

    var locations;
    var locationMap = [];
    var moduleProcessor;

    $(document).ready(function () {

        moduleProcessor = new ModuleProcessor([], globals.currentModule);
        moduleProcessor.initialize();

        initializeData();
        initializeUI();
        initializeEvents();

    });

    function initializeData() {
        locations = JSON.parse($('meta[name=locations]').attr('content'));
        for (var i in locations) {
            locationMap[locations[i]["SP_StoreID"]] = locations[i]["SP_StoreName"];
        }
    }

    function initializeUI() {
        var locationIdList = $('.select2[name=U_Location_id_list\\[\\]]').val();
        $('.select2[name=U_Default_location]').prop('disabled', !(locationIdList && locationIdList.length > 0));
    }

    function initializeEvents() {
        $('.select2[name=U_Location_id_list\\[\\]]').on('change', function (e) {
            var locationIdList = $(this).val();
            displayDefaultLocationOptions(locationIdList);

            //  select2 height fix
//            var hgt = $(this).find(".select2-selection__rendered").scrollHeight + 5;
//            $('.select2-container--default .select2-selection--multiple').css('height', hgt + 'px');
//            console.log($(this).find(".select2-selection__rendered").scrollHeight);

        });

    }

    function displayDefaultLocationOptions(locationIdList) {
        if (locationIdList && locationIdList.length > 0) {
            var options = [];
            for (var i in locationIdList) {
                options.push({
                    id: locationIdList[i],
                    text: locationMap[locationIdList[i]]
                });
            }

            $('.select2[name=U_Default_location]').select2({
                data: options,
                value: locationIdList[0]
            });

            console.log(options);

            $('select[name=U_Default_location]').prop('disabled', false);
        } else {
            $('select[name=U_Default_location]').prop('disabled', true);
        }


    }

})();
