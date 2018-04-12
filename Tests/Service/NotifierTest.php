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

        $sessionStorage = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $attributeBag = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $flashBag = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $flashBag
            ->expects($this->any())
            ->method('add')
            ->will($this->returnValue(true))
        ;

        $session = $this->getMockBuilder('\Symfony\Component\HttpFoundation\Session\Session')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $session
            ->expects($this->any())
            ->method('getFlashBag')
            ->will($this->returnValue($flashBag))
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

    public function testHasSourceName()
    {
        $this->assertTrue($this->notifier->hasSourceName());
    }

    public function testCreateNotification()
    {
        $notification = $this->notifier->createNotification(
            'email',
            array(
                'notifierAlias' => 'alias1',
                'to'            => 'to1',
                'subject'       => 'Subject1',
                'message'       => 'Message1',
            )
        );

        $this->assertInstanceOf(
            'IDCI\Bundle\NotificationApiClientBundle\Notification\EmailNotification',
            $notification
        );

        try {
            $notification = $this->notifier->createNotification('dummy', array());

            $this->fail("Expected exception not thrown");
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals("The notification type \"dummy\" is not defined.", $e->getMessage());
        }
    }

    public function testAddNotification()
    {
        $this->notifier
            ->addNotification(
                'email',
                array(
                    'notifierAlias' => 'alias1',
                    'to'            => 'to1',
                    'subject'       => 'Subject1',
                    'message'       => 'Message1',
                )
            )
            ->addNotification(
                'flash',
                array(
                    'level'   => 'info',
                    'message' => 'message1',
                )
            )
        ;

        $this->assertEquals(count($this->notifier->getApiNotifications()), 1);
        $this->assertEquals(count($this->notifier->getApiNotifications('email')), 1);
        $this->assertEquals(count($this->notifier->getSessionNotifications()), 1);
        $this->assertEquals(count($this->notifier->getSessionNotifications('flash')), 1);

        $this->notifier
            ->addNotification(
                'email',
                array(
                    'notifierAlias' => 'alias2',
                    'to'            => 'to2',
                    'subject'       => 'Subject2',
                    'message'       => 'Message2',
                )
            )
            ->addNotification(
                'flash',
                array(
                    'level'   => 'info',
                    'message' => 'message2',
                )
            )
        ;

        $this->assertEquals(count($this->notifier->getApiNotifications()), 1);
        $this->assertEquals(count($this->notifier->getApiNotifications('email')), 2);
        $this->assertEquals(count($this->notifier->getSessionNotifications()), 1);
        $this->assertEquals(count($this->notifier->getSessionNotifications('flash')), 2);
    }

    public function tesGetApiNotifications()
    {
        $this->notifier
            ->addNotification(
                'email',
                array(
                    'notifierAlias' => 'alias1',
                    'to'            => 'to1',
                    'subject'       => 'Subject1',
                    'message'       => 'Message1',
                )
            )
        ;

        $this->assertEquals(count($this->notifier->getApiNotifications()), 1);
        $this->assertEquals(count($this->notifier->getApiNotifications('email')), 1);

        try {
            $this->notifier->getApiNotifications('dummy');
            $this->fail("Expected exception not thrown");
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals("The given type \"dummy\" is undefined in the category \"api\"", $e->getMessage());
        }
    }

    public function tesGetSessionNotifications()
    {
        $this->notifier
            ->addNotification(
                'flash',
                array(
                    'level'   => 'info',
                    'message' => 'message',
                )
            )
        ;

        $this->assertEquals(count($this->notifier->getSessionNotifications()), 1);
        $this->assertEquals(count($this->notifier->getSessionNotifications('flash')), 1);

        try {
            $this->notifier->getSessionNotifications('dummy');
            $this->fail("Expected exception not thrown");
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals("The given type \"dummy\" is undefined in the category \"session\"", $e->getMessage());
        }
    }

    public function testNotify()
    {
        $this->notifier
            ->addNotification(
                'email',
                array(
                    'notifierAlias' => 'alias1',
                    'to'            => 'to1',
                    'subject'       => 'Subject1',
                    'message'       => 'Message1',
                )
            )
            ->addNotification(
                'email',
                array(
                    'notifierAlias' => 'alias2',
                    'to'            => 'to2',
                    'subject'       => 'Subject2',
                    'message'       => 'Message2',
                )
            )
            ->addNotification(
                'flash',
                array(
                    'level'   => 'info',
                    'message' => 'message1',
                )
            )
            ->addNotification(
                'flash',
                array(
                    'level'   => 'info',
                    'message' => 'message2',
                )
            )
        ;

        $this->assertEquals(count($this->notifier->getApiNotifications()), 1);
        $this->assertEquals(count($this->notifier->getApiNotifications('email')), 2);
        $this->assertEquals(count($this->notifier->getSessionNotifications()), 1);
        $this->assertEquals(count($this->notifier->getSessionNotifications('flash')), 2);

        $count = $this->notifier->notify();

        $this->assertEquals(count($this->notifier->getApiNotifications()), 0);
        $this->assertEquals(count($this->notifier->getSessionNotifications()), 0);
        $this->assertEquals($count, 4);
    }
}
