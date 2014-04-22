<?php

namespace Eo\KeyClient\Notification;

/**
 * AbstractNotification
 */
abstract class AbstractNotification implements NotificationInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function getKey();

    /**
     * {@inheritdoc}
     */
    abstract public function getValue();
}