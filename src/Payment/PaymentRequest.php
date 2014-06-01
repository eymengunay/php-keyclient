<?php

namespace Eo\KeyClient\Payment;

/**
 * PaymentRequest
 */
class PaymentRequest extends AbstractPayment implements PaymentRequestInterface
{
    /**
     * Class constructor
     *
     * @param int    $amount          Total amount expressed in cents
     * @param string $currency        3 character currency code
     * @param string $transactionCode Unique payment identifier code
     * @param string $completeUrl     Redirect url for when the payment is completed
     * @param string $cancelUrl       Redirect url for when the payment is canceled
     */
    public function __construct($amount, $currency, $transactionCode, $completeUrl, $cancelUrl)
    {
        parent::__construct(array(
            'importo'  => $amount,
            'divisa'   => $currency,
            'codTrans' => $transactionCode,
            'url'      => $completeUrl,
            'url_back' => $cancelUrl
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function getRequiredParams()
    {
        return array(
            'importo',
            'divisa',
            'codTrans',
            'url',
            'url_back'
        );
    }
}