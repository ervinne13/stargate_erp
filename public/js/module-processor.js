
/* global globals, bootbox */

/**
 * @class ModuleProcessor
 * @param {Object} configs 
 *  The configuration of the module header. 
 * @description 
 *  Abstracts out the functionality of processing saving and updating header records of a module.
 *  IMPORTANT! This class is dependent on certain DOM elements as specified in the configuration or by 
 *  default, only call it's custructor when the document/DOM is ready, otherwise, events and ui 
 *  modifications will not apply!
 * 
 */
function ModuleProcessor(configs, module) {

    if (!configs) {
        configs = {};   //  avoid undefined exceptions
    }

    this.form = configs.form ? configs.form : '#' + module.M_Module_id + "-form";
    this.detailTable = configs.detailTable ? configs.detailTable : null;
    this.moduleURL = configs.moduleURL ? configs.moduleURL : globals.baseUrl + "/" + module.M_Trigger;
    this.createModuleURL = configs.newEntryURL ? configs.newEntryURL : globals.baseUrl + "/" + module.M_Trigger + "/create";
    this.processURL = configs.processURL ? configs.processURL : this.moduleURL + '/process';

    this.saveNewButton = configs.saveNewButton ? configs.saveNewButton : "action-save-new";
    this.saveCloseButton = configs.saveCloseButton ? configs.saveCloseButton : "action-save-close";
    this.updateNewButton = configs.updateNewButton ? configs.updateNewButton : "action-update-new";
    this.updateCloseButton = configs.updateCloseButton ? configs.updateCloseButton : "action-update-close";
    this.closeButton = configs.closeButton ? configs.closeButton : "action-close";


    //  make sure that the default action buttons have an action-button class
    $('#' + this.saveNewButton).addClass('action-button');
    $('#' + this.saveCloseButton).addClass('action-button');
    $('#' + this.updateNewButton).addClass('action-button');
    $('#' + this.updateCloseButton).addClass('action-button');
    $('#' + this.closeButton).addClass('action-button');

}

(function () {

    //
    //  <editor-fold defaultstate="collapsed" desc="Public UI Utility Functions">      
    ModuleProcessor.prototype.enableActionButtons = function (enable) {
        if (enable) {
            $('.action-button').removeAttr('disabled');
        } else {
            $('.action-button').attr('disabled', 'disabled');
        }
    };

    ModuleProcessor.prototype.showErrors = function (show, errors) {

        if (show) {
            for (var key in errors) {
                if ($('[name=' + key + ']').length) {
                    $('.' + key + '-form-group').addClass('has-error');
                    $('.' + key + '-error-container').removeAttr('hidden');
                    $('.' + key + '-error').text(errors[key][0]);
                }
            }
        } else {
            $('.error-container').attr('hidden');
            $('.form-group').removeClass('has-error');
        }

    };

    ModuleProcessor.prototype.showErrorMessage = function (show, message) {

        if (show) {
            $(this.errorMessageContainer).css("display", "block");
            $(this.errorMessageText).html(message);
        } else {
            $(this.errorMessageContainer).css("display", "none");
            $(this.errorMessageText).html("");
        }

    };

    ModuleProcessor.prototype.switchToUpdateMode = function (uniqueId) {
        $('#' + this.saveNewButton).attr({'disabled': false, 'id': this.updateNewButton});
        $('#' + this.saveCloseButton).attr({'disabled': false, 'id': this.updateCloseButton});
        $('#' + this.updateNewButton).attr('data-id', uniqueId);
        $('#' + this.updateCloseButton).attr('data-id', uniqueId);

        this.initializeActions();
    };

    ModuleProcessor.prototype.redirectBack = function () {
        var _this = this;
        setTimeout(function () {
            window.location = _this.moduleURL;
        }, 1000);
    };

    //  </editor-fold>

    ModuleProcessor.prototype.loadNumberSeries = function (numberSeriesFieldSelector, onNumberSeriesLoaded) {
        alert('to be implemented');
    };

    //  Facade function, initializeUI + initializeActions
    ModuleProcessor.prototype.initialize = function () {
        this.initializeUI();
        this.initializeActions();
    };

    ModuleProcessor.prototype.initializeUI = function () {
        $('.select2').select2();
    };

    ModuleProcessor.prototype.initializeActions = function () {

        //  context reference
        var _this = this;

        $('#' + this.saveNewButton).unbind('click');
        $('#' + this.saveNewButton).click(function () {
            bootbox.confirm({
                title: "Confirm",
                message: "Save Entry?",
                callback: function (confirmed) {
                    if (confirmed) {
                        _this.enableActionButtons(false);
                        _this.processStore(function () {
                            location.href = _this.createModuleURL;
                        });
                    }
                }
            });
        });

        $('#' + this.saveCloseButton).unbind('click');
        $('#' + this.saveCloseButton).click(function () {
            bootbox.confirm({
                title: "Confirm",
                message: "Save Entry?",
                callback: function (confirmed) {
                    if (confirmed) {
                        _this.enableActionButtons(false);
                        _this.processStore(function () {
                            location.href = _this.moduleURL;
                        });
                    }
                }
            });
        });

        $('#' + this.updateNewButton).unbind('click');
        $('#' + this.updateNewButton).click(function () {
            var uniqueId = $(this).data('id');
            bootbox.confirm({
                title: "Confirm",
                message: "Update Entry?",
                callback: function (confirmed) {
                    if (confirmed) {
                        _this.enableActionButtons(false);
                        _this.processUpdate(uniqueId, function () {
                            location.href = _this.createModuleURL;
                        });
                    }
                }
            });
        });

        $('#' + this.updateCloseButton).unbind('click');
        $('#' + this.updateCloseButton).click(function () {
            var uniqueId = $(this).data('id');
            bootbox.confirm({
                title: "Confirm",
                message: "Update Entry?",
                callback: function (confirmed) {
                    if (confirmed) {
                        _this.enableActionButtons(false);
                        _this.processUpdate(uniqueId, function () {
                            location.href = _this.moduleURL;
                        });
                    }
                }
            });
        });

        $('#' + this.closeButton).unbind('click');
        $('#' + this.closeButton).click(function () {
            location.href = _this.moduleURL;
        });

    };

    ModuleProcessor.prototype.processStore = function (onFinishCallback) {
        var formData = this.processFormData();
        this.sendAction('store', null, formData, onFinishCallback);
    };

    ModuleProcessor.prototype.processUpdate = function (uniqueId, onFinishCallback) {
        var formData = this.processFormData();
        this.sendAction('update', uniqueId, formData, onFinishCallback);
    };

    ModuleProcessor.prototype.getCSRF = function () {
        return $(this.form).find('[name=_token]').val();
    };

    ModuleProcessor.prototype.sendAction = function (action, id, formData, onFinishCallback) {
        var _this = this;
        var url;

        if (action === 'update') {
            url = _this.moduleURL + "/" + id;
            formData.append("_method", "PUT");
        } else if (action === 'store') {
            url = _this.moduleURL;
        }

        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': _this.getCSRF()
            },
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.result == 0) {
                    if (data.errors) {
//                        error_message(data.errors);
                        bootbox.alert({
                            title: "Error(s)",
                            message: data.errors
                        });
                    }

                    if (_this.detailTable && data.batch_save_errors) {
                        _this.showBatchSaveErrors(data.batch_save_errors);
                    }
                } else {
                    if (onFinishCallback) {
                        onFinishCallback(data);
                    }
                }
                _this.enableActionButtons(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);

                if (jqXHR.responseJSON) {
                    _this.showErrors(true, jqXHR.responseJSON);
                } else if (jqXHR.responseText) {
                    _this.showErrorMessage(true, jqXHR.responseText);
                } else {
                    alert('Error!');
                }

                _this.enableActionButtons(true);
            }
        });

        this.enableActionButtons(false);
        this.showErrors(false);
        this.showErrorMessage(false);
    };

    ModuleProcessor.prototype.processFormData = function (additionalFormData) {
        var form = $(this.form);
        var data = form.serializeArray();
        var formData = new FormData();

//        console.log(data);

        if (!additionalFormData) {
            additionalFormData = {};    //  avoid undefined exceptions
        }

        for (var key in additionalFormData) {
            formData.append(key, additionalFormData[key]);
        }

        $('.attachment').each(function () {
            if ($(this)[0].files.length > 0) {
                formData.append('file[]', $(this)[0].files[0]);
            }
        });

        $(form).find('input[type=checkbox]').each(function () {
            data.push({name: this.name, value: this.checked ? 1 : 0});
        });

        if (this.detailTable) {
            data.push({
                name: "details",
                value: this.processDetailsData(this.detailTable.getSourceData())
            });
        }

        $.each(data, function (key, input) {
            if (input.value && input.value.length <= 0) {
                input.value = null;
            }
            formData.append(input.name, input.value);
        });

        return formData;
    };

})();