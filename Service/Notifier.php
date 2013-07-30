<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Service;

use Symfony\Component\Validator\ValidatorInterface;
use IDCI\Bundle\NotificationApiClientBundle\Exception\UnavailableNotificationDataException;
use IDCI\Bundle\NotificationApiClientBundle\HttpClient\RestHttpApiClientInterface;
use IDCI\Bundle\NotificationApiClientBundle\Factory\NotificationFactory;

class Notifier
{
    protected $validator;
    protected $apiClient;
    protected $notifications;

    /**
     * Constructor
     *
     * @params ValidatorInterface $validator
     * @params RestHttpApiClientInterface $apiClient
     */
    public function __construct(ValidatorInterface $validator, RestHttpApiClientInterface $apiClient)
    {
        $this->validator = $validator;
        $this->apiClient = $apiClient;
        $this->notifications = array();
    }

    /**
     * Get Validator
     *
     * @return Symfony\Component\Validator\Validator
     */
    protected function getValidator()
    {
        return $this->validator;
    }


    /**
     * Get ApiClient
     *
     * @return RestHttpApiClientInterface
     */
    protected function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Get Notifications
     *
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Add Notification
     *
     * @param string $type
     * @param array|string $parameters
     * @return Notifier
     * @throw UnavailableNotificationDataException
     */
    public function addNotification($type, $parameters)
    {
        if(!is_array($parameters)) {
            $parameters = json_decode($parameters, true);
        }

        if(!isset($this->notifications[$type])) {
            $this->notifications[$type] = array();
        }

        $notification = NotificationFactory::create($type, $parameters);
        $errorList = $this->getValidator()->validate($notification);
        if(count($errorList) > 0) {
            throw new UnavailableNotificationDataException($errorList);
        }
        $this->notifications[$type][] = $notification;

        return $this;
    }

    /**
     * Notify
     *
     * @return string
     */
    public function notify()
    {
        $response = $this->getApiClient()->post(
            '/notifications/add',
            $this->buildNotificationQuery()
        );
        $this->purgeNotifications();

        return $response;
    }

    /**
     * Build Notification Query
     *
     * @return string
     */
    public function buildNotificationQuery()
    {
        $queryString = '';
        foreach($this->getNotifications() as $type => $notifications) {
            $queryString .= sprintf('%s=%s',
                $type,
                self::queryStringify($notifications)
            );
        }

        return $queryString;
    }

    /**
     * Query stringify notifications
     *
     * @param array $notifications
     * @return string
     */
    public static function queryStringify($notifications)
    {
        $stringify = '[';
        foreach($notifications as $notification) {
            $stringify .= $notification->toQueryString();
        }
        $stringify .= ']';

        return $stringify;
    }

    /**
     * Purge Notifications
     */
    public function purgeNotifications()
    {
        $this->notifications = array();
    }
}

