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

abstract class AbstractApiNotification extends AbstractNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array('notifierAlias' => null))
            ->setAllowedTypes('notifierAlias', array('null', 'string'))
        ;
    }

    /**
     * Normalize the notification for the api.
     *
     * @return array
     */
    public function normalize()
    {
        $array = array();

        if (isset($this->parameters['notifierAlias'])) {
            $array['notifierAlias'] = $this->parameters['notifierAlias'];
        }

        if ($this->getDataFrom()) {
            $array['from'] = self::cleanData($this->getDataFrom());
        }

        if ($this->getDataTo()) {
            $array['to'] = self::cleanData($this->getDataTo());
        }

        if ($this->getDataContent()) {
            $array['content'] = self::cleanData($this->getDataContent());
        }

        return $array;
    }

    /**
     * Get data from.
     *
     * @return array
     */
    abstract public function getDataFrom();

    /**
     * Get data to.
     *
     * @return array
     */
    abstract public function getDataTo();

    /**
     * Get data content.
     *
     * @return array
     */
    abstract public function getDataContent();
}
