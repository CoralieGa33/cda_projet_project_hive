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
        if(isset($_GET['route'])) {
            // rediriger vers la bonne page
            if($_GET['route'] === 'signup') {
                require "../app/templates/signup.php";
            } elseif ($_GET['route'] === 'addUser') {
                $this->userController->addUSer($_POST);
            } 
        }else {
            require "../app/templates/home.php";
        }
    }
}
