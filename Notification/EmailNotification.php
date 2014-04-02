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

class EmailNotification extends AbstractNotification
{
    /**
     * @Assert\Choice(
     *      choices = {"smtp","sendmail", "mail"},
     *      message = "Choose a valid transport."
     * )
     */
    protected $transport;

    /**
     */
    protected $from;

    /**
     */
    protected $server;

    /**
     */
    protected $login;

    /**
     */
    protected $password;

    /**
     * @Assert\Type(
     *    type="integer",
     *    message="The value {{ value}} is not in type {{ type }}"
     * )
     */
    protected $port;

    /**
     * @Assert\Choice(
     *      choices = {"null","ssl", "tsl"},
     *      message = "Choose a valid type of encryption"
     * )
     */
    protected $encryption;

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
    protected $subject;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     */
    protected $htmlMessage;

    /**
     */
    protected $attachments;

    /**
     * Set transport
     *
     * @param  string $transport
     * @return AbstractNotification
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return  string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set from
     *
     * @param string $from
     * @return AbstractNotification
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return  string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set server
     *
     * @param  string $server
     * @return AbstractNotification
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return  string
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set login
     *
     * @param  string $login
     * @return AbstractNotification
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
     * @return AbstractNotification
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
     * Set port
     *
     * @param  int $port
     * @return AbstractNotification
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return  int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set encryption
     *
     * @param  string $encryption
     * @return AbstractNotification
     */
    public function setEncryption($encryption)
    {
        $this->encryption = $encryption;

        return $this;
    }

    /**
     * Has encryption
     *
     * @return  string
     */
    public function hasEncryption()
    {
        return $this->encryption;
    }

    /**
     * Set to
     *
     * @param  string $to
     * @return AbstractNotification
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
     * Set cc
     *
     * @param  string $cc
     * @return AbstractNotification
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return  string
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set bcc
     *
     * @param  string $bcc
     * @return AbstractNotification
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * Get bcc
     *
     * @return  string
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Set subject
     *
     * @param  string $subject
     * @return AbstractNotification
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return  string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return AbstractNotification
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
     * Set html message
     *
     * @param  string $htmlMessage
     * @return AbstractNotification
     */
    public function setHtmlMessage($htmlMessage)
    {
        $this->htmlMessage = $htmlMessage;

        return $this;
    }

    /**
     * Get html message
     *
     * @return  string
     */
    public function getHtmlMessage()
    {
        return $this->htmlMessage;
    }

    /**
     * Set attachments
     *
     * @param  string $attachments
     * @return AbstractNotification
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Get attachments
     *
     * @return  string
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array(
            'from' => array(
                'transport'  => $this->getTransport(),
                'from'       => $this->getFrom(),
                'server'     => $this->getServer(),
                'login'      => $this->getLogin(),
                'password'   => $this->getPassword(),
                'port'       => $this->getPort(),
                'encryption' => $this->hasEncryption()
            ),
            'to' => array(
                'to'  => $this->getTo(),
                'cc'  => $this->getCc(),
                'bcc' => $this->getBcc()
            ),
            'content' => array(
                'subject'     => $this->getSubject(),
                'message'     => $this->getMessage(),
                'htmlMessage' => $this->getHtmlMessage(),
                'attachments' => $this->getAttachments()
            )
        );
    }
}
