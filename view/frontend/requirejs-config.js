/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
var config = {
	shim: {
		"Braspag_BraspagPagador/js/vendor/superdebitoLib": {
			export: 'superdebito',
			init: function () {
				return {
					superdebito: superdebito
				}
			}
		}
	},
	map: {
		"*": {
			'Magento_Checkout/js/action/place-order': 'Braspag_BraspagPagador/js/action/place-order',
			'Magento_Checkout/js/view/billing-address':'Braspag_BraspagPagador/js/view/billing-address',
		}
	}
}
