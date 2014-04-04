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
    protected $fromPhoneNumber;

    /**
     * @Assert\NotBlank()
     */
    protected $toPhoneNumber;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * SetFromPhoneNumber
     *
     * @param  integer $phoneNumber
     * @return SmsNotification
     */
    public function setFromPhoneNumber($phoneNumber)
    {
        $this->fromPhoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * GetFromPhoneNumber
     *
     * @return integer
     */
    public function getFromPhoneNumber()
    {
        return $this->fromPhoneNumber;
    }

    /**
     * SetToPhoneNumber
     *
     * @param  integer $phoneNumber
     * @return SmsNotification
     */
    public function setToPhoneNumber($phoneNumber)
    {
        $this->toPhoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * GetToPhoneNumber
     *
     * @return integer
     */
    public function getToPhoneNumber()
    {
        return $this->toPhoneNumber;
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
    public function getDataFrom()
    {
        return array(
          'phoneNumber' => $this->getFromPhoneNumber()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'phoneNumber' => $this->getToPhoneNumber()
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
