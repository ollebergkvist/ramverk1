<?php
/**
 * Configuration file to create router as $di service.
 */

return [
    "services" => [
        "curl" => [
            "active" => false,
            "shared" => true,
            "callback" => function () {
                $curl = new \Olbe19\Weather\Models\Curl();
                return $curl;
            },
        ],
    ],
];