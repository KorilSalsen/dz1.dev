'use strict';
function addPlaceholder() {
    if ($.fn.placeholder) {
        $('input, textarea').placeholder();
    }
}

function fileLoaderModule() {
    var fileUploads = $(".input__upload"),
        picTypes = ['.jpg', '.jpeg', '.png', '.bmp'];

    function _eventListener() {
        fileUploads.on('change', _fileUploadFix);
    }

    function _fileUploadFix(e) {
        var fileApi = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false,
            fileName,
            thisUploadWrapper = $(e.target).closest('.input_popup'),
            fileUploadInput = thisUploadWrapper.find('.input__upload'),
            fakeFileUploadInput = thisUploadWrapper.find('.input__fake-upload');

        if (fileApi && fileUploadInput[0].files[0]) {
            fileName = fileUploadInput[0].files[0].name;
        } else {
            fileName = fileUploadInput.val().replace("C:\\fakepath\\", '');
        }

        if (!fileName.length) return;

        var fileType = fileName.slice(fileName.lastIndexOf('.'));

        if ($.inArray(fileType, picTypes) === -1) {
            fakeFileUploadInput.val('');
            validateModule().validateInput(fakeFileUploadInput);
        } else {
            fakeFileUploadInput.val(fileName);
            validateModule().validateInput(fakeFileUploadInput);
        }
    }

    return {
        'init': function () {
            _eventListener();
        }
    };
}

function popupModule() {
    var popups = $('.popup'),
        popupButtons = $('.popup-button'),
        serverMessageClose = popups.find('.server-message__close'),
        time = 300;

    function _eventListener() {
        popupButtons.on('click', _popupSwitcher.show);
        popups.on('click', _popupSwitcher.hide);
        serverMessageClose.on('click', _hideServerMessage);
    }

    function _hideServerMessage(e) {
        e.preventDefault ? e.preventDefault() : (e.returnValue = false);

        var thisClose = $(this);

        thisClose.closest('.server-message')
            .hide()
            .end()
            .closest('.content-block__container_popup')
            .attr('style', '');
    }

    var _popupSwitcher = {
        'show': function (e) {
            e.preventDefault ? e.preventDefault() : (e.returnValue = false);

            var popupName = $(this).data('popup-name');

            popups.filter('[data-popup-name="' + popupName + '"]').fadeIn(time, function () {
                addPlaceholder();
            });
        },
        'hide': function (e) {
            var $this = $(e.target),
                thisPopup = $(this),
                form = thisPopup.find('form'),
                serverMessageBlock = form.siblings('.server-message'),
                popupContainer = serverMessageBlock.closest('.content-block__container_popup');

            if ($this.hasClass('popup') || $this.hasClass('popup__close')) {
                e.preventDefault ? e.preventDefault() : (e.returnValue = false);

                thisPopup.fadeOut(time, function () {
                    serverMessageBlock.attr('style', '')
                        .removeClass('server-message_ok server-message_error')
                        .hide()
                        .siblings()
                        .show();
                    popupContainer.attr('style', '');

                    if (form.length) {
                        var inputs = form.find('.input__text'),
                            tooltips = form.find('.tooltip');

                        form.each(function (i) {
                            form.eq(i)[0].reset();
                        });

                        inputs.removeClass('input__text_no-valid');
                        tooltips.hide();
                    }
                });
            }
        }
    };

    return {
        'init': function () {
            _eventListener();
        }
    };
}

function validateModule() {
    var forms = $('form'),
        time = 300;

    function _eventListener() {
        forms.on('submit', _validator);
        forms.on('reset', _cleanForm);
    }

    function _cleanForm(e) {
        var thisForm = $(e.target).closest('form'),
            inputs = thisForm.find('.input__text'),
            tooltips = thisForm.find('.tooltip');

        inputs.removeClass('input__text_no-valid');
        tooltips.hide();
    }

    var _validateSwitcher = {
        noValid: function (input) {
            input.addClass('input__text_no-valid')
                .siblings('.tooltip').fadeIn(time);
        },
        valid: function (input) {
            input.removeClass('input__text_no-valid')
                .siblings('.tooltip').fadeOut(time);
        }
    };

    function _validateInput(input) {
        var type = input.attr('type'),
            tooltipText = input.data('tooltip'),
            tooltipPosition = input.data('tooltip-position'),
            inputWrapper = $('<div></div>', {
                'class': 'input-tooltip-wrapper'
            }),
            tooltipBlock = $('<div></div>', {
                'class': 'tooltip',
                'text': tooltipText
            });

        if (!input.siblings('.tooltip').length) {
            input.wrap(inputWrapper)
                .after(tooltipBlock);
        } else {
            tooltipBlock = input.siblings('.tooltip');
        }

        if (tooltipPosition === 'right') {
            tooltipBlock.css({
                right: -tooltipBlock.width() - 17
            }).addClass('tooltip_right');
        } else {
            tooltipBlock.css({
                left: -tooltipBlock.width() - 17
            });
        }

        if (type !== 'file' && !input.hasClass('input__fake-upload')) {
            input.on('focus', function (e) {
                var thisInput = $(e.target);

                if (thisInput.hasClass('input__text_no-valid')) {
                    thisInput.on('keydown', function () {
                        _validateSwitcher.valid(thisInput);
                    });
                }
            });
        }

        if (!input.val()) {
            _validateSwitcher.noValid(input);
        } else {
            _validateSwitcher.valid(input)
        }
    }

    function _validator(e) {
        e.preventDefault ? e.preventDefault() : (e.returnValue = false);

        var thisForm = $(this),
            inputs = thisForm.find('.input__text');

        inputs.each(function (i) {
            var input = inputs.eq(i);

            _validateInput(input);
        });

        if (!thisForm.find('.input__text_no-valid').length) {
            if (thisForm.hasClass('popup-form')) {
                ajaxModule().addWork(thisForm);
            } else if (thisForm.hasClass('login-form')) {
                ajaxModule().login(thisForm);
            }
        }
    }

    return {
        'init': function () {
            _eventListener();
        },
        'validateInput': _validateInput
    };
}

function ajaxModule() {
    return {
        'addWork': function (form) {
            if (window.FormData) {
                var formData = new FormData(form[0]),
                    serverMessageBlock = form.siblings('.server-message'),
                    serverMessageTitle = serverMessageBlock.find('.server-message__title'),
                    serverMessageText = serverMessageBlock.find('.server-message__text'),
                    serverMessageClose = serverMessageBlock.find('.server-message__close'),
                    popupContainer = serverMessageBlock.closest('.content-block__container_popup');

                var messageLoader = {
                    'ok': function (data) {
                        serverMessageTitle.text(data.title);
                        serverMessageText.text(data.message);
                        serverMessageBlock
                            .show()
                            .addClass('server-message_ok')
                            .siblings()
                            .not('.popup__close')
                            .hide();
                        serverMessageClose.hide();
                        popupContainer.css({
                            'top': (window.innerHeight - popupContainer.height()) / 2,
                            'margin-top': 0
                        });
                    },
                    'error': function (data) {
                        serverMessageTitle.text(data.title);
                        serverMessageText.text(data.message);
                        serverMessageBlock
                            .show()
                            .addClass('server-message_error');
                        serverMessageClose.show();
                        popupContainer.css({
                            'top': '-=' + serverMessageBlock.outerHeight(true)
                        });
                    }
                };

                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "php/add-work.php",
                    data: formData
                }).done(function (data) {
                    var status = data.status;

                    popupContainer.attr('style', '');

                    if (status === 'ok') {
                        messageLoader.ok(data);
                    } else if (status === 'error') {
                        messageLoader.error(data);
                    }
                }).error(function () {
                    var data = {
                        'title': 'Ошибка!',
                        'message': 'Невозможно добавить проект.'
                    };

                    messageLoader.error(data);
                });
            }
        },
        'login': function (form) {
            if (window.FormData) {
                var formData = new FormData(form[0]);

                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "php/login.php",
                    data: formData
                }).done(function (data) {
                    console.log(data.message);
                });
            }
        }
    }
}

addPlaceholder();
fileLoaderModule().init();
popupModule().init();
validateModule().init();