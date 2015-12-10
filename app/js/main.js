'use strict';

;
(function () {
    var form = $('form');
    //Popup
    var popup = $('.popup-back');

    $('.work__add-link').on('click', function (e) {
        e.preventDefault();

        popup.fadeIn(300);
    });

    popup.on('click', function (e) {
        var $this = $(e.target);

        if ($this[0] == popup[0] || $this[0] == $('.popup-close')[0]) {
            e.preventDefault();

            popup.fadeOut(300);

            form[0].reset();
            fakeInputUpload.removeClass('file-selected').text(defaultText);
            form.find('.input__text').removeClass('input__text_no-valid');
            form.find('.tooltip').hide(0);
        }
    });

    //File-upload
    var fileUpload = $("#pic-of-work"),
        fakeInputUpload = $('.input__text_fake-upload'),
        defaultText = fakeInputUpload.text();

    var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;

    fileUpload.change(function () {
        var file_name;

        if (file_api && fileUpload[0].files[0]) {
            file_name = fileUpload[0].files[0].name;
        } else {
            file_name = fileUpload.val().replace("C:\\fakepath\\", '');
        }

        if (!file_name.length) return;

        fakeInputUpload.addClass('file-selected')
            .text(file_name)
            .removeClass('input__text_no-valid')
            .parent().siblings('.tooltip').fadeOut(500);
    }).change();

    //Tooltip
    form.submit(function (e) {
        e.preventDefault();

        var form = $(e.target),
            inputs = form.find('.input__text'),
            readyToSend = true;

        for (var i = 0; i < inputs.length; i++) {
            var input = inputs.eq(i),
                type = input.attr('type');

            if (!input.hasClass('input__text_fake-upload') && !input.hasClass('input__text_upload')) {

                input.focus(function (e) {
                    var $this = $(e.target);

                    if ($this.hasClass('input__text_no-valid')) {

                        $this.keydown(function () {
                            $this.removeClass('input__text_no-valid')
                                .siblings('.tooltip').fadeOut(500);
                        });
                    }
                });

                if (!input.val()) {
                    input.addClass('input__text_no-valid')
                        .siblings('.tooltip').fadeIn(500);
                    readyToSend = false;
                }

            } else if (input.hasClass('input__text_upload')) {
                if (!input.val()) {
                    input.siblings('.input__text_fake-upload').addClass('input__text_no-valid')
                        .parent().siblings('.tooltip').fadeIn(500);
                    readyToSend = false;
                }
            }
        }
    });
})();
