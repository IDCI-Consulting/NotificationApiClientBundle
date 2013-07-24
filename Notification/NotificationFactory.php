<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use IDCI\Bundle\NotificationApiClientBundle\Util\Inflector;

abstract class NotificationFactory
{
    /**
     * Create
     *
     * @param string $type
     */
    static public function create($type)
    {
        $class = sprintf(
            '%s\%sNotification',
            'IDCI\Bundle\NotificationApiClientBundle\Notification',
            Inflector::camelize($type)
        );

        return new $class();
    }


}
