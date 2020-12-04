<?php
/**
 * Configuration file to create router as $di service.
 */

return [
    "services" => [
        "getweathermodel" => [
            "active" => false,
            "shared" => true,
            "callback" => function () {
                $getWeatherModel = new \Olbe19\Weather\Models\GetWeatherModel();
                return $getWeatherModel;
            },
        ],
    ],
];