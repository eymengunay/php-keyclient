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
        $this->alias  = getenv('KEYCLIENT_ALIAS') ?: 'payment_testm_urlmac';
        $this->secret = getenv('KEYCLIENT_SECRET') ?: 'esempiodicalcolomac';
    }

    /**
     * Test create payment url
     */
    public function testCreatePaymentUrl()
    {
        $client = new Client($this->alias, $this->secret);

        $payment = new PaymentRequest(1, 'EUR', 'transactionCode', 'http://example.com/completed', 'http://example.com/canceled');
        $payment->set('session_id', '123456');
        $payment->set('languageId', 'ITA-ENG');

        $url = $client->createPaymentUrl($payment);

        $this->assertEquals(
            $url,
            'https://ecommerce.nexi.it/ecomm/ecomm/DispatcherServlet?importo=1&divisa=EUR&codTrans=transactionCode&url=http%3A%2F%2Fexample.com%2Fcompleted&url_back=http%3A%2F%2Fexample.com%2Fcanceled&session_id=123456&languageId=ITA-ENG&alias=payment_testm_urlmac&mac=abb95ee2a0c7017d046624a2e08816efe0c2e389'
        );
    }

    /**
     * Test parse payment response
     */
    public function testParsePaymentResponse()
    {
        $_GET['session_id'] = '';
        $_GET['regione'] = 'EUROPE';
        $_GET['codAut'] = 'TESTOK';
        $_GET['alias'] = 'payment_testm_urlmac';
        $_GET['orario'] = '060954';
        $_GET['data'] = '20140424';
        $_GET['mac'] = 'bfb7d9ce16c038fd06272a3f4aeb1ecffe0f2bff';
        $_GET['importo'] = '1';
        $_GET['$BRAND'] = 'MasterCard';
        $_GET['tipoProdotto'] = 'MASTERCARD - CREDIT - N';
        $_GET['cognome'] = 'Test';
        $_GET['languageId'] = '';
        $_GET['pan'] = '525599XXXXXX9992';
        $_GET['nazionalita'] = 'ITA';
        $_GET['divisa'] = 'EUR';
        $_GET['email'] = 'test@test.com';
        $_GET['scadenza_pan'] = '201407';
        $_GET['esito'] = 'OK';
        $_GET['codTrans'] = '53588e64566af10c9a0041ce';
        $_GET['nome'] = 'Test';
        $_GET['messaggio'] = 'Message OK';

        $client   = new Client('123', 'esempiodicalcolomac');
        $response = $client->parsePaymentResponse();

        $this->assertEquals($_GET, $response->toArray());
    }

    /**
     * Test calculate mac
     */
    public function testCalculateMac()
    {
        $client  = new Client('123', 'esempiodicalcolomac');
        $payment = new PaymentRequest(1, 'EUR', 'testCILME534', 'http://example.com/completed', 'http://example.com/canceled');
        $sha1    = $client->calculateMac($payment);

        $this->assertEquals('992e40c00b79ad1a6e4a5a8c61e776e696796a79', $sha1);
    }

    /**
     * Test verify mac
     */
    public function testVerifyMac()
    {
        $client = new Client('123', 'esempiodicalcolomac');

        $_GET['session_id'] = '';
        $_GET['regione'] = 'EUROPE';
        $_GET['codAut'] = null;
        $_GET['alias'] = 'payment_testm_urlmac';
        $_GET['orario'] = '154631';
        $_GET['data'] = '20140422';
        $_GET['mac'] = 'e9826dde381f20de678a54ac61b1f75d805f964f';
        $_GET['importo'] = 5000;
        $_GET['$BRAND'] = 'MasterCard';
        $_GET['cognome'] = 'Test';
        $_GET['languageId'] = '';
        $_GET['divisa'] = 'EUR';
        $_GET['email'] = 'test@test.com';
        $_GET['esito'] = 'KO';
        $_GET['codTrans'] = '5356728f566af114300041d6';
        $_GET['nome'] = 'Test';
        $_GET['messaggio'] = 'Some error';

        $response = new PaymentResponse();
        $true = $client->verifyMac($response);
        $this->assertTrue($true);

        $_GET['codTrans'] = '1234567890abcdef01234567';
        $this->setExpectedException('Eo\KeyClient\Exception\KeyClientException');

        $response = $client->parsePaymentResponse();
    }
}