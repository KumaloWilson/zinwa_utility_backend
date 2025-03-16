<?php

namespace App\Services;

use App\Models\Transaction;
use Paynow\Payments\Paynow;

class PayNowService
{
    public Paynow $paymentObject;

    public function __construct(Transaction $transaction, ?string $returnUrl = null)
    {
        $this->paymentObject = $this->configurePayNow($transaction->currency);

        $returnUrl = $returnUrl ?? route('paynow_redirect', ['id' => $transaction->id]);
        $this->paymentObject->setReturnUrl($returnUrl);
        $this->paymentObject->setResultUrl($returnUrl);
    }

    protected function configurePayNow(string $currency): Paynow
    {
        $isUsd = strtolower($currency) === 'usd';

        return new Paynow(
            config($isUsd ? 'services.paynow.card_integration_id' : 'services.paynow.mobile_integration_id'),
            config($isUsd ? 'services.paynow.card_integration_key' : 'services.paynow.mobile_integration_key'),
            '',
            ''
        );
    }
}
