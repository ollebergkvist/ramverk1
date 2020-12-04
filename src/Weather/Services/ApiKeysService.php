<?php

namespace Olbe19\Weather\Services;

/**
 * Service class to set and get api keys
 */
class ApiKeysService
{
    private $apiKeyIP = null;
    private $apiKeyMap = null;
    private $apiKeyWeather = null;

    public function setApiKeyIP(string $apiKey) : void
    {
        $this->apiKeyIP = $apiKey;
    }

    public function setApiKeyMap(string $apiKey) : void
    {
        $this->apiKeyMap = $apiKey;
    }

    public function setApiKeyWeather(string $apiKey) : void
    {
        $this->apiKeyWeather = $apiKey;
    }

    public function getApiKeyIP() : string
    {
        return $this->apiKeyIP;
    }

    public function getApiKeyMap() : string
    {
        return $this->apiKeyMap;
    }

    public function getApiKeyWeather() : string
    {
        return $this->apiKeyWeather;
    }
}