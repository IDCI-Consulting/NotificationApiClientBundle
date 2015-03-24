<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MailNotification extends AbstractNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setOptional(array(
                'fromFirstName',
                'fromLastName',
                'fromAddress',
                'fromPostalCode',
                'fromCity',
                'fromCountry',
            ))
            ->setRequired(array(
                'toFirstName',
                'toLastName',
                'toAddress',
                'toPostalCode',
                'toCity',
                'toCountry',
                'message',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataFrom()
    {
        return array(
            'firstName'  => $this->parameters['fromFirstName'],
            'lastName'   => $this->parameters['fromLastName'],
            'address'    => $this->parameters['fromAddress'],
            'postalCode' => $this->parameters['fromPostalCode'],
            'city'       => $this->parameters['fromCity'],
            'country'    => $this->parameters['fromCountry']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'firstName'  => $this->parameters['toFirstName'],
            'lastName'   => $this->parameters['toLastName'],
            'address'    => $this->parameters['toAddress'],
            'postalCode' => $this->parameters['toPostalCode'],
            'city'       => $this->parameters['toCity'],
            'country'    => $this->parameters['toCountry']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataContent()
    {
        return array(
            'message' => $this->parameters['message']
        );
    }
}
