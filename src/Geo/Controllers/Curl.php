<?php

/**
 * Curl model
 */

namespace Olbe19\Geo\Controllers;

/**
 * Get data from API
 *
 */
class Curl
{
    /**
     * Uses curl to retrieve data and return result
     *
     * @param string $url URL to curl
     *
     * @return array $res Result as JSON
     */

    public function getData(String $url)
    {
        $curlHandler = curl_init($url);

        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($curlHandler);

        curl_close($curlHandler);

        $res = json_decode($res, true);

        return $res;
    }
}
