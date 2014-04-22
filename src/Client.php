<?php

namespace Eo\KeyClient;

use Eo\KeyClient\Payment\PaymentRequestInterface;

/**
 * Client
 */
class Client
{
    /**
     * @var string
     */
    protected $endpoint = 'https://ecommerce.keyclient.it/ecomm/ecomm/DispatcherServlet';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $secret;

    /**
     * Class constructor
     *
     * @param string $alias  Store identification code given by KeyClient
     * @param string $secret
     */
    public function __construct($alias, $secret)
    {
        $this->alias  = $alias;
        $this->secret = $secret;
    }

    /**
     * Create paymentUrl
     *
     * @param  PaymentRequestInterface $payment
     * @return string
     */
    public function createPaymentUrl(PaymentRequestInterface $payment)
    {
        $params = array(
            'alias'      => $this->alias,

            'importo'    => $payment->getAmount(),
            'divisa'     => $payment->getCurrency(),
            'codTrans'   => $payment->getTransactionCode(),
            'session_id' => $payment->getSession(),
            'url_back'   => $payment->getCancelUrl(),
            'languageId' => $payment->getLanguage(),

            'mac'        => $this->signPayment($payment)
        );

        foreach ($payment->getNotifications() as $notification) {
            $params[$notification->getKey()] = $notification->getValue();
        }

        return sprintf('%s?%s', $this->endpoint, http_build_query($params));
    }

    /**
     * Sign payment
     *
     * @param  PaymentRequestInterface $payment
     * @return string
     */
    protected function signPayment(PaymentRequestInterface $payment)
    {
        $mac = strtr('codTrans={transactionCode}divisa={currency}importo={amount}{secret}', array(
            '{transactionCode}' => $payment->getTransactionCode(),
            '{currency}'        => $payment->getCurrency(),
            '{amount}'          => $payment->getAmount(),
            '{secret}'          => $this->secret
        ));

        return sha1($mac);
    }
}