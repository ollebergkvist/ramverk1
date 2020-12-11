<?php

namespace Olbe19\User\HTMLForm;

use Olbe19\User\User;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                "legend" => "Register Account",
            ],
            [
                "username" => [
                    "type"        => "text",
                    // "description" => "Here you can place a description.",
                    "placeholder" => "you@domain.com",
                ],

                "password" => [
                    "type"        => "password",
                    // "description" => "Here you can place a description.",
                    "placeholder" => "Must contain at least 6 characters",
                ],

                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Register",
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
        $passwordAgain = $this->form->value("password-again");

        // Check if password matches
        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        // Save to database (Active Record way)
        $user = new User(); // Create user
        $user->setDb($this->di->get("dbqb"));// Create connection between object and db
        $user->acronym = $username; // Save username
        $user->setPassword($password); // Save password
        $user->save();


        // Save to database (Anax way)
        // $db = $this->di->get("dbqb");
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // $db->connect()
        //     ->insert("User", ["acronym", "password"])
        //     ->execute([$username, $password]);

        $this->form->addOutput("User successfully created.");
        return true;
    }
}
