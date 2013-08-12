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
     * @param string $path
     * @param string $queryString
     * @return string
     * @throw ApiResponseException
     */
    public function get($path, $queryString = null);

    /**
     * Post
     *
     * @param string $path
     * @param string $queryString
     * @return string
     * @throw ApiResponseException
     */
    public function post($path, $queryString = null);

    /**
     * Put
     *
     * @param string $path
     * @param string $queryString
     * @return string
     * @throw ApiResponseException
     */
    public function put($path, $queryString = null);

    /**
     * Delete
     *
     * @param string $path
     * @param string $queryString
     * @return string
     * @throw ApiResponseException
     */
    public function delete($path, $queryString = null);
}

