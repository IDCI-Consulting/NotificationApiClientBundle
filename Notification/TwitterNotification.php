<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\OptionsResolver\OptionsResolver;

class TwitterNotification extends AbstractApiNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolver $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setDefaults(array(
                'consumerKey' => null,
                'consumerSecret' => null,
                'oauthAccessToken' => null,
                'oauthAccessTokenSecret' => null,
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
            'consumerKey' => $this->parameters['consumerKey'],
            'consumerSecret' => $this->parameters['consumerSecret'],
            'oauthAccessToken' => $this->parameters['oauthAccessToken'],
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
            'status' => $this->parameters['status'],
        );
    }
}
