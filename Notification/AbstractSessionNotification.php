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

abstract class AbstractSessionNotification extends AbstractNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(array('message'))
        ;
    }

    /**
     * Get data type.
     *
     * @return string
     */
    abstract public function getDataType();

    /**
     * Get data message.
     *
     * @return string
     */
    public function getDataMessage()
    {
        return $this->parameters['message'];
    }
}
