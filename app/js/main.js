'use strict';

var fileLoaderModule = function () {
    var fileUploads = $(".input__upload"),
        picTypes = ['.jpg', '.jpeg', '.png', '.bmp'];

    var _eventListener = function () {
        fileUploads.on('change', _fileUploadFix);
    };

    var _fileUploadFix = function (e) {
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

        if (picTypes.indexOf(fileType) === -1) {
            validateModule().validateInput(fakeFileUploadInput);
        } else {
            fakeFileUploadInput.val(fileName);
            validateModule().validateInput(fakeFileUploadInput);
        }
    };

    return {
        init: _eventListener
    };
};

var popupModule = function () {
    var popups = $('.popup'),
        popupButtons = $('.popup-button'),
        time = 300;

    var _eventListener = function () {
        popupButtons.on('click', _popupSwitcher.show);
        popups.on('click', _popupSwitcher.hide);
    };

    var _popupSwitcher = {
        show: function (e) {
            e.preventDefault ? e.preventDefault() : (e.returnValue = false);

            var popupName = $(this).data('popup-name');

            popups.filter('[data-popup-name="' + popupName + '"]').fadeIn(time);
        },
        hide: function (e) {
            var $this = $(e.target),
                thisPopup = $(this),
                form = thisPopup.find('form');

            if ($this.hasClass('popup') || $this.hasClass('popup-close')) {
                e.preventDefault();

                thisPopup.fadeOut(time);

                if (form.length) {
                    var inputs = form.find('.input__text'),
                        tooltips = form.find('.tooltip');

                    form.each(function (i) {
                        form.eq(i)[0].reset();
                    });

                    inputs.removeClass('input__text_no-valid');
                    tooltips.hide();
                }
            }
        }
    };

    return {
        init: _eventListener
    };
};

var validateModule = function () {
    var forms = $('form'),
        resetButtons = $('[type="reset"]'),
        time = 300;

    var _eventListener = function () {
        forms.on('submit', _validator);
        resetButtons.on('click', _cleanForm);
    };

    var _cleanForm = function (e) {
        var thisForm = $(e.target).closest('form'),
            inputs = thisForm.find('.input__text'),
            tooltips = thisForm.find('.tooltip');

        inputs.removeClass('input__text_no-valid');
        tooltips.hide();
    };

    var _validateSwitcher = {
        noValid: function(input){
            input.addClass('input__text_no-valid')
                .siblings('.tooltip').fadeIn(time);
        },
        valid: function(input){
            input.removeClass('input__text_no-valid')
                .siblings('.tooltip').fadeOut(time);
        }
    };

    var _validateInput = function(input){
        var type = input.attr('type'),
            tooltipText = input.data('tooltip'),
            tooltipPosition = input.data('tooltip-position'),
            inputWrapper = $('<div></div>', {
                'class': 'input-tooltip-wrapper'
            }),
            tooltipBlock = $('<div></div>', {
                'class': 'tooltip'
            }).text(tooltipText);

        if (!input.siblings('.tooltip').length) {
            input.wrap(inputWrapper)
                .after(tooltipBlock);

            if (tooltipPosition === 'right') {
                tooltipBlock.css({
                    right: -tooltipBlock.width() - 17
                }).addClass('tooltip_right');
            } else {
                tooltipBlock.css({
                    left: -tooltipBlock.width() - 17
                });
            }
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
        }else{
            _validateSwitcher.valid(input)
        }
    };

    var _validator = function (e) {
        e.preventDefault ? e.preventDefault() : (e.returnValue = false);

        var thisForm = $(this),
            inputs = thisForm.find('.input__text');

        inputs.each(function (i) {
            var input = inputs.eq(i);

            _validateInput(input);
        });

        if (!thisForm.find('.input__text_no-valid').length) {
            _ajaxAddWork(thisForm);
        }
    };

    var _ajaxAddWork = function (form) {
        var formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            url: "php/add-work.php",
            data: formData
        })
            .done(function (data) {
                console.log(data);
            });
    };

    return {
        init: _eventListener,
        validateInput: _validateInput
    };
};

fileLoaderModule().init();
popupModule().init();
validateModule().init();

$('input, textarea').placeholder();

