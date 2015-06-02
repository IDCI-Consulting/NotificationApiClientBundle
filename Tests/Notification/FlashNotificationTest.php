<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class FlashNotificationTest extends \PHPUnit_Framework_TestCase
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
            'flash' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\FlashNotification'),
        );

        $this->notifier = new Notifier(
            $apiClient,
            'dummySource',
            $notificationTypes,
            $session
        );
    }

    public function testGetter()
    {
        $notification = $this->notifier->createNotification(
            'flash',
            array(
                'level'   => 'info',
                'message' => 'message',
            )
        );

        $this->assertEquals($notification->getDataType(), 'flash_info');
        $this->assertEquals($notification->getDataMessage(), 'message');
    }
}