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

class SmsOcitoNotification extends AbstractApiNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setDefaults(array(
                'userName'           => null, //max = "30"
                'password'           => null, //max = "30"
                'senderAppId'        => null, //max = "10"
                'senderId'           => null, //max = "11"
                'flag'               => null, //max = "10"
                'priority'           => 'L',
                'timeToLiveDuration' => null, //max = "30"
                'timeToSendDuration' => null, //max = "30"
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
