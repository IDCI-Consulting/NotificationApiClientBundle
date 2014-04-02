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

class TwitterNotification extends AbstractNotification
{
    /**
     */
    protected $login;

    /**
     */
    protected $password;

    /**
     * @Assert\NotBlank()
     */
    protected $to;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * Set login
     *
     * @param  string $login
     * @return TwitterNotification
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return  string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param  string $password
     * @return TwitterNotification
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return  string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set to
     *
     * @param  string $to
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
            'from' => array(
                'login'    => $this->getLogin(),
                'password' => $this->getPassword()
            ),
            'to' => array(
                'to' => $this->getTo()
            ),
            'content' => array(
                'message'  => $this->getMessage()
            )
        );
    }
}
