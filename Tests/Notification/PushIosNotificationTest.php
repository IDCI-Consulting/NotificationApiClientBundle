<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class PushIosNotificationTest extends \PHPUnit_Framework_TestCase
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
            'push_ios' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\PushIosNotification'),
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
            'push_ios',
            array(
                'notifierAlias' => 'alias',
                'deviceToken'   => 'deviceToken',
                'message'       => 'message',
            )
        );

        $this->assertEquals(
            $notification->normalize(),
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