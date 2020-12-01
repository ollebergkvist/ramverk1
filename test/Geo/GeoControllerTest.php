<?php

namespace Olbe19\Geo\Controllers;

use Anax\DI\DIFactoryConfig;
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
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new GeoController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    /**
     * Test route indexActionGet
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertIsObject($res);
    }

    /**
     * Test route textActionPost with valid IPV4 adress
     */
    // public function testTextActionPostWithValidIPV4()
    // {
    //     $request = $this->di->get("request");
    //     $request->setPost("ip", "216.58.217.36");

    //     $res = $this->controller->textActionPost();


    //     $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    // }
}
