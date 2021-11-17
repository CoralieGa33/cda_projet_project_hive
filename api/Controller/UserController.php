<?php

namespace App\api\Controller;

use App\api\Repository\UserRepository;


class UserController
{
    private $UserRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function signup($user)
    {
        if (isset($user['submit'])) {
            $this->userRepository->addUser($user);
        }

        require "../app/templates/signup.php";
    }

    public function signin($user)
    {     
        if (isset($user['submit'])) {
            $this->userRepository->connectUser($user);
        }

        require "../app/templates/signin.php";  
    }
}
