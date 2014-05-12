<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class PushAndroidNotification extends AbstractNotification
{
    /**
     * @Assert\NotBlank()
     */
    protected $deviceToken;

    /**
     */
    protected $apiKey;

    /**
     * @Assert\NotBlank()
     */
    protected $message;


    /**
     * Set device token
     *
     * @param string $deviceToken
     * @return PushAndroidNotification
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;

        return $this;
    }

    /**
     * Get device token
     *
     * @return string
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }
    /**
     * Set api key
     *
     * @param string $apiKey
     * @return PushAndroidNotification
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get api key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return PushAndroidNotification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return  string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataFrom()
    {
        return array(
          'apiKey' => $this->getApiKey()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'deviceToken' => $this->getDeviceToken()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataContent()
    {
        return array(
            'message' => $this->getMessage()
        );
    }
}
