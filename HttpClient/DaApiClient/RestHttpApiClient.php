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
    public function getNotif($offset, $limit)
    {
        $parameters = array('offset' => $offset, 'limit' => $limit);

        $this->get('/friends', $parameters);

        return 'It works!';
    }
}
