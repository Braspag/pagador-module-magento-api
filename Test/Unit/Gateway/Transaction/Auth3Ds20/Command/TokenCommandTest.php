<?php

namespace Braspag\BraspagPagador\Test\Unit\Gateway\Transaction\Auth3Ds20\Command;

use Braspag\BraspagPagador\Gateway\Transaction\Auth3Ds20\Command\TokenCommand;
use Braspag\BraspagPagador\Api\Auth3Ds20TokenCommandInterface;
use Braspag\BraspagPagador\Api\Transaction\ApiInterface as BraspagApi;
use Braspag\BraspagPagador\Api\Transaction\Api\Auth3Ds20\Token\RequestInterface;

class TokenCommandTest extends \PHPUnit\Framework\TestCase
{
    private $command;
    private $apiMock;
    private $responseHandlerMock;
    private $requestHandlerMock;

    public function setUp()
    {
        $this->apiMock = $this->createMock(BraspagApi::class);
        $this->requestBuilderMock = $this->createMock('Magento\Payment\Gateway\Request\BuilderInterface');
        $this->requestHandlerMock = $this->createMock('Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Request\HandlerInterface');
        $this->responseHandlerMock = $this->createMock('Magento\Payment\Gateway\Response\HandlerInterface');

        $this->command = new TokenCommand(
            $this->apiMock
        );
    }

    public function tearDown()
    {
    }

    public function testExecute()
    {
        $buildObject = [];

        $requestMock = $this->getMockBuilder('Braspag\BraspagPagador\Api\Transaction\Api\Auth3Ds20\Token\RequestInterface')
            ->getMock();

        $responseMock = $this->getMockBuilder('Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\ResponseInterface')
            ->getMock();

        $this->apiMock->expects($this->once())
            ->method('getToken')
            ->with($requestMock)
            ->will($this->returnValue($responseMock));

        $result = $this->command->execute($requestMock);

        $this->assertEquals($responseMock, $result);
    }
}