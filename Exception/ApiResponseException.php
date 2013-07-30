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
     * @param string $content
     */
    public function __construct($url, $httpCode, $content)
    {
        parent::__construct(
            sprintf(
                "%s\nApi response error code: %d\n%s",
                $url,
                $httpCode,
                $content
            ),
            0,
            null
        );
    }
}

