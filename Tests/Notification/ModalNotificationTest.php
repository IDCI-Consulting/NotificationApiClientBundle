<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class ModalNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetter()
    {
        $notification = NotificationFactory::create(
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
        ));
    }
}