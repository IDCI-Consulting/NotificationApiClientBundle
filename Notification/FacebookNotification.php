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

class FacebookNotification implements QueryStringableInterface
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
     * @Assert\NotBlank()
     */
    protected $senderLogin;

    /**
     * @Assert\NotBlank()
     */
    protected $senderPassword;

    /**
     * @see QueryStringableInterface
     */
    public function toQueryString()
    {
        return json_encode(array(
            'to' => array(
                'to' => $this->getTo()
            ),
            'from' => array(
                'senderLogin'    => $this->getSenderLogin(),
                'senderPassword' => $this->getSenderPassword()
            ),
            'content' => array(
                'message'  => $this->getMessage()
            )
        ));
    }

    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setSenderLogin($senderLogin)
    {
        $this->senderLogin = $senderLogin;

        return $this;
    }

    public function getSenderLogin()
    {
        return $this->senderLogin;;
    }

    public function setSenderPassword($senderPassword)
    {
        $this->senderPassword = $senderPassword;

        return $this;
    }

    public function getSenderPassword()
    {
        return $this->senderPassword;
    }

}
