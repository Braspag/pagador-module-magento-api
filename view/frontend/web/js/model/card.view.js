/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2019 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
/*browser:true*/
/*global define*/
define(
    [
        "jquery",
        "Braspag_BraspagPagador/js/vendor/card.view",
    ],
    function (
        $,
        cardView
    ) {
        'use strict';

        return {

            isCreditCardViewEnabled: function () {
                return window.checkoutConfig.payment.ccform.card_view.active;
            },

            isDebitCardViewEnabled: function () {
                return window.checkoutConfig.payment.dcform.card_view.active;
            },

            isVoucherViewEnabled: function () {
                return window.checkoutConfig.payment.vcform.card_view.active;
            },

            initialize: function () {
            },
        };
    }
);
