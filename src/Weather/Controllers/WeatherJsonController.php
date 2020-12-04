<?php

namespace Olbe19\Weather\Controllers;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A test controller to show off using a $di service class.
 */
class WeatherJsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";

    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convenient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->db = "active";
    }

    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     *
     * @return array
     */
    public function indexActionGet(): array
    {
        // General framework setup
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ip");

        // API keys
        $apiKeys = $this->di->get("apikeys");
        $apiKeyIP = $apiKeys->getApiKeyIP();
        $apiKeyMap = $apiKeys->getApiKeyMap();
        $apiKeyWeather = $apiKeys->getApiKeyWeather();

        // Validate IP
        $ipValidator = $this->di->get("ipvalidator");
        $isValidIP = $ipValidator->isIPValid($ipAddress);

        // Get IP position
        $ipGeoPosition = $this->di->get("ipgeoposition");
        $ipGeoPosition->setApiKey($apiKeyIP);
        $ipGeoPosition->setUrl($ipAddress);
        $ipGeoPositionResult = $ipGeoPosition->getData();
        $latitude = $ipGeoPositionResult["latitude"] ?? null;
        $longitude = $ipGeoPositionResult["longitude"] ?? null;

        // Get weather forecast
        $getWeather = $this->di->get("getweathermodel");
        $getWeather->setApiKey($apiKeyWeather);
        $getWeather->setCoordinates($latitude, $longitude);
        $getWeather->setUrl();
        $weatherForecast = $getWeather->getData();
        $iconUrl = $getWeather->getIconUrl($weatherForecast["icon"]);

        // Location
        $location = [
            "city" => $ipGeoPositionResult["city"] ?? null,
            "country" => $ipGeoPositionResult["country"] ?? null,
        ];

        // Current weather
        $currentWeather = [
            "date" => date("Y-m-d") ?? null,
            "description" => $weatherForecast["description"] ?? null,
            "temperature" => $weatherForecast["temperature"] ?? null,
            "wind" => $weatherForecast["wind"] ?? null,
            "humidity" => $weatherForecast["humidity"] ?? null,
            "iconUrl" => $iconUrl ?? null,
        ];

        // Get weather history
        $getWeather->setUrlHistory();
        $getWeather->setUrls();
        $weatherHistory = $getWeather->getDataMulti();
        $filteredWeatherHistory =  $getWeather->filterHistory($weatherHistory);

        $data = [
            "location" => $location ?? null,
            "currentWeather" => $currentWeather ?? null,
            "weatherHistory" => $filteredWeatherHistory ?? null,
        ];

        $json = [$data];

        return [$data];
    }
}