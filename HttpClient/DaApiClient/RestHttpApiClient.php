<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\HttpClient\DaApiClient;

use Da\ApiClientBundle\HttpClient\RestApiClientBridge;
use IDCI\Bundle\NotificationApiClientBundle\HttpClient\RestHttpApiClientInterface;

class RestHttpApiClient extends RestApiClientBridge implements RestHttpApiClientInterface
{
    /**
     * @see RestHttpClientApiInterface
     */
    public function post($path, $queryString = null)
    {
        echo 'test thomas';
    }
}
