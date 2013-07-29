<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

interface NotificationInterface
{
    /**
     * getType
     *
     * return string
     */
    public function getType();

    /**
     * getQueryString
     *
     * return string
     */
    public function getQueryString();
}
