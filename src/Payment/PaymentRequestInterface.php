<?php

namespace Eo\KeyClient\Payment;

/**
 * PaymentRequestInterface
 */
interface PaymentRequestInterface
{
    /**
     * Get amount
     * 
     * @return int
     */
    public function getAmount();

    /**
     * Get currency
     * 
     * @return string
     */
    public function getCurrency();

    /**
     * Get transactionCode
     * 
     * @return string
     */
    public function getTransactionCode();
}