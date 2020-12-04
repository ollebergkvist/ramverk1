<?php

/**
 * Curl model
 */

namespace Olbe19\Weather\Models;

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
     * @return array $result Result as JSON
     */

    public function getData(String $url)
    {
        // Initiate curl handler
        $curlHandler = curl_init($url);

        // WIll return the response, if false it prints the response
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);

        // Execute
        $result = curl_exec($curlHandler);

        // Close
        curl_close($curlHandler);

        // Result
        $result = json_decode($result, true);

        return $result;
    }

    public function getDataMultiCurl(array $urls) : array
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];

        // Add all curl handlers and remember them
        // Initiate the multi curl handler
        $multiHandler = curl_multi_init();
        $curlHandlerAll = [];

        foreach ($urls as $url) {
            $curlHandler = curl_init($url);
            curl_setopt_array($curlHandler, $options);
            curl_multi_add_handle($multiHandler, $curlHandler);
            $curlHandlerAll[] = $curlHandler;
        }

        // Execute all queries simultaneously,
        // and continue when all are complete
        $running = null;
        do {
            curl_multi_exec($multiHandler, $running);
        } while ($running);

        // Close the handles
        foreach ($curlHandlerAll as $curlHandler) {
            curl_multi_remove_handle($multiHandler, $curlHandler);
        }
        curl_multi_close($multiHandler);

        // All of our requests are done, we can now access the results
        $response = [];
        foreach ($curlHandlerAll as $curlHandler) {
            $data = curl_multi_getcontent($curlHandler);
            $response[] = json_decode($data, true);
        }

        return $response;
    }
}