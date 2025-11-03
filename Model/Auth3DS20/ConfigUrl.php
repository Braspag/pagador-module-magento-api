<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

declare(strict_types=1);

namespace Braspag\BraspagPagador\Model\Auth3DS20;

use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigUrl
{
    const VALUE_URL = 'web/secure/base_url';
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * ConfigUrl constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get 'web/unsecure/base_url'
     *
     * @return mixed
     */
    public function getValueUrl()
    {
        return $this->scopeConfig->getValue(self::VALUE_URL);
    }
}