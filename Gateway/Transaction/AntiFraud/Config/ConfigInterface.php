<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\AntiFraud\Config;

interface ConfigInterface
{
    const COUNTRY_TELEPHONE_CODE = 55;
    const XML_PATH_ACTIVE = 'braspag_braspag_antifraud/general/active';
    const XML_PATH_FINGER_PRINT_ATTRIBUTE = 'braspag_braspag_antifraud/options/sequence';
    const XML_PATH_SEQUENCE = 'braspag_braspag_antifraud/options/sequence';
    const XML_PATH_SEQUENCE_CRITERIA = 'braspag_braspag_antifraud/options/sequence_criteria';
    const XML_PATH_CAPTURE_ON_LOW_RISK = 'braspag_braspag_antifraud/options/capture_in_low_risk';
    const XML_PATH_VOID_ON_HIGH_RISK = 'braspag_braspag_antifraud/options/void_in_high_risk';
    const XML_ORDER_ID_TO_FINGERPRINT   = 'braspag_braspag_antifraud/fingerprint/use_order_id_to_fingerprint';

    public function getSequence();

    public function getSequenceCriteria();

    public function getCaptureOnLowRisk();

    public function getVoidOnHighRisk();

    public function userOrderIdToFingerPrint();
}