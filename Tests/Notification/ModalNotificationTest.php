<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class ModalNotificationTest extends \PHPUnit_Framework_TestCase
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
            'modal' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\ModalNotification'),
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
            'modal',
            array(
                'level'   => 'info',
                'title'   => 'title',
                'message' => 'message',
            )
        );

        $this->assertEquals($notification->getDataType(), 'modal_info');
        $this->assertEquals($notification->getDataMessage(), array(
            'title'   => 'title',
            'message' => 'message',
            'actions' => array(),
            'class'   => null
        ));
    }
}