<?php
/**
 * Configuration file to create router as $di service.
 */

return [
    "services" => [
        "getuserip" => [
            "active" => false,
            "shared" => true,
            "callback" => function () {
                $getUserIP = new \Olbe19\Weather\Models\GetUserIP();
                return $getUserIP;
            },
        ],
    ],
];