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

class PushAndroidNotification extends AbstractApiNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolver $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setDefaults(array(
                'apiKey' => null,
            ))
            ->setRequired(array(
                'deviceToken',
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
          'apiKey' => $this->parameters['apiKey'],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'deviceToken' => $this->parameters['deviceToken'],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataContent()
    {
        return array(
            'message' => $this->parameters['message'],
        );
    }
}
