<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class TwitterNotificationTest extends \PHPUnit_Framework_TestCase
{
    protected $notifier;

    protected function setUp()
    {
        $apiClient = $this->getMockBuilder('Da\ApiClientBundle\Http\Rest\RestApiClientInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $session = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\SessionInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $notificationTypes = array(
            'twitter' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\TwitterNotification'),
        );

        $this->notifier = new Notifier(
            $apiClient,
            'dummySource',
            $notificationTypes,
            $session
        );
    }

    public function testNormalize()
    {
        $notification = $this->notifier->createNotification(
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