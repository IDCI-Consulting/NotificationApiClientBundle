<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class PushAndroidNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalize()
    {
        $notification = NotificationFactory::create(
            'push_android',
            array(
                'notifierAlias' => 'alias',
                'apiKey'        => 'apiKey',
                'deviceToken'   => 'deviceToken',
                'message'       => 'message',
            )
        );

        $this->assertEquals(
            $notification->normalize(),
            array(
                'notifierAlias' => 'alias',
                'from'          => array(
                    'apiKey' => 'apiKey',
                ),
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