<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Service;

use IDCI\Bundle\NotificationApiClientBundle\Exception\UnavailableNotificationDataException;
use IDCI\Bundle\NotificationApiClientBundle\HttpClient\RestHttpApiClientInterface;

class Notifier
{
    protected $validator;
    protected $apiClient;

    /**
     * Constructor
     *
     * @params Symfony\Component\Validator\Validator $validator
     * @params RestHttpApiClientInterface $apiClient
     */
    public function __construct(Symfony\Component\Validator\Validator $validator, RestHttpApiClientInterface $apiClient)
    {
        $this->validator = $validator;
    }

    /**
     * Get Validator
     *
     * @return Symfony\Component\Validator\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }


    /**
     * Get ApiClient
     *
     * @return RestHttpApiClientInterface
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Notify
     *
     * @param array $notificationParameters
     * @throw UnavailableNotificationDataException
     */
    public function notify(array $notificationParameters)
    {
        $queryParameters = array();
        foreach($notificationParameters as $type => $params) {
            $notification = NotificationFactory::create($type, $params);
            // TODO: validate
            $erroList = $this->getValidator->validate($notification);
            if(count($erroList) > 0) {
                throw new UnavailableNotificationDataException(print_r($errorList, true));
            }

            $queryParameters[] = $notification->getQueryParameters();
        }

        $this->getApiClient()->post($queryParameters);
    }
}

