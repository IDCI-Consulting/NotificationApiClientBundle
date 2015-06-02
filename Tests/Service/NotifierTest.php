<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Service;
use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class NotifierTest extends \PHPUnit_Framework_TestCase
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
            'email' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\EmailNotification'),
            'flash' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\FlashNotification')
        );

        $this->notifier = new Notifier(
            $apiClient,
            'dummySource',
            $notificationTypes,
            $session
        );
    }

    public function testAddNotification()
    {
        $this->notifier
            ->addNotification(
                'email',
                array(
                    'notifierAlias' => 'alias',
                    'to'            => 'to',
                    'subject'       => 'Subject',
                    'message'       => 'Message',
                )
            )
            ->addNotification(
                'flash',
                array(
                    'level'   => 'info',
                    'message' => 'message',
                )
            )
        ;

        $this->assertEquals(count($this->notifier->getNotifications('api')), 1);
        $this->assertEquals(count($this->notifier->getNotifications('session')), 1);
    }

    public function testBuildNotificationApiQuery()
    {
        $this->notifier
            ->addNotification(
                'email',
                array(
                    'notifierAlias' => 'alias',
                    'to'            => 'to',
                    'subject'       => 'Subject',
                    'message'       => 'Message',
                )
            )
            ->addNotification(
                'flash',
                array(
                    'level'   => 'info',
                    'message' => 'message',
                )
            )
        ;

        $query = $this->notifier->buildNotificationApiQuery();
        $this->assertEquals($query['sourceName'], 'dummySource');
        $this->assertEquals($query['email'], '[{"notifierAlias":"alias","from":[],"to":{"to":"to"},"content":{"subject":"Subject","message":"Message"}}]');
    }
}