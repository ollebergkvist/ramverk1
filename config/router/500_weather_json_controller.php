<?php

/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Json Controller.",
            "mount" => "weather-json",
            "handler" => "\Olbe19\Weather\Controllers\WeatherJsonController",
        ],
    ]
];