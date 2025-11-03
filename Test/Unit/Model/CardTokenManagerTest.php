<?php

/**
 *
 * Card Token Manager Test.php
 *
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Test\Unit\Model;

use Braspag\BraspagPagador\Model\CardTokenManager;

class CardTokenManagerTest extends \PHPUnit\Framework\TestCase
{
    private $model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->responseMock = $this->createMock(\Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Send\ResponseInterface::class);
        $this->cardTokenRepositoryMock = $this->createMock(\Braspag\BraspagPagador\Api\CardTokenRepositoryInterface::class);
        $this->eventManagerMock = $this->createMock(\Magento\Framework\Event\ManagerInterface::class);
        $this->searchCriteriaBuilderMock = $this->createMock(\Magento\Framework\Api\SearchCriteriaBuilder::class);
        $this->searchCriteriaMock = $this->createMock(\Magento\Framework\Api\SearchCriteriaInterface::class);
        $this->searchCriteriaresultMock = $this->createMock(\Magento\Framework\Api\SearchResultsInterface::class);
        $this->cartTokenMock = $this->createMock(\Braspag\BraspagPagador\Api\Data\CardTokenInterface::class);

        $this->searchCriteriaBuilderMock->expects($this->any())
            ->method('create')
            ->willReturn($this->searchCriteriaMock);

        $this->cardTokenRepositoryMock->expects($this->once())
            ->method('getList')
            ->with($this->searchCriteriaMock)
            ->willReturn($this->searchCriteriaresultMock);

        $this->model = $objectManager->getObject(
            CardTokenManager::class,
            [
                'cardTokenRepository' => $this->cardTokenRepositoryMock,
                'eventManager' => $this->eventManagerMock,
                'searchCriteriaBuilder' => $this->searchCriteriaBuilderMock
            ]
        );
    }

    /** @test */
    public function test()
    {
        // prepare the test

        $this->cardTokenRepositoryMock->expects($this->once())
            ->method('create')
            ->will($this->returnValue($this->cartTokenMock));

        $this->searchCriteriaresultMock->expects($this->any())
            ->method('getitems')
            ->will($this->returnValue([$this->cartTokenMock]));

        // perform the changes

        $result = $this->model->registerCardToken(1, 'payment_method', $this->responseMock);

        // test the results

        static::assertEquals($this->cartTokenMock, $result);
    }
}