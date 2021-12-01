<?php

namespace Config;

require_once 'env.local.php'; 

use Api\Controller\UserController ;

class Router {
    private $userController;

    public function __construct()
    {
        $this->userController = new UserController() ;   
    }
    public function Run() {
        session_start();
        if($_GET) {
            if (isset($_GET['fixtures'])) {
            $this->userController->loadFixtures();
            }
            if (isset($_GET['signup'])) {
                $this->userController->signup($_POST);
            }
            elseif (isset($_GET['registered'])) {
                require "../app/templates/registered.php";
            }
            elseif (isset($_GET['signin'])) {
                $this->userController->signin($_POST);
            }
            elseif (isset($_GET['profile'])) {
                $this->userController->profile($_SESSION["userId"], $_POST);
            }
            elseif (isset($_GET['editpass'])) {
                $this->userController->editpass($_SESSION["userId"], $_POST);
            }
            elseif (isset($_GET['logout'])) {
                session_destroy();
                header('Location: ?');
            }elseif (isset($_GET['board'])) {
                require "../app/templates/board.php";
            }else {
                echo "404 : PAGE NOT FOUND";
            }
        }
        else {
            require "../app/templates/home.php";
        }
    }
}
