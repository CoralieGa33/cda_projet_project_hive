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

    public function addUser($user)
    {
        if (isset($user['submit'])) {
            $this->userRepository->addUser($user);
        }

        require "../app/templates/signup.php";
    }

    

}
