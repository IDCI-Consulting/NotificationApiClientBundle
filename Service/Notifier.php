<?php

/**
 * @author  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license GPL
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Service;

use Da\ApiClientBundle\Http\Rest\RestApiClientInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use IDCI\Bundle\NotificationApiClientBundle\Notification\AbstractNotification;

class Notifier
{
    /**
     * @var RestApiClientInterface
     */
    protected $apiClient;

    /**
     * @var string
     */
    protected $sourceName;

    /**
     * @var array
     */
    protected $notificationTypes;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var array
     */
    protected $notifications;

    /**
     * Constructor
     *
     * @param RestApiClientInterface $apiClient
     * @param string                 $sourceName
     * @param array                  $notificationTypes
     * @param SessionInterface       $session
     */
    public function __construct(
        RestApiClientInterface $apiClient,
        $sourceName,
        array $notificationTypes,
        SessionInterface $session
    )
    {
        $this->apiClient         = $apiClient;
        $this->sourceName        = $sourceName;
        $this->notificationTypes = $notificationTypes;
        $this->session           = $session;

        $this->initNotifications();
    }

    /**
     * Returns notifications
     *
     * @param string $category
     * @return array
     */
    public function getNotifications($category = null)
    {
        if (null === $category) {
            return $this->notifications;
        }

        if (!isset($this->notifications[$category])) {
            throw new \InvalidArgumentException(sprintf(
                'The given category "%s%" is undefined',
                $category
            ));
        }

        return $this->notifications[$category];
    }

    /**
     * Init notifications
     */
    protected function initNotifications()
    {
        $this->notifications = array(
            'api'     => array(),
            'session' => array()
        );
    }

    /**
     * Has source name
     *
     * @return boolean
     */
    public function hasSourceName()
    {
        return null !== $this->sourceName;
    }

    /**
     * Add Notification
     *
     * @param  string   $type
     * @param  array    $parameters
     * @return Notifier
     */
    public function addNotification($type, $parameters)
    {
        $notification = $this->createNotification($type, $parameters);

        $category = 'api';
        if ($notification instanceof \IDCI\Bundle\NotificationApiClientBundle\Notification\AbstractSessionNotification) {
            $category = 'session';
        }

        if (!isset($this->notifications[$category][$type])) {
            $this->notifications[$category][$type] = array();
        }

        $this->notifications[$category][$type][] = $notification;

        return $this;
    }

    /**
     * Create notification object by type.
     *
     * @param string $type       Notification type.
     * @param array  $parameters Notification parameters.
     *
     * @throw \InvalidArgumentException
     *
     * @return AbstractNotification
     */
    public function createNotification($type, $parameters)
    {
        if (!isset($this->notificationTypes[$type])) {
            throw new \InvalidArgumentException(sprintf(
                'The notification type "%s" is not defined.',
                $type
            ));
        }

        $notificationClassName = $this->notificationTypes[$type]['class'];

        return new $notificationClassName($parameters);
    }

    /**
     * Notify
     *
     * @throw Da\ApiClientBundle\Exception\ApiHttpResponseException
     */
    public function notify()
    {
        if (count($this->getNotifications('api')) > 0) {
            $this->apiClient->post(
                '/notifications',
                $this->buildNotificationApiQuery()
            );
        }

        if (count($this->getNotifications('session')) > 0) {
           $this->buildNotificationSession();
        }

        $this->initNotifications();
    }

    /**
     * Build notification api query
     *
     * @return array
     */
    public function buildNotificationApiQuery()
    {
        $query = array();
        foreach ($this->getNotifications('api') as $type => $notifications) {
            $query[$type] = self::queryStringify($notifications);
        }

        if ($this->hasSourceName()) {
            $query['sourceName'] = $this->sourceName;
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
        $data = array();
        foreach ($notifications as $k => $notification) {
            $data[] = $notification->normalize();
        }

        return json_encode($data);
    }

    /**
     * Build notification session
     */
    public function buildNotificationSession()
    {
        foreach ($this->getNotifications('session') as $type => $notifications) {
            foreach ($notifications as $notification) {
                $this->session->getFlashBag()->add(
                    $notification->getDataType(),
                    $notification->getDataMessage()
                );
            }
        }
    }
}
