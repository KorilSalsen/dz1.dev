'use strict';

var popup = $('.popup-back');

$('.work__add-link').on('click', function (e) {
    e.preventDefault();

    popup.fadeIn(300);
});

popup.on('click', function (e) {
    e.preventDefault();

    var $this = $(e.target);


    if ($this[0] == popup[0] || $this[0] == $('.popup-close')[0]) {
        e.preventDefault();

        popup.fadeOut(300);
    }
});