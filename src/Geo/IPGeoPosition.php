<?php

/**
 * IP geo position model
 */

namespace Olbe19\Geo;

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

        $config = require ANAX_INSTALL_PATH . "/config/config.php";
        $this->apiKey = $config["ipstack"] ?? null;
    }

    /**
     * Set url
     *
     * @var string $ip          IP address to look up
     * @var string $baseUrl     API base URL
     * @var string $apiKey      API key for Ipstack usage
     * @var string $url         Complete url to curl
     *
     * @return void.
     */
    public function setUrl($ip)
    {
        $this->url = $this->baseUrl . $ip . "?access_key=" . $this->apiKey;
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