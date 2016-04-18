
/**
 * Functionalities that applies to the whole application are found here
 */

(function () {
    $(document).ready(function () {

        initializeTableEvents();

    });

    function initializeTableEvents() {
        $('.toggle-check').change(function () {
            $('input[type=checkbox].doc').prop('checked', this.checked);
        });
    }
})();

//  JQuery Extensions
jQuery.extend({
    put: function (url, data, callback) {
        return jQuery.ajax({
            url: url,
            type: 'PUT',
            data: data,
            success: callback
        });
    }
});  