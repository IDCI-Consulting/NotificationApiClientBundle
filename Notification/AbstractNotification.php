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

abstract class AbstractNotification
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var array
     */
    protected $files;

    /**
     * Constructor.
     *
     * @param array $parameters the parameters
     * @param array $files      the files
     */
    public function __construct(array $parameters = array(), array $files = array())
    {
        $resolver = new OptionsResolver();
        $this->configureParameters($resolver);
        $this->parameters = $resolver->resolve($parameters);
        $this->files = $files;
    }

    /**
     * Returns files.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Clean data (remove "null" value).
     *
     * @param array $data
     *
     * @return array
     */
    protected static function cleanData($data)
    {
        foreach ($data as $k => $v) {
            if (null === $v) {
                unset($data[$k]);
            }
        }

        return $data;
    }

    /**
     * Configure parameters.
     *
     * @param OptionsResolver $resolver the resolver
     */
    abstract protected function configureParameters(OptionsResolver $resolver);
}
