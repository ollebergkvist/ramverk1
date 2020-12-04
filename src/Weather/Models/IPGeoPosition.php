<?php

/**
 * IP geo position model
 */

namespace Olbe19\Weather\Models;

/**
 * Get IP data from IPstack
 *
 */
class IPGeoPosition
{
    protected $curl;
    protected $baseUrl;
    private $apiKey;
    private $url;

    /**
     * Constructor for Ipstack URL
     *
     * @var Curl $curl          Curl model
     * @var string $baseUrl     API base URL
     * @var string $apiKey      API key for Ipstack usage
     * @var string $url         Complete url to curl
     */
    public function __construct()
    {
        $this->curl = new Curl();
        $this->baseUrl = "http://api.ipstack.com/";
    }

    /**
     * Set api key
     *
     * @var string $ipAddress          IP address to look up
     * @var string $baseUrl     API base URL
     * @var string $apiKey      API key for Ipstack usage
     * @var string $url         Complete url to curl
     *
     * @return void.
     */
    public function setApiKey(String $key)
    {
        $this->apiKey = $key;
    }

        /**
     * Set api key
     *
     * @var string $ipAddress          IP address to look up
     * @var string $baseUrl     API base URL
     * @var string $apiKey      API key for Ipstack usage
     * @var string $url         Complete url to curl
     *
     * @return void.
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set url
     *
     * @var string $ipAddress          IP address to look up
     * @var string $baseUrl     API base URL
     * @var string $apiKey      API key for Ipstack usage
     * @var string $url         Complete url to curl
     *
     * @return void.
     */
    public function setUrl($ipAddress)
    {
        $this->url = $this->baseUrl . $ipAddress . "?access_key=" . $this->apiKey;
    }

    /**
     * Get data from Ipstack api
     *
     * @var string $url         Complete url to curl
     *
     * @return array $result    Result from Ipstack API.
     */
    public function getData()
    {
        $result = $this->curl->getData($this->url);

        $result = [
            "country" => $result["country_name"] ?? null,
            "city" => $result["city"] ?? null,
            "longitude" => $result["longitude"] ?? null,
            "latitude" => $result["latitude"] ?? null,
        ];

        return $result;
    }
}