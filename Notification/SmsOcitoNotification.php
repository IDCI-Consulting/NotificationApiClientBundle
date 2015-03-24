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

class SmsOcitoNotification extends AbstractNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setOptional(array(
                'userName',     //max = "30"
                'password',     //max = "30"
                'senderAppId',  //max = "10"
                'senderId',     //max = "11"
                'flag',         //max = "10"
                'priority',
                'timeToLiveDuration', //max = "30"
                'timeToSendDuration', //max = "30"
            ))
            ->setRequired(array(
                'phoneNumber',  //max = "30"
                'message',      //max = "70"
            ))
            ->setAllowedValues(array(
                'priority' => array('H', 'L')
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataFrom()
    {
        return array(
            'userName'           => $this->parameters['userName'],
            'password'           => $this->parameters['password'],
            'senderAppId'        => $this->parameters['senderAppId'],
            'senderId'           => $this->parameters['senderId'],
            'flag'               => $this->parameters['flag'],
            'priority'           => $this->parameters['priority'],
            'timeToLiveDuration' => $this->parameters['timeToLiveDuration'],
            'timeToSendDuration' => $this->parameters['timeToSendDuration'],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'phoneNumber' => $this->parameters['phoneNumber']
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
