<?php

namespace Olbe19\Geo\Controllers;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the IPController.
 */
class GetUserIPTest extends TestCase
{
    // Create the di container.
    protected $ipAddress;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIMagic();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->ipAddress = new GetUserIP();
    }

    /**
     * Test route indexActionGet
     */
    public function testHTTPCLIENTIP()
    {
        $expectedIP = "187.178.82.197";
        $_SERVER["HTTP_CLIENT_IP"] = "187.178.82.197";

        $actualIP = $this->ipAddress->getIP();

        $this->assertEquals($expectedIP, $actualIP);
    }

    /**
     * Test route indexActionGet
     */
    public function testHTTPXFORWARDEDFOR()
    {
        $expectedIP = "187.178.82.197";
        $_SERVER["HTTP_X_FORWARDED_FOR"] = "187.178.82.197";

        $actualIP = $this->ipAddress->getIP();

        $this->assertEquals($expectedIP, $actualIP);
    }

    /**
     * Test route indexActionGet
     */
    public function testHTTPXFORWARDED()
    {
        $expectedIP = "187.178.82.197";
        $_SERVER["HTTP_X_FORWARDED"] = "187.178.82.197";

        $actualIP = $this->ipAddress->getIP();

        $this->assertEquals($expectedIP, $actualIP);
    }

    /**
     * Test route indexActionGet
     */
    public function testREMOTEADDR()
    {
        $expectedIP = "187.178.82.197";
        $_SERVER["REMOTE_ADDR"] = "187.178.82.197";

        $actualIP = $this->ipAddress->getIP();

        $this->assertEquals($expectedIP, $actualIP);
    }

    /**
     * Test route indexActionGet
     */
    public function testUNKNOWN()
    {
        $expectedIP = "unknown";

        $actualIP = $this->ipAddress->getIP();

        $this->assertEquals($expectedIP, $actualIP);
    }
}
