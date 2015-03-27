<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlashNotification extends AbstractSessionNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setDefaults(array(
                'level' => 'info',
            ))
            ->setAllowedValues(array(
                'level' => array('info', 'error', 'warning')
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataType()
    {
        return sprintf('flash_%s', $this->parameters['level']);
    }
}
