<?php

namespace Eo\KeyClient\Payment;

use Eo\KeyClient\Notification\NotificationInterface;

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
     * @var array
     */
    protected $notifications = array();

    /**
     * Class constructor
     * 
     * @param int    $amount          Total amount expressed in cents
     * @param string $currency        3 character currency code
     * @param string $transactionCode Unique payment identifier code
     * @param string $cancelUrl       Redirect url for when the payment is canceled
     */
    public function __construct($amount, $currency, $transactionCode, $cancelUrl)
    {
        $this->amount          = $amount;
        $this->currency        = $currency;
        $this->transactionCode = $transactionCode;
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
     * Add notification
     * 
     * @param NotificationInterface $notification
     */
    public function addNotification(NotificationInterface $notification)
    {
        $this->notifications[] = $notification;
    }

    /**
     * Get notifications
     * 
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
}