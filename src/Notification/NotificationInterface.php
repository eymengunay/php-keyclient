<?php

namespace Eo\KeyClient\Notification;

/**
 * NotificationInterface
 */
interface NotificationInterface
{
    /**
     * Get key
     * 
     * @return string
     */
    public function getKey();

    /**
     * Get value
     * 
     * @return mixed
     */
    public function getValue();
}