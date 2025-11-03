/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
define(
    [],
    function() {
        'use strict';
        var paymentToken = '';
        return {

            setPaymentToken: function(token) {
                paymentToken = token;
            },

            getPaymentToken: function() {
                return paymentToken;
            }

        };
    }
);
