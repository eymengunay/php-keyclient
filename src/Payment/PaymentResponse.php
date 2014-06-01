<?php

namespace Eo\KeyClient\Payment;

use Eo\KeyClient\Exception\KeyClientException;
use Symfony\Component\HttpFoundation\Request;

/**
 * PaymentResponse
 */
class PaymentResponse extends AbstractPayment implements PaymentResponseInterface
{
    /**
     * Class constructor
     *
     * @param Request $request
     */
    public function __construct(Request $request = null)
    {
        if (is_null($request)) {
            $request = Request::createFromGlobals();
        }

        parent::__construct($request->query->all());
    }

    /**
     * {@inheritdoc}
     */
    protected function getRequiredParams()
    {
        return array(
            'session_id',
            'codAut',
            'alias',
            'orario',
            'data',
            'mac',
            'importo',
            '$BRAND',
            'cognome',
            'languageId',
            'divisa',
            'email',
            'esito',
            'codTrans',
            'nome',
            'messaggio'
        );
    }
}