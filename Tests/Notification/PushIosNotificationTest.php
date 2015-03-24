<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class PushIosNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $notification = NotificationFactory::create(
            'push_ios',
            array(
                'notifierAlias' => 'alias',
                'deviceToken'   => 'deviceToken',
                'message'       => 'message',
            )
        );

        $this->assertEquals(
            $notification->toArray(),
            array(
                'notifierAlias' => 'alias',
                'to'            => array(
                    'deviceToken' => 'deviceToken',
                ),
                'content'       => array(
                    'message' => 'message',
                )
            )
        );
    }
}