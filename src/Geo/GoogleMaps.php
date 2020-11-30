<?php

/**
 * Google Maps model
 */

namespace Olbe19\Geo;

/**
 * Get link to Google Maps from IP
 *
 */
class GoogleMaps
{
    /**
     * Get Google Maps URL
     *
     * @var float $longitude    Longitude
     * @var float $latitude     Latitude
     *
     * @return string $url  Url to google map with coordinates
     */

    public function getMap($longitude, $latitude)
    {
        if (!empty($longitude) && !empty($latitude)) {
            $url = "https://www.google.com/maps/search/?api=1&query=$latitude,$longitude";
            return $url;
        }
    }
}