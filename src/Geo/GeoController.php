<?php

namespace Olbe19\Geo;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Controller for geo tagging ip address
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class GeoController implements ContainerInjectableInterface
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
        $page = $this->di->get("page");
        $title = "Geotag IP-address";
        $request = $this->di->get("request");
        $config = require ANAX_INSTALL_PATH . "/config/config.php";
        $googleAPIKey = $config["google"] ?? null;
        $ip = $request->getGet("ip");

        if (empty($ip)) {
            $userIP = new GetUserIP();
            $ip = $userIP->getIP($request);
        }

        // Validate IP
        $ipValidator = new IPValidator();
        $isValidIP = $ipValidator->isIPValid($ip);
        $ipProtocol = $ipValidator->getIPProtocol($ip);
        $ipHost = $ipValidator->getIPHost($ip);

        // Get IP position
        $ipGeoPosition = new IPGeoPosition();
        $ipGeoPosition->setUrl($ip);
        $ipGeoPositionResult = $ipGeoPosition->getData();

        $data = [
            "googleAPIKey" => $googleAPIKey,
            "ip" => $ip ?? "null",
            "isValidIP" => $isValidIP ?? null,
            "ipProtocol" => $ipProtocol ?? null,
            "ipHost" => $ipHost ?? null,
            "latitude" => $ipGeoPositionResult["latitude"] ?? null,
            "longitude" => $ipGeoPositionResult["longitude"] ?? null,
            "country" => $ipGeoPositionResult["country"] ?? null,
            "city" => $ipGeoPositionResult["city"] ?? null,
        ];

        $page->add("geo/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
