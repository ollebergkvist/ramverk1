<?php

namespace Anax\Controller;

use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IPController.
 */
class IPControllerTest extends TestCase
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
        $this->controller = new IPController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        // $json = $res[0];
        // $exp = "db is active";
        // $this->assertContains($exp, $json["message"]);
    }

    /**
     * Test the route "text".
     */
    public function testTextActionPost()
    {
        $res = $this->controller->textActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "json".
     */
    public function testJsonActionPost()
    {
        $res = $this->controller->jsonActionPost();
        $this->assertInternalType("array", $res);
    }

    /**
     * Test the route "json".
     */
    public function testJsonActionGet()
    {
        $res = $this->controller->jsonActionGet();
        $this->assertInternalType("array", $res);
    }
}
