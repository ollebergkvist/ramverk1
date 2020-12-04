<?php

/**
 * IP geo position model
 */

namespace Olbe19\Weather\Models;

/**
 * Get IP data from IPstack
 *
 */
class GetWeatherModel
{
    protected $curl;
    protected $baseUrl;
    private $apiKey;
    private $url;
    private $urls;
    private $latitude;
    private $longitude;

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
        $this->baseUrl = "https://api.openweathermap.org/";
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
     * Set latitude
     *
     * @var string $ipAddress          IP address to look up
     * @var string $baseUrl     API base URL
     * @var string $apiKey      API key for Ipstack usage
     * @var string $url         Complete url to curl
     *
     * @return void.
     */
    public function setCoordinates($coordinate1, $coordinate2)
    {
        $this->latitude = $coordinate1;
        $this->longitude = $coordinate2;
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
    public function setUrl()
    {
        $this->url = $this->baseUrl . "data/2.5/weather" . "?lat=" . $this->latitude . "&lon=" . $this->longitude . "&appid=" . $this->apiKey . "&units=metric";
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
    public function setUrlHistory()
    {
        $this->url = $this->baseUrl . "data/2.5/onecall/timemachine" . "?lat=" . $this->latitude . "&lon=" . $this->longitude . "&appid=" . $this->apiKey . "&units=metric";
    }

    public function setUrls() {
        for ($i=-5; $i<=-1; $i++) {
            $timestamp = strtotime("$i days");
            $this->urls[] = $this->url . "&dt=" . $timestamp;
        }
    }

    public function getUrls() {
        return $this->urls;
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
            "description" => $result["weather"][0]["description"] ?? null,
            "icon" => $result["weather"][0]["icon"] ?? null,
            "temperature" => $result["main"]["temp"] ?? null,
            "humidity" => $result["main"]["humidity"] ?? null,
            "wind" => $result["wind"]["speed"] ?? null,
        ];

        return $result;
    }

    /**
     * Get data from Ipstack api
     *
     * @var string $url         Complete url to curl
     *
     * @return array $result    Result from Ipstack API.
     */
    public function getDataMulti()
    {
        $result = $this->curl->getDataMultiCurl($this->urls);

        return $result;
    }

    /**
     * Get data from Ipstack api
     *
     * @var string $url         Complete url to curl
     *
     * @return array $result    Result from Ipstack API.
     */
    public function filterHistory(Array $array)
    {
        $historyArray = $array;
        $filteredHistory = [];

        foreach ($historyArray as $date) {
            $filteredHistory[] = [
                "date" => date("Y-m-d", $date["hourly"][15]["dt"]),
                "description" => $date["hourly"][15]["weather"][0]["description"],
                "temperature" => $date["hourly"][15]["temp"],
                "wind" => $date["hourly"][15]["wind_speed"],
                "humidity" => $date["hourly"][15]["humidity"],
                "iconUrl" => "http://openweathermap.org/img/wn/" . $date["hourly"][15]["weather"][0]["icon"] . "@2x.png",
            ];
        }

        return array_reverse($filteredHistory);
    }

    /**
     * Get data from Ipstack api
     *
     * @var string $url         Complete url to curl
     *
     * @return array $result    Result from Ipstack API.
     */
    public function getIconUrl($number)
    {
        $preBaseUrl = "http://openweathermap.org/img/wn/";
        $postBaseUrl = "@2x.png";
        $iconNumber = $number;
        $url = $preBaseUrl . $iconNumber . $postBaseUrl;

        return $url;
    }
}