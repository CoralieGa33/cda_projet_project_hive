<?php

namespace App\api\Controller;

use App\api\Repository\UserRepository;
use App\api\Controller\AbstractController;

class UserController extends AbstractController
{
    private $userRepository;

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

    public function profile($id, $post)
    {
        if(isset($post['submit'])) {
            var_dump($post);
            die();
            $this->userRepository->editUser($id, $post);
        }

        $user = $this->userRepository->findUser($id);

        $this->render("profile", [
            'user' => $user
        ]);
    }

    public function editpass($id, $post)
    {
        if(isset($post['submit'])) {
            var_dump($post);
            die();
            $this->userRepository->editpass($id, $post);
        }

        $this->render("editpass");
    }
}

