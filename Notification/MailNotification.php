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
    protected $fromFirstName;

    /**
     * @Assert\Regex("/^\w+/")
     */
    protected $fromLastName;

    /**
     */
    protected $fromAddress;

    /**
     */
    protected $fromPostalCode;

    /**
     * @Assert\Regex("/^\w+/")
     */
    protected $fromCity;

    /**
     * @Assert\Country
     */
    protected $fromCountry;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $toFirstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $toLastName;

    /**
     * @Assert\NotBlank()
     */
    protected $toAddress;

    /**
     * @Assert\NotBlank()
     */
    protected $toPostalCode;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     */
    protected $toCity;

    /**
     * @Assert\NotBlank()
     * @Assert\Country
     */
    protected $toCountry;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * SetFromFirstName
     *
     * @param  string $firstName
     * @return MailNotification
     */
    public function setFromFirstName($firstName)
    {
        $this->fromFirstName = $firstName;

        return $this;
    }

    /**
     * GetFromFirstName
     *
     * @return string
     */
    public function getFromFirstName()
    {
        return $this->fromFirstName;
    }

    /**
     * SetFromLastName
     *
     * @param  string $lastName
     * @return MailNotification
     */
    public function setFromLastName($lastName)
    {
        $this->fromLastName = $lastName;

        return $this;
    }

    /**
     * GetFromLastName
     *
     * @return string
     */
    public function getFromLastName()
    {
        return $this->fromLastName;
    }

    /**
     * SetFromAddress
     *
     * @param  string $address
     * @return MailNotification
     */
    public function setFromAddress($address)
    {
        $this->fromAddress = $address;

        return $this;
    }

    /**
     * GetFromAddress
     *
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * SetFromPostalCode
     *
     * @param  string $postalCode
     * @return MailNotification
     */
    public function setFromPostalCode($postalCode)
    {
        $this->fromPostalCode = $postalCode;

        return $this;
    }

    /**
     * SetFromPostalCode
     *
     * @return string
     */
    public function getFromPostalCode()
    {
        return $this->fromPostalCode;
    }

    /**
     * SetFromCity
     *
     * @param  string $city
     * @return MailNotification
     */
    public function setFromCity($city)
    {
        $this->fromCity = $city;

        return $this;
    }

    /**
     * GetFromCity
     *
     * @return string
     */
    public function getFromCity()
    {
        return $this->fromCity;
    }

    /**
     * SetFromCountry
     *
     * @param  string $country
     * @return MailNotification
     */
    public function setFromCountry($country)
    {
        $this->fromCountry = $country;

        return $this;
    }

    /**
     * GetFromCountry
     *
     * @return string
     */
    public function getFromCountry()
    {
        return $this->fromCountry;
    }

    /**
     * SetToFirstName
     *
     * @param  string $firstName
     * @return MailNotification
     */
    public function setToFirstName($firstName)
    {
        $this->toFirstName = $firstName;

        return $this;
    }

    /**
     * GetToFirstName
     *
     * @return string
     */
    public function getToFirstName()
    {
        return $this->toFirstName;
    }

    /**
     * SetToLastName
     *
     * @param  string $lastName
     * @return MailNotification
     */
    public function setToLastName($lastName)
    {
        $this->toLastName = $lastName;

        return $this;
    }

    /**
     * GetToLastName
     *
     * @return string
     */
    public function getToLastName()
    {
        return $this->toLastName;
    }

    /**
     * SetToAddress
     *
     * @param  string $address
     * @return MailNotification
     */
    public function setToAddress($address)
    {
        $this->toAddress = $address;

        return $this;
    }

    /**
     * GetToAddress
     *
     * @return string
     */
    public function getToAddress()
    {
        return $this->toAddress;
    }

    /**
     * SetToPostalCode
     *
     * @param  string $postalCode
     * @return MailNotification
     */
    public function setToPostalCode($postalCode)
    {
        $this->toPostalCode = $postalCode;

        return $this;
    }

    /**
     * GetToPostalCode
     *
     * @return string
     */
    public function getToPostalCode()
    {
        return $this->toPostalCode;
    }

    /**
     * SetToCity
     *
     * @param  string $city
     * @return MailNotification
     */
    public function setToCity($city)
    {
        $this->toCity = $city;

        return $this;
    }

    /**
     * GetToCity
     *
     * @return string
     */
    public function getToCity()
    {
        return $this->toCity;
    }

    /**
     * SetToCountry
     *
     * @param  string $country
     * @return MailNotification
     */
    public function setToCountry($country)
    {
        $this->toCountry = $country;

        return $this;
    }

    /**
     * GetToCountry
     *
     * @return string
     */
    public function getToCountry()
    {
        return $this->toCountry;
    }

    /**
     * SetMessage
     *
     * @param  string $message
     * @return MailNotification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * GetMessage
     *
     * @return string
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
                'firstName'  => $this->getFromFirstName(),
                'lastName'   => $this->getFromLastName(),
                'address'    => $this->getFromAddress(),
                'postalCode' => $this->getFromPostalCode(),
                'city'       => $this->getFromCity(),
                'country'    => $this->getFromCountry()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'firstName'  => $this->getToFirstName(),
            'lastName'   => $this->getToLastName(),
            'address'    => $this->getToAddress(),
            'postalCode' => $this->getToPostalCode(),
            'city'       => $this->getToCity(),
            'country'    => $this->getToCountry()
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
