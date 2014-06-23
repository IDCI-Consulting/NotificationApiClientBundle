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

class SmsOcitoNotification extends AbstractNotification
{

    /**
     * @Assert\Length(
     *      max = "30",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $userName;

    /**
     * @Assert\Length(
     *      max = "30",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $password;

    /**
     * @Assert\Length(
     *      max = "10",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $senderAppId;

    /**
     * @Assert\Length(
     *      max = "11",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $senderId;

    /**
     * @Assert\Length(
     *      max = "10",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $flag;

    /**
     * @Assert\Choice(choices = {"H", "L"}, message = "Choisissez une priorité valide.")
     * @Assert\Length(
     *      max = "1",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $priority;

    /**
     */
    protected $timeToLiveTimeout;

    /**
     */
    protected $timeToSendTimeout;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = "30",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $phoneNumber;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = "70",
     *      maxMessage = "Votre message ne doit pas excéder {{ limit }} caractères"
     * )
     */
    protected $message;

    /**
     * SetUserName
     *
     * @param string $userName
     * @return SmsOcitoNotification
     */
    public function setUsername($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * GetUserName
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->userName;
    }

    /**
     * SetPassword
     *
     * @param string $password
     * @return SmsOcitoNotification
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * GetPassword
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * SetSenderAppId
     *
     * @param string $senderAppId
     * @return SmsOcitoNotification
     */
    public function setSenderAppId($senderAppId)
    {
        $this->senderAppId = $senderAppId;

        return $this;
    }

    /**
     * GetSenderAppId
     *
     * @return string
     */
    public function getSenderAppId()
    {
        return $this->senderAppId;
    }

    /**
     * SetSenderId
     *
     * @param string $senderId
     * @return SmsOcitoNotification
     */
    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;

        return $this;
    }

    /**
     * GetSenderId
     *
     * @return string
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * SetFlag
     *
     * @param string $flag
     * @return SmsOcitoNotification
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * GetFlag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * SetPriority
     *
     * @param string $priority
     * @return SmsOcitoNotification
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * GetPriority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * SetTimeToLiveTimeout
     *
     * @param integer $timeToLiveTimeout
     * @return SmsOcitoNotification
     */
    public function setTimeToLiveTimeout($timeToLiveTimeout)
    {
        $this->timeToLiveTimeout = $timeToLiveTimeout;

        return $this;
    }

    /**
     * GetTimeToLiveTimeout
     *
     * @return integer
     */
    public function getTimeToLiveTimeout()
    {
        return $this->timeToLiveTimeout;
    }

    /**
     * SetTimeToSendTimeout
     *
     * @param integer $timeToSendTimeout
     * @return SmsOcitoNotification
     */
    public function setTimeToSendTimeout($timeToSendTimeout)
    {
        $this->timeToSendTimeout = $timeToSendTimeout;

        return $this;
    }

    /**
     * GetTimeToSendTimeout
     *
     * @return integer
     */
    public function getTimeToSendTimeout()
    {
        return $this->timeToSendTimeout;
    }

    /**
     * SetPhoneNumber
     *
     * @param  string $phoneNumber
     * @return SmsOcitoNotification
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * GetPhoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return SmsOcitoNotification
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
          'userName'          => $this->getUserName(),
          'password'          => $this->getPassword(),
          'senderAppId'       => $this->getSenderAppId(),
          'senderId'          => $this->getSenderId(),
          'flag'              => $this->getFlag(),
          'priority'          => $this->getPriority(),
          'timeToSendTimeout' => $this->getTimeToSendTimeout(),
          'timeToLiveTimeout' => $this->getTimeToLiveTimeout()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'phoneNumber' => $this->getPhoneNumber()
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
