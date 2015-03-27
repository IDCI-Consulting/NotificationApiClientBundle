<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Service;

class NotifierTest extends \PHPUnit_Framework_TestCase
{
    public function testAddNotification()
    {
        $apiClient = $this->getMockBuilder('Da\ApiClientBundle\Http\Rest\RestApiClientInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $session = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\SessionInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $notifier = new \IDCI\Bundle\NotificationApiClientBundle\Service\Notifier(
            $apiClient,
            'dummySource',
            $session
        );

        $notifier
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

        $this->assertEquals(count($notifier->getNotifications('api')), 1);
        $this->assertEquals(count($notifier->getNotifications('session')), 1);
    }

    public function testBuildNotificationApiQuery()
    {
        $apiClient = $this->getMockBuilder('Da\ApiClientBundle\Http\Rest\RestApiClientInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $session = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\SessionInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $notifier = new \IDCI\Bundle\NotificationApiClientBundle\Service\Notifier(
            $apiClient,
            'dummySource',
            $session
        );

        $notifier
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

        $query = $notifier->buildNotificationApiQuery();
        $this->assertEquals($query['sourceName'], 'dummySource');
        $this->assertEquals($query['email'], '[{"notifierAlias":"alias","from":[],"to":{"to":"to"},"content":{"subject":"Subject","message":"Message"}}]');
    }
}