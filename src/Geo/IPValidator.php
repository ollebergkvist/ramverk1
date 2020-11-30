<?php

/**
 * IP validator model
 */

namespace Olbe19\Geo;

/**
 * Validate IP address
 *
 */
class IPValidator
{
    /**
     * Returns if IP is valid or not
     *
     * @param string $ip IP to validate
     * 
     * @return bool $ip True or False
     */

    public function isIPValid(string $ip) : bool
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        };
        return false;
    }

    /**
     * Returns IP protocol
     *
     * @param string $ip IP to check protocol
     * 
     * @return string $message IP protocol
     */
    public function getIPProtocol(string $ip) : string
    {
        $message = "";
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $message = "IPv4";
        } 
        else if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return $message = "IPv6";
        }
    }

    /**
     * Returns IP host
     *
     * @param string $ip IP to check host 
     * 
     * @return string $hostname IP host
     */
    public function getIPHost(string $ip) : string {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $hostname = gethostbyaddr($ip);
            return $hostname;
        }
    }
}