<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class FlashNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetter()
    {
        $notification = NotificationFactory::create(
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