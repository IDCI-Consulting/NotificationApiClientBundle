<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ModalNotification extends AbstractSessionNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolver $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setDefaults(array(
                'level' => 'info',
                'title' => null,
                'actions' => array(),
                'class' => null,
            ))
            ->setAllowedValues('level', array('info', 'error', 'warning'))
            ->setAllowedTypes('actions', array('array'))
            ->setNormalizer('actions', function ($options, $value) {
                foreach ($value as $k => $action) {
                    if (isset($action['href'])) {
                        $value[$k] = array_merge(
                                array(
                                    'name' => $action['href'],
                                    'target' => '_self',
                                ),
                                $action
                            );
                    }
                }

                return $value;
            }
            )
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
            'title' => $this->parameters['title'],
            'message' => $this->parameters['message'],
            'actions' => $this->parameters['actions'],
            'class' => $this->parameters['class'],
        );
    }
}
