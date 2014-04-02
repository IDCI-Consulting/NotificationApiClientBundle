<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class SmsNotification extends AbstractNotification
{
    /**
     */
    protected $phoneNumber;

    /**
     * @Assert\NotBlank()
     */
    protected $to;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * Set phoneNumber
     *
     * @param  int $phoneNumber
     * @return SmsNotification
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Get phone number
     *
     * @return  int
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set to
     *
     * @param  string $to
     * @return SmsNotification
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return  string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return SmsNotification
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
    public function getData()
    {
        return array(
            'notifierAlias' => array(
                'notifierAlias' => $this->getNotifierAlias()
            ),
            'phone_number' => array(
                'phone_number'  => $this->getPhoneNumber()
            ),
            'to' => array(
                'to' => $this->getTo()
            ),
            'content' => array(
                'message' => $this->getMessage()
            )
        );
    }
}
