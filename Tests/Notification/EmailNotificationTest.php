<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class EmailNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalize()
    {
        $notification = NotificationFactory::create(
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
                'attachments'   => array()
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
                    'attachments' => array()
                )
            )
        );
    }
}