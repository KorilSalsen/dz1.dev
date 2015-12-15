'use strict';

var projectModule = function () {
    var forms = $('form'),
        popups = $('.popup'),
        popupButtons = $('.popup-button'),
        fileUploads = $(".input__upload"),
        resetButtons = $('[type="reset"]'),
        time = 300,
        picTypes = ['.jpg', '.jpeg', '.png', '.bmp'];

    var _eventListener = function () {
        popupButtons.on('click', _popupSwitcher.show);
        popups.on('click', _popupSwitcher.hide);
        fileUploads.on('change', _fileUploadFix);
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

    var _popupSwitcher = {
        show: function (e) {
            e.preventDefault ? e.preventDefault() : (e.returnValue = false);

            var popupData = $(e.target).closest('.popup-button').data('popup');

            popups.filter('[data-popup="' + popupData + '"]').fadeIn(time);
        },
        hide: function (e) {
            var $this = $(e.target),
                thisPopup = $this.closest('.popup'),
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
            fakeFileUploadInput.val(fileName)
                .addClass('input__text_no-valid')
                .siblings('.tooltip').fadeIn(time);
        } else {
            fakeFileUploadInput.val(fileName)
                .removeClass('input__text_no-valid')
                .siblings('.tooltip').fadeOut(time);
        }
    };

    var _validator = function (e) {
        e.preventDefault ? e.preventDefault() : (e.returnValue = false);

        var form = $(e.target),
            inputs = form.find('.input__text');

        inputs.each(function (i) {
            var input = inputs.eq(i),
                type = input.attr('type'),
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

            if (type !== 'file') {
                input.focus(function (e) {
                    var $this = $(e.target);

                    if ($this.hasClass('input__text_no-valid')) {
                        $this.keydown(function () {
                            $this.removeClass('input__text_no-valid')
                                .siblings('.tooltip').fadeOut(time);
                        });
                    }
                });

                if (!input.val()) {
                    input.addClass('input__text_no-valid')
                        .siblings('.tooltip').fadeIn(time);
                }
            }
        });

        if (!form.find('.input__text_no-valid').length) {
            _ajaxAddWork(form);
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
        init: function () {
            _eventListener();
        }
    };
};

projectModule().init();

