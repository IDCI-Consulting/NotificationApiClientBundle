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

class MailNotification implements QueryStringableInterface
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
     * @see QueryStringableInterface
     */
    public function toQueryString()
    {
        return json_encode(array(
            'to' => array(
                'firstName' => $this->getFirstName(),
                'lastName' => $this->getLastName(),
                'address' => $this->getAddress(),
                'postalCode' => $this->getPostalCode(),
                'city' => $this->getCity(),
                'country' => $this->getCountry()
            ),
            'content' => $this->getMessage()
        ));
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
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
}
