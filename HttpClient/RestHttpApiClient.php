<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\HttpClient;

use IDCI\Bundle\NotificationApiClientBundle\Exception\ApiResponseException;

class RestHttpApiClient implements RestHttpApiClientInterface
{
    const USER_AGENT_NAME = "NotificationApiClient php/curl/REST-UA";

    protected $configuration;

    /**
     * Constructor
     *
     * @param array $configuration
     */
    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Get configuration
     *
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Get parameter
     *
     * @param string $name
     * @return mixed | null
     */
    public function getParameter($name)
    {
        return isset($this->configuration[$name]) ?
            $this->configuration[$name] :
            null
        ;
    }

    /**
     * Get the full path
     *
     * @param string $path
     * @return string
     */
    protected function getFullEndpointPath($path)
    {
        return sprintf('%s%s',
            $this->getParameter('endpoint_root'),
            $path
        );
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function get($path, $queryString = null)
    {
        $cUrl = self::initCurl($this->getFullEndpointPath($path));

        return self::execute($cUrl);
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function post($path, $queryString = null)
    {
        $cUrl = self::initCurl($this->getFullEndpointPath($path));
        curl_setopt($cUrl, CURLOPT_POST, true);
        curl_setopt($cUrl, CURLOPT_POSTFIELDS, $queryString);

        return self::execute($cUrl);
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function put($path, $queryString = null)
    {
        $cUrl = self::initCurl($this->getFullEndpointPath($path));
        curl_setopt($cUrl, CURLOPT_PUT, true);

        return self::execute($cUrl);
    }

    /**
     * @see RestHttpClientApiInterface
     */
    public function delete($path, $queryString = null)
    {
        $cUrl = self::initCurl($this->getFullEndpointPath($path));

        return self::execute($cUrl);
    }

    /**
     * Init cUrl
     *
     * @param string $path
     * @return cUrl
     */
    protected static function initCurl($path)
    {
        $cUrl = curl_init();
        curl_setopt($cUrl, CURLOPT_URL, $path);
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cUrl, CURLOPT_USERAGENT, self::USER_AGENT_NAME);

        return $cUrl;
    }

    /**
     * Execute cUrl
     *
     * @param cUrl $cUrl
     * @return string
     * @throw Exception
     */
    protected static function execute($cUrl)
    {
        $data = curl_exec($cUrl);
        $path = curl_getinfo($cUrl, CURLINFO_EFFECTIVE_URL);
        $httpCode = curl_getinfo($cUrl, CURLINFO_HTTP_CODE);
        curl_close($cUrl);

        if($httpCode != 200) {
            throw new ApiResponseException($path, $httpCode, $data);
        }

        return $data;
    }
}
