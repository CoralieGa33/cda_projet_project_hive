<?php

namespace App\api\Controller;

use App\src\Repository\UserRepository;


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
            $this->UserRepository->addUser($user);
            header('Location: ?');
        }

        require "../app/templates/signup.php";
    }

    

}
