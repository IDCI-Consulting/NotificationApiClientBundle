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

class MailNotification extends AbstractNotification
{
    /**
     * @Assert\Regex("/^\w+/")
     */
    protected $senderFirstName;

    /**
     * @Assert\Regex("/^\w+/")
     */
    protected $senderLastName;

    /**
     */
    protected $senderAddress;

    /**
     */
    protected $senderPostalCode;

    /**
     * @Assert\Regex("/^\w+/")
     */
    protected $senderCity;

    /**
     * @Assert\Country
     */
    protected $senderCountry;

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
     * Set senderFirstName
     *
     * @param  string $senderFirstName
     * @return MailNotification
     */
    public function setSenderFirstName($senderFirstName)
    {
        $this->senderFirstName = $senderFirstName;

        return $this;
    }

    public function getSenderFirstName()
    {
        return $this->senderFirstName;
    }

    /**
     * Set senderLastName
     *
     * @param  string $senderLastName
     * @return MailNotification
     */
    public function setSenderLastName($senderLastName)
    {
        $this->senderLastName = $senderLastName;

        return $this;
    }

    public function getSenderLastName()
    {
        return $this->senderLastName;
    }

    /**
     * Set senderAddress
     *
     * @param  string $senderAddress
     * @return MailNotification
     */
    public function setSenderAddress($senderAddress)
    {
        $this->senderAddress = $senderAddress;

        return $this;
    }

    public function getSenderAddress()
    {
        return $this->senderAddress;
    }

    /**
     * Set senderPostalCode
     *
     * @param  string $senderPostalCode
     * @return MailNotification
     */
    public function setSenderPostalCode($senderPostalCode)
    {
        $this->senderPostalCode = $senderPostalCode;

        return $this;
    }

    public function getSenderPostalCode()
    {
        return $this->senderPostalCode;
    }

    /**
     * Set senderCity
     *
     * @param  string $senderCity
     * @return MailNotification
     */
    public function setSenderCity($senderCity)
    {
        $this->senderCity = $senderCity;

        return $this;
    }

    public function getSenderCity()
    {
        return $this->senderCity;
    }

    /**
     * Set senderCountry
     *
     * @param  string $senderCountry
     * @return MailNotification
     */
    public function setSenderCountry($senderCountry)
    {
        $this->senderCountry = $senderCountry;

        return $this;
    }

    public function getSenderCountry()
    {
        return $this->senderCountry;
    }

    /**
     * Set firstName
     *
     * @param  string $firstName
     * @return MailNotification
     */
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

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array(
            'from' => array(
                'first_name'  => $this->getSenderFirstName(),
                'last_name'   => $this->getSenderLastName(),
                'address'     => $this->getSenderAddress(),
                'postal_code' => $this->getSenderPostalCode(),
                'city'        => $this->getSenderCity(),
                'country'     => $this->getSenderCountry()
            ),
            'to' => array(
                'first_name'  => $this->getFirstName(),
                'last_name'   => $this->getLastName(),
                'address'     => $this->getAddress(),
                'postal_code' => $this->getPostalCode(),
                'city'        => $this->getCity(),
                'country'     => $this->getCountry()
            ),
            'content' => array(
                'message' => $this->getMessage()
            )
        );
    }
}
