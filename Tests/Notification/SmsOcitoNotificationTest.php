<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class SmsOcitoNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalize()
    {
        $notification = NotificationFactory::create(
            'sms_ocito',
            array(
                'notifierAlias'      => 'alias',
                'userName'           => 'userName',
                'password'           => 'password',
                'senderAppId'        => 'senderAppId',
                'senderId'           => 'senderId',
                'flag'               => 'flag',
                'priority'           => 'priority',
                'timeToLiveDuration' => 'timeToLiveDuration',
                'timeToSendDuration' => 'timeToSendDuration',
                'priority'           => 'H',
                'phoneNumber'        => 'phoneNumber',
                'message'            => 'message',
            )
        );

        $this->assertEquals(
            $notification->normalize(),
            array(
                'notifierAlias' => 'alias',
                'from'          => array(
                    'userName'           => 'userName',
                    'password'           => 'password',
                    'senderAppId'        => 'senderAppId',
                    'senderId'           => 'senderId',
                    'flag'               => 'flag',
                    'priority'           => 'priority',
                    'timeToLiveDuration' => 'timeToLiveDuration',
                    'timeToSendDuration' => 'timeToSendDuration',
                    'priority'           => 'H',
                ),
                'to'            => array(
                    'phoneNumber' => 'phoneNumber',
                ),
                'content'       => array(
                    'message' => 'message',
                )
            )
        );
    }
}