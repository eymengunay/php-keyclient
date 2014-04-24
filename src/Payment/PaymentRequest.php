<?php

namespace Eo\KeyClient\Payment;

/**
 * PaymentRequest
 */
class PaymentRequest extends AbstractPayment implements PaymentRequestInterface
{
    /**
     * @var string
     */
    protected $completeUrl;

    /**
     * @var string
     */
    protected $cancelUrl;

    /**
     * @var string
     */
    protected $s2s;

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
        $this->amount          = $amount;
        $this->currency        = $currency;
        $this->transactionCode = $transactionCode;
        $this->completeUrl     = $completeUrl;
        $this->cancelUrl       = $cancelUrl;
    }

    /**
     * Get completeUrl
     *
     * @return string
     */
    public function getCompleteUrl()
    {
        return $this->completeUrl;
    }

    /**
     * Get cancelUrl
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * Set s2s
     *
     * @param  string $s2s
     * @return self
     */
    public function setS2S($s2s)
    {
        $this->s2s = $s2s;

        return $this;
    }

    /**
     * Get s2s
     *
     * @return string
     */
    public function getS2S()
    {
        return $this->s2s;
    }
}