<?php

namespace Eo\KeyClient\Notification;

/**
 * S2SNotification
 */
class S2SNotification extends AbstractNotification
{
    /**
     * @var string
     */
    protected $s2s;

    /**
     * Class constructor
     * 
     * @param string $s2s POST confirmation address
     */
    public function __construct($s2s)
    {
        $this->s2s = $s2s;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return 'url_post';
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->s2s;
    }
}