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

class EmailNotification implements QueryStringableInterface
{
    /**
     * @Assert\NotBlank()
     */
    protected $to;

    /**
     */
    protected $cc;

    /**
     */
    protected $bcc;

    /**
     * @Assert\NotBlank()
     */
    protected $login;

    /**
     * @Assert\NotBlank()
     */
    protected $password;


    /**
     * @Assert\NotBlank()
     */
    protected $server;

    /**
     * @Assert\NotBlank()
     */
    protected $port;

    /**
     * @Assert\Choice(
     *      choices = {"ssl", "tsl"},
     *      message = "Choose a valid type of encryption"
     * )
     */
    protected $encryption;

    /**
     * @Assert\Choice(
     *      choices = {"yes", "no"},
     *      message = "Choose a valid option [yes/no]"
     * )
     */
    protected $isSecured;


    /**
     * @Assert\NotBlank()
     */
    protected $subject;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     */
    protected $htmlMessage;

    /**
     *
     */
    protected $attachments;

    /**
     * @see QueryStringableInterface
     */
    public function toQueryString()
    {
        return json_encode(array(
            'to' => array(
                'to'  => $this->getTo(),
                'cc'  => $this->getCc(),
                'bcc' => $this->getBcc()
            ),
            'from' => array(
                'login'      => $this->getLogin(),
                'password'   => $this->getPassword(),
                'server'     => $this->getServer(),
                'port'       => $this->getPort(),
                'encryption' => $this->hasEncryption(),
                'isSecured'  => $this->hasIsSecured()
            ),
            'content' => array(
                'subject'     => $this->getSubject(),
                'message'     => $this->getMessage(),
                'htmlMessage' => $this->getHtmlMessage(),
                'attachments' => $this->getAttachments()
            )
        ));
    }

    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    public function getServer()
    {
        return $this->server;
    }

    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setEncryption($encryption)
    {
        $this->encryption = $encryption;

        return $this;
    }

    public function hasEncryption()
    {
        return $this->encryption;
    }

    public function setIsSecured($isSecured)
    {
        $this->isSecured = $isSecured;

        return $this;
    }

    public function hasIsSecured()
    {
        return $this->isSecured;
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

    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    public function getCc()
    {
        return $this->cc;
    }

    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    public function getBcc()
    {
        return $this->bcc;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
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

    public function setHtmlMessage($html_message)
    {
        $this->htmlMessage = $html_message;

        return $this;
    }

    public function getHtmlMessage()
    {
        return $this->htmlMessage;
    }

    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }
}
