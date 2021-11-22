<?php

namespace App\config;

require_once 'env.local.php'; 

use App\api\Controller\UserController ;

class Router {
    private $userController;

    public function __construct()
    {
        $this->userController = new UserController() ;   
    }
    public function Run() {
        if($_GET) {
            if (isset($_GET['signup'])) {
                $this->userController->signup($_POST);
            }
            elseif (isset($_GET['signin'])) {
                $this->userController->signin($_POST);
            }
            elseif (isset($_GET['logout'])) {
                session_start();
                session_destroy();
                header('Location: ?');
            }
            else {
                echo "404 : PAGE NOT FOUND";
            }
        }
        else {
            require "../app/templates/home.php";
        }
    }
}
