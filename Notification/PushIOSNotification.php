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
     */
    protected $path;

    /**
     */
    protected $file;

    /**
     */
    protected $passphrase;

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
     * Set certificate
     *
     * @param string $path
     * @return PushIOSNotificationNotification
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return PushIOSNotificationNotification
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set passphrase
     *
     * @param string $passphrase
     * @return IOSPushNotificationNotification
     */
    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;

        return $this;
    }

    /**
     * Get passphrase
     *
     * @return string $passphrase
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return IOSPushNotificationNotification
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
            'certificate' => array(
                "path" => $this->getPath(),
                "file" => $this->getFile()
            ),
            'passphrase'  => $this->getPassphrase()
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
