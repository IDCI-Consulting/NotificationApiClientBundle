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

class SmsNotification implements QueryStringableInterface
{
    /**
     * @Assert\NotBlank()
     */
    protected $to;

    /**
     * @Assert\NotBlank()
     */
    protected $from;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

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
                'from' => $this->getFrom()
            ),
            'content' => array(
                'message' => $this->getMessage()
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

    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }
}
