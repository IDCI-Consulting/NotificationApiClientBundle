<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class PushAndroidNotificationTest extends \PHPUnit_Framework_TestCase
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
            'push_android' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\PushAndroidNotification'),
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