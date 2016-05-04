/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global _, globals */

var sgdatatable = {};

(function (sgdatatable) {

    var caretRight = '<i class="fa fa-caret-right"></i>';
    var caretDown = '<i class="fa fa-caret-down"></i>';

    sgdatatable.initializeInlineFormTriggerEvents = function (inlineFormTemplateSelector) {

        var inlineFormTemplate = _.template($(inlineFormTemplateSelector).html());

        $(document.body).on('click', '.inline-form-trigger', function () {

            var id = $(this).data('id');

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).html(caretRight);

                $('#inline_form_' + id).remove();

            } else {
                $(this).addClass('active');
                $(this).html(caretDown);

                $(this).closest('tr').after(inlineFormTemplate({id: id}));
            }

        });

    };

    sgdatatable.generateInlineFormTrigger = function (id) {

        return '<span><a href="javascript:void(0)" class="inline-form-trigger" data-id="' + id + '">' + caretRight + '</a></span>';

    };

    sgdatatable.generateAccessInlineView = function (id, accessList, accessInlineTemplateSelector) {

        if (!accessInlineTemplateSelector) {
            accessInlineTemplateSelector = "#access_inline_template";
        }

        if (!globals.currentModule) {
            console.error('globals.currentModule is required for sg-datatables. In your blade view, use @include("partials.module_js_info") to include module information in the global context.');
            return;
        }

        var accessInlineTemplate = _.template($(accessInlineTemplateSelector).html());
        var viewHtml = "";

        for (var i in accessList) {
            viewHtml += accessInlineTemplate(adaptAccess(accessList[i], id));
        }

        return viewHtml;

    };

    function adaptAccess(access, id) {

        var accessName = access["access_name"].toLowerCase();

        if (access["is_get"] && accessName == "view") {
            access["href"] = globals.baseUrl + "/" + id;
        } else if (access["is_get"]) {
            access["href"] = globals.baseUrl + "/" + globals.currentModule.M_Trigger + "/" + id + "/" + accessName;
        } else {
            access["href"] = "javascript:void(0)";
        }

        access["id"] = id;

        return access;

    }

})(sgdatatable);