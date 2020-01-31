define([
    'jquery',
    'ko',
    'Magento_Checkout/js/model/step-navigator'
], function($, ko, stepNavigator) {
    'use strict';

    var mixin = {
        initialize: function() {
            this._super();
            $.each(stepNavigator.steps(), function(index, step) {
                if (step.code === 'payment') {
                    step.title = 'Pay Now';
                }
            });
        }
    };
    return function(target) {
        return target.extend(mixin);
    }
});