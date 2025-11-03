<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction;

use Braspag\BraspagPagador\Api\Factories\Auth3Ds20TokenCommandFactory;
use Braspag\BraspagPagador\Api\Factories\OAuth2TokenCommandFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitTransactionPostCommandFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitCreateSubordinateCommandFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitGetSubordinateCommandFactory;
use Braspag\BraspagPagador\Api\Factories\Auth3Ds20TokenRequestFactory;
use Braspag\BraspagPagador\Api\Factories\OAuth2TokenRequestFactory;
use Braspag\BraspagPagador\Api\Factories\BoletoRequestFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentRequestFactory;
use Braspag\BraspagPagador\Api\Factories\CreditCardRequestFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitRequestFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitCreateSubordinateRequestFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitGetSubordinateRequestFactory;
use Braspag\BraspagPagador\Api\Factories\CaptureCommandFactory;
use Braspag\BraspagPagador\Api\Factories\DebitCardRequestFactory;
use Braspag\BraspagPagador\Api\Factories\GetCommandFactory;
use Braspag\BraspagPagador\Api\Factories\VoidCommandFactory;
use Braspag\BraspagPagador\Api\Factories\PixRequestFactory;
use Braspag\BraspagPagador\Api\Factories\VoucherRequestFactory;
use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\RequestInterface as BoletoRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Send\RequestInterface as CreditCardRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\RequestInterface as ActionsPaymentRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\Auth3Ds20\Token\RequestInterface as Auth3Ds20TokenRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as PaymentSplitTransactionPostRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\CreateSubordinate\RequestInterface as PaymentSplitCreateSubordinateRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\GetSubordinate\RequestInterface as PaymentSplitGetSubordinateRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\OAuth2\Token\RequestInterface as OAuth2TokenRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send\RequestInterface as DebitRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\Pix\Send\RequestInterface as PixRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\Voucher\Send\RequestInterface as VoucherRequest;
use Braspag\BraspagPagador\Api\Factories\SalesCommandFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\Sales\CaptureCommand;
use Braspag\BraspagPagador\Api\Transaction\Command\Sales\GetCommand;
use Braspag\BraspagPagador\Api\Transaction\Command\Sales\VoidCommand;
use Braspag\BraspagPagador\Api\Transaction\Command\SalesCommand;

class Api implements ApiInterface
{
    /**
     * @param ActionsAuthenticateRequest $request
     * @return AuthenticateCommand
     */
    public function getToken(Auth3Ds20TokenRequest $request)
    {
        $request = Auth3Ds20TokenCommandFactory::make(Auth3Ds20TokenRequestFactory::make($request))->getResult();

        return $request;
    }

    /**
     * @param ActionsAuthenticateRequest $request
     * @return AuthenticateCommand
     */
    public function getOAuth2Token(OAuth2TokenRequest $request)
    {
        $request = OAuth2TokenCommandFactory::make(OAuth2TokenRequestFactory::make($request))->getResult();

        return $request;
    }

    /**
     * @param BoletoRequest $request
     * @return SalesCommand
     */
    public function sendBoleto(BoletoRequest $request)
    {
        $request = SalesCommandFactory::make(BoletoRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param CreditCardRequest $request
     * @return SalesCommand
     */
    public function sendCreditCard(CreditCardRequest $request)
    {
        $request = SalesCommandFactory::make(CreditCardRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param PaymentSplitTransactionPostRequest $request
     * @return PaymentSplitTransactionPostRequest|SalesCommand
     */
    public function sendSplitPaymentTransactionPost(PaymentSplitTransactionPostRequest $request)
    {
        $request = PaymentSplitTransactionPostCommandFactory::make(PaymentSplitRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param ActionsPaymentRequest $request
     * @return CaptureCommand
     */
    public function captureCreditCard(ActionsPaymentRequest $request)
    {
        $request = CaptureCommandFactory::make(PaymentRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param DebitRequest $request
     * @return SalesCommand
     */
    public function sendDebit(DebitRequest $request)
    {
        $request = SalesCommandFactory::make(DebitCardRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param ActionsPaymentRequest $request
     * @param $type
     * @return GetCommand
     */
    public function checkPaymentStatus(ActionsPaymentRequest $request, $type)
    {
        $request = GetCommandFactory::make(PaymentRequestFactory::make($request, $type))->getResult();
        return $request;
    }

    /**
     * @param ActionsPaymentRequest $request
     * @return VoidCommand
     */
    public function voidPayment(ActionsPaymentRequest $request)
    {
        $request = VoidCommandFactory::make(PaymentRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param PaymentSplitCreateSubordinateRequest $request
     * @return PaymentSplitCreateSubordinateRequest
     */
    public function sendSplitPaymentCreateSubordinate(PaymentSplitCreateSubordinateRequest $request)
    {
        $request = PaymentSplitCreateSubordinateCommandFactory::make(PaymentSplitCreateSubordinateRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param PaymentSplitGetSubordinateRequest $request
     * @return PaymentSplitGetSubordinateRequest
     */
    public function sendSplitPaymentGetSubordinate(PaymentSplitGetSubordinateRequest $request)
    {
        $request = PaymentSplitGetSubordinateCommandFactory::make(PaymentSplitGetSubordinateRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param PixRequest $request
     * @return SalesCommand
     */
    public function sendPix(PixRequest $request)
    {
        $request = SalesCommandFactory::make(PixRequestFactory::make($request))->getResult();
        return $request;
    }

    /**
     * @param VoucherRequest $request
     * @return SalesCommand
     */
    public function sendVoucher(VoucherRequest $request)
    {
        $request = SalesCommandFactory::make(VoucherRequestFactory::make($request))->getResult();
        return $request;
    }
}