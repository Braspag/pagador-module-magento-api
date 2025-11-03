<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Factories;

use Braspag\BraspagPagador\Api\Transaction\Resource\Boleto\Send\Response as BoletoResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Send\Response as CreditCardResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\Pix\Send\Response as PixResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\AntiFraud\Response as CreditCardAntiFraudResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Velocity\Response as CreditCardVelocityResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Avs\Response as CreditCardVAvsResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Velocity\Reasons\Response as CreditCardVelocityReasonsResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\Actions\Response as ActionsResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\Auth3Ds20\Token\Response as Auth3Ds20TokenResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\OAuth2\Token\Response as OAuth2TokenResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\DebitCard\Send\Response as DebitCardResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\PaymentSplit\Response as PaymentSplitResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\PaymentSplit\GetSubordinate\Response as PaymentSplitGetSubordinateResponse;
use Braspag\BraspagPagador\Api\Transaction\Resource\Voucher\Send\Response as VoucherResponse;

class ResponseFactory
{
    const CLASS_TYPE_AUTH_TOKEN = 'auth-token';
    const CLASS_TYPE_OAUTH2_TOKEN = 'oauth2-token';
    const CLASS_TYPE_BOLETO = 'boleto';
    const CLASS_TYPE_CREDIT_CARD = 'creditCard';
    const CLASS_TYPE_ACTIONS = 'actions';
    const CLASS_TYPE_DEBIT_CARD = 'debitCard';
    const CLASS_TYPE_DEBIT_CARD_PAYMENT_SPLIT = 'debitCardPaymentSplit';
    const CLASS_TYPE_CREDIT_CART_ANTI_FRAUD = 'antiFraud';
    const CLASS_TYPE_CREDIT_CART_PAYMENT_SPLIT = 'paymentSplit';
    const CLASS_TYPE_BOLETO_PAYMENT_SPLIT_GET_SUBORDINATE = 'paymentSplitGetSubordinate';
    const CLASS_TYPE_CREDIT_CART_VELOCITY = 'velocity';
    const CLASS_TYPE_CREDIT_CART_VELOCITY_REASONS = 'velocityReasons';
    const CLASS_TYPE_CREDIT_CART_AVS = 'avs';
    const CLASS_TYPE_BOLETO_PAYMENT_SPLIT = 'boletoPaymentSplit';
    const CLASS_TYPE_PIX = 'pix';
    const CLASS_TYPE_PIX_PAYMENT_SPLIT = 'pixPaymentSplit';
    const CLASS_TYPE_VOUCHER = 'voucher';


    public static function make(array $data, $type)
    {
        if ($type === self::CLASS_TYPE_BOLETO) {
            return new BoletoResponse($data);
        }

        if ($type === self::CLASS_TYPE_CREDIT_CARD) {
            return new CreditCardResponse($data);
        }

        if ($type === self::CLASS_TYPE_AUTH_TOKEN) {
            return new Auth3Ds20TokenResponse($data);
        }

        if ($type === self::CLASS_TYPE_OAUTH2_TOKEN) {
            return new OAuth2TokenResponse($data);
        }

        if ($type === self::CLASS_TYPE_ACTIONS) {
            return new ActionsResponse($data);
        }

        if ($type === self::CLASS_TYPE_DEBIT_CARD) {
            return new DebitCardResponse($data);
        }

        if ($type === self::CLASS_TYPE_CREDIT_CART_ANTI_FRAUD) {
            return new CreditCardAntiFraudResponse($data);
        }

        if ($type === self::CLASS_TYPE_DEBIT_CARD_PAYMENT_SPLIT) {
            return new PaymentSplitResponse($data);
        }

        if ($type === self::CLASS_TYPE_CREDIT_CART_PAYMENT_SPLIT) {
            return new PaymentSplitResponse($data);
        }

        if ($type === self::CLASS_TYPE_BOLETO_PAYMENT_SPLIT_GET_SUBORDINATE) {
            return new PaymentSplitGetSubordinateResponse($data);
        }

        if ($type === self::CLASS_TYPE_BOLETO_PAYMENT_SPLIT) {
            return new PaymentSplitResponse($data);
        }

        if ($type === self::CLASS_TYPE_CREDIT_CART_VELOCITY) {
            return new CreditCardVelocityResponse($data);
        }

        if ($type === self::CLASS_TYPE_CREDIT_CART_VELOCITY_REASONS) {
            return new CreditCardVelocityReasonsResponse($data);
        }

        if ($type === self::CLASS_TYPE_CREDIT_CART_AVS) {
            return new CreditCardVAvsResponse($data);
        }

        if ($type === self::CLASS_TYPE_PIX) {
            return new PixResponse($data);
        }

        if ($type === self::CLASS_TYPE_VOUCHER) {
            return new VoucherResponse($data);
        }
    }
}