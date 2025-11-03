<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Config;

/**
 *
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
interface ConfigInterface
{
    const COUNTRY_TELEPHONE_CODE = 55;
    const CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_ID     = 'braspag_braspag/pagador/merchant_id';
    const CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_KEY    = 'braspag_braspag/pagador/merchant_key';
    const CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_NAME = 'braspag_braspag/pagador/merchant_name';
    const CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_ESTABLISHMENT_CODE = 'braspag_braspag/pagador/establishment_code';
    const CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MMC = 'braspag_braspag/pagador/mcc';
    const CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_RETURN_URL    = 'braspag_braspag/pagador/return_url';
    const CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_IS_TEST_ENVIRONMENT    = 'braspag_braspag/pagador/test_mode';
    const CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_STREET_ATTRIBUTE = 'payment/braspag_pagador_customer_address/street_attribute';
    const CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_NUMBER_ATTRIBUTE = 'payment/braspag_pagador_customer_address/number_attribute';
    const CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_COMPLEMENT_ATTRIBUTE = 'payment/braspag_pagador_customer_address/complement_attribute';
    const CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_DISTRICT_ATTRIBUTE = 'payment/braspag_pagador_customer_address/district_attribute';

    const DATE_FORMAT = 'Y-m-d';

    public function getMerchantId();

    public function getMerchantKey();

    public function getMerchantName();

    public function getEstablishmentCode();

    public function getMCC();

    public function getIsTestEnvironment();

    public function getCustomerStreetAttribute();

    public function getCustomerNumberAttribute();

    public function getCustomerComplementAttribute();

    public function getCustomerDistrictAttribute();
}