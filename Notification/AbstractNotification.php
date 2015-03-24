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
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractNotification
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * Constructor
     *
     * @param array $parameters The parameters.
     */
    public function __construct(array $parameters = array())
    {
        $resolver = new OptionsResolver();
        $this->configureParameters($resolver);
        $this->parameters = $resolver->resolve($parameters);
    }

    /**
     * To array
     *
     * @return array
     */
    public function toArray()
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
     * Clean data (remove "null" value)
     *
     * @param array $data
     * @return array
     */
    protected static function cleanData($data)
    {
        foreach($data as $k => $v) {
            if (null === $v) {
                unset($data[$k]);
            }
        }

        return $data;
    }

    /**
     * Configure parameters
     *
     * @param OptionsResolverInterface $resolver The resolver.
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setOptional(array('notifierAlias'))
            ->setAllowedTypes(array(
                'notifierAlias' => array("null", "string")
            ))
        ;
    }

    /**
     * Get data from
     *
     * @return array
     */
    abstract public function getDataFrom();

    /**
     * Get data to
     *
     * @return array
     */
    abstract public function getDataTo();

    /**
     * Get data content
     *
     * @return array
     */
    abstract public function getDataContent();
}
