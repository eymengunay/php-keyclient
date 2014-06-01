<?php

namespace Eo\KeyClient\Payment;

use Eo\KeyClient\Exception\KeyClientException;

/**
 * AbstractPayment
 */
abstract class AbstractPayment
{
    /**
     * @var array
     */
    protected $params = array();

    /**
     * Class constructor
     *
     * @param array $params
     */
    public function __construct(array $params = array())
    {
        $missing = array();
        foreach ($this->getRequiredParams() as $key) {
            if (array_key_exists($key, $params) === false) {
                array_push($missing, $key);
            }
        }

        if (empty($missing) === false) {
            throw new KeyClientException('Missing parameters passed: ' . implode(', ', $missing));
        }

        $this->params = $params;
    }

    /**
     * Configure params
     *
     * @return array
     */
    abstract protected function getRequiredParams();

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->params;
    }

    /**
     * Setter
     *
     * @param  string $key
     * @param  mixed  $val
     * @return self
     */
    public function set($key, $val)
    {
        $this->params[$key] = $val;

        return $this;
    }

    /**
     * Getter
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->params)) {
            return $this->params[$key];
        }

        return $default;
    }
}