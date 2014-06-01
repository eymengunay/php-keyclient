<?php

namespace Eo\KeyClient\Tests\Payment;

use Eo\KeyClient\Payment\PaymentResponse;

/**
 * PaymentResponseTest
 */
class PaymentResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test missing
     *
     * @expectedException Eo\KeyClient\Exception\KeyClientException
     */
    public function testMissing()
    {
        $response = new PaymentResponse();
    }
}