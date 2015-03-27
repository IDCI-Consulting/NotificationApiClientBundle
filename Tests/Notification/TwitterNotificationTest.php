<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class TwitterNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalize()
    {
        $notification = NotificationFactory::create(
            'twitter',
            array(
                'notifierAlias'          => 'alias',
                'consumerKey'            => 'consumerKey',
                'consumerSecret'         => 'consumerSecret',
                'oauthAccessToken'       => 'oauthAccessToken',
                'oauthAccessTokenSecret' => 'oauthAccessTokenSecret',
                'status'                 => 'status',
            )
        );

        $this->assertEquals(
            $notification->normalize(),
            array(
                'notifierAlias' => 'alias',
                'from'          => array(
                    'consumerKey'            => 'consumerKey',
                    'consumerSecret'         => 'consumerSecret',
                    'oauthAccessToken'       => 'oauthAccessToken',
                    'oauthAccessTokenSecret' => 'oauthAccessTokenSecret',
                ),
                'content'       => array(
                    'status' => 'status',
                )
            )
        );
    }
}