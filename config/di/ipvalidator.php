<?php
/**
 * Configuration file to create router as $di service.
 */

return [
    "services" => [
        "ipvalidator" => [
            "active" => false,
            "shared" => true,
            "callback" => function () {
                $ipvalidator = new \Olbe19\Weather\Models\IPValidator();
                return $ipvalidator;
            },
        ],
    ],
];