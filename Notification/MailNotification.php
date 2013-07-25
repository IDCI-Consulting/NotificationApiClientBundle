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

class MailNotification implements NotificationInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $lastName;

    /**
     * @Assert\NotBlank()
     */
    protected $address;

    /**
     * @Assert\NotBlank()
     */
    protected $postalCode;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $city;

    /**
     * @Assert\NotBlank()
     * @Assert\Country
     */
    protected $country;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * @see NotificationInterface
     */
    public function notify()
    {
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return MailNotification
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return MailNotification
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return MailNotification
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return MailNotification
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return MailNotification
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return MailNotification
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return MailNotification
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