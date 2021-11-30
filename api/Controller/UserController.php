<?php

namespace App\api\Controller;

use App\api\Repository\UserRepository;
use App\api\Controller\AbstractController;

class UserController extends AbstractController
{
    private $userRepository;
    private $message;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function signup($user)
    {
        if (isset($user['submit'])) {
            $this->message = $this->userRepository->addUser($user);
        }

        $this->render("signup", [
            'message' => $this->message
        ]);
    }

    public function signin($user)
    {
        if (isset($user['submit'])) {
            $this->message = $this->userRepository->connectUser($user);
        }

        $this->render("signin", [
            'message' => $this->message
        ]);
    }

    public function profile($id, $post)
    {
        if(isset($post['submit'])) {
            $this->message = $this->userRepository->editUser($id, $post);
        }

        $user = $this->userRepository->findUser($id);

        $this->render("profile", [
            'user' => $user,
            'message' => $this->message
        ]);
    }

    public function editpass($id, $post)
    {
        if(isset($post['submit'])) {
            $this->message = $this->userRepository->editpass($id, $post);
        }
        $this->render("editpass", [
            'message' => $this->message
        ]);
    }
}

