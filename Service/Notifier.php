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
    const NOTIFICATION_CATEGORY_API = 'api';
    const NOTIFICATION_CATEGORY_SESSION = 'session';

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
     * @param string $type
     *
     * @return array
     */
    protected function getNotifications($category = null, $type = null)
    {
        if (null === $category) {
            return $this->notifications;
        }

        if (!isset($this->notifications[$category])) {
            throw new \InvalidArgumentException(sprintf(
                'The given category "%s" is undefined',
                $category
            ));
        }

        if (null === $type) {
            return $this->notifications[$category];
        }

        if (!isset($this->notifications[$category][$type])) {
            throw new \InvalidArgumentException(sprintf(
                'The given type "%s" is undefined in the category "%s"',
                $type,
                $category
            ));
        }

        return $this->notifications[$category][$type];
    }

    /**
     * Returns api notifications
     *
     * @param string $type
     *
     * @return array
     */
    public function getApiNotifications($type = null)
    {
        return $this->getNotifications(self::NOTIFICATION_CATEGORY_API, $type);
    }

    /**
     * Returns session notifications
     *
     * @param string $type
     *
     * @return array
     */
    public function getSessionNotifications($type = null)
    {
        return $this->getNotifications(self::NOTIFICATION_CATEGORY_SESSION, $type);
    }

    /**
     * Init notifications
     */
    protected function initNotifications()
    {
        $this->notifications = array(
            self::NOTIFICATION_CATEGORY_API => array(),
            self::NOTIFICATION_CATEGORY_SESSION => array(),
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
     * @param string $type
     * @param array  $parameters
     * @param array  $files
     *
     * @return Notifier
     */
    public function addNotification($type, array $parameters, array $files = array())
    {
        $notification = $this->createNotification($type, $parameters);

        if ($notification instanceof \IDCI\Bundle\NotificationApiClientBundle\Notification\AbstractSessionNotification) {
            $this->addSessionNotification($type, $notification);
        } elseif ($notification instanceof \IDCI\Bundle\NotificationApiClientBundle\Notification\AbstractApiNotification) {
            $this->addApiNotification($type, $notification);
        }

        return $this;
    }

    /**
     * Add Api Notification
     *
     * @param string                $type
     * @param AbstractNotification  $notification
     */
    protected function addApiNotification($type, AbstractNotification $notification)
    {
        if (!isset($this->notifications[self::NOTIFICATION_CATEGORY_API][$type])) {
            $this->notifications[self::NOTIFICATION_CATEGORY_API][$type] = array();
        }

        $this->notifications[self::NOTIFICATION_CATEGORY_API][$type][] = $notification;
    }

    /**
     * Add Session Notification
     *
     * @param string                $type
     * @param AbstractNotification  $notification
     */
    protected function addSessionNotification($type, AbstractNotification $notification)
    {
        if (!isset($this->notifications[self::NOTIFICATION_CATEGORY_SESSION][$type])) {
            $this->notifications[self::NOTIFICATION_CATEGORY_SESSION][$type] = array();
        }

        $this->notifications[self::NOTIFICATION_CATEGORY_SESSION][$type][] = $notification;
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
        $apiCount = $this->sendApiNotifications();
        $sessionCount = $this->sendSessionNotifications();

        $this->initNotifications();

        return $apiCount + $sessionCount;
    }

    /**
     * Send api notifications
     *
     * @return int The number of notifications sended
     */
    protected function sendApiNotifications()
    {
        $count = 0;

        foreach ($this->getApiNotifications() as $type => $notifications) {
            foreach ($notifications as $notification) {
                $normalizedData = $notification->normalize();

                $postData = array(
                    'type' => $type,
                    'data' => json_encode($notification->normalize()),
                );

                if ($this->hasSourceName()) {
                    $postData['sourceName'] = $this->sourceName;
                }

                $this->apiClient->post('/notifications', $postData);
                $count++;
            }
        }

        return $count;
    }

    /**
     * Send session notifications
     *
     * @return int The number of notifications setted
     */
    protected function sendSessionNotifications()
    {
        $count = 0;

        foreach ($this->getSessionNotifications() as $type => $notifications) {
            foreach ($notifications as $notification) {
                $this->session->getFlashBag()->add(
                    $notification->getDataType(),
                    $notification->getDataMessage()
                );
                $count++;
            }
        }

        return $count;
    }
}
