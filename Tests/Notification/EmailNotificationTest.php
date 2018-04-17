<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class EmailNotificationTest extends \PHPUnit_Framework_TestCase
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
            'email',
            array(
                'notifierAlias' => 'alias',
                'transport'     => 'smtp',
                'from'          => 'from@test.fr',
                'fromName'      => 'from TEST',
                'replyTo'       => 'reply@test.fr',
                'server'        => 'localhost',
                'login'         => 'login',
                'password'      => 'password',
                'port'          => 1337,
                'encryption'    => 'ssl',
                'to'            => 'to',
                'cc'            => 'cc',
                'bcc'           => 'bcc',
                'subject'       => 'Subject',
                'message'       => 'Message',
                'htmlMessage'   => '<h1>HTML message</h1>',
            )
        );

        $this->assertEquals(
            $notification->normalize(),
            array(
                'notifierAlias' => 'alias',
                'from'          => array(
                    'transport'  => 'smtp',
                    'from'       => 'from@test.fr',
                    'fromName'   => 'from TEST',
                    'replyTo'    => 'reply@test.fr',
                    'server'     => 'localhost',
                    'login'      => 'login',
                    'password'   => 'password',
                    'port'       => 1337,
                    'encryption' => 'ssl'
                ),
                'to'            => array(
                    'to'  => 'to',
                    'cc'  => 'cc',
                    'bcc' => 'bcc',
                ),
                'content'       => array(
                    'subject'     => 'Subject',
                    'message'     => 'Message',
                    'htmlMessage' => '<h1>HTML message</h1>',
                )
            )
        );
    }
}
