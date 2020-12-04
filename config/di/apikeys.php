<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "apikeys" => [
            // Is the service shared, true or false
            // Optional, default is true
            "shared" => true,

            // Is the service activated by default, true or false
            // Optional, default is false
            "active" => false,

            // Callback executed when service is activated
            // Create the service, load its configuration (if any)
            // and set it up.
            "callback" => function () {
                $service = new Olbe19\Weather\Services\ApiKeysService();

                // Load the configuration file(s)
                $cfg = $this->get("configuration");
                $config = $cfg->load("config.php");
                $settings = $config["config"] ?? null;

                if ($settings["ipstack"] ?? null) {
                    $service->setApiKeyIP($settings["ipstack"]);
                }

                if ($settings["openweathermap"] ?? null) {
                    $service->setApiKeyWeather($settings["openweathermap"]);
                }

                if ($settings["google"] ?? null) {
                    $service->setApiKeyMap($settings["google"]);
                }

                return $service;
            }
        ],
    ],
];