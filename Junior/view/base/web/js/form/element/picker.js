define([
    'Magento_Ui/js/form/element/date',
    'mageUtils',
    'jquery',
    'jquery-ui-modules/datepicker',
], function (Date, utils, $) {
    'use strict';
    return Date.extend({
        defaults: {
            options: {
                showsDate: true,
                showsTime: true,
                timeOnly: false,
                beforeShowDay: function (date) {
                    var date = date.getDate();
                    if (date == 8 || date == 9 ||date == 10 || date == 11) {
                        return [true, "somecssclass"]
                    } else {
                        return [false, "someothercssclass"]
                    }
                },
            },

            elementTmpl: 'ui/form/element/date',
        }
        /*beforeShowDay: function (Date) {
            var day = Date.getDay();
            if(disabledDay.indexOf(day) > -1 ) {
                return [false];
            }
            else{
                return [true];
            }
        }*/
    });
});