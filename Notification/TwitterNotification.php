<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class TwitterNotification implements NotificationInterface
{
    /**
     * @Assert\NotBlank()
     */
    protected $to;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * @see NotificationInterface
     */
    public function getType()
    {
        return 'twitter';
    }

    /**
     * @see NotificationInterface
     */
    public function getQueryString()
    {
    }

    /**
     * Set To
     *
     * @param string $to
     * @return TwitterNotification
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return TwitterNotification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
