define(
    [
        'jquery',
        'ko',
        'Magento_Checkout/js/view/summary/abstract-total',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'Magento_Customer/js/model/customer',
        'mage/url',
        'Magento_Checkout/js/checkout-data',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/cart/totals-processor/default',
    ],
    function (
        $,
        ko,
        Component,
        _,
        stepNavigator,
        customer,
        url,
        checkoutData,
        quote,
    ) {
        'use strict';
        // var check = $(".price").text();
        // alert(check);
        return Component.extend({
            defaults: {
                template: 'Magenest_Junior/check-login',
                basetotal: ko.observable(),
            },

            //add here your logic to display step,
            isVisible: ko.observable(true),
            isLogedIn: customer.isLoggedIn(),
            //step code will be used as step content id in the component template
            stepCode: 'customStep',
            //step title value
            stepTitle: 'Custom Step',

            /**
             *
             * @returns {*}
             */

            initialize: function () {
                this._super();
                // register your step
                stepNavigator.registerStep(
                    this.stepCode,
                    //step alias
                    null,
                    this.stepTitle,
                    //observable property with logic when display step or hide step
                    this.isVisible,

                    _.bind(this.navigate, this),

                    /**
                     * sort order value
                     * 'sort order value' < 10: step displays before shipping step;
                     * 10 < 'sort order value' < 20 : step displays between shipping and payment step
                     * 'sort order value' > 20 : step displays after payment step
                     */
                    15
                );
                var total = quote.getTotals()._latestValue.base_grand_total;
                this.basetotal(total);
            },
            /**
             * The navigate() method is responsible for navigation between checkout step
             * during checkout. You can add custom logic, for example some conditions
             * for switching to your custom step
             */
            navigate: function () {
                alert("helllo");
            },
            /**
             * @returns void
             */
            navigateToNextStep: function (event) {
                $("#backviewcart, #continue").one("click", function () {
                    if(this.id == 'backviewcart'){
                        stepNavigator.navigateTo("shipping");
                    }else if(this.id == 'continue'){
                        stepNavigator.next();

                    }
                });
            },

            getBaseTotal: function () {
                return this.basetotal._latestValue;
            },
            /**
             * @return {*}
             */
            isDisplayed: function () {
                return this.isFullMode();
            },

            /**
             * Get pure value.
             */
            getPureValue: function () {
                var totals = quote.getTotals()();

                if (totals) {
                    return totals['base_grand_total'];
                }

                return quote['base_grand_total'];
            },

            /**
             * @return {*|String}
             */
            getValue: function () {
                return this.getFormattedPrice(this.getPureValue());
            }
        });
    }
);