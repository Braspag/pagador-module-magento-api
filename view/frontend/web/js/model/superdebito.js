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
    	"Braspag_BraspagPagador/js/vendor/superdebitoLib"
    ],
    function(superdebitoLib) {
        'use strict';

        return {

        	isActive: function (code) {
        		return window.checkoutConfig.payment.dcform.superdebito.active[code];
        	},

            getMerchantId: function () {
                return window.checkoutConfig.payment.braspag.merchantId;
            },

        	start: function (options) {
                options.merchantId = this.getMerchantId();
                options.log = true;

        		superdebitoLib.superdebito(options);
        	}

        };
    }
);
