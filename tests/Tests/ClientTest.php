<?php

namespace Eo\KeyClient\Tests;

use Eo\KeyClient\Client;
use Eo\KeyClient\Payment\PaymentRequest;
use Eo\KeyClient\Payment\PaymentResponse;

/**
 * ClientTest
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->alias  = getenv('KEYCLIENT_ALIAS') ?: 'alias';
        $this->secret = getenv('KEYCLIENT_SECRET') ?: 'esempiodicalcolomac';
    }

    /**
     * {@inheritdoc}
     */
    public function testCreatePaymentUrl()
    {
        $client = new Client($this->alias, $this->secret);

        $payment = new PaymentRequest(5000, 'EUR', time(), 'http://example.com/completed', 'http://example.com/canceled');
        $payment->setSession('123456');
        $payment->setLanguage('ITA-ENG');
        $payment->setMail('hello@example.com');
        $payment->setS2S('http://example.com/s2s');

        $client->createPaymentUrl($payment);
    }

    /**
     * {@inheritdoc}
     */
    public function testParsePaymentResponse()
    {
        $_REQUEST['session_id'] = '';
        $_REQUEST['regione'] = 'EUROPE';
        $_REQUEST['codAut'] = 'TESTOK';
        $_REQUEST['alias'] = 'payment_testm_urlmac';
        $_REQUEST['orario'] = '060954';
        $_REQUEST['data'] = '20140424';
        $_REQUEST['mac'] = 'bfb7d9ce16c038fd06272a3f4aeb1ecffe0f2bff';
        $_REQUEST['importo'] = '1';
        $_REQUEST['$BRAND'] = 'MasterCard';
        $_REQUEST['tipoProdotto'] = 'MASTERCARD - CREDIT - N';
        $_REQUEST['cognome'] = 'Test';
        $_REQUEST['languageId'] = '';
        $_REQUEST['pan'] = '525599XXXXXX9992';
        $_REQUEST['nazionalita'] = 'ITA';
        $_REQUEST['divisa'] = 'EUR';
        $_REQUEST['email'] = 'test@test.com';
        $_REQUEST['scadenza_pan'] = '201407';
        $_REQUEST['esito'] = 'OK';
        $_REQUEST['codTrans'] = '53588e64566af10c9a0041ce';
        $_REQUEST['nome'] = 'Test';
        $_REQUEST['messaggio'] = 'Message OK';

        $client   = new Client('123', 'esempiodicalcolomac');
        $response = $client->parsePaymentResponse();
    }

    /**
     * {@inheritdoc}
     */
    public function testCalculateSignature()
    {
        $client  = new Client('123', 'esempiodicalcolomac');
        $payment = new PaymentRequest(1, 'EUR', 'testCILME534', 'http://example.com/completed', 'http://example.com/canceled');
        $sha1    = $client->calculateSignature($payment);

        $this->assertEquals('992e40c00b79ad1a6e4a5a8c61e776e696796a79', $sha1);
    }

    /**
     * {@inheritdoc}
     */
    public function testVerifySignature()
    {
        $client   = new Client('123', 'esempiodicalcolomac');
        $response = new PaymentResponse();
        $response
            ->setTransactionCode('5356728f566af114300041d6')
            ->setResult('KO')
            ->setAmount(5000)
            ->setCurrency('EUR')
            ->setDate('20140422')
            ->setTime('154631')
            ->setSignature('e9826dde381f20de678a54ac61b1f75d805f964f')
        ;
        $bool = $client->verifySignature($response);

        $this->assertTrue($bool);
    }
}