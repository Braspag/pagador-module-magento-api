<?php

namespace Braspag\BraspagPagador\Api\Data;

/**
 * Card Token Interface
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
interface CardTokenInterface
{
    const ENTITY_ID = 'entity_id';

    const ALIAS = 'alias';

    const TOKEN = 'token';

    const CUSTOMER_ID = 'customer_id';

    const STORE_ID = 'store_id';

    const ACTIVE = 'active';

    const PROVIDER = 'provider';

    const BRAND = 'brand';

    const METHOD = 'method';

    const MASK  =  'mask';

    public function getId();

    public function getAlias();

    public function getToken();

    public function getBrand();

    public function getCustomerId();

    public function getStoreId();

    public function isActive();

    public function getProvider();

    public function getMethod();

    public function getMask();

    public function setId($id);

    public function setAlias($alias);

    public function setToken($token);

    public function setBrand($brand);

    public function setCustomerId($customerId);

    public function setStoreId($storeId);

    public function setActive($active);

    public function setProvider($provider);

    public function setMethod($method);

    public function setMask($mask);
}