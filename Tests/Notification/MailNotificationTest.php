<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class MailNotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalize()
    {
        $notification = NotificationFactory::create(
            'mail',
            array(
                'notifierAlias'  => 'alias',
                'fromFirstName'  => 'fromFirstName',
                'fromLastName'   => 'fromLastName',
                'fromAddress'    => 'fromAddress',
                'fromPostalCode' => 'fromPostalCode',
                'fromCity'       => 'fromCity',
                'fromCountry'    => 'fromCountry',
                'toFirstName'    => 'toFirstName',
                'toLastName'     => 'toLastName',
                'toAddress'      => 'toAddress',
                'toPostalCode'   => 'toPostalCode',
                'toCity'         => 'toCity',
                'toCountry'      => 'toCountry',
                'message'        => 'message',
            )
        );

        $this->assertEquals(
            $notification->normalize(),
            array(
                'notifierAlias' => 'alias',
                'from'          => array(
                    'firstName'  => 'fromFirstName',
                    'lastName'   => 'fromLastName',
                    'address'    => 'fromAddress',
                    'postalCode' => 'fromPostalCode',
                    'city'       => 'fromCity',
                    'country'    => 'fromCountry',
                ),
                'to'            => array(
                    'firstName'  => 'toFirstName',
                    'lastName'   => 'toLastName',
                    'address'    => 'toAddress',
                    'postalCode' => 'toPostalCode',
                    'city'       => 'toCity',
                    'country'    => 'toCountry',
                ),
                'content'       => array(
                    'message' => 'message',
                )
            )
        );
    }
}