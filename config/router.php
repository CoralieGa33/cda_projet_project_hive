<?php

namespace Config;

require_once 'env.local.php'; 

use Api\Controller\UserController ;
use Api\Controller\BoardController ;
use Api\Controller\ListeController;
use Api\Controller\CardController ;
use Api\Controller\BackgroundController;
use Api\Controller\MultiController;

class Router {
    private $userController;
    private $boardController;
    private $listeController;
    private $cardController;
    private $backgroundController;
    private $multiController;

    public function __construct()
    {
        $this->userController = new UserController() ; 
        $this->boardController = new BoardController() ;
        $this->listeController = new ListeController();
        $this->cardController = new CardController() ;
        $this->backgroundController = new BackgroundController();
        $this->multiController = new MultiController();
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
                $this->userController->showBoard();
            }elseif (isset($_GET['api/board'])) {
                $this->boardController->getBoardInfos($_POST["boardId"]);
            }elseif (isset($_GET['api/liste'])) {
                $this->listeController->getListe($listId);
            }elseif (isset($_GET['api/liste/add'])) {
                $this->listeController->newListe($_POST);
            }elseif (isset($_GET['api/liste/update'])) {
                $this->listeController->editListe($_POST);
            }elseif (isset($_GET['api/liste/delete'])) {
                $this->listeController->deleteListe($_POST["listeId"]);
                //$this->listeController->deleteListe("24");
            }elseif (isset($_GET['api/card'])) {
                $this->cardController->getCard($_POST["cardId"]);
            }elseif (isset($_GET['api/backgrounds'])) {
                $this->backgroundController->getBackgrounds();
            }elseif (isset($_GET['api/boards'])) {
                $this->multiController->getAllOfBoard($_POST["boardId"], $_SESSION["userId"]);
            }else {
                echo "404 : PAGE NOT FOUND";
            }
        }
        else {
            require "../app/templates/home.php";
        }
    }
}
