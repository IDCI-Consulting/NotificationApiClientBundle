<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class FacebookNotificationTest extends \PHPUnit_Framework_TestCase
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
            'facebook' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\FacebookNotification'),
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