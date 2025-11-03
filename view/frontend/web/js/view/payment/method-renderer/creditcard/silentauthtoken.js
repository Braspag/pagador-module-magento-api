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
        'mage/storage',
        'Magento_Checkout/js/model/url-builder'
    ],
    function (
        storage,
        urlBuilder
    ) {
        'use strict';

        return function () {
            var serviceUrl;
            serviceUrl = urlBuilder.createUrl('/braspag/creditcard/silentauthtoken/', {});

            return storage.post(
                serviceUrl, false
            )
        };
    }
);
