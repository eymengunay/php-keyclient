<?php

namespace Eo\KeyClient\Payment;

/**
 * PaymentRequest
 */
class PaymentRequest implements PaymentRequestInterface
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $transactionCode;

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
    protected $session;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $mail;

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
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Get transactionCode
     *
     * @return string
     */
    public function getTransactionCode()
    {
        return $this->transactionCode;
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
     * Set session
     *
     * @param  string $session
     * @return string
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set language
     *
     * @param  string $language
     * @return string
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set mail
     *
     * @param  string $mail
     * @return string
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set s2s
     *
     * @param  string $s2s
     * @return string
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