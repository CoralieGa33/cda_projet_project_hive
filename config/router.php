<?php

namespace App\config;

class Router {
    public function Run() {
        if(isset($_GET['route'])) {
            // rediriger vers la bonne page
            if($_GET['route'] === 'signup') {
                require "../app/templates/signup.php";
            }
        } else {
            require "../app/templates/home.php";
        }
    }
}
