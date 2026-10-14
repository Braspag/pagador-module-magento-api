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

use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\RequestInterface as BoletoRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Send\RequestInterface as CreditCardRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as PaymentSplitTransactionPostRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\CreateSubordinate\RequestInterface as PaymentSplitCreateSubordinateRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\GetSubordinate\RequestInterface as PaymentSplitGetSubordinateRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\RequestInterface as ActionsPaymentRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send\RequestInterface as DebitRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\Pix\Send\RequestInterface as PixRequest;
use Braspag\BraspagPagador\Api\Transaction\Api\Voucher\Send\RequestInterface as VoucherRequest;
use Braspag\BraspagPagador\Api\Transaction\Command\Sales\CaptureCommand;
use Braspag\BraspagPagador\Api\Transaction\Command\Sales\GetCommand;
use Braspag\BraspagPagador\Api\Transaction\Command\Sales\VoidCommand;
use Braspag\BraspagPagador\Api\Transaction\Command\SalesCommand;

interface ApiInterface
{
    /**
     * @param BoletoRequest $request
     * @return SalesCommand
     */
    public function sendBoleto(BoletoRequest $request);

    /**
     * @param CreditCardRequest $request
     * @return SalesCommand
     */
    public function sendCreditCard(CreditCardRequest $request);

    /**
     * @param DebitCardRequest $request
     * @return SalesCommand
     */
    public function sendSplitPaymentTransactionPost(PaymentSplitTransactionPostRequest $request);

    /**
     * @param ActionsPaymentRequest $request
     * @return CaptureCommand
     */
    public function captureCreditCard(ActionsPaymentRequest $request);

    /**
     * @param DebitRequest $request
     * @return SalesCommand
     */
    public function sendDebit(DebitRequest $request);

    /**
     * @param ActionsPaymentRequest $request
     * @param $type
     * @return GetCommand
     */
    public function checkPaymentStatus(ActionsPaymentRequest $request, $type);

    /**
     * @param ActionsPaymentRequest $request
     * @return VoidCommand
     */
    public function voidPayment(ActionsPaymentRequest $request);

    /**
     * @param PaymentSplitCreateSubordinateRequest $request
     * @return mixed
     */
    public function sendSplitPaymentCreateSubordinate(PaymentSplitCreateSubordinateRequest $request);

    /**
     * @param PaymentSplitGetSubordinateRequest $request
     * @return mixed
     */
    public function sendSplitPaymentGetSubordinate(PaymentSplitGetSubordinateRequest $request);

    /**
     * @param PixRequest $request
     * @return SalesCommand
     */
    public function sendPix(PixRequest $request);

    /**
     * @param VoucherRequest $request
     * @return SalesCommand
     */
    public function sendVoucher(VoucherRequest $request);
}