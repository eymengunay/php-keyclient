<?php

namespace Eo\KeyClient\Tests\Payment;

use Eo\KeyClient\Payment\PaymentRequest;

/**
 * PaymentRequestTest
 */
class PaymentRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PaymentRequest
     */
    protected $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new PaymentRequest(1, 'EUR', 'transactionCode', 'http://example.com/completed', 'http://example.com/canceled');
    }

    /**
     * Test toArray
     */
    public function testToArray()
    {
        $this->assertEquals($this->request->toArray(), array(
            'importo' => 1,
            'divisa' => 'EUR',
            'codTrans' => 'transactionCode',
            'url' => 'http://example.com/completed',
            'url_back' => 'http://example.com/canceled',
        ));
    }

    /**
     * Test getter
     */
    public function testGetter()
    {
        $this->assertFalse($this->request->get('this-doesnt-exists', false));
    }
}