<?php

namespace Eo\KeyClient\Notification;

/**
 * RedirectNotification
 */
class RedirectNotification extends AbstractNotification
{
    /**
     * @var string
     */
    protected $redirect;

    /**
     * Class constructor
     * 
     * @param string $redirect The confirm receipt will be sent to this address
     */
    public function __construct($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return 'url';
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->redirect;
    }
}