<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Exception;

class UndefinedNotificationPropertyException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $property
     * @param string $className
     */
    public function __construct($property, $className)
    {
        parent::__construct(
            sprintf(
                'Undefined notification property "%s" in the class "%s"',
                $property,
                $className
            ),
            0,
            null
        );
    }
}

