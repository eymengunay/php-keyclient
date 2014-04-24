<?php

namespace Eo\KeyClient\Payment;

/**
 * PaymentResponse
 */
class PaymentResponse extends AbstractPayment implements PaymentResponseInterface
{
    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $authCode;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $time;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $cc;

    /**
     * @var string
     */
    protected $nationality;

    /**
     * @var string
     */
    protected $ccExpiresAt;

    /**
     * @var string
     */
    protected $result;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $message;

    /**
     * Set region
     *
     * @param  string $region
     * @return self
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set authCode
     *
     * @param  string $authCode
     * @return self
     */
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;

        return $this;
    }

    /**
     * Get authCode
     *
     * @return string
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * Set alias
     *
     * @param  string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set result
     *
     * @param  string $result
     * @return self
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set nationality
     *
     * @param  string $nationality
     * @return self
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set cc
     *
     * @param  string $cc
     * @return self
     */
    public function setCC($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return string
     */
    public function getCC()
    {
        return $this->cc;
    }

    /**
     * Set ccExpiresAt
     *
     * @param  string $ccExpiresAt
     * @return self
     */
    public function setCCExpiresAt($ccExpiresAt)
    {
        $this->ccExpiresAt = $ccExpiresAt;

        return $this;
    }

    /**
     * Get ccExpiresAt
     *
     * @return string
     */
    public function getCCExpiresAt()
    {
        return $this->ccExpiresAt;
    }

    /**
     * Set type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set brand
     *
     * @param  string $brand
     * @return self
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set signature
     *
     * @param  string $signature
     * @return self
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set time
     *
     * @param  string $time
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set date
     *
     * @param  string $date
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lastName
     *
     * @param  string $lastName
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param  string $firstName
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}