/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global _, globals */

var sgdatatable = {};

(function (sgdatatable) {

    sgdatatable.generateAccessInlineView = function (id, accessList, accessInlineTemplateSelector) {

        if (!accessInlineTemplateSelector) {
            accessInlineTemplateSelector = "#access_inline_template";
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
            access["href"] = globals.baseUrl + "/" + globals.currentModuleTrigger + "/" + id + "/" + accessName;
        } else {
            access["href"] = "javascript:void(0)";
        }

        access["id"] = id;

        return access;

    }

})(sgdatatable);