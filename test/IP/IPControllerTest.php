<?php

namespace Olbe19\IP;

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
    public function testTextActionPostWithValidIPV4()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "216.58.217.36");

        $res = $this->controller->textActionPost();


        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test route textActionPost with valid IPV6 adress
     */
    public function testTextActionPostWithValidIPV6()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "2001:0db8:0000:0000:0000:ff00:0042:7879");

        $res = $this->controller->textActionPost();


        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test route textActionPost with invalid IP adress
     */
    public function testTextActionPostWithInvalidIP()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "127.0");

        $res = $this->controller->textActionPost();


        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test route textActionPost with missing IP adress
     */
    public function testTextActionPostWithMissingIP()
    {
        $request = $this->di->get("request");
        $request->setPost("test", "test");

        $res = $this->controller->textActionPost();


        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    // /**
    //  * Test route jsonActionPost with valid IPV4
    //  */
    public function testJsonActionPostWithValidIPV4()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "216.58.217.36");

        $res = $this->controller->jsonActionPost();

        $this->assertIsArray($res);
    }

    // /**
    //  * Test route jsonActionPost with valid IPV6
    //  */
    public function testJsonActionPostWithValidIPV6()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "2001:0db8:0000:0000:0000:ff00:0042:7879");

        $res = $this->controller->jsonActionPost();

        $this->assertIsArray($res);
    }

    // /**
    //  * Test route jsonActionPost with invalid IP
    //  */
    public function testJsonActionPostWithInvalidIP()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "127.0");

        $res = $this->controller->jsonActionPost();

        $this->assertIsArray($res);
    }

    /**
     * Test route textActionPost with missing IP
     */
    public function testJsonActionPostWithMissingIP()
    {
        $request = $this->di->get("request");
        $request->setPost("test", "test");

        $res = $this->controller->jsonActionPost();


        $this->assertIsArray($res);
    }

    /**
     * Test the route jsonActionGet with valid IPV4
     */
    public function testJsonActionGetWithValidIPV4()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "216.58.217.36");

        $res = $this->controller->jsonActionGet();

        $this->assertIsArray($res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route jsonActionGet with valid IPV6
     */
    public function testJsonActionGetWithValidIPV6()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "2001:0db8:0000:0000:0000:ff00:0042:7879");

        $res = $this->controller->jsonActionGet();

        $this->assertIsArray($res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route jsonActionGet
     */
    public function testJsonActionGetwithInvalidIP()
    {
        $request = $this->di->get("request");
        $request->setGet("216.58");

        $res = $this->controller->jsonActionGet();

        $this->assertIsArray($res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route jsonActionGet
     */
    public function testJsonActionGetWithMissingIP()
    {
        $request = $this->di->get("request");
        $request->setGet("test", "tests");

        $res = $this->controller->jsonActionGet();

        $this->assertIsArray($res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
