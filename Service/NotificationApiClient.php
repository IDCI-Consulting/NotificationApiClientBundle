<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Service;

use IDCI\Bundle\NotificationApiClientBundle\Notification;

class NotificationApiClient
{
    protected $validator;
    protected $apiClient;

    /**
     * Constructor
     */
    public function __construct($validator, RestHttpApiClientInterface $apiClient)
    {
        $this->validator = $validator;
    }

    /**
     * Get validator
     *
     * @return Symfony\Component\Validator\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Notify
     *
     * @param array $notificationParameters
     */
    public function notify(array $notificationParameters)
    {
        $queryParameters = array();
        foreach($notificationParameters as $type => $params) {
            $notification = NotificationFactory::create($type, $params);
            // TODO: validate
            $queryParameters[] = $notification->getQueryParameters();
        }

        $this->getApiClient()->post($queryParameters);
    }


}

