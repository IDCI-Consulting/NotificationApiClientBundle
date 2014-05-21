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

class PushIOSNotification extends AbstractNotification
{
    /**
     * @Assert\NotBlank()
     */
    protected $deviceToken;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max = "218",
     *     maxMessage = "Your message cannot be longer than {{ limit }} characters length"
     * )
     */
    protected $message;

    /**
     * Set device token
     *
     * @param string $deviceToken
     * @return PushIOSNotificationNotification
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;

        return $this;
    }

    /**
     * Get device token
     *
     * @return string $deviceToken
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return PushIOSNotificationNotification
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
        return array();
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
