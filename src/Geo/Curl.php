<?php

/**
 * Curl model
 */

namespace Olbe19\Geo;

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

    public function getData(String $url) : array
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);

        curl_close($ch);

        $res = json_decode($res, true);

        return $res;
    }
}