<?php
/**
 * Configuration file to create router as $di service.
 */

return [
    "services" => [
        "googlemaps" => [
            "active" => false,
            "shared" => true,
            "callback" => function () {
                $googleMaps = new \Olbe19\Weather\Models\GoogleMaps();
                return $googleMaps;
            },
        ],
    ],
];