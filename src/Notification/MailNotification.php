<?php

namespace Eo\KeyClient\Notification;

/**
 * MailNotification
 */
class MailNotification extends AbstractNotification
{
    /**
     * @var string
     */
    protected $mail;

    /**
     * Class constructor
     * 
     * @param string $mail The confirm receipt will be sent to this address
     */
    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return 'mail';
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->mail;
    }
}