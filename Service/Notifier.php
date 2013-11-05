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
    protected $sourceName;
    protected $notifications;

    /**
     * Constructor
     *
     * @param ValidatorInterface $validator
     * @param RestHttpApiClientInterface $apiClient
     * @param string $sourceName
     */
    public function __construct(ValidatorInterface $validator, RestHttpApiClientInterface $apiClient, $sourceName)
    {
        $this->validator = $validator;
        $this->apiClient = $apiClient;
        $this->sourceName = $sourceName;
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
     * Get the notifier source name
     *
     * @return string
     */
    public function getSourceName()
    {
        return $this->sourceName;
    }

    /**
     * Has source name
     *
     * @return boolean
     */
    public function hasSourceName()
    {
        return null !== $this->getSourceName();
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
            '/notifications',
            $this->buildNotificationQuery()
        );
        $this->purgeNotifications();

        return $response;
    }

    /**
     * Build Notification Query
     *
     * @return array
     */
    public function buildNotificationQuery()
    {
        $query = array();
        foreach($this->getNotifications() as $type => $notifications) {
            $query[$type] = self::queryStringify($notifications);
        }
        if($this->hasSourceName()) {
            $query['source_name'] = $this->getSourceName();
        }

        return $query;
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

