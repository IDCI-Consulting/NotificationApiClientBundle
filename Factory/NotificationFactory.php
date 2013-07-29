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

abstract class NotificationFactory
{
    /**
     * Create
     *
     * @param string $type
     * @param array $parameters
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
        foreach($parameters as $field => $value) {
            $setter = sprintf('set%s', Inflector::camelize($field));
            if (!$rc->hasMethod($setter)) {
                throw new UnavailableNotificationDataException($className, $field);
            }
            $notification->$setter($value);
        }

        return $notification;
    }
}
