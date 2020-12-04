<?php

/**
 * Get IP address of current user
 */

namespace Olbe19\Weather\Models;

/**
 * Get IP of current user
 *
 */
class GetUserIP
{
    /**
     * Returns user IP address
     *
     * @return string $ipAddress User IP address
     */

    public function getIP()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipAddress = 'unknown';
        }
        return $ipAddress;
    }
}