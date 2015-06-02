<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Tests\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Service\Notifier;

class MailNotificationTest extends \PHPUnit_Framework_TestCase
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
            'mail' => array('class' => 'IDCI\Bundle\NotificationApiClientBundle\Notification\MailNotification'),
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