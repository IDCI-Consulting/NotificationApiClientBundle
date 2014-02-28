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
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $senderFirstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $senderLastName;

    /**
     * @Assert\NotBlank()
     */
    protected $senderAddress;

    /**
     * @Assert\NotBlank()
     */
    protected $senderPostalCode;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $senderCity;

    /**
     * @Assert\NotBlank()
     * @Assert\Country
     */
    protected $senderCountry;

    /**
     * @see QueryStringableInterface
     */
    public function toQueryString()
    {
        return json_encode(array(
            'to' => array(
                'firstName'  => $this->getFirstName(),
                'lastName'   => $this->getLastName(),
                'address'    => $this->getAddress(),
                'postalCode' => $this->getPostalCode(),
                'city'       => $this->getCity(),
                'country'    => $this->getCountry()
            ),
            'from' => array(
                'senderFirstName'  => $this->getSenderFirstName(),
                'senderLastName'   => $this->getSenderLastName(),
                'senderAddress'    => $this->getSenderAddress(),
                'senderPostalCode' => $this->getSenderPostalCode(),
                'senderCity'       => $this->getSenderCity(),
                'senderCountry'    => $this->getSenderCountry()
            ),
            'content' => array(
                'message' => $this->getMessage()
            )
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

    public function setSenderFirstName($senderFirstName)
    {
        $this->senderFirstName = $senderFirstName;

        return $this;
    }

    public function getSenderFirstName()
    {
        return $this->senderFirstName;
    }

    public function setSenderLastName($senderLastName)
    {
        $this->senderLastName = $senderLastName;

        return $this;
    }

    public function getSenderLastName()
    {
        return $this->senderLastName;
    }

    public function setSenderAddress($senderAddress)
    {
        $this->senderAddress = $senderAddress;

        return $this;
    }

    public function getSenderAddress()
    {
        return $this->senderAddress;
    }

    public function setSenderPostalCode($senderPostalCode)
    {
        $this->senderPostalCode = $senderPostalCode;

        return $this;
    }

    public function getSenderPostalCode()
    {
        return $this->senderPostalCode;
    }

    public function setSenderCity($senderCity)
    {
        $this->senderCity = $senderCity;

        return $this;
    }

    public function getSenderCity()
    {
        return $this->senderCity;
    }

    public function setSenderCountry($senderCountry)
    {
        $this->senderCountry = $senderCountry;

        return $this;
    }

    public function getSenderCountry()
    {
        return $this->senderCountry;
    }
}
