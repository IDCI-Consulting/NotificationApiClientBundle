<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\HttpClient;

interface RestHttpApiClientInterface
{
    /**
     * Get
     *
     * @param string $path       The relative path to the webservice.
     * @param array $queryString The specific queryString to the webservice.
     *
     * @return string
     *
     * @throw ApiHttpResponseException
     */
    public function get($path, array $queryString = array());

    /**
     * Post
     *
     * @param string $path       The relative path to the webservice.
     * @param array $queryString The specific queryString to the webservice.
     *
     * @return string
     *
     * @throw ApiHttpResponseException
     */
    public function post($path, array $queryString = array());

    /**
     * Put
     *
     * @param string $path       The relative path to the webservice.
     * @param array $queryString The specific queryString to the webservice.
     *
     * @return string
     *
     * @throw ApiHttpResponseException
     */
    public function put($path, array $queryString = array());

    /**
     * Delete
     *
     * @param string $path       The relative path to the webservice.
     * @param array $queryString The specific queryString to the webservice.
     *
     * @return string
     *
     * @throw ApiHttpResponseException
     */
    public function delete($path, array $queryString = array());
}

