<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Exception;

class ApiResponseException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $url
     * @param string $httpCode
     */
    public function __construct($url, $httpCode)
    {
        parent::__construct(
            sprintf(
                "%s \nApi response error code: %d",
                $url,
                $httpCode
            ),
            0,
            null
        );
    }
}

