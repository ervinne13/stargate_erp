
/* global bootbox */

var globals = {};

$(document).ready(function () {
    globals.baseUrl = $('meta[name=base_url]').attr('content');
    globals.currentModuleTrigger = $('meta[name=module_trigger]').attr('content');
});

globals.bootboxConfirm = function (options) {
    bootbox.dialog({
        message: options.message ? options.message : "Confirm?",
        title: options.title ? options.title : "Confirm",
        buttons: {
            success: {
                label: "Success!",
                className: "btn-success",
                callback: function () {
                    Example.show("great success");
                }
            },
            main: {
                label: "Click ME!",
                className: "btn-primary",
                callback: function () {
                    Example.show("Primary button");
                }
            }
        }
    });
};