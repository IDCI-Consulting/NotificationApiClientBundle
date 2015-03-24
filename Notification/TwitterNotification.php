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

class TwitterNotification extends AbstractNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setOptional(array(
                'consumerKey',
                'consumerSecret',
                'oauthAccessToken',
                'oauthAccessTokenSecret',
            ))
            ->setRequired(array(
                'status',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataFrom()
    {
        return array(
            'consumerKey'            => $this->parameters['consumerKey'],
            'consumerSecret'         => $this->parameters['consumerSecret'],
            'oauthAccessToken'       => $this->parameters['oauthAccessToken'],
            'oauthAccessTokenSecret' => $this->parameters['oauthAccessTokenSecret'],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getDataContent()
    {
        return array(
            'status' => $this->parameters['status']
        );
    }
}
