<?php

namespace Eo\KeyClient\Tests;

use Eo\KeyClient\Client;
use Eo\KeyClient\Payment\PaymentRequest;
use Eo\KeyClient\Notification\S2SNotification;
use Eo\KeyClient\Notification\MailNotification;
use Eo\KeyClient\Notification\RedirectNotification;

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

        $payment = new PaymentRequest(5000, 'EUR', time(), 'http://example.com/canceled');
        $payment->setSession('123456');
        $payment->setLanguage('ITA-ENG');

        $redirect = new RedirectNotification('http://example.com/completed');
        $payment->addNotification($redirect);

        $client->createPaymentUrl($payment);
    }
}