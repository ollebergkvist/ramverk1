<?php

namespace Olbe19\IP;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IPController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";

    // /**
    //  * This is how a general helper method can be created in the controller.
    //  *
    //  * @param string $method as the method that handled controller action.
    //  *
    //  * @param array $args as an array of arguments.
    //  *
    //  * @return string as a message to output to help understand how the controller method works.
    //  *
    //  */

    // public function getDetailsOnRequest(string $method, array $args = []): string
    // {
    //     $request = $this->di->get("request");
    //     $path = $request->getRoute();
    //     $httpMethod = $request->getMethod();
    //     $numArgs = count($args);
    //     $strArgs = implode(", ", $args);
    //     $queryString = http_build_query($request->getGet(), '', ',');

    //     return <<<EOD
    //         <h1>$method</h1>

    //         <p>THe request was '$path' ($httpMethod)</p>
    //         <p>Got '$numArgs' arguments: '$strArgs'</p>
    //         <p>Query string contains: '$queryString'</p>
    //         <p>\$db is '{$this->db}'.
    //     EOD;
    // }


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize(): void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }

    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionGet(): object
    {
        $page = $this->di->get("page");
        $page->add("ipvalidator/index");

        return $page->render([
            "title" => "IP Validator",
        ]);
    }

    /**
     * This is the text method action, it handles:
     * POST METHOD mountpoint
     * POST METHOD mountpoint/
     * POST METHOD mountpoint/index
     *
     * @return array
     */
    public function textActionPost()
    {
        // Init framework
        $request = $this->di->get("request");
        $page = $this->di->get("page");

        $ipadress = $request->getPost("ip");

        if (empty($ipadress)) {
            $ipadress = "IP is missing in request";
        }

        // Validate IP adress
        if (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $message = "is a valid IPv6 address";
            $hostname = gethostbyaddr($ipadress);
        } elseif (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $message = "is a valid IPv4 address";
            $hostname = gethostbyaddr($ipadress);
        } else {
            $message = "is not a valid IP address";
            $hostname = "No domain connected to given ip";
        }

        // Store values in data array
        $data = [
            "ip" => $ipadress,
            "message" => $message,
            "hostname" => $hostname
        ];

        // Add view and send data to it
        $page->add("ipvalidator/text", $data);

        // Render page
        return $page->render([
            "title" => "IP validation as text",
        ]);
    }

    /**
     * This is the json method action, it handles:
     * POST METHOD mountpoint
     * POST METHOD mountpoint/
     * POST METHOD mountpoint/index
     *
     * @return array
     */
    public function jsonActionPost(): array
    {
        // Init framework
        $request = $this->di->get("request");

        $ipadress = $request->getPost("ip");

        if (empty($ipadress)) {
            $ipadress = "IP is missing in request";
        }

        // Validate IP adress
        if (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $message = "is a valid IPv6 address";
            $hostname = gethostbyaddr($ipadress);
        } elseif (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $message = "is a valid IPv4 address";
            $hostname = gethostbyaddr($ipadress);
        } else {
            $message = "is not a valid IP address";
            $hostname = "No domain connected to given ip";
        }

        // Store values in data array
        $data = [
            "ip" => $ipadress,
            "message" => $message,
            "hostname" => $hostname
        ];

        // Deal with the action and return a response.
        $json = [
            $data
        ];

        // Return json
        return [$json];
    }

    /**
     * This is the json method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function jsonActionGet(): array
    {
        // Init framework
        $request = $this->di->get("request");

        $ipadress = $request->getGet("ip");

        if (empty($ipadress)) {
            $ipadress = "IP is missing in request";
        }

        // Validate IP address
        if (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $message = "is a valid IPv6 address";
            $hostname = gethostbyaddr($ipadress);
        } elseif (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $message = "is a valid IPv4 address";
            $hostname = gethostbyaddr($ipadress);
        } else {
            $message = "is not a valid IP address";
            $hostname = "No domain connected to given ip";
        }

        // Store values in data array
        $data = [
            "ip" => $ipadress,
            "message" => $message,
            "hostname" => $hostname
        ];

        // Deal with the action and return a response.
        $json = [
            $data
        ];

        // Return json
        return [$json];
    }

    // /**
    //  * Adding an optional catchAll() method will catch all actions sent to the
    //  * router. You can then reply with an actual response or return void to
    //  * allow for the router to move on to next handler.
    //  * A catchAll() handles the following, if a specific action method is not
    //  * created:
    //  * ANY METHOD mountpoint/**
    //  *
    //  * @param array $args as a variadic parameter.
    //  *
    //  * @return mixed
    //  *
    //  * @SuppressWarnings(PHPMD.UnusedFormalParameter)
    //  */
    // public function catchAll(...$args)
    // {

    //     $page = $this->di->get(("page"));
    //     $data = [
    //         "content" => $this->getDetailsOnRequest(__METHOD__, $args),
    //     ];
    //     $page->add("anax/v2/article/default", $data);

    //     // Deal with the request and send an actual response, or not.
    //     //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
    //     return [$data, 400];
    // }
}
