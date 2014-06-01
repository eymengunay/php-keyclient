<?php

namespace Eo\KeyClient;

use Eo\KeyClient\Exception\KeyClientException;
use Eo\KeyClient\Payment\PaymentRequestInterface;
use Eo\KeyClient\Payment\PaymentResponse;
use Eo\KeyClient\Payment\PaymentResponseInterface;
use Symfony\Component\HttpFoundation\Request;

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
        $params = $payment->toArray();
        $params = array_merge($params, array(
            'alias' => $this->alias,
            'mac'   => $this->calculateMac($payment)
        ));

        return sprintf('%s?%s', $this->endpoint, http_build_query($params));
    }

    /**
     * Parse paymentResponse
     *
     * @param  Request         $request
     * @return PaymentResponse
     */
    public function parsePaymentResponse(Request $request = null)
    {
        $response = new PaymentResponse($request);

        // Verify mac
        if ($this->verifyMac($response) !== true) {
            throw new KeyClientException('Mac can not be verified');
        }

        return $response;
    }

    /**
     * Calculate mac
     *
     * @param  PaymentRequestInterface $paymentRequest
     * @return string
     */
    public function calculateMac(PaymentRequestInterface $paymentRequest)
    {
        $mac = strtr('codTrans={transactionCode}divisa={currency}importo={amount}{secret}', array(
            '{transactionCode}' => $paymentRequest->get('codTrans'),
            '{currency}'        => $paymentRequest->get('divisa'),
            '{amount}'          => $paymentRequest->get('importo'),
            '{secret}'          => $this->secret
        ));

        return sha1($mac);
    }

    /**
     * Verify mac
     *
     * @param  PaymentResponseInterface $paymentResponse
     * @return bool
     */
    public function verifyMac(PaymentResponseInterface $paymentResponse)
    {
        $mac = strtr('codTrans={transactionCode}esito={result}importo={amount}divisa={currency}data={date}orario={time}codAut={authCode}{secret}', array(
            '{transactionCode}' => $paymentResponse->get('codTrans'),
            '{result}'          => $paymentResponse->get('esito'),
            '{amount}'          => $paymentResponse->get('importo'),
            '{currency}'        => $paymentResponse->get('divisa'),
            '{date}'            => $paymentResponse->get('data'),
            '{time}'            => $paymentResponse->get('orario'),
            '{authCode}'        => $paymentResponse->get('codAut'),
            '{secret}'          => $this->secret
        ));

        $generated = sha1($mac);
        $given     = $paymentResponse->get('mac');

        return $generated === $given;
    }
}