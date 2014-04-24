<?php

namespace Eo\KeyClient;

use Eo\KeyClient\Exception\KeyClientException;
use Eo\KeyClient\Payment\PaymentRequestInterface;
use Eo\KeyClient\Payment\PaymentResponse;
use Eo\KeyClient\Payment\PaymentResponseInterface;

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
            'url'        => $payment->getCompleteUrl(),
            'url_back'   => $payment->getCancelUrl(),
            'languageId' => $payment->getLanguage(),

            'mac'        => $this->calculateSignature($payment)
        );

        if ($mail = $payment->getMail()) {
            $params['mail'] = $mail;
        }

        if ($s2s = $payment->getS2S()) {
            $params['url_post'] = $s2s;
        }

        return sprintf('%s?%s', $this->endpoint, http_build_query($params));
    }

    /**
     * Parse paymentResponse
     *
     * @return PaymentResponse
     */
    public function parsePaymentResponse()
    {
        $request = new \ArrayObject($_REQUEST);
        $fields  = array(
            'session_id'   => 'session',
            'regione'      => 'region',
            'codAut'       => 'authCode',
            'alias'        => 'alias',
            'orario'       => 'time',
            'data'         => 'date',
            'mac'          => 'signature',
            'importo'      => 'amount',
            '$BRAND'       => 'brand',
            'tipoProdotto' => 'type',
            'cognome'      => 'lastName',
            'languageId'   => 'language',
            'pan'          => 'cc',
            'nazionalita'  => 'nationality',
            'divisa'       => 'currency',
            'email'        => 'mail',
            'scadenza_pan' => 'CCExpiresAt',
            'esito'        => 'result',
            'codTrans'     => 'transactionCode',
            'nome'         => 'firstName',
            'messaggio'    => 'message'
        );

        // Create paymentRequest
        $response = new PaymentResponse();

        // Set response fields
        foreach ($fields as $key => $val) {
            if ($request->offsetExists($key) === false) {
                throw new KeyClientException('Missing parameters passed');
            }

            $setter = sprintf('set%s', ucfirst($val));
            $response->$setter($request->offsetGet($key));
        }

        // Verify signature and its exception
        if ($this->verifySignature($response)) {
            throw new KeyClientException('Signature can not be verified');
        }

        return $response;
    }

    /**
     * Calculate signature
     *
     * @param  PaymentRequestInterface $paymentRequest
     * @return string
     */
    public function calculateSignature(PaymentRequestInterface $paymentRequest)
    {
        $mac = strtr('codTrans={transactionCode}divisa={currency}importo={amount}{secret}', array(
            '{transactionCode}' => $paymentRequest->getTransactionCode(),
            '{currency}'        => $paymentRequest->getCurrency(),
            '{amount}'          => $paymentRequest->getAmount(),
            '{secret}'          => $this->secret
        ));

        return sha1($mac);
    }

    /**
     * Verify signature
     *
     * @param  PaymentResponseInterface $paymentResponse
     * @return bool
     */
    public function verifySignature(PaymentResponseInterface $paymentResponse)
    {
        $mac = strtr('codTrans={transactionCode}esito={result}importo={amount}divisa={currency}data={date}orario={time}codAut={authCode}{secret}', array(
            '{transactionCode}' => $paymentResponse->getTransactionCode(),
            '{result}'          => $paymentResponse->getResult(),
            '{amount}'          => $paymentResponse->getAmount(),
            '{currency}'        => $paymentResponse->getCurrency(),
            '{date}'            => $paymentResponse->getDate(),
            '{time}'            => $paymentResponse->getTime(),
            '{authCode}'        => $paymentResponse->getAuthCode(),
            '{secret}'          => $this->secret
        ));

        $generated = sha1($mac);
        $given     = $paymentResponse->getSignature();

        return $generated === $given;
    }
}