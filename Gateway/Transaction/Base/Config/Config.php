<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Config;

/**
 * Braspag Transaction Base Config
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Config extends AbstractConfig implements ConfigInterface
{
    /**
     * @param null $scopeId
     * @param string $scopeType
     * @return mixed
     */
    public function getMerchantId($scopeId = null, $scopeType = \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
    {
        if (!empty($scopeId)) {
            return $this->getConfig()->getValue(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_ID, $scopeType, $scopeId);
        }

        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_ID);
    }

    /**
     * @param null $scopeId
     * @param string $scopeType
     * @return mixed
     */
    public function getMerchantKey($scopeId = null, $scopeType = \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
    {
        if (!empty($scopeId)) {
            return $this->getConfig()->getValue(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_KEY, $scopeType, $scopeId);
        }

        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_KEY);
    }

    /**
     * @return mixed
     */
    public function getMerchantName()
    {
        if (!empty($scopeId)) {
            return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_NAME, $scopeType, $scopeId);
        }

        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MERCHANT_NAME);
    }

    /**
     * @return mixed
     */
    public function getEstablishmentCode()
    {
        if (!empty($scopeId)) {
            return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_ESTABLISHMENT_CODE, $scopeType, $scopeId);
        }

        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_ESTABLISHMENT_CODE);
    }

    /**
     * @return mixed
     */
    public function getMCC()
    {
        if (!empty($scopeId)) {
            return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MMC, $scopeType, $scopeId);
        }

        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_MMC);
    }

    /**
     * @return mixed
     */
    public function getIsTestEnvironment()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_GLOBAL_IS_TEST_ENVIRONMENT);
    }

    public function getCustomerStreetAttribute()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_STREET_ATTRIBUTE);
    }

    public function getCustomerNumberAttribute()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_NUMBER_ATTRIBUTE);
    }

    public function getCustomerComplementAttribute()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_COMPLEMENT_ATTRIBUTE);
    }

    public function getCustomerDistrictAttribute()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CUSTOMER_ADDRESS_DISTRICT_ATTRIBUTE);
    }
}
