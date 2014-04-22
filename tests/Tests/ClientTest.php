<?php

namespace Eo\KeyClient\Tests;

use Eo\KeyClient\Client;
use Eo\KeyClient\Payment\PaymentRequest;

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
    public function testClient()
    {
        $client = new Client($this->alias, $this->secret);

        $payment = new PaymentRequest(5000, 'EUR', time(), 'http://example.com/completed', 'http://example.com/canceled');
        $payment->setSession('123456');
        $payment->setLanguage('ITA-ENG');

        echo $client->createPaymentUrl($payment);
    }

    /**
     * {@inheritdoc}
     */
    public function testSignature()
    {
        $client  = new Client('123', 'esempiodicalcolomac');
        $payment = new PaymentRequest(1, 'EUR', 'testCILME534', 'http://example.com/completed', 'http://example.com/canceled');
        $sha1    = $client->signPayment($payment);

        $this->assertEquals('992e40c00b79ad1a6e4a5a8c61e776e696796a79', $sha1);
    }
}