<?php
/**
 * Configuration file to create router as $di service.
 */

return [
    "services" => [
        "ipgeoposition" => [
            "active" => false,
            "shared" => true,
            "callback" => function () {
                $ipGeoPosition = new \Olbe19\Weather\Models\IPGeoPosition();
                return $ipGeoPosition;
            },
        ],
    ],
];