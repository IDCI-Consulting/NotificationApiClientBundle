<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class SmsOcitoNotificationTest extends \PHPUnit_Framework_TestCase
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
            'sms_ocito' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\SmsOcitoNotification'),
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