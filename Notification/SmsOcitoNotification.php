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
     *      maxMessage = "Your userName cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $userName;

    /**
     * @Assert\Length(
     *      max = "30",
     *      maxMessage = "Your password cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $password;

    /**
     * @Assert\Length(
     *      max = "10",
     *      maxMessage = "Your senderAppId cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $senderAppId;

    /**
     * @Assert\Length(
     *      max = "11",
     *      maxMessage = "Your senderId cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $senderId;

    /**
     * @Assert\Length(
     *      max = "10",
     *      maxMessage = "Your flag cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $flag;

    /**
     * @Assert\Choice(choices = {"H", "L"}, message = "Choisissez une priorité valide.")
     * @Assert\Length(
     *      max = "1",
     *      maxMessage = "Your priority cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $priority;

    /**
     * @Assert\Length(
     *      max = "30",
     *      maxMessage = "Your timeToLiveDuration cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $timeToLiveDuration;

    /**
     * @Assert\Length(
     *      max = "30",
     *      maxMessage = "Your timeToSendDuration cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $timeToSendDuration;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = "30",
     *      maxMessage = "Your phoneNumber cannot be longer than  {{ limit }} characters length"
     * )
     */
    protected $phoneNumber;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = "70",
     *      maxMessage = "Your message cannot be longer than  {{ limit }} characters length"
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
     * SetTimeToLiveDuration
     *
     * @param integer $timeToLiveDuration
     * @return SmsOcitoNotification
     */
    public function setTimeToLiveDuration($timeToLiveDuration)
    {
        $this->timeToLiveDuration = $timeToLiveDuration;

        return $this;
    }

    /**
     * GetTimeToLiveDuration
     *
     * @return integer
     */
    public function getTimeToLiveDuration()
    {
        return $this->timeToLiveDuration;
    }

    /**
     * SetTimeToSendDuration
     *
     * @param integer $timeToSendDuration
     * @return SmsOcitoNotification
     */
    public function setTimeToSendDuration($timeToSendDuration)
    {
        $this->timeToSendDuration = $timeToSendDuration;

        return $this;
    }

    /**
     * GetTimeToSendDuration
     *
     * @return integer
     */
    public function getTimeToSendDuration()
    {
        return $this->timeToSendDuration;
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
          'userName'           => $this->getUserName(),
          'password'           => $this->getPassword(),
          'senderAppId'        => $this->getSenderAppId(),
          'senderId'           => $this->getSenderId(),
          'flag'               => $this->getFlag(),
          'priority'           => $this->getPriority(),
          'timeToLiveDuration' => $this->getTimeToLiveDuration(),
          'timeToSendDuration' => $this->getTimeToSendDuration()
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
