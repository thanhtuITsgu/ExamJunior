require(
    [
        'jquery'
    ],
    function ($) {
        'use strict';
        $(document).ready(function () {

            var addToCardForm = $('#product_addtocart_form');
                addToCardForm.prepend('<div class="message-custom">\n' +
                    '    <label class="email-label" for="email">\n' +
                    '        <span>Email addresses</span>\n' +
                    '    </label>\n' +
                    '    <textarea maxlength="100" name="email-custom"></textarea>\n' +
                    '\n' +
                    '    <label class="message-label" for="message">\n' +
                    '       <span>Message</span>\n' +
                    '    </label>\n' +
                    '    <textarea maxlength="1000" name="message-custom"></textarea>\n' +
                    '</div>\n' +
                    '<br>');
        });
    });