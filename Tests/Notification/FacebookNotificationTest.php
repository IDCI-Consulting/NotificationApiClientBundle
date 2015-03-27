<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class FacebookNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalize()
    {
        $notification = NotificationFactory::create(
            'facebook',
            array(
                'notifierAlias' => 'alias',
                'login'         => 'login',
                'password'      => 'password',
                'to'            => 'to',
                'message'       => 'message',
            )
        );

        $this->assertEquals(
            $notification->normalize(),
            array(
                'notifierAlias' => 'alias',
                'from'          => array(
                    'login'    => 'login',
                    'password' => 'password',
                ),
                'to'            => array(
                    'to' => 'to',
                ),
                'content'       => array(
                    'message' => 'message',
                )
            )
        );
    }
}