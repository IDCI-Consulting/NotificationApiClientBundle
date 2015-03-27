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
    abstract protected function configureParameters(OptionsResolverInterface $resolver);
}
