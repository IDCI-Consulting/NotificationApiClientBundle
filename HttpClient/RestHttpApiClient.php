<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\HttpClient;

class RestHttpApiClient implements RestHttpApiClientInterface
{
    /**
     * @see RestHttpClientApiInterface
     */
    public function get($path, $queryString = null)
    {

    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function post($path, $queryString = null)
    {
        echo 'test sekou';
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function put($path, $queryString = null)
    {
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function delete($path, $queryString = null)
    {
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function test()
    {

    }

}
