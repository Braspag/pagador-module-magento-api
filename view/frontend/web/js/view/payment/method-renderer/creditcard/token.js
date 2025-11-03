/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
/*browser:true*/
/*global define*/
define(
    [
        'Magento_Payment/js/view/payment/cc-form',
        'mage/translate'
    ],
    function (Component, $t) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Braspag_BraspagPagador/payment/creditcardtoken/creditcardtoken',
                creditCardInstallments: '',
                creditCardToken: ''
            },

            initObservable: function () {
                this._super()
                    .observe([
                        'creditCardToken',
                        'creditCardVerificationNumber',
                        'creditCardInstallments'
                    ]);

                return this;
            },

            getCode: function() {
                return 'braspag_pagador_creditcardtoken';
            },

            isActive: function() {
                return window.isCustomerLoggedIn;
            },

            getData: function () {
                return {
                    'method': this.item.method,
                    'additional_data': {
                        'cc_cid': this.creditCardVerificationNumber(),
                        'cc_token': this.creditCardToken(),
                        'cc_installments': this.creditCardInstallments()
                    }
                };
            },

            isInstallmentsActive: function () {
                return window.checkoutConfig.payment.ccform.installments.active[this.getCode()];
            },

            getCcInstallments: function() {
                return window.checkoutConfig.payment.ccform.installments.list[this.getCode()];
            },

            getCcInstallmentsValues: function() {
                return _.map(this.getCcInstallments(), function (value, key) {
                    return {
                        'value': key,
                        'installments': value
                    };
                });
            },

            getCcAvailableTokens: function () {
                return window.checkoutConfig.payment.ccform.tokens.list[this.getCode()];
            },

            getCcAvailableTokensValues: function() {
                return _.map(this.getCcAvailableTokens(), function (value, key) {
                    return {
                        'token': key,
                        'alias': value
                    };
                });
            }

        });
    }
);
