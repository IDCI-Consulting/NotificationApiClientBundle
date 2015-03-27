<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModalNotification extends AbstractSessionNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setDefaults(array(
                'level'   => 'info',
                'title'   => null,
                'actions' => array()
            ))
            ->setAllowedValues(array(
                'level' => array('info', 'error', 'warning')
            ))
            ->setAllowedTypes(array(
                'actions' => array('array')
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataType()
    {
        return sprintf('modal_%s', $this->parameters['level']);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataMessage()
    {
        return array(
            'title'   => $this->parameters['title'],
            'message' => $this->parameters['message'],
            'actions' => $this->parameters['actions'],
        );
    }
}
