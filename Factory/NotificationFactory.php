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
use IDCI\Bundle\NotificationApiClientBundle\Exception\UnavailableNotificationParameterException;

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

        if (isset($parameters['notifierAlias'])) {
            $notification->setNotifierAlias($parameters['notifierAlias']);
            unset($parameters['notifierAlias']);
        }

        foreach($parameters as $field => $values) {
            foreach ($values as $key => $value){
                $setter = sprintf('set%s', Inflector::camelize($key));
                if (!$rc->hasMethod($setter)) {
                    throw new UnavailableNotificationParameterException($className, $field);
                }
                $notification->$setter($value);
            }
        }

        return $notification;
    }
}
