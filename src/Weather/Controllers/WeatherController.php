<?php

namespace Olbe19\Weather\Controllers;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A test controller to show off using a $di service class.
 */
class WeatherController implements ContainerInjectableInterface
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
    public function indexActionGet(): object
    {
        // General framework setup
        $page = $this->di->get("page");
        $title = "Weather";
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ip");

        // API keys
        $apiKeys = $this->di->get("apikeys");
        $apiKeyIP = $apiKeys->getApiKeyIP();
        $apiKeyMap = $apiKeys->getApiKeyMap();
        $apiKeyWeather = $apiKeys->getApiKeyWeather();

        // Get user ip
        if (empty($ipAddress)) {
            $getUserIP = $this->di->get("getuserip");
            $ipAddress = $getUserIP->getIP();
        }

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

        // Get weather history
        $getWeather->setUrlHistory();
        $getWeather->setUrls();
        $weatherHistory = $getWeather->getDataMulti();
        $filteredWeatherHistory =  $getWeather->filterHistory($weatherHistory);

        $data = [
            "apiKeyMap" => $apiKeyMap ?? null,
            "ip" => $ipAddress ?? null,
            "isValidIP" => $isValidIP ?? null,
            "latitude" => $ipGeoPositionResult["latitude"] ?? null,
            "longitude" => $ipGeoPositionResult["longitude"] ?? null,
            "country" => $ipGeoPositionResult["country"] ?? null,
            "city" => $ipGeoPositionResult["city"] ?? null,
            "weather" => $weatherForecast["weather"] ?? null,
            "description" => $weatherForecast["description"] ?? null,
            "iconUrl" => $iconUrl ?? null,
            "temperature" => $weatherForecast["temperature"] ?? null,
            "wind" => $weatherForecast["wind"] ?? null,
            "humidity" => $weatherForecast["humidity"] ?? null,
            "weatherHistory" => $filteredWeatherHistory ?? null,
        ];

        $page->add("weather/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}