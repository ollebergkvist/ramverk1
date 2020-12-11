<?php

namespace Olbe19\User\HTMLForm;

use Olbe19\User\User;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "User Login"
            ],
            [
                "username" => [
                    "type"        => "text",
                    // "description" => "Here you can place a description.",
                    "placeholder" => "you@example.com",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    "placeholder" => "Minimum 8 characters",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from submitted form
        $username = $this->form->value("username");
        $password = $this->form->value("password");

        // Try to login (Active Record way)
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($username, $password);

        var_dump("hej");
        var_dump($res);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.");
            return false;
        }

        $this->form->addOutput("User " . $user->acronym . " logged in.");
        return true;

        // Anax way
        // $db = $this->di->get("dbqb");
        // $db->connect();
        // $user = $db->select("password")
        //             ->from("User")
        //             ->where("acronym = ?")
        //             ->execute([$username])
        //             ->fetch();

        // // $user is null if user is not found
        // if (!$user || !password_verify($password, $user->password)) {
        //     $this->form->rememberValues();
        //     $this->form->addOutput("User or password is incorrect.");
        //     return false;
        // }

        // $this->form->addOutput("User logged in.");
        // return true;
    }
}
