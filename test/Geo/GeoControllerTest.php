<?php

namespace Olbe19\Geo\Controllers;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the IPController.
 */
class GeoControllerTest extends TestCase
{
    // Create the di container.
    protected $di;
    protected $controller;

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
        $this->controller = new GeoController();

        // Set local server address
        $_SERVER["REMOTE_ADDR"] = "127.0.0.1";

        $this->controller->setDI($di);
        $this->controller->initialize();
    }

    /**
     * Test route indexActionGet
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();

        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test indexActionGet has request
     */
    public function testIndexActionGetRequest()
    {
        global $di;
        $request = $di->get("request");
        $request->setGet("ip", "187.178.82.197");
        $res = $this->controller->indexActionGet();

        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
