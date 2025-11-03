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
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'braspag_pagador_boleto',
                component: 'Braspag_BraspagPagador/js/view/payment/method-renderer/boleto'
            },
            {
                type: 'braspag_pagador_creditcard',
                component: 'Braspag_BraspagPagador/js/view/payment/method-renderer/creditcard'
            },
            {
                type: 'braspag_pagador_debitcard',
                component: 'Braspag_BraspagPagador/js/view/payment/method-renderer/debitcard'
            },
            {
                type: 'braspag_pagador_pix',
                component: 'Braspag_BraspagPagador/js/view/payment/method-renderer/pix'
            }
        );
        return Component.extend({});
    }
);
