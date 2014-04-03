<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Factory;

use IDCI\Bundle\NotificationApiClientBundle\Util\Inflector;
use IDCI\Bundle\NotificationApiClientBundle\Exception\UndefinedNotificationPropertyException;

abstract class NotificationFactory
{
    /**
     * Create
     *
     * @param string $type
     * @param array $parameters
     * @return AbstractNotification $notification
     */
    static public function create($type, $parameters)
    {
        $className = sprintf(
            '%s\%sNotification',
            'IDCI\Bundle\NotificationApiClientBundle\Notification',
            Inflector::camelize($type)
        );

        $notification = new $className();
        $rc = new \ReflectionClass($className);

        foreach($parameters as $key => $value) {
            $setter = sprintf('set%s', Inflector::camelize($key));
            if (!$rc->hasMethod($setter)) {
                throw new UndefinedNotificationPropertyException($key, $className);
            }
            $notification->$setter($value);
        }

        return $notification;
    }
}
