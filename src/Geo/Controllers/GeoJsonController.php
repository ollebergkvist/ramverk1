<?php

/**
 * Geo controller
 */

namespace Olbe19\Geo\Controllers;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Controller for geo tagging API
 *
 */
class GeoJsonController implements ContainerInjectableInterface
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
     * Index route
     *
     * @return array
     */
    public function indexActionGet() : array
    {
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ip");

        if (empty($ipAddress)) {
            $userIP = new GetUserIP();
            $ipAddress = $userIP->getIP($request);
        }

        // Validate IP
        $ipValidator = new IPValidator();
        $isValidIP = $ipValidator->isIPValid($ipAddress);

        if ($isValidIP == false) {
            $data = [
                "ip" => $ipAddress ?? null,
                "isValidIP" => $isValidIP ?? null,
            ];

            $json = [$data];

            return [$json];
        }

        $ipProtocol = $ipValidator->getIPProtocol($ipAddress);
        $ipHost = $ipValidator->getIPHost($ipAddress);

        // Get IP position
        $ipGeoPosition = new IPGeoPosition();
        $ipGeoPosition->setUrl($ipAddress);
        $ipGeoPositionResult = $ipGeoPosition->getData();

        // Get map
        $map = new GoogleMaps();
        $urlMap = $map->getMap($ipGeoPositionResult["longitude"], $ipGeoPositionResult["latitude"]);

        $data = [
            "ip" => $ipAddress ?? null,
            "isValidIP" => $isValidIP ?? null,
            "ipProtocol" => $ipProtocol ?? null,
            "ipHost" => $ipHost ?? null,
            "latitude" => $ipGeoPositionResult["latitude"] ?? null,
            "longitude" => $ipGeoPositionResult["longitude"] ?? null,
            "country" => $ipGeoPositionResult["country"] ?? null,
            "city" => $ipGeoPositionResult["city"] ?? null,
            "urlMap" => $urlMap ?? null,
        ];

        $json = [$data];

        return [$json];
    }
}
