<?php

/**
 * IP validator model
 */

namespace Olbe19\Geo\Controllers;

/**
 * Validate IP address
 *
 */
class IPValidator
{
    /**
     * Returns if IP is valid or not
     *
     * @param string $ipAddress IP to validate
     *
     * @return bool $ipAddress True or False
     */

    public function isIPValid(string $ipAddress) : bool
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            return true;
        };
        return false;
    }

    /**
     * Returns IP protocol
     *
     * @param string $ipAddress IP to check protocol
     *
     * @return string $message IP protocol
     */
    public function getIPProtocol(string $ipAddress) : string
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $message = "IPv4";
        } else if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return $message = "IPv6";
        }
        return $message = "";
    }

    /**
     * Returns IP host
     *
     * @param string $ipAddress IP to check host
     *
     * @return string $hostname IP host
     */
    public function getIPHost(string $ipAddress) : string
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            $hostname = gethostbyaddr($ipAddress);
            return $hostname;
        }
        return $hostname = "";
    }
}
