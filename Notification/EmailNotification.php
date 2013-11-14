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
    protected $attachements;

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
            'content' => array(
                'subject'      => $this->getSubject(),
                'message'      => $this->getMessage(),
                'htmlMessage'  => $this->getHtmlMessage(),
                'attachements' => $this->getAttachements()
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

    public function setAttachements($attachements)
    {
        $this->attachements = $attachements;

        return $this;
    }

    public function getAttachements()
    {
        return $this->attachements;
    }
}
