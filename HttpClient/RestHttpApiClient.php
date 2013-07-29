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
    private static function initCurl($path)
    {
        $cUrl = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);

        return $cUrl;
    }

    /**
     *
     */
    private static function closeCurl($cUrl)
    {
        curl_close($cUrl);
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function get($path, $queryString = null)
    {
        $cUrl = self::initCurl($path);

        self::closeCurl($cUrl);
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function post($path, $queryString = null)
    {
        $cUrl = self::initCurl($path);

        self::closeCurl($cUrl);
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function put($path, $queryString = null)
    {
        $cUrl = self::initCurl($path);

        self::closeCurl($cUrl);
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function delete($path, $queryString = null)
    {
        $cUrl = self::initCurl($path);

        self::closeCurl($cUrl);
    }

}
