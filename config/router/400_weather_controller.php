<?php

/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Controller.",
            "mount" => "weather",
            "handler" => "\Olbe19\Weather\Controllers\WeatherController",
        ],
    ]
];
