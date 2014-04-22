<?php

namespace Eo\KeyClient\Tests\Notification;

use Eo\KeyClient\Notification\MailNotification;
use Eo\KeyClient\Notification\RedirectNotification;
use Eo\KeyClient\Notification\S2SNotification;

/**
 * NotificationTest
 */
class NotificationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * {@inheritdoc}
     */
    public function testMail()
    {
        $notification = new MailNotification('hello@world.com');

        $this->assertEquals('mail', $notification->getKey());
        $this->assertEquals('hello@world.com', $notification->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function testRedirect()
    {
        $notification = new RedirectNotification('http://example.com/completed');

        $this->assertEquals('url', $notification->getKey());
        $this->assertEquals('http://example.com/completed', $notification->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function testS2S()
    {
        $notification = new S2SNotification('http://example.com/listener');

        $this->assertEquals('url_post', $notification->getKey());
        $this->assertEquals('http://example.com/listener', $notification->getValue());
    }
}