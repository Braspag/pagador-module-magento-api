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
            serviceUrl = urlBuilder.createUrl('/braspag/auth3ds20/token/', {});

            return storage.get(
                serviceUrl, false
            )
        };
    }
);
