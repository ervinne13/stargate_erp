
/* global _ */

(function () {

    var treetableRowTemplate;

    $(document).ready(function () {

        treetableRowTemplate = _.template($('#treetable_row_template').html());

        initializeEvents();
        loadTreeTable();

        $('#action-expand-all').css('display', 'inline');
        $('#action-collapse-all').css('display', 'none');

    });

    function loadTreeTable() {

        //  load tree table        
        $.ajax({
            url: location.href,
            contentType: "application/json",
            success: function (moduleTree) {
                console.log(moduleTree);
                displayTreeTable(moduleTree);
            }
        });

    }

    function displayTreeTable(moduleTree) {
        var tableHtml = makeModuleChildrenRows(moduleTree);
        $("#settings-table tbody").html(tableHtml);
        initializeTreeTable();
    }

    function makeModuleChildrenRows(moduleChildren) {
        var rowHtml = "";

        for (var i in moduleChildren) {
            rowHtml += treetableRowTemplate(moduleChildren[i]);
            if (moduleChildren[i]["M_Children"] && moduleChildren[i]["M_Children"].length > 0) {
                rowHtml += makeModuleChildrenRows(moduleChildren[i]["M_Children"]);
            }
        }

        return rowHtml;
    }

    function initializeTreeTable() {
        $("#settings-table").treetable({
            expandable: true,
            indent: 40,
            expanderTemplate: '<a class="btn btn-link fa fa-caret-right"></a>',
            onNodeCollapse: function () {
                $(this)[0].expander
                        .removeClass('fa-caret-down')
                        .addClass('fa-caret-right');
            },
            onNodeExpand: function () {
                $(this)[0].expander
                        .removeClass('fa-caret-right')
                        .addClass('fa-caret-down');
            },
            onInitialized: function () {
                $('.treetable tr[data-tt-parent-id]').each(function () {
                    if ($(this).find('td:eq(0) input[type="checkbox"]').prop('checked') == false) {
                        $('tr[data-tt-parent-id="' + $(this).data('tt-id') + '"]').find('input[data-module]').addClass('disabled').attr('disabled', true);
                        $('tr[data-tt-parent-id="' + $(this).data('tt-id') + '"] module-access-check-container').each(function () {
                            $(this).addClass('disabled').attr('disabled', true).find('input[type="checkbox"]').attr('disabled', true);
                        });
                    }
                    if ($(this).find('td:eq(0) input[type="checkbox"]').prop('checked') == false) {
                        $(this).find('.module-access-check-container').each(function () {
                            $(this).addClass('disabled').attr('disabled', true).find('input[type="checkbox"]').attr('disabled', true);
                        });
                    }
                });
            }
        });
    }

    function initializeEvents() {
        $('#action-expand-all').click(expandAll);
        $('#action-collapse-all').click(collapseAll);

        $(document).on('change', ".module-check", function () {
            recursiveCheckChild($(this));
        });

        $('#checkbox-check-all').click(function () {
            if ($(this).prop('checked') == true) {
                $("#settings-table input[type=checkbox]")
                        .prop("checked", true)
                        .removeAttr('disabled')
                        .closest('.checkbox')
                        .removeAttr('disabled')
                        .removeClass('disabled');
            } else {
                $("#settings-table input[type=checkbox]")
                        .prop("checked", false)
                        .closest('tr:not([data-tt-parent-id="0"])')
                        .find("input[type=checkbox]")
                        .attr('disabled', true)
                        .closest('.checkbox')
                        .attr('disabled', true)
                        .addClass('disabled');
            }
        });

    }

    function expandAll() {
        $('#action-expand-all').css('display', 'none');
        $('#action-collapse-all').css('display', 'inline');

        $("#settings-table").treetable("expandAll");
    }

    function collapseAll() {
        $('#action-expand-all').css('display', 'inline');
        $('#action-collapse-all').css('display', 'none');

        $("#settings-table").treetable("collapseAll");
    }

    function recursiveCheckChild(checkbox) {
        console.log(checkbox.prop('checked'));
        if ($('[data-tt-parent-id=' + checkbox.closest('tr').data('tt-id') + ']').length > 0) {
            $.each($('[data-tt-parent-id=' + checkbox.closest('tr').data('tt-id') + ']'), function () {
                if (checkbox.prop('checked') == false) {
                    checkbox.closest('tr').find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled', true).prop('checked', false);
                    checkbox.closest('tr').find('td:not(td:eq(0)) module-access-check-container').addClass('disabled').attr('disabled', true).prop('checked', false);
                    $(this).find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled', true).prop('checked', false);
                    $(this).find('td:not(td:eq(0)) module-access-check-container').addClass('disabled').attr('disabled', true).prop('checked', false);
                    $(this).find('.module-check').addClass('disabled').attr('disabled', true).prop('checked', false);
                } else {
                    checkbox.closest('tr').find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked', true);
                    checkbox.closest('tr').find('.module-access-check-container').removeClass('disabled').removeAttr('disabled').prop('checked', true);
                    $(this).find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked', true);
                    $(this).find('.module-access-check-container').removeClass('disabled').removeAttr('disabled');
                    $(this).find('.module-check').removeClass('disabled').removeAttr('disabled');
                }
                recursiveCheckChild($(this).find('.module-check'));
            });
        } else {
            if (checkbox.prop('checked') == false) {
                checkbox.closest('tr').find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled', true).prop('checked', false);
                checkbox.closest('tr').find('td:not(td:eq(0)) module-access-check-container').addClass('disabled').attr('disabled', true);
                $(this).find('td:not(td:eq(0)) module-access-check-container').addClass('disabled').attr('disabled', true);
                $(this).find('td:not(td:eq(0)) input[type="checkbox"]').addClass('disabled').attr('disabled', true).prop('checked', false);
                $(this).find('.module-check').addClass('disabled').attr('disabled', true).prop('checked', false);
            } else {
                checkbox.closest('tr').find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked', true);
                checkbox.closest('tr').find('.module-access-check-container').removeClass('disabled').removeAttr('disabled').prop('checked', true);
                $(this).find('input[type="checkbox"]').removeClass('disabled').removeAttr('disabled').prop('checked', true);
                $(this).find('.module-access-check-container').removeClass('disabled').removeAttr('disabled');
                $(this).find('.module-check').removeClass('disabled').removeAttr('disabled');
            }
        }
    }

})();