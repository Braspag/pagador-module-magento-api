<?php

/**
 * @author      Webjump Developer Team <developer@webjump.com.br>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com Copyright
 *
 * @link        http://www.nexaas.com
 */

declare(strict_types=1);

namespace Braspag\BraspagPagador\Model\Resolver\DataProvider;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\SilentOrderPost\Builder as SilentOrderBuilder;

/**
 * Class AccessToken
 * @package Braspag\BraspagPagador\Model\Resolver\DataProvider
 */
class AccessToken
{
    const ACCESS_TOKEN_FIELD = 'accessToken';

    /**
     * @var SilentOrderBuilder
     */
    protected $silentOrderBuilder;

    /**
     * AccessToken constructor.
     * @param SilentOrderBuilder $silentOrderBuilder
     */
    public function __construct(
        SilentOrderBuilder $silentOrderBuilder
    ) {
        $this->silentOrderBuilder =  $silentOrderBuilder;
    }

    /**
     * @param $args
     * @return array
     */
    public function getData($args)
    {
        return [
            self::ACCESS_TOKEN_FIELD    => $this->silentOrderBuilder->build(),
        ];
    }
}